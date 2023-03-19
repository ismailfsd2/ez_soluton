<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Documents;


class DocumentsController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }
    public function index($id,Request $request){

        $this->data['type'] = $request->segment(2);
        $this->data['relative_id'] = $id;
        $this->data['documents'] = Documents::where('type',$this->data['type'])->where('related_id',$this->data['relative_id'])->get();
        return view($this->data['active_theme'].'/admin/documents/list',$this->data);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title' => ['required']
        ]);
        if($request->hasFile('file')){
            $file = $request->file('file');
            $logo = time().'_'.$file->getClientOriginalName();
            $destinationPath = 'public/uploads/documents/';
            $file->move($destinationPath,$logo);

            $document = new Documents;
            $document->type = $request->type;
            $document->related_id = $request->relative_id;
            $document->title = $request->title;
            $document->file_url = $logo;
            $document->file_type = $file->getClientOriginalExtension();
            $document->file_size = 0;
            $document->save();

            return redirect()->route('admin.vendors.documents',$request->relative_id)
            ->with('_success','Vendor document uploaded.');

        }




    }
    public function destroy($id){
        Documents::where('id',$id)->delete(); 
        return Redirect::back()
        ->with('_success','Document deleted.');
        
    }

}
