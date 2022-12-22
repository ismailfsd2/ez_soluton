<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Customers;
use App\Models\Users;


class CustomersController extends BaseController
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
        return view($this->data['active_theme'].'/admin/customers/list',$this->data);
    }
    public function data(Request $request){
        $query = Customers::select(
            'customers.*',
        );
        $query->where(function($query){
            $column_search = array(
                'customers.id',
                'customers.logo',
                'customers.name',
                'customers.phone',
                'customers.email',
                'customers.tax_payer',
                'customers.addres',
                'customers.created_at',
                'customers.status'
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
            'customers.id',
            'customers.logo',
            'customers.name',
            'customers.phone',
            'customers.email',
            'customers.tax_payer',
            'customers.addres',
            'customers.created_at',
            'customers.status'
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
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.customers.edit',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item remove-item-btn" href="'.route('admin.customers.destroy',$row->id).'" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>
                    </li>
                    </ul>
                </div>
            ';
            if($row->logo == ""){
                $image = '<img src="'.asset('assets/images/no_image.jpg').'" style="width: 100px;" >';
            }
            else{

                $image = '<img src="'.asset('uploads/customers/'.$row->logo).'" style="width: 100px;" >';
            }
            $data[] = array(
                $row->id,
                $image,
                $row->name,
                $row->phone,
                $row->email,
                $row->tax_payer == 1 ? 'Yes' : 'No',
                $row->addres,
                $row->created_at->format('Y-m-d'),
                $row->status == 1 ? 'Active' : 'Deactive',
                $button
            );
        }
        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => Customers::count(),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        // Output to JSON format
        echo json_encode($output);




        // DatatableData::data('',$request);
    }
    public function add(){
        return view($this->data['active_theme'].'/admin/customers/add',$this->data);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['email','unique:vendors','max:255'],
            'phone' => ['required'],
            'tex_payer' => ['required'],
            'address' => ['required'],
            'username' => ['required','unique:users','max:255'],
            'password' => ['required']
        ]);

        $customer = new Customers;
        if($request->file('logo')){
            $file = $request->file('logo');
            $logo = time().'_'.$file->getClientOriginalName();
            $destinationPath = 'uploads/customers';
            $file->move($destinationPath,$logo);
            $customer->logo = $logo;
        }

        $customer->name = $request->input('name');
        $customer->phone = $request->input('phone');
        $customer->email = $request->input('email');
        $customer->tax_payer = $request->input('tex_payer');
        $customer->addres = $request->input('address');
        $customer->save();

        $user = new Users;
        $user->type = 'customer';
        $user->related_id = $customer->id;
        $user->username = $request->input('username');
        $user->password = Crypt::encrypt($request->input('password'));
        $user->save();
        return redirect()->route('admin.customers.list')
        ->with('_success','Customer created successfully.');
    }
    public function edit($id){

        $this->data['user'] = Users::where('related_id',$id)->get(); 
        $this->data['customer'] = Customers::where('id',$id)->get(); 
        if(count($this->data['customer']) > 0 && count($this->data['user']) > 0){
            $this->data['user'][0]->password = Crypt::decrypt($this->data['user'][0]->password);
            return view($this->data['active_theme'].'/admin/customers/edit',$this->data);
        }
        else{
            return redirect()->route('admin.customers.list')
            ->with('error','Customer not found.');
        }
    }
    public function update(Request $request){
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['email','unique:vendors,email,'.$request->input('customer_id'),'max:255'],
            'phone' => ['required'],
            'tex_payer' => ['required'],
            'address' => ['required'],
            'username' => ['required','unique:users,username,'.$request->input('user_id'),'max:255'],
            'password' => ['required']
        ]);
        $customer = Customers::find($request->input('customer_id'));
        if($request->file('logo')){
            $file = $request->file('logo');
            $logo = time().'_'.$file->getClientOriginalName();
            $destinationPath = 'uploads/customers';
            $file->move($destinationPath,$logo);
            $customer->logo = $logo;
        }
        $customer->name = $request->input('name');
        $customer->phone = $request->input('phone');
        $customer->email = $request->input('email');
        $customer->tax_payer = $request->input('tex_payer');
        $customer->addres = $request->input('address');
        $customer->save();

        $user = Users::find($request->input('user_id'));
        $user->related_id = $customer->id;
        $user->username = $request->input('username');
        $user->password = Crypt::encrypt($request->input('password'));
        $user->save();
        return redirect()->route('admin.customers.list')
        ->with('_success','Customer updated successfully.');
        
    }
    public function destroy($id){
        Users::where('related_id',$id)->delete(); 
        Customers::where('id',$id)->delete(); 
        return redirect()->route('admin.customers.list')
        ->with('_success','Customer deleted successfully.');
    }
    public function view(){
        return view($this->data['active_theme'].'/admin/customers/view',$this->data);
    }

}
