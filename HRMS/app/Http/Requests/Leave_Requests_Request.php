<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Leave_Requests_Request extends FormRequest
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
            'employee_id' => 'required|exists:employees,id', // Check if employee_id exists in employees table
            'start_date' => 'required|date', // Ensure the date format is correct
            'end_date' => 'required|date|after_or_equal:start_date', // Ensure end_date is after or equal to start_date
            'reason' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            'leave_typess_id'=>'required' // Define valid status values
        ];
    }
    public function messages(): array{
        return [    
            'employee_id.required' => 'employee_id is required',
            'start_date.required' => 'start_date is required',
            'end_date.required' => 'end_date is required',
            'reason.required' => 'reason is required',
            'status.required' => 'status is required',
            'leave_typess_id.required' => 'leave_typess_id is required',
        ];}
}
