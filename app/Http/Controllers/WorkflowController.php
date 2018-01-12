<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WorkflowRequest;
use Session;
use DB;

class WorkflowController extends Controller {

    public function index() {
        $workflows = \App\Workflow::orderBy('workflowName')->get();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('workflow.index', compact('workflows', 'designations', 'sections'));
    }

    public function create() {
        //
    }

    public function store(WorkflowRequest $request) {
        $workflow = new \App\Workflow();
        $workflow->fill($request->all());
        DB::beginTransaction();
        $workflow->save();
        foreach ($request->designations as $var) {
            $workflow_step = new \App\WorkflowStep();
            $workflow_step->fill($request->all());
            $workflow_step->idDesignation = $var;
            $workflow_step->idWorkflow = $workflow->idWorkflow;
            $workflow_step->save();
        }
        // dd($workflow_step);
        DB::commit();
        return redirect('workflow');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $workflow = \App\Workflow::where('idWorkflow', '=', $id)->first();
        $section = $workflow->steps()->with('designation.section')->get()->pluck('designation.idSection')->unique();
        $step = $workflow->steps()->with('designation')->get();
        //  dd($step);
        $workflows = \App\Workflow::orderBy('idWorkflow')->get();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('workflow.index', compact('workflow', 'workflows', 'designations', 'section', 'sections', 'step'));
    }

    public function update(WorkflowRequest $request, $id) {
        $workflow = \App\Workflow::where('idWorkflow', '=', $id)->first();
        $step = $workflow->steps()->where('idDesignation', Session::get('idDesignation'))->first();
        $workflow->fill($request->all());
        $old_ids = $workflow->steps->pluck('idworkflowstep')->toArray();
//        dd($old_ids);
        $workflow_step = new \Illuminate\Database\Eloquent\Collection();
        foreach ($request->designations as $var) {
            $desig = \App\WorkflowStep::firstOrNew(['idDesignation' => $var, 'idSection' => $request->idSection, 'idWorkflow' => $workflow->idWorkflow]);
            $workflow_step->add($desig);
        }
        $new_ids = $workflow_step->pluck('idworkflowstep')->toArray();

//          dd($new_ids);
        $detach = array_diff($old_ids, $new_ids);
//         dd($detach);
        DB::beginTransaction();
        $workflow->update();
        \App\WorkflowStep::whereIn('idworkflowstep', $detach)->delete();


        $workflow->steps()->saveMany($workflow_step);
        
        DB::commit();
        return redirect('workflow');
    }

    public function destroy($id) {
        $workflow = \App\Workflow::where('idWorkflow', '=', $id)->first();
        dd($workflow);
        $workflow->delete();
        return redirect('workflow');
    }

    public function designations($id) {
        $workflow = \App\Workflow::where('idWorkflow', '=', $id)->first();

//        $designations = $workflow->steps->load('designation')
//                ->pluck('designation.designationName','idDesignation')->toArray();
        $designations = DB::table('workflow')
                        ->join('workflowsteps', 'workflow.idWorkflow', '=', 'workflowsteps.idWorkflow')
                        ->join('designation', 'workflowsteps.idDesignation', '=', 'designation.idDesignation')
                        ->orderBy('designation.level', 'asc')
                        ->where('workflow.idWorkflow', '=', $workflow->idWorkflow)
                        ->get()->pluck('idDesignation', 'designationName')->toArray();
        return json_encode($designations);
    }

}
