<?php

namespace App\Http\Requests;

use App\Models\Borrow;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBorrowRequest extends FormRequest
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
            'status'   => [
                Rule::in(['PENDING', 'ACCEPTED', 'REJECTED', 'RETURNED']),
                function ($attribute, $value, $fail) {
                    $old = Borrow::find(\request('id'))->status;
                    if (!$this->__checkStatusValidity($old, $value)) {
                        $fail('Can\'t move the status to ' . $value . ' when it\'s ' . $old);
                    }
                },
            ],
            'deadline' => 'date|nullable|after:now',
        ];
    }


    private function __checkStatusValidity($old, $new)
    {
        return ($new == 'PENDING' && in_array($old, ['PENDING'])) ||
            ($new == 'ACCEPTED' && in_array($old, ['ACCEPTED', 'PENDING'])) ||
            ($new == 'RETURNED' && in_array($old, ['RETURNED', 'ACCEPTED'])) ||
            ($new == 'REJECTED' && in_array($old, ['REJECTED', 'PENDING']));
    }
}
