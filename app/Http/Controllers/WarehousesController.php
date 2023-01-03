<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Warehouses;


class WarehousesController extends BaseController
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
        return view($this->data['active_theme'].'/admin/warehouses/list',$this->data);
    }
    public function data(Request $request){
        $query = Warehouses::select(
            'warehouses.*',
        );
        $query->where(function($query){
            $column_search = array(
                'warehouses.id',
                'warehouses.name',
                'warehouses.phone',
                'warehouses.email',
                'warehouses.address',
                'warehouses.created_at',
                'warehouses.status'
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
            'warehouses.id',
            'warehouses.name',
            'warehouses.phone',
            'warehouses.email',
            'warehouses.address',
            'warehouses.created_at',
            'warehouses.status'
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
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.warehouses.edit',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item remove-item-btn" href="'.route('admin.warehouses.destroy',$row->id).'" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>
                    </li>
                    </ul>
                </div>
            ';
            $data[] = array(
                $row->id,
                $row->name,
                $row->phone,
                $row->email,
                $row->address,
                $row->created_at->format('d-M-Y'),
                $row->status = 1 ? "Active" : "Deactive",
                $button
            );
        }
        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => Warehouses::count(),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        // Output to JSON format
        echo json_encode($output);




        // DatatableData::data('',$request);
    }
    public function add(){
        return view($this->data['active_theme'].'/admin/warehouses/add',$this->data);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $warehouse = new Warehouses;
        $warehouse->name = $request->input('name');
        $warehouse->email = $request->input('email');
        $warehouse->phone = $request->input('phone');
        $warehouse->address = $request->input('address');
        $warehouse->save();

        return redirect()->route('admin.warehouses.list')
        ->with('_success','Warehouse created successfully.');
    }
    public function edit($id){

        $this->data['warehouse'] = Warehouses::where('id',$id)->get(); 
        if(count($this->data['warehouse']) > 0){
            return view($this->data['active_theme'].'/admin/warehouses/edit',$this->data);
        }
        else{
            return redirect()->route('admin.warehouses.list')
            ->with('error','Warehouse not found.');
        }
    }
    public function update(Request $request){

        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'address' => ['required']
        ]);

        $warehouse = Warehouses::find($request->input('warehouse_id'));
        $warehouse->name = $request->input('name');
        $warehouse->email = $request->input('email');
        $warehouse->phone = $request->input('phone');
        $warehouse->address = $request->input('address');
        $warehouse->save();

        return redirect()->route('admin.warehouses.list')
        ->with('_success','Warehosue update successfully.');
        
    }
    public function destroy($id){
        Warehouses::where('id',$id)->delete(); 
        return redirect()->route('admin.warehouses.list')
        ->with('_success','Warehouse deleted successfully.');
    }

}
