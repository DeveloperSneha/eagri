<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\UnitRequest;
class UnitController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        //$units = \App\Unit::orderBy('unitName')->get();
		$units = \App\Unit::orderBy('idUnit')->get();
        return view('units.index', compact('units'));
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
    public function store(UnitRequest $request) {
        //
        //  dd($request->all());
        $Unit = new \App\Unit();
        $Unit->fill($request->all());
        $Unit->save();
        return redirect('units');
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
        $units = \App\Unit::orderBy('unitName')->get();
        $unit = \App\Unit:: where('idUnit', '=', $id)->first();
        //   dd($role);
        return view('units.index', compact('unit', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitRequest $request, $id) {
        //
        $unit = \App\Unit:: where('idUnit', '=', $id)->first();
        $unit->fill($request->all());
        $unit->update();
        return redirect('units');
    }
    /**
     * Check There is Any dependency Exist
     *

     */
    public function deleteUnit($id) {
        //
        $unit = \App\Unit:: where('idUnit', '=', $id)->first();
        $schact = \App\SchemeActivation::where('idUnit', '=', $id)->get();
        if ($schact->count() > 0) {
            return redirect()->back()->with('message', 'You Can not Delete this Unit Because it is Already in Use!');
        }
        else{
            return view('units.delete', compact('unit'));
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
        $unit = \App\Unit:: where('idUnit', '=', $id)->first();
        $unit->delete();
        return redirect('units');
    }

}
