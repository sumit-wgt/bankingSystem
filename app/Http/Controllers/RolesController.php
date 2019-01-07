<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Session;

class RolesController extends Controller
{
    /**
	 *  Roles will be created, updated and deleted 
	 *	from this controller
	 *  
	 */

    public function index() {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
    	$getRoles = Role::select('*')->where('deleted_by',NULL)->get();
        return view('roles.list',compact('getRoles'));
    }

    public function roleAdd() {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
    	return view('roles.add');
    }

    public function roleInsert(Request $request) {
    	$userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
    	$data = array('role_name'=>$request->input('role_name'),
    				  'is_admin'=>$request->input('is_admin'),
    				  'site_admin'=>$request->input('site_admin'),
    				  'status'=>$request->input('status'),
    				  'created_by'=>$userDetails['id'],
    				  'updated_by'=>$userDetails['id'],
    				  'created_at'=>date("Y-m-d H:i:s"),
    				  'updated_at'=>date("Y-m-d H:i:s"),
    				  );
    	$insert = Role::insert($data);
    	Session::flash('success','Role has been added');
      	return redirect()->route('roles-list');
    }

    public function roleEdit($id) {
        if($id == '') {
            return abort(404);
        }
    	$getData = Role::find($id);
        if(empty($getData)) {
            return abort(404);
        }
    	return view('roles.edit',compact('getData'));
    }

    public function roleUpdate(Request $request) {
    	$userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
    	$roleId = $request->input('roleId');
    	$data = array('role_name'=>$request->input('role_name'),
    				  'is_admin'=>$request->input('is_admin'),
    				  'site_admin'=>$request->input('site_admin'),
    				  'status'=>$request->input('status'),
    				  'updated_by'=>$userDetails['id'],
    				  'updated_at'=>date("Y-m-d H:i:s")
    				  );
    	$updateData = Role::where('id',$roleId)->update($data);
    	Session::flash('success','Role has been updated');
      	return redirect()->route('roles-edit',['id'=>$roleId]);
    }

    public function roleStatus($id) {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
        $state = Role::find($id);
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

    public function roleDelete($id) {
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
        $deleteData = Role::where('id',$id)->update($data);
        Session::flash('success','Role has been deleted');
        return back();
    }
}
