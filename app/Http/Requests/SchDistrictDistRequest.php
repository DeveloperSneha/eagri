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
        
     //   dd($this->idSchemeActivation);
        $rules = [
            'idSchemeActivation' => 'required',
                //   'idDistrict' => 'unique:schemedistributiondistrict,idDistrict,NULL,idDistrict,idSchemeActivation,' . $this->idSchemeActivation,
        ];
        $this->_details = array_where($this->input('districts', []), function ($dis) {
            if (isset($dis['idDistrict'])) {
                return $dis;
            }
        });

        if ((count($this->_details)) == 0) {
            $rules['district'] = 'required';
        }
        $totalFunds = 0;
        $totalArea = 0;
        foreach ($this->districts as $dis) {
            if (isset($dis['idDistrict'])) {
                $rules['districts.' . $dis['idDistrict'] . '.idDistrict'] = 'unique:schemedistributiondistrict,idDistrict,NULL,idDistrict,idSchemeActivation,' . $this->idSchemeActivation;
                $rules['districts.' . $dis['idDistrict'] . '.amountDistrict'] = 'required|numeric';
                $rules['districts.' . $dis['idDistrict'] . '.areaDistrict'] = 'required|numeric';
            }
            $totalFunds += $dis['amountDistrict'];
            $totalArea += $dis['areaDistrict'];
        }
        if ($this->idSchemeActivation != null) {
            $scheme = \App\SchemeActivation::where('idSchemeActivation', '=', $this->idSchemeActivation)->first();
            //dd($totalFunds);
            if ($totalFunds > $scheme->totalFundsAllocated) {
               //  dd('here');
                $rules += ['totalFunds' => 'required'];
            }
            if ($totalArea > $scheme->totalAreaAllocated) {
                $rules += ['totalArea' => 'required'];
            }
        }
        return $rules;
    }

    public function messages() {
        $messages = [];

        $messages += [
           // 'amountDistrict.required' => 'District Amount must be Given',
            'idSchemeActivation.required' => 'Select Any One Of the Scheme',
            'district.required' => 'Atleast One District Should Be Selected',
            'totalFunds.required' => 'Financial Target is Exceeded the limit of This Scheme',
            'totalArea.required'=>'Physical Target is Exceeded the limit of This Scheme'
        ];

        return $messages;
    }

}
