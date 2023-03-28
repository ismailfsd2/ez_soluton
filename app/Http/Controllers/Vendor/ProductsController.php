<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\BaseController;
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
        return view($this->data['active_theme'].'/vendor/products/list',$this->data);
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
                        <li><a class="dropdown-item" href="'.route('admin.products.vendors',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Vendors</a></li>
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
    public function view(){
        return view($this->data['active_theme'].'/vendor/products/view',$this->data);
    }
    public function vendors($id){
        $this->data['id'] = $id;
        $this->data['vendors'] = Productvendors::select('product_vendors.*','vendors.name')->join('vendors', 'vendors.id', '=', 'product_vendors.vendor_id')->where('product_vendors.product_id',$id)->get();
        return view($this->data['active_theme'].'/vendor/products/vendors',$this->data);
    }

}
