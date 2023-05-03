<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Conversations;


class ConversationController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }
    public function syn_data(Request $request){
        $query = Conversations::select(
            'conversations.*',
            'users.type as user_type',
            DB::raw('CONCAT(employees.first_name," ",employees.last_name) as employee'),
            'vendors.name as vendor',
            'customers.name as customer'
        );
        $query->join('users', 'users.id', '=', 'conversations.user_id');
        $query->leftJoin('employees', 'employees.id', '=', 'users.related_id');
        $query->leftJoin('vendors', 'vendors.id', '=', 'users.related_id');
        $query->leftJoin('customers', 'customers.id', '=', 'users.related_id');
        if($this->data['autdata']->type == "customer" || $this->data['autdata']->type == "vendor"){
            $query->where('conversations.only_staff',0);
        }
        $query->where('conversations.type',1);
        $query->where('conversations.relative_id',$request->id);
        $this->data['rows'] = $query->get();
        return view($this->data['active_theme'].'/conversations/messages',$this->data);


    }
    public function send_message(Request $request){
        $data['status'] = false;
        $conversation = new Conversations;
        $conversation->type = $request->type;
        $conversation->relative_id = $request->id;
        $conversation->user_id = $this->data['autdata']->id;
        $conversation->only_staff = $request->intenal_message;
        $conversation->message = $request->message;
        $conversation->save();
        $data['status'] = true;
        $data['message'] = "Message Send";
        echo json_encode($data);

    }

}
