<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Http\Controllers\BaseController;

class AdminMiddleware extends BaseController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Session::has('AdminSession')) {
            return redirect()->route('login');
    
        }
        else{
            $adminid = Session::get('AdminSession');
            $this->data['autdata'] = Users::find($adminid);
        }
        return $next($request);
    }
}
