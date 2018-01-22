<?php

namespace App\Http\Controllers\Authority\Subdivision;

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
        $user_level = \App\Designation::where('idDesignation', '=', Session::get('idDesignation'))
                        ->pluck('level')->first();
        $designations = \App\Designation::where('idSection', '=', $user_section)
                        ->where('level', '>', $user_level)
                        ->get()
                        ->pluck('idDesignation')->toArray();
        if (count($designations) >=1) {
            $other_desig = \App\Designation::where('idSection', '=', $user_section)
                            ->where('level', 3)
                            ->get()
                            ->pluck('idDesignation')->toArray();
            $schemes = DB::table('schemeappreject')
                    ->join('farmerapplied_scheme', 'schemeappreject.idAppliedScheme', '=', 'farmerapplied_scheme.idAppliedScheme')
                    ->join('scheme', 'farmerapplied_scheme.idScheme', '=', 'scheme.idScheme')
                    ->join('program', 'farmerapplied_scheme.idProgram', '=', 'program.idProgram')
                    ->join('farmers', 'farmerapplied_scheme.idFarmer', '=', 'farmers.idFarmer')
                    ->join('district', 'farmers.idDistrict', '=', 'district.idDistrict')
                    ->join('subdivision', 'farmers.idSubdivision', '=', 'subdivision.idSubdivision')
                    ->join('block', 'farmers.idBlock', '=', 'block.idBlock')
                    ->join('village', 'farmers.idVillage', '=', 'village.idVillage')
                    ->whereIn('idDesignation', $other_desig)
                    ->get();
        } else {
            $schemes = DB::table('farmerapplied_scheme')
                    ->join('scheme', 'farmerapplied_scheme.idScheme', '=', 'scheme.idScheme')
                    ->join('program', 'farmerapplied_scheme.idProgram', '=', 'program.idProgram')
                    ->join('farmers', 'farmerapplied_scheme.idFarmer', '=', 'farmers.idFarmer')
                    ->join('district', 'farmers.idDistrict', '=', 'district.idDistrict')
                    ->join('subdivision', 'farmers.idSubdivision', '=', 'subdivision.idSubdivision')
                    ->join('block', 'farmers.idBlock', '=', 'block.idBlock')
                    ->join('village', 'farmers.idVillage', '=', 'village.idVillage')
                    ->whereIn('farmers.idSubdivision', Session::get('idSubdivision'))
                    ->select('name', 'farmers.idFarmer', 'schemeName', 'programName', 'villageName', 'blockName', 'scheme.idScheme', 'idAppliedScheme')
                    ->get();
        }
        return view('authority.subdivisions.scheme_for_approval', compact('schemes'));
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
        return view('authority.subdivisions.view_appliedscheme', compact('app_reject_scheme'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //dd('here');
        $rules = [
            'remarks' => 'required',
            'haveChecked' => 'required'
        ];
        $messages = [
            'haveChecked.required' => 'Please Confirm You Have Checked And Verified The Details Of The Farmer'
        ];
        $this->validate($request, $rules, $messages);
        $workflow = \App\WorkflowStep::where('idDesignation', '=', Session::get('idDesignation'))->first();
        $approve_scheme = new \App\SchemeApproveReject();
        $approve_scheme->fill($request->all());
        $approve_scheme->haveChecked = $request->has('haveChecked') ? 'Y' : 'N';
        $approve_scheme->idDesignation = Session::get('idDesignation');
        $approve_scheme->idWorkflow = $workflow->idWorkflow;

        if ($request->has('Approve')) {
            $approve_scheme->status = 'A';
            $approve_scheme->save();
            return redirect('authority/subdivisions/apvscheme');
        } else {
            $approve_scheme->status = 'R';
            $approve_scheme->save();
            return redirect('authority/subdivisions/rjctscheme');
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
                ->where('schemeappreject.status', '=', 'A')
                ->select('farmers.name','subdivision.subDivisionName' ,'scheme.schemeName', 'programName', 'district.districtName', 'block.blockName', 'village.villageName')
                ->get();
        // dd($schemes);
        return view('authority.subdivisions.approved_scheme', compact('schemes'));
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
                ->where('schemeappreject.status', '=', 'R')
                ->select('farmers.name','subdivision.subDivisionName', 'scheme.schemeName', 'programName', 'district.districtName', 'block.blockName', 'village.villageName')
                ->get();
        return view('authority.subdivisions.rejected_scheme', compact('schemes'));
    }

}
