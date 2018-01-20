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

}
