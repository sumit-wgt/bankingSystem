<?php

namespace App\Http\Controllers\admin;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Traits\DataSaver;
use input;
use App\Role;

class AuthenticationController extends Controller
{
    use DataSaver;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_details = Session::get('user_details');

        if($user_details){
            return redirect(route('admin-dashboard'));
        }
        else {
            return view('admin/admin_login');
        }
    }

    public function dashboard()
    {
        return view('admin/admin_dashboard');
    }

     /**
     * this function will check admin login with correct email & password
     * @param  Request $request [description]
     * @var string
     */
    public function postLogin(Request $request)
    {

        if(($request->input('email'))&&($request->input('password')))
        {
            $email = $request->input('email');
            $password = $request->input('password');
      			$condition = [
      				'email' => $email,
      				'password' => md5($password),
      				'status' => 'active',
      			];
            $user = User::where($condition)->first();
            if(isset($user->id))
            {
                $getRole = Role::select('role_name')->where('id',$user->role_id)->get();
                $this->setUserDetailsIntoSession($user->id,$user->username,$user->email,$user->full_name,$getRole[0]->role_name);
                return redirect(route('admin-dashboard'));
            }
            else
            {
                Session::flash('alert_class', 'danger');
                Session::flash('alert_msg', 'Invalid Email/Password!');
                return view('admin/admin_login');
            }
        }
        else
        {
            return view('admin/admin_login');
        }
    }


    public function postLogout()
    {
       // $this->log('Logged Out From Admin');
        Session::flush();
        return redirect(route('admin-login'));
    }

    public function getChangePassword()
    {
      return view('admin/admin_change_password');
    }

    public function postChangePassword(Request $request)
    {
      $current_password = md5($request->input('current_password'));
      $user_details = Session::get('user_details');
      $condition = [
        'id' => $user_details['id'],
        'password' => $current_password
      ];
      $user_data = User::where($condition)->first();
      if($user_data)
      {
        $user_data->update([
          'password'   =>   md5($request->input('confirm_password')),
          'updated_at' => NOW()
        ]);
        Session::flash('success','Password has been changed');
      }
      else
      {
        Session::flash('error','Current password is wrong!');
      }
      return back();
    }

    public function pageNotFound() {
      echo "404 Error";
    }
}
