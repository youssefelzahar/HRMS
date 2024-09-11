<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TranningSessionRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'title is required',
            'description.required' => 'description is required',
            'date.required' => 'date is required',
            'location.required' => 'location is required',
        ];
    }
}
