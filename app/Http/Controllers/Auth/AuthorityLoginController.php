<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Traits;
use Session;

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
//        dd($request->all());
        $request['captcha'] = $this->captchaCheck();
        $rules = [
            'userName' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required',
            'captcha' => 'required|min:1',
            'idDesignation' => 'required'
        ];
        $messages = [
            'userName.required' => 'Enter Your Username ',
            'password.required' => 'Enter Your Password',
            'g-recaptcha-response.required' => 'Captcha authentication is required.',
            'captcha.min' => 'Wrong captcha, please try again.',
            'idDesignation.required' => 'Please Select Your Designation you want to login.'
        ];
        $this->validate($request, $rules, $messages);
        // Attempt to log the user in
        if (Auth::guard('authority')->attempt([
                    'userName' => $request->userName,
                    'password' => $request->password], $request->remember)) {
            $user = \App\User::where('userName', $request->userName)->first();
            $user_desig = $user->userdesig()->where('idDesignation', '=', $request->idDesignation)->first();
            $idDesignation = $user_desig->idDesignation;
            Session::put('idDesignation', $idDesignation);
            //dd(Session::get('idDesignation'));
         //   dd($user_desig->idDesignation);
            if ($user_desig) {
               //  dd(Session::get('idDesignation'));
                return view('authority.dashboard')->with($request->session()->get('idDesignation'));
            //  return redirect()->intended(route('authority.dashboard'));
            } else {
                return Redirect::back()->withInput($request->only('userName', 'idDesignation'))->withErrors(['UserName Is Not vaild !!']);
            }
        }





//        if (Auth::guard('authority')->attempt(['userName' => $request->userName, 'password' => $request->password], $request->remember)) {
//            // if successful, then redirect to their intended location
//            return redirect()->intended(route('authority.dashboard'));
//        }
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
        return redirect()->guest(route('authority.login'));
    }

    protected function guard() {
        return Auth::guard('authority');
    }

    public function getDesignation($userName) {
        $user = \App\User::where('userName', $userName)->first();
        $user_desig = DB::table('user_designation_district_mapping')
                        ->join('designation', 'user_designation_district_mapping.idDesignation', '=', 'designation.idDesignation')
                        ->where("idUser", $user->idUser)->get()
                        ->pluck("designationName", "idDesignation")->toArray();
        return json_encode($user_desig);
    }

}
