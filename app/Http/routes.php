<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//USER PART

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//API PART

Route::group(['prefix'=>'api/v1'],function(){

	Route::resource('employee','API\EmployeeApi');
	Route::resource('locale','API\LocaleApi');
	Route::get('home','API\HomeApi@index');
	Route::post('pinyin','API\Pinyin@index');
});

Route::group(['prefix'=>'admin'],function(){

	Route::resource('employee','Admin\AdminEmployee');
	Route::get('position','Admin\AdminPosition@index');
	Route::get('office','Admin\AdminOffice@index');
	Route::get('company','Admin\AdminCompany@index');
	Route::get('visa','Admin\AdminVisa@index');
});


Route::get('home','HomeController@index');
Route::get('employee','EmployeeController@index');
Route::get('employee/show/{id}','EmployeeController@show');


//Route::get('spread','SpreadController@index');
Route::get('locale','LocaleController@index');


Route::get('/',function(){
	return Redirect::to('home');
});

