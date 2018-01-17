<?php

namespace App\Http\Controllers\Auth;

use App\Farmer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;

class FarmerRegisterController extends Controller {
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
    protected $guard = 'farmer';
    protected $redirectTo = '/farmer';

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
//    protected function validator(array $data) {
//        return Validator::make($data, [
//                    'name' => 'required|string|max:25',
//                    'father_name'=>'required|string|max:25',
//                    'aadhaar' => 'required|max:12|min:12|unique:farmers',
//                    'check' => 'required',
//                    'mobile' => 'required|min:10|max:10',
//                    'idDistrict'=>'required',
//                    'idBlock' =>'required',
//                    'idVillage' =>'required',
//                    'gender' =>'required',
//                   // 'farmer_category'=>'required',
//                    'marital_status' =>'required',
//                    'caste'=>'required',
//                    'rcno' =>'required|max:12|min:12|unique:farmers',
//                    'ifsc_code'=>'required',
//                    'account_no'=>'required|unique:farmers',
//                    'land_location'=>'required',
//                    'land_owner'=>'required',
//                    'total_land'=>'required|numeric'
//        ]);
//    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
//    protected function create(array $data) {
//        return User::create([
//                    'name' => $data['name'],
//                    'aadhaar' => $data['aadhaar'],
//                    'mobile' => $data['mobile'],
//                    'father_name' => $data['father_name'],
//                    'rcno' => $data['rcno'],
//                    'check' => $data['check'],
//                    //'farmer_category' => $data['farmer_category'],
//                    'gender' => $data['gender'],
//                    'marital_status' => $data['marital_status'],
//                    'caste' => $data['caste'],
//                    'ifsc_code'=>$data['ifsc_code'],
//                    'account_no'=>$data['account_no'],
//                    'land_location'=>$data['land_location'],
//                    'land_owner'=>$data['land_owner'],
//                    'total_land'=>$data['total_land'],
//                    'idDistrict'=>$data['idDistrict'],
//                    'idBlock' =>$data['idBlock'],
//                    'idVillage' =>$data['idVillage'],
//        ]);
//    }

    public function showRegistrationForm() {
        $districts = \App\District::pluck('districtName', 'idDistrict')->toArray();
        return view('farmer.registration', compact('districts'));
    }

    public function register(Request $request) {
//        $this->validator($request->all())->validate();
//        dd($farmer=$request->idDistrict);
//        dd($farmer);
        $rules = [
            'name' => 'required|string|max:25',
            'father_name' => 'required|string|max:25',
            'aadhaar' => 'required|max:12|min:12',
            'check' => 'required',
            'mobile' => 'required|min:10|max:10',
            'idDistrict' => 'required',
            'idBlock' => 'required',
            'idVillage' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'caste' => 'required',
            'rcno' => 'required|max:12|min:12',
            'ifsc_code' => 'required',
            'account_no' => 'required|unique:farmers',
            'land_location' => 'required|max:25',
            'total_land' => 'required|numeric|min:0'
        ];
        $message = [
            'name.required' => 'Farmer Name Must Not be Empty',
            'father_name.required' => 'Father/Husband Name Must Be Filled.',
            'aadhaar.required' => 'Aadhaar Number Must Not be Empty.',
            'aadhaar.max' => 'Aadhaar Number is not Valid',
            'aadhaar.unique' => 'Aadhaar Number must Be Unique.',
            'mobile.required' => 'Mobile Number Must Not be Empty.',
            'mobile.unique' => 'Mobile Number Must be unique',
            'mobile.max' => 'Mobile Number is not Valid',
            'idDistrict.required' => 'District Must Be selected First',
            'idBlock.required' => 'Block must be selected First',
            'idVillage.required' => 'Village must be selected',
            'gender.required' => 'Gender must be selected',
            'marital_status.required' => 'Marital Status Must be Selected',
            'caste.required' => 'Caste Category Must be selected',
            'rcno.required' => 'Ration Card Number Must Not be Empty.',
            'rcno.max' => 'Ration Card Number is not Valid',
            'rcno.unique' => 'Ration Card Number must Be Unique.',
            'ifsc_code.required' => 'IFSC Code Must be Selected',
            'account_no.required' => 'Account Number Must be Filled',
            'account_no.unique' => 'Account Number Must be Unique',
            'land_location.required' => 'Land Location Must not be Empty',
            'total_land.required' => 'Total Land Must Not be Empty'
        ];
        if ($request->aadhaar != null) {
            if (Verhoeff::validate($request->aadhaar) === false) {
                $rules += ['aadhaarabc' => 'required'];
                $message += ['aadhaarabc.required' => 'Aadhaar Number Is Not vaild  | आधार संख्या वैध नहीं है'];
                //  $errors = "Aadhaar Number Is Not vaild  | आधार संख्या वैध नहीं है";
                // return Redirect::back()->withInput(Input::all())->withErrors(['Aadhaar Number Is Not vaild  | आधार संख्या वैध नहीं है']);
            }
        }
        $this->Validate($request, $rules, $message);
        $farmer = new \App\Farmer();
        $farmer->fill($request->all());
        $n = substr($request->name, 0, 4);
        $rn = substr($request->rcno, -4);
        $an = substr($request->aadhaar, -4);
        $password = ($n . $an . $rn);
        $farmer->password = bcrypt($password);
        $farmer->save();
        Session::put('idFarmer', $farmer->idFarmer);
//        dd($farmer);
        return redirect('farmer/successreg')->with(['farmer' => $farmer]);
//        event(new Registered($user = $this->create($request->all())));
//
//        $this->guard()->login($user);
//
//        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    public function successReg(Request $request) {
        // dd('here');
        $farmer = \App\Farmer::where('idFarmer', '=', Session::get('idFarmer'))->first();
        return view('farmer.success_reg', compact('farmer'));
    }

    public function printFarmerDetails($id) {
        $farmer = \App\Farmer::where('idFarmer', '=', Session::get('idFarmer'))->first();
//        dd($farmers);
        return view('farmer.print_farmer_detail', compact('farmer'));
    }

    public function getBlocks($id) {
        $blocks = [0 => '--- अपना ब्लाक चुने ---'] + \App\Block::where("idDistrict", $id)
                        ->pluck("blockName", "idBlock")->toArray();
        return json_encode($blocks);
    }

    public function getVillages($id) {
        $villages = [0 => '--- अपना गाँव चुने ---'] + \App\Village::where("idBlock", $id)
                        ->pluck("villageName", "idVillage")->toArray();
        return json_encode($villages);
    }

    public function getBankDetails(Request $request) {
        //dd($request->name_startsWith);
        $banks = \App\BankDetail::where("ifsc", 'like', '%' . $request->name_startsWith . '%')
                //  ->select("ifsc", "bank", 'branch')
                ->limit(20)
                ->get();
        foreach ($banks as $query) {
            $results[] = [$query->ifsc, $query->bank, $query->branch];
        }
        return json_encode($results);
    }

    public function getUserDetails($id) {
        $users = \App\Farmer::where("idFarmer", $id)->pluck('mobile', '')->toArray();
        return view('farmer.success_reg', compact('users'));
    }

    protected function guard() {
        return Auth::guard('farmer');
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
