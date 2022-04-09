<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function toArray()
    {
        return $this->model->toArray();
    }

    public function save()
    {
        $this->beforeSave();
        $this->model->save();
        $this->afterSave();
    }

    protected function beforeSave() {}
    protected function afterSave() {}
}