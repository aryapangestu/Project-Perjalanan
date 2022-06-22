<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerPemesananController extends Controller
{
    // Method yang digunakan untuk menampilkan halaman pemesanan penumpang
    public function index()
    {
        if (Ride::where('passenger_id', Auth::user()->id)->first() == null) {
            $temp =  -1;
        } else {
            $temp =  Ride::where('passenger_id', Auth::user()->id)->first()->value('status');
        }
        return view('passenger.dashboard.pemesanan', [
            "title" => "Pemesanan Passenger",
            "status" => $temp,

        ]);
    }

    // Method yang digunakan untuk menyimpan posisi titik jemput dan tujuan serta jenis kendaraan ke dalam table ride
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_type' => 'required',
            'pick_up_form_latitude' => 'required',
            'pick_up_form_longitude' => 'required',
            'drop_to_latitude' => 'required',
            'drop_to_longitude' => 'required',
            'amount' => 'required',
        ]);
        $validated['passenger_id'] = Auth::user()->id;

        Ride::create($validated);

        return redirect('/passenger/perjalanan')->with('alert', 'Pesanan berhasil ditambahkan, Silakan tunggu driver Anda');
    }
}
