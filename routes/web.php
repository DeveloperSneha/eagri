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
Route::group(['middleware' => ['auth']], function() {
    Route::get('/', function () {
        return view('layouts.app');
    });
});


Route::resource('roles', 'RoleController');
Route::resource('schemes', 'Scheme\MainSchemeController');
Route::resource('subschemes', 'Scheme\SubSchemeController');
Route::resource('compschemes', 'Scheme\SchemeComponentController');


Route::get('district/{id}/blocks', 'Farmer\FarmerRegisterController@getBlocks');
Route::get('block/{id}/villages', 'Farmer\FarmerRegisterController@getVillages');
Route::resource('farmer-reg', 'Farmer\FarmerRegisterController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
