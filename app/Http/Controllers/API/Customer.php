<?php

namespace App\Http\Controllers\API;

use Exception;
use Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Models\Customer as CustomerModel;
use App\Models\Role as RoleModel;
use App\Models\User as UserModel;
use App\Models\UserStore as UserStoreModel;
use App\Models\Store as StoreModel;
use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Resources\Collections\CustomerCollection;
use App\Http\Controllers\API\Role as RoleApi;

class Customer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $data['action_key'] = 'A_VIEW_CUSTOMER_LISTING';
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
            $order_by_column =  $request->columns[$order_by]['name'];

            $filter_string = $request->search['value'];
            $filter_columns = array_filter(data_get($request->columns, '*.name'));

            $query = CustomerModel::select('customers.*', 'master_status.label as status_label', 'master_status.color as status_color', 'user_created.fullname')
                ->take($limit)
                ->skip($offset)
                ->statusJoin()
                ->createdUser()
                ->skipDefaultCustomer()

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

            $customers = CustomerResource::collection($query);

            $total_count = CustomerModel::select('id')->skipDefaultCustomer()->get()->count();

            $item_array = [];
            foreach ($customers as $key => $customer) {

                $customer = $customer->toArray($request);

                $item_array[$key][] = (!empty($customer['name'])) ? $customer['name'] : '-';
                $item_array[$key][] = (!empty($customer['email'])) ? $customer['email'] : '-';
                $item_array[$key][] = (!empty($customer['phone'])) ? $customer['phone'] : '-';
                $item_array[$key][] = (isset($customer['status']['label'])) ? view('common.status', ['status_data' => ['label' => $customer['status']['label'], "color" => $customer['status']['color']]])->render() : '-';
                $item_array[$key][] = $customer['created_at_label'];
                $item_array[$key][] = $customer['updated_at_label'];
                $item_array[$key][] = (isset($customer['created_by']) && isset($customer['created_by']['fullname'])) ? $customer['created_by']['fullname'] : '-';
                $item_array[$key][] = view('customer.layouts.customer_actions', array('customer' => $customer))->render();
            }

            $response = [
                'draw' => $draw,
                'recordsTotal' => $total_count,
                'recordsFiltered' => $total_count,
                'data' => $item_array
            ];

            return response()->json($response);
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            if (!check_access(['A_ADD_CUSTOMER'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $this->validate_request($request);


            
            //check email already exists
            if ($request->email != '') {
                $customer_email_exists = CustomerModel::where('email', $request->email)->first();
                if ($customer_email_exists) {
                    throw new Exception("Customer email already exists");
                }
            }

            // dd($request->email);


            //check phone already exists
            if ($request->phone != '') {
                $customer_phone_exists = CustomerModel::where('phone', $request->phone)->first();
                if ($customer_phone_exists) {
                    throw new Exception("Customer phone already exists");
                }
            }




            DB::beginTransaction();

            $customer = [
                "slack" => $this->generate_slack("customers"),
                'customer_type' => 'CUSTOM',
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "address" => $request->address,
                "dob" => $request->dob,
                "status" => $request->status,                
                "created_by" => $request->logged_user_id
            ];


            
            $customer_id = CustomerModel::create($customer)->id;
            

            $password = Str::random(6);
            $hashed_password = Hash::make($password);

            $user = [
                "slack" => $customer['slack'],
                "user_code" => Str::random(6),
                "email" => $customer['email'],
                "password" => $hashed_password,
                "init_password" => $password,
                "fullname" => $customer['name'],
                "phone" => $customer['phone'],
                "role_id" => 2,
                "store_id" => $request->logged_user_store_id,
                "status" => $request->status,
                "customer_id" => $customer_id,
                "created_by" => $request->logged_user_id
            ];

            // dd($user);

            $this->customerAddInUser($request, $user);

            DB::commit();

           

            return response()->json($this->generate_response(
                array(
                    "message" => "Customer created successfully", 
                    "data"    => $customer
                ), 'SUCCESS'
            ));
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }


    private function customerAddInUser($request, $user){
        
        
        // dd($user->email);
            $user_email_exists = UserModel::where('email', $user['email'])->first();
            if ($user_email_exists) {
                throw new Exception("Email is already added, try signing in");
            }       
            

        //    dd($user);

            DB::beginTransaction();   
            
            $user_id = UserModel::create($user)->id;
            $user_data['id'] = $user_id; 
            $code_start_config = Config::get('constants.unique_code_start.user');
            $code_start = (isset($code_start_config))?$code_start_config:100;
            
            // dd($user_id);
            $user_code = [
                "user_code" => ($code_start + $user_id)
            ];
            UserModel::where('id', $user_id)
            ->update($user_code);

            $role_api = new RoleAPI();
            $role_api->update_user_roles($request, 2);

            $this->update_user_stores($request,  $user['slack']);

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

            if (!check_access(['A_DETAIL_CUSTOMER'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $item = CustomerModel::select('*')
                ->where('slack', $slack)
                ->first();

            $item_data = new CustomerResource($item);

            return response()->json($this->generate_response(
                array(
                    "message" => "Customer loaded successfully",
                    "data"    => $item_data
                ),
                'SUCCESS'
            ));
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
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

            if (!check_access(['A_VIEW_CUSTOMER_LISTING'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $list = new CustomerCollection(CustomerModel::select('*')
                ->orderBy('created_at', 'desc')->paginate());

            return response()->json($this->generate_response(
                array(
                    "message" => "Customers loaded successfully",
                    "data"    => $list
                ),
                'SUCCESS'
            ));
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slack)
    {
        try {

            if (!check_access(['A_EDIT_CUSTOMER'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $this->validate_request($request);

            //check email already exists
            if ($request->email != '') {
                $customer_email_exists = CustomerModel::where('email', $request->email)->where('slack', '!=', $slack)->first();
                if ($customer_email_exists) {
                    throw new Exception("Customer email already exists");
                }
            }

            //check phone already exists
            if ($request->phone != '') {
                $customer_phone_exists = CustomerModel::where('phone', $request->phone)->where('slack', '!=', $slack)->first();
                if ($customer_phone_exists) {
                    throw new Exception("Customer phone already exists");
                }
            }
            $this->customerUpdateInUser($request, $slack);
            DB::beginTransaction();

            $customer = [
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "address" => $request->address,
                "dob" => $request->dob,
                "status" => $request->status,
                "updated_by" => $request->logged_user_id
            ];

            $data = CustomerModel::where('slack', $slack)
                ->update($customer);

            DB::commit();

            return response()->json($this->generate_response(
                array(
                    "message" => "Customer updated successfully",
                    "data"    => $data
                ),
                'SUCCESS'
            ));
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    public function load_customer_list(Request $request)
    {
        try {
            $keywords = $request->keywords;
            $type = $request->type;
            DB::enableQueryLog();
            $customer_list = CustomerModel::select('slack', 'name', 'email', 'phone')
                ->when($type == 'phone', function ($query) use ($keywords) {
                    return $query->where('phone', 'like', $keywords . '%');
                })
                ->when($type == 'email', function ($query) use ($keywords) {
                    return $query->where('email', 'like', $keywords . '%');
                })
                ->when($type == 'all', function ($query) use ($keywords) {
                    return $query->where('name', 'like', $keywords . '%')
                        ->orWhere('email', 'like', $keywords . '%')
                        ->orWhere('phone', 'like', $keywords . '%');
                })
                ->skipDefaultCustomer()
                ->limit(15)
                ->get();

            return response()->json($this->generate_response(
                array(
                    "message" => "Customers loaded successfully",
                    "data"    => $customer_list
                ),
                'SUCCESS'
            ));
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    public function filter_customers(Request $request)
    {
        try {

            $keyword = $request->keyword;

            $customer_list = CustomerModel::select("*")
                ->where('name', 'like', $keyword . '%')
                ->orWhere('email', 'like', $keyword . '%')
                ->orWhere('phone', 'like', $keyword . '%')
                ->limit(25)
                ->get();

            $customers = CustomerResource::collection($customer_list);

            return response()->json($this->generate_response(
                array(
                    "message" => "Customers filtered successfully",
                    "data" => $customers
                ),
                'SUCCESS'
            ));
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    public function destroy(Request $request, $slack)
    {
        try {
            if (!check_access(['A_DELETE_CUSTOMER'], true)) {
                throw new Exception("Invalid request", 400);
            }

            $customer_detail = CustomerModel::select('id')->where('slack', $slack)->first();
            if (empty($customer_detail)) {
                throw new Exception("Invalid customer provided", 400);
            }
            $customer_id = $customer_detail->id;

            DB::beginTransaction();

            CustomerModel::where('id', $customer_id)->delete();

            DB::commit();

            $forward_link = route('customers');

            return response()->json($this->generate_response(
                array(
                    "message" => "Customer deleted successfully",
                    "data" => $slack,
                    "link" => $forward_link
                ),
                'SUCCESS'
            ));
        } catch (Exception $e) {
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    public function validate_request($request)
    {
        $validator = Validator::make($request->all(), [
            'email'  => 'required_if:phone,""' . '|' . $this->get_validation_rules("email", false),
            'phone'  => 'required_if:email,""' . '|' . $this->get_validation_rules("phone", false),
            'name'   => $this->get_validation_rules("fullname", true),
            'address' => $this->get_validation_rules("text", false),
            'status' => $this->get_validation_rules("status", true),
        ]);
        $validation_status = $validator->fails();
        if ($validation_status) {
            throw new Exception($validator->errors());
        }
    }
    
    public function update_user_stores(Request $request, $user_slack){
        
        if($user_slack == ''){
            return;
        }
        

    //     $selected_stores = $request->logged_user_store_id;

    //     $user_data = UserModel::select('id')->where('slack', '=', $user_slack)->first();
    //     if (empty($user_data)) {
    //         return;
    //     }

    //     $user_stores = UserStoreModel::where('user_id', '=', $user_data->id)
    //         ->pluck('store_id')
    //         ->toArray();
    //     (count($user_stores) > 0) ? sort($user_stores) : $user_stores;

    //     $selected_stores_array = StoreModel::whereIn('slack', $selected_stores)
    //         ->pluck('id')
    //         ->toArray();
    //     (count($selected_stores_array) > 0) ? sort($selected_stores_array) : $selected_stores_array;

    //     if ($user_stores != $selected_stores_array) {

    //         $user_stores_array = [];
    //         foreach ($selected_stores_array as $selected_stores_array_item) {
    //             $user_stores_array[] = [
    //                 'user_id' => $user_data->id,
    //                 'store_id' => $selected_stores_array_item,
    //                 'created_by' => $request->logged_user_id,
    //                 "created_at" => now(),
    //                 "updated_at" => now()
    //             ];
    //         }

    //         UserStoreModel::where('user_id', $user_data->id)->delete();
    //         UserStoreModel::insert($user_stores_array);
    //     }
    // }

    private function customerUpdateInUser($request, $slack)
    {

        DB::beginTransaction();

        $user = [
            "email" => $request->email,
            "fullname" => $request->name,
            "phone" => $request->phone,


            "status" => $request->status,
            "updated_by" => $request->logged_user_id
        ];

        $data = UserModel::where('slack', $slack)
            ->update($user);

        $role_api = new RoleAPI();
        $role_api->update_user_roles($request, 1);



        DB::commit();

        return $data;
    }
}
