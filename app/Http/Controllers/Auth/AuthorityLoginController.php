<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Support\Facades\Redirect;
use App\Traits;
use Session;

class AuthorityLoginController extends Controller {

    use Traits\CaptchaTrait;

    // protected $redirectTo = '/authority';

    public function __construct() {
        $this->middleware('guest:authority')->except('logout');
    }

    public function showLoginForm() {

        return view('authority.authority-login');
    }

    public function login(Request $request) {
        $request['captcha'] = $this->captchaCheck();
        $rules = [
            'userName' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required',
            'captcha' => 'required|min:1',
        ];
        $messages = [
            'userName.required' => 'Enter Your Username ',
            'password.required' => 'Enter Your Password',
            'g-recaptcha-response.required' => 'Captcha authentication is required.',
            'captcha.min' => 'Wrong captcha, please try again.',
        ];
        $this->validate($request, $rules, $messages);

        if (!auth()->attempt(['username' => $request->userName, 'password' => $request->password])) {
            return Redirect::back()->withInput($request->only('userName'))->withErrors(['msg' => 'Your Credential Doesnot Match.Please Try Again !!']);
        }else{
            $user = \App\User::where('userName', $request->userName)->first();
            Session::put('pass', $request->password);
            if ($user->userdesig()->count() > 0) {
                return view('authority.secondstep_login', compact('user'));
            }
        }
     //   dd($user);
//        if ($user) {
//            if ($user->userdesig()->count() > 0) {
//                return view('authority.secondstep_login', compact('user'));
//            }
//        } else {
//            return Redirect::back()->withInput($request->only('userName'))->withErrors(['msg' => 'Your Credential Doesnot Match.Please Try Again !!']);
//        }
    }

//    public function secondStepLoginForm() {
//        if (session()->has('data')) {
//            $user = Session::get('data');
//            return view('authority.secondstep_login', compact('user'));
//        }else{
//            return redirect('authority/login');
//        }
//    }

    public function secondStepLogin(Request $request) {
        $user = \App\User::where('userName', $request->userName)->first();
        $rules = [
          //  'password' => 'required',
            'idDesignation' => 'required',
            'idDistrict' => 'required'
        ];
        if ($request->has('idDistrict')) {
            $user_subdivision = $user->userdesig()
                    ->where('idDesignation', '=', $request->idDesignation)
                    ->where('idDistrict', '=', $request->idDistrict)
                    ->whereNotNull('idSubdivision')
                    ->get();
            if ($user_subdivision->count() > 0) {
                $rules['idSubdivision'] = 'required';
            }
        }
        if ($request->has('idSubdivision')) {
            $user_block = $user->userdesig()
                    ->where('idDesignation', '=', $request->idDesignation)
                    ->where('idDistrict', '=', $request->idDistrict)
                    ->where('idSubdivision', '=', $request->idSubdivision)
                    ->whereNotNull('idBlock')
                    ->get();
            if ($user_block->count() > 0) {
                $rules['idBlock'] = 'required';
            }
        }
        $messages = [
            'idDesignation.required' => 'Select Your Designation First',
            'idDistrict.required' => 'District Must Be Selected',
            'idSubdivision.required' => 'Subdivision Must Be Selected',
            'idBlock.required' => 'Block Must Be Selected'
        ];
        $this->validate($request, $rules, $messages);
        if (Auth::guard('authority')->attempt([
                    'userName' => $request->userName,
                    'password' => Session::get('pass')], $request->remember)) {
            //dd(Auth::guard('authority')->User());
            Session::put('idDesignation', $request->idDesignation);
            Session::put('idDistrict', $request->idDistrict);
            Session::put('idSubdivision', $request->idSubdivision);
            Session::put('idBlock', $request->idBlock);
            return $this->redirectToDashboard($request);
        } else {
            return redirect('authority/login');
        }
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

    public function redirectToDashboard(Request $request) {
        // dd(Session::get('idSubdivision'));
        $loggedinuser = \App\User::where('idUser', Auth::guard('authority')->User()->idUser)->first();
        $user_in_district = $loggedinuser->userdesig()
                ->where('idDesignation', '=', $request->idDesignation)
                ->where('idDistrict', '=', $request->idDistrict)
                ->whereNull('idSubdivision')
                ->whereNull('idBlock')
                ->whereNull('idVillage')
                ->first();
        if ($request->has('idSubdivision')) {
            $user_in_subdivision = $loggedinuser->userdesig()
                    ->where('idDesignation', '=', $request->idDesignation)
                    ->where('idDistrict', '=', $request->idDistrict)
                    ->where('idSubdivision', '=', $request->idSubdivision)
                    ->whereNull('idBlock')
                    ->whereNull('idVillage')
                    ->first();
        }
        if ($request->has('idBlock')) {
            $user_in_block = $loggedinuser->userdesig()
                    ->where('idDesignation', '=', $request->idDesignation)
                    ->where('idDistrict', '=', $request->idDistrict)
                    ->where('idSubdivision', '=', $request->idSubdivision)
                    ->where('idBlock', '=', $request->idBlock)
                    ->whereNull('idVillage')
                    ->get();
            $user_in_village = $loggedinuser->userdesig()
                    ->where('idDesignation', '=', $request->idDesignation)
                    ->where('idDistrict', '=', $request->idDistrict)
                    ->where('idSubdivision', '=', $request->idSubdivision)
                    ->where('idBlock', '=', $request->idBlock)
                    ->whereNotNull('idVillage')
                    ->get();
        }
        if (count($user_in_district) > 0) {
            return response()->json(['success' => "SUCCESS", 'userdistrict' => "DistrictUser"], 200, ['app-status' => 'success']);
        } else if (count($user_in_subdivision) > 0) {
            return response()->json(['success' => "SUCCESS", 'usersubdivision' => "SubdivisionUser"], 200, ['app-status' => 'success']);
        } else if (count($user_in_block) > 0) {
            return response()->json(['success' => "SUCCESS", 'userblock' => "BlockUser"], 200, ['app-status' => 'success']);
        } else if (count($user_in_village) > 0) {
            return response()->json(['success' => "SUCCESS", 'uservillage' => "VillageUser"], 200, ['app-status' => 'success']);
        }
    }

//    public function getDesignation($userName) {
//        $user = \App\User::where('userName', $userName)->first();
//        $user_desig = DB::table('user_designation_district_mapping')
//                        ->join('designation', 'user_designation_district_mapping.idDesignation', '=', 'designation.idDesignation')
//                        ->where("idUser", $user->idUser)->get()
//                        ->pluck("designationName", "idDesignation")->toArray();
//        return json_encode($user_desig);
//    }
}
