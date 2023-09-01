<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaints;
class ComplaintsController extends Controller
{
    //
    public function index(Request $request){
        $data['menu_key'] = 'MM_COMPLAIN';
        $data['sub_menu_key'] = 'SM_CUSTOMER_COMPLAINTS';
        check_access(array($data['menu_key'],$data['sub_menu_key']));
        
        return view('complaints.customer_complaints', $data);
    }

    public function add_complaints(){

    }
}
