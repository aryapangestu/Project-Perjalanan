<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        if (in_array($request->user()->role, $role) && in_array($request->user()->status, [1])) {
            return $next($request);
        }

        // logout
        // Ini akan menghapus informasi otentikasi dari sesi pengguna sehingga permintaan berikutnya tidak diautentikasi.
        Auth::logout();

        // invalidate sesi pengguna
        $request->session()->invalidate();

        // membuat ulang token CSRF user
        $request->session()->regenerateToken();

        return redirect(RouteServiceProvider::HOME);
    }
}
