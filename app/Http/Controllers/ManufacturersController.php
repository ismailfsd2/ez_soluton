<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Manufacturers;
use App\Models\Pointofcontacts;
use App\Models\Users;


class ManufacturersController extends BaseController
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
        return view($this->data['active_theme'].'/admin/manufacturers/list',$this->data);
    }
    public function data(Request $request){
        $query = Manufacturers::select(
            'manufacturers.*',
        );
        $query->where(function($query){
            $column_search = array(
                'manufacturers.id',
                'manufacturers.logo',
                'manufacturers.name',
                'manufacturers.phone',
                'manufacturers.email',
                'manufacturers.tax_payer',
                'manufacturers.country',
                'manufacturers.state',
                'manufacturers.city',
                'manufacturers.addres',
                'manufacturers.fda_licenses',
                'manufacturers.note',
                'manufacturers.created_at',
                'manufacturers.status'
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
            'manufacturers.id',
            'manufacturers.logo',
            'manufacturers.name',
            'manufacturers.phone',
            'manufacturers.email',
            'manufacturers.tax_payer',
            'manufacturers.country',
            'manufacturers.state',
            'manufacturers.city',
            'manufacturers.addres',
            'manufacturers.fda_licenses',
            'manufacturers.note',
            'manufacturers.created_at',
            'manufacturers.status'
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
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.manufacturers.edit',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.manufacturers.poc',$row->id).'" ><i class="bx bx-user align-bottom me-2 text-muted"></i> Point of Contacts</a></li>
                        <li><a class="dropdown-item remove-item-btn" href="'.route('admin.manufacturers.destroy',$row->id).'" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>
                    </li>
                    </ul>
                </div>
            ';
            if($row->logo == ""){
                $image = '<img src="'.asset('assets/images/no_image.jpg').'" style="width: 100px;" >';
            }
            else{

                $image = '<img src="'.asset('uploads/manufacturers/'.$row->logo).'" style="width: 100px;" >';
            }
            $data[] = array(
                $row->id,
                $image,
                $row->name,
                $row->phone,
                $row->email,
                $row->tax_payer == 1 ? "Yes" : "No",
                $row->country,
                $row->state,
                $row->city,
                $row->fda_licenses,
                $row->addres,
                $row->note,
                $row->created_at->format('Y-m-d'),
                $row->status == 1 ? 'Active' : 'Deactive',
                $button
            );
        }
        $output = array(
            "draw" => $request->draw,
            "recordsTotal" => Manufacturers::count(),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        // Output to JSON format
        echo json_encode($output);




        // DatatableData::data('',$request);
    }
    public function add(){
        return view($this->data['active_theme'].'/admin/manufacturers/add',$this->data);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['email','unique:manufacturers','max:255'],
            'phone' => ['required'],
            'tex_payer' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'address' => ['required'],
            'username' => ['required','unique:users','max:255'],
            'password' => ['required']
        ]);


        $file = $request->file('logo');
        $logo = time().'_'.$file->getClientOriginalName();
        $destinationPath = 'public/uploads/manufacturers';
        $file->move($destinationPath,$logo);


        $manufacturer = new Manufacturers;
        $manufacturer->logo = $logo;
        $manufacturer->name = $request->input('name');
        $manufacturer->phone = $request->input('phone');
        $manufacturer->email = $request->input('email');
        $manufacturer->tax_payer = $request->input('tex_payer');
        $manufacturer->country = $request->input('country');
        $manufacturer->state = $request->input('state');
        $manufacturer->city = $request->input('city');
        $manufacturer->addres = $request->input('address');
        $manufacturer->fda_licenses = $request->input('fda_licenses');
        $manufacturer->note = $request->input('note');
        $manufacturer->save();

        $user = new Users;
        $user->type = 'manufacturer';
        $user->related_id = $manufacturer->id;
        $user->username = $request->input('username');
        $user->password = Crypt::encrypt($request->input('password'));
        $user->save();
        return redirect()->route('admin.manufacturers.list')
        ->with('_success','Manufacturer created successfully.');
    }
    public function edit($id){

        $this->data['user'] = Users::where('related_id',$id)->get(); 
        $this->data['manufacturer'] = Manufacturers::where('id',$id)->get(); 
        if(count($this->data['manufacturer']) > 0 && count($this->data['user']) > 0){
            $this->data['user'][0]->password = Crypt::decrypt($this->data['user'][0]->password);
            return view($this->data['active_theme'].'/admin/manufacturers/edit',$this->data);
        }
        else{
            return redirect()->route('admin.manufacturers.list')
            ->with('error','Manufacturer not found.');
        }
    }
    public function update(Request $request){
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['email','unique:manufacturers,email,'.$request->input('manufacturer_id'),'max:255'],
            'phone' => ['required'],
            'tex_payer' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'address' => ['required'],
            'username' => ['required','unique:users,username,'.$request->input('user_id'),'max:255'],
            'password' => ['required']
        ]);
        $manufacturer = Manufacturers::find($request->input('manufacturer_id'));
        if($request->file('logo')){
            $file = $request->file('logo');
            $logo = time().'_'.$file->getClientOriginalName();
            $destinationPath = 'public/uploads/manufacturers';
            $file->move($destinationPath,$logo);
            $manufacturer->logo = $logo;
        }
        $manufacturer->name = $request->input('name');
        $manufacturer->phone = $request->input('phone');
        $manufacturer->email = $request->input('email');
        $manufacturer->tax_payer = $request->input('tex_payer');
        $manufacturer->country = $request->input('country');
        $manufacturer->state = $request->input('state');
        $manufacturer->city = $request->input('city');
        $manufacturer->addres = $request->input('address');
        $manufacturer->fda_licenses = $request->input('fda_licenses');
        $manufacturer->note = $request->input('note');
        $manufacturer->save();

        $user = Users::find($request->input('user_id'));
        $user->related_id = $manufacturer->id;
        $user->username = $request->input('username');
        $user->password = Crypt::encrypt($request->input('password'));
        $user->save();
        return redirect()->route('admin.manufacturers.list')
        ->with('_success','Manufacturer updated successfully.');
        
    }
    public function destroy($id){
        Users::where('related_id',$id)->delete(); 
        Manufacturers::where('id',$id)->delete(); 
        return redirect()->route('admin.manufacturers.list')
        ->with('_success','Manufacturer deleted successfully.');
    }
    public function view(){
        return view($this->data['active_theme'].'/admin/manufacturers/view',$this->data);
    }
    // Point of Contacts

    public function poc($id){
        $this->data['id'] = $id;
        return view($this->data['active_theme'].'/admin/manufacturers/poc',$this->data);
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
            $query->where('type',3);
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
                        <li><a class="dropdown-item edit-item-btn" href="'.route('admin.manufacturers.poc.edit',$row->id).'" ><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                        <li><a class="dropdown-item remove-item-btn" href="'.route('admin.manufacturers.poc.destroy',$row->id).'" ><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>
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
            "recordsTotal" => Manufacturers::count(),
            "recordsFiltered" => count($data),
            "data" => $data
        );
        // Output to JSON format
        echo json_encode($output);
        // DatatableData::data('',$request);
    }
    public function poc_add($id){
        $this->data['related_id'] = $id;
        return view($this->data['active_theme'].'/admin/manufacturers/poc_add',$this->data);
    }
    public function poc_store(Request $request){
        $validated = $request->validate([
            'f_name' => ['required'],
            'l_name' => ['required'],
            'designation' => ['required'],
            'email' => ['email','unique:manufacturers','max:255'],
            'working_phone' => ['required'],
            'personal_phone' => ['required'],
            'comment' => ['required']
        ]);

        $poc = new Pointofcontacts;
        $related_id = $request->input('related_id');
        $poc->type = 3;
        $poc->related_id = $related_id;
        $poc->first_name = $request->input('f_name');
        $poc->last_name = $request->input('l_name');
        $poc->designation = $request->input('designation');
        $poc->working_phone = $request->input('working_phone');
        $poc->personal_phone = $request->input('personal_phone');
        $poc->email = $request->input('email');
        $poc->comment = $request->input('comment');
        $poc->save();

        return redirect()->route('admin.manufacturers.poc',$related_id)
        ->with('_success','Manufacturer point of contact created successfully.');
    }
    public function poc_edit($id){

        $this->data['poc'] = Pointofcontacts::where('id',$id)->get(); 
        if(count($this->data['poc']) > 0){
            return view($this->data['active_theme'].'/admin/manufacturers/poc_edit',$this->data);
        }
        else{
            return back()
            ->with('error','Manufacturer not found.');
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
        ->with('_success','Manufacturer poc updated successfully.');
    }
    public function poc_destroy($id){
        Pointofcontacts::where('id',$id)->delete(); 
        return back()
        ->with('_success','Manufacturer point of contact deleted successfully.');
    }

}
