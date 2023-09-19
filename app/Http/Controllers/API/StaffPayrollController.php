<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Collections\SupplierCollection;
use App\Http\Resources\SupplierResource;
use App\Models\PaySlipAllowance;
use App\Models\StaffPayroll;
use App\Models\Supplier as SupplierModel;
use App\Models\SupplierPerformance;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DataTables;
use App\Models\User as UserModel;
use App\Models\Account as AccountModel;
use App\Models\PaymentMethod as PaymentMethodModel;

use App\Models\Transaction as TransactionModel;

use Validator;

class StaffPayrollController extends Controller
{
    public function store(Request $request){
        try {

            if (!check_access(['A_ADD_STAFF_PAYROLL'], true)) {
                throw new Exception("Invalid request", 400);
            }
            $total_deductions = 0;
            $total_earnings = 0;

            

            if (is_array($request->deductions)) {
                foreach ($request->deductions as $deduction) {
                    if (
                        isset($deduction['deduction_type']) &&
                        isset($deduction['deduction_amount']) &&
                        $deduction['deduction_type'] && // Optional check if 'deduction_type' is not empty
                        $deduction['deduction_amount'] != 0 // Optional check if 'deduction_amount' is not zero
                    ) {
                        $total_deductions += $deduction['deduction_amount'];
                    }
                }
            }

            if (is_array($request->earnings)) {
                foreach ($request->earnings as $earning) {
                    if (
                        isset($earning['allowance_type']) &&
                        isset($earning['allowance_amount']) &&
                        $earning['allowance_type'] && // Optional check if 'allowance_type' is not empty
                        $earning['allowance_amount'] != 0 // Optional check if 'allowance_amount' is not zero
                    ) {                       
                        $total_earnings += $earning['allowance_amount'];
                    }
                }
            }
            DB::beginTransaction();
            $staff_payroll = [
                'staff_id' => $request->staff_id,
                "store_id" => $request->logged_user_store_id,
                'basic' => $request->basic_salary,
                'total_allowance' => $total_earnings,
                'total_deduction' => $total_deductions,
                'tax' => $request->tax,
                'net_salary' => $request->net_salary,
                'status' => $request->status,
                'month' => $request->month,
                'year' => $request->year,
            ];
            $staff_payroll_id = StaffPayroll::create($staff_payroll)->id;
            
            if (is_array($request->earnings)) {
                foreach ($request->earnings as $earning) {
                    if (
                        isset($earning['allowance_type']) &&
                        isset($earning['allowance_amount']) &&
                        $earning['allowance_type'] &&
                        $earning['allowance_amount'] != 0
                    ) {
                       
                        PaySlipAllowance::create([
                            'payslip_id' => $staff_payroll_id,
                            'allowance_type' => $earning['allowance_type'],
                            'amount' => $earning['allowance_amount'],
                            'staff_id' => $request->staff_id,
                            'cal_type' => 'positive',
                        ]);
                    }
                }
            }         

            if (is_array($request->deductions)) {
                foreach ($request->deductions as $deduction) {
                    if (
                        isset($deduction['deduction_type']) &&
                        isset($deduction['deduction_amount']) &&
                        $deduction['deduction_type'] &&
                        $deduction['deduction_amount'] != 0
                    ) {
                        PaySlipAllowance::create([
                            'payslip_id' => $staff_payroll_id,
                            'allowance_type' => $deduction['deduction_type'],
                            'amount' => $deduction['deduction_amount'],
                            'staff_id' => $request->staff_id,
                            'cal_type' => 'negative',
                        ]);
                    }
                }
            }

           
         
            DB::commit();

            return response()->json($this->generate_response(
                array(
                    "message" => "Add Staff Payroll Sucessfully!",
                    "data" => $staff_payroll_id,
                ), 'SUCCESS'
            ));

        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode(),
                )
            ));
        }
    }



    


   
}
