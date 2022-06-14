<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 0) {
            return view('admin.dashboard.index', [
                "title" => "Dashboard Admin",
                "total_passenger" => User::all()->where('role', 1)->count(),
                "total_driver" => User::all()->where('role', 2)->count(),
            ]);
        }

        if (Auth::user()->role == 1) {
            return view('passenger.dashboard.index', [
                "title" => "Dashboard Passenger",
                "total_ride" => Ride::all()->where('passenger_id', Auth::user()->id)->count(),
            ]);
        }

        if (Auth::user()->role == 2) {
            return view('driver.dashboard.index', [
                "title" => "Dashboard Driver",
                "driver" => Driver::where('user_id', Auth::user()->id)->first(),
                "total_ride" => Ride::all()->where('driver_id', Auth::user()->id)->count(),
            ]);
        }
    }
}
