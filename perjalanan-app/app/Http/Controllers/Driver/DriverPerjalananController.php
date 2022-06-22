<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverPerjalananController extends Controller
{
    // Method yang digunakan untuk menampilkan halaman perjalanan driver
    public function index()
    {
        return view('driver.dashboard.perjalanan', [
            "title" => "Perjalanan Driver",
            "rides" => Ride::where('vehicle_type', Auth::user()->driver->vehicle->vehicle_type)
                ->where('status', 0)
                ->where('driver_id', null)
                ->get(),
            "perjalanan_ride" => Ride::where('vehicle_type', Auth::user()->driver->vehicle->vehicle_type)
                ->where('status', 0)
                ->where('driver_id', Auth::user()->id)
                ->first(),
            "driver" => Driver::where('user_id', Auth::user()->id)->first()
        ]);
    }

    // Method yang digunakan untuk menampilkan view map pada perjalanan yang dipilih
    public function showView($id)
    {
        return view('driver.dashboard.viewPerjalanan', [
            "title" => "Perjalanan Driver",
            "ride" => Ride::where('id', $id)->first()
        ]);
    }

    // Method yang digunakan untuk mengubah status Perjalanan berhasil diambil
    public function updateRideDriver($id)
    {
        $update = array('driver_id' => Auth::user()->id);
        Ride::where('id', $id)->update($update);
        return redirect('/driver/perjalanan')->with('alert', 'Perjalanan berhasil diambil');
    }

    // Method yang digunakan untuk mengubah status Selamat Anda telah menyelesaikan perjalanan
    public function updateRideStatus($id)
    {
        $update = array('status' => 1);
        Ride::where('id', $id)->update($update);

        return redirect('/driver/perjalanan')->with('alert', 'Selamat Anda telah menyelesaikan perjalanan');
    }
}
