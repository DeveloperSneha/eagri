<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Requests\UserSubdivisionRequest;
use App\Http\Controllers\Controller;
use DB;

class UserSubdivisionController extends Controller {

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
                ->whereNull('user_designation_district_mapping.idBlock')
                ->whereNull('user_designation_district_mapping.idVillage')
                ->select('users.idUser', 'userName', 'subDivisionName', 'districtName', 'sectionName', 'designationName', DB::raw('group_concat(subDivisionName)AS subDivisionName'))
                ->groupBy('idUser')
                ->get();
//        dd($user_list);
        $users = ['' => 'Select User'] + \App\User::where('idUser', '>', 2)->pluck('userName', 'idUser')->toArray();
        $districts = ['' => 'Select District'] + \App\District::pluck('districtName', 'idDistrict')->toArray();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('users.user_subdivision', compact('users', 'sections', 'districts', 'user_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $users = ['' => 'Select User'] + \App\User::where('idUser', '>', 2)->pluck('userName', 'idUser')->toArray();
        $districts = ['' => 'Select District'] + \App\District::pluck('districtName', 'idDistrict')->toArray();

        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('users.existing_usersubdivision', compact('users', 'sections', 'districts', 'user_list'));
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
        return redirect('usersubdivision');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
       $userdesig = \App\UserDesignationDistrictMapping::where('iddesgignationdistrictmapping', '=', $id)->first();
      
//        $user_section = $user->userdesig()->with('designation.section')->get()->pluck('designation.idSection')->unique();
//        $user_desig = $user->userdesig()->with('designation')->get();
//        $user_dist = $user->userdesig()->with('district')->get()->pluck('district.idDistrict')->toArray();
//        //dd($user_dist);
//        $users = \App\User::where('idUser', '>', 2)->get();
        $districts = \App\District::pluck('districtName', 'idDistrict')->toArray();
//        $user_subdivision = $userdesig->idSubdivision;
//        dd($user_subdivision);
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('users.edituser_subdivision', compact( 'sections', 'designations', 'districts', 'userdesig'));
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
            'idSubdivision'=>'required',
            'idDesignation' => 'required|unique:user_designation_district_mapping,idDesignation,'.$id.',iddesgignationdistrictmapping,idSubdivision,' . $request->idSubdivision,
           // 'userName' => 'required|regex:/^[\pL\s\-)]+$/u|between:2,50'
        ];
//        if (count($request->idSubdivisions) == 0) {
//            $rules += ['idSubdivision' => 'required'];
//        }
        $messages = [
            'idSection.required' => 'Select Section First.',
            'idDesignation.required' => 'Select Designation.',
            'idDesignation.unique' => 'User With This Designation has already been registered in this Subdivision.',
           // 'userName.required' => 'UserName Must Not Be Empty.'
        ];
        $this->validate($request, $rules, $messages);
        $userdesig = \App\UserDesignationDistrictMapping::where('iddesgignationdistrictmapping', '=', $id)->first();
        $userdesig->fill($request->all());
        $userdesig->update();
//        $user = \App\User::where('idUser', '=', $id)->first();
//        $user_district = $user->userdesig()->pluck('idDistrict')->unique()->first();
//        $user->fill($request->all());
//        $old_ids = $user->userdesig()->pluck('iddesgignationdistrictmapping')->toArray();
//        //dd($old_ids);
//        $user_subdivisions = new \Illuminate\Database\Eloquent\Collection();
//        foreach ($request->idSubdivisions as $var) {
//            $user_sub = \App\UserDesignationDistrictMapping::firstOrNew(['idSubdivision' => $var, 'idDistrict' => $user_district, 'idDesignation' => $request->idDesignation, 'idUser' => $user->idUser]);
//            $user_subdivisions->add($user_sub);
//        }
//        $new_ids = $user_subdivisions->pluck('iddesgignationdistrictmapping')->toArray();
////        dd($new_ids);
//        $detach = array_diff($old_ids, $new_ids);
//        //  dd($detach);
//        DB::beginTransaction();
//
//        $user->update();
//        \App\UserDesignationDistrictMapping::whereIn('iddesgignationdistrictmapping', $detach)->delete();
//        $user->userdesig()->saveMany($user_subdivisions);
//
//        DB::commit();
        return redirect('usersubdivision/'.$userdesig->idUser.'/edituser');
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
        $userdesig = $user->userdesig()->whereNotNull('idSubdivision')->whereNull('idBlock')->whereNull('idVillage')->get();
        return view('users.userdetails_subdivision', compact('user','userdesig'));
        
    }
    
    public function getDesignations($id) {
        $designations = \App\Designation::where("idSection", $id)
                        ->where('level', 2)->get()
                        ->pluck("designationName", "idDesignation")->toArray();
        return json_encode($designations);
    }

    public function getBlocks($id) {
        $blocks = \App\Block::where("idSubdivision", $id)->get()
                        ->pluck("blockName", "idBlock")->toArray();
        return json_encode($blocks);
    }

}
