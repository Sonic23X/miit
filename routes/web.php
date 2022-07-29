<?php

use App\Http\Controllers\Web\RegistrationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Mail\Markdown;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain('form.' . env('APP_URL'))->group(function () {
    Route::get('/', [RegistrationController::class, 'create']);
    Route::get('/gracias/{hash}', [RegistrationController::class, 'thanks'])->name('thanks');
    Route::post('/formulario', [RegistrationController::class, 'store'])->name('form_store');
    Route::get('/validacion/{hash}', [RegistrationController::class, 'confirm']);
});

/*
Route::get('/formulario', [RegistrationController::class, 'create']);
Route::get('/gracias/{hash}', [RegistrationController::class, 'thanks'])->name('thanks');
Route::post('/formulario', [RegistrationController::class, 'store']);
Route::get('/validacion/{hash}', [RegistrationController::class, 'confirm']);*/

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [RegistrationController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
