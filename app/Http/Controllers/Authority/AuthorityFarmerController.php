<?php

namespace App\Http\Controllers\Authority;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class AuthorityFarmerController extends AuthorityController {

    public function registeredFarmer() {
        $authority = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $user_desig = $authority->userdesig()->where('idDesignation', Session::get('idDesignation'))->first();
        $authority_dist = $user_desig->district->idDistrict;
        $farmers = \App\Farmer::where('idDistrict', '=', $authority_dist)->where('iscancelled', '=', 'N')->get();
        return view('authority.farmers.registered_farmer', compact('farmers'));
    }

    public function cancelReg() {
        return view('authority.farmers.cancel_registration');
    }

    public function blacklistedFarmer() {
        $authority = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $user_desig = $authority->userdesig()->where('idDesignation', Session::get('idDesignation'))->first();
        $authority_dist = $user_desig->district->idDistrict;
        $farmers = \App\Farmer::where('idDistrict', '=', $authority_dist)->where('iscancelled', '=', 'Y')->get();
        return view('authority.farmers.blacklisted_farmer', compact('farmers'));
    }

}
