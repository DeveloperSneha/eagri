<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Requests\UserDistrictRequest;
use App\Http\Controllers\Controller;
use DB;

class UserDistrictController extends Controller {

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
                ->whereNull('user_designation_district_mapping.idSubdivision')
                ->whereNull('user_designation_district_mapping.idBlock')
                ->whereNull('user_designation_district_mapping.idVillage')
                ->select('users.idUser', 'userName', 'districtName', 'sectionName', 'designationName', DB::raw('group_concat(districtName)AS districtName'))
                ->groupBy('idUser')
                ->get();
        // dd($user_list);
        $users = ['Select User'] + \App\User::where('idUser', '>', 1)->pluck('userName', 'idUser')->toArray();
        $districts = \App\District::pluck('districtName', 'idDistrict')->toArray();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('users.user_district', compact('users', 'sections', 'districts', 'user_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $users = ['' => 'Select User'] + \App\User::where('idUser', '>', 1)->pluck('userName', 'idUser')->toArray();
        $districts = \App\District::pluck('districtName', 'idDistrict')->toArray();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('users.existing_userdistrict', compact('users', 'sections', 'districts', 'user_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserDistrictRequest $request) {
        // dd($request->has('existing'));
        if ($request->has('existing')) {
            foreach ($request->idDistricts as $var) {
                $user_desig = new \App\UserDesignationDistrictMapping();
                $user_desig->fill($request->all());
                $user_desig->idDistrict = $var;
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
            foreach ($request->idDistricts as $var) {
                $user_desig = new \App\UserDesignationDistrictMapping();
                $user_desig->fill($request->all());
                $user_desig->idDistrict = $var;
                $user_desig->idUser = $user->idUser;
                $user_desig->save();
            }
            DB::commit();
        }
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        }
        return redirect('userdistrict');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
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
        // dd($user);
//        foreach ($user as $query) {
//            $result[] = [$query->idDistrict, $query->districtName,$query->idSubdivision, $query->subDivisionName,$query->idBlock, $query->blockName];
//        }
        return json_encode($user);
//
//        $user = \App\User::where('idUser', '=', $id)->first();
//
//        $user_district = $user->userdesig()
//                        ->whereNotNull('idDistrict')
//                        ->whereNull('idSubdivision')
//                        ->whereNull('idBlock')
//                        ->whereNull('idVillage')
//                        ->with(array('district' => function($query) {
//                                $query->select('idDistrict', 'districtName');
//                            }))
//                         ->with(array('designation' => function($query) {
//                                $query->select('idDesignation','designationName');
//                            }))->get()->toArray();
//       // dd($user_district);
//        $user_subdivision = $user->userdesig()
//                        ->whereNotNull('idSubdivision')
//                        ->whereNull('idBlock')
//                        ->whereNull('idVillage')
//                        ->with(array('subdivision' => function($query) {
//                                $query->select('idSubdivision', 'subDivisionName');
//                            }))
//                        ->get()->toArray();
//        $user_block = $user->userdesig()
//                        ->whereNotNull('idBlock')
//                        ->whereNull('idVillage')
//                        ->with(array('block' => function($query) {
//                                $query->select('idBlock', 'blockName');
//                            }))
//                        ->get()->toArray();
//        $user_village = $user->userdesig()
//                        ->whereNotNull('idVillage')
//                        ->with(array('village' => function($query) {
//                                $query->select('idVillage', 'villageName');
//                            }))
//                        ->get()->toArray();
//        $data[] = compact('user_district','user_subdivision','user_block','user_village');
        // dd($data);
        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $userdesig = \App\UserDesignationDistrictMapping::where('iddesgignationdistrictmapping', '=', $id)->first();
        // dd($userdesig->district->idDistrict);
//        $user_section = $user->userdesig()->with('designation.section')->get()->pluck('designation.idSection')->unique();
//        $user_desig = $user->userdesig()->with('designation')->get();
//        $user_district = $user->userdesig()->whereNull('idSubdivision')->whereNull('idBlock')->whereNull('idVillage')->pluck('idDistrict')->toArray();
        // dd($user_district);
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        $districts = \App\District::pluck('districtName', 'idDistrict')->toArray();
        return view('users.edituser_district', compact('userdesig', 'sections', 'districts', 'designation'));
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
            'idDistrict' => 'required',
            //' unique:' . getYearlyDbConn() . '.subject_group,s_no,' . $id . ',id,course_id,' . $course_id,
            'idDesignation' => 'required|unique:user_designation_district_mapping,idDesignation,' . $id . ',iddesgignationdistrictmapping,idDistrict,' . $request->idDistrict
                // 'userName' => 'required|regex:/^[\pL\s\-)]+$/u|between:2,50'
        ];

//        if (count($request->idDistricts) == 0) {
//            $rules += ['idDistrict' => 'required'];
//        }
        $messages = [
            'idDistrict.required' => 'District must be selected.',
            'idSection.required' => 'Select Section First.',
            'idDesignation.required' => 'Select Designation.',
            'idDesignation.unique' => 'User With This Designation has already been registered in this District.',
                //   'userName.required' => 'UserName Must Not Be Empty.'
        ];
        $this->validate($request, $rules, $messages);
        $userdesig = \App\UserDesignationDistrictMapping::where('iddesgignationdistrictmapping', '=', $id)->first();
        $userdesig->fill($request->all());
        $userdesig->update();

//        $user = \App\User::where('idUser', '=', $id)->first();
//        $user->fill($request->all());
//        $old_ids = $user->userdesig()->pluck('iddesgignationdistrictmapping')->toArray();
//        //dd($old_ids);
//        $user_districts = new \Illuminate\Database\Eloquent\Collection();
//        foreach ($request->idDistricts as $var) {
//            $user_dist = \App\UserDesignationDistrictMapping::firstOrNew(['idDistrict' => $var, 'idDesignation' => $request->idDesignation, 'idUser' => $user->idUser]);
//            $user_districts->add($user_dist);
//        }
//        $new_ids = $user_districts->pluck('iddesgignationdistrictmapping')->toArray();
//        //dd($new_ids);
//        $detach = array_diff($old_ids, $new_ids);
//        //  dd($detach);
//        DB::beginTransaction();
//
//        $user->update();
//        \App\UserDesignationDistrictMapping::whereIn('iddesgignationdistrictmapping', $detach)->delete();
//        $user->userdesig()->saveMany($user_districts);
//
//        DB::commit();
        return redirect('userdistrict/' . $userdesig->idUser . '/edituser');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
    }

    public function getUserDetails($id) {
        $user = \App\User::where('idUser', '=', $id)->first();
        $userdesig = $user->userdesig()->whereNotNull('idDistrict')->whereNull('idSubdivision')->whereNull('idBlock')->whereNull('idVillage')->get();
        return view('users.userdetails_district', compact('user', 'userdesig'));
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

    public function getDetails($id, $desig) {
        $user = DB::table('users')
                ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                ->join('district', 'user_designation_district_mapping.idDistrict', '=', 'district.idDistrict')
//                ->leftjoin('subdivision', 'user_designation_district_mapping.idSubdivision', '=', 'subdivision.idSubdivision')
//                ->leftjoin('block', 'user_designation_district_mapping.idBlock', '=', 'block.idBlock')
//                ->leftjoin('village', 'user_designation_district_mapping.idVillage', '=', 'village.idVillage')
                ->where('users.idUser', '=', $id)
                ->where('user_designation_district_mapping.idDesignation', '=', $desig)
                ->select('user_designation_district_mapping.idDesignation', 'districtName', 'user_designation_district_mapping.idDistrict')
                ->distinct()
                ->get();

        return json_encode($user);
    }

    public function getSubdivision($id, $desig, $district) {
        $user = DB::table('users')
                ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                ->join('district', 'user_designation_district_mapping.idDistrict', '=', 'district.idDistrict')
                ->leftjoin('subdivision', 'user_designation_district_mapping.idSubdivision', '=', 'subdivision.idSubdivision')
//                ->leftjoin('block', 'user_designation_district_mapping.idBlock', '=', 'block.idBlock')
//                ->leftjoin('village', 'user_designation_district_mapping.idVillage', '=', 'village.idVillage')
                ->whereNotNull('user_designation_district_mapping.idSubdivision')
                ->where('users.idUser', '=', $id)
                ->where('user_designation_district_mapping.idDesignation', '=', $desig)
                ->where('user_designation_district_mapping.idDistrict', '=', $district)
                ->select('user_designation_district_mapping.idDesignation', 'subDivisionName', 'user_designation_district_mapping.idSubdivision')
                ->distinct()
                ->get();

        return json_encode($user);
    }

    public function getBlock($id, $desig, $subdiv) {
        $user = DB::table('users')
                ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                ->join('district', 'user_designation_district_mapping.idDistrict', '=', 'district.idDistrict')
                ->leftjoin('subdivision', 'user_designation_district_mapping.idSubdivision', '=', 'subdivision.idSubdivision')
                ->leftjoin('block', 'user_designation_district_mapping.idBlock', '=', 'block.idBlock')
                ->whereNotNull('user_designation_district_mapping.idBlock')
                ->where('users.idUser', '=', $id)
                ->where('user_designation_district_mapping.idDesignation', '=', $desig)
                ->where('user_designation_district_mapping.idSubdivision', '=', $subdiv)
                ->select('user_designation_district_mapping.idDesignation', 'blockName', 'user_designation_district_mapping.idBlock')
                ->distinct()
                ->get();

        return json_encode($user);
    }

}
