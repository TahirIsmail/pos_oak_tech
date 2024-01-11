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
use App\Models\Category;
use App\Models\ComplaintCharge;
use App\Models\User;
use App\Models\PurchaseOrder;
use App\Models\Invoice;


use Illuminate\Support\Facades\DB;

use App\Models\Store as StoreModel;
use App\Models\Country as CountryModel;
use App\Models\MasterStatus as MasterStatusModel;
use App\Models\MasterTransactionType as MasterTransactionTypeModel;
use App\Models\Account as AccountModel;
use App\Models\PaymentMethod as PaymentMethodModel;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Http\Resources\OrderResource;
use App\Http\Resources\KitchenResource;

use App\Models\Order as OrderModel;
use App\Models\OrderProduct as OrderProductModel;
use App\Models\Product as ProductModel;
use App\Models\Customer as CustomerModel;
use App\Models\TaxcodeType as TaxcodeTypeModel;
use App\Models\Transaction as TransactionModel;
use App\Models\MasterOrderType as MasterOrderTypeModel;
use App\Models\Table as TableModel;
use App\Models\BusinessRegister as BusinessRegisterModel;
use App\Models\User as UserModel;
use App\Models\MasterBillingType as MasterBillingTypeModel;
use App\Models\ProductIngredient as ProductIngredientModel;
use App\Models\OrderProductLogs;

use App\Http\Resources\Collections\OrderCollection;

use App\Http\Controllers\API\Notification as NotificationAPI;
use App\Http\Controllers\API\Otp as OtpAPI;
use App\Models\InvoiceProduct;

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

            if ($request->logged_user_role_id == 2) {
                $data = ModelsComplaints::with('order', 'product', 'customer')->where('customer_id', $request->logged_user_customer_id)->get();
            } else {
                $data = ModelsComplaints::with('order', 'product', 'customer')->get();
            }



            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('order_id', function ($row) {
                    return 'Order#' . $row->order->invoice_reference;
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


            $order_id = Invoice::select('id')->where('slack', $request->order_slack)->get();
            $customer_id = Customer::select('id',)->where('slack', $request->customer_slack)->get();

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

    public function complaint_completed(Request $request)
    {
        try {


            $complaint = ModelsComplaints::where('slack', $request->complaint_slack)->first();

            $complaint->final_lab_staff_remark = $request->final_lab_staff_remark;
            $complaint->complaint_status = 'Completed Complaint';
            $complaint->complaint_completed_date =  date('Y-m-d');
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

        $data['transaction_type'] =  $income_transaction_type_data;
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
                ['stores.id', '=', request()->logged_user_store_id]
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


    public function complaint_submit_transaction(Request $request)
    {

        $account_id = AccountModel::where('slack', $request->account)->first();
        $payment_method_id = PaymentMethodModel::where('slack', $request->payment_method)->first();
        $complaint_id = ModelsComplaints::with('customer')->where('slack', $request->complaint_slack)->first();
        // dd($complaint_id->customer->id);

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
            "bill_to_name" => $complaint_id->customer->name,
            "bill_to_contact" => $complaint_id->customer->phone,
            "bill_to_address" => $complaint_id->customer->address,
            "currency_code" => 'PKR',
            "amount" => $request->payment_total_amount,
            "received_amount" => $request->received_amount,
            "pg_transaction_id" => '',
            "pg_transaction_status" => '',
            "notes" => '',
            "transaction_date" => date('Y-m-d'),
            "created_by" => $request->logged_user_id
        ];

        // dd($transaction);

        $transaction_id = TransactionModel::create($transaction)->id;

        $code_start_config = Config::get('constants.unique_code_start.transaction');
        $code_start = (isset($code_start_config)) ? $code_start_config : 100;

        $transaction_code = [
            "transaction_code" => ($code_start + $transaction_id)
        ];
        TransactionModel::where('id', $transaction_id)
            ->update($transaction_code);

        if ($transaction_id) {
            return response()->json($this->generate_response(
                array(
                    "message" => "Transaction updated successfully",
                    "data" => $transaction_id
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
            DB::beginTransaction();
            foreach ($productIdsArray as $productId) {
                $complaint_update = [
                    'admin_again_remark' => $request->admin_again_remark,
                    'due_date' => $request->extend_date,
                    'complaint_status'   => 'Request Completed'
                ];
                $complaint_id->update($complaint_update);
                $product = Product::find($productId);
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
