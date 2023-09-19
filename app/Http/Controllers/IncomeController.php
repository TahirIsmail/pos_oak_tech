<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction as TransactionModel;
class IncomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $data['menu_key'] = 'MM_ACCOUNTS';
        $data['sub_menu_key'] = 'SM_INCOME';
        check_access(array($data['menu_key'],$data['sub_menu_key']));
        $data['income'] = TransactionModel::where('transaction_type',1)->count();
        dd($data);
       return view('income.index', $data);
    }
}
