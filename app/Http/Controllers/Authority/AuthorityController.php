<?php

namespace App\Http\Controllers\Authority;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Auth;

class AuthorityController extends Controller {

    protected $idDistrict;

    public function __construct() {
        $this->middleware(function ($request, $next) {

            View::share('idDistrict', Session::get('idDistrict'));
            //Session::get('idDistrict');

            return $next($request);
        });
        $this->middleware('auth:authority');
    }

    public function index() {
        return view('authority.dashboard');
    }

    public function districts() {
        if (Session::has('idDistrict') && (Session::has('idSubdivision') == false) && (Session::has('idBlock') == false)) {
            return view('authority.districts.dashboard');
        } else {
            return view('errors.404');
        }
    }

    public function subdivisions() {
        if (Session::has('idSubdivision') && (Session::has('idBlock') == false)) {
            return view('authority.subdivisions.dashboard');
        } else {
            return view('errors.404');
        }
    }

    public function blocks() {
        if (Session::has('idDistrict') && Session::has('idSubdivision') && Session::has('idBlock')) {
            return view('authority.blocks.dashboard');
        } else {
            return view('errors.404');
        }
    }

    public function village() {
        $loggedinuser = \App\User::where('idUser', Auth::guard('authority')->User()->idUser)->first();
        $user_in_village = $loggedinuser->userdesig()
                ->where('idDesignation', '=', Session::get('idDesignation'))
                ->where('idDistrict', '=', Session::get('idDistrict'))
                ->where('idSubdivision', '=', Session::get('idSubdivision'))
                ->where('idBlock', '=', Session::get('idBlock'))
                ->whereNotNull('idVillage')
                ->get();
        if (count($user_in_village) > 0) {
            return view('authority.villages.dashboard');
        }else{
            return view('errors.404');
        }
    }

}
