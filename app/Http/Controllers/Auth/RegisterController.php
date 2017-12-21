<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|string|max:255',
                    'aadhaar' => 'required|min:12|min:12|unique:users',
                    'mobile' => 'required|min:10|max:10',
                        //    'email' => 'required|string|email|max:255|unique:users',
                        //     'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        return User::create([
                    'name' => $data['name'],
                    'aadhaar' => $data['aadhaar'],
                    'mobile' => $data['mobile'],
                     // 'email' => $data['email'],
                    'password' => bcrypt($data['mobile']),
        ]);
    }

    public function showRegistrationForm() {
        return redirect('login');
    }

    public function register(Request $request) {
      //  $error = [];
        //   dd($request->all());
//        $request->validate([
//            'aadhaar' => [ 'required',new \App\Rules\ValidateAdhaar() ]
//        ]);
        $this->validator($request->all())->validate();
        if (Verhoeff::validate($request->aadhaar) === false) {
          //  $errors = "Aadhaar Number Is Not vaild  | आधार संख्या वैध नहीं है";
            return Redirect::back()->withInput(Input::all())->withErrors(['Aadhaar Number Is Not vaild  | आधार संख्या वैध नहीं है']);
        }


        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

}