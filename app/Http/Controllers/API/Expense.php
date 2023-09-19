<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expenses as ExpenseModel;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
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
    public function store(Request $request, $slack = null)
    {
        //


        try {

            if (!check_access(['A_ADD_EXPENSE'], true)) {
                throw new Exception("Invalid request", 400);
            }

            //    dd($request->complaint_by);

            if ($slack == null) {
                if ($request->hasFile('receipt_upload')) {
                    // Get the uploaded file from the request.
                    $file = $request->file('receipt_upload');

                    // Generate a unique name for the file.
                    $fileName = uniqid('receipt_') . '.' . $file[0]->getClientOriginalExtension();

                    // Store the file in the "expenses" directory in the storage folder using Storage::put().
                    $filePath = Storage::disk('public')->putFileAs('expenses', $file[0], $fileName);

                    // Now, $filePath contains the path to the stored file in the storage folder.

                    // Update the database record with the new file path.
                    // Assuming you have an "expenses" table with a "receipt_path" column.

                }

                //dd($request->all());

                $expense = [
                    "slack" => $this->generate_slack("expenses"),
                    "store_id" => $request->logged_user_store_id,
                    "expense_name" => $request->expense_name,
                    "expense_category" => $request->expense_category,
                    "amount" => $request->amount,
                    "notes" =>  $request->notes,
                    "expense_date" => $request->expense_date,
                    "receipt_upload" => storage::path($filePath),
                    "created_by" => $request->logged_user_id,
                    "updated_by" => $request->logged_user_id,

                ];
                $expense = ExpenseModel::create($expense);
                if ($expense) {
                    return response()->json($this->generate_response(
                        array(
                            "message" => "Expense Submit successfully",
                            "data" => $expense,
                            'msg' => 'success',
                        ),
                        'SUCCESS'
                    ));
                }
            } else {
                
                if ($request->hasFile('receipt_upload')) {
                    // Get the uploaded file from the request.
                    $file = $request->file('receipt_upload');

                    // Generate a unique name for the file.
                    $fileName = uniqid('receipt_') . '.' . $file[0]->getClientOriginalExtension();

                    // Store the file in the "expenses" directory in the storage folder using Storage::put().
                    $filePath = Storage::disk('public')->putFileAs('expenses', $file[0], $fileName);

                    // Now, $filePath contains the path to the stored file in the storage folder.

                    // Update the database record with the new file path.
                    // Assuming you have an "expenses" table with a "receipt_upload" column.
                    $expense = ExpenseModel::where('slack', $slack)->first();
                    
                    if ($expense) {
                        // Delete the old file if it exists.
                        if ($expense->receipt_upload) {
                            Storage::delete($expense->receipt_upload);
                        }

                        // Update the file path in the database.
                        $expense->receipt_upload = $filePath;
                        $expense->save();
                    }
                }
                
                $expense = [

                    "expense_name" => $request->expense_name,
                    "expense_category" => $request->expense_category,
                    "notes" =>  $request->notes,
                    "expense_date" => $request->expense_date,
                    "amount" => $request->amount,
                    "updated_by" => $request->logged_user_id
                ];
                $conditions = [
                    "slack" => $slack,
                ];
                $expense = ExpenseModel::updateOrInsert($conditions, $expense);
                if ($expense) {
                    return response()->json($this->generate_response(
                        array(
                            "message" => "Expense Update successfully",
                            "data" => $expense,
                            'msg' => 'success',
                        ),
                        'SUCCESS'
                    ));
                }
            }
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode(),
                )
            ));
        }
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
    public function list(Request $request)
    {

        $data['action_key'] = 'A_VIEW_EXPENSE_LISTING';
        if (check_access(array($data['action_key']), true) == false) {
            $response = $this->no_access_response_for_listing_table();
            return $response;
        }




        if ($request->ajax()) {
            $data = ExpenseModel::with('createdUser', 'updatedUser', 'expenseCategory')->get();

            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('expense_category', function ($row) {

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
                    $data['row'] = $row;


                    return view('expenses.layout.expenses_actions', $data)->render();
                })
                ->rawColumns(['expense_category', 'action'])
                ->make(true);
        }
    }
}
