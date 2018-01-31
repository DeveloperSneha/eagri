<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DesignationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        //$designations = \App\Designation::orderBy('designationName')->get();
		$designations = \App\Designation::orderBy('idDesignation')->get();
//        $designations =DB::table('designation')->distinct()->get();
        return view('designation.index', compact('designations','sections'));
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
     * @return \Illuminate\Http\Response /****regex:/^[\pL\s\-()]+$/u|
     */
    public function store(Request $request) {
        $rules = [
            'idSection'=>'required',
            'designationName' => 'required|between:2,50|unique:designation,designationName,NULL,idDesignation,idSection,'.$request->idSection,
            'level' => 'required|integer|between:1,9|unique:designation,level,NULL,idDesignation,idSection,'.$request->idSection
        ];
        $message = [
            'idSection.required' => 'Please Select Section',
            'designationName.required' => 'Designation Name Must Be Filled.',
            'designationName.regex' => 'Designation Name is Invalid.',
            'level.required' => 'Level Must Be Provided.'
        ];
        $this->Validate($request, $rules, $message);

        $designation = new \App\Designation();
        $designation->fill($request->all());
        $designation->save();
        return redirect('designations');
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
//        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
//        $designations = \App\Designation::orderBy('designationName')->get();
//        $designation = \App\Designation::where('idDesignation', '=', $id)->first();
//        return view('designation.index', compact('designations', 'designation','sections'));
    }
    
    public function editDesignation($id) {
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        $designations = \App\Designation::orderBy('designationName')->get();
        $designation = \App\Designation:: where('idDesignation', '=', $id)->first();
        $workflow = \App\WorkflowStep::where('idDesignation', '=', $id)->get();
        $userdesig = \App\UserDesignationDistrictMapping::where('idDesignation', '=', $id)->get();
        if($workflow->count() > 0){
            return redirect()->back()->with('message', 'You Can not Edit this Designation Because it is Already Existing in Some workflow!');
        }elseif($userdesig->count() > 0){
            return redirect()->back()->with('message', 'You Can not Edit this Designation Because it is Already In Use');
        }
        else{
            return view('designation.index', compact('designations','designation','sections'));
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
        $rules = [
            'idSection'=>'required',
            'designationName' => 'required|regex:/^[\pL\s\-()]+$/|between:2,50|unique:designation,designationName,'.$id.',idDesignation,idSection,'.$request->idSection,
            'level' => 'required|integer|between:1,9|unique:designation,level,'.$id.',idDesignation,idSection,'.$request->idSection,
        ];
        $message = [
            'idSection.required' => 'Select Section',
            'designationName.required' => 'Designation Name Must Be Filled.',
            'designationName.regex' => 'Designation Name is Invalid.',
            'level.required' => 'level Must Be Provided.'
        ];
        $this->Validate($request, $rules, $message);
        $designation = \App\Designation::where('idDesignation', '=', $id)->first();
        $designation->fill($request->all());
        $designation->update();
        return redirect('designations');
    }

    /**
     * Check There is Any dependency Exist
     *

     */
    public function deleteDesignation($id) {
        //
        $designation = \App\Designation:: where('idDesignation', '=', $id)->first();
        $workflow = \App\WorkflowStep::where('idDesignation', '=', $id)->get();
        $userdesig = \App\UserDesignationDistrictMapping::where('idDesignation', '=', $id)->get();
        if($workflow->count() > 0){
            return redirect()->back()->with('message', 'You Can not Delete this Designation Because it is Already Existing in Some workflow!');
        }elseif($userdesig->count() > 0){
            return redirect()->back()->with('message', 'You Can not Delete this Designation Because it is Already In Use');
        }
        else{
            return view('designation.delete', compact('designation'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $designation = \App\Designation:: where('idDesignation', '=', $id)->first();
        $designation->delete();
        return redirect('designations');
    }

}
