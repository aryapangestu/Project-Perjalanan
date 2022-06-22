<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Passenger;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Method yang digunakan untuk menampilkan halaman registrasi
    public function index()
    {
        return view('register.index',  [
            "title" => "register"
        ]);
    }

    // Method yang digunakan untuk menyimpan data ke table users
    public function storePassenger(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'terms' => 'required',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 1;

        $user = User::create($validated);
        Passenger::create(['user_id' => $user->id]);

        return redirect('/login');
    }

    // Method yang digunakan untuk menyimpan data ke table drivers
    public function storeDriver(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'terms' => 'required',
            'vehicle_type' => 'required',
            'model' => 'required',
            'plat' => 'required',
        ]);
        $validated['password'] = Hash::make($validated['password']);

        $datVehicle['vehicle_type'] = $validated['vehicle_type'];
        unset($validated['vehicle_type']);

        $datVehicle['model'] = $validated['model'];
        unset($validated['model']);

        $datVehicle['plat'] = $validated['plat'];
        unset($validated['plat']);

        $vehicle = Vehicle::create($datVehicle);

        $validated['role'] = 2;
        $user = User::create($validated);
        Driver::create(['user_id' => $user->id, 'vehicle_id' => $vehicle->id]);

        return redirect('/login');
    }
}
