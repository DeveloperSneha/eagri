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
        $schapr = \App\SchemeApproveReject::where('idDesignation', '=', Session::get('idDesignation'))
                        ->get()->pluck('idAppliedScheme')->toArray();
        if (count($designations) >= 1) {
            // If None Of Lower level approve Farmer Scheme
            $sch_noresponse = DB::table('farmerapplied_scheme')
                    ->join('scheme', 'farmerapplied_scheme.idScheme', '=', 'scheme.idScheme')
                    ->join('program', 'farmerapplied_scheme.idProgram', '=', 'program.idProgram')
                    ->join('farmers', 'farmerapplied_scheme.idFarmer', '=', 'farmers.idFarmer')
                    ->join('district', 'farmers.idDistrict', '=', 'district.idDistrict')
                    ->join('subdivision', 'farmers.idSubdivision', '=', 'subdivision.idSubdivision')
                    ->join('block', 'farmers.idBlock', '=', 'block.idBlock')
                    ->join('village', 'farmers.idVillage', '=', 'village.idVillage')
                    ->whereRaw('DATEDIFF(now(),farmerapplied_scheme.created_at) > 10')
                    ->whereRaw('DATEDIFF(now(),farmerapplied_scheme.created_at) <= 15')
                    ->where('farmers.idSubdivision', Session::get('idSubdivision'))
                    ->select('name', 'farmers.idFarmer', 'schemeName', 'programName','subDivisionName', 'districtName', 'villageName', 'blockName', 'scheme.idScheme', 'idAppliedScheme')
                    ->get();
            if ($sch_noresponse->count() > 0) {
                $sch_with_noresponse = $sch_noresponse;
            }
            // If  Lowest  level approved Farmer Scheme But Block Level Not responded within 5 Days

            $other_lower_desig = \App\Designation::where('idSection', '=', $user_section)
                            ->where('level', 4)
                            ->get()
                            ->pluck('idDesignation')->toArray();
            $schemes_lower_response = DB::table('schemeappreject')
                    ->join('farmerapplied_scheme', 'schemeappreject.idAppliedScheme', '=', 'farmerapplied_scheme.idAppliedScheme')
                    ->join('scheme', 'farmerapplied_scheme.idScheme', '=', 'scheme.idScheme')
                    ->join('program', 'farmerapplied_scheme.idProgram', '=', 'program.idProgram')
                    ->join('farmers', 'farmerapplied_scheme.idFarmer', '=', 'farmers.idFarmer')
                    ->join('district', 'farmers.idDistrict', '=', 'district.idDistrict')
                    ->join('subdivision', 'farmers.idSubdivision', '=', 'subdivision.idSubdivision')
                    ->join('block', 'farmers.idBlock', '=', 'block.idBlock')
                    ->join('village', 'farmers.idVillage', '=', 'village.idVillage')
                    ->where('farmers.idSubdivision', Session::get('idSubdivision'))
                    ->whereNotIn('farmerapplied_scheme.idAppliedScheme', $schapr)
                    ->whereRaw('DATEDIFF(now(),schemeappreject.created_at) > 5')
                    ->whereIn('idDesignation', $other_lower_desig)
                    ->get();
            if ($schemes_lower_response->count() > 0) {
                $sch_with_lower_response = $schemes_lower_response;
            }

            // If  Block  level approved Farmer Scheme
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
                    ->whereNotIn('farmerapplied_scheme.idAppliedScheme', $schapr)
                    ->where('farmers.idSubdivision', Session::get('idSubdivision'))
                    ->whereIn('idDesignation', $other_desig)
                    ->whereRaw('DATEDIFF(now(),schemeappreject.created_at) <= 5')
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
                    ->whereRaw('DATEDIFF(now(),farmerapplied_scheme.created_at) <= 5')
                    ->where('farmers.idSubdivision', Session::get('idSubdivision'))
                    ->select('name', 'farmers.idFarmer', 'schemeName', 'programName', 'villageName', 'blockName','subDivisionName', 'scheme.idScheme', 'idAppliedScheme')
                    ->get();
        }
        return view('authority.subdivisions.scheme_for_approval', compact('schemes', 'sch_with_noresponse', 'sch_with_lower_response'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    public function viewAprRejScheme($id) {
        $app_reject_scheme = \App\SchemeApproveReject::where('idSchemeappreject', '=', $id)->first();
        return view('authority.subdivisions.view_appliedscheme', compact('app_reject_scheme'));
    }

    public function viewFarmerAppliedScheme($id) {
        $farmer_scheme = \App\FarmerAppliedScheme::findOrfail($id);
        return view('authority.subdivisions.view_appliedscheme', compact('farmer_scheme'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      //  dd('here');
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
                ->where('farmers.idSubdivision', '=', Session::get('idSubdivision'))
                ->where('schemeappreject.status', '=', 'A')
                ->select('farmers.name', 'subdivision.subDivisionName', 'scheme.schemeName', 'programName', 'district.districtName', 'block.blockName', 'village.villageName')
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
                ->where('farmers.idSubdivision', '=', Session::get('idSubdivision'))
                ->where('schemeappreject.status', '=', 'R')
                ->select('farmers.name', 'subdivision.subDivisionName', 'scheme.schemeName', 'programName', 'district.districtName', 'block.blockName', 'village.villageName')
                ->get();
        return view('authority.subdivisions.rejected_scheme', compact('schemes'));
    }

}
