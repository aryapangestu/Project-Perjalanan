<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverHistoryController extends Controller
{
    // Method yang digunakan untuk menampilkan halaman riwayat driver
    public function index()
    {
        return view('driver.dashboard.history', [
            "title" => "Riwayat Driver",
            "histories" => Ride::where('driver_id', Auth::user()->id)
                ->where('status', 1)
                ->get()
        ]);
    }

    // Method yang digunakan untuk menampilkan halaman vie detail dari riwayat yang dipilih
    public function showView($id)
    {
        return view('driver.dashboard.viewHistory', [
            "title" => "Riwayat Driver",
            "ride" => Ride::where('id', $id)->first()
        ]);
    }
}
