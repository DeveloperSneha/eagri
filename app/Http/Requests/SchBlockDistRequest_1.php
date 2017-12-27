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
        //   dd($this->blocks);
        $rules = [
            'idSchemeActivation' => 'required',
                // 'schemeDistributionDistrict' => 'required'
        ];
        if (((count($this->blocks)) == 0)) {
            $rules['block'] = 'required';
        }
        if (((count($this->blocks)) > 0)) {
            $this->_details = array_where($this->input('blocks', []), function ($dis) {
                if (isset($dis['idBlock'])) {
                    return $dis;
                }
            });
        }
        $totalFunds = 0;
        $totalArea = 0;
        if ((count($this->_details)) == 0) {
            $rules['block'] = 'required';
        } else {
            foreach ($this->blocks as $dis) {
                $totalFunds += $dis['amountBlock'];
                $totalArea += $dis['areaBlock'];
                if (isset($dis['idBlock'])) {
                    $rules['blocks.' . $dis['idBlock'] . '.amountBlock'] = 'required|integer|min:0';
                    $rules['blocks.' . $dis['idBlock'] . '.areaBlock'] = 'required|integer|min:0';
                }
            }
        }

        if ($this->idSchemeActivation != null) {
            $scheme = \App\SchDistrictDistribution::where('idSchemeActivation', '=', $this->idSchemeActivation)->first();
            //dd($totalFunds);
            if ($totalFunds > $scheme->amountDistrict) {
                //  dd('here');
                $rules += ['totalFunds' => 'required|integer|min:0'];
            }
            if ($totalArea > $scheme->areaDistrict) {
                $rules += ['totalArea' => 'required|integer|min:0'];
            }
        }
        return $rules;
    }

    public function messages() {
        $messages = [];

        $messages += [
            'idSchemeActivation.required' => 'Select Any One Of the Scheme',
            //   'schemeDistributionDistrict.required' => 'Scheme Distribution(District) Must be Selected',
            'block.required' => 'Atleast One Block Should Be Selected',
            'totalFunds.required' => 'Financial Target is Exceeded for this District',
            'totalArea.required'=>'Physical Target is Exceeded for this District'
        ];

        return $messages;
    }

}
