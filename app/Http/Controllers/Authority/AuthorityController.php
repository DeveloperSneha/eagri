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
        return view('authority.districts.dashboard');
    }

    public function subdivisions() {
        return view('authority.subdivisions.dashboard');
    }

    public function blocks() {
        return view('authority.blocks.dashboard');
    }

}
