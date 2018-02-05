<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class SchemeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        //$schemes = \App\Scheme::orderBy('schemeName')->get();
	$schemes = \App\Scheme::orderBy('idScheme')->get();
        return view('schemes.index', compact('schemes', 'sections'));
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
            'idSection' => 'required',
            'schemeName' => 'required|unique:scheme|regex:/^[\pL\s\-()]+$/u|between:2,90',
            'remarks' => 'required|regex:/^[0-9a-zA-Z-()]+/'
        ];
        $messages = [
            'idSection.required' => 'Section Must be Selected',
            'schemeName.required' => 'Scheme Name Must be Filled',
            'schemeName.unique' => 'Scheme Name Is Already Taken',
            'schemeName.regex' => 'Scheme Name is Not Valid',
            'remarks.required' => 'Remark must be Provided',
            'remarks.regex' => 'Remarks is Not Valid',
        ];
        $this->validate($request, $rules, $messages);

        $scheme = new \App\Scheme();
        $scheme->fill($request->all());
        $scheme->save();
        return redirect('schemes');
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
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        $schemes = \App\Scheme::orderBy('schemeName')->get();
        $scheme = \App\Scheme:: where('idScheme', '=', $id)->first();
        //   dd($role);
        return view('schemes.index', compact('scheme', 'schemes', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $scheme = \App\Scheme::where('idScheme', '=', $id)->first();
        $rules = [
            'idSection' => 'required',
            'schemeName' => 'required|regex:/^[\pL\s\-()]+$/u|unique:scheme,schemeName,'.$id.',idScheme',
//           'schemeName' => array('required', 'regex:/^[A-Za-z]{4}\d{4}$/')
            'remarks' => 'required'
        ];
        $messages = [
            'idSection.required' => 'Section Must be Selected',
            'schemeName.required' => 'Scheme Name Must be Filled',
            'schemeName.regex' => 'Scheme Name is Not Valid',
        ];
        $this->validate($request, $rules, $messages);

        $scheme->fill($request->all());
        $scheme->update();
        return redirect('schemes');
    }

    public function deleteScheme($id) {
        //
        $schemes = \App\Scheme::where('idScheme', '=', $id)->first();
        $program = \App\Program::where('idScheme', '=', $id)->get();
        if($program->count() > 0){
            return redirect()->back()->with('message', 'You Cant Delete this Scheme Because it  Already Exist in Some Program!');
        }
        else{
            return view('schemes.delete', compact('schemes'));
        }
    }
    public function editScheme($id) {
        //
        
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        $schemes = \App\Scheme::orderBy('schemeName')->get();
        $scheme = \App\Scheme:: where('idScheme', '=', $id)->first();
        $program = \App\Program::where('idScheme', '=', $id)->get();
        if($program->count() > 0){
            return redirect()->back()->with('message', 'You Can Not Edit this Scheme Because it  Already Exist in Some Program!');
        }
        else{
            return view('schemes.index', compact('scheme', 'schemes', 'sections'));
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
        $scheme = \App\Scheme:: where('idScheme', '=', $id)->first();
        $scheme->delete();
        return redirect('schemes');
    }

    public function getProgram($id) {
        $programs = \App\Program::where("idProgram", $id)
                        ->pluck("programName", "idProgram")->toArray();
        return json_encode($programs);
    }

}
