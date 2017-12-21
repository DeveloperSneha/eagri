<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchVillageDistRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class SchVillageDistributionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $schvillage = \App\SchVillageDistribution::get();
        $schact = \App\SchemeActivation::whereNotNull('idScheme')
                        ->with('scheme')->get()->pluck('scheme.schemeName', 'idSchemeActivation')->toArray();
        return view('schemes.village_distribution', compact('schact', 'schvillage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // dd('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchVillageDistRequest $request) {
        //
        //  dd($request->all());
        foreach ($request->villages as $var)
            if (isset($var['idVillage'])) {
                $schvillage = new \App\SchVillageDistribution();
                $schvillage->fill($request->all());
                $schvillage->idVillage = $var['idVillage'];
                $schvillage->amountVillage = $var['amountVillage'];
                $schvillage->areaVillage = $var['areaVillage'];
                $schvillage->save();
            }
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        }
        return redirect('villagedistribution');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
        //   return view('roles.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $schvillage = \App\SchVillageDistribution::where('idSchemDistributionVillage', '=', $id)->first();
        return view('schemes.edit_villagedistribution', compact('schvillage'));
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
        $schvillage = \App\SchVillageDistribution::where('idSchemDistributionVillage', '=', $id)->first();
        $schvillage->fill($request->all());
        $schvillage->update();
        return redirect('villagedistribution');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $request->validate([
            'amountVillage' => 'required',
            'areaVillage' => 'required',
        ]);
        $schvillage = \App\SchVillageDistribution::where('idSchemDistributionVillage', '=', $id)->first();
        $schvillage->delete();
        return redirect('villagedistribution');
    }

    public function getBlock($id) {
        $schblock = [0 => 'Select Block'] + \App\SchBlockDistribution::where("idSchemeActivation", $id)->with('block')->get()
                        ->pluck("block.blockName", "idSchemDistributionBlock")->toArray();
        return json_encode($schblock);
    }

}
