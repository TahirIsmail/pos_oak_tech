<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DemandForm;
use App\Mail\DemandFormMail;
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
}
