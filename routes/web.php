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

Route::get('component/all', 'ComponentController@index');

Route::post('component/create', 'ComponentController@createComponent');

Route::post('ad/create', 'AdController@createAd');

Route::post('ad/post', 'AdController@postAd');
