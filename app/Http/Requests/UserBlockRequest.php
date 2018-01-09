<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserBlockRequest extends FormRequest {

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
        if ($this->has('existing')) {
            $rules = [
                'idSubdivision' => 'required',
                'idDistrict' => 'required',
                'idSection' => 'required',
                'idDesignation' => 'required',
                'idUser' => 'required',
            ];
            if (count($this->idBlocks) == 0) {
                $rules['idBlock'] = 'required';
            } else {
                foreach ($this->idBlocks as $var) {
                    $rules['idDesignation'] = 'unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idBlock,' . $var;
                }
            }
        } else {
            $rules = [
                'idSubdivision' => 'required',
                'idDistrict' => 'required',
                'idSection' => 'required',
                'idDesignation' => 'required',
                'userName' => 'required|regex:/^[\pL\s\-)]+$/u'
            ];
            if (count($this->idBlocks) == 0) {
                $rules['idBlock'] = 'required';
            } else {
                foreach ($this->idBlocks as $var) {
                    $rules['idDesignation'] = 'unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idBlock,' . $var;
                }
            }
        }
        return $rules;
    }

    public function messages() {
        $messages = [
            'idDistrict.required' => 'District must be selected.',
            'idSubdivision.required' => 'Subdivision must be selected.',
            'idBlock.required' => 'Block must be selected.',
            'idSection.required' => 'Select Section First.',
            'idDesignation.required' => 'Select Designation.',
            'idDesignation.unique' => 'User With This Designation has already been registered in this Block.',
            'userName.required' => 'UserName Must Not Be Empty.'
        ];
        return $messages;
    }

}
