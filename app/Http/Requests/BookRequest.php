<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'cover_image'   => 'nullable|string',
            'pages'         => 'required|integer',
            'language_code' => 'nullable|string',
            'isbn'          => 'unique:books,isbn|regex:/^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$/i',
            'genres'        => 'array',
            'genres.*'      => 'exists:genres,id',
            'in_stock'      => 'required|integer|min:0'
        ];
    }
}
