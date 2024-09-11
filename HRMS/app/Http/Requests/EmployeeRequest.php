<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'departments' => 'required|exists:departments,id',
            'position' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'hire_date' => 'required|date',
            'salary' => 'required|numeric',
            'status' => 'required|in:active,terminated',
            'version'=>'required|integer',
        ];
    }

    public function messages(){

        return [
            'user_id.required' => 'The User ID field is required.',
            'departments.required' => 'The Department field is required.',
            'position.required' => 'The Position field is required.',
            'date_of_birth.required' => 'The Date Of Birth field is required.',
            'gender.required' => 'The Gender field is required.',
            'hire_date.required' => 'The Hire Date field is required.',
            'salary.required' => 'The Salary field is required.',
            'status.required' => 'The Status field is required.',
            'version.required' => 'The Version field is required.',
            
        ];
    }
}
