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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::group(['prefix'=>'admin','middleware'=>'admin'],function (){          //gruplama
    Route::get('/', 'HomeController@get_admin');
    Route::get('/dashboard', 'HomeController@get_admin');
    Route::get('/haber/haber-ekle', 'AdminController@get_haberEkle');
    Route::post('/haber/haber-ekle', 'AdminController@post_haberEkle');
});
//    Route::group(['prefix'=>'admin','middleware'=>['admin','moderator']]); // şeklindede olabilir


