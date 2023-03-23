<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Session;
use App\Models\Users;
use App\Models\Customers;
use App\Models\Employees;
use App\Models\Vendors;
use Mail;
use App\Mail\ForgetPassword;

class LoginController extends BaseController
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
        if(Session::has('AdminSession')) {
            return redirect()->route('admin.dashboard');
        }
        else{
            return view($this->data['active_theme'].'/login',$this->data);
        }
    }
    public function submit(Request $request){
        $user = Users::where('username',$request->username)->get();
        if(count($user) == 0){
            return redirect()->route('login')
            ->with('_error','Username not found.');
        }
        else{
            $password = Crypt::decrypt($user[0]->password);
            if($password != $request->password){
                return redirect()->route('login')
                ->with('_error','Password not match');
            }
            else{
                if($user[0]->status == 1){
                    if($user[0]->type == "employee"){
                        Session::put('AdminSession',$user[0]->id);
                        return redirect()->route('admin.dashboard')
                        ->with('_success','Welcome to EZ Solution Dashboard.');
                    }
                    else if($user[0]->type == "vendor"){
                        Session::put('VendorSession',$user[0]->id);
                        return redirect()->route('vendor.dashboard')
                        ->with('_success','Welcome to EZ Solution Dashboard.');
                    }
                    else if($user[0]->type == "customer"){
                        Session::put('CustomerSession',$user[0]->id);
                        return redirect()->route('customer.dashboard')
                        ->with('_success','Welcome to EZ Solution Dashboard.');
                    }
                    else{
                        return redirect()->route('login')
                        ->with('_error','User type invalid!');
                    }
                }
                else{
                    return redirect()->route('login')
                    ->with('_error','Your account deactive');
                }
            }
        }
    }
    public function logout(){
        Session::forget('AdminSession');
        return redirect()->route('login');
    }
    public function forget_password(){
        if(Session::has('AdminSession')) {
            return redirect()->route('admin.dashboard');
        }
        else{
            return view($this->data['active_theme'].'/forget_password',$this->data);
        }
    }
    public function forget_password_submit(Request $request){
        $user = Users::where('username',$request->username)->get();
        if(count($user) == 0){
            return redirect()->route('login')
            ->with('_error','Try Again.');
        }
        else{
            $related = false;
            if($user[0]->type == "employee"){
                $related = Employees::where('id',$user[0]->related_id)->get();
            }
            else if($user[0]->type == "customer"){
                $related = Customers::where('id',$user[0]->related_id)->get();
            }
            else if($user[0]->type == "vendor"){
                $related = Vendors::where('id',$user[0]->related_id)->get();
            }
            if($related){
                if(count($related) > 0){
                    $email = [
                        'title' => 'Foreget Password Request',
                        'body' => 'Forget password link: '
                    ];
                    Mail::to($related[0]->email)->send(new ForgetPassword($email));
                }
                else{
                    return redirect()->route('login')
                    ->with('_error','Try Again.');
                }
            }
            else{
                return redirect()->route('login')
                ->with('_error','Try Again.');
            }
        }

    }

}
