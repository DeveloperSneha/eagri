<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Http\Requests\SchDistrictDistRequest;
use Illuminate\Http\Request;
use Input;

class SchDistrictDistributionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $schdistrict = \App\SchDistrictDistribution::get();
        $schact = ['' => 'Select Scheme'] + \App\SchemeActivation::whereNotNull('idScheme')
                        ->with('scheme')->get()->pluck('scheme.schemeName', 'idSchemeActivation')->toArray();
        //  ->pluck('idSchemeActivation','scheme.schemeName')->toArray();
        // dd($schact);
        $districts = \App\District::pluck('districtName', 'idDistrict')->toArray();
        //  dd($districts);
        return view('schemes.district_distribution', compact('districts', 'schdistrict', 'schact'));
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
    public function store(SchDistrictDistRequest $request) {
        dd($request->all());

        foreach ($request->districts as $dis)
        //  dd ($dis['idDistrict']);
            if (isset($dis['idDistrict'])) {
                $schdistrict = new \App\SchDistrictDistribution();
                $schdistrict->fill($request->all());
                $schdistrict->idDistrict = $dis['idDistrict'];
                $schdistrict->amountDistrict = $dis['amountDistrict'];
                $schdistrict->areaDistrict = $dis['areaDistrict'];
                $schdistrict->save();
            }
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        }
        return redirect('districtdistribution');
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
        $schdistrict = \App\SchDistrictDistribution::get();
        $schdist = \App\SchDistrictDistribution::where('idSchemDistributionDistrict', '=', $id)->first();
        //  dd('here');
        return view('schemes.edit_districtdistribution', compact('schdistrict', 'schdist'));
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
            'amountDistrict' => 'required',
            'areaDistrict' => 'required',
        ];
        $messages = [
            'amountDistrict.required' => 'District Amount Must be Filled.',
            'areaDistrict.required' => 'District Area must Be Filled'
        ];
        $this->Validate($request, $rules, $messages);

        $schdist = \App\SchDistrictDistribution::where('idSchemDistributionDistrict', '=', $id)->first();
        $schdist->fill($request->all());
        $schdist->update();
        return redirect('districtdistribution');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $schdist = \App\SchDistrictDistribution::where('idSchemDistributionDistrict', '=', $id)->first();
        $schdist->delete();
        return redirect('districtdistribution');
    }

}
