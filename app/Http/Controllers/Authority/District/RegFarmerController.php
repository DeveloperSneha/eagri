<?php

namespace App\Http\Controllers\Authority\District;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class RegFarmerController extends Controller
{
    public function registeredFarmer() {
        $farmers = \App\Farmer::where('idDistrict', '=', Session::get('idDistrict'))
                ->where('iscancelled', '=', 'N')
                ->get();
        return view('authority.districts.registered_farmer', compact('farmers'));
    }
}
