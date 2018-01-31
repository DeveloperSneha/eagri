<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class SectionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        //$sections = \App\Section::orderBy('sectionName')->get();
        $sections = \App\Section::orderBy('idSection')->get();
        return view('sections.index', compact('sections'));
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
    public function store(Request $request) {
        //
        //  dd($request->all());
        $rules = [
            'sectionName' => 'required|unique:section|between:2,50|regex:/^[\pL\s\-()]+$/u'
        ];
        $messages = [
            'sectionName.required' => 'Section Name Must be Filled',
            'sectionName.regex' => 'Section Name is not Valid',
            'sectionName.unique' => 'Section Name is Already Exist'
        ];
        $this->validate($request, $rules, $messages);

        $section = new \App\Section();
        $section->fill($request->all());
        $section->save();
        return redirect('sections');
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
//        $sections = \App\Section::orderBy('sectionName')->get();
//        $section = \App\Section:: where('idSection', '=', $id)->first();
//        //   dd($role);
//        return view('sections.index', compact('section', 'sections'));
    }
    
    public function editSection($id) {
        $sections = \App\Section::orderBy('sectionName')->get();
        $section = \App\Section:: where('idSection', '=', $id)->first();
        $schemes = \App\Scheme::where('idSection', '=', $id)->get();
        $designation = \App\Designation::where('idSection', '=', $id)->get();
        if ($schemes->count() > 0) {
            return redirect()->back()->with('message', 'You Can not Edit this Section Because it  Already Exist in Some Schemes!');
        }elseif($designation->count() > 0){
            return redirect()->back()->with('message', 'You Can not Edit this Section Because it  Already Exist in Some Designation!');
        }
        else{
            return view('sections.index', compact('section','sections'));
        }
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
        $section = \App\Section:: where('idSection', '=', $id)->first();
        // dd($section);
        $rules = [
            'sectionName' => 'required|regex:/^[\pL\s\-]+$/u|between:2,50|unique:section,sectionName,' . $id . ',idSection'
        ];
        $messages = [
            'sectionName.required' => 'Section Name Must be Filled',
            'sectionName.regex' => 'Section Name is not Valid',
        ];
        $this->validate($request, $rules, $messages);


        $section->fill($request->all());
        $section->update();
        return redirect('sections');
    }

    /**
     * Check There is Any dependency Exist
     *

     */
    public function deleteSection($id) {
        //
        $section = \App\Section:: where('idSection', '=', $id)->first();
        $schemes = \App\Scheme::where('idSection', '=', $id)->get();
        $designation = \App\Designation::where('idSection', '=', $id)->get();
        if ($schemes->count() > 0) {
            return redirect()->back()->with('message', 'You Cant Delete this Section Because it  Already Exist in Some Schemes!');
        }elseif($designation->count() > 0){
            return redirect()->back()->with('message', 'You Cant Delete this Section Because it  Already Exist in Some Designation!');
        }
        else{
            return view('sections.delete', compact('section'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $section = \App\Section:: where('idSection', '=', $id)->first();
        $section->delete();
        return redirect('sections');
    }

    public function getScheme($id) {
        $schemes = \App\Scheme::where("idSection", $id)
                        ->pluck("schemeName", "idScheme")->toArray();
        return json_encode($schemes);
    }

    public function getDesignations($id) {
        $designations = \App\Designation::where("idSection", $id)
                        ->pluck("designationName", "idDesignation")->toArray();
        return json_encode($designations);
    }

    public function getWorkflow($id) {
        $workflows = \App\WorkflowStep::with('workflow')->where("idSection", $id)->get()
                        ->pluck("workflow.workflowName", "workflow.idWorkflow")->toArray();
        return json_encode($workflows);
    }

}
