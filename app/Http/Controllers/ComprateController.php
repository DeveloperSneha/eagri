<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ComprateController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $compsizes = ['' => 'Select Component size'] + \App\Compsize::pluck('size', 'idCompSize')->toArray();
//        $schemeactivations = ['' => 'Scheme Activation Id'] + \App\Schemeactivation::pluck('idSchemeActivation', 'idSchemeActivation')->toArray();
        $schemeactivations = ['' => 'Select Scheme Activation Id'] + \App\SchemeActivation::whereNotNull('idScheme')
                        ->with('scheme')->get()->pluck('scheme.schemeName', 'idSchemeActivation')->toArray();
        $comprates = \App\Comprate::orderBy('idcompRate')->get();
        return view('comprate.index', compact('comprates', 'compsizes', 'schemeactivations'));
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
        // dd($request->all());
        $rules = [
            'idCompSize' => 'required|max:15',
            'idSchemeActivation' => 'required|max:15|unique:comprate,idSchemeActivation,NULL,idSchemeActivation,idCompSize,' . $request->idCompSize,
            'ratePerUnit' => 'required|max:15|numeric'
        ];
        $messages = [
            'idCompSize.required' => 'Component Size Must be Selected',
            'idSchemeActivation.required' => 'Scheme Must be Selected',
            'idSchemeActivation.unique' => 'This Component Size has already been taken. for this scheme',
            'ratePerUnit.required' => 'Rate Per Unit Field Must be Filled',
            'ratePerUnit.numeric' => 'Rate Per Unit Field Must Have Numeric Value'
        ];
        $this->validate($request, $rules, $messages);

        $Comprate = new \App\Comprate();
        $Comprate->fill($request->all());
        $Comprate->save();
        return redirect('comprates');
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
        $comprates = \App\Comprate::orderBy('idCompRate')->get();
        $compsizes = ['' => 'Select Component Size'] + \App\Compsize::pluck('size', 'idCompSize')->toArray();
        $schemeactivations = ['' => 'Select Scheme Activation Id'] + \App\SchemeActivation::whereNotNull('idScheme')
                        ->with('scheme')->get()->pluck('scheme.schemeName', 'idSchemeActivation')->toArray();
        $comprate = \App\Comprate:: where('idCompRate', '=', $id)->first();
        //   dd($role);
        return view('comprate.index', compact('comprate', 'comprates', 'compsizes', 'schemeactivations'));
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
        $comprate = \App\Comprate:: where('idCompRate', '=', $id)->first();
        $rules = [
            'idCompSize' => 'required|max:15',
            'idSchemeActivation' => 'required|max:15',
            'ratePerUnit' => 'required|max:15|numeric'
        ];
        $messages = [
            'idCompSize.required' => 'Component Size Must be Selected',
            'idSchemeActivation.required' => 'Scheme Must be Selected',
            'ratePerUnit.required' => 'Rate Per Unit Field Must be Filled',
            'ratePerUnit.numeric' => 'Rate Per Unit Field Must Have Numeric Value'
        ];
        $this->validate($request, $rules, $messages);
        
        $comprate->fill($request->all());
        $comprate->update();
        return redirect('comprates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $comprate = \App\Comprate:: where('idCompRate', '=', $id)->first();
        $comprate->delete();
        return redirect('comprates');
    }

}
