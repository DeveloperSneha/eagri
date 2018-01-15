<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Requests\UserBlockRequest;
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
                ->select('users.idUser', 'userName', 'districtName', 'blockName', 'subDivisionName', 'sectionName', 'designationName', DB::raw('group_concat(blockName)AS blockName'))
                ->groupBy('idUser')
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
        $users = ['' => 'Select User'] + \App\User::where('idUser', '>', 2)->pluck('userName', 'idUser')->toArray();
        $districts = ['' => 'Select District'] + \App\District::pluck('districtName', 'idDistrict')->toArray();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('users.existing_userblock', compact('users', 'sections', 'districts', 'user_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserBlockRequest $request) {
//        dd(count($request->idBlocks));
        //  dd($request->all());
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
//dd('here');
        $userdesig = \App\UserDesignationDistrictMapping::where('iddesgignationdistrictmapping', '=', $id)->first();
//        $user_section = $user->userdesig()->with('designation.section')->get()->pluck('designation.idSection')->unique();
//        $user_desig = $user->userdesig()->with('designation')->get();
//        $user_subdiv = $user->userdesig()->with('subdivision')
//                        ->whereNotNull('idSubdivision')
//                        ->get()->pluck('subdivision.idSubdivision', 'subdivision.subDivisionName')->unique();
//        $user_block = $user->userdesig()->with('block')
//                        ->whereNotNull('idBlock')->whereNull('idVillage')->get();
//        //dd($user_block);
//        $users = ['Select User'] + \App\User::where('idUser', '>', 2)->pluck('userName', 'idUser')->toArray();
        $districts = ['' => 'Select District'] + \App\District::pluck('districtName', 'idDistrict')->toArray();
        $sections = ['' => 'Select Section'] + \App\Section::pluck('sectionName', 'idSection')->toArray();
        return view('users.edituser_block', compact('districts','sections','userdesig'));
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
            'idBlock'=>'required',
            'idSection' => 'required',
            'idDesignation' => 'required|unique:user_designation_district_mapping,idDesignation,'.$id.',iddesgignationdistrictmapping,idBlock,' . $request->idBlock,
            //'userName' => 'required|regex:/^[\pL\s\-)]+$/u|between:2,50'
        ];
//        if (count($request->idBlocks) == 0) {
//            $rules += ['idBlock' => 'required'];
//        }
        $messages = [
            'idDistrict.required' => 'District must be selected.',
            'idSubdivision.required' => 'Subdivision must be selected.',
            'idBlock.required' => 'Block must be selected.',
            'idDesignation.unique' => 'User With This Designation has already been registered in this Block.',
            'idSection.required' => 'Select Section First.',
            'idDesignation.required' => 'Select Designation.',
           // 'userName.required' => 'UserName Must Not Be Empty.'
        ];
        $this->validate($request, $rules, $messages);
        $userdesig = \App\UserDesignationDistrictMapping::where('iddesgignationdistrictmapping', '=', $id)->first();
        $userdesig->fill($request->all());
        $userdesig->update();
//        $user = \App\User::where('idUser', '=', $id)->first();
//        $user_district = $user->userdesig()->pluck('idDistrict')->unique()->first();
//        $user_subdivision = $user->userdesig()->pluck('idSubdivision')->unique()->first();
//        $user->fill($request->all());
//        $old_ids = $user->userdesig()->pluck('iddesgignationdistrictmapping')->toArray();
//        //dd($old_ids);
//        $user_blocks = new \Illuminate\Database\Eloquent\Collection();
//        foreach ($request->idBlocks as $var) {
//            $user_sub = \App\UserDesignationDistrictMapping::firstOrNew(['idBlock' => $var, 'idDistrict' => $user_district, 'idSubdivision' => $user_subdivision, 'idDesignation' => $request->idDesignation, 'idUser' => $user->idUser]);
//            $user_blocks->add($user_sub);
//        }
//        $new_ids = $user_blocks->pluck('iddesgignationdistrictmapping')->toArray();
////        dd($new_ids);
//        $detach = array_diff($old_ids, $new_ids);
//        //  dd($detach);
//        DB::beginTransaction();
//
//        $user->update();
//        \App\UserDesignationDistrictMapping::whereIn('iddesgignationdistrictmapping', $detach)->delete();
//        $user->userdesig()->saveMany($user_blocks);
//
//        DB::commit();
        return redirect('userblock/'.$userdesig->idUser.'/edituser');
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
        $userdesig = $user->userdesig()->whereNotNull('idBlock')->whereNull('idVillage')->get();
        return view('users.userdetails_block', compact('user','userdesig'));
        
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
