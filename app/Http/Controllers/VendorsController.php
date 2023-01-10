<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Vendors;
use App\Models\Pointofcontacts;
use App\Models\Users;


class VendorsController extends BaseController
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
        return view($this->data['active_theme'].'/admin/vendors/list',$this->data);
    }
    public function data(Request $request){
        $query = Vendors::select(
            'vendors.*',
        );
        $query->where(function($query){
            $column_search = array(
                'vendors.id',
                'vendors.logo',
                'vendors.name',
                'vendors.phone',
                'vendors.email',
                'vendors.tax_payer',
                'vendors.country',
                'vendors.state',
                'vendors.city',
                'vendors.addres',
                'vendors.note',
                'vendors.created_at',
                'vendors.status'
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
            'vendors.id',
            'vendors.logo',
            'vendors.name',
            'vendors.phone',
            'vendors.email',
            'vendors.tax_payer',
            'vendors.country',
            'vendors.state',
            'vendors.city',
            'vendors.addres',
            'vendors.note',
            'vendors.created_at',
            'vendors.status'
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
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.vendors.edit',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.vendors.poc',$row->id).'" ><i class="bx bx-user align-bottom me-2 text-muted"></i> Point of Contacts</a></li>
                        <li><a class="dropdown-item remove-item-btn" href="'.route('admin.vendors.destroy',$row->id).'" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>
                    </li>
                    </ul>
                </div>
            ';
            if($row->logo == ""){
                $image = '<img src="'.asset('assets/images/no_image.jpg').'" style="width: 100px;" >';
            }
            else{

                $image = '<img src="'.asset('uploads/vendors/'.$row->logo).'" style="width: 100px;" >';
            }
            $data[] = array(
                $row->id,
                $image,
                $row->name,
                $row->phone,
                $row->email,
                $row->tax_payer,
                $row->country,
                $row->state,
                $row->city,
                $row->addres,
                $row->note,
                $row->created_at->format('Y-m-d'),
                $row->status == 1 ? 'Active' : 'Deactive',
                $button
            );
        }
        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => Vendors::count(),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        // Output to JSON format
        echo json_encode($output);




        // DatatableData::data('',$request);
    }
    public function add(){
        return view($this->data['active_theme'].'/admin/vendors/add',$this->data);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['email','unique:vendors','max:255'],
            'phone' => ['required'],
            'tex_payer' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'address' => ['required'],
            'note' => ['required'],
            'username' => ['required','unique:users','max:255'],
            'password' => ['required']
        ]);


        $file = $request->file('logo');
        $logo = time().'_'.$file->getClientOriginalName();
        $destinationPath = 'public/uploads/vendors';
        $file->move($destinationPath,$logo);


        $vendor = new Vendors;
        $vendor->logo = $logo;
        $vendor->name = $request->input('name');
        $vendor->phone = $request->input('phone');
        $vendor->email = $request->input('email');
        $vendor->tax_payer = $request->input('tex_payer');
        $vendor->country = $request->input('country');
        $vendor->state = $request->input('state');
        $vendor->city = $request->input('city');
        $vendor->addres = $request->input('address');
        $vendor->note = $request->input('note');
        $vendor->save();

        $user = new Users;
        $user->type = 'vendor';
        $user->related_id = $vendor->id;
        $user->username = $request->input('username');
        $user->password = Crypt::encrypt($request->input('password'));
        $user->save();
        return redirect()->route('admin.vendors.list')
        ->with('_success','Vendor created successfully.');
    }
    public function edit($id){

        $this->data['user'] = Users::where('related_id',$id)->get(); 
        $this->data['vendor'] = Vendors::where('id',$id)->get(); 
        if(count($this->data['vendor']) > 0 && count($this->data['user']) > 0){
            $this->data['user'][0]->password = Crypt::decrypt($this->data['user'][0]->password);
            return view($this->data['active_theme'].'/admin/vendors/edit',$this->data);
        }
        else{
            return redirect()->route('admin.vendors.list')
            ->with('error','Vendor not found.');
        }
    }
    public function update(Request $request){
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['email','unique:vendors,email,'.$request->input('vendor_id'),'max:255'],
            'phone' => ['required'],
            'tex_payer' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'address' => ['required'],
            'note' => ['required'],
            'username' => ['required','unique:users,username,'.$request->input('user_id'),'max:255'],
            'password' => ['required']
        ]);
        $vendor = Vendors::find($request->input('vendor_id'));
        if($request->file('logo')){
            $file = $request->file('logo');
            $logo = time().'_'.$file->getClientOriginalName();
            $destinationPath = 'public/uploads/vendors';
            $file->move($destinationPath,$logo);
            $vendor->logo = $logo;
        }
        $vendor->name = $request->input('name');
        $vendor->phone = $request->input('phone');
        $vendor->email = $request->input('email');
        $vendor->tax_payer = $request->input('tex_payer');
        $vendor->country = $request->input('country');
        $vendor->state = $request->input('state');
        $vendor->city = $request->input('city');
        $vendor->addres = $request->input('address');
        $vendor->note = $request->input('note');
        $vendor->save();

        $user = Users::find($request->input('user_id'));
        $user->related_id = $vendor->id;
        $user->username = $request->input('username');
        $user->password = Crypt::encrypt($request->input('password'));
        $user->save();
        return redirect()->route('admin.vendors.list')
        ->with('_success','Vendor updated successfully.');
        
    }
    public function destroy($id){
        Users::where('related_id',$id)->delete(); 
        Vendors::where('id',$id)->delete(); 
        return redirect()->route('admin.vendors.list')
        ->with('_success','Vendor deleted successfully.');
    }
    public function view(){
        return view($this->data['active_theme'].'/admin/vendors/view',$this->data);
    }
    // Point of Contacts

    public function poc($id){
        $this->data['id'] = $id;
        return view($this->data['active_theme'].'/admin/vendors/poc',$this->data);
    }
    public function poc_data(Request $request){
        $query = Pointofcontacts::select(
            'point_of_contacts.*',
        );
        $query->where(function($query){
            $column_search = array(
                'point_of_contacts.id',
                'point_of_contacts.first_name',
                'point_of_contacts.last_name',
                'point_of_contacts.designation',
                'point_of_contacts.working_phone',
                'point_of_contacts.personal_phone',
                'point_of_contacts.email',
                'point_of_contacts.comment',
                'point_of_contacts.created_at',
                'point_of_contacts.status',
            );
            $query->where('type',1);
            $query->where('related_id', $_POST['id']);
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
            'point_of_contacts.id',
            'point_of_contacts.first_name',
            'point_of_contacts.last_name',
            'point_of_contacts.designation',
            'point_of_contacts.working_phone',
            'point_of_contacts.personal_phone',
            'point_of_contacts.email',
            'point_of_contacts.comment',
            'point_of_contacts.created_at',
            null,
            'point_of_contacts.status',
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
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.vendors.poc.edit',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item remove-item-btn" href="'.route('admin.vendors.poc.destroy',$row->id).'" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>
                    </li>
                    </ul>
                </div>
            ';
           $data[] = array(
                $row->id,
                $row->first_name,
                $row->last_name,
                $row->designation,
                $row->working_phone,
                $row->personal_phone,
                $row->email,
                $row->comment,
                $row->created_at->format('Y-m-d'),
                $row->status == 1 ? 'Active' : 'Deactive',
                $button
            );
        }
        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => vendors::count(),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        // Output to JSON format
        echo json_encode($output);
        // DatatableData::data('',$request);
    }
    public function poc_add($id){
        $this->data['related_id'] = $id;
        return view($this->data['active_theme'].'/admin/vendors/poc_add',$this->data);
    }
    public function poc_store(Request $request){
        $validated = $request->validate([
            'f_name' => ['required'],
            'l_name' => ['required'],
            'designation' => ['required'],
            'email' => ['email','unique:vendors','max:255'],
            'working_phone' => ['required'],
            'personal_phone' => ['required'],
            'comment' => ['required']
        ]);

        $poc = new Pointofcontacts;
        $related_id = $request->input('related_id');
        $poc->type = 1;
        $poc->related_id = $related_id;
        $poc->first_name = $request->input('f_name');
        $poc->last_name = $request->input('l_name');
        $poc->designation = $request->input('designation');
        $poc->working_phone = $request->input('working_phone');
        $poc->personal_phone = $request->input('personal_phone');
        $poc->email = $request->input('email');
        $poc->comment = $request->input('comment');
        $poc->save();

        return redirect()->route('admin.vendors.poc',$related_id)
        ->with('_success','Vendor point of contact created successfully.');
    }
    public function poc_edit($id){

        $this->data['poc'] = Pointofcontacts::where('id',$id)->get(); 
        if(count($this->data['poc']) > 0){
            return view($this->data['active_theme'].'/admin/vendors/poc_edit',$this->data);
        }
        else{
            return back()
            ->with('error','Vendor not found.');
        }
    }
    public function poc_update(Request $request){
        $validated = $request->validate([
            'f_name' => ['required'],
            'l_name' => ['required'],
            'designation' => ['required'],
            // 'email' => ['email','unique:point_of_contacts,email,'.$request->input('id'),'max:255'],
            'email' => ['email'],
            'working_phone' => ['required'],
            'personal_phone' => ['required']
        ]);
        $poc = Pointofcontacts::find($request->input('id'));
        $poc->first_name = $request->input('f_name');
        $poc->last_name = $request->input('l_name');
        $poc->designation = $request->input('designation');
        $poc->working_phone = $request->input('working_phone');
        $poc->personal_phone = $request->input('personal_phone');
        $poc->email = $request->input('email');
        $poc->comment = $request->input('comment');
        $poc->save();
        return back()
        ->with('_success','Vendor poc updated successfully.');
    }
    public function poc_destroy($id){
        Pointofcontacts::where('id',$id)->delete(); 
        return back()
        ->with('_success','Vendor point of contact deleted successfully.');
    }

}
