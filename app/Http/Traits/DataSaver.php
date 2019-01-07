<?php

namespace App\Http\Traits;

use App\Models\User;
use App\Models\UsersActivityLog;
use App\Models\SystemActivityLog;
use Illuminate\Support\Facades\Session;

/**
 * This contain several function that help to store data into session or database
 *
 *  @author Raja Chakraborty
 */
trait DataSaver
{
	/**
	 * This will log users activity into table
	 *
	 * @param  string $event   what he did
	 * @param  integer $user_id nullable for logged in user
	 */
	public function setUserDetailsIntoSession($user_id = null,$username = null, $email = null, $full_name = null,$role_name = null)
	{
		$user_details = [
			'id' 			=> $user_id,
			'username' 		=> $username,
			'email' 		=> $email,
			'full_name'	=> $full_name,
			'role_name' => $role_name
		];
		Session::put('user_details',$user_details);
		//aa(Session::get('user_details'));
	}
}
