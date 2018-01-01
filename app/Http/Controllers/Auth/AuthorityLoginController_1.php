<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Traits;

class AuthorityLoginController extends Controller {

 use Traits\CaptchaTrait;
 
    protected $redirectTo = '/authority';

    public function __construct() {
        $this->middleware('guest:authority')->except('logout');
    }

    public function showLoginForm() {
        return view('authority.authority-login');
    }

    public function login(Request $request) {
        // Validate the form data
//        $this->validate($request, [
//            'userName' => 'required',
//            'password' => 'required'
//        ]);
        $request['captcha'] = $this->captchaCheck();
        $rules = [
            'userName' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required',
            'captcha'               => 'required|min:1',
        ];
        $messages = [
            'userName.required'=>'Enter Your Username ',
            'password.required'=>'Enter Your Password',
            'g-recaptcha-response.required' => 'Captcha authentication is required.',
            'captcha.min'           => 'Wrong captcha, please try again.'
        ];
        $this->validate($request, $rules, $messages);
        // Attempt to log the user in
        
        if (Auth::guard('authority')->attempt(['userName' => $request->userName, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('authority.dashboard'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        // return redirect()->back()->withInput($request->only('aadhaar', 'remember'));
        return Redirect::back()->withInput($request->only('userName', 'remember'))->withErrors(['UserName Is Not vaild !!']);

        // dd('your username and password are wrong.');
    }

    public function logout(Request $request) {
        Auth::guard('authority')->logout();

        //$request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerate();
      //  return redirect('/farmer/login');
        return redirect()->guest(route( 'authority.login' ));
    }

    protected function guard() {
        return Auth::guard('authority');
    }

}
