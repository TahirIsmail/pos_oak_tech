<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ComplaintMailToEngineer;
use App\Models\Account as AccountModel;
use App\Models\Category;
use App\Models\ComplaintAssignToFieldEngg;
use App\Models\CompaintAssignToLabEngg;
use App\Models\ComplaintCharge;
use App\Models\Complaints as ModelsComplaints;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\MasterTransactionType as MasterTransactionTypeModel;
use App\Models\Notification;
use App\Models\PartRequest;
use App\Models\PaymentMethod as PaymentMethodModel;
use App\Models\Product;
use App\Models\RequestToStore;
use App\Models\Role;
use App\Models\Store as StoreModel;
use App\Models\Transaction as TransactionModel;
use App\Models\User;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Complaints extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data['action_key'] = 'A_VIEW_CUSTOMER_COMPLAINTS_LISTING';
        if (check_access(array($data['action_key']), true) == false) {
            $response = $this->no_access_response_for_listing_table();
            return $response;
        }

        if ($request->ajax()) {

            if ($request->logged_user_role_id == 2) {
                $data = ModelsComplaints::with('customer')->where('customer_id', $request->logged_user_customer_id)->get();
            } else {
                $data = ModelsComplaints::with('customer')->get();
            }

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $data['row'] = $row;
                    return view('complaints.layouts.complaints_actions', $data)->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function complaints(Request $request)
    {
        $data['action_key'] = 'VIEW_FIELD_COMPLAINTS_LISTING';
        $data['action_only_listing'] = 'VIEW_ONLY_COMPLAINTS';
        $data['action_all_listing'] = 'VIEW_ALL_COMPLAINTS_LISTING';
        
        // Check initial access
        if (check_access(array($data['action_key']), true) == false) {
            return $this->no_access_response_for_listing_table();
        }
        
        if ($request->ajax()) {
            // Initialize complaints data variable
            $complaints = null;
        
            // Role-specific data retrieval
            if ($request->logged_user_role_id == 2) {
                // Customer-specific complaints
                $complaints = ModelsComplaints::with('customer')
                    ->where('customer_id', $request->logged_user_customer_id)
                    ->get();
            } else if ($request->logged_user_role_id == 1) {
                // Admin can view all complaints
                $complaints = ModelsComplaints::with('customer')->get();
            } else {
                // Field staff specific complaints
                if (check_access(array($data['action_only_listing']), true) == true) {
                    $complaints = ModelsComplaints::with('customer')
                        ->where('assign_to_field_staff_id', $request->logged_user_id)
                        ->get();
                }
        
                // View all complaints if permitted
                if (check_access(array($data['action_all_listing']), true) == true) {
                    $complaints = ModelsComplaints::with('customer')->get();
                }
            }
        
            // Debugging the retrieved data
            // dd($complaints);
            return DataTables::of($complaints)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $data['row'] = $row;
                    return view('complaints.layouts.field_engg_complaints_action', $data)->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function lab_complaints_listing(Request $request)
    {

        $data['action_key'] = 'A_VIEW_CUSTOMER_COMPLAINTS_LISTING';
        if (check_access(array($data['action_key']), true) == false) {
            $response = $this->no_access_response_for_listing_table();
            return $response;
        }

        if ($request->ajax()) {

            if ($request->logged_user_role_id == 1) {
                $data = ModelsComplaints::with('customer')->get();
            } else {
                $data = ModelsComplaints::with('customer')->where('assign_to_lab_staff_id', $request->logged_user_id)->get();

            }
            // dd($data);
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $data['row'] = $row;
                    return view('complaints.layouts.lab_engg_complaints_action', $data)->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    public function product_request_listing(Request $request){
        $data['action_key'] = 'VIEW_PRODUCT_REQUEST_LISTING';
        if (check_access(array($data['action_key']), true) == false) {
            $response = $this->no_access_response_for_listing_table();
            return $response;
        }

        if ($request->ajax()) {        

            $data = RequestToStore::with('user', 'part_request', 'complaint')->get();
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product_request', function ($row) {
                   return $row['request'];
                })
                ->addColumn('user_id', function ($row) {
                    return $row['user']->fullname . '('.$row['user']->email. ')';
                 })
                 ->addColumn('request_start_time', function ($row) {
                    return $row['start_request_time'];
                 })
                 ->addColumn('request_completed', function ($row) {
                    return ($row['end_request_time'] ? $row['end_request_time'] : 'Pending...');
                 })

                ->addColumn('action', function ($row) {
                    $data['row'] = $row;
                    return view('complaints.layouts.request_to_store_actions', $data)->render();
                })
                ->rawColumns(['action', 'product_request', 'user_id', 'request_start_time', 'request_completed'])
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
        try {
            if (!check_access(['A_ADD_CUSTOMER_COMPLAINT'], true)) {
                throw new Exception("Invalid request", 400);
            }
        
            DB::beginTransaction();
        
            $customer_id = Customer::select('id', 'name')->where('slack', $request->customer_slack)->get();
            if (isset($request->assigned_to) && $request->assigned_to != null) {
                $assigned_to = User::select('id', 'email')->where('slack', $request->assigned_to)->get();
            } else {
                $assigned_to = null;
            }
        
            if (isset($request->assigned_to_field_enng) && $request->assigned_to_field_enng != null) {
                $assigned_to_field_enng = User::select('id', 'email')->where('slack', $request->assigned_to_field_enng)->get();
            } else {
                $assigned_to_field_enng = null;
            }
        
            $ticket = $this->generate_ticket("complaints");
            $currentTime =  Carbon::now('Asia/Karachi');
            $time = $currentTime->format('H:i:s');
            $date = $currentTime->format('d-m-Y');
        
            if ($slack == null) {
                $customer_complaints = [
                    "slack" => $this->generate_slack("complaints"),
                    "store_id" => $request->logged_user_store_id,
                    "ticket" => $ticket,
                    "date" => $date,
                    "time" => $time,
                    "assign_to" => $request->assign_to ?? null,
                    "customer_id" => $customer_id[0]->id,
                    "user_name" => $customer_id[0]->name,
                    "equipment_type" => $request->equipment_type,
                    "equipment_make" => $request->equipment_make,
                    "model" => $request->model,
                    "serial_no" => $request->serial_no,
                    "complaint_details" => $request->complaint_details,
                    "end_user_details" => $request->end_user_details,
                    "service_required" => $request->service_required,
                    "type_of_service" => $request->service_type,
                    "assign_to_lab_staff_id" => isset($assigned_to[0]) ? $assigned_to[0]->id : '',
                    "assign_to_field_staff_id" => isset($assigned_to_field_enng[0]) ? $assigned_to_field_enng[0]->id : '',
                    "assign_to_field_engg" => ($request->assign_to == 'assigned_to_field_eng') ? 1 : 0,
                    "assign_to_lab_engg" => ($request->assign_to == 'assigned_to_lab_eng') ? 1 : 0,
                    "poc_name" => $request->poc_name,
                    "c_status" => $request->complaint_status,
                ];
        
                $complaints = ModelsComplaints::create($customer_complaints);
        
                if ($complaints) {
                    if($request->assign_to == 'assigned_to_field_eng'){
                        $complaint_assign_to_field_enggs = [
                            'complaint_id' => $complaints->id,
                            'engg_id' => isset($assigned_to_field_enng[0]) ? $assigned_to_field_enng[0]->id : '',
                            'assign_complaint_time' => now()->setTimezone('Asia/Karachi'),
                        ];
                        $save_assign_to_field_eng_table = ComplaintAssignToFieldEngg::create($complaint_assign_to_field_enggs);
        
                        $notification = [
                            "slack" => $this->generate_slack("notifications"),
                            "user_id" => isset($assigned_to_field_enng[0]) ? $assigned_to_field_enng[0]->id : '',
                            "notification_text" => 'Field Complaint Assigned You Please Check Port to View Details',
                            "created_by" => $request->logged_user_id
                        ];
                        
                        $notification_id = Notification::create($notification)->id;
                        $data['message'] = "Please Check Your Port For New Complaints Which is Assigned to you";
                        Mail::to($assigned_to_field_enng[0]->email)->send(new ComplaintMailToEngineer($complaints, $data['message']));
                    }
                    elseif($request->assign_to == 'assigned_to_lab_eng'){
                        $complaint_assign_to_lab_enggs = [
                            'complaint_id' => $complaints->id,
                            'engg_id' => isset($assigned_to[0]) ? $assigned_to[0]->id : '',
                            'assign_complaint_time' => now()->setTimezone('Asia/Karachi'),
                        ];
                        $save_assign_to_lab_eng_table = CompaintAssignToLabEngg::create($complaint_assign_to_lab_enggs);
        
                        $notification = [
                            "slack" => $this->generate_slack("notifications"),
                            "user_id" => isset($assigned_to[0]) ? $assigned_to[0]->id : '',
                            "notification_text" => 'Lab Complaint Assigned You Please Check Port to View Details',
                            "created_by" => $request->logged_user_id,
                            "created_at" => now()->setTimezone('Asia/Karachi'),
                        ];
                        
                        $notification_id = Notification::create($notification)->id;
                        
                        $data['message'] = "Please Check Your Port For New Complaints Which is Assigned to you";
                        Mail::to($assigned_to[0]->email)->send(new ComplaintMailToEngineer($complaints, $data['message']));
                    }
        
                    DB::commit();
        
                    return response()->json($this->generate_response(
                        array(
                            "message" => "Customer Complaints Submit successfully",
                            "data" => $complaints,
                            'msg' => 'success',
                        ),
                        'SUCCESS'
                    ));
                }
            } else {
                $customer_complaints = [
                    "assign_to" => $request->assign_to ?? null,
                    "customer_id" => $customer_id[0]->id ?? null,
                    "user_name" => $customer_id[0]->name ?? null,
                    "equipment_type" => $request->equipment_type ?? null,
                    "equipment_make" => $request->equipment_make ?? null,
                    "model" => $request->model ?? null,
                    "serial_no" => $request->serial_no ?? null,
                    "complaint_details" => $request->complaint_details ?? null,
                    "end_user_details" => $request->end_user_details ?? null,
                    "service_required" => $request->service_required ?? null,
                    "type_of_service" => $request->service_type,
                    "assign_to_lab_staff_id" => $assigned_to[0]->id ?? null,
                    "assign_to_field_staff_id" => $assigned_to_field_enng[0]->id ?? null,
                    "poc_name" => $request->poc_name ?? null,
                    "c_status" => $request->complaint_status ?? null,
                ];
        
                $conditions = [
                    "slack" => $slack,
                ];
        
                $customer_complaint = ModelsComplaints::updateOrCreate($conditions, $customer_complaints);
        
                DB::commit();
        
                return response()->json($this->generate_response(
                    [
                        "message" => "Customer Complaints Updated successfully",
                        "data" => $customer_complaint,
                        'msg' => 'success',
                    ],
                    'SUCCESS'
                ));
            }
        } catch (\Exception $e) {
            DB::rollBack();
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

            $customer = Customer::select('id')->where('slack', $request->customer_slack)->get();
            $customer_user = User::select('id')->where('customer_id', $customer[0]->id)->get();
            $customerInvoices = Invoice::select('id', 'slack', 'invoice_number', 'invoice_reference')->where('invoice_against_po_from_customer', 1)->where('bill_to_id', $customer_user[0]['id'])->get();

            if ($customerInvoices) {
                return response()->json($this->generate_response(
                    array(
                        "message" => "Order Against Customer Fetched successfully",
                        "data" => $customerInvoices,
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
            $invoice = Invoice::select('id')->where('slack', $request->order_slack)->get();
            $productData = InvoiceProduct::where('invoice_id', $invoice[0]['id'])->get();
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
                    'admin_remark' => $request->admin_remark,
                    'due_date' => $request->due_date,
                    'complaint_status' => 'Process',
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

    public function complaint_completed(Request $request)
    {
        try {

            $complaint = ModelsComplaints::where('slack', $request->complaint_slack)->first();

            $complaint->final_lab_staff_remark = $request->final_lab_staff_remark;
            $complaint->complaint_status = 'Completed Complaint';
            $complaint->complaint_completed_date = date('Y-m-d');
            $complaint->save();
            if ($complaint) {
                return response()->json($this->generate_response(
                    array(
                        "message" => "Customer Complaint Assign to Lab Technician Completed Successfully",
                        "data" => '',
                        'msg' => 'success',
                    ),
                    'SUCCESS'
                ));
            } else {
                return response()->json($this->generate_response(
                    array(
                        "message" => "Some Error Occur",
                        "data" => '',
                        'msg' => 'Fail',
                    ),
                    'Fail'
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

    public function assign_products_complaint(Request $request)
    {
        $complaint_id = ModelsComplaints::select('id')->where('slack', $request->complaint_slack)->first();

        if ($complaint_id) {
            $products = Product::with('subcategory.category')->where('link_to_complaint', $complaint_id->id)->get();
            $data['products'] = $products;
            return response()->json($this->generate_response(
                array(
                    "message" => "",
                    "data" => $data,
                    'msg' => 'success',
                ),
                'SUCCESS'
            ));
        }
    }

    public function change_complaint_status(Request $request)
    {
        $complaint = ModelsComplaints::where('slack', $request->complaint_slack)->first();

        if ($complaint) {
            $complaint->update([
                'billable' => $request->billable,
                'complaint_status_label' => $request->complaint_status_label,
                'type_of_service' => $request->type_of_service,
                'complaint_ok' => $request->complaint_ok,
                'picked_for_workshop' => $request->picked_for_workshop,
                'equipment_S_no' => $request->equipment_s_no,
                'equipment_specs' => $request->equipment_specs,
                'accessories' => $request->accessories,
                'invoice_number' => $request->invoice_number,
                'po_number' => $request->po_number,
                'complaint_condition' => $request->condition,
                'equipment_part_serial_number' => $request->equipment_part_serial_number,
                'outsource_date' => $request->outsource_date,
                'return_date' => $request->return_date,
                'delivery_date' => $request->delivery_date,
                'fault_report_by_customer' => $request->fault_report_by_customer,
                'c_status' => $request->c_status,
                'status' => $request->status,
            ]);

            return response()->json($this->generate_response(
                array(
                    "message" => "Complaint Status Change Successfully.",
                    "data" => '',
                    'msg' => 'success',
                ),
                'SUCCESS'
            ));

        }
    }

    public function change_complaint_remark_by_engg(Request $request)
    {
        $complaint = ModelsComplaints::where('slack', $request->complaint_slack)->first();

        if ($complaint) {
            $complaint->update([
                'parts_required' => $request->parts_required,
                'outsource' => $request->outsource,
                'out_source_item' => $request->outsource_item,
                'ready_date' => $request->ready_date,
                'diagnose_by_engg' => $request->diagnose_by_engg,
            ]);

            return response()->json($this->generate_response(
                array(
                    "message" => "Complaint Status Change Successfully.",
                    "data" => '',
                    'msg' => 'success',
                ),
                'SUCCESS'
            ));

        }
    }

    public function add_customer_feedback(Request $request)
    {
        $complaint = ModelsComplaints::where('slack', $request->complaint_slack)->first();

        if ($complaint) {
            $complaint->update([
                'customer_feedback' => $request->customer_feedback,
            ]);

            return response()->json($this->generate_response(
                array(
                    "message" => "Complaint Customer Feedback Submitted Successfully.",
                    "data" => '',
                    'msg' => 'success',
                ),
                'SUCCESS'
            ));

        }
    }

    public function complaintInvoice(Request $request)
    {
        try {

            if (!check_access(['A_CUSTOMER_COMPLAINT_MAKE_INVOICE'], true)) {
                throw new Exception("Invalid request", 400);
            }
            $total_complaint_amount_invoice = 0;
            $productIdsArray = explode(",", $request->complaint_product_ids);
            $complaint = ModelsComplaints::where('slack', $request->complaint_slack)->first();
            $products = Product::whereIn('id', $productIdsArray)->get();
            $chargeLabel = explode(',', $request->charge_label);
            $chargePrice = explode(',', $request->charge_price);
            //   dd($complaint->id);
            foreach ($products as $product) {
                $total_complaint_amount_invoice += floatval($product->sale_amount_excluding_tax);
            }

            foreach ($chargePrice as $complaintPrice) {
                $total_complaint_amount_invoice += floatval($complaintPrice);
            }

            DB::beginTransaction();

            $complaint->final_total_amount = $total_complaint_amount_invoice;
            $complaint->save();

            for ($i = 0; $i < count($chargeLabel); $i++) {
                $complaint_charges = [
                    'slack' => $this->generate_slack('complaint_charges'),
                    'store_id' => $request->logged_user_store_id,
                    'complaint_id' => $complaint->id,
                    'charge_price' => $chargePrice[$i],
                    'charge_label' => $chargeLabel[$i],
                ];

                $complaintCharges = ComplaintCharge::create($complaint_charges);
            }

            DB::commit();

            return response()->json($this->generate_response(
                array(
                    "message" => "Complaint Invoice Generated Successfully!",
                    "data" => $complaintCharges,
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

    public function fetchComplaintRecord(Request $request)
    {
        $complaints = ModelsComplaints::with('linkToProduct', 'complaintCharges', 'transactions')->where('slack', $request->complaint_slack)->get();
        $total_complaint_amount_invoice = 0;
        $total_received_amount = 0;
        $total_pending_amount = 0;
        $cal = $complaints->toArray();
        if ($cal[0]['transactions']) {
            foreach ($cal[0]['transactions'] as $transaction) {
                $total_received_amount += floatval($transaction['received_amount']);
            }
        }

        foreach ($cal[0]['link_to_product'] as $product) {
            $total_complaint_amount_invoice += floatval($product['sale_amount_including_tax']);
        }

        foreach ($cal[0]['complaint_charges'] as $complaintPrice) {
            $total_complaint_amount_invoice += floatval($complaintPrice['charge_price']);
        }

        $total_pending_amount = $total_complaint_amount_invoice - $total_received_amount;

        // dd($total_pending_amount, $total_complaint_amount_invoice, $total_received_amount);

        $data['total_complaint_amount_invoice'] = $total_complaint_amount_invoice;
        $data['total_received_amount'] = $total_received_amount;
        $data['total_pending_amount'] = $total_pending_amount;

        $income_transaction_type_data = MasterTransactionTypeModel::select('transaction_type_constant')
            ->where('transaction_type_constant', '=', trim('INCOME'))
            ->first();

        $expense_transaction_type_data = MasterTransactionTypeModel::select('transaction_type_constant')
            ->where('transaction_type_constant', '=', trim('EXPENSE'))
            ->first();

        $data['transaction_type'] = $income_transaction_type_data;
        $data['accounts'] = AccountModel::select('accounts.slack', 'accounts.label', 'master_account_type.label as account_type_label')
            ->masterAccountTypeJoin()
            ->active()
            ->get();

        // dd($data['transaction_type']);

        $data['payment_methods'] = PaymentMethodModel::select('slack', 'label')
            ->active()
            ->skipPaymentGateway()
            ->get();

        $store_data = StoreModel::select('currency_name', 'currency_code', 'printnode_enabled')
            ->where([
                ['stores.id', '=', request()->logged_user_store_id],
            ])
            ->active()
            ->first();

        $data['currency_codes'] = [
            'store_currency' => $store_data->currency_code,
        ];

        $data['complaints'] = $complaints;

        if ($complaints) {
            return response()->json($this->generate_response(
                array(
                    "message" => "",
                    "data" => $data,
                    'msg' => 'success',
                ),
                'SUCCESS'
            ));
        }
    }

    public function request_requirement(Request $request)
    {

        $complaints = ModelsComplaints::where('slack', $request->complaint_slack)->get();
        if ($complaints->count() > 0) {
            $complaint = $complaints->first();
            $complaint->lab_staff_remark = $request->lab_staff_remark;
            $complaint->save();
            return response()->json($this->generate_response(
                array(
                    "message" => "Requirement Request Submitted Successfully",
                    "data" => $complaint,
                    'msg' => 'success',
                ),
                'SUCCESS'
            ));
        }
    }

    public function add_request_product_store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Find store role users
            $store_role = Role::where('label', 'store')->first();
            if (!$store_role) {
                throw new \Exception("Store role not found");
            }
    
            $store_users = User::where('role_id', $store_role->id)->get();
    
            // Create request to store
            $request_to_store = [
                'complaint_id' => $request->complaint_id,
                'request_id' => $request->request_id,
                'user_id' => $request->logged_user_id,
                'status' => 0,
                'start_request_time' => now()->setTimezone('Asia/Karachi'),
                'request' => $request->request_detail,
            ];
            $save_request_to_store = RequestToStore::create($request_to_store);
    
            $part_request = PartRequest::findOrFail($request->request_id);
            $part_request->request_status = '1';
            $part_request->save();
    
            // Create notifications and send emails
            foreach ($store_users as $store_user) {
                $notification = [
                    "slack" => $this->generate_slack("notifications"),
                    "user_id" => $store_user->id,
                    "notification_text" => 'Complaint Manager Request for: ' . $request->request_detail,
                    "created_by" => $request->logged_user_id
                ];
                Notification::create($notification);
    
                $data['message'] = "Complaint Manager Request for: " . $request->request_detail;
                Mail::to($store_user->email)->send(new ComplaintMailToEngineer($request_to_store, $data['message']));
            }
    
            DB::commit();
    
            return response()->json($this->generate_response(
                [
                    "message" => "Request Submitted Successfully",
                    "data" => '',
                    'msg' => 'success',
                ],
                'SUCCESS'
            ));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($this->generate_response(
                [
                    "message" => "Request Submission Failed",
                    "data" => '',
                    'msg' => 'error',
                ],
                'ERROR'
            ), 500);
        }
    }


    public function field_eng_request_requirement(Request $request)
    {
        $complaints = ModelsComplaints::where('slack', $request->complaint_slack)->get();
        $field_assign_complaint = ComplaintAssignToFieldEngg::where('engg_id', $request->logged_user_id)->where('complaint_id', $complaints[0]->id)->first();
        
        $cse_role = Role::where('label', 'Cse')->get();
        $cse_user = User::where('role_id', $cse_role[0]->id)->get();   
        if ($complaints->count() > 0 && $field_assign_complaint) {
            $complaint = $complaints->first();
            $complaint->field_engg_part_request = 1;
            $complaint->save();
            $part_request = [
                'complaint_id' => $complaints[0]->id,
                'engineer_id' => $request->logged_user_id,
                'engineer_type' => 'Field_Engineer',
                'request' => $request->field_staff_remark,
                'start_request_time' => now()->setTimezone('Asia/Karachi'),
            ];
            $request_part = PartRequest::create($part_request);

            if($request_part){
                foreach($cse_user as $cse){
                    $notification = [
                        "slack" => $this->generate_slack("notifications"),
                        "user_id" => $cse['id'],
                        "notification_text" => 'Field Engineer Request for: '. $request->field_staff_remark,
                        "created_by" => $request->logged_user_id
                    ];                
                    $notification_id = Notification::create($notification)->id;
                    $data['message'] = "Field Engineer Request for: " . $request->field_staff_remark;
                    Mail::to($cse['email'])->send(new ComplaintMailToEngineer($complaints, $data['message']));
                }
            }
          
    
        }
    }

    public function complaint_submit_transaction(Request $request)
    {

        $account_id = AccountModel::where('slack', $request->account)->first();
        $payment_method_id = PaymentMethodModel::where('slack', $request->payment_method)->first();
        $complaint_id = ModelsComplaints::with('customer')->where('slack', $request->complaint_slack)->first();
        $customer = Customer::where('id', $complaint_id->customer_id)->first();

        $transaction = [
            "slack" => $this->generate_slack("transactions"),
            "store_id" => $request->logged_user_store_id,
            "transaction_code" => Str::random(6),
            "account_id" => $account_id->id,
            "transaction_type" => $request->transaction_type_data,
            "payment_method_id" => $payment_method_id->id,
            "payment_method" => $payment_method_id->label,
            "bill_to" => 'COMPLAINTS',
            "bill_to_id" => $complaint_id->id,
            "bill_to_name" => $customer->name,
            "bill_to_contact" => $customer->phone,
            "bill_to_address" => $customer->address,
            "currency_code" => 'PKR',
            "amount" => $request->payment_total_amount,
            "received_amount" => $request->received_amount,
            "pg_transaction_id" => '',
            "pg_transaction_status" => '',
            "notes" => '',
            "transaction_date" => date('Y-m-d'),
            "created_by" => $request->logged_user_id,
        ];

        // dd($transaction);

        $transaction_id = TransactionModel::create($transaction)->id;

        $code_start_config = Config::get('constants.unique_code_start.transaction');
        $code_start = (isset($code_start_config)) ? $code_start_config : 100;

        $transaction_code = [
            "transaction_code" => ($code_start + $transaction_id),
        ];
        TransactionModel::where('id', $transaction_id)
            ->update($transaction_code);

        if ($transaction_id) {
            return response()->json($this->generate_response(
                array(
                    "message" => "Transaction updated successfully",
                    "data" => $transaction_id,
                ),
                'SUCCESS'
            ));
        }
    }

    public function fetchCategorySubcategory(Request $request)
    {
        $categories = Category::with('subcategories')->get();
        if ($categories) {
            return response()->json($this->generate_response(
                array(
                    "message" => "Requirement Request Submitted Successfully",
                    "data" => $categories,
                    'msg' => 'success',
                ),
                'SUCCESS'
            ));
        }
    }

    public function fetchCategoryProduct(Request $request)
    {
        $category = Category::where('slack', $request->category_slack)->first();
        // dd($category);
        if ($category) {
            $subCategories = $category->subcategories->toArray();
            $subCategoryIDs = $category->subcategories->pluck('id')->toArray();
            $products = Product::with('subcategory.category')->whereIn('sub_category_id', $subCategoryIDs)->where('quantity', 1)->get();
            $data['products'] = $products;
            $data['subCategories'] = $subCategories;
            if ($products) {
                return response()->json($this->generate_response(
                    array(
                        "message" => "",
                        "data" => $data,
                        'msg' => 'success',
                    ),
                    'SUCCESS'
                ));
            }
        }
    }

    public function fetchSubCategoryProduct(Request $request)
    {
        $products = Product::with('subcategory.category')->where('sub_category_id', $request->sub_category_id)->where('quantity', 1)->get();
        if ($products) {
            $data['products'] = $products;
            return response()->json($this->generate_response(
                array(
                    "message" => "",
                    "data" => $data,
                    'msg' => 'success',
                ),
                'SUCCESS'
            ));
        }
    }

    public function assignProductToTechnician(Request $request)
    {
        try {

            if (!check_access(['A_REQUIREMENT_REQUEST_LABTECHNICIAN'], true)) {
                throw new Exception("Invalid request", 400);
            }
            $productIdsArray = explode(",", $request->product_ids);
            $complaint_id = ModelsComplaints::where('slack', $request->complaint_slack)->first();

            // dd($complaint_id);
            DB::beginTransaction();
            foreach ($productIdsArray as $productId) {
                $complaint_update = [
                    'admin_again_remark' => $request->admin_again_remark,
                    'due_date' => $request->extend_date,
                    'complaint_status' => 'Request Completed',
                ];
                $complaint_id->update($complaint_update);
                $product = Product::find($productId);
                // dd($productIdsArray);
                $product->link_to_complaint = $complaint_id->id;
                $product->quantity = 0;
                $product->save();
            }
            DB::commit();
            if ($product) {
                return response()->json($this->generate_response(
                    array(
                        "message" => "Requirement Request Completed Successfully!",
                        "data" => '',
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

    public function fetchSelectedProduct(Request $request)
    {
        // dd($request->product_ids);
        $productIdsArray = explode(",", $request->product_ids[0]);
        $products = Product::with('subcategory.category')->whereIn('id', $productIdsArray)->where('quantity', 1)->get();
        if ($products) {
            $data['products'] = $products;
            return response()->json($this->generate_response(
                array(
                    "message" => "",
                    "data" => $data,
                    'msg' => 'success',
                ),
                'SUCCESS'
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
