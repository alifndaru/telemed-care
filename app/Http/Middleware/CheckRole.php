<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ): Response
    {
      
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        // Periksa apakah pengguna memiliki role 'super_admin' pada guard 'admin'
        $user = Auth::guard('web')->user();
    //    dd($user);

        // Periksa apakah pengguna memiliki role admin
        if ($user->role->name !== 'super_admin') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
       
        return $next($request);
    }
}
