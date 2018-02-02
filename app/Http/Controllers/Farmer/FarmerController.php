<?php

namespace App\Http\Controllers\Farmer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class FarmerController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:farmer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $farmer = \App\Farmer::where('idFarmer', '=', Auth::user()->idFarmer)->first();
        $sections = \App\Section:: orderBy('idSection')->get();
        $districts = DB::table('schemedistributionblock')
                ->join('schemeactivation', 'schemedistributionblock.idSchemeActivation', '=', 'schemeactivation.idSchemeActivation')
                ->join('program', 'schemeactivation.idProgram', '=', 'program.idProgram')
                ->join('scheme', 'schemeactivation.idScheme', '=', 'scheme.idScheme')
                ->join('section', 'scheme.idSection', '=', 'section.idSection')
                ->where('schemedistributionblock.idBlock', '=', $farmer->idBlock)
                ->get();
//        dd($districts);
        return view('farmer.dashboard', compact('sections', 'farmer', 'schemes', 'districts'));
    }

    public function getProfile() {
        $farmer = \App\Farmer::where('idFarmer', '=', Auth::user()->idFarmer)->first();
        return view('farmer.profile', compact('farmer'));
    }

    public function getAuthinfo() {
        $farmer = \App\Farmer::where('idFarmer', '=', Auth::user()->idFarmer)->first();
        $sections = \App\Section::all();
//        $info = DB::table('farmers')->distinct()
//                ->join('user_designation_district_mapping', 'farmers.idDistrict', '=', 'user_designation_district_mapping.idDistrict')
//                ->join('users', 'users.idUser', '=', 'user_designation_district_mapping.idUser')
//                ->join('designation', 'designation.idDesignation', '=', 'user_designation_district_mapping.idDesignation')
//                ->join('section', 'section.idSection', '=', 'designation.idSection')
//                ->where('farmers.idFarmer', '=', $farmer->idFarmer)
//                ->select("users.name", "designation.designationname", "section.sectionName", "users.mobile", "users.ofc_address")
//                ->orderBy('section.idSection')
//                ->get();
        return view('farmer.authinfo', compact('info', 'farmer', 'sections'));
    }

    public function getAvaschemes() {
        $farmer = \App\Farmer::where('idFarmer', '=', Auth::user()->idFarmer)->first();
        $sections = \App\Section:: orderBy('idSection')->get();
        $districts = DB::table('schemedistributionblock')
                ->join('schemeactivation', 'schemedistributionblock.idSchemeActivation', '=', 'schemeactivation.idSchemeActivation')
                ->join('program', 'schemeactivation.idProgram', '=', 'program.idProgram')
                ->join('scheme', 'schemeactivation.idScheme', '=', 'scheme.idScheme')
                ->join('section', 'scheme.idSection', '=', 'section.idSection')
                ->where('schemedistributionblock.idBlock', '=', $farmer->idBlock)
                ->get();
//        dd($districts);
        return view('farmer.avaschemes', compact('sections', 'farmer', 'schemes', 'districts'));
    }

}
