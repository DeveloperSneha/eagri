<?php

namespace App\Http\Controllers\Authority;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class AuthorityProfileController extends AuthorityController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = \App\User::where('idUser', '=', Auth::guard('authority')->User()->idUser)->first();
        $userdesig = $user->userdesig()->whereNotNull('idBlock')->whereNull('idVillage')->get();
       
        return view('authority.profile', compact('user', 'userdesig'));
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
            'dob' => 'required',
            'aadhaar' => 'required',
            'mobile' => 'required|min:10|max:10',
            'ofc_address' => 'required',
            'address' => 'required'
        ];
        $this->validate($request, $rules);
        if (Verhoeff::validate($request->aadhaar) === false) {
            return Redirect::back()->withInput(Input::all())->withErrors(['Aadhaar Number Is Not vaild  | आधार संख्या वैध नहीं है']);
        }
        //dd($request->all());
        $profile = \App\User::where('idUser', '=', Auth::User()->idUser)->first();
        $profile->fill($request->all());
        $profile->isComplete = 'Y';
        $profile->update();
        return redirect('authority/profile');
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

}

class Verhoeff {

    static public $d = array(
        array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9),
        array(1, 2, 3, 4, 0, 6, 7, 8, 9, 5),
        array(2, 3, 4, 0, 1, 7, 8, 9, 5, 6),
        array(3, 4, 0, 1, 2, 8, 9, 5, 6, 7),
        array(4, 0, 1, 2, 3, 9, 5, 6, 7, 8),
        array(5, 9, 8, 7, 6, 0, 4, 3, 2, 1),
        array(6, 5, 9, 8, 7, 1, 0, 4, 3, 2),
        array(7, 6, 5, 9, 8, 2, 1, 0, 4, 3),
        array(8, 7, 6, 5, 9, 3, 2, 1, 0, 4),
        array(9, 8, 7, 6, 5, 4, 3, 2, 1, 0)
    );
    static public $p = array(
        array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9),
        array(1, 5, 7, 6, 2, 8, 3, 0, 9, 4),
        array(5, 8, 0, 3, 7, 9, 6, 1, 4, 2),
        array(8, 9, 1, 6, 0, 4, 3, 5, 2, 7),
        array(9, 4, 5, 3, 1, 2, 6, 8, 7, 0),
        array(4, 2, 8, 6, 5, 7, 3, 9, 0, 1),
        array(2, 7, 9, 3, 8, 0, 6, 4, 1, 5),
        array(7, 0, 4, 6, 9, 1, 3, 2, 5, 8)
    );
    static public $inv = array(0, 4, 3, 2, 1, 5, 6, 7, 8, 9);

    static function calc($num) {
        if (!preg_match('/^[0-9]+$/', $num)) {
            throw new \InvalidArgumentException(sprintf("Error! Value is restricted to the number, %s is not a number.", $num));
        }

        $r = 0;
        foreach (array_reverse(str_split($num)) as $n => $N) {
            $r = self::$d[$r][self::$p[($n + 1) % 8][$N]];
        }
        return self::$inv[$r];
    }

    static function check($num) {
        if (!preg_match('/^[0-9]+$/', $num)) {
            throw new \InvalidArgumentException(sprintf("Error! Value is restricted to the number, %s is not a number.", $num));
        }

        $r = 0;
        foreach (array_reverse(str_split($num)) as $n => $N) {
            $r = self::$d[$r][self::$p[$n % 8][$N]];
        }
        return $r;
    }

    static function generate($num) {
        return sprintf("%s%s", $num, self::calc($num));
    }

    static function validate($num) {
        return self::check($num) === 0;
    }

}
