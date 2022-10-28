<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\AdminController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/webhook', [RegistrationController::class, 'register']);

Route::post('admin/race', [AdminController::class, 'setPaymentRace']);
Route::post('admin/forum', [AdminController::class, 'setPaymentForum']);

Route::post('admin/payment', [AdminController::class, 'payment']);
Route::get('/emails/{option}', [AdminController::class, 'sendEmails']);
Route::get('/emails/race/nopayment', [AdminController::class, 'sendNoPaymentEmails']);
Route::post('/admin/race/change/{id}', [AdminController::class, 'changeRace']);
Route::get('/admin/race/day', [AdminController::class, 'sendChangeDayEmails']);
Route::post('/admin/forum/change/{id}', [AdminController::class, 'changeForum']);

Route::get('/admin/race/confirm/{id}', [AdminController::class, 'confirmRaceAssistence']);
Route::get('/admin/forum/confirm/{id}', [AdminController::class, 'confirmForumAssistence']);
