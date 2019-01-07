<?php

// Route::get('/', function () {
// 	return view('welcome');
// });

/* ----- Admin route starts from here ----- */
Route::get('/', ['as' => 'admin-login', 'uses' => 'admin\AuthenticationController@index']);
Route::post('/',['as'=>'admin-post-login','uses'=>'admin\AuthenticationController@postLogin']);
Route::get('/admin-dashboard',['as'=>'admin-dashboard','middleware'=>'admin.auth','uses'=>'admin\AuthenticationController@dashboard']);
Route::get('/admin-logout',['as'=>'admin-logout','uses'=>'admin\AuthenticationController@postLogout']);


//===page not found=====================//
Route::get('/error',['as'=>'error','uses'=>'admin\AuthenticationController@pageNotFound']);
//--- Route for change password
Route::get('/admin-change-password',['as' => 'admin-change-password','middleware'=>'admin.auth', 'uses' => 'admin\AuthenticationController@getChangePassword']);
Route::post('/admin-change-password',['as' => 'admin-change-password','middleware'=>'admin.auth', 'uses' => 'admin\AuthenticationController@postChangePassword']);

// Route for cuisines ---------------------
// Route::group(['middleware' => 'admin.auth'], function () {
// 		Route::get('/cuisines',['as' => 'cuisines-list', 'uses' => 'admin\CuisinesController@index']);
// 		Route::get('/cuisines-add',['as' => 'cuisines-add', 'uses' => 'admin\CuisinesController@create']);
// 		Route::post('/cuisines-add',['as' => 'cuisines-add', 'uses' => 'admin\CuisinesController@store']);
// 		Route::get('/cuisines-status/{id}',['as' => 'cuisines-status', 'uses' => 'admin\CuisinesController@changeStatus']);
// 		Route::get('/cuisines-edit/{id}',['as' => 'cuisines-edit', 'uses' => 'admin\CuisinesController@edit']);
// 		Route::get('/cuisines-delete/{id}',['as' => 'cuisines-delete', 'uses' => 'admin\CuisinesController@destroy']);
// 		Route::post('/cuisines-update',['as' => 'cuisines-update', 'uses' => 'admin\CuisinesController@update']);

// 		// Route for country ----------------------
// 		Route::get('/country',['as' => 'country-list', 'uses' => 'admin\CountryController@index']);
// 		Route::get('/country-add',['as' => 'country-add', 'uses' => 'admin\CountryController@create']);
// 		Route::post('/country-add',['as' => 'country-add', 'uses' => 'admin\CountryController@store']);
// 		Route::get('/country-status/{id}',['as' => 'country-status', 'uses' => 'admin\CountryController@changeStatus']);
// 		Route::get('/country-edit/{id}',['as' => 'country-edit', 'uses' => 'admin\CountryController@edit']);
// 		Route::get('/country-delete/{id}',['as' => 'country-delete', 'uses' => 'admin\CountryController@destroy']);
// 		Route::post('/country-update',['as' => 'country-update', 'uses' => 'admin\CountryController@update']);

// 		// Route for state ----------------------
// 		Route::get('/state',['as' => 'state-list', 'uses' => 'admin\StateController@index']);
// 		Route::get('/state-add',['as' => 'state-add', 'uses' => 'admin\StateController@create']);
// 		Route::post('/state-add',['as' => 'state-add', 'uses' => 'admin\StateController@store']);
// 		Route::get('/state-status/{id}',['as' => 'state-status', 'uses' => 'admin\StateController@changeStatus']);
// 		Route::get('/state-edit/{id}',['as' => 'state-edit', 'uses' => 'admin\StateController@edit']);
// 		Route::get('/state-delete/{id}',['as' => 'state-delete', 'uses' => 'admin\StateController@destroy']);
// 		Route::post('/state-update',['as' => 'state-update', 'uses' => 'admin\StateController@update']);


// 		// Route for city ----------------------
// 		Route::get('/city',['as' => 'city-list', 'uses' => 'admin\CityController@index']);
// 		Route::get('/city-add',['as' => 'city-add', 'uses' => 'admin\CityController@create']);
// 		Route::post('/city-add',['as' => 'city-add', 'uses' => 'admin\CityController@store']);
// 		Route::get('/city-status/{id}',['as' => 'city-status', 'uses' => 'admin\CityController@changeStatus']);
// 		Route::get('/city-edit/{id}',['as' => 'city-edit', 'uses' => 'admin\CityController@edit']);
// 		Route::get('/city-delete/{id}',['as' => 'city-delete', 'uses' => 'admin\CityController@destroy']);
// 		Route::post('/city-update',['as' => 'city-update', 'uses' => 'admin\CityController@update']);

// 		Route::get('/city/state-listing/{id}',['as' => 'city.state-listing', 'uses' => 'admin\CityController@stateList']);

// 		// Route for Area/Zipcode ----------------
// 		Route::get('/area',['as' => 'area-list', 'uses' => 'admin\AreaController@index']);
// 		Route::get('/area-add',['as' => 'area-add', 'uses' => 'admin\AreaController@create']);
// 		Route::post('/area-add',['as' => 'area-add', 'uses' => 'admin\AreaController@store']);
// 		Route::get('/area-status/{id}',['as' => 'area-status', 'uses' => 'admin\AreaController@changeStatus']);
// 		Route::get('/area-edit/{id}',['as' => 'area-edit', 'uses' => 'admin\AreaController@edit']);
// 		Route::get('/area-delete/{id}',['as' => 'area-delete', 'uses' => 'admin\AreaController@destroy']);
// 		Route::post('/area-update',['as' => 'area-update', 'uses' => 'admin\AreaController@update']);

// 		Route::get('/area/city-listing/{id}',['as' => 'area.city-listing', 'uses' => 'admin\AreaController@cityList']);


// 		// Route for categories ------------------
// 		Route::get('/category',['as' => 'category-list', 'uses' => 'admin\CategoryController@index']);
// 		Route::get('/category-add',['as' => 'category-add', 'uses' => 'admin\CategoryController@create']);
// 		Route::post('/category-add',['as' => 'category-add', 'uses' => 'admin\CategoryController@store']);
// 		Route::get('/category-status/{id}',['as' => 'category-status', 'uses' => 'admin\CategoryController@changeStatus']);
// 		Route::get('/category-edit/{id}',['as' => 'category-edit', 'uses' => 'admin\CategoryController@edit']);
// 		Route::get('/category-delete/{id}',['as' => 'category-delete', 'uses' => 'admin\CategoryController@destroy']);
// 		Route::post('/category-update',['as' => 'category-update', 'uses' => 'admin\CategoryController@update']);

// 		// Route for cms ------------------
// 		
// 		Route::get('/cms-add',['as' => 'cms-add', 'uses' => 'admin\CmsController@create']);
// 		Route::post('/cms-add',['as' => 'cms-add', 'uses' => 'admin\CmsController@store']);
// 		Route::get('/cms-status/{id}',['as' => 'cms-status', 'uses' => 'admin\CmsController@changeStatus']);
// 		Route::get('/cms-edit/{id}',['as' => 'cms-edit', 'uses' => 'admin\CmsController@edit']);
// 		Route::get('/cms-delete/{id}',['as' => 'cms-delete', 'uses' => 'admin\CmsController@destroy']);
// 		Route::post('/cms-update',['as' => 'cms-update', 'uses' => 'admin\CmsController@update']);
		
// });

		// Route for User -------------------
		Route::get('/user',['as' => 'user', 'uses' => 'UserController@index']);
		Route::get('/user-add',['as' => 'user-add', 'uses' => 'UserController@userAdd']);
		Route::post('/user-insert',['as' => 'user-insert', 'uses' => 'UserController@userInsert']);
		Route::get('/user-status/{id}',['as' => 'user-status', 'uses' => 'UserController@changeStatus']);
		Route::get('/user-edit/{id}',['as' => 'user-edit', 'uses' => 'UserController@edit']);
		Route::post('/user-update',['as' => 'user-update', 'uses' => 'UserController@update']);
		Route::get('/user-delete/{id}',['as' => 'user-delete', 'uses' => 'UserController@destroy']);
		Route::post('/user-suggestion',['as' => 'user-suggestion', 'uses' => 'UserController@userSuggestion']);
		Route::post('/user-suggestion-id',['as' => 'user-suggestion-id', 'uses' => 'UserController@userSuggestionId']);

		// Route for Settings ---------(Role)--------
		Route::get('/roles-list',['as' => 'roles-list', 'uses' => 'RolesController@index']);
		Route::get('/roles-add',['as' => 'roles-add', 'uses' => 'RolesController@roleAdd']);
		Route::post('/roles-insert',['as' => 'roles-insert', 'uses' => 'RolesController@roleInsert']);
		Route::get('/roles-status/{id}',['as' => 'roles-status', 'uses' => 'RolesController@roleStatus']);
		Route::get('/roles-edit/{id}',['as' => 'roles-edit', 'uses' => 'RolesController@roleEdit']);
		Route::post('/roles-update',['as' => 'roles-update', 'uses' => 'RolesController@roleUpdate']);
		Route::get('/roles-delete/{id}',['as' => 'roles-delete', 'uses' => 'RolesController@roleDelete']);

		// Route for Settings -------(Permission)-------
		Route::get('/permission',['as' => 'permission', 'uses' => 'PermissionController@index']);
		Route::post('/change-permission-status',['as' => 'change-permission-status', 'uses' => 'PermissionController@changePermission']);
		Route::post('/change-user',['as' => 'change-user', 'uses' => 'PermissionController@changeUser']);
		Route::post('/selected-user-permission-details',['as' => 'selected-user-permission-details', 'uses' => 'PermissionController@getSelectedUserPermission']);
		// Route for Settings -------(Module Management)-------
		Route::get('/module-list',['as' => 'module-list', 'uses' => 'ModuleController@index']);
		Route::get('/module-add',['as' => 'module-add', 'uses' => 'ModuleController@Add']);
		Route::post('/module-insert',['as' => 'module-insert', 'uses' => 'ModuleController@Insert']);
		Route::get('/module-status/{id}',['as' => 'module-status', 'uses' => 'ModuleController@Status']);
		Route::get('/module-edit/{id}',['as' => 'module-edit', 'uses' => 'ModuleController@Edit']);
		Route::post('/module-update',['as' => 'module-update', 'uses' => 'ModuleController@Update']);
		Route::get('/module-delete/{id}',['as' => 'module-delete', 'uses' => 'ModuleController@Delete']);

		// Route for Settings -------(Email Template)------------
		Route::get('/email-template-list',['as' => 'email-template-list', 'uses' => 'EmailTemplateController@index']);
		Route::get('/email-template-add',['as' => 'email-template-add', 'uses' => 'EmailTemplateController@add']);
		Route::post('/email-template-insert',['as' => 'email-template-add', 'uses' => 'EmailTemplateController@insert']);
		Route::get('/email-template-status/{id}',['as' => 'email-template-status', 'uses' => 'EmailTemplateController@status']);
		Route::get('/email-template-edit/{id}',['as' => 'email-template-edit', 'uses' => 'EmailTemplateController@edit']);
		Route::post('/email-template-update',['as' => 'email-template-update', 'uses' => 'EmailTemplateController@update']);
		Route::get('/email-template-delete/{id}',['as' => 'email-template-delete', 'uses' => 'EmailTemplateController@destroy']);

		//Route for modules list
		Route::get('/loan',['as' => 'loan', 'uses' => 'LoanController@index']);
		Route::get('/recurring',['as' => 'recurring', 'uses' => 'RecurringDepositController@index']);
		Route::get('/fixed-deposit',['as' => 'fixed-deposit', 'uses' => 'FixedDepositController@index']);
		Route::get('/interest-master',['as' => 'interest-master', 'uses' => 'InterestController@index']);
