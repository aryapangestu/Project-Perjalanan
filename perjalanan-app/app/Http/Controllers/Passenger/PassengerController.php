<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerController extends Controller
{
    // Method yang digunakan untuk halaman dashboard penumpang
    public function index()
    {
        return view('passenger.dashboard.index', [
            "title" => "Dashboard Passenger",
            "total_ride" => Ride::all()->where('passenger_id', Auth::user()->id)->count(),
        ]);
    }
}
