<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if(!Auth::check()){
            return redirect('/auth/login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        if(Auth::user()->role !== $role){
            // Redirect ke halaman utama berdasarkan role pengguna dengan pesan error
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            } else if (Auth::user()->role === 'dokter') {
                return redirect('/dokter/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            } else {
                return redirect('/pasien/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }
        }

        return $next($request);
    }
}