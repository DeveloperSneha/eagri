<?php

namespace App\Http\Controllers\Authority;

use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Auth;
class AuthorityController extends Controller {

    protected $idDesignation ;

   
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $user = \App\User::where('idUser', Auth::user()->idUser)->first();
            $user_desig = $user->userdesig()->where('idDesignation',Session::get('idDesignation'))->first();
          //  dd($user_desig);
            View::share('userdesig', $user_desig);
            //Session::get('idDesignation');

           return $next($request);
     });
  
       
//        View::share('idDesignation', $idDesignation);

        $this->middleware('auth:authority');
    }

    public function index() {
       return view('authority.dashboard');
    }

}
