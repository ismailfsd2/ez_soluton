<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Categories;
use App\Models\FrontendSetting;
use App\Models\Users;
use App\Models\UserSaveLists;

class BaseController extends Controller {
    public $data = array();
    public function __construct(){
        $request = new Request;
        $this->data['active_theme'] = 'theme1';
        $this->data['page_title'] = 'EZ Solution';
        $this->middleware(function ($request, $next){
            $admin = Users::find(Session::get('AdminSession'));
            if($admin){
                $this->data['autdata'] = $admin;
            }
            else{
                $vendor = Users::find(Session::get('VendorSession'));
                if($vendor){
                    $this->data['autdata'] = $vendor;
                }
                else{
                    $customer = Users::find(Session::get('CustomerSession'));
                    if($customer){
                        $this->data['autdata'] = $customer;
                    }
                }
            }
            return $next($request);
        });
    }
}
