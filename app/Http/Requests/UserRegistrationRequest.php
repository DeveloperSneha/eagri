<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest {

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
//        dd($this->all());
        $rules = [
           'idSection' => 'required',
           // 'idDesignation' => 'unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idDistrict,' . $this->idDistrict,
            'userName' => 'required|regex:/^[\pL\s\-)]+$/u'
        ];
        if (count($this->idDistricts) == 0) {
            $rules += ['idDistrict' => 'required'];
        }
        if (count($this->designations) == 0) {
            $rules += ['designation' => 'required'];
        }
        return $rules;
    }

    public function messages() {
        $messages = [
            'idDistrict.required' => 'District must be selected.',
            'idSection.required' => 'Select Section First.',
            'designation.required' => 'Select Atleast OneDesignation.',
            'idDesignation.unique' => 'User With This Designation has already been registered.',
            'userName.required' => 'UserName Must Not Be Empty.'
        ];
        return $messages;
    }
}
