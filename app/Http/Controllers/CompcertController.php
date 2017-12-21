<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CompcertController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $certificates = ['' => 'Select Certificate'] + \App\Certificate::pluck('certificateName', 'idCertificate')->toArray();
        $components = ['' => 'Select Components'] + \App\Component::pluck('componentName', 'idComponent')->toArray();
        $compcerts = \App\Compcert::orderBy('idComponent')->get();
        return view('compcerts.index', compact('compcerts', 'certificates', 'components'));
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
            'idComponent' => 'required|max:15',
            'idCertificate' => 'required|max:15|unique:compcerts,idCertificate,NULL,idCompCerts,idComponent,' . $request->idComponent,
        ];
        $messages = [
            'idCertificate.required' => 'Certificate Must be Selected.',
            'idComponent.required' => 'Component Must be Selected.',
            'idCertificate.unique' => 'Certificate for this Component Is Already Taken.'
        ];
        $this->validate($request, $rules, $messages);
        $compcert = new \App\Compcert();
        $compcert->fill($request->all());
        $compcert->save();
        return redirect('compcerts');
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
        $certificates = ['' => 'Select Certificate'] + \App\Certificate::pluck('certificateName', 'idCertificate')->toArray();
        $components = ['' => 'Select Components'] + \App\Component::pluck('componentName', 'idComponent')->toArray();
        $compcerts = \App\Compcert::orderBy('idComponent')->get();
        $compcert = \App\Compcert:: where('idCompCerts', '=', $id)->first();
        //   dd($role);
        return view('compcerts.index', compact('compcert', 'compcerts', 'certificates', 'components'));
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
        // dd('here');
        $compcert = \App\Compcert:: where('idCompCerts', '=', $id)->first();
        $rules = [
            'idCertificate' => 'required|max:15',
            'idComponent' => 'required|max:15'
        ];
        $messages = [
            'idCertificate.required' => 'Certificate Must be Selected.',
            'idComponent.required' => 'Component Must be Selected.'
        ];
        $this->validate($request, $rules, $messages);

        $compcert->fill($request->all());
        $compcert->update();
        return redirect('compcerts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        $compcert = \App\Compcert:: where('idCompCerts', '=', $id)->first();
        $compcert->delete();
        return redirect('compcerts');
    }

}
