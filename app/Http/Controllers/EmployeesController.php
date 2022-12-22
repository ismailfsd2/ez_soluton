<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Employees;
use App\Models\Users;


class EmployeesController extends BaseController
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
        return view($this->data['active_theme'].'/admin/employees/list',$this->data);
    }
    public function data(Request $request){
        $query = Employees::select(
            'employees.*',
        );
        $query->where(function($query){
            $column_search = array(
                'employees.id',
                'employees.first_name',
                'employees.last_name',
                'employees.phone',
                'employees.email',
                'employees.created_at',
                'employees.status'
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
            'employees.id',
            'employees.first_name',
            'employees.last_name',
            'employees.phone',
            'employees.email',
            'employees.created_at',
            'employees.status'
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
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.employees.edit',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item remove-item-btn" href="'.route('admin.employees.destroy',$row->id).'" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>
                    </li>
                    </ul>
                </div>
            ';
            $data[] = array(
                $row->id,
                $row->first_name,
                $row->last_name,
                $row->phone,
                $row->email,
                $row->created_at->format('d-M-Y'),
                $row->status = 1 ? "Active" : "Deactive",
                $button
            );
        }
        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => Employees::count(),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        // Output to JSON format
        echo json_encode($output);




        // DatatableData::data('',$request);
    }
    public function add(){
        return view($this->data['active_theme'].'/admin/employees/add',$this->data);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'email|unique:employees|max:255',
            'phone' => 'required',
            'username' => 'required|unique:users|max:255',
            'password' => 'required|min:8'
        ]);

        $employee = new Employees;
        $employee->first_name = $request->input('fname');
        $employee->last_name = $request->input('lname');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->save();

        $user = new Users;
        $user->type = 'employee';
        $user->related_id = $employee->id;
        $user->username = $request->input('username');
        $user->password = Crypt::encrypt($request->input('password'));
        $user->save();
        return redirect()->route('admin.employees.list')
        ->with('_success','Employee created successfully.');
    }
    public function edit($id){

        $this->data['user'] = Users::where('related_id',$id)->get(); 
        $this->data['employee'] = Employees::where('id',$id)->get(); 
        if(count($this->data['employee']) > 0 && count($this->data['user']) > 0){
            $this->data['user'][0]->password = Crypt::decrypt($this->data['user'][0]->password);
            return view($this->data['active_theme'].'/admin/employees/edit',$this->data);
        }
        else{
            return redirect()->route('admin.employees.list')
            ->with('error','Employee not found.');
        }
    }
    public function update(Request $request){

        $validated = $request->validate([
            'fname' => ['required'],
            'lname' => ['required'],
            'email' => ['email','unique:employees,email,'.$request->input('employee_id'),'max:255'],
            'phone' => ['required'],
            'username' => ['required','unique:users,username,'.$request->input('user_id'),'max:255'],
            'password' => ['required']
        ]);

        $employee = Employees::find($request->input('employee_id'));
        $employee->first_name = $request->input('fname');
        $employee->last_name = $request->input('lname');
        $employee->email = $request->input('email');
        $employee->phone = $request->input('phone');
        $employee->save();

        $user = Users::find($request->input('user_id'));
        $user->type = 'employee';
        $user->related_id = $employee->id;
        $user->username = $request->input('username');
        $user->password = Crypt::encrypt($request->input('password'));
        $user->save();
        return redirect()->route('admin.employees.list')
        ->with('_success','Employee update successfully.');
        
    }
    public function destroy($id){
        Users::where('related_id',$id)->delete(); 
        Employees::where('id',$id)->delete(); 
        return redirect()->route('admin.employees.list')
        ->with('_success','Employee deleted successfully.');
    }
    public function view(){
        return view($this->data['active_theme'].'/admin/employees/view',$this->data);
    }

}
