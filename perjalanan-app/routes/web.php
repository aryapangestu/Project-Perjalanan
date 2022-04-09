<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPengemudiController;
use App\Http\Controllers\DashboardPenumpangController;
use App\Http\Controllers\RegisterController;

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

Route::get('/edit-tambah-detail-penumpang', function () {
    return view('Dashboard.edit-tambah-detail-penumpang', [
        "title" => "edit-tambah-detail-penumpang"
    ]);
});

Route::get('/edit-tambah-detail-pengemudi', function () {
    return view('Dashboard.edit-tambah-detail-pengemudi', [
        "title" => "edit-tambah-detail-pengemudi"
    ]);
});

// AdminPanel
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);

Route::get('/list-pengemudi', [DashboardPengemudiController::class, 'index']);

Route::get('/list-penumpang', [DashboardPenumpangController::class, 'index']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);


// Driver

// Passenger
