<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerPerjalananController extends Controller
{
    // Method yang digunakan untuk menampilkan halaman perjalanan penumpang
    public function index()
    {
        if (
            Ride::where('passenger_id', Auth::user()->id)
            ->where('status', 0)
            ->first() == null
        ) {
            $temp =  null;
        } else {
            $temp =  Ride::where('passenger_id', Auth::user()->id)
                ->where('status', 0)
                ->first();
        }
        return view('passenger.dashboard.perjalanan', [
            "title" => "Perjalanan Passenger",
            "ride" => $temp
        ]);
    }
}
