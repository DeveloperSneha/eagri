<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

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
        //difference of date in months
//        dd(Carbon::createFromFormat('d-m-Y', $this->startDate)
//                ->diffInMonths(Carbon::createFromFormat('d-m-Y', $this->endDate)));
        $id = $this->route('nv');
        $rules = [
            'idSection' => 'required',
            'idScheme' => 'required',
            'idWorkflow' => 'required',
            'idProgram' => 'required|unique:schemeactivation,idProgram,NULL,idSchemeActivation,idScheme,' . $this->idScheme,
            'idFinancialYear' => 'required|unique:schemeactivation,idFinancialYear,NULL,idSchemeActivation,idProgram,' . $this->idProgram,
            'startDate' => 'required|date_format:d-m-Y|after:' . yesterday_date(),
            'endDate' => 'required|date_format:d-m-Y|after:startDate',
            'idUnit' => 'required',
            'assistance' => 'required',
            'totalFundsAllocated' => 'required|numeric',
            'totalAreaAllocated' => 'required|numeric',
            'guidelines' => 'required_without:notiFile|mimes:pdf|max:1000',
            'notiFile' => 'required_without:guidelines|mimes:pdf|max:1000',
        ];
        if (($this->assistance) >= ($this->totalFundsAllocated)) {
            $rules += ['assistanceamt' => 'required'];
        }
        if ($this->startDate != null && $this->endDate != null) {
            if (Carbon::createFromFormat('d-m-Y', $this->startDate)
                            ->diffInMonths(Carbon::createFromFormat('d-m-Y', $this->endDate)) <= 6) {
                $rules += ['dateofactivation' => 'required'];
            }
        }

        if ($id) {
            $rules = [
                //'idScheme' => 'required',
                'idFinancialYear' => 'required|unique:schemeactivation,idFinancialYear,' . $id . ',idSchemeActivation,idProgram,' . $this->idProgram,
                'startDate' => 'required|date_format:d-m-Y',
                'endDate' => 'required|date_format:d-m-Y|after:startDate',
                'idUnit' => 'required',
                'assistance' => 'required',
                'totalFundsAllocated' => 'required|numeric',
                'totalAreaAllocated' => 'required|numeric',
                'idWorkflow' => 'required',
                'guidelines' => 'mimes:pdf|max:1000',
                'notiFile' => 'mimes:pdf|max:1000',
            ];
            if ($this->startDate != null && $this->endDate != null) {
                if (Carbon::createFromFormat('d-m-Y', $this->startDate)
                                ->diffInMonths(Carbon::createFromFormat('d-m-Y', $this->endDate)) < 6) {
                    $rules += ['dateofactivation' => 'required'];
                }
            }
        }
       // dd($rules);
        //dd($this->all());
        return $rules;
    }

    public function messages() {
        $message = [
            'idSection.required' => 'Section Must Be Selected.',
            'idScheme.required' => 'Scheme Name Must Be Selected.',
            'idProgram.required' => 'Program Must Be Selected.',
            'idFinancialYear.required' => 'Finanacial Year Must Be Selected.',
            'idFinancialYear.unique' => 'This Scheme is Already Activated for this Financial Year',
            'startDate.required' => 'Start Date Must Be Chosen',
            'endDate.required' => 'End Date Must Be Chosen',
            'idUnit.required' => 'Unit Must Be Selected',
            'assistance.required' => 'Assistance Must Be Filled',
            'assistanceamt.required' => 'Assistance Must Not be Greater Than And Equal To Total Funds Allocated.',
            'totalFundsAllocated.required' => 'Total Funds Allocated Must Be Filled.',
            'totalAreaAllocated.required' => 'Total Area Allocated Must Be Filled',
            'guidelines.required' => 'Guidelines Must Be Provided.',
            'idWorkflow.required' => 'Workflow Must Be Selected',
            'guidelines.required_without' => 'Guidelines Must Be provided when notifications is not present.',
            'guidelines.mimes' => 'Notifications Must Be PDF.',
            'notiFile.mimes' => 'Notifications Must Be PDF.',
            'notiFile.max' => 'Notifications File Must Not be Greater than 1MB',
            'guidelines.max' => 'Guidelines File Must Not be Greater than 1MB',
            'notiFile.required_without' => 'Notifications Must Be provided when guidelines is not present.',
            'dateofactivation.required' => 'Differece Between Start And End Date Should be More Than Six Months.'
        ];
        return $message;
    }

}
