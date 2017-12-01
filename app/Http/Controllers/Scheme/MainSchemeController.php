<?php

namespace App\Http\Controllers\Scheme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainSchemeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $schemes = \App\MainScheme::orderBy('name')->get();
        return view('schemes.mainscheme', compact('schemes'));
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
        $scheme = new \App\MainScheme();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $schemes = \App\MainScheme::orderBy('name')->get();
        $scheme = \App\MainScheme::findOrfail($id);
        return view('schemes.mainscheme', compact('scheme', 'schemes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $scheme = \App\MainScheme::findOrfail($id);
        $scheme->fill($request->all());
        $scheme->update();
        return redirect('schemes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $scheme = \App\MainScheme::findOrfail($id);
        $scheme->delete();
        return redirect('schemes');
    }

}
