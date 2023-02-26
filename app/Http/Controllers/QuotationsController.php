<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Quotations;
use App\Models\Customers;


class QuotationsController extends BaseController
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
        return view($this->data['active_theme'].'/admin/quotations/list',$this->data);
    }
    public function create(){
        $this->data['customers'] = Customers::get();
        return view($this->data['active_theme'].'/admin/quotations/create',$this->data);
    }
    public function store(Request $request){
    }

}
