<?php

namespace App\Http\Controllers\Authority\Village;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class RegFarmerController extends Controller {

    public function registeredFarmer() {
        $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
        $user_village = $user->userdesig()
                        ->where('idDesignation', '=', Session::get('idDesignation'))
                        ->where('idDistrict', '=', Session::get('idDistrict'))
                        ->where('idSubdivision', '=', Session::get('idSubdivision'))
                        ->where('idBlock', '=', Session::get('idBlock'))
                        ->whereNotNull('idVillage')
                        ->get()->pluck('idVillage')->toArray();
        $farmers = \App\Farmer::where('idDistrict', '=', Session::get('idDistrict'))
                ->where('idBlock', '=', Session::get('idBlock'))
                ->whereIn('farmers.idVillage', $user_village)
                ->where('iscancelled', '=', 'N')
                ->get();
      //  dd($farmers);
        return view('authority.villages.registered_farmer', compact('farmers'));
    }

    public function cancelFarmerReg($id){
        dd($id);
    }
}
