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
use App\Http\Verhoeff;
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
        $districts = [''=>'--- Select / जिला चुने ---'] +\App\District::pluck('districtName', 'idDistrict')->toArray();
        return view('farmer.registration', compact('districts'));
    }

    public function register(Request $request) {
//        $this->validator($request->all())->validate();
//        dd($farmer=$request->idDistrict);
//        dd($farmer);
        $rules = [
            'name' => 'required|string|max:25',
            'father_name' => 'required|string|max:25',
            'aadhaar' => 'required|max:12|min:12|unique:farmers',
            'check' => 'required|accepted',
            'mobile' => 'required|min:10|max:10|unique:farmers|regex:/^[6789]\d{9}$/',
            'idDistrict' => 'required',
            'idBlock' => 'required|integer|min:1',
            'idSubdivision'=>'required|integer|min:1',
            'idVillage' => 'required|integer|min:1',
            'gender' => 'required',
            'marital_status' => 'required',
            'caste' => 'required',
            'rcno' => 'required|alpha_dash|max:20|min:4|unique:farmers',
            'ifsc_code' => 'required|alpha_num|regex:/^[A-Za-z]{4}\d{7}$/',
            'bank_name' =>'required|string|max:60|min:3',
            'bank_branch' =>'required|max:60|min:3|regex:/^[a-z\d\-_\s]+$/i',
            'account_no' => 'required|unique:farmers',
            'land_location' => 'required|max:30',
            'total_land' => 'required|numeric|min:0'
        ];
        $message = [
            'name.required' => 'Farmer Name Must Not be Empty',
            'father_name.required' => 'Father/Husband Name Must Be Filled.',
            'aadhaar.required' => 'Aadhaar Number Must Not be Empty.',
            'aadhaar.unique' => 'Aadhaar Number  is Already Taken.',
            'mobile.required' => 'Mobile Number Must Not be Empty.',
            'mobile.unique' => 'Mobile Number  is Already Taken',
            'mobile.regex' => 'Mobile Number is Not Valid',
            'mobile.min' => 'Mobile Number Must Have Atleast 10 digits',
            'idDistrict.required' => 'District Must Be selected First',
            'idSubdivision.required' => 'Subdivision must be selected',
            'idSubdivision.integer' => 'Subdivision must be selected',
            'idSubdivision.min' => 'Subdivision must be selected',
            'idBlock.required' => 'Block must be selected',
            'idBlock.integer' => 'Block must be selected',
            'idBlock.min' => 'Block must be selected',
            'idVillage.required' => 'Village must be selected',
            'idVillage.integer' => 'Village must be selected',
            'idVillage.min' => 'Village must be selected',
            'gender.required' => 'Gender must be selected',
            'marital_status.required' => 'Marital Status Must be Selected',
            'caste.required' => 'Caste Category Must be selected',
            'rcno.required' => 'Ration Card Number Must Not be Empty.',
            'rcno.max' => 'Ration Card Number is Not Valid',
            'rcno.alpha_dash'=>'The Ration Card Number is Not Valid',
            'rcno.min' => 'Ration Card Number is Not Valid',
            'rcno.unique' => 'Ration Card Number is Already Taken',
            'bank_name.required' => 'Bank Name Must Not be Empty.',
            'bank_name.max' => 'Bank Name is Not Valid',
            'bank_name.min' => 'Bank Name is Not Valid',
            'bank_branch.required' => 'Bank Branch Name Must Not be Empty.',
            'bank_branch.max' => 'Bank Branch Name is Not Valid',
            'bank_branch.regex' => 'Bank Branch Name is Not Valid',
            'bank_branch.min' => 'Bank Name is Not Valid',
            'ifsc_code.required' => 'IFSC Code Must be Selected',
            'ifsc_code.alpha_num' => 'IFSC Code is Not Valid',
            'ifsc_code.regex' => 'IFSC Code is Not Valid',
            'account_no.required' => 'Account Number Must be Filled',
            'account_no.unique' => 'Account Number  is Already Taken',
            'land_location.required' => 'Land Location Must not be Empty',
            'total_land.required' => 'Total Land Must Not be Empty',
            'check.required'=>'Please Select the Disclaimer '
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
        $an = substr($request->aadhaar, -4);
        $rn = substr($request->rcno, -4);
        $password = ($n . $an . $rn);
        $farmer->password = bcrypt($password);
        if($request->total_land <=2){
            $farmer->farmer_category = 'Small Farmer';
        }elseif($request->total_land >2 && $request->total_land <= 5){
            $farmer->farmer_category = 'Medium Farmer';
        }elseif($request->total_land >5){
            $farmer->farmer_category = 'Large Farmer';
        }
        $farmer->save();
        Session::put('idFarmer', $farmer->idFarmer);
        if ($request->ajax()) {
            return response()->json(['success' => "SUCCESS"], 200, ['app-status' => 'success']);
        }
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

    public function getSubdivisions($id) {
        $subdivisions = [0 => '--- Select /उपखंड  चुने ---'] + \App\Subdivision::where("idDistrict", $id)
                        ->pluck("subDivisionName", "idSubdivision")->toArray();
        return json_encode($subdivisions);
    }
    public function getBlocks($id) {
        $blocks = [0 => '--- Select / ब्लाक चुने ---'] + \App\Block::where("idSubdivision", $id)
                        ->pluck("blockName", "idBlock")->toArray();
        return json_encode($blocks);
    }

    public function getVillages($id) {
        $villages = [0 => '--- Select / गाँव चुने ---'] + \App\Village::where("idBlock", $id)
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


