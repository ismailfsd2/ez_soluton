<?php

namespace App\Http\Controllers;

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
        return view($this->data['active_theme'].'/admin/categories/list',$this->data);
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
                <div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-fill align-middle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.categories.edit',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item remove-item-btn" href="'.route('admin.categories.destroy',$row->id).'" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>
                    </li>
                    </ul>
                </div>
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
                $row->created_at->format('Y-m-d'),
                $row->status == 1 ? 'Active' : 'Deactive',
                $button
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
    public function add(){
        $this->data['categories'] = Categories::get();
        return view($this->data['active_theme'].'/admin/categories/add',$this->data);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required']
        ]);

        $logo = "";
        if($request->file('logo')){
            $file = $request->file('logo');
            $logo = time().'_'.$file->getClientOriginalName();
            $destinationPath = 'uploads/categories';
            $file->move($destinationPath,$logo);
        }


        $category = new Categories;
        $category->logo = $logo;
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $category->save();

        return redirect()->route('admin.categories.list')
        ->with('_success','Category created successfully.');
    }
    public function edit($id){

        $this->data['categories'] = Categories::get();
        $this->data['category'] = Categories::where('id',$id)->get(); 
        if(count($this->data['category'])){
            return view($this->data['active_theme'].'/admin/categories/edit',$this->data);
        }
        else{
            return redirect()->route('admin.categories.list')
            ->with('error','Category not found.');
        }
    }
    public function update(Request $request){
        $validated = $request->validate([
            'name' => ['required'],
        ]);
        $category = Categories::find($request->input('category_id'));
        if($request->file('logo')){
            $file = $request->file('logo');
            $logo = time().'_'.$file->getClientOriginalName();
            $destinationPath = 'uploads/categories';
            $file->move($destinationPath,$logo);
            $category->logo = $logo;
        }
        $category->name = $request->input('name');
        $category->parent_id = $request->input('parent_id');
        $category->save();

        return redirect()->route('admin.categories.list')
        ->with('_success','Category updated successfully.');
        
    }
    public function destroy($id){
        Users::where('related_id',$id)->delete(); 
        Categories::where('id',$id)->delete(); 
        return redirect()->route('admin.categories.list')
        ->with('_success','Category deleted successfully.');
    }
    public function view(){
        return view($this->data['active_theme'].'/admin/categories/view',$this->data);
    }

}
