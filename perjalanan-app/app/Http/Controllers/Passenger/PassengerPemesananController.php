<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
