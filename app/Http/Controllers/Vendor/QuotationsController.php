<?php

namespace App\Http\Controllers\Vendor;

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
        $this->data['rows'] = Quotations::select('quotations.*','customers.name as customer')
                                ->LeftJoin('customers', 'customers.id', '=', 'quotations.customer_id')
                                ->where('quotations.customer_id',$this->data['autdata']->related_id)
                                ->orderBy('quotations.date','desc')
                                ->get();
        return view($this->data['active_theme'].'/vendor/quotations/list',$this->data);
    }
    public function create(){
        return view($this->data['active_theme'].'/vendor/quotations/create',$this->data);
    }
    public function store(Request $request){

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
        if($addons_product_name != ""){
            foreach($addons_product_name as $key => $item){
                $quotation_addonsitems = new Quotationaddons;
                $quotation_addonsitems->quotation_id = $quotation->id;
                $quotation_addonsitems->product_name = $addons_product_name[$key];
                $quotation_addonsitems->product_description = $addons_product_description[$key];
                $quotation_addonsitems->quantity = $addons_product_quantity[$key];
                $quotation_addonsitems->save();
            }
        }
        return redirect()->route('vendor.quotations.list')
        ->with('_success','Quotation created successfully.');
    }
    public function destroy($id){
        Quotationaddons::where('quotation_id',$id)->delete(); 
        Quotationitems::where('quotation_id',$id)->delete(); 
        Quotations::where('id',$id)->delete(); 
        return redirect()->route('vendor.quotations.list')
        ->with('_success','Quotation deleted successfully.');
    }
    public function detail($id){
        $this->data['quotation'] = Quotations::select('customers.*','quotations.*')->join('customers', 'customers.id', '=', 'quotations.customer_id')->where('quotations.id',$id)->get();
        $this->data['items'] = Quotationitems::select('quotation_items.*','p.name as product_name','v.name as vendor_name')
                                    ->join('products as p','p.id','=','quotation_items.product_id')
                                    ->join('vendors as v','v.id','=','quotation_items.vendor_id')
                                    ->where('quotation_items.quotation_id',$id)->get();
        $this->data['addons'] = Quotationaddons::where('quotation_id',$id)->get();
        return view($this->data['active_theme'].'/vendor/quotations/view',$this->data);
    }
}
