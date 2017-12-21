<?php

namespace App\Http\Controllers\Authority;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class AuthoritySchemeController extends AuthorityController {

    /**
     * Display a listing of the resource.
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $authority = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $authority_dist = $authority->userdesig->district->idDistrict;
//         dd($authority_dist);
        //$schemes = \App\FarmerAppliedScheme::orderBy('idAppliedScheme')->get();
        $schemes = DB::table('farmerapplied_scheme')
                ->join('scheme', 'farmerapplied_scheme.idScheme', '=', 'scheme.idScheme')
                ->join('farmers', 'farmerapplied_scheme.idFarmer', '=', 'farmers.idFarmer')
                ->join('district', 'farmers.idDistrict', '=', 'district.idDistrict')
                ->join('block', 'farmers.idBlock', '=', 'block.idBlock')
                ->join('village', 'farmers.idVillage', '=', 'village.idVillage')
                ->where('farmers.idDistrict', '=', $authority_dist)
                ->get();
//          dd($schemes);
        return view('authority.schemes.scheme', compact('schemes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // dd('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //   dd(Auth::user()->userdesig->idDesignation);
        // dd($request->all());
        $request->validate([
            'remarks' => 'required',
            'haveChecked' => 'required'
        ]);
        $approve_scheme = new \App\SchemeApproveReject();
        $approve_scheme->fill($request->all());
        $approve_scheme->haveChecked = $request->has('haveChecked') ? 'Y' : 'N';
        $approve_scheme->idDesignation = Auth::user()->userdesig->idDesignation;
        
        if ($request->has('Approve')) {
            $approve_scheme->status = 'A';
            $approve_scheme->save();
            return redirect('authority/approvedscheme');
        } else {
            $approve_scheme->status = 'R';
            $approve_scheme->save();
            return redirect('authority/rejectedscheme');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $farmer_scheme = \App\FarmerAppliedScheme::findOrfail($id);
        return view('authority.schemes.view', compact('farmer_scheme'));
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

    public function approvedScheme() {
        $schemes = \App\SchemeApproveReject::where('status', '=', 'A')->get();
        $schemes->idAppliedScheme = Auth::user()->userdesig->district->idDistrict;
        return view('authority.schemes.approved_scheme', compact('schemes','district'));
    }

    public function rejectedScheme() {
        $schemes = \App\SchemeApproveReject::where('status', '=', 'R')->get();
        $schemes->idAppliedScheme = Auth::user()->userdesig->district->idDistrict;
//        dd($schemes);
        return view('authority.schemes.rejected_scheme', compact('schemes'));
    }

}
