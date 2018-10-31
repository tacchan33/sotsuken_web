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

Auth::routes();

// Brower App
Route::redirect('/','/home',301);

//ホーム
Route::get('/home', 'HomeController@index')->name('home');

/* 個人設定 */
Route::get('/account','AccountController@index')->name('account.index');
Route::get('/account/form','AccountController@form')->name('account.form');
Route::put('/account/update','AccountController@update')->name('account.update');
Route::put('/account/passnumber','AccountController@passnumber')->name('account.passnumber');

/* アクセスポイント */
Route::get('/accesspoint/index','AccesspointController@index')->name('accesspoint.index');
Route::get('/accesspoint/form','AccesspointController@form')->name('accesspoint.form');
Route::post('/accesspoint/create','AccesspointController@create')->name('accesspoint.create');
Route::put('/accesspoint/update','AccesspointController@update')->name('accesspoint.update');
Route::delete('/accesspoint/delete','AccesspointController@delete')->name('accesspoint.delete');

/* Wi-Fiビーコン Androidのみ　未完成 */
Route::get('/wifibeacon/form','WifibeaconController@form')->name('wifibeacon.form');
Route::match(['get','put','post'],'/wifibeacon/update','WifibeaconController@update')->name('wifibeacon.update');

/* ScanLog */
Route::get('/scanlog/index','ScanlogController@index')->name('scanlog.index');

Route::get('/test','HomeController@test');