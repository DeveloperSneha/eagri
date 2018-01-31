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
        $sections = ['' => '----Select Section----'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        $schact = \App\SchemeActivation::where('vendorDeliveryDayLimit', '=', 0)->get();
        $fys = ['' => '----Select Financial Year----'] + \App\FinancialYear::orderBy('financialYearName', 'desc')->pluck('financialYearName', 'idFinancialYear')->toArray();
        $units = ['' => '----Select Unit----'] + \App\Unit::pluck('unitName', 'idUnit')->toArray();
        $schemecert = \App\Certificate::orderBy('certificateName')->pluck('certificateName', 'idCertificate')->toArray();
        return view('schemes.scheme_activation_nonvendor', compact('sections', 'fys', 'units', 'schact', 'schemecert'));
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
        // dd($request->all());
        $sch = new \App\SchemeActivation();
        $sch->fill($request->all());
        $sch->vendorDeliveryDayLimit = 0;
        DB::beginTransaction();
        $sch->save();
        if ($request->has('guidelines')) {
            $guidelines = $sch->idProgram . '_guidelines.' . $request->file('guidelines')->getClientOriginalExtension();
            $request->file('guidelines')->storeAs('public', $guidelines);
            $sch->guidelines = $guidelines;
        }
        if ($request->has('notiFile')) {
            $notifications = $sch->idProgram . '_notifications.' . $request->file('notiFile')->getClientOriginalExtension();
            $request->file('notiFile')->storeAs('public', $notifications);
            $sch->notiFile = $notifications;
        }
        $sch->update();
        $schworkflow = new \App\SchemeWorkflowMapping();
        $schworkflow->fill($request->all());
        $schworkflow->idScheme = $sch->idScheme;
        $schworkflow->idProgram = $sch->idProgram;
        $schworkflow->save();
        if (count($request->schemecerts) > 0) {
            foreach ($request->schemecerts as $var) {
                $schemecert = new \App\Schemecert();
                $schemecert->fill($request->all());
                $schemecert->idCertificate = $var;
                $schemecert->idScheme = $sch->idScheme;
                $schemecert->save();
            }
        }
        DB::commit();
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        }
        return redirect('schemeactivations/nv');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $schact = \App\SchemeActivation::where('idSchemeActivation', '=', $id)->select('totalFundsAllocated AS TotalFund', 'totalAreaAllocated AS TotalArea', 'assistance AS Assistance')->first()->toArray();
        $dist_sch = DB::table('schemeactivation')
                        ->leftjoin('schemedistributiondistrict', 'schemedistributiondistrict.idSchemeActivation', '=', 'schemeactivation.idSchemeActivation')
                        ->select(DB::raw('schemeactivation.totalFundsAllocated   -  SUM(schemedistributiondistrict.amountDistrict) AS TotalFund'), DB::raw('schemeactivation.totalAreaAllocated - SUM(schemedistributiondistrict.areaDistrict) AS TotalArea'), 'schemeactivation.assistance AS Assistance')
                        //'schemeactivation.totalAreaAllocated'- DB::raw('SUM(schemedistributiondistrict.areaDistrict)' ))
                        ->where('schemeactivation.idSchemeActivation', '=', $id)->first();
        if ($dist_sch->TotalFund != null) {
            return json_encode($dist_sch);
        }
        return json_encode($schact);
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
        $schemecert = \App\Certificate::orderBy('certificateName')->pluck('certificateName', 'idCertificate')->toArray();
        $sch = \App\SchemeActivation::where('idSchemeActivation', '=', $id)->first();
        // dd($sch->idProgram);
        $sch_workflow = DB::table('scheme_workflow_mapping')
                        ->join('program', 'scheme_workflow_mapping.idProgram', '=', 'program.idProgram')
                        ->join('workflow', 'scheme_workflow_mapping.idWorkflow', '=', 'workflow.idWorkflow')
                        ->where('scheme_workflow_mapping.idProgram', $sch->idProgram)
                        ->get()->pluck('workflowName', 'idWorkflow')->toArray();
        //     with('schworkflow.workflow')->get()->pluck('schworkflow.workflow.workflowName', 'schworkflow.idWorkflow')->toArray();
        //dd($sch_workflow);
        $schdist = \App\SchDistrictDistribution::where('idSchemeActivation', '=', $id)->get();
        if ($schdist->count() > 0) {
            return redirect()->back()->with('message', 'You Can Not Edit This Because it is Already Distributed in Some District!');
        } else {
            return view('schemes.scheme_activation_nonvendor', compact('sch_workflow', 'fys', 'schact', 'sch', 'units', 'sections', 'schemecert', 'workflow'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NonVendorSchemeActivationRequest $request, $id) {
        //  dd('here');
        $sch = \App\SchemeActivation::where('idSchemeActivation', '=', $id)->first();
        $sch->fill($request->all());
        $sch->vendorDeliveryDayLimit = 0;
        if ($request->hasFile('guidelines')) {
            $guidelines = $sch->idProgram . '_guidelines.' . $request->file('guidelines')->getClientOriginalExtension();
            $request->file('guidelines')->storeAs('public', $guidelines);
            $sch->guidelines = $guidelines;
        }
        if ($request->hasFile('notiFile')) {
            $notifications = $sch->idProgram . '_notifications.' . $request->file('notiFile')->getClientOriginalExtension();
            $request->file('notiFile')->storeAs('public', $notifications);
            $sch->notiFile = $notifications;
        }
        $old_ids = $sch->documents->pluck('idSchemeCert')->toArray();
        $sch_certificates = new \Illuminate\Database\Eloquent\Collection();

        if (count($request->schemecerts) > 0) {
            foreach ($request->schemecerts as $var) {
                $schemecert = \App\Schemecert::firstOrNew(['idCertificate' => $var, 'idScheme' => $sch->idScheme, 'idProgram' => $sch->idProgram]);
                $sch_certificates->add($schemecert);
            }
        }
        $new_ids = $sch_certificates->pluck('idSchemeCert')->toArray();
        $detach = array_diff($old_ids, $new_ids);
//         dd($detach);
        DB::beginTransaction();
        $sch->update();
        $schworkflow = \App\SchemeWorkflowMapping::where('idProgram', '=', $sch->idProgram)->first();
        //$schworkflow->idScheme = $sch->idScheme;
        //$schworkflow->idScheme = $sch->idProgram;
        $schworkflow->update();
        \App\Schemecert::whereIn('idSchemeCert', $detach)->delete();
        $sch->documents()->saveMany($sch_certificates);
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

    public function getActivatedProgram($id) {
        $activated_program = \App\SchemeActivation::where('idScheme', $id)
                        ->with('program')->get()
                        ->pluck("program.programName", "idSchemeActivation")->toArray();
        return json_encode($activated_program);
    }

    public function getPrograms($id) {
        $program = \App\Program::where("idScheme", '=', $id)
                        ->get()
                        ->pluck("programName", "idProgram")->toArray();
        return json_encode($program);
    }

}
