<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;


class CategoriesController extends BaseController
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
        return view($this->data['active_theme'].'/customer/categories/list',$this->data);
    }
    public function data(Request $request){
        $query = Categories::select(
            'categories.*',
            'parent.name as parent'
        );
        $query->leftJoin('categories as parent', 'parent.id', '=', 'categories.parent_id');
        $query->where(function($query){
            $column_search = array(
                'categories.id',
                'categories.name',
                'parent.name'
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
            'categories.id',
            'categories.name',
            'parent.name'
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

                $image = '<img src="'.asset('uploads/categories/'.$row->logo).'" style="width: 100px;" >';
            }
            $data[] = array(
                $row->id,
                $image,
                $row->name,
                $row->parent == "" ? "Main Category" : $row->parent,
                $row->created_at->format('Y-m-d')
            );
        }
        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => Categories::count(),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        // Output to JSON format
        echo json_encode($output);




        // DatatableData::data('',$request);
    }

}
