<?php

namespace App\Http\Controllers\Authority;

use App\Http\Controllers\Controller;


class AuthorityController extends Controller {

    public function __construct() {
        $this->middleware('auth:authority');
    }

    public function index() {
        return view('authority.dashboard');
    }

}
