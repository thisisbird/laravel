<?php

use Illuminate\Support\Facades\Route;

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


Route::any('/login','AdminController@login')->name('admin.login');
Route::any('/register','AdminController@create');

//後台登入
Route::group(['middleware' => ['auth.admin:admin']], function () {

    Route::any('/register/update/{id}','AdminController@update');
    Route::get('/dashboard','AdminController@index');
    Route::get('/','AdminController@index');
    Route::any('/logout','AdminController@logout');


    Route::get('/item','ItemController@index');
    Route::any('/item/create','ItemController@create');
    Route::any('/item/update/{id}','ItemController@update');
    Route::delete('/item/delete/{id}','ItemController@destroy');

    Route::get('/admin_menu','AdminMenuController@index');
    Route::any('/admin_menu/create','AdminMenuController@create');
    Route::any('/admin_menu/update/{id}','AdminMenuController@update');
    Route::delete('/admin_menu/delete/{id}','AdminMenuController@destroy');

});