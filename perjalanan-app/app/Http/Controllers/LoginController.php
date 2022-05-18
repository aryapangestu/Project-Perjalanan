<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//  Import Auth facade
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Method menuju ke view login index
    public function index()
    {
        return view('login.index',  [
            "title" => "login"
        ]);
    }

    // Method untuk melakukan login atau melakukan Authenticating Users
    public function authenticate(Request $request)
    {
        // Melakukan validasi email dan password
        $credentials = $request->validate([
            // email harus terisi dan formatnya email
            'email' => ['required', 'email'],
            // password harus terisi
            'password' => ['required'],
        ]);

        // Digunakan untuk menangani upaya autentikasi dari formulir "login" aplikasi
        if (Auth::attempt($credentials)) {
            // Membuat ulang sesi pengguna untuk mencegah fiksasi sesi
            $request->session()->regenerate();

            // Redirect route sesuai role user
            if (Auth::user()->role == 0) {
                return redirect('/dashboard');
            } else if (Auth::user()->role == 1) {
                return redirect('/passenger');
            } else if (Auth::user()->role == 2) {
                return redirect('/driver');
            } else {
                // jika role tidak ada maka login failed dengan mengirim pesan alert loginError yang berisi Login failed!
                return back()->with('loginError', 'Login failed!');
            }
        }

        // jika login gagal/user atau password user tidak tersedia maka akan kembali/back view
        // dengan mengirim pesan alert loginError yang berisi Login failed!
        return back()->with('loginError', 'Login failed!');
    }


    // Mengeluarkan user dari aplikasi
    public function logout(Request $request)
    {
        // Ini akan menghapus informasi otentikasi dari sesi pengguna sehingga permintaan berikutnya tidak diautentikasi.
        Auth::logout();

        // invalidate sesi pengguna
        $request->session()->invalidate();

        // membuat ulang token CSRF user
        $request->session()->regenerateToken();

        // Setelah mengeluarkan pengguna maka akan mengarahkan pengguna ke root aplikasi
        return redirect('/');
    }
}
