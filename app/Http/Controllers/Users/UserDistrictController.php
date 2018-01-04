<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Controllers\Controller;
use DB;

class UserDistrictController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
       // $user_list = \App\User::where('idUser', '>', 2)->pluck('userName', 'idUser')->toArray();
        $users = ['Select User']+\App\User::where('idUser', '>', 2)->pluck('userName', 'idUser')->toArray();
        $districts = \App\District::pluck('districtName', 'idDistrict')->toArray();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('users.user_district', compact('users', 'sections', 'districts'));
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
      //  dd($request->has('existing'));
        $rules = [
            'idSection' => 'required',
            'idDesignation' => 'required|unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idDistrict,' . $request->idDistrict,
            'userName' => 'required|regex:/^[\pL\s\-)]+$/u'
        ];
        if (count($request->idDistricts) == 0) {
            $rules += ['idDistrict' => 'required'];
        }
        $messages = [
            'idDistrict.required' => 'District must be selected.',
            'idSection.required' => 'Select Section First.',
            'idDesignation.required' => 'Select Designation.',
            'idDesignation.unique' => 'User With This Designation has already been registered.',
            'userName.required' => 'UserName Must Not Be Empty.'
        ];
        $this->validate($request, $rules, $messages);
      //  dd($request->all());
        $user = new \App\User();
        $user->fill($request->all());
        $password = 'abc@123';
        $user->password = bcrypt($password);
        DB::beginTransaction();
        $user->save();
        foreach ($request->idDistricts as $var) {
            $user_desig = new \App\UserDesignationDistrictMapping();
            $user_desig->fill($request->all());
            $user_desig->idDistrict = $var;
            $user_desig->idUser = $user->idUser;
            $user_desig->save();
        }
        DB::commit();
        return redirect('userdistrict');
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
        $user = \App\User::where('idUser', '=', $id)->first();
        $user_section = $user->userdesig()->with('designation.section')->get()->pluck('designation.idSection')->unique();
        $user_desig = $user->userdesig()->with('designation')->get();
        $users = \App\User::where('idUser', '>', 2)->get();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        $districts = \App\District::pluck('districtName', 'idDistrict')->toArray();
        return view('users.user_district', compact('user', 'users', 'sections', 'designations', 'districts', 'user_section', 'user_desig'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRegistrationRequest $request, $id) {
        $user = \App\User::where('idUser', '=', $id)->first();
        dd($user);
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

    public function getDesignations($id) {
        $designations = \App\Designation::where("idSection", $id)->where('level', 1)->get()
                        ->pluck("designationName", "idDesignation")->toArray();
        return json_encode($designations);
    }

    public function getSubdivisions($id) {
        $subdivisions = \App\Subdivision::where("idDistrict", $id)->get()
                        ->pluck("subDivisionName", "idSubdivision")->toArray();
        return json_encode($subdivisions);
    }

}
