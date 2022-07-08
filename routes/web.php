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




route::group(['namespace' => 'Dashboard','middleware'=>'guest:web'],function(){

    route::view('/','dashboard.login')->name('login');

    route::post('login','LoginController@login')->name('login.admin');

});


route::group(['namespace' => 'Dashboard','middleware'=>'auth:web'],function(){

    route::view('home','dashboard.dashboard')->name('home');

    route::resource('users','UserController')->except(['show']);

    route::resource('categories','CategoryController')->except(['show']);




});

