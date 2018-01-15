<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NonVendorSchemeActivationRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
       
        $id = $this->route('nv');
        $rules = [
            'idScheme' => 'required',
            'idProgram'=>'required',
            'idWorkflow'=>'required',
            'idProgram' => 'required|unique:schemeactivation,idProgram,NULL,idSchemeActivation,idScheme,' . $this->idScheme,
            'idFinancialYear' => 'required|unique:schemeactivation,idFinancialYear,NULL,idSchemeActivation,idScheme,' . $this->idScheme,
            'startDate' => 'required|date|after:' . yesterday_date(),
            'endDate' => 'required|date|after:startDate',
            'idUnit' => 'required',
            'assistance' =>'required',
            'totalFundsAllocated' => 'required|numeric',
            'totalAreaAllocated' => 'required|numeric',
            'guidelines' => 'required_without:notiFile|mimes:pdf',
            'notiFile' => 'required_without:guidelines|mimes:pdf',
        ];
        if(($this->assistance)>($this->totalFundsAllocated)){
            $rules += ['assistanceamt'=>'required'];
        }
//        if(count($this->schemecerts) == 0){
//            $rules += ['documents'=>'required'];
//        }
        if ($id) {
            $rules = [
                //'idScheme' => 'required',
                //  'idFinancialYear' => 'required|unique:schemeactivation,idFinancialYear,NULL,idSchemeActivation,idScheme,' . $this->idScheme,
                'startDate' => 'required|date',
                'endDate' => 'required|date|after:startDate',
                'idUnit' => 'required',
                'assistance' =>'required',
                'totalFundsAllocated' => 'required|numeric',
                'totalAreaAllocated' => 'required|numeric',
                'idWorkflow'=>'required',
               
            ];
        }
        return $rules;
    }

    public function messages() {
        $message = [
            'idScheme.required' => 'Scheme Name Must Be Selected.',
            'idProgram.required' => 'Program Must Be Selected.',
            'idFinancialYear.required' => 'Finanacial Year Must Be Selected.',
            'idFinancialYear.unique' => 'This Scheme is Already Activated for this Financial Year',
            'startDate.required' => 'Start Date Must Be Chosen',
            'endDate.required' => 'End Date Must Be Chosen',
            'idUnit.required' => 'Unit Must Be Selected',
            'assistanceamt.required' => 'Assistance Must Not be Greater Than Total Funds Allocated.',
            'totalFundsAllocated.required' => 'Total Funds Allocated Must Be Filled.',
            'totalAreaAllocated.required' => 'Total Area Allocated Must Be Filled',
            'guidelines.required' => 'Guidelines Must Be Provided.',
            'idWorkflow.required'=>'Workflow Must Be Selected',
            'guidelines.required_without' => 'Guidelines Must Be provided when notifications is not present.',
            'notiFile.required_without' => 'Notifications Must Be provided when guidelines is not present.',
        ];
        return $message;
    }

}
