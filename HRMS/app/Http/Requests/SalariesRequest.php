<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalariesRequest extends FormRequest
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
            'employee_id' => 'required',
            'amount' => 'required',
            'effective_date' => 'required',
        ];
    }
    public function messages(): array{
        return [
            'employee_id.required' => 'employee_id is required',
            'amount.required' => 'amount is required',
            'effective_date.required' => 'effective_date is required',
        ];
    }
}
