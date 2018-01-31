<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSubdivisionRequest extends FormRequest {

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
//        dd($this->has('existing'));
        if ($this->has('existing')) {
            $rules = [
                'idDistrict' => 'required',
                'idSection' => 'required',
                'idDesignation' => 'required',
                'idUser' => 'required'
            ];
            if (count($this->idSubdivisions) == 0) {
                $rules['idSubdivision'] = 'required';
            } else {
                foreach ($this->idSubdivisions as $var) {
                    $rules['idDesignation'] = 'required|unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idSubdivision,' . $var;
                }
            }
        } else {
            $rules = [
                'idDistrict' => 'required',
                'idSection' => 'required',
                'idDesignation' => 'required',
                'userName' => 'required|unique:users|regex:/^[\pL\s\-()]+$/u'
            ];
            if (count($this->idSubdivisions) == 0) {
                $rules['idSubdivision'] = 'required';
            } else {
                foreach ($this->idSubdivisions as $var) {
                    $rules['idDesignation'] = 'required|unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idSubdivision,' . $var;
                }
            }
        }
        return $rules;
    }

    public function messages() {
        $messages = [
            'idUser.required' => 'User must be selected.',
            'idUser.unique'=> 'User Already Taken',
            'idDistrict.required' => 'District must be selected.',
            'idSubdivision.required' => 'Sub Division must be selected.',
            'idSection.required' => 'Select Section First.',
            'idDesignation.required' => 'Select Designation.',
            'idDesignation.unique' => 'User With This Designation has already been registered in this Subdivision.',
            'userName.required' => 'UserName Must Not Be Empty.'
        ];
        return $messages;
    }

}
