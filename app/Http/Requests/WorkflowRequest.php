<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkflowRequest extends FormRequest {

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
            'idSection' => 'required',
            'workflowName' => 'required|between:2,50|regex:/^[\pL\s\-()]+$/u'
        ];
        if(count($this->designations) == 0){
            $rules += ['designation'=>'required'];
        }
        return $rules;
    }

    public function messages() {
        $message = [
            'idSection.required' => 'Select Section.',
            'designation.required' => 'Designation Must Be Selected.',
            'workflowName.required' => 'workflow Name Must Be Provided.',
            'workflow.regex' => 'Workflow Name is Invalid '
        ];
        return $message;
    }

}
