<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchDistrictDistRequest extends FormRequest {

    protected $_details = [];

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
     //   dd($this->TotalFund);
        $rules = [
            'idSection' => 'required',
            'idScheme' => 'required',
            'idSchemeActivation' => 'required',
        ];
        if($this->TotalFund<0 || $this->TotalArea<0){
            $rules += ['total_val' => 'required'];
        }
        $this->_details = array_where($this->input('districts', []), function ($dis) {
            if (isset($dis['idDistrict'])) {
                return $dis;
            }
        });
        if ((count($this->_details)) == 0) {
            $rules['district'] = 'required';
        } else {
              $totalFunds = 0;
              $totalArea = 0;
            foreach ($this->districts as $dis) {
                if (isset($dis['idDistrict'])) {
                    $rules['districts.' . $dis['idDistrict'] . '.idDistrict'] = 'unique:schemedistributiondistrict,idDistrict,NULL,idDistrict,idSchemeActivation,' . $this->idSchemeActivation;
                    $rules['districts.' . $dis['idDistrict'] . '.amountDistrict'] = 'required|integer|min:0';
                    $rules['districts.' . $dis['idDistrict'] . '.areaDistrict'] = 'required|integer|min:0';
                }
                if (is_numeric($dis['amountDistrict']) && is_numeric($dis['areaDistrict'])) {
                    $totalFunds += $dis['amountDistrict'];
                    $totalArea += $dis['areaDistrict'];
                }
            }
            if ($this->idSchemeActivation != null) {
                $scheme = \App\SchemeActivation::where('idSchemeActivation', '=', $this->idSchemeActivation)->first();
                if ($totalFunds > $scheme->totalFundsAllocated) {
                    $rules += ['totalFunds' => 'required|integer|min:0'];
                }
                if ($totalArea > $scheme->totalAreaAllocated) {
                    $rules += ['totalArea' => 'required|integer|min:0'];
                }
            }
        }
      
        //dd($rules);
        return $rules;
    }

    public function messages() {
        $messages = [];

        $messages += [
            'idScheme.required' => 'Select Scheme First',
            'idSection.required' => 'Select Section First',
            'idSchemeActivation.required' => 'Select Any One Of the Program',
            'district.required' => 'Atleast One District Should Be Selected',
            'totalFunds.required' => 'Financial Target is Exceeded the Limit of This Scheme',
            'totalFunds.integer' => 'Physical Target Must have Numeric Value Only',
            'totalFunds.min' => 'Physical Target Must Not Be Negative',
            'totalArea.required' => 'Physical Target is Exceeded the limit of This Scheme',
            'totalArea.integer' => 'Physical Target Must have Numeric Value Only',
            'totalArea.min' => 'Physical Target Must Not Be Negative',
            'districts.*idDistrict.unique' => 'This Scheme is Already Distributed in This District',
            'districts.*amountDistrict.required' => 'Financial Target Must Not Be Empty',
            'districts.*amountDistrict.integer' => 'Financial Target Must Be Numeric',
            'districts.*areaDistrict.required' => 'Physical Target Must Not Be Empty',
            'districts.*areaDistrict.integer' => 'Physical Target Must Be Numeric',
            'total_val.required'=>'Your Physical Or Financial Target May be Exceeded the Limit.'
        ];

        return $messages;
    }

}
