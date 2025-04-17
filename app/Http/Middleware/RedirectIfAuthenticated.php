<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                $userRole = $user->role;
                
                // Log detailed information
                Log::info('RedirectIfAuthenticated - User ID: ' . $user->id . ', Email: ' . $user->email . ', Role: ' . $userRole);
                
                if ($userRole === 'dokter') {
                    Log::info('RedirectIfAuthenticated - Redirecting to dokter dashboard');
                    return redirect('/dokter/dashboard');
                } 
                else if ($userRole === 'pasien') {
                    Log::info('RedirectIfAuthenticated - Redirecting to pasien dashboard');
                    return redirect('/pasien/dashboard');
                }
                else if ($userRole === 'admin') {
                    Log::info('RedirectIfAuthenticated - Redirecting to admin dashboard');
                    return redirect('/admin/dashboard');
                }
                else {
                    Log::info('RedirectIfAuthenticated - Redirecting to home (default)');
                    return redirect('/home');
                }
            }
        }

        return $next($request);
    }
}
