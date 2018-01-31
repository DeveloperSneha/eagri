<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchBlockDistRequest extends FormRequest {

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
        $rules = [
            'idSection' => 'required',
            'idScheme' => 'required',
            'idSubdivision' => 'required',
            'idSchemeActivation' => 'required',
        ];
        if($this->TotalFund<0 || $this->TotalArea<0){
            $rules += ['total_val' => 'required'];
        }
        $this->_details = array_where($this->input('blocks', []), function ($dis) {
            if (isset($dis['idBlock'])) {
                return $dis;
            }
        });
        if (((count($this->_details)) == 0)) {
            $rules['block'] = 'required';
        } else {
            $totalFunds = 0;
            $totalArea = 0;
            foreach ($this->blocks as $dis) {
                if (isset($dis['idBlock'])) {
                    $rules['blocks.' . $dis['idBlock'] . '.idBlock'] = 'unique:schemedistributionblock,idBlock,NULL,idBlock,idSchemeActivation,' . $this->idSchemeActivation;
                    $rules['blocks.' . $dis['idBlock'] . '.amountBlock'] = 'required|integer|min:0';
                    $rules['blocks.' . $dis['idBlock'] . '.areaBlock'] = 'required|integer|min:0';
                }
                if (is_numeric($dis['amountBlock']) && is_numeric($dis['areaBlock'])) {
                    $totalFunds += $dis['amountBlock'];
                    $totalArea += $dis['areaBlock'];
                }
            }
            if ($this->idSchemeActivation != null) {
                $scheme = \App\SchDistrictDistribution::where('idSchemeActivation', '=', $this->idSchemeActivation)->first();
                if ($totalFunds > $scheme->amountDistrict) {
                    $rules += ['totalFunds' => 'required'];
                }
                if ($totalArea > $scheme->areaDistrict) {
                    $rules += ['totalArea' => 'required'];
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
            'idSubdivision.required'=>'Subdivision Must be Selected.',
            //   'schemeDistributionDistrict.required' => 'Scheme Distribution(District) Must be Selected',
            'block.required' => 'Atleast One Block Should Be Selected',
            'totalFunds.required' => 'Financial Target is Exceeded for this District',
            'totalArea.required' => 'Physical Target is Exceeded for this District',
            'blocks.*idBlock.unique' => 'This Scheme is Already Distributed To This Block',
            'blocks.*amountBlock.required' => 'Financial Target Must Not Be Empty',
            'blocks.*areaBlock.required' => 'Physical Target Must Not Be Empty',
            'blocks.*amountBlock.integer' => 'Financial Target Must Have Numeric Value ',
            'blocks.*areaBlock.integer' => 'Physical Target Must Have Numeric Value',
            'blocks.*amountBlock.min' => 'Financial Target Must Have Positive Value',
            'blocks.*areaBlock.min' => 'Physical Target Must Have Positive Value',
            'total_val.required'=>'Your Physical Or Financial Target May have Exceeded the Limit.'
        ];

        return $messages;
    }

}
