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

class AttendanceController extends Controller
{
    public function index(){
        $data['menu_key'] = 'MM_HR';
        $data['sub_menu_key'] = 'SM_STAFF_ATTENDANCE';
        check_access(array($data['menu_key'],$data['sub_menu_key']));

        $roles = RoleModel::where('id' , '!=', 1)->CustomerRole()->SupplierRole()->get();
        // dd($roles);
        $data['roles_data']= $roles;

        return view('staff_attendance.staffattendancelist', $data);

    }
}
