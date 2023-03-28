<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
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
        $this->data['active_theme'] = 'theme1';
        $this->data['page_title'] = 'EZ Solution';
        $this->middleware(function ($request, $next){
            $this->data['autdata'] = Users::find(Session::get('CustomerSession'));
            return $next($request);
        });
    }
}
