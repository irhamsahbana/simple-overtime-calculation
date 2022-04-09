<?php

namespace App\Http\Repositories\Finder;

use Illuminate\Http\Request;

use App\Models\Employee as Model;

class EmployeeFinder extends AbstractFinder
{
    public function __construct()
    {
        $this->query = Model::select('id', 'status_id', 'name', 'salary')
                            ->with([
                                'status' => function ($query) {
                                    $query->select('id', 'name');
                                }
                            ]);
    }

    public function setOrderBy(string $order_by)
    {
        $order_by = strtolower($order_by);

        switch ($order_by) {
            case 'name':
                $this->query->orderBy('name', $this->order_type);
                break;
            case 'salary':
                $this->query->orderBy('salary', $this->order_type);
                break;
        }
    }
}