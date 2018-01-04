<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Traits;
class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

    use Traits\CaptchaTrait;
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request) {
        $request['captcha'] = $this->captchaCheck();
        $this->validate($request, [
            $this->username() => 'required|string',
          //  'g-recaptcha-response' => 'required',
           // 'captcha'               => 'required|min:1',
            'password' => 'required|string',
                ], [
            'g-recaptcha-response.required' => 'Captcha authentication is required.',
             'captcha.min'           => 'Wrong captcha, please try again.'
        ]);
    }

    public function username() {
        return 'aadhaar';
    }

    protected function attemptLogin(Request $request) {
        return $this->guard()->attempt(
                        $this->credentials($request), $request->filled('remember')
        );
    }

    protected function credentials(Request $request) {
        return $request->only($this->username(), 'password');
    }

    protected function sendLoginResponse(Request $request) {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user()) ?: redirect()->intended($this->redirectPath());
    }

    protected function guard() {
        return Auth::guard();
    }

}
