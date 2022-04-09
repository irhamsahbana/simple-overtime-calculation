<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApiOvertimeIndexRequest extends FormRequest
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
            'date_started' => [
                'nullable',
                'date',
                'before_or_equal:date_ended'
            ],
            'date_ended' => [
                'nullable',
                'date',
                'after_or_equal:date_started'
            ],
        ];
    }
}
