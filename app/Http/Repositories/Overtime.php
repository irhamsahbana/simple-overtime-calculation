<?php

namespace App\Http\Repositories;

use App\Models\Overtime as Model;

class Overtime extends AbstractRepository
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function save()
    {
        parent::save();
    }

    public function toArray()
    {
        return parent::toArray();
    }
}