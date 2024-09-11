<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentsRequest extends FormRequest
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
            'employee_id' => 'sometimes|required|exists:employees,id',
            'document_type' => 'sometimes|required|string',
            'file' => 'sometimes|required|file|mimes:pdf,jpg,png|max:2048',
            'uploaded_at' => 'sometimes|required|date',
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required' => 'The Employee ID field is required.',
            'document_type.required' => 'The Document Type field is required.',
            'file.required' => 'The File field is required.',
            'uploaded_at.required' => 'The Uploaded At field is required.',
        ];
    }
}
