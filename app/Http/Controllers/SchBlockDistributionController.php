<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchBlockDistRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use DB;

class SchBlockDistributionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $schblock = \App\SchBlockDistribution::with('district')->get();
        $schact = ['' => 'Select Scheme'] + \App\SchemeActivation::whereNotNull('idScheme')
                        ->with('scheme')
                        ->get()
                        ->pluck('scheme.schemeName', 'idSchemeActivation')
                        ->toArray();
        return view('schemes.block_distribution', compact('schact', 'schblock'));
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

        //  dd($request->all());
        foreach ($request->blocks as $var)
        //dd ($var);
            if (isset($var['idBlock'])) {
                $schblock = new \App\SchBlockDistribution();
                $schblock->fill($request->all());
                $schblock->idBlock = $var['idBlock'];
                $schblock->amountBlock = $var['amountBlock'];
                $schblock->areaBlock = $var['areaBlock'];
                $schblock->save();
            }
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        }
        return redirect('blockdistribution');
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
        return view('schemes.edit_blockdistribution', compact('schdistrict', 'schblock'));
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
        return redirect('blockdistribution');
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
        return redirect('blockdistribution');
    }

    public function getDistrict($id) {
        $schdist = [0 => 'Select District'] + \App\SchDistrictDistribution::where("idSchemeActivation", $id)->with('district')->get()
                        ->pluck("district.districtName", "idSchemDistributionDistrict")->toArray();
        return json_encode($schdist);
    }

    public function getBlocks($id) {
        $blocks = DB::table('schemedistributiondistrict')
                        ->join('district', 'district.idDistrict', '=', 'schemedistributiondistrict.idDistrict')
                        ->join('block', 'block.idDistrict', '=', 'district.idDistrict')
                        ->where('schemedistributiondistrict.idSchemDistributionDistrict', '=', $id)
                        ->select('block.blockName', 'block.idBlock')
                        ->get()->pluck("blockName", "idBlock")->toArray();
        return json_encode($blocks);
    }

    public function getVillages($id) {
        $blocks = DB::table('schemedistributionblock')
                        ->join('block', 'block.idBlock', '=', 'schemedistributionblock.idBlock')
                        ->join('village', 'village.idBlock', '=', 'block.idBlock')
                        ->where('schemedistributionblock.idSchemDistributionBlock', '=', $id)
                        ->select('village.villageName', 'village.idVillage')
                        ->get()->pluck("villageName", "idVillage")->toArray();
        return json_encode($blocks);
    }

}
