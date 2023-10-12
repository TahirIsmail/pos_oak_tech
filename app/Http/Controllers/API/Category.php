<?php

namespace App\Http\Controllers\API;

use Exception;
use Validator;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

use App\Http\Resources\CategoryResource;

use App\Models\Category as CategoryModel;

use App\Http\Resources\Collections\CategoryCollection;
use App\Models\CategoryCompany;
use App\Models\ProductName;
use App\Models\SubCategory;

class Category extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $data['action_key'] = 'A_VIEW_CATEGORY_LISTING';
            if(check_access(array($data['action_key']), true) == false){
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
            
            $query = CategoryModel::select('category.*', 'master_status.label as status_label', 'master_status.color as status_color', 'user_created.fullname')
            ->take($limit)
            ->skip($offset)
            ->statusJoin()
            ->createdUser()

            ->when($order_by_column, function ($query, $order_by_column) use ($order_direction) {
                $query->orderBy($order_by_column, $order_direction);
            }, function ($query) {
                $query->orderBy('created_at', 'desc');
            })

            ->when($filter_string, function ($query, $filter_string) use ($filter_columns) {
                $query->where(function ($query) use ($filter_string, $filter_columns){
                    foreach($filter_columns as $filter_column){
                        $query->orWhere($filter_column, 'like', '%'.$filter_string.'%');
                    }
                });
            })

            ->get();

            $categories = CategoryResource::collection($query);
           
            $total_count = CategoryModel::select("id")->get()->count();

            $item_array = [];
            foreach($categories as $key => $category){
                
                $category = $category->toArray($request);

                $item_array[$key][] = $category['label'];
                $item_array[$key][] = $category['category_code'];
                $item_array[$key][] = ($category['display_on_qr_menu'] == 1)?'Yes':'No';
                $item_array[$key][] = (isset($category['status']['label']))?view('common.status', ['status_data' => ['label' => $category['status']['label'], "color" => $category['status']['color']]])->render():'-';
                $item_array[$key][] = $category['created_at_label'];
                $item_array[$key][] = $category['updated_at_label'];
                $item_array[$key][] = (isset($category['created_by']['fullname']))?$category['created_by']['fullname']:'-';
                $item_array[$key][] = view('category.layouts.category_actions', ['category' => $category])->render();
            }

            $response = [
                'draw' => $draw,
                'recordsTotal' => $total_count,
                'recordsFiltered' => $total_count,
                'data' => $item_array
            ];
            
            return response()->json($response);
        }catch(Exception $e){
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

            if(!check_access(['A_ADD_CATEGORY'], true)){
                throw new Exception("Invalid request", 400);
            }

            

            $this->validate_request($request);
            $subCategories = explode(',', $request->input('sub_categories')[0]);
            
           

            $category_data_exists = CategoryModel::select('id')
            ->where('label', '=', trim($request->category_name))
            ->first();
            if (!empty($category_data_exists)) {
                throw new Exception("Category already exists", 400);
            }

            DB::beginTransaction();
            
            $category = [
                "slack" => $this->generate_slack("category"),
                "store_id" => $request->logged_user_store_id,
                "category_code" => $request->category_code,
                "label" => Str::title($request->category_name),
                "description" => $request->description,
                "display_on_qr_menu" => (isset($request->display_on_qr_menu))?$request->display_on_qr_menu:0,
                "status" => $request->status,
                "created_by" => $request->logged_user_id
            ];
            
            $category_id = CategoryModel::create($category)->id;

           

            $code_start_config = Config::get('constants.unique_code_start.category');
            $code_start = (isset($code_start_config))?$code_start_config:100;
            
            
            // dd($request->category_code);
            // CategoryModel::where('id', $category_id)
            // ->update($request->category_code);
            if($request->input('sub_categories')[0] != null){
                if($category_id){
                    foreach($subCategories as $scategory){
                        $subCategory = [
                            'category_id' => $category_id,
                            'sub_category_name' => $scategory
                        ];
                        SubCategory::create($subCategory);
                    }
                }
            }

            DB::commit();

            return response()->json($this->generate_response(
                array(
                    "message" => "Category created successfully", 
                    "data"    => $category['slack']
                ), 'SUCCESS'
            ));

        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }


    public function submit_category_company(Request $request)
    {
        try {

            if(!check_access(['A_ADD_CATEGORY'], true)){
                throw new Exception("Invalid request", 400);
            }
            // dd($request->all());

            $company_name = [
                "store_id" => $request->logged_user_store_id,
                "category_id" => ($request->sub_category_id == "null") ? $request->category_id : null,
                "sub_category_id" => ($request->sub_category_id != "null") ? $request->sub_category_id : null,
                "category_company_name" => $request->category_company_name,
            ];
            // dd($company_name);
            $company_name_id = CategoryCompany::create($company_name)->id;
          
            
            if($company_name){
                return response()->json($this->generate_response(
                    array(
                        "message" => "Category Company Created Successfully", 
                        "data"    => $company_name_id,
                    ), 'SUCCESS'
                ));
            }
            else{
                return response()->json($this->generate_response(
                    array(
                        "message" => "Some Error occurred while.", 
                        "data"    => '',
                    ), 'FAILED'
                ));
            }


        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }


    public function submit_product_name(Request $request)
    {
        try {

            if(!check_access(['A_ADD_CATEGORY'], true)){
                throw new Exception("Invalid request", 400);
            }
            // dd($request->all());

            $productName = [
                "store_id" => $request->logged_user_store_id,
                "category_id" => ($request->sub_category_id == "null") ? $request->category_id : null,
                "sub_category_id" => ($request->sub_category_id != "null") ? $request->sub_category_id : null,
                "product_name" => $request->category_product_name,
            ];
           
            $productName_id = ProductName::create($productName)->id;
          
            
            if($productName_id){
                return response()->json($this->generate_response(
                    array(
                        "message" => "Category Company Created Successfully", 
                        "data"    => $productName_id,
                    ), 'SUCCESS'
                ));
            }
            else{
                return response()->json($this->generate_response(
                    array(
                        "message" => "Some Error occurred while.", 
                        "data"    => '',
                    ), 'FAILED'
                ));
            }


        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }


    public function fetch_sub_categories(Request $request){
        
        $data['companies'] = [];
        $subCategories = SubCategory::where('category_id', $request->category_id)->get();
        if(count($subCategories) == 0){
            $companies = CategoryCompany::where('category_id', $request->category_id)->get();
            $data['companies'] = $companies;
        }
        $data['subCategories'] = $subCategories;

        

        if($subCategories){
            return response()->json($this->generate_response(
                array(
                    "message" => "Sub Categories fetched successfully", 
                    "data"    => $data,
                ), 'SUCCESS'
            ));
        }
    }

    public function fetch_companies(Request $request){
        $data['companies'] = [];
        $companies = CategoryCompany::where('sub_category_id', $request->sub_category_id)->get();

        $data['companies'] = $companies;
        
        if($companies){
            return response()->json($this->generate_response(
                array(
                    "message" => "Sub Categories fetched successfully", 
                    "data"    => $data,
                ), 'SUCCESS'
            ));
        }
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

            if(!check_access(['A_DETAIL_CATEGORY'], true)){
                throw new Exception("Invalid request", 400);
            }

            $item = CategoryModel::select('*')
            ->where('slack', $slack)
            ->first();

            $item_data = new CategoryResource($item);

            return response()->json($this->generate_response(
                array(
                    "message" => "Category loaded successfully", 
                    "data"    => $item_data
                ), 'SUCCESS'
            ));

        }catch(Exception $e){
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

            if(!check_access(['A_VIEW_CATEGORY_LISTING'], true)){
                throw new Exception("Invalid request", 400);
            }

            $list = new CategoryCollection(CategoryModel::select('*')
            ->orderBy('created_at', 'desc')->paginate());

            return response()->json($this->generate_response(
                array(
                    "message" => "Categories loaded successfully", 
                    "data"    => $list
                ), 'SUCCESS'
            ));

        }catch(Exception $e){
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
     * @param  int  $slack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slack)
    {
        try {

            if(!check_access(['A_EDIT_CATEGORY'], true)){
                throw new Exception("Invalid request", 400);
            }
            $subCategories = explode(',', $request->input('sub_categories')[0]);
            $checkCategoryCode = CategoryModel::where('slack', $slack)->get()->toArray();
            if($checkCategoryCode[0]['category_code'] == $request->category_name){

                $this->validate_request_update($request);

            }

            $category_data_exists = CategoryModel::select('id')
            ->where([
                ['slack', '!=', $slack],
                ['label', '=', trim($request->category_name)],
            ])
            ->first();
            // dd($category_data_exists);

            if (!empty($category_data_exists)) {
                throw new Exception("Category already exists", 400);
            }

            DB::beginTransaction();

            $category = [
                "label" => Str::title($request->category_name),
                "category_code" => $request->category_code,
                "description" => $request->description,               
                "display_on_qr_menu" => (isset($request->display_on_qr_menu))?$request->display_on_qr_menu:0,
                "status" => $request->status,
                'updated_by' => $request->logged_user_id
            ];

            $action_response = CategoryModel::where('slack', $slack)
            ->update($category);

           

            if($request->input('sub_categories')[0] != null){
                if($action_response){
                    foreach($subCategories as $scategory){
                        $subCategory = [
                            'category_id' => $action_response,
                            'sub_category_name' => $scategory
                        ];
                        SubCategory::create($subCategory);
                    }
                }
            }

            DB::commit();

            return response()->json($this->generate_response(
                array(
                    "message" => "Category updated successfully", 
                    "data"    => $slack
                ), 'SUCCESS'
            ));

        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
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
        try{
            if(!check_access(['A_DELETE_CATEGORY'], true)){
                throw new Exception("Invalid request", 400);
            }

            $category_detail = CategoryModel::select('id')->where('slack', $slack)->first();
            if (empty($category_detail)) {
                throw new Exception("Invalid category provided", 400);
            }
            $category_id = $category_detail->id;
            
            DB::beginTransaction();

            CategoryModel::where('id', $category_id)->delete();

            DB::commit();

            $forward_link = route('categories');

            return response()->json($this->generate_response(
                array(
                    "message" => "Category deleted successfully", 
                    "data" => $slack,
                    "link" => $forward_link
                ), 'SUCCESS'
            ));

        }catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
    }

    public function delete_subcategory(Request $request){
        try {

            if(!check_access(['A_ADD_CATEGORY'], true)){
                throw new Exception("Invalid request", 400);
            }

            $id = $request->input('id');
            $del = SubCategory::find($id)->delete();

            if($del){
                return response()->json($this->generate_response(
                    array(
                        "message" => 'Sub Category Deleted Successfully',
                        "status_code" => '200',
                        'id' => $id
                    )
                ));
            }
            else{
                return response()->json($this->generate_response(
                    array(
                        "message" => 'Some Error Occured',
                        "status_code" => '201',
                        
                    )
                ));
            }
    
        
       

        }
        catch(Exception $e){
            return response()->json($this->generate_response(
                array(
                    "message" => $e->getMessage(),
                    "status_code" => $e->getCode()
                )
            ));
        }
        
    }

    public function update_subcategory(Request $request)
{
    $id = $request->input('id');
    $newName = $request->input('sub_category_name');

    // dd($request->all());

    // Find the subcategory by ID and update the name
    $subcategory = SubCategory::findOrFail($id);
    $subcategory->sub_category_name = $newName;
    $subcategory->save();
    return response()->json($this->generate_response(
        array(
            "message" => 'Subcategory updated successfully',
            "status_code" => 200
        )
    ));

   
}


    public function validate_request($request)
    {
        $validator = Validator::make($request->all(), [
            'category_code' => 'required|unique:category,category_code',
            'category_name' => $this->get_validation_rules("name_label", true),
            'status' => $this->get_validation_rules("status", true),
        ]);
        $validation_status = $validator->fails();
        if($validation_status){
            throw new Exception($validator->errors());
        }
    }
    public function validate_request_update($request)
    {
        $validator = Validator::make($request->all(), [
            
            'category_name' => $this->get_validation_rules("name_label", true),
            'status' => $this->get_validation_rules("status", true),
        ]);
        $validation_status = $validator->fails();
        if($validation_status){
            throw new Exception($validator->errors());
        }
    }
}
