<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerHistoryController extends Controller
{
    // Method yang digunakan untuk menampilkan halamana riwayat penumpang
    public function index()
    {
        return view('passenger.dashboard.history', [
            "title" => "Riwayat Passenger",
            "histories" => Ride::where('passenger_id', Auth::user()->id)
                ->where('status', 1)
                ->get()
        ]);
    }

    // Method yang digunakan untuk view map pada riwayat yang telah dipilih
    public function showView($id)
    {
        return view('passenger.dashboard.viewHistory', [
            "title" => "Riwayat Passenger",
            "ride" => Ride::where('id', $id)->first()
        ]);
    }

    // Method yang digunakan untuk memasukan ulasan pada table reviews sesuai riwayat yang telah dipilih
    public function storeUlasan(Request $request, $id)
    {
        $validated = $request->validate([
            'rate' => 'required',
            'review' => 'required',
        ]);
        $review = Review::create($validated);

        $temp['review_id'] = $review->id;
        Ride::where('id', $id)->update($temp);
        return redirect('/passenger/history')->with('alert', 'Ulasan berhasil ditambahkan!');
    }
}
