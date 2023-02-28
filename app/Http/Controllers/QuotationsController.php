<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Quotations;
use App\Models\Customers;
use App\Models\Quotationitems;
use App\Models\Quotationaddons;

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
        echo '<pre>';
        print_r($request->all());
        echo '</pre>';


        $quotation = new Quotations;
        $quotation->reference_no = date('Y').''.date('m').''.date('d').''.date('H').''.date('i').''.date('s');
        $quotation->date = $request->date.' '.date('H:i:s');
        $quotation->customer_id = $request->customer;
        $quotation->save();
        $items = $request->item_id;
        $item_vendor = $request->item_vendor;
        $item_qty = $request->item_qty;
        foreach($items as $key => $item){
            $quotation_items = new Quotationitems;
            $quotation_items->quotation_id = $quotation->id;
            $quotation_items->product_id = $items[$key];
            $quotation_items->vendor_id = $item_vendor[$key];
            $quotation_items->quantity = $item_qty[$key];
            $quotation_items->save();
        }





        $addons_product_name = $request->addons_product_name;
        $addons_product_description = $request->addons_product_description;
        $addons_product_quantity = $request->addons_product_quantity;
        foreach($addons_product_name as $key => $item){
            $quotation_addonsitems = new Quotationaddons;
            $quotation_addonsitems->quotation_id = $quotation->id;
            $quotation_addonsitems->product_name = $addons_product_name[$key];
            $quotation_addonsitems->product_description = $addons_product_description[$key];
            $quotation_addonsitems->quantity = $addons_product_quantity[$key];
            $quotation_addonsitems->save();
        }
        return redirect()->route('admin.quotations.list')
        ->with('_success','Quotation created successfully.');
    }

}
