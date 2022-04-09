<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\{
    ApiEmployeeIndexRequest,
    ApiEmployeeStoreRequest
};

use App\Http\Repositories\Finder\EmployeeFinder;
use App\Http\Repositories\Employee;

use App\Models\Employee as Model;

class ApiEmployeeController extends Controller
{
    public function index(ApiEmployeeIndexRequest $request)
    {
        $finder = new EmployeeFinder();

        if ($request->page)
            $finder->setPage($request->page);

        if ($request->per_page)
            $finder->setPerPage($request->per_page);

        if ($request->order_type)
            $finder->setOrderType($request->order_type);

        if ($request->order_by)
            $finder->setOrderBy($request->order_by);

        $found = $finder->get();

        return response()->json($found);

    }

    public function store(ApiEmployeeStoreRequest $request)
    {
        $row = new Model();
        $row->name = $request->name;
        $row->salary = $request->salary;
        $row->status_id = $request->status_id;

        $repo = new Employee($row);
        $repo->save();

        return response()->json([
            'message' => 'Employee created.',
            'data' => $repo->toArray(),
        ], Response::HTTP_CREATED);
    }
}
