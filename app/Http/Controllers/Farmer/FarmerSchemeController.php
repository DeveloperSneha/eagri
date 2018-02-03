<?php

namespace App\Http\Controllers\Farmer;

use Illuminate\Http\Request;
use App\Http\Controllers\Farmer\FarmerController;
use DB;
use Auth;
use PDF;

class FarmerSchemeController extends FarmerController {

    /**
     * Display list Of Activated Scheme of Farmer's District
     *
     */
    public function getScheme($id) {
        $farmer = \App\Farmer::where('idFarmer', '=', Auth::user()->idFarmer)->first();
        $section = \App\Section:: where('idSection', '=', $id)->first();
        $schemes = DB::table('schemedistributionblock')
                ->join('schemeactivation', 'schemedistributionblock.idSchemeActivation', '=', 'schemeactivation.idSchemeActivation')
                ->join('scheme', 'schemeactivation.idScheme', '=', 'scheme.idScheme')
                ->join('program', 'schemeactivation.idProgram', '=', 'program.idProgram')
                ->where('schemedistributionblock.idBlock', '=', $farmer->idBlock)
                ->where('scheme.idSection', '=', $section->idSection)
                ->get();
        //dd($schemes);
        return view('farmer.schemes.scheme', compact('schemes', 'district', 'section', 'farmer'));
    }

    /**
     * Show the form of Applying For  New Scheme.
     *
     */
    public function applicationScheme($id) {
        $farmer = \App\Farmer::where('idFarmer', '=', Auth::user()->idFarmer)->first();
        $program = \App\Program:: where('idProgram', '=', $id)->first();

        return view('farmer.schemes.farmer_application', compact('program', 'farmer'));
    }

    /**
     * Store  Farmer Submitted Scheme Application.
     *
     */
    public function submitSchemeApplication(Request $request, $id) {
        //  dd($request->all());
        //  dd(Auth::user()->idFarmer);
        $rules = [
            'idProgram' => 'required',
            'areaApplied' => 'required'
        ];
        $messages = [
            'idProgram.required' => 'Program Must be Selected',
            'areaApplied.required' => 'Area For Which Applied /No.Of Items Applied Should Not Be Empty'
        ];
        $this->validate($request, $rules, $messages);
        $appsch = new \App\FarmerAppliedScheme();
        $appsch->idFarmer = Auth::user()->idFarmer;
        $appsch->fill($request->all());
        $appsch->save();
        return redirect('/farmer/schemes')->with('message', 'YOU HAVE SUCCESSFULLY APPLIED FOR THIS SCHEME!');
    }

    /**
     * Show List Of category Of  Scheme Program.
     * Used in farmer Scheme Application Category drop-down
     */
    public function getCategory($id) {
        $categories = [0 => '--- Select Category ---'] + \App\Category::where("idProgram", $id)
                        ->pluck("categoryName", "idCategory")->toArray();
        return json_encode($categories);
    }

    /**
     * Show List Of component Of  Scheme Program Category.
     * Used in farmer Scheme Application Component drop-down
     */
    public function getComponent($id) {
        $components = [0 => '--- Select Components ---'] + \App\Component::where("idCategory", $id)
                        ->pluck("componentName", "idComponent")->toArray();
        return json_encode($components);
    }

    /**
     * Display list Of Applied Scheme of Farmer
     *
     */
    public function farmerSchemes() {
        $farmer = \App\Farmer::where('idFarmer', '=', Auth::user()->idFarmer)->first();
        $fschemes = \App\FarmerAppliedScheme::where('idFarmer', '=', Auth::user()->idFarmer)->get();
        // dd($fschemes);
        return view('farmer.schemes.applied_schemes', compact('fschemes', 'farmer'));
    }

    /**
     * Print Details
     *
     */
    public function printDetails($id) {
        $fscheme = \App\FarmerAppliedScheme::where('idProgram', '=', $id)->first();
        return view('farmer.schemes.print_detail', compact('fscheme'));
    }

    /**
     * Generate PDF
     *
     */
    public function downloadPDF($id) {
        $fscheme = \App\FarmerAppliedScheme::where('idProgram', '=', $id)->first();
        $pdf = PDF::loadView('farmer.schemes.pdf', compact('fscheme'));
        return $pdf->stream('invoice.pdf');
    }

    public function getAppliedProgramStatus($id) {
        $farmer = \App\Farmer::where('idFarmer', '=', Auth::user()->idFarmer)->first();
        $fscheme = \App\FarmerAppliedScheme::where('idProgram', '=', $id)->first();
        $sch_section = DB::table('scheme')
                ->join('section', 'scheme.idSection', '=', 'section.idSection')
                ->where('idScheme', '=', $fscheme->idScheme)
                ->first();
        $auth_desig = \App\Designation::where('idSection', '=', $sch_section->idSection)
                        ->orderBy('level','desc')->get();
        return view('farmer.schemes.appliedprogram_status', compact('farmer', 'fscheme', 'auth_desig'));
    }

}
