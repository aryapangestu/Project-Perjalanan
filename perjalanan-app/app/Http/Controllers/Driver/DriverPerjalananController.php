<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverPerjalananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRideDriver($id)
    {
        $update = array('driver_id' => Auth::user()->id);
        Ride::where('id', $id)->update($update);
        return redirect('/driver/perjalanan')->with('alert', 'Perjalanan berhasil diambil');
    }

    public function updateRideStatus($id)
    {
        $update = array('status' => 1);
        Ride::where('id', $id)->update($update);

        return redirect('/driver/perjalanan')->with('alert', 'Selamat Anda telah menyelesaikan perjalanan');
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
        //
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
