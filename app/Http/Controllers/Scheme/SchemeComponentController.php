<?php

namespace App\Http\Controllers\Scheme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchemeComponentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $compschemes = \App\Schemecomponent::orderBy('name')->get();
        return view('schemes.compscheme', compact('compschemes'));
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
        $request->validate([
            'name' => 'required',
        ]);
        $compscheme = new \App\SchemeComponent();
        $compscheme->fill($request->all());
        $compscheme->save();
        return redirect('compschemes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $compschemes = \App\SchemeComponent::orderBy('name')->get();
        $compscheme = \App\SchemeComponent::findOrfail($id);
        return view('schemes.compscheme', compact('compscheme', 'compschemes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $compscheme = \App\SchemeComponent::findOrfail($id);
        $compscheme->fill($request->all());
        $compscheme->update();
        return redirect('compschemes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $compscheme = \App\SchemeComponent::findOrfail($id);
        $compscheme->delete();
        return redirect('compschemes');
    }

}
