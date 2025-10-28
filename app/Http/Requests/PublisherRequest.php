<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublisherRequest extends FormRequest
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
    return array(
        'publisher_name' => 'required|string|max:150',
        'publisher_description' => 'string|max:150'
    );
}

public function messages(): array
{
    return array(
        'publisher_name.required' => 'Name field is required',
        'publisher_name.max' => 'Maximum character for Name field is 150',
        'publisher_name.string' => 'Description field must be a string',
        'publisher_description.string' => 'Description field must be a string',
        'publisher_description.max' => 'Maximum character for Name field is 150',
    );
}
}
