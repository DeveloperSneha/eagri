<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;

class PermissionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Gate::denies('add-permission'))
            return deny();
        $permissions = \App\Permission::orderBy('label')->get();
        return view('permissions.index', compact('permissions'));
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
        if (Gate::denies('add-permission'))
            return deny();
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            'label' => 'required|unique:permissions,label'
        ]);
        $permission = new \App\Permission();
        $permission->fill($request->all());
        $permission->save();
        return redirect('permissions');
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
        if (Gate::denies('add-permission'))
            return deny();
        $permission = \App\Permission::where('idPermission', '=', $id)->first();
        $permissions = \App\Permission::orderBy('label')->get();
        return view('permissions.index', compact('permissions', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        if (Gate::denies('add-permission'))
            return deny();
        $permission = \App\Permission::where('idPermission', '=', $id)->first();
        $permission->fill($request->all());
        $permission->save();
        return redirect('permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
