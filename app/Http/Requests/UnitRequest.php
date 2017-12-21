<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest {

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
        $id = $this->route('unit');
        $rules = [
            'unitName' => 'required|unique:units|regex:/^[\pL\s\-]+$/u',
            'unitType' => 'required|unique:units',
            'idBaseUnit' => 'required|integer',
            'conversionMultipierToBase' => 'required'
        ];
        if ($id)
            $rules = [
                'unitName' => 'required|regex:/^[\pL\s\-]+$/u', Rule::unique('units')->ignore($id),
                'unitType' => 'required',
                'idBaseUnit' => 'required|integer',
                'conversionMultipierToBase' => 'required|integer'
            ];
        return $rules;
    }

    public function messages() {
        $messages = [
            'unitName.required' => 'Unit Name Must Not be Empty',
            'unitName.regex' => 'Unit Name Is Not Valid',
            'unitType.required' => 'Unit Type Must Not be Empty',
            'unitType.unique' => 'Unit Type Already Exist',
            'idBaseUnit.required' => 'Base Unit Must Not Be Empty',
            'idBaseUnit.integer' => 'Base Unit Must Have integer Value',
            'conversionMultipierToBase.required' => 'Conversion Multipier To Base Must Not be Empty'
        ];
        return $messages;
    }

}
