<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Brands;


class BrandsController extends BaseController
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
        return view($this->data['active_theme'].'/vendor/brands/list',$this->data);
    }
    public function data(Request $request){
        $query = Brands::select(
            'brands.*'
        );
        $query->where(function($query){
            $column_search = array(
                'brands.id',
                'brands.name'
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
            'brands.id',
            'brands.name',
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
            ';
            if($row->logo == ""){
                $image = '<img src="'.asset('assets/images/no_image.jpg').'" style="width: 100px;" >';
            }
            else{

                $image = '<img src="'.asset('uploads/brands/'.$row->logo).'" style="width: 100px;" >';
            }
            $data[] = array(
                $row->id,
                $image,
                $row->name,
                $row->created_at->format('Y-m-d')
                // $row->status == 1 ? 'Active' : 'Deactive',
            );
        }
        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => Brands::count(),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        // Output to JSON format
        echo json_encode($output);
        // DatatableData::data('',$request);
    }

}
