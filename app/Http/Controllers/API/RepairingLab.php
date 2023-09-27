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

class RepairingLab extends Controller
{
    public function index(Request $request)
    {
        //

        $data['action_key'] = 'A_VIEW_REPAIRING_LISTING';
        if (check_access(array($data['action_key']), true) == false) {
            $response = $this->no_access_response_for_listing_table();
            return $response;
        }

        if ($request->ajax()) {

            if($request->logged_user_role_id == 1){
                
                $data = ModelsComplaints::with('order', 'product', 'customer')->get();
            }
            else{
                $data = ModelsComplaints::with('order', 'product', 'customer')->where('assign_to_lab_staff_id', $request->logged_user_id)->get();
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
}
