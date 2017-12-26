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
        return view('layouts.dashboard');
    });
});

Route::get('section/{id}/designations', 'Users\UserRegistrationController@getDesignations');
Route::resource('user-registration', 'Users\UserRegistrationController');
Route::resource('designations', 'DesignationController');
Route::get('workflow/{id}/designations', 'WorkflowController@designations');
Route::resource('workflow', 'WorkflowController');
Route::resource('roles', 'RoleController');
Route::resource('units', 'UnitController');

Route::get('section/{id}/schemes', 'SectionController@getScheme');
Route::resource('sections', 'SectionController');
Route::resource('schemes', 'SchemeController');
Route::resource('compcerts', 'CompcertController');
//Route::resource('schemecerts', 'SchemecertController');
Route::resource('components', 'ComponentController');
Route::resource('certificates', 'CertificateController');
Route::resource('categories', 'CategoryController');
Route::resource('programs', 'ProgramController');
Route::resource('fys', 'FinancialYearController');
Route::resource('compsizes', 'CompsizeController');
Route::resource('comprates', 'ComprateController');

Route::resource('schemeactivations/nv', 'NonVendorSchemeActivationController');
Route::resource('schemeactivations', 'SchemeActivationController');
Route::resource('districtdistribution', 'SchDistrictDistributionController');

Route::get('schdistrict/{schdistid}/blocks', 'SchBlockDistributionController@getBlocks');
Route::get('schblock/{schdistid}/villages', 'SchBlockDistributionController@getVillages');
Route::get('schact/{id}/districts', 'SchBlockDistributionController@getDistrict');
Route::get('schact/{id}/blocks', 'SchVillageDistributionController@getBlock');
Route::resource('blockdistribution', 'SchBlockDistributionController');
Route::resource('villagedistribution', 'SchVillageDistributionController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Farmers Route


Route::prefix('farmer')->group(function() {
    Route::get('/register', 'Auth\FarmerRegisterController@showRegistrationForm')->name('farmer.register');
    Route::post('/register', 'Auth\FarmerRegisterController@register')->name('farmer.register.submit');
    Route::get('/login', 'Auth\FarmerLoginController@showLoginForm')->name('farmer.login');
    Route::post('/login', 'Auth\FarmerLoginController@login')->name('farmer.login.submit');
    Route::post('/logout', 'Auth\FarmerLoginController@logout')->name('farmer.logout');
    Route::get('/', 'Farmer\FarmerController@index')->name('farmer.dashboard');

    Route::get('district/{id}/blocks', 'Auth\FarmerRegisterController@getBlocks');
    Route::get('block/{id}/villages', 'Auth\FarmerRegisterController@getVillages');

    Route::get('section/{id}/schemes', 'Farmer\FarmerSchemeController@getScheme');
    Route::get('scheme/{id}/apply', 'Farmer\FarmerSchemeController@applicationScheme');
    Route::post('scheme/{id}/apply', 'Farmer\FarmerSchemeController@submitSchemeApplication');
    Route::get('program/{id}/categories', 'Farmer\FarmerSchemeController@getCategory');
    Route::get('category/{id}/components', 'Farmer\FarmerSchemeController@getComponent');
    Route::get('/schemes', 'Farmer\FarmerSchemeController@farmerSchemes');
    Route::get('/downloadPDF/{id}', 'Farmer\FarmerSchemeController@downloadPDF');
    Route::get('/printdetails/{id}', 'Farmer\FarmerSchemeController@printDetails');
});

// Designation wise Route
Route::prefix('authority')->group(function() {
    Route::get('/login', 'Auth\AuthorityLoginController@showLoginForm')->name('authority.login');
    Route::post('/login', 'Auth\AuthorityLoginController@login')->name('authority.login.submit');
    Route::post('/logout', 'Auth\AuthorityLoginController@logout')->name('authority.logout');
    Route::get('/', 'Authority\AuthorityController@index')->name('authority.dashboard');

    Route::resource('/adduser', 'Authority\AuthorityUserController');
    Route::resource('/profile', 'Authority\AuthorityProfileController');
    Route::resource('/schemes', 'Authority\AuthoritySchemeController');
    Route::get('/approvedscheme', 'Authority\AuthoritySchemeController@approvedScheme');
    Route::get('/rejectedscheme', 'Authority\AuthoritySchemeController@rejectedScheme');
    Route::get('/schemedistrict/{id}', 'Authority\BlockwiseSchemeDistributionController@getSchemeDist');
    Route::resource('/blockwisescheme', 'Authority\BlockwiseSchemeDistributionController');
});
