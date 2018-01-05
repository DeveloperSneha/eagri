<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UserBlockController extends Controller {

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
                ->whereNull('user_designation_district_mapping.idVillage')
                ->select('users.idUser', 'userName', 'districtName', 'subDivisionName', 'blockName', 'sectionName', 'designationName', DB::raw('group_concat(blockName)AS blockName'))
                ->get();
        //dd($user_list);
        $users = ['Select User'] + \App\User::where('idUser', '>', 2)->pluck('userName', 'idUser')->toArray();
        $districts = ['' => 'Select District'] + \App\District::pluck('districtName', 'idDistrict')->toArray();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('users.user_block', compact('users', 'sections', 'districts', 'user_list'));
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
//        dd(count($request->idBlocks));
        $rules = [
            'idSubdivision' => 'required',
            'idDistrict' => 'required',
            'idSection' => 'required',
            'idDesignation' => 'required',
            'userName' => 'required|regex:/^[\pL\s\-)]+$/u'
        ];
        if (count($request->idBlocks) == 0) {
            $rules += ['idBlock' => 'required'];
        }
        $messages = [
            'idDistrict.required' => 'District must be selected.',
            'idSubdivision.required' => 'Subdivision must be selected.',
            'idBlock.required' => 'Block must be selected.',
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
        foreach ($request->idBlocks as $var) {
            $user_desig = new \App\UserDesignationDistrictMapping();
            $user_desig->fill($request->all());
            $user_desig->idBlock = $var;
            $user_desig->idUser = $user->idUser;
            $user_desig->save();
        }
        DB::commit();
        return redirect('userblock');
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
        $user_list = DB::table('users')
                ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                ->join('designation', 'user_designation_district_mapping.idDesignation', '=', 'designation.idDesignation')
                ->join('section', 'designation.idSection', '=', 'section.idSection')
                ->join('district', 'user_designation_district_mapping.idDistrict', '=', 'district.idDistrict')
                ->join('subdivision', 'user_designation_district_mapping.idSubdivision', '=', 'subdivision.idSubdivision')
                ->join('block', 'user_designation_district_mapping.idBlock', '=', 'block.idBlock')
                ->whereNull('user_designation_district_mapping.idVillage')
                ->select('users.idUser', 'userName', 'districtName', 'subDivisionName', 'blockName', 'sectionName', 'designationName', DB::raw('group_concat(blockName)AS blockName'))
                ->get();
        $user = \App\User::where('idUser', '=', $id)->first();
        $user_section = $user->userdesig()->with('designation.section')->get()->pluck('designation.idSection')->unique();
        $user_desig = $user->userdesig()->with('designation')->get();
        $users = ['Select User'] + \App\User::where('idUser', '>', 2)->pluck('userName', 'idUser')->toArray();
        $districts = ['' => 'Select District'] + \App\District::pluck('districtName', 'idDistrict')->toArray();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        
        return view('users.user_block', compact('users','user', 'sections', 'districts', 'user_list','user_section','user_desig'));
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

    public function getDesignations($id) {
        $designations = \App\Designation::where("idSection", $id)
                        ->where('level', 3)->get()
                        ->pluck("designationName", "idDesignation")->toArray();
        return json_encode($designations);
    }

    public function getVillages($id) {
        $villages = \App\village::where("idBlock", $id)
                        ->pluck("villageName", "idVillage")->toArray();
        return json_encode($villages);
    }

}
