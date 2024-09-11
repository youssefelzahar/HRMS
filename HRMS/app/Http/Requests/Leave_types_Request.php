<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Leave_types_Request extends FormRequest
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
            
            "name"=>"required",
            "description"=>"required", 
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'name is required',
            'description.required' => 'description is required',

        ];
    }
}
