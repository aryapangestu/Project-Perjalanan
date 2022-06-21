<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Events\Login;
use Symfony\Component\HttpKernel\DependencyInjection\RegisterLocaleAwareServicesPass;

use App\Http\Controllers\HomeController;

// Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDriverController;
use App\Http\Controllers\Admin\AdminPassengerController;

// Driver
use App\Http\Controllers\Driver\DriverController;
use App\Http\Controllers\Driver\DriverPerjalananController;
use App\Http\Controllers\Driver\DriverHistoryController;

// Passenger
use App\Http\Controllers\Passenger\PassengerController;
use App\Http\Controllers\Passenger\PassengerPemesananController;
use App\Http\Controllers\Passenger\PassengerPerjalananController;
use App\Http\Controllers\Passenger\PassengerHistoryController;
use Illuminate\Support\Facades\Auth;

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
// Login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register/passenger', [RegisterController::class, 'storePassenger']);
Route::post('/register/driver', [RegisterController::class, 'storeDriver']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    Route::middleware(['checkRole:0'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index']);
        Route::get('/list-pengemudi', [AdminDriverController::class, 'index']);
        Route::post('/list-pengemudi/status/{id}', [AdminDriverController::class, 'updateDriverStatus']);
        Route::get('/list-penumpang', [AdminPassengerController::class, 'index']);
        Route::post('/list-penumpang/status/{id}', [AdminPassengerController::class, 'updatepassengerStatus']);
    });

    Route::middleware(['checkRole:1'])->group(function () {
        Route::get('/passenger', [PassengerController::class, 'index']);
        Route::get('/passenger/perjalanan', [PassengerPerjalananController::class, 'index']);
        Route::get('/passenger/history', [PassengerHistoryController::class, 'index']);
        Route::get('/passenger/history/{id}', [PassengerHistoryController::class, 'showView']);
        Route::post('/passenger/history/{id}', [PassengerHistoryController::class, 'storeUlasan']);
        Route::get('/passenger/pemesanan', [PassengerPemesananController::class, 'index']);
        Route::post('/passenger/pemesanan', [PassengerPemesananController::class, 'store']);
    });

    Route::middleware(['checkRole:2'])->group(function () {
        Route::get('/driver', [DriverController::class, 'index']);
        Route::post('/driver/status/{id}', [DriverController::class, 'updateDriverStatus']);
        Route::get('/driver/perjalanan', [DriverPerjalananController::class, 'index']);
        Route::get('/driver/perjalanan/{id}', [DriverPerjalananController::class, 'showView']);
        Route::put('/driver/perjalanan/{id}', [DriverPerjalananController::class, 'updateRideDriver']);
        Route::put('/driver/perjalanan/selesai/{id}', [DriverPerjalananController::class, 'updateRideStatus']);
        Route::get('/driver/history', [DriverHistoryController::class, 'index']);
        Route::get('/driver/history/{id}', [DriverHistoryController::class, 'showView']);
    });
});
