<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Complaints as ModelsComplaints;
use DataTables;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

            if($request->logged_user_role_id == 2){
                $data = ModelsComplaints::with('order', 'product', 'customer')->where('customer_id', $request->logged_user_customer_id)->get();

            }
            else{
                $data = ModelsComplaints::with('order', 'product', 'customer')->get();
            }



            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('order_id', function ($row) {
                    return 'Order#' . $row->order->order_number;
                })
                ->addColumn('product_id', function ($row) {
                    return $row->product->name . ' (' . $row->product->product_code . ')';
                })
                ->addColumn('customer_id', function ($row) {
                    return $row->customer->name . ' (' . $row->customer->email . ')';
                })
                ->addColumn('complaint_status', function ($row) {
                    return '<span class="btn btn-danger text-white">' . $row->complaint_status . '</span>';
                })
                ->addColumn('action', function ($row) {

                    $data['row'] = $row;

                    return view('complaints.layouts.complaints_actions', $data)->render();
                })
                ->rawColumns(['order_id', 'product_id', 'customer_id', 'complaint_status', 'action'])
                ->make(true);
        }
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

            if (!check_access(['A_ADD_CUSTOMER_COMPLAINT'], true)) {
                throw new Exception("Invalid request", 400);
            }


            $order_id = Order::select('id')->where('slack', $request->order_slack)->get();
            $customer_id = Customer::select('id',)->where('slack', $request->customer_slack)->get();

            // dd($slack);
            if ($slack == null) {

                // dd($order_id[0]->id, $customer_id);
                $customer_complaints = [
                    "slack" => $this->generate_slack("complaints"),
                    "store_id" => $request->logged_user_store_id,
                    "order_id" => $order_id[0]->id,
                    "customer_id" => $customer_id[0]->id,
                    "product_id" => $request->product_id,
                    "complaint_ref" => $request->complaint_ref,
                    "description" => $request->descriptions,
                    "complaint_status" => "Complaint",
                    "complaint_by" => 'Customer'
                ];
                // dd($customer_complaints);
                $customer_complaints = ModelsComplaints::create($customer_complaints);
                if ($customer_complaints) {
                    return response()->json($this->generate_response(
                        array(
                            "message" => "Customer Complaints Submit successfully",
                            "data" => $customer_complaints,
                            'msg' => 'success',
                        ),
                        'SUCCESS'
                    ));
                }
            } else {
                $customer_complaints = [

                    "order_id" => $order_id[0]->id,
                    "customer_id" => $customer_id[0]->id,
                    "product_id" => $request->product_id,
                    "complaint_ref" => $request->complaint_ref,
                    "description" => $request->descriptions,

                ];
                $conditions = [
                    "slack" => $slack,
                ];
                $customer_complaint = ModelsComplaints::updateOrInsert($conditions, $customer_complaints);
                if ($customer_complaint) {
                    return response()->json($this->generate_response(
                        array(
                            "message" => "Customer Complaints Update successfully",
                            "data" => $customer_complaint,
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


    public function customer_orders(Request $request)
    {
        try {

            if (!check_access(['A_ADD_CUSTOMER_COMPLAINT'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $customers_orders = Order::with(['customer_data' => function ($query) use ($request) {
                $query->where('slack', $request->slack);
            }])->get();

            if ($customers_orders) {
                return response()->json($this->generate_response(
                    array(
                        "message" => "Order Against Customer Fetched successfully",
                        "data" => $customers_orders,
                        'msg' => 'success',
                    ),
                    'SUCCESS'
                ));
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


    public function customer_orders_products(Request $request)
    {
        try {

            if (!check_access(['A_ADD_CUSTOMER_COMPLAINT'], true)) {
                throw new Exception("Invalid request", 400);
            }

            // dd($request->order_slack);
            $orders = OrderProduct::with('product_data')->OrderJoin()->where('orders.slack', $request->order_slack)->get();
            $productData = $orders->pluck('product_data');


            if ($productData) {
                return response()->json($this->generate_response(
                    array(
                        "message" => "Product Against Order Fetched successfully",
                        "data" => $productData,
                        'msg' => 'success',
                    ),
                    'SUCCESS'
                ));
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


    public function delete_complaint($slack)
    {
        try {

            if (!check_access(['A_DELETE_CUSTOMER_COMPLAINT'], true)) {
                throw new Exception("Invalid request", 400);
            }

            DB::beginTransaction();

            $del = ModelsComplaints::where('slack', $slack)->delete();

            DB::commit();




            return response()->json($this->generate_response(
                array(
                    "message" => "Customer Complaint Deleted Successfully",
                    "data" => $del,
                    'msg' => 'success',
                ),
                'SUCCESS'
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

    public function assign_complaint_to_technician(Request $request)
    {
        try {

            if (!check_access(['A_ASSIGN_CUSTOMER_COMPLAINT_LABTECHNICIAN'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $lab_technician_id = User::select('id')->where('slack', $request->lab_staff_slack)->first();
            $complaint = ModelsComplaints::where('slack', $request->complaint_slack)->first();
            // dd($complaint);
            if ($complaint) {
                // Update the model's attributes
                $complaint->update([
                    'assign_to_lab_staff_id' => $lab_technician_id->id,
                    'admin_remark'           => $request->admin_remark,
                    'due_date'                    => $request->due_date,
                    'complaint_status'       => 'Process',
                ]);
            }

            return response()->json($this->generate_response(
                array(
                    "message" => "Customer Complaint Assign to Lab Technician Successfully",
                    "data" => '',
                    'msg' => 'success',
                ),
                'SUCCESS'
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
