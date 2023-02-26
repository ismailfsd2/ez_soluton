<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Brands;
use App\Models\Taxes;
use App\Models\Categories;
use App\Models\Units;
use App\Models\Products;
use App\Models\Productvendors;


class ProductsController extends BaseController
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
        return view($this->data['active_theme'].'/admin/products/list',$this->data);
    }
    public function data(Request $request){
        $query = Products::select(
            'products.*',
            'categories.name as category',
            'units.name as unit',
            'brands.name as brand'
        );
        $query->leftJoin('categories', 'categories.id', '=', 'products.category_id');
        $query->leftJoin('units', 'units.id', '=', 'products.unit_id');
        $query->leftJoin('brands', 'brands.id', '=', 'products.brand_id');
        $query->where(function($query){
            $column_search = array(
                'products.id',
                'products.name',
                'products.barcode',
                'products.company_code',
                'products.cost',
                'products.price',
                'products.mrp',
                'categories.name',
                'units.name',
                'brands.name',
                'products.tax_method',
                'products.created_at',
                'products.status'
            );
            foreach($column_search as $key => $item){
                if($_POST['search']['value']){
                    if($key==0){
                        $query->where($item, 'like', '%'.$_POST['search']['value'].'%');
                    }
                    else{
                        $query->orWhere($item, 'like', '%'.$_POST['search']['value'].'%');
                    }
                }
            }
        });    
        $column_order = array(
            'products.id',
            'products.name',
            'products.barcode',
            'products.company_code',
            'products.cost',
            'products.price',
            'products.mrp',
            'products.tax_method',
            'products.created_at',
            'products.status'
        );

        if($_POST['order']['0']['dir'] == 'asc'){
            $query->orderBy($column_order[$_POST['order']['0']['column']]);
        }
        else{
            $query->orderByDesc($column_order[$_POST['order']['0']['column']]);
        }
        $rows = $query->get();
        $data = array();
        foreach($rows as $row){
            $button = '
                <div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-fill align-middle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.products.edit',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.products.vendors',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Vendors</a></li>
                        <li><a class="dropdown-item remove-item-btn" href="'.route('admin.products.destroy',$row->id).'" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>
                    </li>
                    </ul>
                </div>
            ';
            if($row->image == ""){
                $image = '<img src="'.asset('assets/images/no_image.jpg').'" style="width: 100px;" >';
            }
            else{

                $image = '<img src="'.asset('uploads/products/'.$row->image).'" style="width: 100px;" >';
            }
            $tax_method = "Exclusive";
            if($row->tax_method == 2){
                $tax_method = "Inclusive";
            }
            $data[] = array(
                $row->id,
                $image,
                $row->name,
                $row->barcode,
                $row->company_code,
                $row->cost,
                $row->price,
                $row->mrp,
                $tax_method,
                $row->category,
                $row->unit,
                $row->brand,
                $row->alert_quantity,
                $row->created_at->format('Y-m-d'),
                $row->status == 1 ? 'Active' : 'Deactive',
                $button
            );
        }
        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => Products::count(),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        // Output to JSON format
        echo json_encode($output);




        // DatatableData::data('',$request);
    }
    public function add(){

        $this->data['brands'] = Brands::where('status',1)->get();
        $this->data['units'] = Units::where('status',1)->get();
        $this->data['categories'] = Categories::where('status',1)->get();
        $this->data['taxes'] = Taxes::where('status',1)->get();

        return view($this->data['active_theme'].'/admin/products/add',$this->data);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required']
        ]);

        $image = "";
        if($request->file('image')){
            $file = $request->file('image');
            $image = time().'_'.$file->getClientOriginalName();
            $destinationPath = 'public/uploads/products';
            $file->move($destinationPath,$image);
        }


        $product = new Products;
        $product->image = $image;
        $product->name = $request->input('name');
        $product->barcode = $request->input('barcode');
        $product->company_code = $request->input('company_code');
        $product->cost = $request->input('cost');
        $product->price = $request->input('price');
        $product->mrp = $request->input('mrp');
        $product->tax_method = $request->input('tax_method');
        $product->taxes = $request->input('product_tax');
        $product->category_id = $request->input('category');
        $product->unit_id = $request->input('unit');
        $product->brand_id = $request->input('brand');
        // $product->suppliers = $request->input('name');
        $product->alert_quantity = $request->input('alert_quantity');
        $product->description = $request->input('description');
        $product->save();

        return redirect()->route('admin.products.list')
        ->with('_success','Product created successfully.');
    }
    public function edit($id){
        $this->data['brands'] = Brands::where('status',1)->get();
        $this->data['units'] = Units::where('status',1)->get();
        $this->data['categories'] = Categories::where('status',1)->get();
        $this->data['taxes'] = Taxes::where('status',1)->get();

        $product = Products::where('id',$id)->get(); 
        if(count($product)){
            $this->data['product'] = $product[0];
            return view($this->data['active_theme'].'/admin/products/edit',$this->data);
        }
        else{
            return redirect()->route('admin.products.list')
            ->with('error','Product not found.');
        }
    }
    public function update(Request $request){
        $validated = $request->validate([
            'name' => ['required'],
        ]);
        $product = Products::find($request->input('product_id'));
        if($request->file('logo')){
            $file = $request->file('logo');
            $logo = time().'_'.$file->getClientOriginalName();
            $destinationPath = 'public/uploads/products';
            $file->move($destinationPath,$logo);
            $product->image = $logo;
        }
        $product->name = $request->input('name');
        $product->barcode = $request->input('barcode');
        $product->company_code = $request->input('company_code');
        $product->cost = $request->input('cost');
        $product->price = $request->input('price');
        $product->mrp = $request->input('mrp');
        $product->tax_method = $request->input('tax_method');
        $product->taxes = $request->input('product_tax');
        $product->category_id = $request->input('category');
        $product->unit_id = $request->input('unit');
        $product->brand_id = $request->input('brand');
        // $product->suppliers = $request->input('name');
        $product->alert_quantity = $request->input('alert_quantity');
        $product->description = $request->input('description');
        $product->status = $request->input('status');
        $product->save();

        return redirect()->route('admin.products.list')
        ->with('_success','Product updated successfully.');
        
    }
    public function destroy($id){
        Products::where('id',$id)->delete(); 
        return redirect()->route('admin.products.list')
        ->with('_success','Product deleted successfully.');
    }
    public function view(){
        return view($this->data['active_theme'].'/admin/products/view',$this->data);
    }
    public function vendors($id){
        $this->data['id'] = $id;
        $this->data['vendors'] = Productvendors::select('product_vendors.*','vendors.name')->join('vendors', 'vendors.id', '=', 'product_vendors.vendor_id')->where('product_vendors.product_id',$id)->get();
        return view($this->data['active_theme'].'/admin/products/vendors',$this->data);
    }
    public function vendor_add(Request $request){

        $check = Productvendors::where('product_id',$request->product_id)->where('vendor_id',$request->vendor)->get();
        if(count($check) == 0){
            $productvendor = new Productvendors;
            $productvendor->product_id = $request->product_id;
            $productvendor->vendor_id = $request->vendor;
            $productvendor->save();
            return redirect()->route('admin.products.vendors',$request->product_id)
            ->with('_success','Vendor add successfully.');
        }
        else{
            return redirect()->route('admin.products.vendors',$request->product_id)
            ->with('_error','Vendor already add.');
        }
    }
    public function vendor_destroy($id){
        Productvendors::where('id',$id)->delete(); 
        return redirect()->back()
        ->with('_success','Product vendor deleted successfully.');
    }

}
