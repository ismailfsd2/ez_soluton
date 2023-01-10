<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Units;


class UnitsController extends BaseController
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
        return view($this->data['active_theme'].'/admin/units/list',$this->data);
    }
    public function data(Request $request){
        $query = Units::select(
            'units.*',
        );
        $query->where(function($query){
            $column_search = array(
                'units.id',
                'units.name',
                'units.code',
                'units.created_at',
                'units.status'
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
            'units.id',
            'units.name',
            'units.code',
            'units.created_at',
            'units.status'
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
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.units.edit',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item remove-item-btn" href="'.route('admin.units.destroy',$row->id).'" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>
                    </li>
                    </ul>
                </div>
            ';
            $data[] = array(
                $row->id,
                $row->name,
                $row->code,
                $row->created_at->format('d-M-Y'),
                // $row->status = 1 ? "Active" : "Deactive",
                $button
            );
        }
        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => Units::count(),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        // Output to JSON format
        echo json_encode($output);




        // DatatableData::data('',$request);
    }
    public function add(){
        return view($this->data['active_theme'].'/admin/units/add',$this->data);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'code' => 'required'
        ]);

        $unit = new Units;
        $unit->name = $request->input('name');
        $unit->code = $request->input('code');
        $unit->save();

        return redirect()->route('admin.units.list')
        ->with('_success','Unit created successfully.');
    }
    public function edit($id){

        $this->data['unit'] = Units::where('id',$id)->get(); 
        if(count($this->data['unit']) > 0){
            return view($this->data['active_theme'].'/admin/units/edit',$this->data);
        }
        else{
            return redirect()->route('admin.units.list')
            ->with('error','Unit not found.');
        }
    }
    public function update(Request $request){

        $validated = $request->validate([
            'name' => ['required'],
            'code' => ['required']
        ]);

        $unit = Units::find($request->input('unit_id'));
        $unit->name = $request->input('name');
        $unit->code = $request->input('code');
        $unit->save();

        return redirect()->route('admin.units.list')
        ->with('_success','Warehosue update successfully.');
        
    }
    public function destroy($id){
        Units::where('id',$id)->delete(); 
        return redirect()->route('admin.units.list')
        ->with('_success','Unit deleted successfully.');
    }

}
