<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepairingLab extends Controller
{  
    public function index(){

            $data['menu_key'] = 'MM_WORKSHOP';
            $data['sub_menu_key'] = 'SM_WORKSHOP';
            check_access(array($data['menu_key'], $data['sub_menu_key']));
    
            return view('repairing.repairing_devices', $data);
    }
}
