<?php

namespace App\Http\Controllers\Authority\Subdivision;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Auth;

class BlockUserController extends \App\Http\Controllers\Authority\AuthorityController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user_list = DB::table('users')
                ->join('user_designation_district_mapping', 'user_designation_district_mapping.idUser', '=', 'users.idUser')
                ->where('user_designation_district_mapping.idSubdivision','=',Session::get('idsubdivision')) 
                ->whereNotNull('user_designation_district_mapping.idBlock')
                ->whereNull('user_designation_district_mapping.idVillage')
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
        // dd($user_district);
        $sections = ['' => '---Select Section---'] + $user->userdesig()->with('designation.section')
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->whereNull('idSubdivision')
                        ->whereNull('idBlock')
                        ->whereNull('idVillage')
                        ->get()
                        ->pluck('designation.section.sectionName', 'designation.section.idSection')
                        ->toArray();
       
        return view('authority.subdivisions.user_block', compact('user_subdivision', 'sections', 'user_district','user_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserBlockRequest $request) {
       // dd($request->all());
        
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
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
        // $user = \App\User::where('idUser', '=', $id)->first();
        // $userdesig = $user->userdesig()->whereNotNull('idBlock')->whereNull('idVillage')->get();
        // return view('authority.subdivisions.userdetails_block', compact('user','userdesig'));
        
    }
}
