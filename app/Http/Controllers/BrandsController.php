<?php

namespace App\Http\Controllers;

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
        return view($this->data['active_theme'].'/admin/brands/list',$this->data);
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
                <div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-fill align-middle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.brands.edit',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item remove-item-btn" href="'.route('admin.brands.destroy',$row->id).'" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>
                    </li>
                    </ul>
                </div>
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
                $row->created_at->format('Y-m-d'),
                $row->status == 1 ? 'Active' : 'Deactive',
                $button
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
    public function add(){
        return view($this->data['active_theme'].'/admin/brands/add',$this->data);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required']
        ]);

        $logo = "";
        if($request->file('logo')){
            $file = $request->file('logo');
            $logo = time().'_'.$file->getClientOriginalName();
            $destinationPath = 'uploads/brands';
            $file->move($destinationPath,$logo);
        }


        $brand = new Brands;
        $brand->logo = $logo;
        $brand->name = $request->input('name');
        $brand->save();

        return redirect()->route('admin.brands.list')
        ->with('_success','Brand created successfully.');
    }
    public function edit($id){

        $this->data['brand'] = Brands::where('id',$id)->get(); 
        if(count($this->data['brand'])){
            return view($this->data['active_theme'].'/admin/brands/edit',$this->data);
        }
        else{
            return redirect()->route('admin.brands.list')
            ->with('error','Brand not found.');
        }
    }
    public function update(Request $request){
        $validated = $request->validate([
            'name' => ['required'],
        ]);
        $brand = Brands::find($request->input('brand_id'));
        if($request->file('logo')){
            $file = $request->file('logo');
            $logo = time().'_'.$file->getClientOriginalName();
            $destinationPath = 'uploads/brands';
            $file->move($destinationPath,$logo);
            $brand->logo = $logo;
        }
        $brand->name = $request->input('name');
        $brand->save();

        return redirect()->route('admin.brands.list')
        ->with('_success','Brand updated successfully.');
        
    }
    public function destroy($id){
        Users::where('related_id',$id)->delete(); 
        Brands::where('id',$id)->delete(); 
        return redirect()->route('admin.brands.list')
        ->with('_success','Brand deleted successfully.');
    }
    public function view(){
        return view($this->data['active_theme'].'/admin/brands/view',$this->data);
    }

}
