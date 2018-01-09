<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserVillageRequest extends FormRequest {

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
//       dd($this->all());
        if ($this->has('existing')) {
            $rules = [
                'idSubdivision'=>'required',
                'idDistrict'=>'required',
                'idBlock'=>'required',
                'idSection' => 'required',
                'idDesignation' => 'required',
                'idUser' => 'required'
            ];
            if (count($this->idVillages) == 0) {
                $rules['idVillage'] = 'required';
            }else {
                foreach ($this->idVillages as $var) {
                    $rules['idDesignation'] = 'unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idVillage,' . $var;
                }
            }
        } else {
            $rules = [
                'idSubdivision'=>'required',
                'idDistrict'=>'required',
                'idBlock'=>'required',
                'idSection' => 'required',
                'idDesignation' => 'required',
                'userName' => 'required|regex:/^[\pL\s\-)]+$/u'
            ];
            if (count($this->idVillages) == 0) {
                $rules['idVillage'] = 'required';
            }else {
                foreach ($this->idVillages as $var) {
                    $rules['idDesignation'] = 'unique:user_designation_district_mapping,idDesignation,NULL,iddesgignationdistrictmapping,idVillage,' . $var;
                }
            }
        }
       return $rules;
    }

    public function messages() {
        $messages = [
            'idUser.required' => 'User must be selected.',
            'idDistrict.required' => 'District must be selected.',
            'idSubdivision.required' => 'Sub Division must be selected.',
            'idBlock.required' => 'Block must be selected.',
            'idVillage.required' => 'Atleast One Village Must Be selected.',
            'idSection.required' => 'Select Section First.',
            'idDesignation.required' => 'Select Designation.',
            'idDesignation.unique' => 'User in This Village has already been registered with this designation.',
            'userName.required' => 'UserName Must Not Be Empty.'
        ];
        return $messages;
    }

}


