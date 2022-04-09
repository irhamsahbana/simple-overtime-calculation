<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\ApiSettingUpdateRequest;

use App\Http\Repositories\Setting;

use App\Models\Setting as Model;
use App\Models\Reference;

class ApiSettingController extends Controller
{
    public function update(ApiSettingUpdateRequest $request)
    {
        $row = Model::find($request->id);
        $row->key = $request->key;
        $row->value = $request->value;

        $repo =  new Setting($row);
        $repo->save();

        return response()->json([
            'message' => 'Setting updated.',
            'data' => $repo->toArray(),
        ]);
    }
}
