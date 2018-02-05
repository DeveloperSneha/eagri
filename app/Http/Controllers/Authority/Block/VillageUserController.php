<?php

namespace App\Http\Controllers\Authority\Block;

use Illuminate\Http\Request;
use App\Http\Requests\UserVillageRequest;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use DB;

class VillageUserController extends \App\Http\Controllers\Authority\AuthorityController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user_list = DB::table('users')
                ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                ->where('user_designation_district_mapping.idBlock', '=', Session::get('idBlock'))
                ->whereNotNull('user_designation_district_mapping.idVillage')
                ->select('users.idUser', 'userName')
                ->groupBy('idUser')
                ->get();
        $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
        $user_district = $user->userdesig()
                        ->with('district')
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->get()
                        ->pluck('district.districtName', 'district.idDistrict')->toArray();
        $user_subdivision = $user->userdesig()
                        ->with('subdivision')
                        ->where('idSubdivision', '=', Session::get('idSubdivision'))
                        ->get()
                        ->pluck('subdivision.subDivisionName', 'subdivision.idSubdivision')->toArray();
        $user_block = $user->userdesig()
                        ->with('block')
                        ->where('idBlock', '=', Session::get('idBlock'))
                        ->get()
                        ->pluck('block.blockName', 'block.idBlock')->toArray();
        // dd($user_district);
        $sections = ['' => '---Select Section---'] + $user->userdesig()->with('designation.section')
                        ->where('idBlock', '=', Session::get('idBlock'))
                        ->get()
                        ->pluck('designation.section.sectionName', 'designation.section.idSection')
                        ->toArray();
        return view('authority.blocks.user_villages', compact('user_subdivision', 'user_block', 'sections', 'user_district', 'user_list'));
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
        $user_subdivision = $user->userdesig()
                        ->with('subdivision')
                        ->where('idSubdivision', '=', Session::get('idSubdivision'))
                        ->get()
                        ->pluck('subdivision.subDivisionName', 'subdivision.idSubdivision')->toArray();
        $user_block = $user->userdesig()
                        ->with('block')
                        ->where('idBlock', '=', Session::get('idBlock'))
                        ->get()
                        ->pluck('block.blockName', 'block.idBlock')->toArray();
        // dd($user_district);
        $sections = ['' => '---Select Section---'] + $user->userdesig()->with('designation.section')
                        ->where('idBlock', '=', Session::get('idBlock'))
                        ->get()
                        ->pluck('designation.section.sectionName', 'designation.section.idSection')
                        ->toArray();
        return view('authority.blocks.existing_uservillage', compact('users', 'user_subdivision', 'user_block', 'sections', 'user_district', 'user_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserVillageRequest $request) {
        // dd($request->all());
        if ($request->has('existing')) {
            foreach ($request->idVillages as $var) {
                $user_desig = new \App\UserDesignationDistrictMapping();
                $user_desig->fill($request->all());
                $user_desig->idVillage = $var;
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
            foreach ($request->idVillages as $var) {
                $user_desig = new \App\UserDesignationDistrictMapping();
                $user_desig->fill($request->all());
                $user_desig->idVillage = $var;
                $user_desig->idUser = $user->idUser;
                $user_desig->save();
            }
            DB::commit();
        }
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        }
        return redirect('authority/blocks/viuser');
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
       // dd('here');
        $userdesig = \App\UserDesignationDistrictMapping::where('iddesgignationdistrictmapping', '=', $id)->first();
        $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
        $user_district = $user->userdesig()
                        ->with('district')
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->get()
                        ->pluck('district.districtName', 'district.idDistrict')->toArray();
        $user_subdivision = $user->userdesig()
                        ->with('subdivision')
                        ->where('idSubdivision', '=', Session::get('idSubdivision'))
                        ->get()
                        ->pluck('subdivision.subDivisionName', 'subdivision.idSubdivision')->toArray();
        $user_block = $user->userdesig()
                        ->with('block')
                        ->where('idBlock', '=', Session::get('idBlock'))
                        ->get()
                        ->pluck('block.blockName', 'block.idBlock')->toArray();
        $sections = ['' => '---Select Section---'] + $user->userdesig()->with('designation.section')
                        ->where('idBlock', '=', Session::get('idBlock'))
                        ->get()
                        ->pluck('designation.section.sectionName', 'designation.section.idSection')
                        ->toArray();
        return view('authority.blocks.edituser_village', compact('sections', 'user_block','userdesig', 'user_district', 'user_subdivision'));
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
            // 'idDistrict' => 'required',
            'idSubdivision' => 'required',
            'idBlock' => 'required',
            'idSection' => 'required',
            'idDesignation' => 'required|unique:user_designation_district_mapping,idDesignation,' . $id . ',iddesgignationdistrictmapping,idVillage,' . $request->idVillage,
            'idVillage' => 'required',
        ];
        $messages = [
            // 'idDistrict.required' => 'District must be selected.',
            'idSubdivision.required' => 'Subdivision must be selected.',
            'idBlock.required' => 'Block must be selected.',
            'idVillage.required' => 'Atleast One Village Must Be selected.',
            'idSection.required' => 'Select Section First.',
            'idDesignation.required' => 'Select Designation.',
            'idDesignation.unique' => 'User With This Designation has already been registered.',
        ];
        $this->validate($request, $rules, $messages);
        $userdesig = \App\UserDesignationDistrictMapping::where('iddesgignationdistrictmapping', '=', $id)->first();
        $userdesig->fill($request->all());
        $userdesig->update();
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        }
        return redirect('authority/blocks/viuser/' . $userdesig->idUser . '/details');
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

    public function editUser($id) {
       // dd('here');
        $user = \App\User::where('idUser', '=', $id)->first();
        $userdesig = $user->userdesig()->whereNotNull('idVillage')->get();
        return view('authority.blocks.userdetails_village', compact('user', 'userdesig'));
    }

}
