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
                //->groupBy('idUser')
                ->get();
       // dd($user_list);
        $users = ['Select User'] + \App\User::where('idUser', '>', 2)->pluck('userName', 'idUser')->toArray();
        $districts = \App\District::pluck('districtName', 'idDistrict')->toArray();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('users.user_district', compact('users', 'sections', 'districts','user_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $users = [''=>'Select User'] + \App\User::where('idUser', '>', 2)->pluck('userName', 'idUser')->toArray();
        $districts = \App\District::pluck('districtName', 'idDistrict')->toArray();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('users.existing_userdistrict', compact('users', 'sections', 'districts','user_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserDistrictRequest $request) {
       // dd($request->has('existing'));
        if($request->has('existing')){
            foreach ($request->idDistricts as $var) {
                $user_desig = new \App\UserDesignationDistrictMapping();
                $user_desig->fill($request->all());
                $user_desig->idDistrict = $var;
                $user_desig->idUser = $request->idUser;
                $user_desig->save();
            }
        }else{
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
                ->where('users.idUser','=',$id)
                ->select('districtName as District','designationName as Designation','sectionName as Section','subDivisionName as Subdivision','blockName as Block',DB::raw('group_concat(villageName)AS villageName'))->first();
        return json_encode($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user_list = DB::table('users')
                ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                ->join('designation', 'user_designation_district_mapping.idDesignation', '=', 'designation.idDesignation')
                ->join('section', 'designation.idSection', '=', 'section.idSection')
                ->join('district', 'user_designation_district_mapping.idDistrict', '=', 'district.idDistrict')
                ->whereNull('user_designation_district_mapping.idSubdivision')
                ->whereNull('user_designation_district_mapping.idBlock')
                ->whereNull('user_designation_district_mapping.idVillage')
                ->get();
        $user = \App\User::where('idUser', '=', $id)->first();
        $user_section = $user->userdesig()->with('designation.section')->get()->pluck('designation.idSection')->unique();
        $user_desig = $user->userdesig()->with('designation')->get();
        $user_district = $user->userdesig()->whereNull('idSubdivision')->whereNull('idBlock')->whereNull('idVillage')->pluck('idDistrict')->toArray();
       // dd($user_district);
        $users = \App\User::where('idUser', '>', 2)->get();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        $districts = \App\District::pluck('districtName', 'idDistrict')->toArray();
        return view('users.user_district', compact('user_district','user_list','user', 'users', 'sections', 'designations', 'districts', 'user_section', 'user_desig'));
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
        $user = \App\User::where('idUser', '=', $id)->first();
        $user->fill($request->all());
        $old_ids = $user->userdesig()->pluck('iddesgignationdistrictmapping')->toArray();
        //dd($old_ids);
        $user_districts = new \Illuminate\Database\Eloquent\Collection();
        foreach ($request->idDistricts as $var) {
            $user_dist = \App\UserDesignationDistrictMapping::firstOrNew(['idDistrict' => $var, 'idDesignation' => $request->idDesignation,'idUser' => $user->idUser]);
            $user_districts->add($user_dist);
        }
        $new_ids = $user_districts->pluck('iddesgignationdistrictmapping')->toArray();
        //dd($new_ids);
        $detach = array_diff($old_ids, $new_ids);
      //  dd($detach);
        DB::beginTransaction();
        
        $user->update();
        \App\UserDesignationDistrictMapping::whereIn('iddesgignationdistrictmapping', $detach)->delete();
        $user->userdesig()->saveMany($user_districts);

        DB::commit();
        return redirect('userdistrict');
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
