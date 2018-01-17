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
            'unitName' => 'required|unique:units|between:2,20|regex:/^[A-z]+$/|max:25',
            'unitType' => 'required|unique:units|regex:/^[A-z]+$/|max:25',
            'idBaseUnit' => 'required|numeric|min:0',
            'conversionMultipierToBase' => 'required|numeric|min:0'
        ];
        if ($id)
            $rules = [
                'unitName' => 'required|regex:/^[\pL\s\-]+$/u|unique:units,unitName,'.$id.',idUnit',
                'unitType' => 'required|regex:/^[A-z]+$/|max:25',
                'idBaseUnit' => 'required|integer|min:0',
                'conversionMultipierToBase' => 'required|numeric|min:0'
            ];
        return $rules;
    }

    public function messages() {
        $messages = [
            'unitName.required' => 'Unit Name Must Not be Empty',
            'unitName.regex' => 'Unit Name Is Not Valid',
            'unitType.required' => 'Unit Type Must Not be Empty',
            'unitType.regex' => 'Unit Type Is Not Valid',
            'unitType.unique' => 'Unit Type Already Exist',
            'idBaseUnit.required' => 'Base Unit Must Not Be Empty',
            'idBaseUnit.numeric' => 'Base Unit Must Have Numeric Value',
            'idBaseUnit.min' => 'Base Unit Must Not be Negative',
            'conversionMultipierToBase.required' => 'Conversion Multipier To Base Must Not be Empty',
            'conversionMultipierToBase.min' => 'Conversion Multipier To Base Must Not be Negative',
            'conversionMultipierToBase.numeric' => 'Conversion Multipier To Base Must Have Numeric Value',
            'conversionMultipierToBase.after' => 'Conversion Multipier To Base Must Be Greater than Base Unit '
        ];
        return $messages;
    }

}
