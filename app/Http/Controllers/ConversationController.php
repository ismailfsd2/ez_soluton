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
    public function syn_data(){
        $this->data['rows'] = Conversations::select('c.*','customers.name as customer')
                                ->join('users', 'users.id', '=', 'c.relative_id')
                                ->join('employees', 'employees.id', '=', 'users.relative_id')
                                ->join('vendors', 'vendors.id', '=', 'users.relative_id')
                                ->join('customers', 'customers.id', '=', 'users.relative_id')
                                ->orderBy('quotations.date','desc')
                                ->get();
        return view($this->data['active_theme'].'/conversations/messages',$this->data);


    }
    public function send_message(Request $request){
        $conversation = new Conversations;
        $conversation->type = "1";
        $conversation->relative_id = $request->id;
        $conversation->user_id = $this->data['autdata']->id;
        $conversation->only_staff = $request->marked_private;
        $conversation->message = $request->message;
        $conversation->save();
    }

}
