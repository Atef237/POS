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

route::group(['namespace' => 'dashboard','prefix'=>'dashboard'],function (){

    route::get('/',function (){
        return "<h1>Dashboard</h1>";
    });

});

