<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeTranningRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            //
            'employee_id' => 'required',
            'training_sessions_id'=>'required',
            'status'=>'required'
        ];

    }

    public function messages(){

        return [
            'employee_id.required' => 'employee_id is required',
            'training_sessions_id.required' => 'training_sessions_id is required',
            'status.required' => 'status is required',
            
        ];
    }
}
