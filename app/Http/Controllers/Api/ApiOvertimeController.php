<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\{
    ApiOvertimeIndexRequest,
    ApiOvertimeStoreRequest,
    ApiOvertimeCalculatePaymentRequest,
};

use App\Http\Repositories\Overtime;
use App\Http\Repositories\Finder\OvertimeFinder;
use App\Http\Repositories\Finder\OvertimePaymentFinder;
use App\Models\Overtime as Model;

class ApiOvertimeController extends Controller
{
    public function index(ApiOvertimeIndexRequest $request)
    {
        $finder = new OvertimeFinder();
        $finder->setIsUsePagination(false);

        if ($request->date_started)
            $finder->setDateStarted(new \DateTime($request->date_started));

        if ($request->date_ended)
            $finder->setDateEnded(new \DateTime($request->date_ended));

        $found = $finder->get();

        return response()->json($found);
    }

    public function store(ApiOvertimeStoreRequest $request)
    {
        $row = new Model();
        $row->employee_id = $request->employee_id;
        $row->date = $request->date;
        $row->time_started = $request->time_started;
        $row->time_ended = $request->time_ended;

        $repo = new Overtime($row);
        $repo->save();

        return response()->json([
            'message' => 'Successfully created overtime!',
            'data' => $repo->toArray()
        ], Response::HTTP_CREATED);
    }

    public function calculatePayment(ApiOvertimeCalculatePaymentRequest $request)
    {
        $finder = new OvertimePaymentFinder();
        $finder->setIsUsePagination(false);
        $finder->setMonthOfYear(new \DateTime($request->month));

        $found = $finder->calculateOvertimePayment();

        return response()->json($found);
    }
}
