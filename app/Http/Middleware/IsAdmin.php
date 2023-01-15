<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->roles == 'ADMIN') {
            return $next($request);
        } elseif (Auth::user()->roles == 'KARYAWAN') {
            return redirect('/karyawan/dashboard');
        } elseif (Auth::user()->roles == 'KEUANGAN') {
            return redirect('/keuangan/dashboard');
        } elseif (Auth::user()->roles == 'PARTNER') {
            return redirect('/partner/dashboard');
        } elseif (Auth::user()->roles == 'SEKRETARIS') {
            return redirect('/sekretaris/dashboard');
        }
        return redirect('/');
    }
}
