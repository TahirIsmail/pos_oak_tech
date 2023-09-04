<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaints as ComplaintModel;
use App\Models\User as UserModel;
use App\Models\Customer as CustomerModel;
use function PHPUnit\Framework\isNull;

class ComplaintsController extends Controller
{
    //
    public function index(Request $request){
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_COMPLAINTS';
        check_access(array($data['menu_key'],$data['sub_menu_key']));
        
        return view('complaints.customer_complaints', $data);
    }

    public function add_complaints($slack = null){
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_COMPLAINTS';
        $data['action_key'] = ($slack == null)?'A_ADD_CUSTOMER_COMPLAINT':'A_EDIT_CUSTOMER_COMPLAINT';
        check_access(array($data['action_key']));

       
        $data['complaints_data'] = null;
        $data['selectedComplaintId'] = '';
        
        if(!is_null($slack)){
            
            $complaint = ComplaintModel::with('assignedTo','complaintBy')->where('slack', '=', $slack)->first();
            if (empty($complaint)) {
                abort(404);
            }
            $data['selectedComplaintId'] = $complaint->id;
            $data['complaints_data'] = $complaint;
            
        }
        
        $users = UserModel::all();
        $customers = CustomerModel::all();
        $data['customers_list'] = $customers;
        $data['users_list'] = $users;

       
        
        return view('complaints.add_customer_complaint', $data);
    }
}
