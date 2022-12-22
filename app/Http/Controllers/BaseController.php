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
        $this->data['active_theme'] = 'theme1';
        $this->data['page_title'] = 'EZ Solution';
    }
}
