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


Route::any('/login','Backend\AdminController@login')->name('admin.login');
Route::any('/register','Backend\AdminController@create');
Route::any('/upload','Backend\AdminController@upload');

//後台登入
Route::group(['middleware' => ['auth.back:back']], function () {

    Route::any('/register/update/{id}','Backend\AdminController@update');
    Route::get('/dashboard','Backend\AdminController@index');
    Route::get('/','Backend\AdminController@index');
    Route::any('/logout','Backend\AdminController@logout');


    Route::get('/item','Backend\ItemController@index');
    Route::any('/item/create','Backend\ItemController@create');
    Route::any('/item/update/{id}','Backend\ItemController@update');
    Route::delete('/item/delete/{id}','Backend\ItemController@destroy');

    Route::get('/admin_menu','Backend\AdminMenuController@index');
    Route::any('/admin_menu/create','Backend\AdminMenuController@create');
    Route::any('/admin_menu/update/{id}','Backend\AdminMenuController@update');
    Route::delete('/admin_menu/delete/{id}','Backend\AdminMenuController@destroy');

    Route::get('/article','Backend\ArticleController@index');
    Route::any('/article/create','Backend\ArticleController@create');
    Route::any('/article/update/{id}','Backend\ArticleController@update');
    Route::delete('/article/delete/{id}','Backend\ArticleController@destroy');


    Route::get('/article_block','Backend\ArticleBlockController@index');
    Route::any('/article_block/create','Backend\ArticleBlockController@create');
    Route::any('/article_block/update/{id}','Backend\ArticleBlockController@update');
    Route::delete('/article_block/delete/{id}','Backend\ArticleBlockController@destroy');
    
});