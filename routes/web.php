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


Route::any('/login2','Frontend\UserController@login')->name('login');
Route::any('/register2','Frontend\UserController@create');

Route::middleware('auth:web')->any('/logout','Frontend\UserController@logout');

Route::group(['middleware' => ['auth:web']], function () {
    Route::any('/test2','Frontend\TestController@index');
    
});
Route::get('/test','Frontend\TestController@index');
Route::get('/test2', function () {
    return view('tailwind2');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/{any}', function () {
//     return view('todo');
// })->where('any','.*');
Route::get('/', function () {
    return view('todo');
});
Route::get('/todo', function () {
    return view('todo');
});
Route::get('/about', function () {
    return view('todo');
});
Route::get('/map', function () {
    return view('todo');
});
