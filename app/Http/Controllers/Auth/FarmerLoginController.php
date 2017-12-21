<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use Illuminate\Support\Facades\Redirect;
class FarmerLoginController extends Controller {

   
    protected $redirectTo = '/farmer';

    public function __construct() {
        $this->middleware('guest:farmer')->except('logout');
    }

    public function showLoginForm() {
        return view('farmer.farmer-login');
    }

    public function login(Request $request) {
        // Validate the form data
        $this->validate($request, [
            'aadhaar' => 'required',
            'password' => 'required'
        ]);
        // Attempt to log the user in
        if (Auth::guard('farmer')->attempt(['aadhaar' => $request->aadhaar, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('farmer.dashboard'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        // return redirect()->back()->withInput($request->only('aadhaar', 'remember'));
        return Redirect::back()->withInput($request->only('aadhaar', 'remember'))->withErrors(['Aadhaar Number Is Not vaild  | आधार संख्या वैध नहीं है']);

        // dd('your username and password are wrong.');
    }

    public function logout(Request $request) {
        Auth::guard('farmer')->logout();

        //$request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerate();
      //  return redirect('/farmer/login');
        return redirect()->guest(route( 'farmer.login' ));
    }

    protected function guard() {
        return Auth::guard('farmer');
    }

}
