<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    // Method yang digunakan untuk menampilkan dashboard driver
    public function index()
    {
        return view('driver.dashboard.index', [
            "title" => "Dashboard Driver",
            "driver" => Driver::where('user_id', Auth::user()->id)->first(),
            "total_ride" => Ride::all()->where('driver_id', Auth::user()->id)->count(),
        ]);
    }

    // Method yang digunakan untuk mengubah status ride driver
    public function updateDriverStatus($id)
    {
        if (Driver::where('user_id', $id)->first()->ride_status === 1) {
            $update = array('ride_status' => 0);
        } else {
            $update = array('ride_status' => 1);
        }
        Driver::where('user_id', $id)->update($update);
        return;
    }
}
