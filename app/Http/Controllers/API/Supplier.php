<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Collections\SupplierCollection;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier as SupplierModel;
use App\Models\User as UserModel;
use App\Models\UserStore as UserStoreModel;
use App\Models\SupplierPerformance;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\Role as RoleApi;
use App\Models\BusinessType;
use App\Models\ContactPerson;
use App\Models\SupplierBankDetails;

use Validator;

class Supplier extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $data['action_key'] = 'A_VIEW_SUPPLIER_LISTING';
            if (check_access(array($data['action_key']), true) == false) {
                $response = $this->no_access_response_for_listing_table();
                return $response;
            }

            $item_array = array();

            $draw = $request->draw;
            $limit = $request->length;
            $offset = $request->start;

            $order_by = $request->order[0]["column"];
            $order_direction = $request->order[0]["dir"];
            $order_by_column = $request->columns[$order_by]['name'];

            $filter_string = $request->search['value'];
            $filter_columns = array_filter(data_get($request->columns, '*.name'));

            $query = SupplierModel::select('suppliers.*', 'master_status.label as status_label', 'master_status.color as status_color', 'user_created.fullname')
                ->take($limit)
                ->skip($offset)
                ->statusJoin()
                ->SkipDefaultSupplier()
                ->createdUser()

                ->when($order_by_column, function ($query, $order_by_column) use ($order_direction) {
                    $query->orderBy($order_by_column, $order_direction);
                }, function ($query) {
                    $query->orderBy('created_at', 'desc');
                })

                ->when($filter_string, function ($query, $filter_string) use ($filter_columns) {
                    $query->where(function ($query) use ($filter_string, $filter_columns) {
                        foreach ($filter_columns as $filter_column) {
                            $query->orWhere($filter_column, 'like', '%' . $filter_string . '%');
                        }
                    });
                })

                ->get();

            $suppliers = SupplierResource::collection($query);

            $total_count = SupplierModel::select("id")->get()->count();

            $item_array = [];
            foreach ($suppliers as $key => $supplier) {

                $supplier = $supplier->toArray($request);

                $item_array[$key][] = Str::limit($supplier['name'], 50);
                $item_array[$key][] = $supplier['supplier_code'];
                $item_array[$key][] = (isset($supplier['status']['label'])) ? view('common.status', ['status_data' => ['label' => $supplier['status']['label'], "color" => $supplier['status']['color']]])->render() : '-';
                $item_array[$key][] = $supplier['created_at_label'];
                $item_array[$key][] = $supplier['updated_at_label'];
                $item_array[$key][] = (isset($supplier['created_by']) && isset($supplier['created_by']['fullname'])) ? $supplier['created_by']['fullname'] : '-';
                $item_array[$key][] = view('supplier.layouts.supplier_actions', array('supplier' => $supplier))->render();
            }

            $response = [
                'draw' => $draw,
                'recordsTotal' => $total_count,
                'recordsFiltered' => $total_count,
                'data' => $item_array,
            ];

            return response()->json($response);
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode(),
                )
            ));
        }
    }

    public function suppliers_performance(Request $request)
    {
        $data['action_key'] = 'A_VIEW_SUPPLIER_PERFORMANCE_LISTING';
        if (check_access(array($data['action_key']), true) == false) {
            $response = $this->no_access_response_for_listing_table();
            return $response;
        }

        if ($request->ajax()) {
            $data = SupplierPerformance::with('store', 'supplier')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('supplier_id', function ($row) {
                    $output = $row['supplier']['name'];
                    return $output;
                })
                ->addColumn('delivery_timeline', function ($row) {
                    $data['row'] = $row;
                    return view('suppliers_rating.delivery_timeline', $data);
                })
                ->addColumn('product_quality', function ($row) {
                    $data['row'] = $row;
                    return view('suppliers_rating.product_quality', $data);
                })
                ->addColumn('responsiveness', function ($row) {
                    $data['row'] = $row;
                    return view('suppliers_rating.responsiveness', $data);
                })
                ->addColumn('action', function ($row) {
                    $data['supplier'] = $row;
                    return view('supplier.layouts.supplier_performance_action', $data)->render();
                })
                ->rawColumns(['supplier_id', 'delivery_timeline', 'product_quality', 'responsiveness', 'action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            if (!check_access(['A_ADD_SUPPLIER'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $banks = json_decode($request->input('banks'), true);
            $contact_persons = json_decode($request->input('contact_people'), true);
            $businessTypes = json_decode($request->input('businessTypes'), true);
            
            

            $this->validate_request($request);
            $supplier_data_exists = SupplierModel::select('id')
                ->where('name', '=', trim($request->supplier_name))
                ->first();
            if (!empty($supplier_data_exists)) {
                throw new Exception("Supplier already exists", 400);
            }
            // $user_data   = $this->SupplierAddInUser($request);

            DB::beginTransaction();
            $supplier = [
                "slack" => $this->generate_slack("suppliers"),
                "store_id" => $request->logged_user_store_id,
                "supplier_code" => Str::random(6),
                "supplier_id" => $request->supplier_id,
                "name" => Str::title($request->supplier_name),
                "address" => $request->address,
                "city" => $request->city,
                "country" => $request->country,
                "gender" => $request->gender,
                "phone" => $request->phone,
                "email" => $request->email,
                "pincode" => $request->pincode,
                "status" => $request->status,
                "created_by" => $request->logged_user_id,
            ];

            $supplier_id = SupplierModel::create($supplier)->id;


            // add bank details to supplier 


            foreach ($banks as $bank) {
                $bank_Details = [
                    'supplier_id' => $supplier_id,
                    'bank_name' => $bank['bank_name'],
                    'account_title' => $bank['account_title'],
                    'account_number' => $bank['account_number'],
                    'iban_number' => $bank['iban_number'],
                    'branch_code' => $bank['branch_code'],
                ];
                SupplierBankDetails::create($bank_Details);
            }

            foreach($businessTypes as $btype){
                $business_type = [
                    'supplier_id' => $supplier_id,
                    'business_type' => $btype
                ];
                BusinessType::create($business_type);
            }


            // add bank details to supplier end


            // contact person add start 
            foreach ($contact_persons as $person) {
                $contactPerson = [
                    'supplier_id' => $supplier_id,
                    'position' => $person['position'],
                    'name' => $person['name'],
                    'email' => $person['email'],
                    'mobile' => $person['mobile'],
                ];
                ContactPerson::create($contactPerson);
            }

            // contact person add end 

            $password = Str::random(6);
            $hashed_password = Hash::make($password);



            $user = [
                "slack" => $supplier['slack'],
                "user_code" => $supplier['supplier_code'],
                "email" => $request->email,
                "password" => $hashed_password,
                "init_password" => $password,
                "fullname" => $request->supplier_name,
                "phone" => $request->phone,
                "role_id" => 3,
                "store_id" => $request->logged_user_store_id,
                "supplier_id" => $supplier_id,
                "status" => $request->status,
                "created_by" => $request->logged_user_id
            ];

             $user_data   = $this->SupplierAddInUser($request, $user);
            DB::commit();

            return response()->json($this->generate_response(
                array(
                    "message" => "Supplier created successfully",
                    "data" => $supplier['slack'],
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
    private function SupplierAddInUser($request, $user)
    {

        $user_email_exists = UserModel::where('email', $request->email)->first();
        if ($user_email_exists) {
            throw new Exception("Email is already added, try signing in");
        }

        DB::beginTransaction();

        $user_id = UserModel::create($user)->id;
        $user_data['id'] = $user_id;
        $code_start_config = Config::get('constants.unique_code_start.supplier');
        $code_start = (isset($code_start_config)) ? $code_start_config : 100;

        $user_code = [
            "user_code" => "SUP" . ($code_start + $user_id)
        ];
        UserModel::where('id', $user_id)
            ->update($user_code);
        $user_data['user_code'] = $user_code['user_code'];
        $role_api = new RoleAPI();
        $role_api->update_user_roles($request, 3);

        $user_stores_array[] = [
            'user_id' => $user_id,
            'store_id' => $request->logged_user_store_id,
            'created_by' => $request->logged_user_id,
            "created_at" => now(),
            "updated_at" => now()
        ];

        UserStoreModel::insert($user_stores_array);


        DB::commit();

        return $user_data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slack
     * @return \Illuminate\Http\Response
     */
    public function show($slack)
    {
        try {

            if (!check_access(['A_DETAIL_SUPPLIER'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $item = SupplierModel::select('*')
                ->where('slack', $slack)
                ->first();

            $item_data = new SupplierResource($item);

            return response()->json($this->generate_response(
                array(
                    "message" => "Supplier loaded successfully",
                    "data" => $item_data,
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
     * list all the specified resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        try {

            if (!check_access(['A_VIEW_SUPPLIER_LISTING'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $list = new SupplierCollection(SupplierModel::select('*')
                ->orderBy('created_at', 'desc')->paginate());

            return response()->json($this->generate_response(
                array(
                    "message" => "Suppliers loaded successfully",
                    "data" => $list,
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $slack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slack)
    {
        try {

            if (!check_access(['A_EDIT_SUPPLIER'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $banks = json_decode($request->input('banks'), true);
            $contact_persons = json_decode($request->input('contact_people'), true);
            $businessTypes = json_decode($request->input('businessTypes'), true);

            $this->validate_request($request);

            $supplier_data_exists = SupplierModel::select('id')
                ->where([
                    ['slack', '!=', $slack],
                    ['name', '=', trim($request->supplier_name)],
                ])
                ->first();
            if (!empty($supplier_data_exists)) {
                throw new Exception("Supplier already exists", 400);
            }

            DB::beginTransaction();

            $supplier = [
                "supplier_id" => $request->supplier_id,
                "name" => Str::title($request->supplier_name),
                "address" => $request->address,
                "city" => $request->city,
                "country" => $request->country,
                "gender" => $request->gender,
                "phone" => $request->phone,
                "email" => $request->email,
                "pincode" => $request->pincode,
                "status" => $request->status,
                "updated_by" => $request->logged_user_id,
            ];

            // dd($supplier);
            $action_response = SupplierModel::where('slack', $slack)
                ->update($supplier);
                $updatedRecord = SupplierModel::where('slack', $slack)->first();
                

            foreach ($banks as $bank) {
                $bank_details = [
                    'id' => isset($bank['id']) ? $bank['id'] : null,
                    'supplier_id' => $updatedRecord->id,
                    'bank_name' => $bank['bank_name'],
                    'account_title' => $bank['account_title'],
                    'account_number' => $bank['account_number'],
                    'iban_number' => $bank['iban_number'],
                    'branch_code' => $bank['branch_code'],
                ];                

                SupplierBankDetails::updateOrCreate(
                    ['id' => $bank_details['id']], // Search condition
                    $bank_details // Data to update or create
                );
            }

             // contact person add start 
             foreach ($contact_persons as $person) {
                $contactPerson = [
                    'id' => isset($person['id']) ? $person['id'] : null,
                    'supplier_id' => $updatedRecord->id,
                    'position' => $person['position'],
                    'name' => $person['name'],
                    'email' => $person['email'],
                    'mobile' => $person['mobile'],
                ];
                ContactPerson::updateOrCreate(
                    ['id' => $contactPerson['id']],
                    $contactPerson
                );
            }

            // contact person add end 

            BusinessType::where('supplier_id', $updatedRecord->id)->delete();
            foreach($businessTypes as $btype){
                $business_type = [
                    'supplier_id' => $updatedRecord->id,
                    'business_type' => $btype
                ];
                BusinessType::create($business_type);
            }


            DB::commit();

            return response()->json($this->generate_response(
                array(
                    "message" => "Supplier updated successfully",
                    "data" => $slack,
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $slack)
    {
        try {
            if (!check_access(['A_DELETE_SUPPLIER'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $supplier_detail = SupplierModel::select('id')->where('slack', $slack)->first();
            // $user_supplier = UserModel::select('id')->where('supplier_id', $supplier_detail->id)->first();
            if (empty($supplier_detail)) {
                throw new Exception("Invalid supplier provided", 400);
            }
            $supplier_id = $supplier_detail->id;
            // $user_supplier_id = $user_supplier->id;

            DB::beginTransaction();

            SupplierModel::where('id', $supplier_id)->delete();
            // UserModel::where('supplier_id', $supplier_id)->delete();

            DB::commit();

            $forward_link = route('suppliers');

            return response()->json($this->generate_response(
                array(
                    "message" => "Supplier deleted successfully",
                    "data" => $slack,
                    "link" => $forward_link,
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

    public function destroy_supplier_performance(Request $request, $slack)
    {
        try {
            if (!check_access(['A_DELETE_SUPPLIER_PERFORMANCE'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $supplier_detail = SupplierPerformance::select('id')->where('slack', $slack)->first();
            if (empty($supplier_detail)) {
                throw new Exception("Invalid supplier provided", 400);
            }
            $supplier_id = $supplier_detail->id;

            DB::beginTransaction();

            SupplierPerformance::where('id', $supplier_id)->delete();

            DB::commit();

            $forward_link = route('suppliers_performance');

            return response()->json($this->generate_response(
                array(
                    "message" => "Supplier Performance deleted successfully",
                    "data" => $slack,
                    "link" => $forward_link,
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

    public function load_supplier_list(Request $request)
    {
        try {
            $keywords = $request->keywords;

            $supplier_data = SupplierModel::select('slack', DB::raw("CONCAT(supplier_code,' - ',name) as label"))
            ->where(function ($query) use ($keywords) {
                $query->where('name', 'like', $keywords . '%')
                    ->orWhere('supplier_code', 'like', $keywords . '%');
            })
            ->when($request->logged_user_role_id == 2, function ($query) {
                $query->where('supplier_type', 'DEFAULT');
            }, function ($query) {
                $query->skipDefaultSupplier();
            })
            ->active()
            ->get();
        

            return response()->json($this->generate_response(
                array(
                    "message" => "Suppliers loaded successfully",
                    "data" => $supplier_data,
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

    public function validate_request($request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_name' => $this->get_validation_rules("name_label", true),
            'address' => $this->get_validation_rules("text", false),
            'pincode' => $this->get_validation_rules("pincode", false),
            'email' => $this->get_validation_rules("email", false),
            'phone' => $this->get_validation_rules("phone", false),
            'status' => $this->get_validation_rules("status", true),
        ]);
        $validation_status = $validator->fails();
        if ($validation_status) {
            throw new Exception($validator->errors());
        }
    }

    public function submit_supplier_performance(Request $request, $slack = null)
    {

        try {

            if (!check_access(['A_ADD_SUPPLIER_PERFORMANCE'], true)) {
                throw new Exception("Invalid request", 400);
            }


            if ($slack == null) {
                $supplier_performance = [
                    "slack" => $this->generate_slack("supplier_performances"),
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
                $supplier_performance = SupplierPerformance::create($supplier_performance);
                if ($supplier_performance) {
                    return response()->json($this->generate_response(
                        array(
                            "message" => "Supplier Performance Submit successfully",
                            "data" => $supplier_performance,
                            'msg' => 'success',
                        ),
                        'SUCCESS'
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
}
