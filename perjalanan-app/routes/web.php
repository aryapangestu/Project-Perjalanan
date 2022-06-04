<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Events\Login;
use Symfony\Component\HttpKernel\DependencyInjection\RegisterLocaleAwareServicesPass;

use App\Http\Controllers\HomeController;

// Admin
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDriverController;
use App\Http\Controllers\AdminPassengerController;

// Driver
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverPerjalananController;
use App\Http\Controllers\DriverHistoryController;

// Passenger
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\PassengerPemesananController;
use App\Http\Controllers\PassengerPerjalananController;
use App\Http\Controllers\PassengerHistoryController;
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
Route::post('/register', [RegisterController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    Route::middleware(['checkRole:0'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index']);
        Route::get('/list-pengemudi', [AdminDriverController::class, 'index']);
        Route::get('/list-penumpang', [AdminPassengerController::class, 'index']);
    });

    Route::middleware(['checkRole:1'])->group(function () {
        Route::get('/passenger', [PassengerController::class, 'index']);
        Route::get('/passenger/pemesanan', [PassengerPemesananController::class, 'index']);
        Route::get('/passenger/perjalanan', [PassengerPerjalananController::class, 'index']);
        Route::get('/passenger/history', [PassengerHistoryController::class, 'index']);
    });

    Route::middleware(['checkRole:2'])->group(function () {
        Route::get('/driver', [DriverController::class, 'index']);
        Route::get('/driver/perjalanan', [DriverPerjalananController::class, 'index']);
        Route::get('/driver/history', [DriverHistoryController::class, 'index']);
    });
});
