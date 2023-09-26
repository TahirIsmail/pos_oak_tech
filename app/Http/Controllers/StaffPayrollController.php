<?php

namespace App\Http\Controllers;

use App\Models\Account as AccountModel;
use App\Models\PaymentMethod as PaymentMethodModel;
use App\Models\PaySlipAllowance;
use App\Models\Role;
use App\Models\StaffAttendance;
use App\Models\StaffPayroll;
use App\Models\Transaction as TransactionModel;
use App\Models\User;
use App\Models\User as UserModel;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        $data['roles'] = Role::select('id', 'label')->CustomerRole()->SupplierRole()->where('id', '!=', 1)->get();
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

        $data['roles'] = Role::select('id', 'label')->CustomerRole()->where('id', '!=', 1)->get();

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


            $staff_payroll = [
                "payment_mode" => $request->payment_mode,
                "payment_date" => $request->payment_date,
                "remark" => $request->remarks,
                "status" => "Paid",
            ];

            $action_response = StaffPayroll::where('id', $request->paymentid)
                ->update($staff_payroll);

            if ($action_response) {
                $payment_date = $request->payment_date;
                $month = date("m", strtotime($payment_date)); 
                $year = date("Y", strtotime($payment_date));
                $monthText = date("F", strtotime("2023-$month-01"));
                $staff = [
                    "staff_id" => $request->staff_id,
                    "store_id" => $request->logged_user_store_id,
                    "payment_mode" => $request->payment_mode,
                    "payment_date" => $request->payment_date,
                    "remark" => $request->remarks,
                    "month" => $monthText,
                    "net_salary" => $request->net_salary,
                    "year" => $year,
                    "account" => 1,
                    "created_by" => $request->logged_user_id,
                ];
                $this->staff_transaction($staff);
            }

            return response()->json([
                "message" => "Product created successfully",
                "data" => $action_response,
            ]);
        } catch (Exception $e) {
            return response()->json();
        }
    }

    public function staff_transaction($staff_detail)
    {
        // dd($staff_detail);
        $user_data = UserModel::select('id', 'fullname', 'email', 'phone')
            ->where('id', '=', trim($staff_detail['staff_id']))
            ->active()
            ->first();
            
            if (empty($user_data)) {
                throw new Exception("Invalid user selected", 400);
        }
        
        
        
        $payment_method_data = PaymentMethodModel::select('id', 'label')
        ->where('label', '=', trim($staff_detail['payment_mode']))
        ->first();
        
        $bill_to_id = $user_data->id;
        $bill_to_name = $user_data->fullname;
        $bill_to_contact = implode(', ', [$user_data->phone, $user_data->email]);
        $bill_to_address = '';
        
        // dd($staff_detail);
        DB::beginTransaction();

        $transaction = [
            "slack" => $this->generate_slack("transactions"),
            "store_id" => $staff_detail['store_id'],
            "transaction_code" => Str::random(6),
            "account_id" => 1,
            "transaction_type" => 2,
            "payment_method_id" => $payment_method_data->id,
            "payment_method" => $payment_method_data->label,
            "bill_to" => 'STAFF',
            "bill_to_id" => $bill_to_id,
            "bill_to_name" => $bill_to_name,
            "bill_to_contact" => $bill_to_contact,
            "bill_to_address" => $bill_to_address,
            "currency_code" => 'PKR',
            "amount" => $staff_detail['net_salary'],
            "notes" => '',
            "transaction_date" => $staff_detail['payment_date'],
            "created_by" => $staff_detail['created_by'],
        ];
        // dd($transaction);
        $transaction_id = TransactionModel::create($transaction)->id;

        $code_start_config = Config::get('constants.unique_code_start.transaction');
        $code_start = (isset($code_start_config)) ? $code_start_config : 100;

        $transaction_code = [
            "transaction_code" => ($code_start + $transaction_id),
        ];
        TransactionModel::where('id', $transaction_id)
            ->update($transaction_code);

        DB::commit();

        if ($transaction_id) {
            return true;
        } else {
            return false;
        }

    }

    public function revert_staff_payroll(Request $request)
    {
        try {

            if (!check_access(['A_REVERT_STAFF_PAYROLL'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $payslipallownacerevert = PaySlipAllowance::where('payslip_id', $request->payroll_id)->delete();

            if ($payslipallownacerevert) {
                $revert_payroll = StaffPayroll::where('id', $request->payroll_id)->delete();
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

        $data["month"] = "";
        $data["year"] = "";
        $data["present"] = 0;
        $data["absent"] = 0;
        $data["late"] = 0;
        $data["half_day"] = 0;
        $data["holiday"] = 0;
        $data["leave_count"] = 0;
        $data["alloted_leave"] = 0;

        $date = $year . "-" . $month;
        $datee = new DateTime("$year-$month-01");
        $datee->modify('last month');
        $previousMonth = $datee->format('F');
        $previousYear = $datee->format('Y');

        $data["month"] = $month;
        $data["year"] = $year;
        // dd($data['year']);

        $newdate = date('Y-m-d', strtotime($date . " +1 month"));

        $result = $this->staff_attendance->monthAttendance($newdate, 3, $data['staff_with_attendance'][0]['id']);

        $data['attendance_records'] = $result;

        if ($data['staff_with_attendance'][0]['profile_image']) {
            $data['profile_image'] = asset('storage/profile/' . $data['staff_with_attendance'][0]['profile_image']);
        } else {
            $data['profile_image'] = asset('public/images/users.jpg');
        }

        $data['accounts'] = AccountModel::select('accounts.slack', 'accounts.label', 'master_account_type.label as account_type_label')
            ->masterAccountTypeJoin()
            ->active()
            ->get();

        $data['payment_methods'] = PaymentMethodModel::select('slack', 'label')
            ->active()
            ->get();
        //  dd($data['profile_image']);

        return view('staff_payroll.generate_staff_payroll', $data);
    }
}
