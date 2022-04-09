<?php

namespace App\Http\Repositories;

use App\Models\Setting as Model;
use App\Models\Reference;

class Setting extends AbstractRepository
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

    protected function beforeSave()
    {
        $this->model->expression = Reference::find($this->model->value)->expression;
    }
}