<?php

namespace App\Http\Controllers\Authority\District;

use Illuminate\Http\Request;
use App\Http\Requests\SchSubdivisionRequest;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use DB;

class SubdivisionDistController extends \App\Http\Controllers\Authority\AuthorityController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $schsubdivision = \App\SchSubdivisionDistribution::orderBy('idSchemDistributionSubdivision')->get();
        $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
        $sections = ['' => '---Select Section---'] + $user->userdesig()->with('designation.section')
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->whereNull('idSubdivision')
                        ->whereNull('idBlock')
                        ->whereNull('idVillage')
                        ->get()
                        ->pluck('designation.section.sectionName', 'designation.section.idSection')
                        ->toArray();
        $user_district = $user->userdesig()
                        ->with('district')
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->get()
                        ->pluck('district.districtName', 'district.idDistrict')->toArray();
        $subdivisions = \App\Subdivision::where("idDistrict", Session::get('idDistrict'))->get()
                        ->pluck("subDivisionName", "idSubdivision")->toArray();
        return view('authority.districts.schdist_subdivision', compact('schsubdivision', 'sections', 'subdivisions', 'user_district'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchSubdivisionRequest $request) {
        // dd($request->idDistrict);
        foreach ($request->subdivisions as $dis)
            if (isset($dis['idSubdivision'])) {
                $schdistrict = new \App\SchSubdivisionDistribution();
                $schdistrict->fill($request->all());
                $schdistrict->idSubdivision = $dis['idSubdivision'];
                $schdistrict->schemeDistributionDistrict = $request->idDistrict;
                $schdistrict->amountSubdivision = $dis['amountSubdivision'];
                $schdistrict->areaSubdivision = $dis['areaSubdivision'];
                $schdistrict->save();
            }
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        }
        return redirect('/authority/districts/schsubdist');
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

    public function getSchemes($id) {
        $schemes = \App\Scheme::where("idSection", $id)
                        ->pluck("schemeName", "idScheme")->toArray();
        return json_encode($schemes);
    }

    public function getPrograms($id) {
        //dd($id);
        $programs = DB::table('schemedistributiondistrict')
                        ->join('schemeactivation', 'schemedistributiondistrict.idSchemeActivation', '=', 'schemeactivation.idSchemeActivation')
                        // ->join('scheme', 'schemeactivation.idScheme', '=', 'scheme.idScheme')
                        ->join('program', 'schemeactivation.idProgram', '=', 'program.idProgram')
                        ->where('schemeactivation.idScheme', '=', $id)
                        ->select('schemeactivation.idSchemeActivation', 'program.programName')
                        //  ->groupBy('schemedistributiondistrict.idSchemeActivation')
                        ->get()
                        ->pluck('programName', 'idSchemeActivation')->toArray();
        // $programs = DB::table()->
        return json_encode($programs);
    }

    public function getFunds($id) {
        $schact = DB::table('schemedistributiondistrict')
                        ->leftjoin('schemeactivation', 'schemeactivation.idSchemeActivation', '=', 'schemedistributiondistrict.idSchemeActivation')
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->where('schemedistributiondistrict.idSchemeActivation', '=', $id)
                        ->select('amountDistrict AS TotalFund', 'areaDistrict AS TotalArea', 'assistance AS Assistance')->first();
       // dd($schact);
        $dist_sch = DB::table('schemedistributiondistrict')
                        ->leftjoin('schemeactivation', 'schemeactivation.idSchemeActivation', '=', 'schemedistributiondistrict.idSchemeActivation')
                        ->leftjoin('schemedistributionsubdivision', 'schemedistributionsubdivision.idSchemeActivation', '=', 'schemedistributiondistrict.idSchemeActivation')
                        ->select(DB::raw('schemedistributiondistrict.amountDistrict   -  SUM(schemedistributionsubdivision.amountSubdivision) AS TotalFund'), DB::raw('schemedistributiondistrict.areaDistrict - SUM(schemedistributionsubdivision.areaSubdivision) AS TotalArea'), 'schemeactivation.assistance AS Assistance')
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->where('schemedistributiondistrict.idSchemeActivation', '=', $id)
                        ->first();
      //  dd($dist_sch);
        if ($dist_sch->TotalFund !=null) {
            return json_encode($dist_sch);
        }
        return json_encode($schact);
    }

}
