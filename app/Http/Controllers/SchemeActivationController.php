<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Requests\SchemeActivationRequest;
use DB;

class SchemeActivationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $schact = \App\SchemeActivation::where('vendorDeliveryDayLimit', '!=', 0)->get();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        $fys = ['' => 'Financial Year'] + \App\FinancialYear::pluck('financialYearName', 'idFinancialYear')->toArray();
        $units = ['' => 'Select Unit'] + \App\Unit::pluck('unitName', 'idUnit')->toArray();
        $workflow = ['' => 'Select'] + \App\Workflow::orderBy('workflowName')->pluck('workflowName', 'idWorkflow')->toArray();
        return view('schemes.scheme_activation', compact('sections', 'fys', 'units', 'schact', 'workflow'));
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
    public function store(SchemeActivationRequest $request) {
        $sch = new \App\SchemeActivation();
        $sch->fill($request->all());
        DB::beginTransaction();
        $sch->save();
        $guidelines = $sch->idScheme . '_guidelines.' . $request->file('guidelines')->getClientOriginalExtension();
        $request->file('guidelines')->storeAs('public', $guidelines);

        //   dd($guidelines);
        $notifications = $sch->idScheme . '_notifications.' . $request->file('notiFile')->getClientOriginalExtension();
        $request->file('notiFile')->storeAs('public', $notifications);
        $sch->guidelines = $guidelines;
        $sch->notiFile = $notifications;
        $sch->update();
        foreach ($request->workflows as $var) {
            $schworkflow = new \App\SchemeWorkflowMapping();
            $schworkflow->fill($request->all());
            $schworkflow->idWorkflow = $var;
            $schworkflow->idScheme = $sch->idScheme;
            $schworkflow->save();
        }
        DB::commit();
        return redirect('schemeactivations');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
            $schact = \App\SchemeActivation::where('idSchemeActivation', '=', $id)->select('totalFundsAllocated','totalAreaAllocated','assistance')->first()->toArray();
            $result = DB::table('schemedistributiondistrict')
                ->select(DB::raw('SUM(amountDistrict) as total_amountDistrict'))
                    ->where('idSchemeActivation', '=', $id)
                ->get();
//            dd($result);
            $res = DB::table('schemedistributiondistrict')
                ->select(DB::raw('SUM(areaDistrict) as total_areaDistrict'))
                    ->where('idSchemeActivation', '=', $id)
                ->get();
//            dd($res);
            $act = DB::table('schemeactivation')
                   ->select(DB::raw('totalFundsAllocated')) 
                   ->where('idSchemeActivation', '=', $id)
                    ->get();
            $activ = DB::table('schemeactivation')
                   ->select(DB::raw('totalAreaAllocated')) 
                   ->where('idSchemeActivation', '=', $id)
                    ->get();
//            dd($activ);
               return json_encode($schact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $schact = \App\SchemeActivation::where('vendorDeliveryDayLimit', '!=', 0)->get();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        $fys = ['' => 'Financial Year'] + \App\FinancialYear::pluck('financialYearName', 'idFinancialYear')->toArray();
        $units = ['' => 'Select Unit'] + \App\Unit::pluck('unitName', 'idUnit')->toArray();
        $workflow = ['' => 'Select'] + \App\Workflow::orderBy('workflowName')->pluck('workflowName', 'idWorkflow')->toArray();
        $sch = \App\SchemeActivation::where('idSchemeActivation', '=', $id)->with('workflow')->first();
        return view('schemes.scheme_activation', compact('fys', 'schact', 'sch', 'units', 'sections', 'workflow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SchemeActivationRequest $request, $id) {
        $sch = \App\SchemeActivation::where('idSchemeActivation', '=', $id)->first();
        $sch->fill($request->all());
        if ($request->hasFile('guidelines')) {
            $guidelines = $sch->idScheme . '_guidelines.' . $request->file('guidelines')->getClientOriginalExtension();
            $request->file('guidelines')->storeAs('public', $guidelines);
            $sch->guidelines = $guidelines;
        }
        if ($request->hasFile('notiFile')) {
            $notifications = $sch->idScheme . '_notifications.' . $request->file('notiFile')->getClientOriginalExtension();
            $request->file('notiFile')->storeAs('public', $notifications);
            $sch->notiFile = $notifications;
        }
        DB::beginTransaction();
        $sch->update();
        DB::commit();
        return redirect('schemeactivations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $sch = \App\SchemeActivation::where('idSchemeActivation', '=', $id)->first();
        $sch->delete();
        return redirect('schemeactivations');
    }

}
