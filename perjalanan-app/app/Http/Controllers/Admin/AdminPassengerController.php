<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.list-penumpang', [
            "title" => "List-penumpang Admin",
            "users" => User::all(),
            "rides" => Ride::all()
        ]);
    }

    public function showDetail($id)
    {
        return view('admin.dashboard.detailList-penumpang', [
            "title" => "List-penumpang Admin",
            "rides" => Ride::where('passenger_id', $id)->where('status', 1)->get()
        ]);
    }

    public function showView($id)
    {
        return view('admin.dashboard.viewList-penumpang', [
            "title" => "List-penumpang Admin",
            "ride" => Ride::where('id', $id)->first()
        ]);
    }

    public function updatepassengerStatus($id)
    {
        if (User::where('id', $id)->first()->status === 1) {
            $update = array('status' => 0);
        } else {
            $update = array('status' => 1);
        }
        User::where('id', $id)->update($update);
        return;
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
