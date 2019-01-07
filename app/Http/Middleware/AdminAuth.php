<?php

namespace App\Http\Middleware;

use Closure;
use Session;
//use App\Http\Traits\Rbac;
use App\Http\Traits\Authentication;
use App\User;

/**
 *  This is a Middleware which will validate all admin request.
 *  It use Rbac trait to access control.
 *
 *  @author Raja Chakraborty
 */
class AdminAuth
{
    //use Rbac;
    use Authentication;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$slug=null,$verify_parent = false)
    {
        if($this->isLoggedIn()){
            return $next($request);
        }
        else
        {
            Session::flash('alert_class', 'danger');
            Session::flash('alert_msg', 'Log in first');
            return redirect(route('admin-login'));
        };
    }
	public function verifyParent($request)
	{
		return true;
	}
}
