<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    ApiSettingController,
    ApiEmployeeController,
    ApiOvertimeController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::patch('/settings',[ApiSettingController::class, 'update']);

Route::get('/employees', [ApiEmployeeController::class, 'index']);
Route::post('/employees', [ApiEmployeeController::class, 'store']);

Route::get('/overtimes', [ApiOvertimeController::class, 'index']);
Route::post('/overtimes', [ApiOvertimeController::class, 'store']);
Route::get('/overtime-pays/calculate', [ApiOvertimeController::class, 'calculatePayment']);

