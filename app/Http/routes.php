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

Route::get('/', function () {
    return view('welcome');
});


//API
Route::group(['prefix' => 'api'], function(){
    Route::resource('authenticate', 'JwtAuthenticateController', ['only' => ['index']]);
    Route::get('users','JwtAuthenticateController@getAuthenticateUser');
    Route::post('authenticate','JwtAuthenticateController@authenticate');
});
Route::group(['prefix' => 'client', 'before' => 'jwt.auth','middleware' => ['ability:client,create-posts']],function(){

});
Route::group(['prefix'=>'admin','middleware'=> ['ability:admin,create-users|edit-users|delete-users']],function(){
    Route::get('users','JwtAuthenticateController@getAuthenticateUser');
//    lấy toàn bộ danh sách user
    Route::get('all-users','JwtAuthenticateController@allUsers');
//    tạo mới user
    Route::post('register','JwtAuthenticateController@register');

    //Tao role moi
    Route::post('role','JwtAuthenticateController@createRole');
//Tao quyen moi
    Route::post('permission','JwtAuthenticateController@createPermission');
//Gan role cho user
    Route::post('assign-role','JwtAuthenticateController@assignRole');
//Gan quyen cho role
    Route::post('attach-permission','JwtAuthenticateController@attachPermission');
//    kiem tra role
    Route::post('check-roles','JwtAuthenticateController@checkRoles');
//    Sửa role
    Route::put('update-role','JwtAuthenticateController@updateRole');
});

//authentication route
//Route::post('authenticate','JwtAuthenticateController@authenticate');