<?php

namespace App\Http\Repositories\Finder;

use App\Models\Overtime as Model;

class OvertimeFinder extends AbstractFinder
{
    public function __construct()
    {
        $this->query = Model::select(
                            'id',
                            'employee_id',
                            'date',
                            'time_started',
                            'time_ended',
                            )
                            ->with([
                                'employee' => function ($query) {
                                    $query->select('id', 'name');
                                },
                            ]);
    }

    public function setDateStarted(\DateTime $dateStarted)
    {
        $this->query->where('date', '>=', $dateStarted);
    }

    public function setDateEnded(\DateTime $dateEnded)
    {
        $this->query->where('date', '<=', $dateEnded);
    }
}