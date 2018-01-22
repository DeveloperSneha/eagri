<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Requests\UserVillageRequest;
use App\Http\Controllers\Controller;
use DB;

class UserVillageController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user_list = DB::table('users')
                ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                ->join('designation', 'user_designation_district_mapping.idDesignation', '=', 'designation.idDesignation')
                ->join('section', 'designation.idSection', '=', 'section.idSection')
                ->join('district', 'user_designation_district_mapping.idDistrict', '=', 'district.idDistrict')
                ->join('subdivision', 'user_designation_district_mapping.idSubdivision', '=', 'subdivision.idSubdivision')
                ->join('block', 'user_designation_district_mapping.idBlock', '=', 'block.idBlock')
                ->join('village', 'user_designation_district_mapping.idVillage', '=', 'village.idVillage')
                ->select('users.idUser', 'userName', 'districtName', 'subDivisionName', 'blockName', 'sectionName', 'designationName', DB::raw('group_concat(villageName)AS villageName'))
                ->groupBy('idUser')
                ->get();
        //dd($user_list);
        $users = ['Select User'] + \App\User::where('idUser', '>', 2)->pluck('userName', 'idUser')->toArray();
        $districts = ['' => 'Select District'] + \App\District::pluck('districtName', 'idDistrict')->toArray();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('users.user_villages', compact('users', 'sections', 'districts', 'user_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $users = ['' => 'Select User'] + \App\User::where('idUser', '>', 2)->pluck('userName', 'idUser')->toArray();
        $districts = ['' => 'Select District'] + \App\District::pluck('districtName', 'idDistrict')->toArray();
        $subdivisions = ['' => 'Select Sub Division'] + \App\Subdivision::pluck('subDivisionName', 'idSubdivision')->toArray();
        $blocks = \App\Block::pluck('blockName', 'idBlock')->toArray();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('users.existing_uservillage', compact('users', 'sections', 'blocks', 'subdivisions', 'districts', 'user_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserVillageRequest $request) {
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
        return redirect('uservillage');
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
        $userdesig = \App\UserDesignationDistrictMapping::where('iddesgignationdistrictmapping', '=', $id)->first();
//        $user = \App\User::where('idUser', '=', $id)->first();
//        $user_section = $user->userdesig()->with('designation.section')->get()->pluck('designation.idSection')->unique();
//        $user_desig = $user->userdesig()->with('designation')->get();
//        $users = ['Select User'] + \App\User::where('idUser', '>', 2)->pluck('userName', 'idUser')->toArray();
//        $user_subdiv = $user->userdesig()->with('subdivision')->get()->pluck('subdivision.idSubdivision','subdivision.subDivisionName')->unique();
//       //dd($user_subdiv);
//        $user_village = $user->userdesig()->with('village')->get();
        //dd($user_village);
        $districts = ['' => 'Select District'] + \App\District::pluck('districtName', 'idDistrict')->toArray();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        // dd($districts);
        return view('users.edituser_villages', compact('userdesig', 'sections', 'districts'));
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
            'idDesignation' => 'required|unique:user_designation_district_mapping,idDesignation,' . $id . ',iddesgignationdistrictmapping,idVillage,' . $request->idVillage,
            'idVillage' => 'required',
                //    'userName' => 'required|regex:/^[\pL\s\-)]+$/u|between:2,50'
        ];
//        if (count($request->idVillages) == 0) {
//            $rules += ['idVillage' => 'required'];
//        }
        $messages = [
            'idDistrict.required' => 'District must be selected.',
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
//        $user = \App\User::where('idUser', '=', $id)->first();
//        $user_district = $user->userdesig()->pluck('idDistrict')->unique()->first();
//        $user_subdivision = $user->userdesig()->pluck('idSubdivision')->unique()->first();
//        $user_block = $user->userdesig()->pluck('idBlock')->unique()->first();
//        $user->fill($request->all());
//        $old_ids = $user->userdesig()->pluck('iddesgignationdistrictmapping')->toArray();
//        //dd($old_ids);
//        $user_villages = new \Illuminate\Database\Eloquent\Collection();
//        foreach ($request->idVillages as $var) {
//            $user_sub = \App\UserDesignationDistrictMapping::firstOrNew(['idVillage' => $var, 'idDistrict' => $user_district,'idSubdivision' => $user_subdivision,'idBlock' => $user_block, 'idDesignation' => $request->idDesignation, 'idUser' => $user->idUser]);
//            $user_villages->add($user_sub);
//        }
//        $new_ids = $user_villages->pluck('iddesgignationdistrictmapping')->toArray();
////        dd($new_ids);
//        $detach = array_diff($old_ids, $new_ids);
//        //  dd($detach);
//        DB::beginTransaction();
//
//        $user->update();
//        \App\UserDesignationDistrictMapping::whereIn('iddesgignationdistrictmapping', $detach)->delete();
//        $user->userdesig()->saveMany($user_villages);
//
//        DB::commit();
        return redirect('uservillage/' . $userdesig->idUser . '/edituser');
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

    public function getUserDetails($id) {
        $user = \App\User::where('idUser', '=', $id)->first();
        $userdesig = $user->userdesig()->whereNotNull('idVillage')->get();
        return view('users.userdetails_village', compact('user', 'userdesig'));
    }

    public function getDesignations($id) {
        $desig = \App\Designation::where("idSection", $id)->get();
        if ($desig->count() == 4) {
            $designations = \App\Designation::where("idSection", $id)
                            ->where('level', 4)->get()
                            ->pluck("designationName", "idDesignation")->toArray();
        } elseif ($desig->count() == 3) {
            $designations = \App\Designation::where("idSection", $id)
                            ->where('level', 3)->get()
                            ->pluck("designationName", "idDesignation")->toArray();
        } elseif ($desig->count() == 2) {
            $designations = \App\Designation::where("idSection", $id)
                            ->where('level', 2)->get()
                            ->pluck("designationName", "idDesignation")->toArray();
        } else {
            $designations = \App\Designation::where("idSection", $id)
                            ->where('level', 2)->get()
                            ->pluck("designationName", "idDesignation")->toArray();
        }
        return json_encode($designations);
    }

}
