<?php

use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    RegistrationController,
    CanadeviController,
    RaceController,
    DomController,
    Admin\AdminController,
    AmpiController
};


use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Canadevi;

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
    Route::get('/canadevi/validacion/{hash}', [CanadeviController::class, 'confirm']);

    Route::get('login', [CanadeviController::class, 'login'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('dashboard', [CanadeviController::class, 'dashboard'])->name('dashboard');
});

Route::domain('carreracanadevi.' . env('APP_URL'))->group(function () {
    Route::get('/', [RaceController::class, 'create']);
    Route::get('/gracias/{hash}', [RaceController::class, 'thanks'])->name('thanks_race');
    Route::post('/formulario', [RaceController::class, 'store'])->name('form_store_race');
    Route::get('/canadevi/validacion/{hash}', [RaceController::class, 'confirm']);
    Route::get('/cities/{id}', [RaceController::class, 'getCities']);

    Route::get('login', [RaceController::class, 'login'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('dashboard', [RaceController::class, 'dashboard'])->name('dashboard');
});

Route::domain('ampi.' . env('APP_URL'))->group(function () {
    Route::get('/', [AmpiController::class, 'create']);
    Route::get('/gracias/{hash}', [AmpiController::class, 'thanks'])->name('thanks_ampi');
    Route::post('/formulario', [AmpiController::class, 'store'])->name('form_store_ampi');
    Route::get('/validacion/{hash}', [AmpiController::class, 'confirm']);
    Route::get('/cupon/{cupon}', [AmpiController::class, 'validateCoupon']);

    Route::get('login', [AmpiController::class, 'login'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [AmpiController::class, 'dashboard'])->name('dashboard_ampi');
        Route::get('/cupon', [AmpiController::class, 'cupon_dash'])->name('dashboard_coupon');
        Route::get('/cupon/make/{count}', [AmpiController::class, 'makeCoupons']);
    });
});

Route::domain('dom.' . env('APP_URL'))->group(function () {
    Route::get('/', [DomController::class, 'create']);
    Route::get('/gracias/{hash}', [DomController::class, 'thanks'])->name('thanks_dom');
    Route::post('/formulario', [DomController::class, 'store'])->name('form_store_dom');
    Route::get('/validacion/{hash}', [DomController::class, 'confirm']);
});

Route::domain('access.' . env('APP_URL'))->group(function () {
    Route::get('/', function () {
        return redirect('/login');
    });

    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::middleware(['auth'])->group(function () {
        //Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', function () {
            return redirect('/forum');
        });
        Route::get('forum', [AdminController::class, 'indexForum'])->name('forum');
        Route::get('forum/excel', [AdminController::class, 'downloadForum'])->name('downloadForum');
        Route::get('race', [AdminController::class, 'indexRace'])->name('race');
        Route::get('race/excel', [AdminController::class, 'downloadRace'])->name('downloadRace');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});

/*

Route::middleware(['auth'])->group(function() {
    //Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', function () {
        return redirect('/forum');
    });
    Route::get('forum', [AdminController::class, 'indexForum'])->name('forum');
    Route::get('forum/excel', [AdminController::class, 'downloadForum'])->name('downloadForum');
    Route::get('race', [AdminController::class, 'indexRace'])->name('race');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);*/
