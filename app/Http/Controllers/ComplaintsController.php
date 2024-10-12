<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Complaints;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\CompaintAssignToLabEngg;
use App\Models\Complaints as ComplaintModel;
use App\Models\Customer as CustomerModel;
use App\Models\OutSourceComplaint;
use App\Models\RequestToStore;
use App\Models\Role;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\User as UserModel;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;

class ComplaintsController extends Controller
{

    public function index(Request $request)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_COMPLAINTS';
        check_access(array($data['menu_key'], $data['sub_menu_key']));
        return view('complaints.customer_complaints', $data);
    }


    public function customer_side_complaints(Request $request){
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_SIDE_COMPLAINTS';
        check_access(array($data['menu_key'], $data['sub_menu_key']));
        return view('complaints.customer_side_complaints', $data);
    }

    public function complaints(Request $request)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_COMPLAINTS';
        check_access(array($data['menu_key'], $data['sub_menu_key']));

        return view('complaints.complaints', $data);
    }

    public function lab_complaints(Request $request)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_LAB_COMPLAINTS';
        check_access(array($data['menu_key'], $data['sub_menu_key']));

        return view('complaints.lab_complaints', $data);
    }

    public function out_source_complaints(Request $request){
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_OUTSOURCE_COMPLAINTS';
        check_access(array($data['menu_key'], $data['sub_menu_key']));

        return view('complaints.out_source_complaints', $data);
    }

    public function product_request(Request $request)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_PRODUCT_REQUEST';
        check_access(array($data['menu_key'], $data['sub_menu_key']));

        return view('complaints.product_request', $data);
    }

    public function add_complaints(Request $request, $slack = null)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_COMPLAINTS';
        $data['action_key'] = ($slack == null) ? 'A_ADD_CUSTOMER_COMPLAINT' : 'A_EDIT_CUSTOMER_COMPLAINT';
        check_access(array($data['action_key']));

        $categories = Category::pluck('label')->unique()->toArray();
        $subcategories = SubCategory::pluck('sub_category_name')->unique()->toArray();
        $childCategories = ChildCategory::pluck('child_category')->unique()->toArray();

        $allValues = array_merge($categories, $subcategories, $childCategories);
        $allValues = array_filter($allValues);
        $allValues = array_values($allValues);

        $data['equipment_types'] = $allValues;

        $data['complaints_data'] = [];
        $lab_engg_role = Role::where('label', 'Lab Engineer')->first();
        // dd($lab_engg_role->id);
        $users = UserModel::withCount(['assignComplaints' => function ($query) {
            $query->where('complaint_status', '!=', 'Completed Complaint');
        }])->whereNotIn('role_id', [1, 2, 3])->where('customer_child_id', null)->where('role_id', $lab_engg_role->id)->get();
        $data['lab_engineers'] = $users;

        if ($request->customer_id || $request->customer_child_id) {
            if ($request->customer_id) {
                $data['customer_slack'] = $request->logged_user_slack;
            }
            if ($request->customer_child_id) {
                $child_customer = CustomerModel::where('id', $request->customer_child_id)->first();
                $customer = CustomerModel::where('id', $child_customer->parent_id)->first();

                $data['customer_slack'] = $customer->slack;

            }
            $data['is_customer'] = true;

        } else {
            $data['is_customer'] = false;
            $data['customer_slack'] = '';

        }


        $data['assign_type'] = $request->input('type');

        if ($slack) {

            $complaint = ComplaintModel::with('customer', 'user', 'order', 'field_user')->where('slack', '=', $slack)->first();
            if (empty($complaint)) {
                abort(404);
            }

            $data['complaints_data'] = $complaint;
            $data['assign_type'] = $complaint['assign_type'];
        }
        
        

        if ($request->logged_user_role_id == 2) {
            $customers = User::where('id', $request->logged_user_id)->get();
        } else {
            $customers = User::where('role_id', 2)->get();
        }

        $data['customers_list'] = $customers;
       
        

        return view('complaints.add_customer_complaint', $data);

    }


    public function add_customer_side_complaints(Request $request, $slack = null)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_SIDE_COMPLAINTS';

        $categories = Category::pluck('label')->unique()->toArray();
        $subcategories = SubCategory::pluck('sub_category_name')->unique()->toArray();
        $childCategories = ChildCategory::pluck('child_category')->unique()->toArray();

        $allValues = array_merge($categories, $subcategories, $childCategories);
        $allValues = array_filter($allValues);
        $allValues = array_values($allValues);

        $data['equipment_types'] = $allValues;

        $data['complaints_data'] = [];
        $lab_engg_role = Role::where('label', 'Lab Engineer')->first();
    
        $users = UserModel::withCount(['assignComplaints' => function ($query) {
            $query->where('complaint_status', '!=', 'Completed Complaint');
        }])->whereNotIn('role_id', [1, 2, 3])->where('customer_child_id', null)->where('role_id', $lab_engg_role->id)->get();
        $data['lab_engineers'] = $users;

        if ($request->customer_id || $request->customer_child_id) {
            if ($request->customer_id) {
                $data['customer_slack'] = $request->logged_user_slack;
            }
            if ($request->customer_child_id) {
                $child_customer = CustomerModel::where('id', $request->customer_child_id)->first();
                $customer = CustomerModel::where('id', $child_customer->parent_id)->first();

                $data['customer_slack'] = $customer->slack;

            }
            $data['is_customer'] = true;

        } else {
            $data['is_customer'] = false;
            $data['customer_slack'] = '';

        }


        $data['assign_type'] = $request->input('type');

        if ($slack) {

            $complaint = ComplaintModel::with('customer', 'user', 'order', 'field_user')->where('slack', '=', $slack)->first();
            if (empty($complaint)) {
                abort(404);
            }

            $data['complaints_data'] = $complaint;
            $data['assign_type'] = $complaint['assign_type'];
        }
        
        

        if ($request->logged_user_role_id == 2) {
            $customers = User::where('id', $request->logged_user_id)->get();
        } else {
            $customers = User::where('role_id', 2)->get();
        }

        $data['customers_list'] = $customers;
       
        

        return view('complaints.add_customer_side_complaint', $data);

    }

    public function view_complaints(Request $request, $slack = null)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_COMPLAINTS';
        $data['action_key'] = 'A_VIEW_CUSTOMER_COMPLAINT';
        check_access(array($data['action_key']));
        // $users = UserModel::with('role')->withCount(['assignComplaints' => function ($query) {
        //     $query->where('complaint_status', '!=', 'Completed Complaint');
        // }])->whereNotIn('role_id', [1, 2, 3])->where('customer_child_id', null)->get();
        $users = UserModel::with('role')
        ->withCount(['assignComplaints' => function ($query) {
            $query->where('complaint_status', '!=', 'Completed Complaint');
        }])
        ->whereHas('role', function ($query) {
            $query->where('label', 'Lab Engineer');
        })
        ->where('customer_child_id', null)
        ->get();
        $data['labTechnician'] = $users;

        // dd($users);

        $OutSource_Vendors = Role::where('label', 'Out Source Vendor')->first();
        
        if($OutSource_Vendors){
            $out_source_vendors = User::where('role_id', $OutSource_Vendors->id)->get();    
            $data['out_source_vendors'] = $out_source_vendors;
        }
        else{
            $data['out_source_vendors'] = [];
        }

        $complaint = ComplaintModel::with('customer', 'order', 'product', 'user', 'field_user', 'complaint_assign_to_lab_enggs.users', 'complaint_assign_to_lab_enggs.part_requests.engineer', 'complaint_assign_to_field_enggs', 'part_requests.engineer', 'part_requests.request_to_store',  'complaint_assign_to_lab_enggs.part_requests.request_to_store.store_assign_products_on_reqeusts', 'out_source_vendor.vendor')->where('slack', '=', $slack)->first();
        $data['complaint'] = $complaint;


        $lab_tech = ($request->logged_user_id == $complaint->assign_to_lab_staff_id) ? true : false;
        $data['is_lab_tech'] = $lab_tech;
        $categories = Category::pluck('label')->unique()->toArray();
        $subcategories = SubCategory::pluck('sub_category_name')->unique()->toArray();
        $childCategories = ChildCategory::pluck('child_category')->unique()->toArray();

        $allValues = array_merge($categories, $subcategories, $childCategories);
        $allValues = array_filter($allValues);
        $allValues = array_values($allValues);
        $data['out_source_items'] = $allValues;

        if ($request->customer_id || $request->customer_child_id) {
            $data['is_customer'] = true;
        } else {
            $data['is_customer'] = false;

        }

        $data['assign_access_key'] = 'A_ASSIGN_CUSTOMER_COMPLAINT_LABTECHNICIAN';
        if (check_access(array($data['assign_access_key']), true) == false) {

        } else {
            $data['assign_access'] = true;
        }

        $data['requirement_request_key'] = 'A_REQUIREMENT_REQUEST_LABTECHNICIAN';
        if (check_access(array($data['requirement_request_key']), true) == false) {

        } else {
            $data['requirement_request_access'] = true;
        }

        $data['Customer_complaint_make_invoice_key'] = 'A_CUSTOMER_COMPLAINT_MAKE_INVOICE';
        if (check_access(array($data['Customer_complaint_make_invoice_key']), true) == false) {

        } else {
            $data['Customer_complaint_make_invoice'] = true;
        }

        $data['delete_access_key'] = 'A_DELETE_CUSTOMER_COMPLAINT';
        if (check_access(array($data['delete_access_key']), true) == false) {

        } else {
            $data['delete_access'] = true;
        }

        $reAssignComplaints = ComplaintModel::select('slack', 'ticket')
        ->where('picked_for_workshop', 'Yes')
        ->where('slack', '!=', $slack)
        ->get();

        $data['re_assign_complaints'] = $reAssignComplaints;

        return view('complaints.view_customer_complaint', $data);
    }

    public function view_request_to_store(Request $request, $slack = null)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_PRODUCT_REQUEST';
        $data['action_key'] = 'VIEW_PRODUCT_REQUEST';
        check_access(array($data['action_key']));
        try {

            $categories = Category::pluck('label')->unique()->toArray();
            $subcategories = SubCategory::pluck('sub_category_name')->unique()->toArray();
            $childCategories = ChildCategory::pluck('child_category')->unique()->toArray();
            $allValues = array_merge($categories, $subcategories, $childCategories);
            $allValues = array_filter($allValues);
            $allValues = array_values($allValues);
    
            $data['out_source_items'] = $allValues;

            $id = Crypt::decryptString($slack);
            $requestToStore = RequestToStore::with('user', 'complaint', 'part_request')->findOrFail($id);
          
            $complaint = ComplaintModel::with('customer', 'order', 'product', 'user', 'field_user', 'complaint_assign_to_lab_enggs', 'complaint_assign_to_field_enggs', 'part_requests.engineer')->where('slack', '=', $requestToStore['complaint']['slack'])->first();
            $data['complaint'] = $complaint;
            $data['requestToStore'] = $requestToStore;
            
            return view('complaints.view_request_to_store', $data);
        } catch (DecryptException $e) {
            // Handle the error, maybe redirect back with an error message
            return redirect()->back()->withErrors(['msg' => 'Invalid request.']);
        }
    }


    public function view_out_source_complaint(Request $request, $id = null)
    {
        
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_OUTSOURCE_COMPLAINTS';
        $data['action_key'] = 'VIEW_OUT_SOURCE_COMPLAINTS';

       
        
        check_access(array($data['action_key']));
        try {
            
            $outsourceComplaint = OutSourceComplaint::with('complaint.customer', 'complaint.complaint_assign_to_lab_enggs', 'complaint.out_source_vendor', 'lab_complaint')->where('id', $id)->first();
            // dd($outsourceComplaint['complaint']);
            // $complaint = ComplaintModel::with('customer', 'order', 'product', 'user', 'field_user', 'complaint_assign_to_lab_enggs', 'complaint_assign_to_field_enggs', 'part_requests.engineer', 'out_source_vendor')->where('id', '=', $outsourceComplaint->complaint_id)->first();
            $data['complaint'] = $outsourceComplaint;

            return view('complaints.view_out_source_complaint', $data);
        } catch (DecryptException $e) {
            // Handle the error, maybe redirect back with an error message
            return redirect()->back()->withErrors(['msg' => 'Invalid request.']);
        }
    }

    public function open_complaint(Request $request, $slack = null)
    {        
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_COMPLAINTS';
        $data['action_key'] = 'VIEW_COMPLAINT_DATA';
        check_access(array($data['action_key']));
        $users = UserModel::withCount(['assignComplaints' => function ($query) {
            $query->where('complaint_status', '!=', 'Completed Complaint');
        }])->whereNotIn('role_id', [1, 2, 3])->where('customer_child_id', null)->get();
        $data['labTechnician'] = $users;
        $complaint = ComplaintModel::with('customer', 'order', 'product', 'user')->where('slack', '=', $slack)->first();
        $data['complaint'] = $complaint;

        $user_data = User::with(['part_requests' => function ($query) use ($complaint) {
            $query->where('complaint_id', $complaint->id);
        }])
        ->where('id', $request->logged_user_id)
        ->whereHas('part_requests', function ($query) use ($complaint) {
            $query->where('complaint_id', $complaint->id);
        })
        ->first();
        $data['user_data'] = $user_data;

        $lab_tech = ($request->logged_user_id == $complaint->assign_to_field_staff_id) ? true : false;

        $data['is_lab_tech'] = $lab_tech;
        $categories = Category::pluck('label')->unique()->toArray();
        $subcategories = SubCategory::pluck('sub_category_name')->unique()->toArray();
        $childCategories = ChildCategory::pluck('child_category')->unique()->toArray();

        $allValues = array_merge($categories, $subcategories, $childCategories);
        $allValues = array_filter($allValues);
        $allValues = array_values($allValues);

        $data['out_source_items'] = $allValues;

        if ($request->customer_id || $request->customer_child_id) {
            $data['is_customer'] = true;
        } else {
            $data['is_customer'] = false;
        }



        $data['Customer_complaint_make_invoice_key'] = 'A_CUSTOMER_COMPLAINT_MAKE_INVOICE';
        if (check_access(array($data['Customer_complaint_make_invoice_key']), true) == false) {

        } else {
            $data['Customer_complaint_make_invoice'] = true;
        }

        // dd($data);

        return view('complaints.view_complaint', $data);
    }

    public function open_lab_complaint(Request $request, $slack = null)
    {
      
        $id = decrypt($slack);
        
        

        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_LAB_COMPLAINTS';
        $data['action_key'] = 'VIEW_LAB_COMPLAINTS';
        check_access(array($data['action_key']));



        $compaint_assign_to_lab_enggs = CompaintAssignToLabEngg::with('complaint')->where('id', $id)->get();

        // dd($compaint_assign_to_lab_enggs[0]['complaint']['slack']);

        // dd($compaint_assign_to_lab_enggs);


        $users = UserModel::withCount(['assignComplaints' => function ($query) {
            $query->where('complaint_status', '!=', 'Completed Complaint');
        }])->whereNotIn('role_id', [1, 2, 3])->where('customer_child_id', null)->get();
        $data['labTechnician'] = $users;
        $complaint = ComplaintModel::with([
            'customer',
            'order',
            'product',
            'user',
            'complaint_assign_to_lab_enggs' => function($query) use ($id) {
                $query->where('id', $id);
            }
        ])->where('slack', $compaint_assign_to_lab_enggs[0]['complaint']['slack'])->first();

        // dd($complaint['complaint_assign_to_lab_enggs'][0]['id']);

    
        $data['complaint'] = $complaint;

        $user_data = User::with(['part_requests' => function ($query) use ($complaint) {
            $query->where('complaint_id', $complaint->id);
            $query->where('assign_complaint_id', $complaint['complaint_assign_to_lab_enggs'][0]['id']);
        }])

        ->where('id', $request->logged_user_id)
        ->whereHas('part_requests', function ($query) use ($complaint) {
            $query->where('complaint_id', $complaint->id);
        })
        ->first();

        $data['user_data'] = $user_data;

        
        $lab_tech = ($request->logged_user_id == $complaint->assign_to_lab_staff_id) ? true : false;
        $data['is_lab_tech'] = $lab_tech;
        $categories = Category::pluck('label')->unique()->toArray();
        $subcategories = SubCategory::pluck('sub_category_name')->unique()->toArray();
        $childCategories = ChildCategory::pluck('child_category')->unique()->toArray();

        $allValues = array_merge($categories, $subcategories, $childCategories);
        $allValues = array_filter($allValues);
        $allValues = array_values($allValues);

        $data['out_source_items'] = $allValues;
        // dd($data['out_source_items']);

        if ($request->customer_id || $request->customer_child_id) {
            $data['is_customer'] = true;
        } else {
            $data['is_customer'] = false;
        }

        $data['assign_access_key'] = 'A_ASSIGN_CUSTOMER_COMPLAINT_LABTECHNICIAN';
        if (check_access(array($data['assign_access_key']), true) == false) {

        } else {
            $data['assign_access'] = true;
        }

        $data['requirement_request_key'] = 'A_REQUIREMENT_REQUEST_LABTECHNICIAN';
        if (check_access(array($data['requirement_request_key']), true) == false) {

        } else {
            $data['requirement_request_access'] = true;
        }

        $data['Customer_complaint_make_invoice_key'] = 'A_CUSTOMER_COMPLAINT_MAKE_INVOICE';
        if (check_access(array($data['Customer_complaint_make_invoice_key']), true) == false) {

        } else {
            $data['Customer_complaint_make_invoice'] = true;
        }

        $data['delete_access_key'] = 'A_DELETE_CUSTOMER_COMPLAINT';
        if (check_access(array($data['delete_access_key']), true) == false) {

        } else {
            $data['delete_access'] = true;
        }
       
        // dd($data);
        return view('complaints.view_lab_complaint', $data);
    }

    public function print_invoice(Request $request, $slack, $type = 'INLINE', $full_path = false)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_COMPLAINTS';
        $data['action_key'] = 'A_PRINT_CUSTOMER_COMPLAINT_INVOICE';
        check_access(array($data['action_key']));

        $complaint_invoice = ComplaintModel::with('storeData', 'linkToProduct', 'complaintCharges', 'transactions')->where('slack', '=', $slack)->first();
       

        if (empty($complaint_invoice)) {
            abort(404);
        }

        $print_logo_path = config("app.invoice_print_logo");

        $print_data = view('invoice.invoice.complaint_invoice_print', ['data' => json_encode($complaint_invoice), 'logo_path' => $print_logo_path])->render();

        $mpdf_config = [
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_left' => 7,
            'margin_right' => 7,
            'margin_top' => 7,
            'margin_bottom' => 7,
            'tempDir' => storage_path() . "/pdf_temp",
        ];

        $cache_params = '?=' . uniqid();
        $stylesheet = File::get(public_path('css/invoice_print_invoice.css'));
        $mpdf = new Mpdf($mpdf_config);
        $mpdf->SetDisplayMode('real');
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->SetHTMLFooter('<div class="footer">Page: {PAGENO}/{nb}</div>');
        $mpdf->WriteHTML($print_data);
        header('Content-Type: application/pdf');

        $filename = 'invoice_' . $complaint_invoice['invoice_number'] . '.pdf';

        Storage::disk('invoice')->delete(
            [
                $filename,
            ]
        );

        if ($type == 'INLINE') {
            $mpdf->Output($filename . $cache_params, \Mpdf\Output\Destination::INLINE);
        } else {
            $view_path = Config::get('constants.upload.invoice.view_path');
            $upload_dir = Storage::disk('invoice')->getAdapter()->getPathPrefix();

            $mpdf->Output($upload_dir . $filename, \Mpdf\Output\Destination::FILE);

            $download_link = ($full_path == false) ? $view_path . $filename . $cache_params : $upload_dir . $filename;
            return $download_link;
        }
    }
}
