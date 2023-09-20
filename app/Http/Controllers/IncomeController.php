<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction as TransactionModel;
use Illuminate\Support\Facades\DB;
class IncomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $data['menu_key'] = 'MM_ACCOUNTS';
        $data['sub_menu_key'] = 'SM_INCOME';
        check_access(array($data['menu_key'],$data['sub_menu_key']));
        $data['income'] = DB::table('transactions')->where('transaction_type',1)->sum('received_amount');
        $data['expense'] = DB::table('transactions')->where('transaction_type',2)->sum('received_amount');
       
        $data['staff_expense'] = DB::table('transactions')->where('transaction_type',2)->where('bill_to','STAFF')->sum('received_amount');
        $data['customer_income'] = DB::table('transactions')->where('transaction_type',1)->where('bill_to','CUSTOMER_ORDER')->sum('received_amount');
        $data['supplier_expense'] = 0; 
        $data['profitAndLoss'] =(int) ($data['income'] - $data['expense']);
        
       return view('income.index', $data);
    }
}
