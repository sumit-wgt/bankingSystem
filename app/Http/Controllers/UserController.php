<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Module;
use Session;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |Here all Listing, Add and Delete functionality of all available
    |users will be done.
    |
    */

    public function index() {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
        //check module id from module table
        $checkUserModuleId = Module::select('id','module_name','module_slug')->where('module_slug','user')->get();
        //check logged user permission on user module
        $checkedPermission = checkModulePermission($userDetails['id'],$checkUserModuleId[0]->id);
        //user list accoding to logged role
        $getRole = User::select('role_id')->where([['id',$userDetails['id']],['deleted_by',NULL]])->get();
        if($getRole[0]->role_id == 1) {
            $getUserDetails = User::select('*')->where('deleted_by',NULL)->get();
        } elseif ($getRole[0]->role_id == 2) {
            $getUserDetails = User::select('*')->where([['role_id','!=',1],['deleted_by',NULL]])->get();
        } elseif ($getRole[0]->role_id == 3) {
            $getUserDetails = User::select('*')->where([['role_id',3],['deleted_by',NULL]])->get();
        }
        
    	return view('user.list',compact('getUserDetails','checkedPermission'));
    }

    public function userAdd() {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
        $getRoles = Role::select('*')->where('deleted_by',NULL)->get();
    	return view('user.add',compact('getRoles'));
    }

    // public function userSuggestion(Request $request) {
    //     $keyword = $request->input('keyword');
    //     $search = User::select('id')->where('email',$keyword)->get();
    //     if(count($search) > 0) {
    //         echo $search[0]->id;
    //     } else {
    //         echo '0';
    //     }
    // }

    // Ajax user suggestion check
    public function userSuggestion(Request $request) {
        $keyword = $request->input('keyword');
        $search = User::select('id','email')->where('email', 'like', "%{$keyword}%")->get();
        if(count($search) > 0) {
            //echo $search[0]->id;
            //echo json_encode($search);
            $output = '<ul class="dropdown-menu size_control"" style="display:block; position:relative">';
            foreach($search as $row)
            {
             $output .= '
             <li style="padding-left:12px;" class="userEmail"><a href="javascript:void(0)" onclick="getSuggestion()">'.$row->email.'</a></li>
             ';
            }
            $output .= '</ul>';
            echo $output;
        } else {
            echo '0';
        }
    }
    // Ajax user suggestion check
    public function userSuggestionId(Request $request) {
      $email = $request->input('email');
      $search = User::select('id')->where('email',$email)->get();
      if(count($search) > 0) {
          echo $search[0]->id;
      } else {
          echo '0';
      }
    }

    public function userInsert(Request $request) {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
        $param = array('full_name'=>$request->input('full_name'),'username'=>$request->input('username'),'password'=>$request->input('password'),'email'=>$request->input('email'));
    	$data = array('role_id'=>$request->input('role_id'),
                      'parent_id'=>$request->input('parent_id'),
                      'full_name'=>$request->input('full_name'),
    				  'username'=>$request->input('username'),
    				  'email'=>$request->input('email'),
    				  'mobile'=>$request->input('mobile'),
    				  'password'=>md5($request->input('password')),
                      'created_by'=>$userDetails['id'],
    				  'created_at'=>date('Y-m-d H:i:s')
    				  );
    	$insert = User::insert($data);
        //send mail to added user
        $tableName = 'email_templates';
        $condition = array('template_name'=> 'Welcome mail'); 
        mailSendingMethodToUser($tableName,$condition,$param);
        //send mail to admin
        $where = array('template_name'=> 'User added');
        mailSendingMethodToAdmin($tableName,$where,$param);

        Session::flash('success','User has been added');
        return redirect()->route('user');
    }

    public function changeStatus($id) {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
        $state = User::find($id);
        if(empty($state)) {
            return abort(404);
        } else {
            $status = $state->status == 'active' ? 'inactive' : 'active';
            $state->update([
              'status'   =>   $status,
              'updated_by'=>$userDetails['id'],
              'updated_at' => date("Y-m-d H:i:s")
            ]);
        }

        Session::flash('success','Status has been changed');
        return back();
    }

    public function edit($id) {
        if($id == '') {
            return redirect('/');
        }
        $getRoles = Role::select('*')->where('deleted_by',NULL)->get();
        $getData =  User::find($id);
        if(empty($getData)) {
            return abort(404);
        }
        $getAdminDetails =  User::find($getData->parent_id);
        return view('user.edit',compact('getRoles','getData','getAdminDetails'));
    }

    public function update(Request $request) {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
        $userId = $request->input('userId');
        $data = array('role_id'=>$request->input('role_id'),
                      'parent_id'=>$request->input('parent_id'),
                      'full_name'=>$request->input('full_name'),
                      'username'=>$request->input('username'),
                      'email'=>$request->input('email'),
                      'mobile'=>$request->input('mobile'),
                      'updated_by'=>$userDetails['id'],
                      'updated_at'=>date('Y-m-d H:i:s')
                      );
        $updateData = User::where('id',$userId)->update($data);
        Session::flash('success','User has been updated');
        return redirect()->route('user-edit',['id'=>$userId]);
    }

    public function destroy($id) {
        if($id == '') {
            return abort(404);
        }
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
        $data        = array('deleted_by'=>$userDetails['id'],
                             'deleted_at'=>date("Y-m-d H:i:s")
                            );
        $deleteData = User::where('id',$id)->update($data);
        Session::flash('success','User has been deleted');
        return back();
    }
}
