<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Finishedgoods;

class FinishedgoodsController extends BaseController
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
        return view($this->data['active_theme'].'/admin/finishedgoods/list',$this->data);
    }
    public function data(Request $request){
        $query = Finishedgoods::select(
            'finished_goods.*'
        );
        $query->where(function($query){
            $column_search = array(
                'finished_goods.id',
                'finished_goods.name',
                'finished_goods.created_at',
                'finished_goods.status'
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
            'finished_goods.id',
            'finished_goods.name',
            'finished_goods.created_at',
            'finished_goods.status'
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
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.finishedgoods.edit',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item remove-item-btn" href="'.route('admin.finishedgoods.destroy',$row->id).'" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>
                    </li>
                    </ul>
                </div>
            ';
            $data[] = array(
                $row->id,
                $row->name,
                $row->created_at->format('Y-m-d'),
                $row->status == 1 ? 'Active' : 'Deactive',
                $button
            );
        }
        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => Finishedgoods::count(),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        // Output to JSON format
        echo json_encode($output);




        // DatatableData::data('',$request);
    }
    public function add(){
        return view($this->data['active_theme'].'/admin/finishedgoods/add',$this->data);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required']
        ]);


        $product = new Finishedgoods;
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->save();

        return redirect()->route('admin.finishedgoods.list')
        ->with('_success','Product created successfully.');
    }
    public function edit($id){
        $product = Finishedgoods::where('id',$id)->get(); 
        if(count($product)){
            $this->data['product'] = $product[0];
            return view($this->data['active_theme'].'/admin/finishedgoods/edit',$this->data);
        }
        else{
            return redirect()->route('admin.finishedgoods.list')
            ->with('error','Finished Good not found.');
        }
    }
    public function update(Request $request){
        $validated = $request->validate([
            'name' => ['required'],
        ]);
        $product = Finishedgoods::find($request->input('fg_id'));
        $product->name = $request->input('name');
        $product->status = $request->input('status');
        $product->save();

        return redirect()->route('admin.finishedgoods.list')
        ->with('_success','Finished Goods updated successfully.');
        
    }
    public function destroy($id){
        Finishedgoods::where('id',$id)->delete(); 
        return redirect()->route('admin.finishedgoods.list')
        ->with('_success','Finished Goods deleted successfully.');
    }
    public function view(){
        return view($this->data['active_theme'].'/admin/finishedgoods/view',$this->data);
    }

}



