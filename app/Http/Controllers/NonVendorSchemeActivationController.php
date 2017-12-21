<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Requests\NonVendorSchemeActivationRequest;
use DB;

class NonVendorSchemeActivationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        $schact = \App\SchemeActivation::where('vendorDeliveryDayLimit', '=', 0)->get();
        $fys = ['' => 'Financial Year'] + \App\FinancialYear::orderBy('financialYearName', 'desc')->pluck('financialYearName', 'idFinancialYear')->toArray();
        $units = ['' => 'Select Unit'] + \App\Unit::pluck('unitName', 'idUnit')->toArray();
        $workflow = ['' => 'Select'] + \App\Workflow::orderBy('workflowName')->pluck('workflowName', 'idWorkflow')->toArray();
        $schemecert = \App\Certificate::orderBy('certificateName')->pluck('certificateName', 'idCertificate')->toArray();
        // dd($workflow);
        return view('schemes.scheme_activation_nonvendor', compact('sections', 'fys', 'units', 'schact', 'schemecert', 'workflow'));
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
    public function store(NonVendorSchemeActivationRequest $request) {
        // dd($request->workflows);
        // dd($request->file('guidelines')->getClientOriginalName());
        $sch = new \App\SchemeActivation();
        $sch->fill($request->all());
        $sch->vendorDeliveryDayLimit = 0;
        DB::beginTransaction();
        $sch->save();
        $guidelines = $sch->idScheme . '_guidelines.' . $request->file('guidelines')->getClientOriginalExtension();
        $request->file('guidelines')->storeAs('public', $guidelines);
        $notifications = $sch->idScheme . '_notifications.' . $request->file('notiFile')->getClientOriginalExtension();
        $request->file('notiFile')->storeAs('public', $notifications);
        $sch->guidelines = $guidelines;
        $sch->notiFile = $notifications;
        $sch->update();
        $schworkflow = new \App\SchemeWorkflowMapping();
        $schworkflow->fill($request->all());
        $schworkflow->idScheme = $sch->idScheme;
        $schworkflow->save();
        if(count($request->schemecerts)>0) {
            foreach ($request->schemecerts as $var) {
                $schemecert = new \App\Schemecert();
                $schemecert->fill($request->all());
                //  dd($var);
                $schemecert->idCertificate = $var;
                $schemecert->idScheme = $sch->idScheme;
                $schemecert->save();
            }
        }
        DB::commit();
        
        return redirect('schemeactivations/nv');
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
        $schact = \App\SchemeActivation::where('vendorDeliveryDayLimit', '=', 0)->get();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        $fys = ['' => 'Financial Year'] + \App\FinancialYear::pluck('financialYearName', 'idFinancialYear')->toArray();
        $units = ['' => 'Select Unit'] + \App\Unit::pluck('unitName', 'idUnit')->toArray();
        $workflow = ['' => 'Select'] + \App\Workflow::orderBy('workflowName')->pluck('workflowName', 'idWorkflow')->toArray();
        $schemecert = \App\Certificate::orderBy('certificateName')->pluck('certificateName', 'idCertificate')->toArray();
        $sch = \App\SchemeActivation::where('idSchemeActivation', '=', $id)->with('workflow')->first();
        return view('schemes.scheme_activation_nonvendor', compact('fys', 'schact', 'sch', 'units', 'sections', 'schemecert', 'workflow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NonVendorSchemeActivationRequest $request, $id) {
        $sch = \App\SchemeActivation::where('idSchemeActivation', '=', $id)->first();
        $sch->fill($request->all());
        $sch->vendorDeliveryDayLimit = 0;
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
        $schworkflow = \App\SchemeWorkflowMapping::where('idScheme', '=', $sch->idScheme)->first();
        $schworkflow->fill($request->all());
        $schworkflow->idScheme = $sch->idScheme;
        $schworkflow->save();
        //   dd($sch->documents);

        foreach ($request->schemecerts as $var) {
            $schemecert = \App\Schemecert::firstOrNew(['idCertificate' => $var], ['idScheme' => $sch->idScheme]);
            $schemecert->save();
        }


        DB::commit();
        return redirect('schemeactivations/nv');
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
        return redirect('schemeactivations/nv');
    }

}
