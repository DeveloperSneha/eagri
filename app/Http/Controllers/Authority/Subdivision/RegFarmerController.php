<?php

namespace App\Http\Controllers\Authority\Subdivision;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class RegFarmerController extends Controller
{
    public function registeredFarmer() {
        $farmers = \App\Farmer::where('idSubdivision', '=', Session::get('idSubdivision'))
                ->where('iscancelled', '=', 'N')
                ->get();
        return view('authority.Subdivisions.registered_farmer', compact('farmers'));
    }
}
