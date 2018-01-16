<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ProgramController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        //$programs = \App\Program::orderBy('programName')->get();
		$programs = \App\Program::orderBy('idProgram')->get();
        return view('program.index', compact('programs','sections'));
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
    public function store(Request $request) {
        $rules = [
            'idSection' =>'required',
            'idScheme' => 'required',
            'programName' => 'required|max:100|regex:/^[\pL\s\-]+$/u|unique:program,programName,NULL,idProgram,idScheme,' . $request->idScheme,
        ];
        $messages = [
            'idSection.required'=>'Section Must be Selected First',
            'idScheme.required' => 'Scheme Must be Selected',
            'programName.required' => 'Program Name Must be Filled',
            'programName.unique' => 'Program Name Is already Taken',
            'programName.regex' => 'Program Name Is Not valid',
        ];
        $this->validate($request, $rules, $messages);

        $program = new \App\Program();
        $program->fill($request->all());
        $program->save();
        return redirect('programs');
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
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        $programs = \App\Program::orderBy('programName')->get();
        $program = \App\Program::where('idProgram', '=', $id)->first();
        return view('program.index', compact('program', 'programs','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $program = \App\Program::where('idProgram', '=', $id)->first();
        $rules = [
          //  'idScheme' => 'required',
            'programName' => 'required|regex:/^[\pL\s\-]+$/u|unique:program,programName,'.$id.',idProgram'
        ];
        $messages = [
         //   'idScheme.required' => 'Scheme Must be Selected',
            'programName.required' => 'Program Name Must be Filled',
            'programName.regex' => 'Program Is Not Valid'
        ];
        $this->validate($request, $rules, $messages);


        $program->fill($request->all());
        $program->update();
        return redirect('programs');
    }

    /**
     * Check There is Any dependency Exist
     *

     */
    public function deleteprogram($id) {
        //
        $programs = \App\Program:: where('idProgram', '=', $id)->first();
        $schact = \App\SchemeActivation::where('idProgram', '=', $id)->get();
        if($schact->count() > 0){
            return redirect()->back()->with('message', 'You Can not Delete this Program Because it is Already Exist in Some Scheme Activation!');
        }
        else{
            return view('program.delete', compact('programs'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $program = \App\Program::where('idProgram', '=', $id)->first();
        $program->delete();
        return redirect('programs');
    }

}
