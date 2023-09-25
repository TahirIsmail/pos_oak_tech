<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaints as ComplaintModel;
use App\Models\User as UserModel;
use App\Models\Customer as CustomerModel;
use Pusher\Pusher;

use function PHPUnit\Framework\isNull;

class ComplaintsController extends Controller
{
    //
    public function index(Request $request)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_COMPLAINTS';
        check_access(array($data['menu_key'], $data['sub_menu_key']));

        return view('complaints.customer_complaints', $data);
    }

    public function add_complaints(Request $request,$slack = null)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_COMPLAINTS';
        $data['action_key'] = ($slack == null) ? 'A_ADD_CUSTOMER_COMPLAINT' : 'A_EDIT_CUSTOMER_COMPLAINT';
        check_access(array($data['action_key']));


        $data['complaints_data'] = [];

       
        
        if ($slack) {

            $complaint = ComplaintModel::with('customer', 'order')->where('slack', '=', $slack)->first();
            if (empty($complaint)) {
                abort(404);
            }

            $data['complaints_data'] = $complaint;
        }
        
        if($request->logged_user_role_id == 2){
            $customers = CustomerModel::has('orders')->with('orders')->where('id', $request->logged_user_customer_id)->get();
        }
        else{
            $customers = CustomerModel::has('orders')->with('orders')->get();
        }

        // dd($customers);
        $data['customers_list'] = $customers;

        return view('complaints.add_customer_complaint', $data);
    }

    public function view_complaints(Request $request, $slack = null)
    {
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_COMPLAINTS';
        $data['action_key'] = 'A_VIEW_CUSTOMER_COMPLAINT';
        check_access(array($data['action_key']));
        $users = UserModel::withCount(['assignComplaints' => function ($query) {
            $query->where('complaint_status', '!=', 'Completed Complaint');
        }])->get();
        
        $complaint = ComplaintModel::with('customer', 'order', 'product', 'user')->where('slack', '=', $slack)->first();
        $data['labTechnician'] = $users;
        $data['complaint'] = $complaint;
       
        $data['assign_access_key'] = 'A_ASSIGN_CUSTOMER_COMPLAINT_LABTECHNICIAN';
        if (check_access(array($data['assign_access_key']), true) == false) {
           
        }else{
            $data['assign_access'] = true;
        }


        $data['requirement_request_key'] = 'A_REQUIREMENT_REQUEST_CUSTOMER_COMPLAINT_LABTECHNICIAN';
        if (check_access(array($data['requirement_request_key']), true) == false) {
           
        }else{
            $data['requirement_request_access'] = true;
        }


        $data['Customer_complaint_make_invoice_key'] = 'A_CUSTOMER_COMPLAINT_MAKE_INVOICE';
        if (check_access(array($data['Customer_complaint_make_invoice_key']), true) == false) {
           
        }else{
            $data['Customer_complaint_make_invoice'] = true;
        }




        $data['delete_access_key'] = 'A_DELETE_CUSTOMER_COMPLAINT';
        if (check_access(array($data['delete_access_key']), true) == false) {
           
        }else{
            $data['delete_access'] = true;
        }



        
        return view('complaints.view_customer_complaint', $data);
    }
}
