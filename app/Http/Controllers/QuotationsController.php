<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Quotations;
use App\Models\Customers;
use App\Models\Quotationitems;
use App\Models\Quotationaddons;
use App\Models\Manufacturers;
use App\Models\Finishedgoods;
use App\Models\Orders;
use App\Models\Orderitems;
use App\Models\Documents;

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
        $this->data['rows'] = Quotations::select('quotations.*','customers.name as customer')->join('customers', 'customers.id', '=', 'quotations.customer_id')->orderBy('quotations.date','desc')->get();
        return view($this->data['active_theme'].'/admin/quotations/list',$this->data);
    }
    public function create(){
        $this->data['customers'] = Customers::get();
        return view($this->data['active_theme'].'/admin/quotations/create',$this->data);
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
        return redirect()->route('admin.quotations.list')
        ->with('_success','Quotation created successfully.');
    }
    public function destroy($id){

        Quotationaddons::where('quotation_id',$id)->delete(); 
        Quotationitems::where('quotation_id',$id)->delete(); 
        Quotations::where('id',$id)->delete(); 
        return redirect()->route('admin.quotations.list')
        ->with('_success','Quotation deleted successfully.');

    }
    public function detail($id){


        $this->data['factories'] = Manufacturers::select('id','name')->where('status',1)->get();
        $this->data['fgs'] = Finishedgoods::select('id','name')->where('status',1)->get();

        $this->data['quotation'] = Quotations::select('customers.*','quotations.*')->join('customers', 'customers.id', '=', 'quotations.customer_id')->where('quotations.id',$id)->get()[0];
        $this->data['items'] = Quotationitems::select('quotation_items.*','p.name as product_name','v.name as vendor_name')
                                    ->join('products as p','p.id','=','quotation_items.product_id')
                                    ->join('vendors as v','v.id','=','quotation_items.vendor_id')
                                    ->where('quotation_items.quotation_id',$id)->get();

        $this->data['addons'] = Quotationaddons::where('quotation_id',$id)->get();
        

        $this->data['orders'] = Orders::select('vendors.name as vendor_name','orders.*')->join('vendors', 'vendors.id', '=', 'orders.vendor_id')->where('orders.quotation_id',$id)->get();

        $this->data['documents'] = Documents::where('type','quotation')->where('related_id',$id)->get();

        return view($this->data['active_theme'].'/admin/quotations/view',$this->data);

    }
    public function project_detail_submit(Request $request){
        $quotation = Quotations::find($request->input('quotation_id'));
        $quotation->project_name = $request->input('projectname');
        $quotation->finish_good_id = $request->input('finishgood');
        $quotation->production_factory_id =$request->input('productionfactory');
        $quotation->packaging_factory_id = $request->input('packagingfactory');
        $quotation->save();
        return redirect()->route('admin.quotations.detail',$item->id)
        ->with('_success','Project Detail submit successfully.');
    }
    public function submit_price(Request $request){
        $item = Quotationitems::find($request['id']);
        $item->vendor_price = $request['price'];
        $item->estimated_delivery_date = $request['estimated_delivery_date'];
        $item->quote_expiry_date = $request['quote_expiry_date'];
        $item->save();
        return redirect()->route('admin.quotations.detail',$item->quotation_id)
        ->with('_success','Price submit successfully.');
    }
    public function add_materail(Request $request){
        $quotation_items = new Quotationitems;
        $quotation_items->quotation_id = $request->quotation_id;
        $quotation_items->product_id = $request->product_id;
        $quotation_items->vendor_id = $request->vendor;
        $quotation_items->quantity = $request->quantity;
        $quotation_items->save();
        return back()->with('_success','Meterial add successfully.');
    }
    public function udpate_materail(Request $request){
        $items = Quotationitems::find($request->id);
        $items->product_id = $request->product_id;
        $items->vendor_id = $request->vendor;
        $items->quantity = $request->quantity;
        $items->save();
        return back()->with('_success','Meterial update successfully.');
    }
    public function delete_materail($id){
        Quotationitems::where('id',$id)->delete();
        return back()->with('_success','Meterial deleted successfully.');
    }
    public function add_addonmaterail(REQUEST $request){
        $quotation_addonsitems = new Quotationaddons;
        $quotation_addonsitems->quotation_id = $request->quotation_id;
        $quotation_addonsitems->product_name = $request->name;
        $quotation_addonsitems->product_description = $request->detail;
        $quotation_addonsitems->quantity = $request->quantity;
        $quotation_addonsitems->save();
        return back()->with('_success','Add-Ons Meterial add successfully.');
    }
    public function udpate_addonmaterail(REQUEST $request){
        $items = Quotationaddons::find($request->id);
        $items->product_name = $request->name;
        $items->product_description = $request->detail;
        $items->quantity = $request->quantity;
        $items->save();
        return back()->with('_success','Add-Ons Meterial update successfully.');
    }
    public function delete_addonmaterail($id){
        Quotationaddons::where('id',$id)->delete();
        return back()->with('_success','Add-Ons Meterial deleted successfully.');
    }
    public function order_create(REQUEST $request){
        $quotation = Quotations::select('quotations.*')->where('quotations.id',$request->input('quotation_id'))->get()[0];
        if($quotation->finish_good_id != 0){
            $qu = Quotations::find($request->input('quotation_id'));
            $qu->ponumber = $request->input('ponumber');
            $qu->billaddress = $request->input('billaddress');
            $qu->shippingaddress = $request->input('shippingaddress');
            if($request->input('ponumber')){
                $qu->status = "accept";
            }
            $qu->save();
            $vendors = Quotationitems::select('quotation_items.vendor_id')
                            ->where('quotation_items.quotation_id',$request->input('quotation_id'))
                            ->groupBy('quotation_items.vendor_id')
                            ->get();
            foreach($vendors as $vendor){
                $order = new Orders;
                $order->quotation_id = $quotation->id;
                $order->customer_id = $quotation->customer_id;
                $order->vendor_id = $vendor->vendor_id;
                $order->save();

                $items = Quotationitems::select('quotation_items.*')
                            ->where('quotation_items.quotation_id',$request->input('quotation_id'))
                            ->where('quotation_items.vendor_id',$vendor->vendor_id)
                            ->get();
                $order_subtotal = 0;
                $order_total_items = 0;
                foreach($items as $item){
                    $orderitem = new Orderitems;
                    $orderitem->order_id = $order->id;
                    $orderitem->item_id = $item->product_id;
                    $orderitem->price = $item->vendor_price;
                    $orderitem->quantity = $item->quantity;
                    $orderitem->total = $item->quantity*$item->vendor_price;
                    $orderitem->save();
                    $order_subtotal += $item->quantity*$item->vendor_price;
                    $order_total_items++;
                }
                $order = Orders::find($order->id);
                $order->total_items = $order_total_items;
                $order->sub_total = $order_subtotal;
                $order->save();
            }
            return redirect()->route('admin.quotations.detail',$request->input('quotation_id'))
            ->with('_success','Order Create Successfully');
        }
        else{
            return redirect()->route('admin.quotations.detail',$request->input('quotation_id'))
            ->with('_error','You cannot create order.');
        }
    }

    public function submit_ponumber(REQUEST $request){
        $quotation = Quotations::select('quotations.*')->where('quotations.id',$request->input('quotation_id'))->get()[0];
        if($quotation->finish_good_id != 0){
            $qu = Quotations::find($request->input('quotation_id'));
            $qu->ponumber = $request->input('ponumber');
            $qu->billaddress = $request->input('billaddress');
            $qu->shippingaddress = $request->input('shippingaddress');
            if($request->input('ponumber')){
                $qu->status = "accept";
            }
            $qu->save();
            return redirect()->route('admin.quotations.detail',$request->input('quotation_id'))->with('_success','Order Create Successfully');
        }
        else{
            return redirect()->route('admin.quotations.detail',$request->input('quotation_id'))
            ->with('_error','You cannot create order.');
        }
    }
    public function attachmentupload(REQUEST $request){
        $validated = $request->validate([
            'title' => ['required']
        ]);
        if($request->hasFile('file')){
            $file = $request->file('file');
            $logo = time().'_'.$file->getClientOriginalName();
            $destinationPath = 'public/uploads/quotations/';
            $file->move($destinationPath,$logo);

            $document = new Documents;
            $document->type = $request->type;
            $document->related_id = $request->relative_id;
            $document->title = $request->title;
            $document->file_url = $logo;
            $document->file_type = $file->getClientOriginalExtension();
            $document->file_size = 0;
            $document->save();

            return redirect()->route('admin.quotations.detail',$request->input('relative_id'))->with('_success','Attachment Upload Successfully');

        }
        
    }
    public function delete_file($id){
        Documents::where('id',$id)->delete(); 
        return Redirect::back()
        ->with('_success','Document deleted.');
    }
}
