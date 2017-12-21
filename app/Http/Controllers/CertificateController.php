<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CertificateController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $certificates = \App\Certificate::orderBy('certificateName')->get();
        return view('certificates.index', compact('certificates'));
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
        $rules=[
            'certificateName' => 'required|unique:certificates|regex:/^[\pL\s\-]+$/u|max:100',
            'description'=>'required|max:200|regex:/^[\pL\s\-.]+$/u'
        ];
        $message=[
            'certificateName.required' => 'Certificate Name Must Be Filled.',
            'certificateName.unique' => 'Certificate Name Is Already Taken.',
            'description.required' => 'Description Must Be Provided.'
            
        ];
        $this->Validate($request,$rules,$message);
        
        $certificate = new \App\Certificate();
        $certificate->fill($request->all());
        $certificate->save();
        return redirect('certificates');
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
     * @param  int  $idlName::
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $certificates = \App\Certificate::orderBy('certificateName')->get();
        $certificate = \App\Certificate::where('idCertificate', '=', $id)->first();
        return view('certificates.index', compact('certificate', 'certificates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
    //    dd($id);
        $certificate = \App\Certificate::where('idCertificate', '=', $id)->first();
        $rules=[
            'certificateName' => 'required|regex:/^[\pL\s\-]+$/u|max:100|',Rule::unique('certificates')->ignore($certificate->idCertificate, 'idCertificate'),
            'description'=>'required|max:200|regex:/^[\pL\s\-.]+$/u'
        ];
        $message=[
            'certificateName.required' => 'Certificate Name Must Be Filled.',
            'description.required' => 'Description Must Be Provided.'
            
        ];
        $this->Validate($request,$rules,$message);
        $certificate->fill($request->all());
        $certificate->update();
        return redirect('certificates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $certificate = \App\Certificate::where('idCertificate', '=', $id)->first();
        $certificate->delete();
        return redirect('certificates');
    }

}