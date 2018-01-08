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
                'idBlock' => 'unique:user_designation_district_mapping,idBlock,'.$this->idBlock,
            ];
            if (count($this->idBlocks) == 0) {
                $rules += ['idBlock' => 'required|unique:user_designation_district_mapping,idBlock'.$this->idBlock];
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
                $rules += ['idBlock' => 'required|unique:user_designation_district_mapping,idBlock,NULL,iddesgignationdistrictmapping,idBlock' . $this->idBlock];
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
            'idBlock.unique' => 'User in This Block has already been registered.',
            'userName.required' => 'UserName Must Not Be Empty.'
        ];
        return $messages;
    }

}
