<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Method yang digunakan untuk menampilkan halaman dashboard admin
    public function index()
    {
        return view('admin.dashboard.index', [
            "title" => "Dashboard Admin",
            "total_passenger" => User::all()->where('role', 1)->count(),
            "total_driver" => User::all()->where('role', 2)->count(),
        ]);
    }
}
