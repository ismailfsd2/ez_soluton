<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Vendors;
use App\Models\Products;
use App\Models\Productvendors;


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
    public function select2_products(Request $request){

        $vendor = Products::select('id','name as text');
        $vendor->where('status',1);
        if($request->q != ""){
            $vendor->where('name','like','%'.$request->q.'%');
        }
        $sendvalue['results'] = $vendor->get();
        $sendvalue['pagination']['more'] = false;
        echo json_encode($sendvalue);
    }
   public function searching_products(Request $request){
        $pq = Products::select('id','name','barcode');
        $pq->where('status',1);
        $pq->where('name','like','%'.$request->term.'%');
        $pq->limit(10);
		$rows =  $pq->get();
		$products = array();
		foreach($rows as $row){
            $vendors = Productvendors::select('vendors.id','vendors.name')->leftJoin('vendors', 'vendors.id', '=', 'product_vendors.vendor_id')->where('product_vendors.product_id',$row->id)->get();
			$products[] = array(
				'id' => sha1($row->id), 
				'item_id' => $row->id, 
				'label' => $row->name, 
				'row' => $row,
				'vendors' => $vendors,
				'qty' => 1
			);
		}
		echo json_encode($products);
   } 
   public function product_vendors(REQUEST $request){
        $vendors = Productvendors::select('vendors.id','vendors.name')->leftJoin('vendors', 'vendors.id', '=', 'product_vendors.vendor_id')->where('product_vendors.product_id',$request->product_id)->get();
        $data['vendors'] = $vendors;
		echo json_encode($data);

   }
}