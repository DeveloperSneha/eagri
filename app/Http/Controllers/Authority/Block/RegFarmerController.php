<?php

namespace App\Http\Controllers\Authority\Block;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class RegFarmerController extends Controller {

    public function registeredFarmer() {
        $farmers = \App\Farmer::where('idBlock', '=', Session::get('idBlock'))
                ->where('iscancelled', '=', 'N')
                ->get();
        return view('authority.blocks.registered_farmer', compact('farmers'));
    }

}
