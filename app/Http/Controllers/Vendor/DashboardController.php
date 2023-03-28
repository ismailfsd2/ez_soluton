<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Session;

class DashboardController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        return view($this->data['active_theme'].'/vendor/dashboard',$this->data);
    }

}
