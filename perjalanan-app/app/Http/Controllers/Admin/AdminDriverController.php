<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Driver;
use App\Models\Ride;

class AdminDriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.list-pengemudi', [
            "title" => "List-pengemudi Admin",
            "users" => User::all(),
            "rides" => Ride::all()
        ]);
    }

    public function showDetail($id)
    {
        return view('admin.dashboard.detailList-pengemudi', [
            "title" => "List-pengemudi Admin",
            "rides" => Ride::where('driver_id', $id)->where('status', 1)->get()
        ]);
    }

    public function showView($id)
    {
        return view('admin.dashboard.viewList-pengemudi', [
            "title" => "List-pengemudi Admin",
            "ride" => Ride::where('id', $id)->first()
        ]);
    }

    public function updateDriverStatus($id)
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
