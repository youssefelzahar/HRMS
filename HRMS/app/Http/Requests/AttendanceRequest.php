<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
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
            'employee_id' => 'required|numeric',
            'date' => 'required|date_format:Y-m-d',
            'check_in_time' => 'required|date_format:Y-m-d H:i:s',
            'check_out_time' => 'required|date_format:Y-m-d H:i:s|after:check_in_time',
            'status' => 'required|string',
            'version'=> 'required|numeric',
        ];

    }
    public function messages(){

        return [
            'employee_id.required' => 'The employee field is required.',
            'date.required' => 'The date field is required.',
            'check_in_time.required' => 'The check in time field is required.',
            'check_out_time.required' => 'The check out time field is required.',
            'status.required' => 'The status field is required.',
            'version.required'=>"The version field is required."
        ];
    }
}
