<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Admin\AdminController@dashboard');

Route::get('/admin', 'Admin\AdminController@dashboard');
Route::get('/admin/tables', 'Admin\AdminController@tables');
Route::get('/admin/getTables', 'Admin\AdminController@getTables');

// Работа с пользователями
// Методы GET
Route::get('/admin/users', 'Admin\UserController@users');
Route::get('/admin/users/all', 'Admin\UserController@usersAll');
Route::get('/admin/profile', 'Admin\UserController@profile');
Route::get('/admin/profile/{email}', 'Admin\UserController@userProfile');
Route::get('/admin/profile/{email}/info', 'Admin\UserController@userInfo');

Route::get('/admin/profile/tables/get', 'Admin\UserController@profileTables');
Route::get('/admin/profile/table/{table}', 'Admin\UserController@profileTableInfo');
Route::get('/admin/profile/table/{table}/get', 'Admin\UserController@profileTableInfoGet');


// Методы POST
Route::post('/admin/users/add', 'Admin\UserController@addUser');
Route::post('/admin/users/send/registration', 'Admin\UserController@userRegistrationMail');
Route::post('/admin/profile/remove', 'Admin\UserController@removeUser');
Route::post('/admin/profile/update', 'Admin\UserController@userInfoUpdate');


// Методы не зарегистрированного пользователя
Route::get('/passwordActivation/{token}', 'HomeController@passwordActivation');
Route::post('/admin/profile/activate', 'HomeController@passwordActivationPost');

Auth::routes();

Route::get('/home', 'HomeController@index');
