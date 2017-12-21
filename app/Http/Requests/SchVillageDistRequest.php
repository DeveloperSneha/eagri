<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchVillageDistRequest extends FormRequest {

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
        // dd($this->all());
        $rules = [
            'idSchemeActivation' => 'required',
            'schemeDistributionBlock' => 'required'
        ];
         if (((count($this->villages)) == 0)) {
            $rules['village'] = 'required';
        }
        if (((count($this->villages)) > 0)) {
            $this->_details = array_where($this->input('villages', []), function ($dis) {
                if (isset($dis['idVillage'])) {
                    return $dis;
                }
            });
        }
        if ((count($this->_details)) == 0) {
            $rules['village'] = 'required';
        } else {
            foreach ($this->_details as $dis) {
                if (isset($dis['idVillage'])) {
                    $rules['villages.' . $dis['idVillage'] . '.amountVillage'] = 'required';
                    $rules['villages.' . $dis['idVillage'] . '.areaVillage'] = 'required';
                }
            }
        }
        return $rules;
    }

    public function messages() {
        $messages = [];

        $messages += [
            'idSchemeActivation.required' => 'Select Any One Of the Scheme',
            'schemeDistributionBlock.required' => 'Scheme Distribution(Block) Must be Selectedq',
            'village.required' => 'Atleast One Village Should Be Selected'
        ];

        return $messages;
    }

}
