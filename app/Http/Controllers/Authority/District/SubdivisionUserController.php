<?php

namespace App\Http\Controllers\Authority\District;

use Illuminate\Http\Request;
use App\Http\Requests\UserSubdivisionRequest;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use DB;

class SubdivisionUserController extends \App\Http\Controllers\Authority\AuthorityController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
        $user_district = $user->userdesig()
                        ->with('district')
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->get()
                        ->pluck('district.districtName', 'district.idDistrict')->toArray();
        // dd($user_district);
        $sections = ['' => '---Select Section---'] + $user->userdesig()->with('designation.section')
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->whereNull('idSubdivision')
                        ->whereNull('idBlock')
                        ->whereNull('idVillage')
                        ->get()
                        ->pluck('designation.section.sectionName', 'designation.section.idSection')
                        ->toArray();
        $user_section = $user->userdesig()->with('designation.section')
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->whereNull('idSubdivision')
                        ->whereNull('idBlock')
                        ->whereNull('idVillage')
                        ->get()
                        ->pluck('designation.section.idSection')->toArray();
        $user_list = DB::table('users')
                ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                ->join('designation', 'user_designation_district_mapping.idDesignation', '=', 'designation.idDesignation')
                ->join('section', 'designation.idSection', '=', 'section.idSection')
                ->where('user_designation_district_mapping.idDistrict', '=', Session::get('idDistrict'))
                ->whereNotNull('user_designation_district_mapping.idSubdivision')
                ->whereNull('user_designation_district_mapping.idBlock')
                ->whereNull('user_designation_district_mapping.idVillage')
                ->whereIn('section.idSection', $user_section)
                ->select('users.idUser', 'userName', 'designation.idSection')
                ->groupBy('idUser')
                ->get();
       // dd($user_list);
        $subdivisions = \App\Subdivision::where("idDistrict", Session::get('idDistrict'))->get()
                        ->pluck("subDivisionName", "idSubdivision")->toArray();
        return view('authority.districts.user_subdivision', compact('subdivisions', 'sections', 'user_district', 'user_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
        $users = ['' => 'Select User'] + \App\User::where('idUser', '>', 1)->pluck('userName', 'idUser')->toArray();
        $user_district = $user->userdesig()
                        ->with('district')
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->get()
                        ->pluck('district.districtName', 'district.idDistrict')->toArray();
        $sections = ['' => '---Select Section---'] + $user->userdesig()->with('designation.section')
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->whereNull('idSubdivision')
                        ->whereNull('idBlock')
                        ->whereNull('idVillage')
                        ->get()
                        ->pluck('designation.section.sectionName', 'designation.section.idSection')
                        ->toArray();
        $subdivisions = \App\Subdivision::where("idDistrict", Session::get('idDistrict'))->get()
                        ->pluck("subDivisionName", "idSubdivision")->toArray();
        return view('authority.districts.existing_usersubdivision', compact('subdivisions', 'users', 'sections', 'user_district'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserSubdivisionRequest $request) {
        // dd($request->all());
        if ($request->has('existing')) {
            foreach ($request->idSubdivisions as $var) {
                $user_desig = new \App\UserDesignationDistrictMapping();
                $user_desig->fill($request->all());
                $user_desig->idSubdivision = $var;
                $user_desig->idUser = $request->idUser;
                $user_desig->save();
            }
        } else {
            $user = new \App\User();
            $user->fill($request->all());
            $password = 'abc@123';
            $user->password = bcrypt($password);
            DB::beginTransaction();
            $user->save();
            foreach ($request->idSubdivisions as $var) {
                $user_desig = new \App\UserDesignationDistrictMapping();
                $user_desig->fill($request->all());
                $user_desig->idSubdivision = $var;
                $user_desig->idUser = $user->idUser;
                $user_desig->save();
            }
            DB::commit();
        }
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        }
        return redirect('authority/districts/addsubuser');
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
        $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
        $user_district = $user->userdesig()
                        ->with('district')
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->get()
                        ->pluck('district.districtName', 'district.idDistrict')->toArray();
        $userdesig = \App\UserDesignationDistrictMapping::where('iddesgignationdistrictmapping', '=', $id)->first();
        $sections = ['' => '---Select Section---'] + $user->userdesig()->with('designation.section')
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->whereNull('idSubdivision')
                        ->whereNull('idBlock')
                        ->whereNull('idVillage')
                        ->get()
                        ->pluck('designation.section.sectionName', 'designation.section.idSection')
                        ->toArray();
        $user_section = $userdesig->designation->section->idSection;
        $subdivisions = \App\Subdivision::where("idDistrict", Session::get('idDistrict'))->get()
                        ->pluck("subDivisionName", "idSubdivision")->toArray();
        return view('authority.districts.edituser_subdivision', compact('user_section', 'sections', 'userdesig', 'user_district', 'subdivisions'));
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
            'idSection' => 'required',
            'idSubdivision' => 'required',
            'idDesignation' => 'required|unique:user_designation_district_mapping,idDesignation,' . $id . ',iddesgignationdistrictmapping,idSubdivision,' . $request->idSubdivision,
        ];
        $messages = [
            'idSection.required' => 'Select Section First.',
            'idDesignation.required' => 'Select Designation.',
            'idDesignation.unique' => 'User With This Designation has already been registered in this Subdivision.',
        ];
        $this->validate($request, $rules, $messages);
        $userdesig = \App\UserDesignationDistrictMapping::where('iddesgignationdistrictmapping', '=', $id)->first();
        $userdesig->fill($request->all());
        $userdesig->update();
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        }
        return redirect('authority/districts/addsubuser/' . $userdesig->idUser . '/details');
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

    public function getUserDetail($id) {
        $user = DB::table('users')
                        ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                        ->join('designation', 'user_designation_district_mapping.idDesignation', '=', 'designation.idDesignation')
                        ->join('section', 'designation.idSection', '=', 'section.idSection')
                        ->join('district', 'user_designation_district_mapping.idDistrict', '=', 'district.idDistrict')
                        ->leftjoin('subdivision', 'user_designation_district_mapping.idSubdivision', '=', 'subdivision.idSubdivision')
                        ->leftjoin('block', 'user_designation_district_mapping.idBlock', '=', 'block.idBlock')
                        ->leftjoin('village', 'user_designation_district_mapping.idVillage', '=', 'village.idVillage')
                        ->where('users.idUser', '=', $id)
                        ->select('districtName', 'designationName', 'sectionName', 'subDivisionName', 'blockName', 'villageName')->get()->toArray();
        return json_encode($user);
    }

    public function getDesignations($id) {
        $designations = \App\Designation::where("idSection", $id)
                        ->where('level', 2)->get()
                        ->pluck("designationName", "idDesignation")->toArray();
        return json_encode($designations);
    }

    public function editUser($id) {
        $user = \App\User::where('idUser', '=', $id)->first();
        $userdesig = $user->userdesig()->whereNotNull('idSubdivision')->whereNull('idBlock')->whereNull('idVillage')->get();
        return view('authority.districts.userdetails_subdivision', compact('user', 'userdesig'));
    }

}
