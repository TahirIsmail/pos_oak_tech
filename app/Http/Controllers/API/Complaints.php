<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Complaints as ModelsComplaints;
use DataTables;
use Illuminate\Http\Request;

class Complaints extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        
        $data['action_key'] = 'A_VIEW_CUSTOMER_COMPLAINTS_LISTING';
        if (check_access(array($data['action_key']), true) == false) {
            $response = $this->no_access_response_for_listing_table();
            return $response;
        }

        if ($request->ajax()) {
            $data = ModelsComplaints::with('store', 'assignedTo','complaintBy','createdUser','updatedUser')->get();
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('complaint_by', function ($row) {                    
                    $output = $row['complaintBy']->name;
                    return $output;
                })
                ->addColumn('assigned_to', function ($row) {                    
                    $output = $row['assignedTo']->fullname;
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
                
                ->addColumn('action', function ($row) {
                    $data['supplier'] = $row;          
                    return view('supplier.layouts.supplier_performance_action', $data)->render();
                })
                ->rawColumns(['complaint_by','assigned_to','action'])
                ->make(true);
        }
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
}
