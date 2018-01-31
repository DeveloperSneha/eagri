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
            'financialYearName' => 'required|regex:/^[0-9-]*$/|max:9|unique:financialyear,financialYearName', 
            'finanYearStartDate' => 'required|date|after_or_equal:today|unique:financialyear,finanYearStartDate',
            'finanYearEndDate' => 'required|date|after:finanYearStartDate|unique:financialyear,finanYearEndDate'
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
            'finanYearStartDate.after_or_equal'=>'Financial Year Start date Must be a Date From Todays Date',
            'finanYearEndDate.required' => 'Financial Year End Date Must Be Chosen.',
            'finanYearEndDate.unique' => 'Financial Year End Date Already Exist.',
            'finanYearEndDate.after'=>'The End Date Must be a Date After Start Date.'
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
//        $fys = \App\FinancialYear::get();
//        $fy = \App\FinancialYear::where('idFinancialYear', '=', $id)->first();
//        return view('financialyear.index', compact('fy', 'fys'));
    }
    
    public function editfys($id) {
        $fys = \App\FinancialYear::get();
        $fy = \App\FinancialYear::where('idFinancialYear', '=', $id)->first();
        $schact = \App\SchemeActivation::where('idUnit', '=', $id)->get();
        if ($schact->count() > 0) {
            return redirect()->back()->with('message', 'You Can not Edit this Financial Year Because it is Already in Use!');
        }
        else{
            return view('financialyear.index', compact('fys','fy'));
        }
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
            'finanYearStartDate' => 'required|date|after_or_equal:today',
            'finanYearEndDate' => 'required|date|after:finanYearStartDate'
        ];
        $message=[
            'financialYearName.required' => 'Financial Year  Must be Filled.',
            'financialYearName.regex' => 'Financial Year Is Not Valid.',
            'finanYearStartDate.required' => 'Financial Year Start Date Must Be Chosen.',
            'finanYearStartDate.after_or_equal'=>'Financial Year Start date Must Not Be Less Than Todays Date',
            'finanYearEndDate.required' => 'Financial Year End Date Must Be Chosen.',
            'finanYearEndDate.after'=>'Financial Year End date Must Be Greater Than Financial Year Start Date'
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
