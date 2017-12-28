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
        
      //  dd($this->all());
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
                $rules['districts.' . $dis['idDistrict'] . '.amountDistrict'] = 'required|integer|min:0';
                $rules['districts.' . $dis['idDistrict'] . '.areaDistrict'] = 'required|integer|min:0';
            }
            $totalFunds += $dis['amountDistrict'];
            $totalArea += $dis['areaDistrict'];
        }
        if ($this->idSchemeActivation != null) {
            $scheme = \App\SchemeActivation::where('idSchemeActivation', '=', $this->idSchemeActivation)->first();
            //dd($totalFunds);
            if ($totalFunds > $scheme->totalFundsAllocated) {
               //  dd('here');
                $rules += ['totalFunds' => 'required|integer|min:0'];
            }
            if ($totalArea > $scheme->totalAreaAllocated) {
                $rules += ['totalArea' => 'required|integer|min:0'];
            }
        }
//        foreach ($this->districts as $dis) {
//            if (isset($dis['districtName'])) {
//                $rules +=['districtName'=>'unique'];
//            }
//            }
        return $rules;
    }

    public function messages() {
        $messages = [];

//        foreach ($this->districts as $dis) {
//            if (isset($dis['idDistrict'])) {
//                
//            }
//        }
        $messages += [
            'idSchemeActivation.required' => 'Select Any One Of the Scheme',
            'district.required' => 'Atleast One District Should Be Selected',
            'totalFunds.required' => 'Financial Target is Exceeded the Limit of This Scheme',
            'totalFunds.integer'=>'Physical Target Must have Numeric Value Only',
            'totalFunds.min'=>'Physical Target Must Not Be Negative',
            'totalArea.required'=>'Physical Target is Exceeded the limit of This Scheme',
            'totalArea.integer'=>'Physical Target Must have Numeric Value Only',
            'totalArea.min'=>'Physical Target Must Not Be Negative',
            'districts.*idDistrict.unique' => 'This Scheme is Already Distributed in This District',
            'districts.*amountDistrict.required' => 'Financial Target Must Not Be Empty',
            'districts.*areaDistrict.required' => 'Physical Target Must Not Be Empty',
        ];

        return $messages;
    }

}
