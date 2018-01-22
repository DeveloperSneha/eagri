<?php

namespace App\Http\Controllers\Authority\District;

use Illuminate\Http\Request;
use App\Http\Requests\SchBlockDistRequest;
use Auth;
use DB;
use Session;

class BlockwiseSchemeDistController extends \App\Http\Controllers\Authority\AuthorityController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // dd('here');
        $schblock = \App\SchBlockDistribution::orderBy('idSchemDistributionBlock')->get();
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
        $subdivisions = ['---Select Subdivision---'] + \App\Subdivision::where("idDistrict", Session::get('idDistrict'))->get()
                        ->pluck("subDivisionName", "idSubdivision")->toArray();
        return view('authority.districts.schdist_block', compact('schblock','schsubdivision', 'sections', 'subdivisions', 'user_district'));
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
    public function store(SchBlockDistRequest $request) {
       // dd($request->all());
        foreach ($request->blocks as $var)
            if (isset($var['idBlock'])) {
                $schblock = new \App\SchBlockDistribution();
                $schblock->fill($request->all());
                $schblock->schemeDistributionDistrict = $request->idDistrict;
                $schblock->schemeDistributionSubdivision = $request->idSubdivision;
                $schblock->idBlock = $var['idBlock'];
                $schblock->amountBlock = $var['amountBlock'];
                $schblock->areaBlock = $var['areaBlock'];
                $schblock->save();
            }
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        }
        return redirect('authority/districts/schblockdist');
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
        $schblock = \App\SchBlockDistribution::where('idSchemDistributionBlock', '=', $id)->first();
        // dd('here');
        return view('authority.schemes.edit_blockdistribution', compact('schblock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $rules = [
            'amountBlock' => 'required',
            'areaBlock' => 'required'
        ];
        $messages = [
            'amountBlock.required' => 'Scheme Must Be Selected',
            'areaBlock.required' => 'Scheme Distribution(District) Must be Selected'
        ];
        $this->validate($request, $rules, $messages);

        $schblock = \App\SchBlockDistribution::where('idSchemDistributionBlock', '=', $id)->first();
        $schblock->fill($request->all());
        $schblock->update();
        return redirect('authority/blockwisescheme');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $schblock = \App\SchBlockDistribution::where('idSchemDistributionBlock', '=', $id)->first();
        $schblock->delete();
        return redirect('authority/blockwisescheme');
    }

    public function getPrograms($id) {
        //dd($id);
        $programs = DB::table('schemedistributionsubdivision')
                        ->join('schemeactivation', 'schemedistributionsubdivision.idSchemeActivation', '=', 'schemeactivation.idSchemeActivation')
                        ->join('program', 'schemeactivation.idProgram', '=', 'program.idProgram')
                        ->where('schemeDistributionDistrict', '=', Session::get('idDistrict'))
                        ->where('schemeactivation.idScheme', '=', $id)
                        ->select('schemeactivation.idSchemeActivation', 'program.programName')
                        ->groupBy('schemedistributionsubdivision.idSchemeActivation')
                        ->get()->pluck('programName', 'idSchemeActivation')->toArray();
        // $programs = DB::table()->
        return json_encode($programs);
    }

    public function distSubdivisions($id) {
        $subdivisions = \App\SchSubdivisionDistribution::with('subdivision')
                        ->where('idSchemeActivation', '=', $id)
                        // ->select('subdivision.subDivisionName','subdivision.idSubdivision')
                        ->get()->pluck('subdivision.subDivisionName', 'subdivision.idSubdivision')->toArray();
        return json_encode($subdivisions);
    }

    public function getFunds($id) {
      //  dd($id);
        $schact = DB::table('schemedistributionsubdivision')
                        ->leftjoin('schemeactivation', 'schemeactivation.idSchemeActivation', '=', 'schemedistributionsubdivision.idSchemeActivation')
                        ->where('schemedistributionsubdivision.idSchemeActivation', '=', $id)
                        ->select('amountSubdivision AS TotalFund', 'areaSubdivision AS TotalArea', 'assistance AS Assistance')->first();
        $dist_sch = DB::table('schemedistributionsubdivision')
                        ->leftjoin('schemeactivation', 'schemeactivation.idSchemeActivation', '=', 'schemedistributionsubdivision.idSchemeActivation')
                        ->leftjoin('schemedistributionblock', 'schemedistributionblock.schemeDistributionSubdivision', '=', 'schemedistributionsubdivision.idSubdivision')
                        ->select(DB::raw('schemedistributionsubdivision.amountSubdivision   -  SUM(schemedistributionblock.amountBlock) AS TotalFund'), DB::raw('schemedistributionsubdivision.areaSubdivision - SUM(schemedistributionblock.areaBlock) AS TotalArea'),'schemeactivation.assistance AS Assistance')
                        ->where('schemedistributionsubdivision.idSchemeActivation', '=', $id)
                        ->first();
        if ($dist_sch->TotalFund!=null){
            return json_encode($dist_sch);
        }
        return json_encode($schact);
    }

}
