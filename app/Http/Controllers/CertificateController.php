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
        //$certificates = \App\Certificate::orderBy('certificateName')->get();
		$certificates = \App\Certificate::orderBy('idCertificate')->get();
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
            'certificateName' => 'required|unique:certificates|regex:/^[\pL\s\-]+$/u|between:3,40',
            'description'=>'required|between:3,100|regex:/^[\pL\s\-.]+$/u'
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
//        $certificates = \App\Certificate::orderBy('certificateName')->get();
//        $certificate = \App\Certificate::where('idCertificate', '=', $id)->first();
//        return view('certificates.index', compact('certificate', 'certificates'));
    }
    
    public function editCertificate($id) {
        $certificates = \App\Certificate::orderBy('certificateName')->get();
        $certificate = \App\Certificate::where('idCertificate', '=', $id)->first();
        $schemes = \App\Schemecert::where('idCertificate', '=', $id)->get();
        if ($schemes->count() > 0) {
            return redirect()->back()->with('message', 'You Can not Delete this Certificate Because it is Already in Use!');
        }else{
            return view('certificates.index', compact('certificate','certificates'));
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
    //    dd($id);
        $certificate = \App\Certificate::where('idCertificate', '=', $id)->first();
        $rules=[
            'certificateName' => 'required|regex:/^[\pL\s\-]+$/u|between:3,40|unique:certificates,certificateName,'.$id.',idCertificate',
            'description'=>'required|between:3,100|regex:/^[\pL\s\-.]+$/u'
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
     * Check There is Any dependency Exist
     *

     */
    public function deleteCertificate($id) {
        //
        $certificate = \App\Certificate::where('idCertificate', '=', $id)->first();
        $schemes = \App\Schemecert::where('idCertificate', '=', $id)->get();
        if ($schemes->count() > 0) {
            return redirect()->back()->with('message', 'You Can not Delete this Certificate Because it is Already in Use!');
        }else{
            return view('certificates.delete', compact('certificate'));
        }
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
