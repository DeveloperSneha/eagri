<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDistrictRequest extends FormRequest {

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
        //   dd($this->idDistricts);
        if ($this->has('existing')) {
            $rules = [
                'idSection' => 'required',
                'idDesignation' => 'required',
                'idUser' => 'required'
            ];
            if (count($this->idDistricts) == 0) {
                $rules['idDistrict'] = 'required';
            } else {
                foreach ($this->idDistricts as $var) {
                    $rules['idDesignation'] = 'unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idDistrict,' . $var;
                }
            }
        } else {
            $rules = [
                'idSection' => 'required',
                'idDesignation' => 'required',
                'userName' => 'required|regex:/^[\pL\s\-)]+$/u'
            ];
            if (count($this->idDistricts) == 0) {
                $rules['idDistrict'] = 'required';
            } else {
                foreach ($this->idDistricts as $var) {
                    $rules['idDesignation'] = 'unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idDistrict,' . $var;
                }
            }
        }
        //  dd($rules);
        return $rules;
    }

    public function messages() {
        $messages = [
            'idUser.required' => 'User must be selected.',
            'idDistrict.required' => 'District must be selected.',
            'idSection.required' => 'Select Section First.',
            'idDesignation.required' => 'Select Designation.',
            'idDesignation.unique' => 'User With This Designation has already been registered in this District.',
            'userName.required' => 'UserName Must Not Be Empty.'
        ];
        return $messages;
    }

}
