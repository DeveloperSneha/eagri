<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CompsizeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $components = ['' => 'Select Component '] + \App\Component::pluck('componentName', 'idComponent')->toArray();
        $units = ['' => 'Select Unit'] + \App\Unit::pluck('unitName', 'idUnit')->toArray();
        $compsizes = \App\Compsize::orderBy('idCompSize')->get();
        return view('compsize.compsize', compact('compsizes', 'components', 'units'));
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
//          dd($request->all());
        // $components = ['' => 'Select Component Id'] + \App\Component::pluck('idComponent', 'idComponent')->toArray();

        $rules = [
            'idComponent' => 'required|max:15',
            'idUnit' => 'required|max:15|unique:compsize,idUnit,NULL,idUnit,idComponent,' . $request->idComponent,
            'size' => 'required|max:5|numeric|between:0,99.99'
        ];
        $messages = [
            'idComponent.required' => 'Component Must be Selected',
            'idUnit.required' => 'Unit Must be Selected',
            'idUnit.unique' => 'Unit For This Component has already been taken. ',
            'size.required' => 'Size Must be Filled',
            'size.numeric' => 'Size Must Have Decimal Number',
            'size.between' => 'Size Must Have Decimal Value'
        ];
        $this->validate($request, $rules, $messages);

        $compsize = new \App\Compsize();
        $compsize->fill($request->all());
        $compsize->save();
        return redirect('compsizes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
        //return view('compsize.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $compsizes = \App\Compsize::orderBy('idCompSize')->get();
        $components = ['' => 'Select Component Id'] + \App\Component::pluck('componentName', 'idComponent')->toArray();
        $units = ['' => 'Select Unit'] + \App\Unit::pluck('unitName', 'idUnit')->toArray();
        $compsize = \App\Compsize:: where('idCompSize', '=', $id)->first();
        //   dd($role);
        return view('compsize.compsize', compact('compsize', 'compsizes', 'components', 'units'));
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
        $compsize = \App\Compsize::where('idCompSize', '=', $id)->first();
        $rules = [
            'idComponent' => 'required|max:15',
            'idUnit' => 'required|max:15',
            'size' => 'required|max:5|numeric|between:0,99.99'
        ];
        $messages = [
            'idComponent.required' => 'Component Must be Selected',
            'idUnit.required' => 'Unit Must be Selected',
            'size.required' => 'Size Must be Filled',
            'size.numeric' => 'Size Must Have Decimal Number',
            'size.between' => 'Size Must Have Decimal Value'
        ];
        $this->validate($request, $rules, $messages);
        //$compsize = \App\Compsize::findOrfail($id);
        $compsize->fill($request->all());
        $compsize->update();
        return redirect('compsizes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
//        dd('here');
        $compsize = \App\Compsize::findOrfail($id);
        $compsize->delete();
        return redirect('compsizes');
    }

}
