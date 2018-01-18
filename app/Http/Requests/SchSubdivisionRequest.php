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
            'idSchemeActivation' => 'required',
        ];
        $this->_details = array_where($this->input('subdivisions', []), function ($dis) {
            if (isset($dis['idSubdivision'])) {
                return $dis;
            }
        });

        if (((count($this->_details)) == 0)) {
            $rules['subdivision'] = 'required';
        }

        $totalFunds = 0;
        $totalArea = 0;
        foreach ($this->subdivisions as $dis) {
            $totalFunds += $dis['amountSubdivision'];
            $totalArea += $dis['areaSubdivision'];
            if (isset($dis['idSubdivision'])) {
                $rules['subdivisions.' . $dis['idSubdivision'] . '.idSubdivision'] = 'unique:schemedistributionsubdivision,idSubdivision,NULL,idSubdivision,idSchemeActivation,' . $this->idSchemeActivation;
                $rules['subdivisions.' . $dis['idSubdivision'] . '.amountSubdivision'] = 'required|numeric|min:0';
                $rules['subdivisions.' . $dis['idSubdivision'] . '.areaSubdivision'] = 'required|numeric|min:0';
            }
        }

        if ($this->idSchemeActivation != null) {
            $scheme = \App\SchDistrictDistribution::where('idSchemeActivation', '=', $this->idSchemeActivation)->first();
            //dd($totalFunds);
            if ($totalFunds > $scheme->amountDistrict) {
                //  dd('here');
                $rules += ['totalFunds' => 'required'];
            }
            if ($totalArea > $scheme->areaDistrict) {
                $rules += ['totalArea' => 'required'];
            }
        }
        return $rules;
    }

    public function messages() {
        $messages = [];

        $messages += [
            'idSchemeActivation.required' => 'Select Any One Of the Scheme',
            //   'schemeDistributionDistrict.required' => 'Scheme Distribution(District) Must be Selected',
            'subdivision.required' => 'Atleast One Subdivision Should Be Selected',
            'totalFunds.required' => 'Financial Target is Exceeded for this District',
            'totalArea.required' => 'Physical Target is Exceeded for this District',
            'subdivisions.*idSubdivision.unique' => 'This Scheme is Already Distributed To This Block',
            'subdivisions.*amountSubdivision.required' => 'Financial Target Must Not Be Empty',
            'subdivisions.*areaSubdivision.required' => 'Physical Target Must Not Be Empty',
            'subdivisions.*amountSubdivision.numeric' => 'Financial Target Must Have Numeric Value ',
            'subdivisions.*areaSubdivision.numeric' => 'Physical Target Must Have Numeric Value',
            'subdivisions.*amountSubdivision.min' => 'Financial Target Must Have Positive Value',
            'subdivisions.*areaSubdivision.min' => 'Physical Target Must Have Positive Value',
        ];

        return $messages;
    }

}
