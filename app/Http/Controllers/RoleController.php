<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class RoleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $roles = \App\Role::orderBy('name')->get();
        return view('roles.index', compact('roles'));
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
        $request->validate([
            'name' => 'required',
        ]);
        $role = new \App\Role();
        $role->fill($request->all());
        $role->save();
        return redirect('/roles');
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
        $roles = \App\Role::orderBy('name')->get();
        $role = \App\Role::where('idRole', '=', $id)->first();
        return view('roles.index', compact('role', 'roles'));
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
        $role = \App\Role::findOrfail($id);
        $request->validate([
            'name' => 'required|regex:/^[\pL\s\-)]+$/u', Rule::unique('roles')->ignore($role->id, 'id'),
        ]);
        $role->fill($request->all());
        $role->update();
        return redirect('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        dd('here');
        $role = \App\Role::findOrfail($id);
        $role->delete();
        return redirect('roles');
    }

    public function showPermissions($role_id) {
        $role = \App\Role::where('idRole','=',$role_id)->first();
        $permissions = \App\Permission::
                //whereIn('idPermission', function($q) {
                 //   $q->from('permission_role')->select('idPermission');
              //  })
                        orderBy('label')->get();
        return view('roles.permissions_to_role', compact('role', 'permissions', 'group'));
    }

    public function savePermissions(Request $request, $role_id) {
       // dd($request->all());
        $role = \App\Role::where('idRole','=',$role_id)->first();
        $role->permissions()->sync($request->input('permission_id', []));
        return redirect('roles');
    }

}
