<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Driver;
use App\Models\Ride;

class AdminDriverController extends Controller
{
    // Method yang digunakan untuk menampilkan halaman list/data driver
    public function index()
    {
        return view('admin.dashboard.list-pengemudi', [
            "title" => "List-pengemudi Admin",
            "users" => User::all(),
            "rides" => Ride::all()
        ]);
    }

    // Method yang digunakan untuk halaman detail sesuai driver yang dipilih
    public function showDetail($id)
    {
        return view('admin.dashboard.detailList-pengemudi', [
            "title" => "List-pengemudi Admin",
            "rides" => Ride::where('driver_id', $id)->where('status', 1)->get()
        ]);
    }

    // Method yang digunakan untuk halaman view map sesuai detail yang dipilih
    public function showView($id)
    {
        return view('admin.dashboard.viewList-pengemudi', [
            "title" => "List-pengemudi Admin",
            "ride" => Ride::where('id', $id)->first()
        ]);
    }

    // Method yang digunakan untuk mengubah status driver
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
}
