<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowRequest extends FormRequest
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
            'reader_id'             => 'required|exists:users,id',
            'book_id'               => 'required|exists:books,id',
            'status'                => 'required|in:PENDING, ACCEPTED, REJECTED, RETURNED',
            'request_processed_at'  => 'date|nullable',
            'request_managed_by'    => 'required|exists:users,id',
            'deadline'              => 'date|nullable',
            'returned_at'           => 'date|nullable',
            'return_managed_by'     => 'nullable|exists:users,id'
        ];
    }
}
