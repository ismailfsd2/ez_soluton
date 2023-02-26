<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Vendors;


class GeneralController extends BaseController
{
    // Select2 Functions
    public function select2_vendor(Request $request){

        $vendor = Vendors::select('id','name as text');
        $vendor->where('status',1);
        if($request->q != ""){
            $vendor->where('name','like','%'.$request->q.'%');
        }
        $sendvalue['results'] = $vendor->get();
        $sendvalue['pagination']['more'] = false;
        echo json_encode($sendvalue);
    }
}