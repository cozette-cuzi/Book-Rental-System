<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|string|max:255',
            'authors'       => 'required|string|max:255',
            'description'   => 'nullable|string',
            'released_at'   => 'date|required|before:now',
            'cover_image'   => 'nullable|image',
            'pages'         => 'required|integer|min:1',
            'language_code' => 'nullable|string|max:3',
            'isbn'          => 'regex:/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/i|unique:books,isbn',
            'genres'        => 'array|required',
            'genres.*'      => 'required|numeric|exists:genres,id',
            'in_stock'      => 'required|integer|min:0'
        ];
    }
}
