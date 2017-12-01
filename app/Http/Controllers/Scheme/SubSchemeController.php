<?php

namespace App\Http\Controllers\Scheme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubSchemeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $subschemes = \App\SubScheme::orderBy('name')->get();
        return view('schemes.subscheme', compact('subschemes'));
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
        $subscheme = new \App\SubScheme();
        $subscheme->fill($request->all());
        $subscheme->save();
        return redirect('subschemes');
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
        $subschemes = \App\SubScheme::orderBy('name')->get();
        $subscheme = \App\SubScheme::findOrfail($id);
        return view('schemes.subscheme', compact('subscheme', 'subschemes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $subscheme = \App\SubScheme::findOrfail($id);
        $subscheme->fill($request->all());
        $subscheme->update();
        return redirect('subschemes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $subscheme = \App\SubScheme::findOrfail($id);
        $subscheme->delete();
        return redirect('subschemes');
    }

}
