<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
class ForgotpasswordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
         
        return view('farmer.forgotpassword');
		
    }

	public function match(Request $request)
    {
      //$users = DB::table('farmers')->get();
	  $user = \App\Farmer::where(['aadhaar' => $request->aadhaar, 'rcno' => $request->rcno])->first();
	   //dd($user);
	   if ($user) {
            if ($user->count() > 0) {
				
                return view('farmer.reset', compact('user'));
            }
        } else {
            return Redirect::back()->withInput($request->only('aadhaar'),$request->only('rcno'))->withErrors(['msg' => 'Your Credential Doesnt Match. Plz Check Your aadhaar Number and Ration Card Number  !!']);
        }
     
		
    }
}
