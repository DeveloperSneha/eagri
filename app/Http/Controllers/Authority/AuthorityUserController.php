<?php

namespace App\Http\Controllers\Authority;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use DB;
use Gate;

class AuthorityUserController extends AuthorityController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Gate::denies('add-user'))
            return deny();
        $authority = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $user_desig = $authority->userdesig()->where('idDesignation', Session::get('idDesignation'))->first();
        $authority_dist = $user_desig->district->idDistrict;
        $users = \App\User::whereHas('userdesig', function ($query) use ($authority_dist) {
                    $query->where('idDistrict', $authority_dist);
                })->where('idUser', '!=', Auth::User()->idUser)->get();

        $sch_blocks =  \App\Block::where('idDistrict', '=', $authority_dist)->get()->pluck('blockName', 'idBlock')->toArray();
        
        $designations = \App\Designation::where("idSection", $user_desig->designation->idSection)
                        ->pluck("designationName", "idDesignation")->toArray();
        return view('authority.adduser', compact('sch_blocks', 'designations', 'users'));
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
        // dd($request->all());
        $rules = [
            'idBlock' => 'unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idBlock,' . $request->idBlock,
            'idDesignation' => 'unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idBlock,' . $request->idBlock,
            'userName' => 'required|unique:users|regex:/^[\pL\s\-)]+$/u'
        ];
        if (count($request->designations) == 0) {
            $rules += ['designation' => 'required'];
        }
        if (count($request->sch_blocks) == 0) {
            $rules += ['block' => 'required'];
        }
        $message = [
            'idBlock.required' => 'Select Atleast One Block',
            'designation.required' => 'Select Atleast One Designation.',
            'idDesignation.unique' => 'User With This Designation has already been registered.',
            'userName.required' => 'UserName Must Not Be Empty.'
        ];
        $this->Validate($request, $rules, $message);
        $authority = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $user_desig = $authority->userdesig()->where('idDesignation', Session::get('idDesignation'))->first();
        $authority_dist = $user_desig->district->idDistrict;
        $user = new \App\User();
        $user->fill($request->all());
        $password = 'abc@123';
        $user->password = bcrypt($password);
        DB::beginTransaction();
        $user->save();

        foreach ($request->designations as $var) {
            $user_desig = new \App\UserDesignationDistrictMapping();
            $user_desig->fill($request->all());
            $user_desig->idDistrict = $authority_dist;
            $user_desig->idDesignation = $var;
            $user_desig->idUser = $user->idUser;
            $user_desig->save();
        }
        DB::commit();
        return redirect('authority/adduser');
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
        $authority = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $authority_desig = $authority->userdesig()->where('idDesignation', Session::get('idDesignation'))->first();
        $authority_dist = $authority_desig->district->idDistrict;
        $users = \App\User::whereHas('userdesig', function ($query) use ($authority_dist) {
                    $query->where('idDistrict', $authority_dist);
                })->where('idUser', '!=', Auth::User()->idUser)->get();
        $sch_blocks = \App\Block::where('idDistrict', '=', $authority_dist)->get()->pluck('blockName', 'idBlock')->toArray();
        $user_block = $user->userdesig()->with('block')->get()->pluck('block.idBlock')->unique();

        $designations = \App\Designation::where("idSection", $authority_desig->designation->idSection)
                        ->pluck("designationName", "idDesignation")->toArray();
        $userdesig = $user->userdesig->pluck("idDesignation")->toArray();
        // dd($userdesig);
        return view('authority.adduser', compact('sch_blocks', 'designations', 'users', 'user', 'user_block', 'userdesig'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //   dd($request->idBlock);
        $rules = [
            'idBlock' => 'unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idBlock,' . $request->idBlock,
            'idDesignation' => 'unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idBlock,' . $request->idBlock,
            'userName' => 'required|regex:/^[\pL\s\-)]+$/u'
        ];
        if (count($request->designations) == 0) {
            $rules += ['designation' => 'required'];
        }
        if (count($request->sch_blocks) == 0) {
            $rules += ['block' => 'required'];
        }
        $message = [
            'idBlock.required' => 'Slelct Atleast One Block',
            'designation.required' => 'Select Atleast OneDesignation.',
            'idDesignation.unique' => 'User With This Designation has already been registered.',
            'userName.required' => 'UserName Must Not Be Empty.'
        ];
        $this->Validate($request, $rules, $message);


        $authority = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $authority_desig = $authority->userdesig()->where('idDesignation', Session::get('idDesignation'))->first();
        $authority_dist = $authority_desig->district->idDistrict;


        $user = \App\User::where('idUser', '=', $id)->first();
        $user->userName = $request->userName;
        $old_ids = $user->userdesig()->pluck('iddesgignationdistrictmapping')->toArray();
        // dd($old_ids);
        $user_designations = new \Illuminate\Database\Eloquent\Collection();
        foreach ($request->designations as $var) {
            $user_desig = \App\UserDesignationDistrictMapping::firstOrNew(['idDesignation' => $var, 'idDistrict' => $authority_dist, 'idBlock' => $request->idBlock, 'idUser' => $user->idUser]);
            $user_designations->add($user_desig);
        }
        $new_ids = $user_designations->pluck('iddesgignationdistrictmapping')->toArray();

        //  dd($new_ids);
        $detach = array_diff($old_ids, $new_ids);
        // dd($detach);
        DB::beginTransaction();
        $user->update();
        \App\UserDesignationDistrictMapping::whereIn('iddesgignationdistrictmapping', $detach)->delete();


        $user->userdesig()->saveMany($user_designations);

        DB::commit();
        return redirect('authority/adduser');
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
    public function villages($id) {
        $blocks = (explode(",",$id));
        dd($blocks);
        $villages = \App\Village::whereIn("idBlock", $blocks)
                        ->pluck("villageName", "idVillage")->toArray();
        return json_encode($villages);
       
    }

}
