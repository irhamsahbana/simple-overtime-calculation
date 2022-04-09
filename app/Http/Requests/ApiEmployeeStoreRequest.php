<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApiEmployeeStoreRequest extends FormRequest
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
            'status_id' => [
                'required',
                'integer',
                Rule::exists('references', 'id')->where(function ($query) {
                    $query->where('code', 'employee_status');
                })
            ],
            'name' => ['required', 'string', 'min:2', 'unique:employees'],
            'salary' => ['required', 'integer', 'min:2000000', 'max:10000000'],
        ];
    }
}
