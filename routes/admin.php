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


Route::get('/login','AdminController@showLogin')->name('admin.login');
Route::post('/login','AdminController@login');

Route::middleware('auth.admin:admin')->get('/dashboard','AdminController@index');
Route::middleware('auth.admin:admin')->any('/logout','AdminController@logout');