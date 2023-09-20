<?php

namespace App\Http\Controllers;

use App\Models\Expenses as ExpenseModel;
use App\Http\Requests\StoreExpensesRequest;
use App\Http\Requests\UpdateExpensesRequest;
use Symfony\Component\HttpFoundation\Request;
use App\Models\MasterExpenseCategory as ExpenseCategoryModel;
use Illuminate\Support\Facades\DB;
class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['menu_key'] = 'MM_ACCOUNTS';
        $data['sub_menu_key'] = 'SM_EXPENSES';

        check_access(array($data['menu_key'],$data['sub_menu_key']));
        $data['supplier_expense'] = 0; 
        $data['staff_expense'] = DB::table('transactions')->where('transaction_type',2)->where('bill_to','STAFF')->sum('received_amount');
        $data['total_expense'] = DB::table('transactions')->where('transaction_type',2)->sum('received_amount');

        
       return view('expenses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExpensesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpensesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show(Expenses $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit(Expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExpensesRequest  $request
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpensesRequest $request, Expenses $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenses $expenses)
    {
        //
    }
    public function add_expense(Request $request,$slack = null){
       
        $data['menu_key'] = 'MM_ACCOUNTS';
        $data['sub_menu_key'] = 'SM_EXPENSES';
        $data['action_key'] = ($slack == null)?'A_ADD_EXPENSES':'A_EDIT_EXPENSES';
        check_access(array($data['action_key']));

       
        $data['expenses_data'] = null;
        $data['selectedExpenseCatId'] = '';
        
        if(!is_null($slack)){
            
            $expense = ExpenseModel::with('createdUser','updatedUser','expenseCategory')->where('slack', '=', $slack)->first();
            if (empty($expense)) {
                abort(404);
            }
            $data['selectedExpenseCatId'] = $expense->expenseCategory->id;
            $data['expenses_data'] = $expense;
            
        }
        
        $data['expenseCategories'] = ExpenseCategoryModel::all();
       
     

       
        
        return view('expenses.add_expense', $data);
    }
    
}
