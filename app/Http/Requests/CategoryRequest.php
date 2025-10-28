<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        'category_name' => 'required|string|max:150',
        'category_description' => 'string|max:150'
    );
}

public function messages(): array
{
    return array(
        'category_name.required' => 'Name field is required',
        'category_name.max' => 'Maximum character for Name field is 150',
        'category_name.string' => 'Description field must be a string',
        'category_description.string' => 'Description field must be a string',
        'category_description.max' => 'Maximum character for Name field is 150',
    );
}
}
