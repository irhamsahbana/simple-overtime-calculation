<?php

namespace App\Http\Repositories;

use App\Models\Employee as Model;

class Employee extends AbstractRepository
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function toArray()
    {
        return parent::toArray();
    }

    public function save()
    {
        parent::save();
    }
}