<?php

namespace App\Http\Controllers\Authority\Subdivision;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Verhoeff;
use App\Http\CheckSession;

class ProfileController extends \App\Http\Controllers\Authority\AuthorityController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (CheckSession::chk_subuser() === true) {
            $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
            $userdesig = $user->userdesig()->whereNotNull('idSubdivision')->whereNull('idBlock')->whereNull('idVillage')->get();
            return view('authority.subdivisions.profile', compact('user', 'userdesig'));
        } else {
            return view('errors.404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $rules = [
            'name' => 'required',
            'fatherName' => 'required',
            'motherName' => 'required',
            'dob' => 'required|date|before:' . today_date(),
            'aadhaar' => 'required|unique:users',
            'mobile' => 'required|min:10|max:10',
            'ofc_address' => 'required',
            'address' => 'required'
        ];
        if ($request->aadhaar != null) {
            if (Verhoeff::validate($request->aadhaar) === false) {
                $rules += ['aadhaarabc' => 'required'];
                // return Redirect::back()->withInput(Input::all())->withErrors(['Aadhaar Number Is Not vaild  | आधार संख्या वैध नहीं है']);
            }
        }
        $message = [
            'aadhaarabc.required' => 'Aadhaar Number Is Not vaild  | आधार संख्या वैध नहीं है',
            'dob.required' => 'Date Of Birth must be filled',
            'dob.before' => 'Date Of Birth is Invalid'
        ];
        $this->Validate($request, $rules, $message);
        //dd($request->all());
        $profile = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $profile->fill($request->all());
        $profile->isComplete = 'Y';
        $profile->update();
        return redirect('authority/subdivisions/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
    
    public function editPassword() {
        return view('authority.subdivisions.updt_password');
    }

    public function updatePassword(Request $request) {
        $rules = [];
        $user = $request->user();
        if (!auth()->attempt(['username' => $user->userName, 'password' => $request->old_password])) {
            flash()->error('Wrong old password. Authentication failed');
            return redirect()->back();
        }
        $this->validate($request, $rules + [
            'password' => 'required|min:6|confirmed',
        ]);
        $user->password = bcrypt($request['password']);
        $user->update();
        flash()->success('Password updated successfully.');
        return redirect()->back();
    }

}
