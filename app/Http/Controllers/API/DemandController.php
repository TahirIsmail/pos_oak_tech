<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DemandForm;
use App\Mail\DemandFormMail;
use App\Models\QuotationRequest;
use Illuminate\Support\Facades\Mail;
use DataTables;
use App\Models\User;
class DemandController extends Controller
{

    public function index(Request $request){
        $data['action_key'] = 'A_LISTING_DEMAND';
        if (check_access(array($data['action_key']), true) == false) {
            $response = $this->no_access_response_for_listing_table();
            return $response;
        }       
        if ($request->ajax()) {
            if($request->logged_user_role_id == 3){               
                $data = DemandForm::where('suppliers_id', 'LIKE', '%' . $request->logged_user_id . '%')->get();
            }else{
                $data = DemandForm::all();
            }
            //  dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('suppliers_id', function ($row) {
                    $suppliers_id = explode(',', $row->suppliers_id);
                    $suppliers = User::whereIn('id', $suppliers_id)->get();
                    $suppliers_name = [];                    
                    foreach ($suppliers as $supplier){
                       array_push($suppliers_name, $supplier->fullname);
                    }
                    $supplierNames = implode(',', $suppliers_name);
                    return $supplierNames;
                })          
                ->rawColumns(['suppliers_id'])
                ->make(true);
        }
    }

    public function load_quotation_request_data(Request $request){
        $data['action_key'] = 'A_LISTING_QUOTATION_REQUEST';
        if (check_access(array($data['action_key']), true) == false) {
            $response = $this->no_access_response_for_listing_table();
            return $response;
        }       
        if ($request->ajax()) {
            if ($request->logged_user_role_id == 2) {               
                $data = QuotationRequest::with('customer')->where('customer_id', $request)->get();
            } else {
                $data = QuotationRequest::with('customer')->get();
            }
            //  dd($data);
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('customer_id', function ($row) {
               return $row['customer']['name'];
            })          
            ->rawColumns(['customer_id'])
            ->make(true);
        }
    }


    public function add_demand_form(Request $request){
        try {

            if (!check_access(['A_ADD_DEMAND'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $suppliers = json_decode($request->input('suppliers'), true);
            $items = json_decode($request->input('items'), true);
            $supplier_ids = [];
            $supplier_emails = [];
            foreach ($suppliers as $supplier){
                  array_push($supplier_ids, $supplier['id']);
                  array_push($supplier_emails, $supplier['email']);
            }
            $supplier_ids_string = implode(',', $supplier_ids);

            $demandForm = [
                   'details' => $request->input('items'),
                   'suppliers_id' => $supplier_ids_string,
            ];

            // dd($items);
            $demandForm = DemandForm::create($demandForm);

            if($demandForm){
                foreach ($supplier_emails as $email){
                    Mail::to($email)->send(new DemandFormMail($items));
                }

                return response()->json($this->generate_response(
                    array(
                        "message" => "Demand Form Sent To Suppliers/Vendors Sucessfully.",
                        "data" => $demandForm,
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

    public function add_quotation_request(Request $request){
        try {

            if (!check_access(['A_ADD_QUOTATION_REQUEST'], true)) {
                throw new Exception("Invalid request", 400);
            }

           
            $items = json_decode($request->input('items'), true);
            foreach ($items as $item) {
                $data = [
                    "customer_id" => $request->customer_id,
                    "ref_no" => str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT),
                    "items_details" => $item['item_details'],
                    "qty" => $item['quantity'],
                    "payment_terms" => $item['payment_terms'],
                    "delivery_terms" => $item['delivery_terms'],
                ];
                QuotationRequest::create($data);             
            }
           
           

           
                return response()->json($this->generate_response(
                    array(
                        "message" => "Quotation Request Submit Sucessfully.",
                        "data" => $data,
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
}
