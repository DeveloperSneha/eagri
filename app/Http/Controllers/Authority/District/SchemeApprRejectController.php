<?php

namespace App\Http\Controllers\Authority\District;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use DB;

class SchemeApprRejectController extends \App\Http\Controllers\Authority\AuthorityController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
        $user_section = \App\Designation::where('idDesignation', '=', Session::get('idDesignation'))
                        ->pluck('idSection')->first();
        $designations = \App\Designation::where('idSection', '=', $user_section)
                        ->where('level', 2)
                        ->get()
                        ->pluck('idDesignation')->toArray();
        $schapr = \App\SchemeApproveReject::where('idDesignation', '=', Session::get('idDesignation'))
                        ->get()->pluck('idAppliedScheme')->toArray();
        $schemes = DB::table('schemeappreject')
                ->join('farmerapplied_scheme', 'schemeappreject.idAppliedScheme', '=', 'farmerapplied_scheme.idAppliedScheme')
                ->join('scheme', 'farmerapplied_scheme.idScheme', '=', 'scheme.idScheme')
                ->join('program', 'farmerapplied_scheme.idProgram', '=', 'program.idProgram')
                ->join('farmers', 'farmerapplied_scheme.idFarmer', '=', 'farmers.idFarmer')
                ->join('district', 'farmers.idDistrict', '=', 'district.idDistrict')
                ->join('subdivision', 'farmers.idSubdivision', '=', 'subdivision.idSubdivision')
                ->join('block', 'farmers.idBlock', '=', 'block.idBlock')
                ->join('village', 'farmers.idVillage', '=', 'village.idVillage')
                ->whereIn('idDesignation', $designations)
                ->whereNotIn('farmerapplied_scheme.idAppliedScheme', $schapr)
                ->get();
        return view('authority.districts.scheme_for_approval', compact('schemes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    public function viewAppliedScheme($id) {
        $app_reject_scheme = \App\SchemeApproveReject::where('idSchemeappreject', '=', $id)->first();
        return view('authority.districts.view_appliedscheme', compact('app_reject_scheme'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //dd(Session::get('idDesignation'));
        // dd($request->all());
        $rules = [
            'remarks' => 'required',
            'haveChecked' => 'required'
        ];
        $messages = [
            'haveChecked.required' => 'Please Confirm You Have Checked And Verified The Details Of The Farmer'
        ];
        $this->validate($request, $rules, $messages);
        $workflow = \App\WorkflowStep::where('idDesignation', '=', Session::get('idDesignation'))->first();
        //  dd($workflow);
        $approve_scheme = new \App\SchemeApproveReject();
        $approve_scheme->fill($request->all());
        $approve_scheme->haveChecked = $request->has('haveChecked') ? 'Y' : 'N';
        $approve_scheme->idDesignation = Session::get('idDesignation');
        $approve_scheme->idWorkflow = $workflow->idWorkflow;

        $farmer_app_scheme = \App\FarmerAppliedScheme::where('idAppliedScheme', '=', $request->idAppliedScheme)->first();
        if ($request->has('Approve')) {
            DB::beginTransaction();
            $approve_scheme->status = 'A';
            $approve_scheme->save();
            $farmer_app_scheme->status = 'A';
            $farmer_app_scheme->update();
            DB::commit();
            return redirect('authority/districts/apvrscheme');
        } else {
            DB::beginTransaction();
            $approve_scheme->status = 'R';
            $approve_scheme->save();
            $farmer_app_scheme->status = 'R';
            $farmer_app_scheme->update();
            DB::commit();
            return redirect('authority/districts/rejectschemes');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function approvedScheme() {
        $schemes = DB::table('schemeappreject')
                ->join('farmerapplied_scheme', 'schemeappreject.idAppliedScheme', '=', 'farmerapplied_scheme.idAppliedScheme')
                ->join('scheme', 'farmerapplied_scheme.idScheme', '=', 'scheme.idScheme')
                ->join('program', 'farmerapplied_scheme.idProgram', '=', 'program.idProgram')
                ->join('farmers', 'farmerapplied_scheme.idFarmer', '=', 'farmers.idFarmer')
                ->join('district', 'farmers.idDistrict', '=', 'district.idDistrict')
                ->join('subdivision', 'farmers.idSubdivision', '=', 'subdivision.idSubdivision')
                ->join('block', 'farmers.idBlock', '=', 'block.idBlock')
                ->join('village', 'farmers.idVillage', '=', 'village.idVillage')
                ->where('idDesignation', '=', Session::get('idDesignation'))
                ->where('farmers.idDistrict', '=', Session::get('idDistrict'))
                ->where('schemeappreject.status', '=', 'A')
                ->select('farmers.name', 'subdivision.subDivisionName', 'scheme.schemeName', 'programName', 'district.districtName', 'block.blockName', 'village.villageName')
                ->get();
        // dd($schemes);
        return view('authority.districts.approved_scheme', compact('schemes'));
    }

    public function rejectedScheme() {
        $schemes = DB::table('schemeappreject')
                ->join('farmerapplied_scheme', 'schemeappreject.idAppliedScheme', '=', 'farmerapplied_scheme.idAppliedScheme')
                ->join('scheme', 'farmerapplied_scheme.idScheme', '=', 'scheme.idScheme')
                ->join('program', 'farmerapplied_scheme.idProgram', '=', 'program.idProgram')
                ->join('farmers', 'farmerapplied_scheme.idFarmer', '=', 'farmers.idFarmer')
                ->join('district', 'farmers.idDistrict', '=', 'district.idDistrict')
                ->join('subdivision', 'farmers.idSubdivision', '=', 'subdivision.idSubdivision')
                ->join('block', 'farmers.idBlock', '=', 'block.idBlock')
                ->join('village', 'farmers.idVillage', '=', 'village.idVillage')
                ->where('idDesignation', '=', Session::get('idDesignation'))
                ->where('farmers.idDistrict', '=', Session::get('idDistrict'))
                ->where('schemeappreject.status', '=', 'R')
                ->select('farmers.name', 'subdivision.subDivisionName', 'scheme.schemeName', 'programName', 'district.districtName', 'block.blockName', 'village.villageName')
                ->get();
        return view('authority.districts.rejected_scheme', compact('schemes'));
    }

    public function viewStatusAnalytics() {
        $asch = DB::table('schemeappreject')
                        ->join('farmerapplied_scheme', 'schemeappreject.idAppliedScheme', '=', 'farmerapplied_scheme.idAppliedScheme')
                        ->join('scheme', 'farmerapplied_scheme.idScheme', '=', 'scheme.idScheme')
                        ->join('program', 'farmerapplied_scheme.idProgram', '=', 'program.idProgram')
                        ->join('farmers', 'farmerapplied_scheme.idFarmer', '=', 'farmers.idFarmer')
                        ->join('district', 'farmers.idDistrict', '=', 'district.idDistrict')
                        ->where('idDesignation', '=', Session::get('idDesignation'))
                        ->where('farmers.idDistrict', '=', Session::get('idDistrict'))
                        ->selectRaw('count(schemeappreject.status) as count,schemeappreject.status')
                        ->groupBy('status')->get();
        
        $user = array();
        foreach ($asch as $result) {
            $user[$result->status] = (int) $result->count;
        }
        return view('authority.districts.status_analytics', compact('user'));
    }

}
