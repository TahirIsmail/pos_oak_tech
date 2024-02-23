<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DemandForm;

class DemandController extends Controller
{
    public function index(){
        $data['menu_key'] = 'MM_ORDERS';
        $data['sub_menu_key'] = 'SM_DEMAND';
        check_access(array($data['menu_key'],$data['sub_menu_key']));
        // $demandFormRecords = DemandForm::all();
        // $suppliers_id = $array = explode(',', $demandFormRecords[0]['suppliers_id']);
        // $supplier_details = User::whereIn('id', $suppliers_id)->get();

        // dd($suppliers_id, $supplier_details);


        return view('demand.demand', $data);
    }

    public function quotation_request(){
        $data['menu_key'] = 'MM_ORDERS';
        $data['sub_menu_key'] = 'SM_REQUEST_QUOTATION';
        check_access(array($data['menu_key'],$data['sub_menu_key']));
        
        return view('demand.quotation_request', $data);
    }

    public function add_demand_form($slack = null){
        $data['menu_key'] = 'MM_ORDERS';
        $data['sub_menu_key'] = 'SM_DEMAND';
        $data['action_key'] = ($slack == null)?'A_ADD_DEMAND':'A_EDIT_DEMAND';
        check_access(array($data['action_key']));

        $suppliers = User::where('role_id', 3)->get();
        $data['suppliers'] = $suppliers;

       

        if(isset($slack)){

        }

        return view('demand.add_demand_form', $data);
    }

    public function add_quotation_request(){
        $data['menu_key'] = 'MM_ORDERS';
        $data['sub_menu_key'] = 'SM_REQUEST_QUOTATION';
        $data['action_key'] = 'A_ADD_QUOTATION_REQUEST';
        check_access(array($data['action_key']));


        return view('demand.add_quotation_request', $data);
    }
}
