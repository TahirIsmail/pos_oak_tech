<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterStatus;
use App\Models\Role as RoleModel;
use App\Models\User as UserModel;
use App\Models\Store as StoreModel;
use App\Models\UserStore as UserStoreModel;
use App\Models\Leave;

use App\Http\Resources\UserResource;
use App\Http\Resources\StoreResource;
use App\Models\LeaveType;


class LeaveTypeController extends Controller
{
    // leave type && apply leaves and approve leaves of staff/user


    public function leave_type(){
        //check access
        $data['menu_key'] = 'MM_HR';
        $data['sub_menu_key'] = 'SM_STAFF_LEAVE_TYPE';
        check_access(array($data['menu_key'],$data['sub_menu_key']));

        $leave_types = LeaveType::orderBy('id', 'desc')->get();
        // dd($leave_type);
        $data['leave_types'] = $leave_types;
        
        return view('leaveType.leave_types', $data);
    }

    public function leaveType_store($slack = null){
        $data['menu_key'] = 'MM_HR';
        $data['sub_menu_key'] = 'SM_STAFF_LEAVE_TYPE';
        $data['action_key'] = ($slack == null)?'A_ADD_LEAVE_TYPE':'A_EDIT_LEAVE_TYPE';
        check_access(array($data['action_key']));

        $data['statuses'] = MasterStatus::select('value', 'label')->filterByKey('LEAVE_TYPE')->active()->sortValueAsc()->get();
        $data['leave_type_data'] = null;
        if(isset($slack)){   
            
            $leave_type = LeaveType::where('slack', '=', $slack)->first();
            if (empty($leave_type)) {
                abort(404);
            }
           
            $data['leave_type_data'] = $leave_type;
          
        }
        
        
        return view('leaveType.add_leave_type', $data);
    }

    public function view_leave_type($slack = null){
        $data['menu_key'] = 'MM_HR';
        $data['sub_menu_key'] = 'SM_STAFF_LEAVE_TYPE';
        $data['action_key'] = 'A_VIEW_LEAVE_TYPE';
        check_access(array($data['action_key']));
        $data['delete_access'] = check_access(['A_DELETE_LEAVE_TYPE'], true);
        $leave_types = LeaveType::where('slack', $slack)->first();
        $data['leave_type'] = $leave_types;
        return view('leaveType.view_leave_type', $data);

    }


    public function staff_leaves_listing(){
       $data['menu_key'] = 'MM_HR';
       $data['sub_menu_key'] = 'SM_STAFF_APPLY_LEAVE';
       check_access(array($data['menu_key'],$data['sub_menu_key']));
       return view('leaves.apply_leave_listing', $data);
    }



    public function add_staff_leave(){

        $data['menu_key'] = 'MM_HR';
        $data['sub_menu_key'] = 'SM_STAFF_APPLY_LEAVE';
        $data['action_key'] = 'A_ADD_LEAVES';
        check_access(array($data['action_key']));
        $users = UserModel::orderBy('id', 'desc')->get();
        $leave_types = LeaveType::orderBy('id', 'desc')->get();
        $data['staff_leave'] = null;
        $data['users'] = $users;
        $data['leave_types'] = $leave_types;

        return view('leaves.apply_staff_leave', $data);
        
    }

    public function edit_staff_leave($slack){
        $data['menu_key'] = 'MM_HR';
        $data['sub_menu_key'] = 'SM_STAFF_APPLY_LEAVE';
        $data['action_key'] = 'A_EDIT_LEAVES';
        check_access(array($data['action_key']));

        $staff_leave = Leave::with('staff', 'lineManager', 'leaveType')->where('slack', $slack)->first();
        $leave_types = LeaveType::orderBy('id', 'desc')->get();
        $users = UserModel::orderBy('id', 'desc')->get();
        $data['users'] = $users;
        $data['staff_leave'] = $staff_leave;
        $data['leave_types'] = $leave_types;
        return view('leaves.edit_staff_leave', $data);

    }


    public function view_staff_leave($slack){
        $data['menu_key'] = 'MM_HR';
        $data['sub_menu_key'] = 'SM_STAFF_APPLY_LEAVE';
        $data['action_key'] = 'A_VIEW_LEAVES';
        check_access(array($data['action_key']));
        $staff_leave = Leave::with('staff', 'lineManager', 'leaveType')->where('slack', $slack)->first();
        $data['staff_leave_data'] = $staff_leave;
        $data['delete_access'] = check_access(['A_DELETE_LEAVES'], true);
        return view('leaves.view_staff_leave', $data);
    }


    public function listing_staff_leaves(){
        $data['menu_key'] = 'MM_HR';
        $data['sub_menu_key'] = 'SM_STAFF_APPROVE_LEAVE_REQUEST';
        check_access(array($data['menu_key'],$data['sub_menu_key']));

        return view('approve_leave.listing', $data);
    }

    public function view_staff_approve_leaves($slack){
        $data['menu_key'] = 'MM_HR';
        $data['sub_menu_key'] = 'SM_STAFF_APPROVE_LEAVE_REQUEST';
        $data['action_key'] = 'A_VIEW_APPROVE_LEAVES';
        check_access(array($data['action_key']));
        $staff_leave = Leave::with('staff', 'lineManager', 'leaveType')->where('slack', $slack)->first();
        $data['staff_leave_data'] = $staff_leave;
        $data['approve_access'] = check_access(['A_APPROVE_STAFF_LEAVES'], true);
        return view('leaves.view_staff_approve_leave', $data);
    }

}
