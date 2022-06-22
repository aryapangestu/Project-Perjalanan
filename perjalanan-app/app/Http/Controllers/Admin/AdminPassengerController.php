<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPassengerController extends Controller
{
    // Method yang digunakan untuk menampilkan halaman list/data penumpang
    public function index()
    {
        return view('admin.dashboard.list-penumpang', [
            "title" => "List-penumpang Admin",
            "users" => User::all(),
            "rides" => Ride::all()
        ]);
    }

    // Method yang digunakan untuk halaman detail sesuai penumpang yang dipilih
    public function showDetail($id)
    {
        return view('admin.dashboard.detailList-penumpang', [
            "title" => "List-penumpang Admin",
            "rides" => Ride::where('passenger_id', $id)->where('status', 1)->get()
        ]);
    }

    // Method yang digunakan untuk halaman view map sesuai detail yang dipilih
    public function showView($id)
    {
        return view('admin.dashboard.viewList-penumpang', [
            "title" => "List-penumpang Admin",
            "ride" => Ride::where('id', $id)->first()
        ]);
    }

    // Method yang digunakan untuk mengubah status penumpang
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
}
