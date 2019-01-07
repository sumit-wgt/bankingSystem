<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * This will verify a user for front end
 *
 *  @author Anirban Saha
 */
trait Authentication
{
	/**
	 *  it contain current user's user_id
	 *
	 *  @var  int
	 */
	public $user_id;

	/**
	 *  it contain current user's role_id
	 *
	 *  @var  int
	 */
	//public $role_id;

	/**
	 *  this will check if there is any logged in user or not
	 *
	 *  @param   Request  $request  request object
	 *  @return  boolean  true if logged in, false if not
	 */
	public function isLoggedIn()
	{
		//$back_url = $request->isMethod('get') ? $request->fullUrl() : route('front-home');
		//Session::put('back_url',$back_url);
		if(Session::get('user_details') !== null){
			$this->user_id = Session::get('user_details')['id'];
			return true;
		}else{
			return false;
		}
	}
}
 ?>
