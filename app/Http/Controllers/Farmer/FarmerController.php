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

    public function updateMobile() {
        $farmer = \App\Farmer::where('idFarmer', '=', Auth::user()->idFarmer)->first();
        return view('farmer.updtmobile', compact('farmer'));
    }

    public function mobile(Request $request){
        dd('here');
        $rules = [
            'mobile' => 'required|min:10|max:10|unique:farmers|regex:/^[6789]\d{9}$/',
        ];
        $message = [
            'mobile.required' => 'Mobile Number Must Not be Empty.',
            'mobile.unique' => 'Mobile Number  is Already Taken',
            'mobile.regex' => 'Mobile Number is Not Valid',
            'mobile.min' => 'Mobile Number Must Have Atleast 10 digits',
        ];
//        $this->Validate($request, $rules, $message);
//        $mob = new \App\Farmer();
//        $mob->idFarmer = Auth::user()->idFarmer;
//        $mob->fill($request->all());
//        return redirect('/farmer/profile')->with('message', 'YOUR REQUEST HAS BEEN SENT TO YOUR AUTHORITIES!');
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
