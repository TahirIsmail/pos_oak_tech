<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expenses as ExpenseModel;
use DataTables;


class Expense extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function list(Request $request) {
      
        $data['action_key'] = 'A_VIEW_EXPENSE_LISTING';
        if (check_access(array($data['action_key']), true) == false) {
            $response = $this->no_access_response_for_listing_table();
            return $response;
        }
      

       

        if ($request->ajax()) {
            $data = ExpenseModel::with('createdUser','updatedUser','expenseCategory')->get();      
            
            return Datatables::of($data)
                ->addIndexColumn()             
                
                ->addColumn('expense_category',function($row){
                    
                     $output = $row['expenseCategory']['name'];
                     
                     return $output;
                })
               
                ->addColumn('created_by', function ($row) {                    
                    $output = $row['createdUser']->fullname;
                    return $output;
                })
                ->addColumn('updated_by', function ($row) {                    
                    $output = $row['updatedUser']->fullname;
                    return $output;
                })
                ->addColumn('created_at', function ($row) {                    
                    $output = ExpenseModel::parseDate($row['created_at']);
                    
                    return $output;
                })
                ->addColumn('action', function ($row) {
                    $data['row']= $row;
                   
                    //resources\views\expenses\layout\expenses_actions.blade.php
                    return view('expenses.layout.expenses_actions', $data)->render();
                })
                ->rawColumns(['expense_category','action'])
                ->make(true);
        }
   
}
}