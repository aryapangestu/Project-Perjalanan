<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassengerHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('passenger.dashboard.history', [
            "title" => "Riwayat Passenger",
            "histories" => Ride::where('passenger_id', Auth::user()->id)
                ->where('status', 1)
                ->get()
        ]);
    }

    public function showView($id)
    {
        return view('passenger.dashboard.viewHistory', [
            "title" => "Riwayat Passenger",
            "ride" => Ride::where('id', $id)->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
