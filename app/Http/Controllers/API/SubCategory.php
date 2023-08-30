<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubCategory extends Controller
{
    public function delete_category(Request $request){
        if ($request->input('_token') !== csrf_token()) {
            return response()->json([
                'status_code' => 403,
                'msg' => 'Invalid CSRF token'
            ]);
        }
        dd('kashif');
    }
}
