<?php

namespace App\Http\Controllers\Authority;

use Illuminate\Http\Request;
use App\Http\Requests\SchBlockDistRequest;
use Auth;
use DB;

class BlockwiseSchemeDistributionController extends AuthorityController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $authority = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $authority_dist = $authority->userdesig->district->idDistrict;
        $schblockdist = \App\SchBlockDistribution::where('schemeDistributionDistrict', '=', $authority_dist)->with('district')->get();
        $schact = ['' => 'Select Scheme'] + \App\SchDistrictDistribution::where('idDistrict', '=', $authority_dist)
                        ->with('schactivation', 'schactivation.scheme')
                        ->get()->pluck('schactivation.scheme.schemeName', 'idSchemeActivation')
                        ->toArray();
        $sch_blocks = \App\Block::where('idDistrict', '=', $authority_dist)->get()->pluck('blockName', 'idBlock')->toArray();
        //dd($sch_blocks);
        return view('authority.schemes.blockwise_distribution', compact('schact', 'sch_blocks', 'schblockdist'));
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
        $authority = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $authority_dist = $authority->userdesig->district->idDistrict;
        //  dd($request->all());
        foreach ($request->blocks as $var)
            if (isset($var['idBlock'])) {
                $schblock = new \App\SchBlockDistribution();
                $schblock->fill($request->all());
                $schblock->schemeDistributionDistrict = $authority_dist;
                $schblock->idBlock = $var['idBlock'];
                $schblock->amountBlock = $var['amountBlock'];
                $schblock->areaBlock = $var['areaBlock'];
                $schblock->save();
            }
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        }
        return redirect('authority/blockwisescheme');
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

    public function getSchemeDist($id) {
        $authority = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $authority_dist = $authority->userdesig->district->idDistrict;
        $schact = DB::table('schemedistributiondistrict')
                        ->join('schemeactivation', 'schemedistributiondistrict.idSchemeActivation', '=', 'schemeactivation.idSchemeActivation')
                        ->where('schemedistributiondistrict.idSchemeActivation', '=', $id)
                        ->where('schemedistributiondistrict.idDistrict', '=', $authority_dist)
                        ->select('amountDistrict', 'areaDistrict', 'assistance')->first();
                       // ->toArray();
        //  ->select('amountDistrict', 'areaDistrict', 'assistance')->first()->toArray();

        return json_encode($schact);
    }

}
