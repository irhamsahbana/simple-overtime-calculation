<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ApiSettingUpdateRequest extends FormRequest
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
            'id' => 'required|integer|exists:settings,id',
            'key' => ['required', 'string', Rule::in('overtime_method')],
            'value' => [
                'required',
                Rule::exists('references', 'id')->where(function ($query) {
                    $query->where('code', 'overtime_method');
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'id.exists' => 'Setting not found.',
            'key.in' => 'Invalid key.',
            'value.exists' => 'Invalid value.',
        ];
    }
}
