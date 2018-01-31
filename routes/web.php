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
Route::get('user/{id}/{desig}/details', 'Users\UserDistrictController@getDetails');
Route::get('user/{id}/{desig}/{dist}/subdivision', 'Users\UserDistrictController@getSubdivision');
Route::get('user/{id}/{desig}/{subdivision}/block', 'Users\UserDistrictController@getBlock');
Auth::routes();

/* Frontpage */
Route::get('/', function () {
    return view('layouts.frontpage');
});
/* end frontpage */



Route::group(['middleware' => ['auth']], function() {
    Route::get('/index', function () {
        return view('layouts.dashboard');
    });

    Route::get('uservillage/{id}/edituser', 'Users\UserVillageController@getUserDetails');
    Route::get('uservillage/{sectionid}/designations', 'Users\UserVillageController@getDesignations');
    Route::resource('uservillage', 'Users\UserVillageController');

    Route::get('userblock/{id}/edituser', 'Users\UserBlockController@getUserDetails');
    Route::get('userblock/{sectionid}/villages', 'Users\UserBlockController@getVillages');
    Route::get('userblock/{sectionid}/designations', 'Users\UserBlockController@getDesignations');
    Route::resource('userblock', 'Users\UserBlockController');

    Route::get('usersubdivision/{id}/edituser', 'Users\UserSubdivisionController@getUserDetails');
    Route::get('usersubdivision/{subdivisionid}/blocks', 'Users\UserSubdivisionController@getBlocks');
    Route::get('usersubdivision/{sectionid}/designations', 'Users\UserSubdivisionController@getDesignations');
    Route::resource('usersubdivision', 'Users\UserSubdivisionController');

    Route::get('district/{id}/subdivisions', 'Users\UserDistrictController@getSubdivisions');
    Route::get('userdistrict/{id}/designations', 'Users\UserDistrictController@getDesignations');
    Route::get('userdistrict/{id}/edituser', 'Users\UserDistrictController@getUserDetails');
    Route::resource('userdistrict', 'Users\UserDistrictController');

    Route::get('designations/{id}/deletedesignation', 'DesignationController@deleteDesignation');
    Route::get('designations/{id}/editdesignation', 'DesignationController@editDesignation');
    Route::resource('designations', 'DesignationController');

    Route::get('workflow/{id}/designations', 'WorkflowController@designations');
    Route::get('workflow/{id}/deleteworkflow', 'WorkflowController@deleteWorkflow');
    Route::get('workflow/{id}/editworkflow', 'WorkflowController@editWorkflow');
    Route::resource('workflow', 'WorkflowController');
    Route::resource('roles', 'RoleController');
    Route::get('units/{id}/deleteunit', 'UnitController@deleteUnit');
    Route::get('units/{id}/editunit', 'UnitController@editUnit');
    Route::resource('units', 'UnitController');

    Route::get('section/{id}/workflows', 'SectionController@getWorkflow');
    Route::get('section/{id}/designations', 'SectionController@getDesignations');
    Route::get('section/{id}/schemes', 'SectionController@getScheme');
    Route::get('sections/{id}/deletesection', 'SectionController@deleteSection');
    Route::get('sections/{id}/editsection', 'SectionController@editSection');
    Route::get('schemes/{id}/deletescheme', 'SchemeController@deleteScheme');
    Route::get('schemes/{id}/editscheme', 'SchemeController@editScheme');
    Route::resource('sections', 'SectionController');
    Route::resource('schemes', 'SchemeController');
    Route::resource('compcerts', 'CompcertController');
    //Route::resource('schemecerts', 'SchemecertController');
    Route::resource('components', 'ComponentController');

    Route::get('certificates/{id}/deletecertificate', 'CertificateController@deleteCertificate');
    Route::get('certificates/{id}/editcertificate', 'CertificateController@editCertificate');
    Route::resource('certificates', 'CertificateController');
    Route::resource('categories', 'CategoryController');
    Route::get('programs/{id}/editprogram', 'ProgramController@editProgram');
    Route::get('programs/{id}/deleteprogram', 'ProgramController@deleteProgram');
    Route::resource('programs', 'ProgramController');

    Route::get('fys/{id}/deletefys', 'FinancialYearController@deletefys');
    Route::get('fys/{id}/editfys', 'FinancialYearController@editfys');
    Route::resource('fys', 'FinancialYearController');
    Route::resource('compsizes', 'CompsizeController');
    Route::resource('comprates', 'ComprateController');

    Route::get('schemes/{idScheme}/activatedprograms', 'NonVendorSchemeActivationController@getActivatedProgram');
    Route::get('schemes/{idScheme}/programs', 'NonVendorSchemeActivationController@getPrograms');
    Route::resource('schemeactivations/nv', 'NonVendorSchemeActivationController');
    Route::resource('schemeactivations', 'SchemeActivationController');
    Route::resource('districtdistribution', 'SchDistrictDistributionController');

    Route::get('schdistrict/{schdistid}/blocks', 'SchBlockDistributionController@getBlocks');
    Route::get('schblock/{schdistid}/villages', 'SchBlockDistributionController@getVillages');
    Route::get('schact/{id}/districts', 'SchBlockDistributionController@getDistrict');
    Route::get('schact/{id}/blocks', 'SchVillageDistributionController@getBlock');
    Route::resource('blockdistribution', 'SchBlockDistributionController');
    Route::resource('villagedistribution', 'SchVillageDistributionController');
});
//Route::get('/home', 'HomeController@index')->name('home');
//Farmers Route
Route::prefix('farmer')->group(function() {
    Route::get('/bankdetails', 'Auth\FarmerRegisterController@getBankDetails');
    Route::get('/register', 'Auth\FarmerRegisterController@showRegistrationForm')->name('farmer.register');
    Route::post('/register', 'Auth\FarmerRegisterController@register')->name('farmer.register.submit');
    Route::get('/successreg', 'Auth\FarmerRegisterController@successReg');
    //Route::get('/forgotpassword', function () {return view('farmer.forgotpassword');});
    Route::get('/forgotpassword', 'Farmer\ForgotpasswordsController@index');
    Route::post('/forgotpassword', 'Farmer\ForgotpasswordsController@match')->name('farmer.submitforgotpassword.submit');
    Route::post('/changepassword', 'Farmer\ForgotpasswordsController@change')->name('farmer.submitchangepassword.submit');
    Route::get('/printfarmerdetail/{id}', 'Auth\FarmerRegisterController@printFarmerDetails');
    Route::get('/login', 'Auth\FarmerLoginController@showLoginForm')->name('farmer.login');
    Route::post('/login', 'Auth\FarmerLoginController@login')->name('farmer.login.submit');
    Route::post('/logout', 'Auth\FarmerLoginController@logout')->name('farmer.logout');
    Route::get('/', 'Farmer\FarmerController@index')->name('farmer.dashboard');
    Route::get('/profile', 'Farmer\FarmerController@getProfile');
    Route::get('/authinfo', 'Farmer\FarmerController@getAuthinfo');
    Route::get('/avaschemes', 'Farmer\FarmerController@getAvaschemes');

    Route::get('district/{id}/subdivisions', 'Auth\FarmerRegisterController@getSubdivisions');
    Route::get('subdivision/{id}/blocks', 'Auth\FarmerRegisterController@getBlocks');
    Route::get('block/{id}/villages', 'Auth\FarmerRegisterController@getVillages');

    Route::get('section/{id}/schemes', 'Farmer\FarmerSchemeController@getScheme');
    Route::get('program/{id}/apply', 'Farmer\FarmerSchemeController@applicationScheme');
    Route::post('program/{id}/apply', 'Farmer\FarmerSchemeController@submitSchemeApplication');
    Route::get('program/{id}/categories', 'Farmer\FarmerSchemeController@getCategory');
    Route::get('category/{id}/components', 'Farmer\FarmerSchemeController@getComponent');
    Route::get('/schemes', 'Farmer\FarmerSchemeController@farmerSchemes');
    Route::get('/downloadPDF/{id}', 'Farmer\FarmerSchemeController@downloadPDF');
    Route::get('/printdetails/{id}', 'Farmer\FarmerSchemeController@printDetails');
});



// Designation wise Route
Route::prefix('authority')->group(function() {
    Route::get('/user/{user}/designations', 'Auth\AuthorityLoginController@getDesignation');
    Route::get('/login', 'Auth\AuthorityLoginController@showLoginForm')->name('authority.login');
    Route::post('/login', 'Auth\AuthorityLoginController@login')->name('authority.login.submit');
    Route::post('/secondsteplogin', 'Auth\AuthorityLoginController@secondStepLogin')->name('authority.secondlogin');
    Route::post('/logout', 'Auth\AuthorityLoginController@logout')->name('authority.logout');
    // Route::get('/', 'Authority\AuthorityController@index')->name('authority.dashboard');

    Route::prefix('districts')->group(function () {
        Route::get('/', 'Authority\AuthorityController@districts')->name('authority.districts.dashboard');
        Route::resource('/profile', 'Authority\District\ProfileController');

        Route::get('distuser/{id}', 'Authority\District\SubdivisionUserController@getUserDetail');
        Route::get('distsubuser/{id}/designations', 'Authority\District\SubdivisionUserController@getDesignations');
        Route::get('/addsubuser/{id}/details', 'Authority\District\SubdivisionUserController@editUser');
        Route::resource('/addsubuser', 'Authority\District\SubdivisionUserController');
        Route::get('distblockuser/{id}/designations', 'Authority\District\BlockUserController@getDesignations');
        Route::get('distsub/{id}/blocks', 'Authority\District\BlockUserController@getBlocks');
        Route::get('/addblockuser/{id}/details', 'Authority\District\BlockUserController@editUser');
        Route::resource('/addblockuser', 'Authority\District\BlockUserController');
        Route::get('distvillageuser/{id}/designations', 'Authority\District\VillageUserController@getDesignations');
        Route::get('distblock/{id}/villages', 'Authority\District\VillageUserController@getVillages');
        Route::get('/addvillageuser/{id}/details', 'Authority\District\VillageUserController@editUser');
        Route::resource('/addvillageuser', 'Authority\District\VillageUserController');

        //Scheme Distribution By District level Authority in Subdivision 
        Route::get('/schsubdist/{idSchemeActivation}/funddetails', 'Authority\District\SubdivisionDistController@getFunds');
        Route::get('/schsubdist/{id}/schemes', 'Authority\District\SubdivisionDistController@getSchemes');
        Route::get('/schsubdist/{id}/programs', 'Authority\District\SubdivisionDistController@getPrograms');
        Route::resource('/schsubdist', 'Authority\District\SubdivisionDistController');

        //Scheme Distribution By District level Authority in Block 

        Route::get('/schblockdist/{idSubdivision}/{idProgram}/funddetails', 'Authority\District\BlockwiseSchemeDistController@getFunds');
        Route::get('/schblockdist/{idScheme}/programs', 'Authority\District\BlockwiseSchemeDistController@getPrograms');
        Route::get('/schblockdist/{idProgram}/subdivisions', 'Authority\District\BlockwiseSchemeDistController@distSubdivisions');
        Route::resource('/schblockdist', 'Authority\District\BlockwiseSchemeDistController');
        Route::get('/farmer-reg', 'Authority\District\RegFarmerController@registeredFarmer');

        //Scheme(Program) Approval Or Rejection By District User
        Route::get('/apvrscheme', 'Authority\District\SchemeApprRejectController@approvedScheme');
        Route::get('/rejectschemes', 'Authority\District\SchemeApprRejectController@rejectedScheme');
        Route::get('aprvrejectscheme/{idAppliedProgram}/view', 'Authority\District\SchemeApprRejectController@viewAppliedScheme');
        Route::resource('/aprvrejectscheme', 'Authority\District\SchemeApprRejectController');
    });

    Route::prefix('subdivisions')->group(function () {
        Route::get('/', 'Authority\AuthorityController@subdivisions')->name('authority.subdivisions.dashboard');
        Route::resource('/profile', 'Authority\Subdivision\ProfileController');
        Route::get('blockuseradd/{id}/details', 'Authority\Subdivision\BlockUserController@editUser');
        Route::resource('/blockuseradd', 'Authority\Subdivision\BlockUserController');
        Route::get('/addviuser/{id}/details', 'Authority\Subdivision\VillageUserController@editUser');
        Route::resource('/addviuser', 'Authority\Subdivision\VillageUserController');

        //Scheme Distribution By Subdivision level Authority in Block 
        Route::get('/blockdist/{idSchemeActivation}/funddetails', 'Authority\Subdivision\BlockSchemeDistController@getFunds');
        Route::resource('/blockdist', 'Authority\Subdivision\BlockSchemeDistController');
        Route::get('/farmer_reg', 'Authority\Subdivision\RegFarmerController@registeredFarmer');

        //Scheme(Program) Approval Or Rejection By Subdivisionlevel User
        Route::get('/apvscheme', 'Authority\Subdivision\SchemeApprRejectController@approvedScheme');
        Route::get('/rjctscheme', 'Authority\Subdivision\SchemeApprRejectController@rejectedScheme');
        Route::get('apprejectscheme/{idAppliedProgram}/view', 'Authority\Subdivision\SchemeApprRejectController@viewAppliedScheme');
        Route::resource('/apprejectscheme', 'Authority\Subdivision\SchemeApprRejectController');
    });

    Route::prefix('blocks')->group(function () {
        Route::get('/', 'Authority\AuthorityController@blocks')->name('authority.blocks.dashboard');
        Route::resource('/profile', 'Authority\Block\ProfileController');
        Route::get('/viuser/{id}/details', 'Authority\Block\VillageUserController@editUser');
        Route::resource('/viuser', 'Authority\Block\VillageUserController');

        //Scheme(Program) Approval Or Rejection By Blocklevel User
        Route::get('/aprscheme', 'Authority\Block\SchemeApprRejectController@approvedScheme');
        Route::get('/rjscheme', 'Authority\Block\SchemeApprRejectController@rejectedScheme');
        Route::get('approvescheme/{idAppliedProgram}/view', 'Authority\Block\SchemeApprRejectController@viewAppliedScheme');
        Route::resource('/approvescheme', 'Authority\Block\SchemeApprRejectController');
        //Faremer  Rejection By Blocklevel User
        Route::get('/reg-farmer', 'Authority\Block\RegFarmerController@registeredFarmer');
    });

    Route::prefix('villages')->group(function () {
        Route::get('/', 'Authority\AuthorityController@village')->name('authority.villages.dashboard');
        Route::resource('/profile', 'Authority\Village\ProfileController');
        //Scheme(Program) Approval Or Rejection By Villagelevel User
        Route::get('apr/{idAppliedProgram}/view', 'Authority\Village\SchemeApprRejectController@viewAppliedScheme');
        Route::get('/apprscheme', 'Authority\Village\SchemeApprRejectController@approvedScheme');
        Route::get('/rejscheme', 'Authority\Village\SchemeApprRejectController@rejectedScheme');
        Route::resource('/schappreject', 'Authority\Village\SchemeApprRejectController');
        //Faremer  Rejection By Villagelevel User
        Route::get('/regfarmers', 'Authority\Village\RegFarmerController@registeredFarmer');
        Route::get('farmer/{idFarmer}/cancelreg', 'Authority\Village\RegFarmerController@cancelFarmerReg');
        Route::get('/blistfarmers', 'Authority\Village\RegFarmerController@blacklistedFarmer');
    });
});
