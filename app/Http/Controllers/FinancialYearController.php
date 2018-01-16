<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinancialYearController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //$fys = \App\FinancialYear::get();
		$fys = \App\FinancialYear::orderBy('idFinancialYear')->get();
        return view('financialyear.index', compact('fys'));
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
        //   dd($request->finanYearStartDate);
        //   dd(Carbon::createFromFormat('d-m-Y H', $request->finanYearStartDate)->format('Y-m-d H'));
        $rules=[
            'financialYearName' => 'required|regex:/^[0-9-]*$/|max:9',
            'finanYearStartDate' => 'required',
            'finanYearEndDate' => 'required'
        ];
//        if(($this->finanYearStartDate)==($this->finanYearEndDate)){
//          $rules+= ['date'=>'required'];
//        }
        
        $message=[
            'financialYearName.required' => 'Financial Year  Must be Filled.',
            'financialYearName.unique' => 'Financial Year Is Already Exist.',
            'financialYearName.regex' => 'Financial Year Is Not Valid.',
            'finanYearStartDate.required' => 'Financial Year Start Date Must Be Chosen.',
            'finanYearStartDate.unique' => 'Financial Year Start Date Already Exist.',
            'finanYearEndDate.required' => 'Financial Year End Date Must Be Chosen.',
            'finanYearEndDate.unique' => 'Financial Year End Date Already Exist.',
            'date.required'=>'Financial Year Start date Must Not Be Same as Financial Year End Date'
        ];
        $this->Validate($request,$rules,$message);
        
        $fy = new \App\FinancialYear();
        $fy->fill($request->all());
        $fy->save();
        return redirect('fys');
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
        $fys = \App\FinancialYear::get();
        $fy = \App\FinancialYear::where('idFinancialYear', '=', $id)->first();
        return view('financialyear.index', compact('fy', 'fys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $fy = \App\FinancialYear::where('idFinancialYear', '=', $id)->first();
        //  dd($fy);
        $rules=[
            'financialYearName' => 'required|regex:/^[0-9-]*$/|max:9|unique:financialyear,financialYearName,'.$id.',idFinancialYear',
            'finanYearStartDate' => 'required',
            'finanYearEndDate' => 'required'
        ];
        $message=[
            'financialYearName.required' => 'Financial Year Name Must be Filled.',
            'finanYearStartDate.required' => 'Financial Year Start Date Must Be Chosen.',
            'finanYearEndDate.required' => 'Financial Year End Date Must Be Chosen.'
        ];
        $this->Validate($request, $rules,$message);
        
        $fy->fill($request->all());
        $fy->update();
        return redirect('fys');
    }
    /**
     * Check There is Any dependency Exist
     *

     */
    public function deletefys($id) {
        //
        $fys = \App\FinancialYear::where('idFinancialYear', '=', $id)->first();
        $schact = \App\SchemeActivation::where('idUnit', '=', $id)->get();
        if ($schact->count() > 0) {
            return redirect()->back()->with('message', 'You Can not Delete this Financial Year Because it is Already in Use!');
        }
        else{
            return view('financialyear.delete', compact('fys'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $fy = \App\FinancialYear::where('idFinancialYear', '=', $id)->first();
        $fy->delete();
        return redirect('fys');
    }

}
