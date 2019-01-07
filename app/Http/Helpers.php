<?php
use App\Module;
use App\Permission;

function aa($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
	die;
}

function getCurrentUrl($param_number)
{
	$url = explode('/',Request::url());
	return $url[$param_number];
}

function uniqueCheck($table_name,$field_name,$field_value,$id = null)
{
	if(isset($id) || $id != null)
	{
		$data = DB::table($table_name)->where($field_name,$field_value)->where('id','!=',$id)->count();
	}
	else
	{
		$data = DB::table($table_name)->where($field_name,$field_value)->count();
	}
	return $data;
}

function getModuleList() {
	$userDetails = Session::get('user_details');
    $getModulesList = Permission::select('modules.id','modules.module_name','modules.module_slug','modules.module_icon')->leftJoin('modules','modules.id','=','permissions.module_id')->where('permissions.user_id',$userDetails['id'])->orderBy('module_id','ASC')->get();
    return $getModulesList;
}

function checkModulePermission($userId,$moduleId) {
	$getPermission = Permission::select('*')->where([['user_id',$userId],['module_id',$moduleId]])->get()->toArray();
	if(empty($getPermission)) {
		return abort(404);
	} else {
		return $getPermission;
	}
}

function mailSendingMethodToUser($tableName,$condition,$data) {
	$user_details = Session::get('user_details');
	$adminEmailId = $user_details['email'];
	$getEmailTemplate = DB::table($tableName)->select('*')->where($condition)->get();
	$msg = preg_replace("/&#?[a-z0-9]+;/i","",$getEmailTemplate[0]->body);
	$msg = str_replace("{{ user }}",$data['full_name'],$msg);
    $msg = str_replace("{{ username }}",$data['username'],$msg);
    $msg = str_replace("{{ email }}",$data['email'],$msg);
    $msg = str_replace("{{ password }}",$data['password'],$msg);
	
	$email = $data['email'];
    $data['msg'] = $msg;
    Mail::send('email.mail', $data, function($message) use($getEmailTemplate,$email,$adminEmailId){
         $message->to($email)->subject($getEmailTemplate[0]->subject);
         $message->from($adminEmailId,'Innovious Banking');
     });
    
}

function mailSendingMethodToAdmin($tableName,$condition,$data) {
	$user_details = Session::get('user_details');
	$adminEmailId = $user_details['email'];
	$getEmailTemplate = DB::table($tableName)->select('*')->where($condition)->get();
	$msg = preg_replace("/&#?[a-z0-9]+;/i","",$getEmailTemplate[0]->body);
	$msg = str_replace("{{ full_name }}",$user_details['full_name'],$msg);
    $msg = str_replace("{{ user_name }}",$data['full_name'],$msg);
    
    $data['msg'] = $msg;
    Mail::send('email.mail', $data, function($message) use($getEmailTemplate,$adminEmailId){
         $message->to($adminEmailId)->subject($getEmailTemplate[0]->subject);
         $message->from($adminEmailId,'Innovious Banking');
    });
    
}
?>
