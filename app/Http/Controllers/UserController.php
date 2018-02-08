<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Verhoeff;
use Gate;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Gate::denies('add-user'))
            return deny();
        $users = \App\User::with('roles')->has('roles')->get();
        $roles = \App\Role::orderBy('name')->get()->pluck('name', 'idRole')->toArray();
        return view('useradm.index', compact('users', 'roles'));
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
        if (Gate::denies('add-user'))
            return deny();
        $rules = [
            'name' => 'required',
            'mobile' => 'required',
            'aadhaar' => 'required|unique:users|min:12|max:12',
            'idRole' => 'required'
        ];
        if ($request->aadhaar != null) {
            if (Verhoeff::validate($request->aadhaar) === false) {
                $rules += ['aadhaarabc' => 'required'];
            }
        }
        $message = [
            'aadhaarabc.required' => 'Aadhaar Number Is Not vaild  | आधार संख्या वैध नहीं है',
        ];
        $this->validate($request, $rules, $message);
        // dd($request->all());
        $user = new \App\User();
        $user->fill($request->all());
        $user->password = bcrypt($request->mobile);
        $user->save();
        $user->roles()->attach(array(($request->idRole)));
        return redirect('useradm');
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
        //
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
