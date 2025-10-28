<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
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
        $bookId = $this->route('book'); // Ambil model Book dari route binding (kalau ada)

        return [
            'book_name' => 'required|string|max:255',
            'book_isbn' => [
                'required',
                'string',
                Rule::unique('books', 'book_isbn')->ignore($bookId),
            ],
            'book_img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'book_author_id' => 'required|exists:authors,author_id',
            'book_category_id' => 'required|exists:categories,category_id',
            'book_publisher_id' => 'required|exists:publishers,publisher_id',
            'book_shelf_id' => 'required|exists:shelfs,shelf_id',
            'book_stock' => 'required|numeric|min:0',
            'book_description' => 'required|string',
        ];
    }
}
