<?php

namespace App\Http\Controllers\Authority\Block;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ProfileController extends \App\Http\Controllers\Authority\AuthorityController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
        $user_blockdesig = $user->userdesig()->whereNotNull('idBlock')->whereNull('idVillage')->get();
        
        return view('authority.blocks.profile', compact('user', 'user_blockdesig'));
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
        //
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
        $rules = [
            'name' => 'required',
            'fatherName' => 'required',
            'motherName' => 'required',
            'dob' => 'required',
            'aadhaar' => 'required',
            'mobile' => 'required|min:10|max:10',
            'ofc_address' => 'required',
            'address' => 'required'
        ];
        $this->validate($request, $rules);
        //dd($request->all());
        $profile = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $profile->fill($request->all());
        $profile->isComplete = 'Y';
        $profile->update();
        return redirect('authority/blocks/profile');
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
