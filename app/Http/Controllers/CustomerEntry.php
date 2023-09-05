<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use App\Exceptions\InvalidLinkException;
class CustomerEntry extends Controller
{
    //
    public function customer_signin(Request $request){
        
        if(session()->get("access_token") != ""){
            return redirect(session()->get("initial_link")); 
        }
        
        $data['message'] = (session('message'))?session('message'):'';
        $data['is_demo'] = (App::environment('demo'))?true:false;
        $data['preview_mode'] = ($request->query('preview_mode') == 'true')?true:false;
        $data['company_logo'] = config('app.company_logo');
        
        return view('entry.customer.sign_in', $data);
    }
    public function forgot_password(){
        $data['company_logo'] = config('app.company_logo');
        return view('entry.customer.forgot_password', $data);
    }
}
