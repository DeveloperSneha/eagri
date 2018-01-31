<?php

namespace App\Http\Controllers\Authority\Subdivision;

use App\Http\Requests\UserBlockRequest;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Auth;

class BlockUserController extends \App\Http\Controllers\Authority\AuthorityController {

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
        $user_subdivision = $user->userdesig()
                        ->with('subdivision')
                        ->where('idSubdivision', '=', Session::get('idSubdivision'))
                        ->get()
                        ->pluck('subdivision.subDivisionName', 'subdivision.idSubdivision')->toArray();
        // dd($user_district);
        $sections = ['' => '---Select Section---'] + $user->userdesig()->with('designation.section')
                        ->where('idSubdivision', '=', Session::get('idSubdivision'))
                        ->get()
                        ->pluck('designation.section.sectionName', 'designation.section.idSection')
                        ->toArray();
        $user_section = $user->userdesig()->with('designation.section')
                        ->where('idSubdivision', '=', Session::get('idSubdivision'))
                        ->get()
                        ->pluck('designation.section.idSection')->toArray();
        $user_list = DB::table('users')
                ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                ->join('designation', 'user_designation_district_mapping.idDesignation', '=', 'designation.idDesignation')
                ->join('section', 'designation.idSection', '=', 'section.idSection')
                ->where('user_designation_district_mapping.idSubdivision', '=', Session::get('idSubdivision'))
                ->whereNotNull('user_designation_district_mapping.idBlock')
                ->whereNull('user_designation_district_mapping.idVillage')
                ->whereIn('section.idSection', $user_section)
                ->select('users.idUser', 'userName')
                ->groupBy('idUser')
                ->get();
        return view('authority.subdivisions.user_block', compact('user_subdivision', 'sections', 'user_district', 'user_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
        $users = ['' => 'Select User'] + \App\User::where('idUser', '>', 2)->pluck('userName', 'idUser')->toArray();
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
        // dd($user_district);
        $sections = ['' => '---Select Section---'] + $user->userdesig()->with('designation.section')
                        ->where('idSubdivision', '=', Session::get('idSubdivision'))
                        ->get()
                        ->pluck('designation.section.sectionName', 'designation.section.idSection')
                        ->toArray();
        return view('authority.subdivisions.existing_userblock', compact('user_subdivision', 'users', 'sections', 'user_district'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserBlockRequest $request) {
        // dd($request->all());
        if ($request->has('existing')) {
            foreach ($request->idBlocks as $var) {
                $user_desig = new \App\UserDesignationDistrictMapping();
                $user_desig->fill($request->all());
                $user_desig->idBlock = $var;
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
            foreach ($request->idBlocks as $var) {
                $user_desig = new \App\UserDesignationDistrictMapping();
                $user_desig->fill($request->all());
                $user_desig->idBlock = $var;
                $user_desig->idUser = $user->idUser;
                $user_desig->save();
            }
            DB::commit();
        }
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        }
        return redirect('authority/subdivisions/blockuseradd');
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
        $user_subdivision = $user->userdesig()
                        ->with('subdivision')
                        ->where('idSubdivision', '=', Session::get('idSubdivision'))
                        ->get()
                        ->pluck('subdivision.subDivisionName', 'subdivision.idSubdivision')->toArray();
        // dd($user_district);
        $sections = ['' => '---Select Section---'] + $user->userdesig()->with('designation.section')
                        ->where('idSubdivision', '=', Session::get('idSubdivision'))
                        ->get()
                        ->pluck('designation.section.sectionName', 'designation.section.idSection')
                        ->toArray();
        return view('authority.subdivisions.edituser_block', compact('sections', 'userdesig', 'user_district', 'user_subdivision'));
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
            'idBlock' => 'required',
            'idSection' => 'required',
            'idDesignation' => 'required|unique:user_designation_district_mapping,idDesignation,' . $id . ',iddesgignationdistrictmapping,idBlock,' . $request->idBlock,
        ];
        $messages = [
            'idDistrict.required' => 'District must be selected.',
            'idSubdivision.required' => 'Subdivision must be selected.',
            'idBlock.required' => 'Block must be selected.',
            'idDesignation.unique' => 'User With This Designation has already been registered in this Block.',
            'idSection.required' => 'Select Section First.',
            'idDesignation.required' => 'Select Designation.',
        ];
        $this->validate($request, $rules, $messages);
        $userdesig = \App\UserDesignationDistrictMapping::where('iddesgignationdistrictmapping', '=', $id)->first();
        $userdesig->fill($request->all());
        $userdesig->update();
        return redirect('authority/subdivisions/blockuseradd/' . $userdesig->idUser . '/details');
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
        $designations = \App\Designation::where("idSection", $id)
                        ->where('level', 3)->get()
                        ->pluck("designationName", "idDesignation")->toArray();
        return json_encode($designations);
    }

    public function getBlocks($id) {
        $blocks = \App\Block::where("idSubdivision", $id)->get()
                        ->pluck("blockName", "idBlock")->toArray();
        return json_encode($blocks);
    }

    public function editUser($id) {
        //  dd($id);
        $user = \App\User::where('idUser', '=', $id)->first();
        $userdesig = $user->userdesig()->whereNotNull('idBlock')->whereNull('idVillage')->get();
        return view('authority.subdivisions.userdetails_block', compact('user', 'userdesig'));
    }

}
