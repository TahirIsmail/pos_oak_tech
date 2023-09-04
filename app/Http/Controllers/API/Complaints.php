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

                    $data['row']= $row;
                    
                    return view('complaints.layouts.complaints_actions', $data)->render();
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
    public function store(Request $request,$slack = null)
    {
        //
        
        try {

            if (!check_access(['A_ADD_CUSTOMER_COMPLAINT'], true)) {
                throw new Exception("Invalid request", 400);
            }


            if ($slack == null) {
                $customer_complaints = [
                    "slack" => $this->generate_slack("complaints"),
                    "assigned_to" => $request->assigned_to,
                    "complaint_by " => $request->complaint_by,
                    "complaint_ref" => $request->complaint_ref,
                    "descriptions" => $request->descriptions,
                    "complaint_status" => $request->complaint_status,
                    "created_by" => $request->logged_user_id
                    
                ];
                $customer_complaints = ModelsComplaints::create($customer_complaints);
                if ($customer_complaints) {
                    return response()->json($this->generate_response(
                        array(
                            "message" => "Customer Complaints Submit successfully",
                            "data" => $customer_complaints,
                            'msg' => 'success',
                        ), 'SUCCESS'
                    ));
                }
            } else {
                $supplier_performance = [                  
                    "supplier_id" => $request->name,
                    "store_id" => $request->logged_user_store_id,
                    "status" => $request->status,
                    "address" => $request->address,
                    "delivery_timeline" => $request->DeliveryTimeline,
                    "rating_delivery_timeline" => $request->Rating_DeliveryTimeline,
                    "product_quality" => $request->ProductQuality,
                    "rating_product_quality" => $request->Rating_ProductQuality,    
                    "responsiveness" => $request->Responsiveness,
                    "rating_responsiveness" => $request->Rating_Responsiveness,
                ];
                $conditions = [
                    "slack" => $slack,
                ];
                $supplier_performance = SupplierPerformance::updateOrInsert($conditions, $supplier_performance);
                if ($supplier_performance) {
                    return response()->json($this->generate_response(
                        array(
                            "message" => "Supplier Performance Update successfully",
                            "data" => $supplier_performance,
                            'msg' => 'success',
                        ), 'SUCCESS'
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
}
