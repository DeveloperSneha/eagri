<?php

namespace App\Http\Controllers\Authority\Village;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Session;

class SchemeApprRejectController extends \App\Http\Controllers\Authority\AuthorityController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
        $user_village = $user->userdesig()
                        ->where('idDesignation', '=', Session::get('idDesignation'))
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->where('idSubdivision', '=', Session::get('idSubdivision'))
                        ->where('idBlock', '=', Session::get('idBlock'))
                        ->whereNotNull('idVillage')
                        ->get()->pluck('idVillage')->toArray();
        $schapr = \App\SchemeApproveReject::where('idDesignation', '=', Session::get('idDesignation'))
                        ->get()->pluck('idAppliedScheme')->toArray();
        $schemes = DB::table('farmerapplied_scheme')
                ->join('scheme', 'farmerapplied_scheme.idScheme', '=', 'scheme.idScheme')
                ->join('program', 'farmerapplied_scheme.idProgram', '=', 'program.idProgram')
                ->join('farmers', 'farmerapplied_scheme.idFarmer', '=', 'farmers.idFarmer')
                ->join('district', 'farmers.idDistrict', '=', 'district.idDistrict')
                ->join('subdivision', 'farmers.idSubdivision', '=', 'subdivision.idSubdivision')
                ->join('block', 'farmers.idBlock', '=', 'block.idBlock')
                ->join('village', 'farmers.idVillage', '=', 'village.idVillage')
                ->whereRaw('DATEDIFF(now(),farmerapplied_scheme.created_at) <= 5')
                ->whereIn('farmers.idVillage', $user_village)
                ->whereNotIn('farmerapplied_scheme.idAppliedScheme', $schapr)
                ->select('name', 'farmers.idFarmer', 'schemeName', 'programName', 'subDivisionName', 'villageName', 'blockName', 'scheme.idScheme', 'idAppliedScheme')
                ->get();

        //dd($schemes);
        return view('authority.villages.scheme_for_approval', compact('schemes'));
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
        $farmer_scheme = \App\FarmerAppliedScheme::findOrfail($id);
        // dd($farmer_scheme);
        return view('authority.villages.view_appliedscheme', compact('farmer_scheme'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //dd($request->all());
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

        if ($request->has('Approve')) {
            $approve_scheme->status = 'A';
            $approve_scheme->save();
            return redirect('authority/villages/apprscheme');
        } else {
            $approve_scheme->status = 'R';
            $approve_scheme->save();
            return redirect('authority/villages/rejscheme');
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
        $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
        $user_village = $user->userdesig()
                        ->where('idDesignation', '=', Session::get('idDesignation'))
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->where('idSubdivision', '=', Session::get('idSubdivision'))
                        ->where('idBlock', '=', Session::get('idBlock'))
                        ->whereNotNull('idVillage')
                        ->get()->pluck('idVillage')->toArray();
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
                ->whereIn('farmers.idVillage', $user_village)
                ->where('schemeappreject.status', '=', 'A')
                ->select('farmers.name', 'scheme.schemeName', 'programName', 'district.districtName', 'subDivisionName', 'block.blockName', 'village.villageName')
                ->get();
        // dd($schemes);
        return view('authority.villages.approved_scheme', compact('schemes'));
    }

    public function rejectedScheme() {
        $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
        $user_village = $user->userdesig()
                        ->where('idDesignation', '=', Session::get('idDesignation'))
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->where('idSubdivision', '=', Session::get('idSubdivision'))
                        ->where('idBlock', '=', Session::get('idBlock'))
                        ->whereNotNull('idVillage')
                        ->get()->pluck('idVillage')->toArray();
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
                ->whereIn('farmers.idVillage', $user_village)
                ->where('schemeappreject.status', '=', 'R')
                ->select('farmers.name', 'scheme.schemeName', 'program.programName', 'subDivisionName', 'district.districtName', 'block.blockName', 'village.villageName')
                ->get();
        return view('authority.villages.rejected_scheme', compact('schemes'));
    }

}
