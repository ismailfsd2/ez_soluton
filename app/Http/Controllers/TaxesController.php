<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Taxes;


class TaxesController extends BaseController
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
        return view($this->data['active_theme'].'/admin/taxes/list',$this->data);
    }
    public function data(Request $request){
        $query = Taxes::select(
            'taxes.*',
        );
        $query->where(function($query){
            $column_search = array(
                'taxes.id',
                'taxes.name',
                'taxes.type',
                'taxes.rate',
                'taxes.apply_on',
                'taxes.created_at',
                'taxes.status'
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
            'taxes.id',
            'taxes.name',
            'taxes.type',
            'taxes.rate',
            'taxes.apply_on',
            'taxes.created_at',
            'taxes.status'
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
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.taxes.edit',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item remove-item-btn" href="'.route('admin.taxes.destroy',$row->id).'" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>
                    </li>
                    </ul>
                </div>
            ';
            $applyon = "All";
            if($row->apply_on == 1){
                $applyon = "Non Register";
            }
            else if($row->apply_on == 1){
                $applyon = "Register";
            }
            $data[] = array(
                $row->id,
                $row->name,
                $row->type = 1 ? "Percentage" : "Fixed",
                $row->rate,
                $applyon,
                $row->created_at->format('d-M-Y'),
                // $row->status = 1 ? "Active" : "Deactive",
                $button
            );
        }
        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => Taxes::count(),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        // Output to JSON format
        echo json_encode($output);
    }
    public function add(){
        return view($this->data['active_theme'].'/admin/taxes/add',$this->data);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'rate' => 'required',
            'apply_on' => 'required'
        ]);

        $tax = new Taxes;
        $tax->name = $request->input('name');
        $tax->type = $request->input('type');
        $tax->rate = $request->input('rate');
        $tax->apply_on = $request->input('apply_on');
        $tax->save();

        return redirect()->route('admin.taxes.list')
        ->with('_success','Tax created successfully.');
    }
    public function edit($id){

        $this->data['tax'] = Taxes::where('id',$id)->get(); 
        if(count($this->data['tax']) > 0){
            return view($this->data['active_theme'].'/admin/taxes/edit',$this->data);
        }
        else{
            return redirect()->route('admin.taxes.list')
            ->with('error','Tax not found.');
        }
    }
    public function update(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'rate' => 'required',
            'apply_on' => 'required'
        ]);


        $tax = Taxes::find($request->input('tax_id'));
        $tax->name = $request->input('name');
        $tax->type = $request->input('type');
        $tax->rate = $request->input('rate');
        $tax->apply_on = $request->input('apply_on');
        $tax->save();

        return redirect()->route('admin.taxes.list')
        ->with('_success','Warehosue update successfully.');
        
    }
    public function destroy($id){
        Taxes::where('id',$id)->delete(); 
        return redirect()->route('admin.taxes.list')
        ->with('_success','Tax deleted successfully.');
    }

}
