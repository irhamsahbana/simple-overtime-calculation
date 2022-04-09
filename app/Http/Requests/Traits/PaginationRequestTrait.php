<?php

namespace App\Http\Requests\Traits;

trait PaginationRequestTrait
{
    /**
     * This function is used to get the pagination rules.
     *
     * @return array
     */
    public static function getPaginationRules()
    {
        $rules = [
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer',
            'order_type' => ['nullable', 'string', 'in:ASC,DESC'],
        ];

        return $rules;
    }
}