<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\User;
use App\Module;
use Session;

class PermissionController extends Controller
{
    public function index()  {
        $userDetails = Session::get('user_details');
        if(empty($userDetails)) {
            return redirect('/');
        }
        $checkRoles = Role::select('roles.id','role_name')->leftJoin('users','users.role_id','=','roles.id')->where('users.id',$userDetails['id'])->get();
        //==============checked logged user role==========================// 
        if($checkRoles[0]->role_name == 'Superadmin') {
            $getRoles = Role::select('id','role_name')->where([['status','active'],['deleted_by',NULL]])->get();
        } elseif ($checkRoles[0]->role_name == 'Admin') {
            $getRoles = Role::select('id','role_name')->where([['role_name','!=','Superadmin'],['status','active'],['deleted_by',NULL]])->get();
        } elseif ($checkRoles[0]->role_name == 'User') {
            $getRoles = Role::select('id','role_name')->where([['role_name','!=','Superadmin'],['role_name','!=','Admin'],['status','active'],['deleted_by',NULL]])->get();
        }
        //==============checked logged user role end==========================//
        $getRoleName = User::select('id','full_name')->where([['role_id',$getRoles[0]->id],['status','active'],['deleted_by',NULL]])->get();
        // aa($getRoleName);
        $getModules = Module::select('id','module_name')->where([['status','active'],['deleted_by',NULL]])->get();
        //when page will be loaded this section will work on the basis of first selected user==============//
        $permissionDetails = $this->getPermissionData($getRoleName[0]->id,$getRoles[0]->id);
    	return view('permission.view',compact('getRoles','getRoleName','getModules','permissionDetails'));
    }

    function setPermission($method,$userDetails,$roleId,$value,$moduleId,$userId) {
        if($method == 'can_add') {
            $data = array('user_id'=>$userId,
                          'role_id'=>$roleId,
                          'module_id'=>$moduleId,
                          'can_add'=>$value,
                          'created_by'=>$userDetails['id'],
                          'created_at'=>date("Y-m-d H:i:s")
                          );
            $checkTable = Permission::select('*')->where([['user_id',$userId],['module_id',$moduleId]])->get()->toArray();
            if(!empty($checkTable)) {
                $data = array('user_id'=>$userId,
                              'role_id'=>$roleId,
                              'module_id'=>$moduleId,
                              'can_add'=>$value,
                              'updated_by'=>$userDetails['id'],
                              'updated_at'=>date("Y-m-d H:i:s")
                            );
                $update = Permission::where([['user_id',$userId],['module_id',$moduleId]])->update($data);
                if($update == true) {
                    return true;
                }
            } else {
                $create = Permission::insert($data);
                if($create == true) {
                    return true;
                }
            }
        } elseif ($method == 'can_edit') {
            $data = array('user_id'=>$userId,
                          'role_id'=>$roleId,
                          'module_id'=>$moduleId,
                          'can_edit'=>$value,
                          'created_by'=>$userDetails['id'],
                          'created_at'=>date("Y-m-d H:i:s")
                          );
            $checkTable = Permission::select('*')->where([['user_id',$userId],['module_id',$moduleId]])->get()->toArray();
            if(!empty($checkTable)) {
                $data = array('user_id'=>$userId,
                              'role_id'=>$roleId,
                              'module_id'=>$moduleId,
                              'can_edit'=>$value,
                              'updated_by'=>$userDetails['id'],
                              'updated_at'=>date("Y-m-d H:i:s")
                            );
                $update = Permission::where([['user_id',$userId],['module_id',$moduleId]])->update($data);
                if($update == true) {
                    return true;
                }
            } else {
                $create = Permission::insert($data);
                if($create == true) {
                    return true;
                }
            }
        } elseif ($method == 'can_delete') {
            $data = array('user_id'=>$userId,
                          'role_id'=>$roleId,
                          'module_id'=>$moduleId,
                          'can_delete'=>$value,
                          'created_by'=>$userDetails['id'],
                          'created_at'=>date("Y-m-d H:i:s")
                          );
            $checkTable = Permission::select('*')->where([['user_id',$userId],['module_id',$moduleId]])->get()->toArray();
            if(!empty($checkTable)) {
                $data = array('user_id'=>$userId,
                              'role_id'=>$roleId,
                              'module_id'=>$moduleId,
                              'can_delete'=>$value,
                              'updated_by'=>$userDetails['id'],
                              'updated_at'=>date("Y-m-d H:i:s")
                            );
                $update = Permission::where([['user_id',$userId],['module_id',$moduleId]])->update($data);
                if($update == true) {
                    return true;
                }
            } else {
                $create = Permission::insert($data);
                if($create == true) {
                    return true;
                }
            }
        }
    }

    public function changePermission(Request $request) {
    	$userDetails = Session::get('user_details');
      if(empty($userDetails)) {
            return redirect('/');
        }
    	$method = $request->input('method');
      $roleId = $request->input('role_id');
      $value = $request->input('value');
      $moduleId = $request->input('module_id');
      $userId = $request->input('user_id');
    	$status = $this->setPermission($method,$userDetails,$roleId,$value,$moduleId,$userId);
      if($status == true) {
        $permissionDetails = $this->getPermissionData($userId,$roleId);
      }
      $getModules = Module::select('id','module_name')->where([['status','active'],['deleted_by',NULL]])->get();
      return view('permission.user_permission_table',compact('getModules','permissionDetails'));
    }

    //========page load and according to selected user this function will call=================//
    function getPermissionData($userId,$roleId) {
        $getPermissionDetails = Permission::select('*')->where([['user_id',$userId],['role_id',$roleId]])->orderBy('module_id','ASC')->get();
        return $getPermissionDetails;
    }

    //===========change User===============================//
    public function changeUser(Request $request) {
        $role_id = $request->input('role_id');
        $getRoleName = User::select('id','full_name')->where([['role_id',$role_id],['status','active'],['deleted_by',NULL]])->get();
        return view('permission.select_user_dropdown',compact('getRoleName'));
    }

    //============Get permission details according to selected user from dropdown=============//
    public function getSelectedUserPermission(Request $request) {
        $userId = $request->input('user_id');
        $roleId = $request->input('role_id');
        $permissionDetails = $this->getPermissionData($userId,$roleId);
        // aa($permissionDetails);
        $getModules = Module::select('id','module_name')->where([['status','active'],['deleted_by',NULL]])->get();
        return view('permission.user_permission_table',compact('getModules','permissionDetails'));
    }
}
