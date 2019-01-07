<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailTemplate;
use Session;

class EmailTemplateController extends Controller
{
    public function index() {
    	$userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
    	$getTemplateList = EmailTemplate::where([['deleted_by',NULL]])->get();
    	return view('emailTemplate.list',compact('getTemplateList'));
    }

    public function add() {
    	$userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
    	return view('emailTemplate.add');
    }

    public function insert(Request $request) {
    	$userDetails = Session::get('user_details');
    	$data = array('template_name'=>$request->input('template_name'),
    				  'subject'=>$request->input('subject'),
    				  'body'=>$request->input('content'),
    				  'status'=>$request->input('status'),
    				  'created_by'=>$userDetails['id'],
    				  'created_at'=>date('Y-m-d H:i:s')
    				  );
    	$insert = EmailTemplate::insert($data);
    	Session::flash('success','Email template has been added');
        return redirect()->route('email-template-list');
    }

    public function status($id) {
    	$userDetails = Session::get('user_details');
    	$state = EmailTemplate::find($id);
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
        $getData =  EmailTemplate::find($id);
        if(empty($getData)) {
            return abort(404);
        } else {
        	return view('emailTemplate.edit',compact('getData'));
        }
    }

    public function update(Request $request) {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
        $templateId = $request->input('template_id');
        $data = array('template_name'=>$request->input('template_name'),
    				  'subject'=>$request->input('subject'),
    				  'body'=>$request->input('content'),
    				  'status'=>$request->input('status'),
    				  'updated_by'=>$userDetails['id'],
                      'updated_at'=>date('Y-m-d H:i:s')
    				  );
        $updateData = EmailTemplate::where('id',$templateId)->update($data);
        Session::flash('success','Email template has been updated');
        return redirect()->route('email-template-edit',['id'=>$templateId]);
    }

    public function destroy($id) {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
        $data = array('deleted_by'=>$userDetails['id'],
                      'deleted_at'=>date("Y-m-d H:i:s")
                      );
        $deleteData = EmailTemplate::where('id',$id)->update($data);
        Session::flash('success','Email template has been deleted');
        return back();
    }
}
