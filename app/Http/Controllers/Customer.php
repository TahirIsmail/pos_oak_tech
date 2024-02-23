<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer as CustomerModel;
use App\Models\MasterStatus;
use App\Models\Store as StoreModel;
use App\Http\Resources\CustomerResource;
use App\Events\UserCreationEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use App\Models\Role as RoleModel;

class Customer extends Controller
{
    //This is the function that loads the listing page
    public function index(Request $request)
    {
        //check access
        $data['menu_key'] = 'MM_CUSTOMER';
        $data['sub_menu_key'] = 'SM_CUSTOMERS';
        check_access(array($data['menu_key'], $data['sub_menu_key']));

        return view('customer.customers', $data);
    }

    //This is the function that loads the add/edit page
    public function add_customer(Request $request, $slack = null)
    {
        //check access
        $data['menu_key'] = 'MM_CUSTOMER';
        $data['sub_menu_key'] = 'SM_CUSTOMERS';
        $data['action_key'] = ($slack == null) ? 'A_ADD_CUSTOMER' : 'A_EDIT_CUSTOMER';
        check_access(array($data['action_key']));

        $data['statuses'] = MasterStatus::select('value', 'label')->filterByKey('CUSTOMER_STATUS')->active()->sortValueAsc()->get();
        $data['stores'] =  StoreModel::select('slack', 'store_code', 'name', 'address')
            ->active()
            ->get();

        $data['customer_data'] = null;
        $data['child_customers'] = [];
        $employers = User::select('fullname', 'email')->whereNotIn('role_id', [2, 3])->get();
        $data['employers'] = $employers;
        if (isset($slack)) {
            $customer = CustomerModel::with('user')->where('customers.slack', $slack)
                ->first();

            if (empty($customer)) {
                abort(404);
            }
            $child_customers = CustomerModel::select('id as customer_child_id', 'name', 'email', 'mobile_number As mobile', 'customer_person_department as customer_department', 'customer_person_position as position', 'role_id as customer_person_role')->where('parent_id', $customer['id'])->get();
            $data['child_customers'] = $child_customers;

            $customer_data = new CustomerResource($customer);
            $data['customer_data'] = $customer_data;

            if ($data['customer_data']->customer_type == 'CUSTOM') {
                $data['customer_type'] = 'corporate';
            } else if ($data['customer_data']->customer_type == 'WALKIN') {
                $data['customer_type'] = 'walkin';
            } else {
            }
        } else {
            $data['customer_type'] = $request->input('customer_type');
        }

        $CustomerRoles = RoleModel::select('roles.*', 'master_status.label as status_label', 'master_status.color as status_color', 'user_created.fullname')
            ->statusJoin()
            ->ShowCustomerChildRoles()
            ->createdUser()
            ->get();

        $data['CustomerRoles'] = $CustomerRoles;

        return view('customer.add_customer', $data);
    }

    //This is the function that loads the detail page
    public function detail($slack)
    {
        $data['menu_key'] = 'MM_CUSTOMER';
        $data['sub_menu_key'] = 'SM_CUSTOMERS';
        $data['action_key'] = 'A_DETAIL_CUSTOMER';
        check_access([$data['action_key']]);

        $customer = CustomerModel::where('slack', $slack)
            ->first();

        if (empty($customer)) {
            abort(404);
        }

        $customer_data = new CustomerResource($customer);

        $child_customers = CustomerModel::with(['child_users:id,customer_child_id,init_password', 'role:id,label'])
        ->select('id', 'name', 'email', 'mobile_number as mobile', 'customer_person_department as customer_department', 'customer_person_position as position', 'role_id as role_id')
        ->where('parent_id', $customer['id'])
        ->get();

        $data['child_customers'] = $child_customers;
        // dd($child_customers);
        $data['customer_data'] = $customer_data;

        $data['delete_access'] = check_access(['A_DELETE_CUSTOMER'], true);

        return view('customer.customer_detail', $data);
    }
}
