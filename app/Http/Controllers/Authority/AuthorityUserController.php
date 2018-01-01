<?php

namespace App\Http\Controllers\Authority;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use DB;

class AuthorityUserController extends AuthorityController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $authority = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $user_desig = $authority->userdesig()->where('idDesignation', Session::get('idDesignation'))->first();
        $authority_dist = $user_desig->district->idDistrict;
        //   $users = \App\User::load('userdesig')->where('idDistrict', '=', $authority_dist)->get();

        $users = \App\User::whereHas('userdesig', function ($query) use ($authority_dist) {
                    $query->where('idDistrict', $authority_dist);
                })->get();

        $sch_blocks = ["" => 'Select Block'] + \App\Block::where('idDistrict', '=', $authority_dist)->get()->pluck('blockName', 'idBlock')->toArray();
        $designations = \App\Designation::where("idSection", $user_desig->designation->idSection)
                        ->pluck("designationName", "idDesignation")->toArray();
        return view('authority.adduser', compact('sch_blocks', 'designations', 'users'));
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
        // dd($request->all());
        $rules = [
            'idBlock' => 'required',
            'idDesignation' => 'unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idBlock,' . $request->idBlock,
            'userName' => 'required|regex:/^[\pL\s\-)]+$/u'
        ];
        if (count($request->designations) == 0) {
            $rules += ['designation' => 'required'];
        }
        $message = [
            'idBlock.required' => 'Block Must be selected',
            'designation.required' => 'Select Atleast OneDesignation.',
            'idDesignation.unique' => 'User With This Designation has already been registered.',
            'userName.required' => 'UserName Must Not Be Empty.'
        ];
        $this->Validate($request, $rules, $message);
        $authority = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $user_desig = $authority->userdesig()->where('idDesignation', Session::get('idDesignation'))->first();
        $authority_dist = $user_desig->district->idDistrict;
        $user = new \App\User();
        $user->fill($request->all());
        $password = 'abc@123';
        $user->password = bcrypt($password);
        DB::beginTransaction();
        $user->save();

        foreach ($request->designations as $var) {
            $user_desig = new \App\UserDesignationDistrictMapping();
            $user_desig->fill($request->all());
            $user_desig->idDistrict = $authority_dist;
            $user_desig->idDesignation = $var;
            $user_desig->idUser = $user->idUser;
            $user_desig->save();
        }
        DB::commit();
        return redirect('user-registration');
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
//        $authority = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
//        $user_desig = $authority->userdesig()->where('idDesignation', Session::get('idDesignation'))->first();
//        $authority_dist = $user_desig->district->idDistrict;
//        //   $users = \App\User::load('userdesig')->where('idDistrict', '=', $authority_dist)->get();
//
//        $users = \App\User::whereHas('userdesig', function ($query) use ($authority_dist) {
//                    $query->where('idDistrict', $authority_dist);
//                })->get();
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
