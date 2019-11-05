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

use App\Ad;

Route::get('qwe', function () {
    $ad = Ad::where('id', 1)
        ->where('status', 1)
        ->update(['status' => 2]);
    return $ad;
});

Route::post('component/all', 'ComponentController@index');

Route::post('component/store', 'ComponentController@store');

Route::post('ad/store', 'AdController@store');

Route::post('ad/post', 'AdController@postAd');
