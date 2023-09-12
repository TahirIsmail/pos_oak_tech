<?php

namespace App\Http\Controllers;

use App\Models\PaySlipAllowance;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\StaffAttendance;
use App\Models\StaffPayroll;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use DateTime;

use Exception;

class StaffPayrollController extends Controller
{
    private $staff_attendance;

    public function __construct(StaffAttendance $staffAttendance)
    {
        $this->staff_attendance = $staffAttendance;
    }
    public function staff_payroll()
    {
        $data['menu_key'] = 'MM_HR';
        $data['sub_menu_key'] = 'SM_STAFF_PAYROLL';
        check_access(array($data['menu_key'], $data['sub_menu_key']));
        $data['roles'] = Role::select('id', 'label')->where('id', '!=', 1)->get();
        $data['users'] = null;
        return view('staff_payroll.add_staff_payroll', $data);
    }

    public function search_staff_list(Request $request)
    {
        // Validate the form data
        $data['menu_key'] = 'MM_HR';
        $data['sub_menu_key'] = 'SM_STAFF_PAYROLL';
        check_access(array($data['menu_key'], $data['sub_menu_key']));
        $validator = Validator::make($request->all(), [
            'role' => 'required',
            'month' => 'required|numeric|min:1|max:12',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('staff_payroll')
                ->withErrors($validator)
                ->withInput();
        }

        $data['role_id'] = $request->role;

        $monthName = date("F", mktime(0, 0, 0, $request->month, 1));
        $currentYear = date("Y");
        $data['month'] = $monthName;
        $data['year'] = $currentYear;


        $data['roles'] = Role::select('id', 'label')->where('id', '!=', 1)->get();

        $users = User::with([
            'role',
            'staffPayrolls' => function ($query) use ($monthName) {
                $query->where('month', $monthName);
            },
            'staffPayrolls.paySlipAllownace',
        ])
            ->where('role_id', $request->role)
            ->get();

        //    dd($users);
        $data['users'] = $users;

        return view('staff_payroll.add_staff_payroll', $data);
    }


    public function search_staff_payroll(Request $request)
    {
        $data['menu_key'] = 'MM_HR';
        $data['sub_menu_key'] = 'SM_STAFF_PAYROLL';
        check_access(array($data['menu_key'], $data['sub_menu_key']));

        $staff_id = $request->input('staff_id');
        $month = $request->input('month');
        $year = $request->input('year');

        $monthName = date("F", mktime(0, 0, 0, $month, 1));

        $users = User::with([
            'role',
            'staffPayrolls' => function ($query) use ($monthName, $year) {
                $query->where('month', $monthName)->where('year', $year);
            },
            'staffPayrolls.paySlipAllownace',
        ])
            ->where('id', $staff_id)
            ->get();


        return response()->json($users);
    }

    public function updatePayroll(Request $request)
    {
        try {

            if (!check_access(['A_EDIT_STAFF_PAYROLL'], true)) {
                throw new Exception("Invalid request", 400);
            }

            // dd($request->all());


            $staff_payroll = [
                "payment_mode" => $request->payment_mode,
                "payment_date" => $request->payment_date,
                "remark" => $request->remarks,
                "status" => "Paid"
            ];


            $action_response = StaffPayroll::where('id', $request->paymentid)
                ->update($staff_payroll);


            return response()->json([
                "message" => "Product created successfully",
                "data" => $action_response,
            ]);
        } catch (Exception $e) {
            return response()->json();
        }
    }


    public function revert_staff_payroll(Request $request)
    {
        try {

            if (!check_access(['A_REVERT_STAFF_PAYROLL'], true)) {
                throw new Exception("Invalid request", 400);
            }

           
           $payslipallownacerevert = PaySlipAllowance::where('payslip_id', $request->payroll_id)->delete();

           if($payslipallownacerevert){
              $revert_payroll =  StaffPayroll::where('id', $request->payroll_id)->delete();
           }

            return response()->json([
                "message" => "Product created successfully",
                "data" => $revert_payroll,
            ]);
        } catch (Exception $e) {
            return response()->json();
        }
    }





    public function generatePayroll($slack, $month, $year)
    {
        $data['menu_key'] = 'MM_HR';
        $data['sub_menu_key'] = 'SM_STAFF_PAYROLL';
        check_access(array($data['menu_key'], $data['sub_menu_key']));


        $data['staff_with_attendance'] = User::with('staffAttendances', 'role')->where('slack', $slack)->get();


        $data["month"]               = "";
        $data["year"]                = "";
        $data["present"]             = 0;
        $data["absent"]              = 0;
        $data["late"]                = 0;
        $data["half_day"]            = 0;
        $data["holiday"]             = 0;
        $data["leave_count"]         = 0;
        $data["alloted_leave"]       = 0;



        $date = $year . "-" . $month;
        $datee = new DateTime("$year-$month-01");
        $datee->modify('last month');
        $previousMonth = $datee->format('F');
        $previousYear = $datee->format('Y');

        $data["month"]  = $month;
        $data["year"]   = $year;
        // dd($data['year']);

        $newdate = date('Y-m-d', strtotime($date . " +1 month"));

        $result = $this->staff_attendance->monthAttendance($newdate, 3, $data['staff_with_attendance'][0]['id']);

        $data['attendance_records'] = $result;

        if ($data['staff_with_attendance'][0]['profile_image']) {
            $data['profile_image'] = asset('storage/profile/' . $data['staff_with_attendance'][0]['profile_image']);
        } else {
            $data['profile_image']  = asset('public/images/users.jpg');
        }

        //  dd($data['profile_image']);

        return view('staff_payroll.generate_staff_payroll', $data);
    }
}
