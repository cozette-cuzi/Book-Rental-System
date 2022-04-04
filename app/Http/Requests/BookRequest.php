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
            'name'          => 'required|string',
            'authors'       => 'required|string',
            'description'   => 'nullable|string',
            'released_at'   => 'date|required',
            'cover_image'   => 'nullable|string',
            'pages'         => 'required|integer',
            'language_code' => 'nullable|string',
            'isbn'          => 'unique|string',
            'in_stock'      => 'required|integer'
        ];
    }
}
