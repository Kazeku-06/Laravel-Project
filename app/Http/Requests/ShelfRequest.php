<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShelfRequest extends FormRequest
{
    
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
        'shelf_name' => 'required|string|max:150',
        'shelf_position' => 'string|max:150'
    );
}

public function messages(): array
{
    return array(
        'shelf_name.required' => 'Name field is required',
        'shelf_name.max' => 'Maximum character for Name field is 150',
        'shelf_name.string' => 'Description field must be a string',
        'shelf_position.string' => 'Description field must be a string',
        'shelf_position.max' => 'Maximum character for Name field is 150',
    );
}
}
