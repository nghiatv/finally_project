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

Route::get('/', 'AdminController@checkLogin');


//API
Route::group(['prefix' => 'api'], function () {
//    Route::resource('authenticate', 'JwtAuthenticateController', ['only' => ['index']]);
    Route::get('users', 'JwtAuthenticateController@getAuthenticateUser');
    Route::post('authenticate', 'JwtAuthenticateController@authenticate');
    Route::post('sendpo', 'JwtAuthenticateController@sendPO');
});

//authentication route
//Route::post('authenticate','JwtAuthenticateController@authenticate');
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@getLogin');
    Route::get('login', 'AdminController@getLogin');
    Route::post('login', 'AdminController@postLogin');
});


//Admin Login

Route::group(['prefix' => 'admin','middleware' => ['role:admin']], function () {
    // Xac thuc trang Admin
    Route::get('logout', 'AdminController@getLogout');

    // Dang ki trang Admin
    Route::get('user', 'AdminController@getListUser');//xem toan bo thong tin
    Route::get('user/create', 'AdminController@getCreateUser'); // tao moi nguoi dung
    Route::get('user/{id}', 'AdminController@getUser')->where('id', '[0-9]+'); //xem thong tin user
//    Route::get('/user/{id}/edit', 'AdminController@getEditUser');// edit user
    Route::post('user', 'AdminController@postUser');//them moi user
//    Route::put('/user/{id}', 'AdminController@putUser');//update thong tin user
//    Route::delete('/user/{id}', 'AdminController@deleteUser');//xoa user


//    Dashboard
    Route::get('dashboard', 'DashboardController@index');
//    Route::get('/listuser', 'AdminController@getListUser');


//    quan ly cua hang
});
//Route::group(['prefix' => 'admin/store','middleware' => ['role:admin']], function () {
//    Route::get('/create', 'StoreController@createStore'); // lay view tao cua hang
//    Route::get('/', 'StoreController@getStore');//lay danh sach cua hang
//    Route::post('/', 'StoreController@postStore');// tao moi cua hang
//
//    Route::get('/{id}', 'StoreController@getStore')->where('id','[0-9]+'); // lay chi tiet cua hang
//    Route::get('/{id}/edit', 'StoreController@getEditStore');// sua cua hang
////    Route::put('/{id}', 'StoreController@putStore');
////    Route::delete('/{id}', 'StoreController@deleteStore');
//});


Route::resource('admin/user','AdminController',[
    'middleware' => ['role:admin|root|owner']
]);

Route::resource('admin/store','StoreController',[
    'middleware' => ['role:admin|root|owner']
]);

//quan ly permission
Route::resource('admin/perm','PermissionController',[
    'middleware' => ['role:admin|root|owner']
]);

//quan ly role
Route::resource('admin/role','RoleController',[
    'middleware' => ['role:admin|root|owner']
]);
//quan ly hoa don

Route::resource('admin/bill','BillController',[
    'middleware' => ['role:admin|root']
]);

Route::resource('admin/product','ProductController',[
    'middleware' => ['role:admin|root']
]);
Route::get('admin/product/{id}/all','ProductController@getAll',[
    'middleware' => ['role:admin|root']
]);
//Route::get('admin/bill/custom','BillController@daterank');
//Route::get('admin/bill','BillController', function(\Illuminate\Http\Request $request){
////    dd($request->all());
//});
//lay list don hang
//Route::get('admin/testProduct/{id}','AnalyticController@getProducts');
Route::get('admin/store/{id}/orders','AnalyticController@listPO');
Route::get('admin/orders/{id}','AnalyticController@getInvoice');


Route::resource('admin/mail','Mailcontroller',
    ['middleware' => ['role:admin|root']]);