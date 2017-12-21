<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchemeActivationRequest extends FormRequest {

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
        $id = $this->route('schemeactivation');
        $rules = [
            'idScheme' => 'required',
            'idFinancialYear' => 'required|unique:schemeactivation,idFinancialYear,NULL,idSchemeActivation,idScheme,' . $this->idScheme,
            'startDate' => 'required',
            'endDate' => 'required',
            'extendDays' => 'required',
            'vendorDeliveryDayLimit' => 'required',
            'totalFundsAllocated' => 'required',
            'totalAreaAllocated' => 'required',
            'guidelines' => 'required'
        ];
        if ($id) {
            $rules = [
                'idScheme' => 'required',
                //  'idFinancialYear' => 'required|unique:schemeactivation,idFinancialYear,NULL,idSchemeActivation,idScheme,' . $this->idScheme,
                'startDate' => 'required',
                'endDate' => 'required',
                'idUnit' => 'required',
                'extendDays' => 'required',
                'vendorDeliveryDayLimit' => 'required',
                'totalFundsAllocated' => 'required',
                'totalAreaAllocated' => 'required',
                    // 'guidelines' => 'required'
            ];
        }
        return $rules;
    }

    public function messages() {
        $message = [
            'idScheme.required' => 'Scheme Name Must Be Selected.',
            'idFinancialYear.required' => 'Finanacial Year Must Be Selected.',
            'idFinancialYear.unique' => 'This Scheme is Already Activated for this Financial Year',
            'startDate.required' => 'Start Date Must Be Chosen',
            'endDate.required' => 'End Date Must Be Chosen',
            'idUnit.required' => 'Unit Must Be Selected',
            'totalFundsAllocated.required' => 'Total Funds Allocated Must Be Filled.',
            'totalAreaAllocated.required' => 'Total Area Allocated Must Be Filled',
            'guidelines.required' => 'Guidelines Must Be Provided.'
        ];
        return $message;
    }

}
