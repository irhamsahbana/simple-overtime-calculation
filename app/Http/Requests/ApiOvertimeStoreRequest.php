<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApiOvertimeStoreRequest extends FormRequest
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
            'employee_id' => [
                'required',
                'integer',
                Rule::exists('employees', 'id')
            ],
            'date' => [
                'required',
                'date',
                Rule::unique('overtimes', 'date')->where(function ($query) {
                    $query->where('employee_id', $this->employee_id);
                })
            ],
            'time_started' => [
                'required',
                'date_format:H:i',
                'before:time_ended'
            ],
            'time_ended' => [
                'required',
                'date_format:H:i',
                'after:time_started'
            ],
        ];
    }
}
