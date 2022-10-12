<?php

use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    RegistrationController,
    CanadeviController,
    RaceController,
    Admin\AdminController
};

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

Route::domain('forocanadevihidalgo.' . env('APP_URL'))->group(function () {
    Route::get('/', [CanadeviController::class, 'create']);
    Route::get('/gracias/{hash}', [CanadeviController::class, 'thanks'])->name('thanks_canadevi');
    Route::post('/formulario', [CanadeviController::class, 'store'])->name('form_store_canadevi');
    Route::get('/validacion/{hash}', [CanadeviController::class, 'confirm']);
});

Route::domain('carreracanadevi.' . env('APP_URL'))->group(function () {
    Route::get('/', [RaceController::class, 'create']);
    Route::get('/gracias/{hash}', [RaceController::class, 'thanks'])->name('thanks_race');
    Route::post('/formulario', [RaceController::class, 'store'])->name('form_store_race');
    Route::get('/validacion/{hash}', [RaceController::class, 'confirm']);
    Route::get('/cities/{id}', [RaceController::class, 'getCities']);
});

/*
Route::get('/formulario', [RaceController::class, 'create']);
Route::get('/gracias/{hash}', [RaceController::class, 'thanks'])->name('thanks_race');
Route::post('/formulario', [RaceController::class, 'store'])->name('form_store_race');
Route::get('/validacion/{hash}', [RaceController::class, 'confirm']);
Route::get('/cities/{id}', [RaceController::class, 'getCities']);
*/

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
