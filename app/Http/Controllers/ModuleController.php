<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use Session;

class ModuleController extends Controller
{
    public function index() {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
    	$getModule = Module::select('*')->where('deleted_by',NULL)->get();
    	return view('module.list',compact('getModule'));
    }

    public function Add() {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
    	return view('module.add');
    }

    public function Insert(Request $request) {
    	$userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
    	$data = array('module_name'=>$request->input('module_name'),
                      'module_slug'=>$request->input('module_slug'),
                      'module_icon'=>$request->input('module_icon'),
    				  'status'=>$request->input('status'),
    				  'created_by'=>$userDetails['id'],
    				  'created_at'=>date('Y-m-d H:i:s')
    				  );
    	$insert = Module::insert($data);
    	if($insert == true) {
    		Session::flash('success','Module has been added');
        	return redirect()->route('module-list');
    	}
    }

    public function Status($id) {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
        $state = Module::find($id);
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

    public function Edit($id) {
        $getData = Module::find($id);
        if(empty($getData)) {
            return abort(404);
        }
        return view('module.edit',compact('getData'));
    }

    public function Update(Request $request) {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
        $moduleId = $request->input('moduleId');
        $data = array('module_name'=>$request->input('module_name'),
                      'module_slug'=>$request->input('module_slug'),
                      'module_icon'=>$request->input('module_icon'),
                      'status'=>$request->input('status'),
                      'updated_by'=>$userDetails['id'],
                      'updated_at'=>date("Y-m-d H:i:s")
                      );
        $updateData = Module::where('id',$moduleId)->update($data);
        Session::flash('success','Module has been updated');
        return redirect()->route('module-edit',['id'=>$moduleId]);
    }

    public function Delete($id) {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
        if(empty($id)) {
            return abort(404);
        }
        $data        = array('deleted_by'=>$userDetails['id'],
                             'deleted_at'=>date("Y-m-d H:i:s")
                            );
        $deleteData = Module::where('id',$id)->update($data);
        Session::flash('success','Module has been deleted');
        return back();
    }
    
}
