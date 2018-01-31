<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchSubdivisionRequest extends FormRequest {

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
        $rules = [
            'idSection' => 'required',
            'idScheme' => 'required',
            'idSchemeActivation' => 'required',
        ];
        if($this->TotalFund<0 || $this->TotalArea<0){
            $rules += ['total_val' => 'required'];
        }
        $this->_details = array_where($this->input('subdivisions', []), function ($dis) {
            if (isset($dis['idSubdivision'])) {
                return $dis;
            }
        });

        if (((count($this->_details)) == 0)) {
            $rules['subdivision'] = 'required';
        } else {
            $totalFunds = 0;
            $totalArea = 0;
            foreach ($this->subdivisions as $dis) {
                if (isset($dis['idSubdivision'])) {
                    $rules['subdivisions.' . $dis['idSubdivision'] . '.idSubdivision'] = 'unique:schemedistributionsubdivision,idSubdivision,NULL,idSubdivision,idSchemeActivation,' . $this->idSchemeActivation;
                    $rules['subdivisions.' . $dis['idSubdivision'] . '.amountSubdivision'] = 'required|integer|min:0';
                    $rules['subdivisions.' . $dis['idSubdivision'] . '.areaSubdivision'] = 'required|integer|min:0';
                }
                if (is_numeric($dis['amountSubdivision']) && is_numeric($dis['areaSubdivision'])) {
                    $totalFunds += $dis['amountSubdivision'];
                    $totalArea += $dis['areaSubdivision'];
                }
            }
            if ($this->idSchemeActivation != null) {
                $scheme = \App\SchDistrictDistribution::where('idSchemeActivation', '=', $this->idSchemeActivation)->first();
                //dd($totalFunds);
                if ($totalFunds > $scheme->amountDistrict) {
                    $rules += ['totalFunds' => 'required|integer|min:0'];
                }
                if ($totalArea > $scheme->areaDistrict) {
                    $rules += ['totalArea' => 'required|integer|min:0'];
                }
            }
        }


        return $rules;
    }

    public function messages() {
        $messages = [];

        $messages += [
            'idScheme.required' => 'Select Scheme First',
            'idSection.required' => 'Select Section First',
            'idSchemeActivation.required' => 'Select Any One Of the Program',
            //   'schemeDistributionDistrict.required' => 'Scheme Distribution(District) Must be Selected',
            'subdivision.required' => 'Atleast One Subdivision Should Be Selected',
            'totalFunds.required' => 'Financial Target is Exceeded for this District',
            'totalFunds.min' => 'Financial Target is Exceeded for this District',
            'totalArea.required' => 'Physical Target is Exceeded for this District',
            'totalArea.min' => 'Physical Target is Exceeded for this District',
            'subdivisions.*idSubdivision.unique' => 'This Scheme is Already Distributed To This Block',
            'subdivisions.*amountSubdivision.required' => 'Financial Target Must Not Be Empty',
            'subdivisions.*areaSubdivision.required' => 'Physical Target Must Not Be Empty',
            'subdivisions.*amountSubdivision.integer' => 'Financial Target Must Have Numeric Value ',
            'subdivisions.*areaSubdivision.integer' => 'Physical Target Must Have Numeric Value',
            'subdivisions.*amountSubdivision.min' => 'Financial Target Must Have Positive Value',
            'subdivisions.*areaSubdivision.min' => 'Physical Target Must Have Positive Value',
            'total_val.required'=>'Your Physical Or Financial Target May be Exceeded the Limit.'
        ];

        return $messages;
    }

}
