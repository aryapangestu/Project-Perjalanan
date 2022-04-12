<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Events\Login;
use Symfony\Component\HttpKernel\DependencyInjection\RegisterLocaleAwareServicesPass;

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

// AdminPanel
Route::get('/', [AdminController::class, 'index'])->middleware('auth');
Route::get('/dashboard', [AdminController::class, 'index'])->middleware('auth');
Route::get('/list-pengemudi', [AdminDriverController::class, 'index'])->middleware('auth');
Route::get('/list-penumpang', [AdminPassengerController::class, 'index'])->middleware('auth');

// Driver
Route::get('/driver', [DriverController::class, 'index'])->middleware('auth');
Route::get('/driver/perjalanan', [DriverPerjalananController::class, 'index'])->middleware('auth');
Route::get('/driver/history', [DriverHistoryController::class, 'index'])->middleware('auth');

// Passenger
Route::get('/passenger', [PassengerController::class, 'index'])->middleware('auth');
Route::get('/passenger/pemesanan', [PassengerPemesananController::class, 'index'])->middleware('auth');
Route::get('/passenger/perjalanan', [PassengerPerjalananController::class, 'index'])->middleware('auth');
Route::get('/passenger/history', [PassengerHistoryController::class, 'index'])->middleware('auth');
