<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Quotations;
use App\Models\Customers;
use App\Models\Vendors;
use App\Models\Quotationitems;
use App\Models\Quotationaddons;
use App\Models\Manufacturers;
use App\Models\Finishedgoods;
use App\Models\Orders;
use App\Models\Orderitems;

class OrdersController extends BaseController
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
        $this->data['rows'] = Orders::select('orders.*','customers.name as customer','vendors.name as vendor')
                                ->join('customers', 'customers.id', '=', 'orders.customer_id')
                                ->join('vendors', 'vendors.id', '=', 'orders.vendor_id')
                                ->orderBy('orders.created_at','desc')
                                ->get();
        return view($this->data['active_theme'].'/admin/orders/list',$this->data);
    }
    public function detail($id){

        $this->data['factories'] = Manufacturers::select('id','name')->where('status',1)->get();
        $this->data['fgs'] = Finishedgoods::select('id','name')->where('status',1)->get();
        
        $this->data['order'] = Orders::select('orders.*')->where('orders.id',$id)->get()[0];
        $this->data['oc'] = Customers::select('customers.*')->where('customers.id',$this->data['order']->customer_id)->get()[0];
        $this->data['ov'] = Vendors::select('vendors.*')->where('vendors.id',$this->data['order']->vendor_id)->get()[0];

        $this->data['items'] = Orderitems::select('order_items.*','p.name as product_name')
                                    ->join('products as p','p.id','=','order_items.item_id')
                                    ->where('order_items.order_id',$id)
                                    ->get();


        return view($this->data['active_theme'].'/admin/orders/view',$this->data);

    }

    public function submit_estimated_date(REQUEST $request){
        $item = Orderitems::find($request->input('id'));
        $item->eta_date = $request->input('eta_date');
        $item->ets_date = $request->input('ets_date');
        $item->save();


        $check = Orderitems::where('order_id',$item->order_id)->whereNull('eta_date')->get();
        if(count($check) == 0){
            $order = Orders::find($item->order_id);
            $order->status = "proccess";
            $order->save();          
        }
        return redirect()->route('admin.orders.detail',$item->order_id)->with('_success','Estimated Date Submit');
    }
    public function submit_deliverydate_date(REQUEST $request){
        $item = Orderitems::find($request->input('id'));
        $item->delivery_date = $request->input('delivery_date');
        $item->save();
        $check = Orderitems::where('order_id',$item->order_id)->whereNull('delivery_date')->get();
        if(count($check) == 0){
            $order = Orders::find($item->order_id);
            $order->status = "completed";
            $order->save();          
        }
        return redirect()->route('admin.orders.detail',$item->order_id)->with('_success','Delivery Date Submit');
    }

}
