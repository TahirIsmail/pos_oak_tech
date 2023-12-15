<?php

namespace App\Http\Controllers;

use App\Models\MasterStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Supplier as SupplierModel;

use App\Http\Resources\SupplierResource;
use App\Models\SupplierPerformance;

class Supplier extends Controller
{
    //This is the function that loads the listing page
    public function index(Request $request){
        //check access
        $data['menu_key'] = 'MM_SUPPLIER';
        $data['sub_menu_key'] = 'SM_SUPPLIERS';
        check_access(array($data['menu_key'],$data['sub_menu_key']));
        
        return view('supplier.suppliers', $data);
    }

    public function suppliers_performance(Request $request){
        //check access
        $data['menu_key'] = 'MM_SUPPLIER';
        $data['sub_menu_key'] = 'SM_SUPPLIERS_PERFORMANCE';
        check_access(array($data['menu_key'],$data['sub_menu_key']));
        
        return view('supplier.suppliers_performance', $data);
    }

    public function add_supplier_performa($slack = null){
        $data['menu_key'] = 'MM_SUPPLIER';
        $data['sub_menu_key'] = 'SM_SUPPLIERS_PERFORMANCE';
        $data['action_key'] = ($slack == null)?'A_ADD_SUPPLIER_PERFORMANCE':'A_EDIT_SUPPLIER_PERFORMANCE';
        check_access(array($data['action_key']));

        $data['statuses'] = MasterStatus::select('value', 'label')->filterByKey('SUPPLIER_STATUS')->active()->sortValueAsc()->get();
        $data['supplier_data'] = null;
        $data['selectedSupplierId'] = '';

        if(isset($slack)){
            
            $supplier = SupplierPerformance::with('supplier')->where('slack', '=', $slack)->first();
            if (empty($supplier)) {
                abort(404);
            }
            $data['selectedSupplierId'] = $supplier->supplier->id;
            $data['supplier_data'] = $supplier;
        }
        $suppliers = SupplierModel::all();
        $data['suppliers'] = $suppliers;

        // dd($data['suppliers']);
        
        return view('supplier.add_supplier_performance', $data);
        
    }

    

    //This is the function that loads the add/edit page
    public function add_supplier($slack = null){
        //check access
        $data['menu_key'] = 'MM_SUPPLIER';
        $data['sub_menu_key'] = 'SM_SUPPLIERS';
        $data['action_key'] = ($slack == null)?'A_ADD_SUPPLIER':'A_EDIT_SUPPLIER';
        check_access(array($data['action_key']));
        $data['statuses'] = MasterStatus::select('value', 'label')->filterByKey('SUPPLIER_STATUS')->active()->sortValueAsc()->get();
        $data['supplier_data'] = null;
        if(isset($slack)){    
            $supplier = SupplierModel::with('bank_details')->where('slack', '=', $slack)->first();
            if (empty($supplier)) {
                abort(404);
            }
            $supplier_data = new SupplierResource($supplier);
            $data['supplier_data'] = $supplier_data;
            // dd($data['supplier_data']);
        }

        return view('supplier.add_supplier', $data);
    }

    //This is the function that loads the detail page
    public function detail($slack){
        $data['menu_key'] = 'MM_SUPPLIER';
        $data['sub_menu_key'] = 'SM_SUPPLIERS';
        $data['action_key'] = 'A_DETAIL_SUPPLIER';
        check_access([$data['action_key']]);

        $supplier = SupplierModel::where('slack', '=', $slack)->first();
        
        if (empty($supplier)) {
            abort(404);
        }

        $supplier_data = new SupplierResource($supplier);
        
        $data['supplier_data'] = $supplier_data;

        // dd($data['supplier_data']);

        $data['delete_access'] = check_access(['A_DELETE_SUPPLIER'], true);

        return view('supplier.supplier_detail', $data);
    }


    public function view_supplier_performance($slack){
        $data['menu_key'] = 'MM_SUPPLIER';
        $data['sub_menu_key'] = 'SM_SUPPLIERS_PERFORMANCE';        
        $data['action_key'] = 'A_DETAIL_SUPPLIER_PERFORMANCE';
        check_access(array($data['action_key']));

        $supplier_data = SupplierPerformance::with('supplier')->where('slack', '=', $slack)->first();
        if (empty($supplier_data)) {
            abort(404);
        }
        $data['supplier_data'] = $supplier_data;
        $data['delete_access'] = check_access(['A_DELETE_SUPPLIER'], true);
        return view('supplier.supplier_performance_details', $data);
    }
}
