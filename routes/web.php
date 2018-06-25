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


//Route::group(['prefix' => 'admin', 'middleware' => ['role:admin|content']], function() {
//    Route::get('/', 'AdminController@index');
//    Route::get('/index', 'AdminController@index');
////    Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
//});

Route::group(['prefix' => 'user', 'middleware' => ['role:admin']], function()
{
    Route::bind('user', function ($value) {
        $hashids = app()->make('Hashids');

        $id = $hashids->decode($value)[0];
        return \App\User::findOrFail($id);
    });

    Route::get('/', ['middleware' => ['permission:user-index'], 'uses' => 'UserController@index']);
    Route::get('/index', ['middleware' => ['permission:user-index'], 'uses' => 'UserController@index']);
    Route::get('/show/{user}', ['middleware' => ['permission:user-show'], 'uses' => 'UserController@show']);
    Route::get('/create', ['middleware' => ['permission:user-create'], 'uses' => 'UserController@create']);
    Route::post('/store', ['middleware' => ['permission:user-create'], 'uses' => 'UserController@store']);
    Route::get('/edit/{user}', ['middleware' => ['permission:user-edit'], 'uses' => 'UserController@edit']);
    Route::post('/update', ['middleware' => ['permission:user-edit'], 'uses' => 'UserController@update']);
    Route::get('/delete/{user}', ['middleware' => ['permission:user-delete'], 'uses' => 'UserController@destroy']);
    Route::post('/deleteMultiple', ['middleware' => ['permission:user-delete'], 'uses' => 'UserController@destroyMultiple']);
    Route::get('/export', ['middleware' => ['permission:user-create'], 'uses' => 'UserController@export']);
    Route::get('/import', ['middleware' => ['permission:user-create'], 'uses' => 'UserController@import']);
});

Route::group(['prefix' => 'role', 'middleware' => ['role:admin']], function()
{
    Route::bind('role', function ($value) {
        $hashids = app()->make('Hashids');

        $id = $hashids->decode($value)[0];
        return \App\Role::findOrFail($id);
    });

    Route::get('/', ['middleware' => ['permission:role-index'], 'uses' => 'RoleController@index']);
    Route::get('/index', ['middleware' => ['permission:role-index'], 'uses' => 'RoleController@index']);
    Route::get('/show/{role}', ['middleware' => ['permission:role-show'], 'uses' => 'RoleController@show']);
    Route::get('/create', ['middleware' => ['permission:role-create'], 'uses' => 'RoleController@create']);
    Route::post('/store', ['middleware' => ['permission:role-create'], 'uses' => 'RoleController@store']);
    Route::get('/edit/{role}', ['middleware' => ['permission:role-edit'], 'uses' => 'RoleController@edit']);
    Route::post('/update', ['middleware' => ['permission:role-edit'], 'uses' => 'RoleController@update']);
    Route::get('/delete/{role}', ['middleware' => ['permission:role-delete'], 'uses' => 'RoleController@destroy']);
    Route::post('/deleteMultiple', ['middleware' => ['permission:role-delete'], 'uses' => 'RoleController@deleteMultiple']);
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
