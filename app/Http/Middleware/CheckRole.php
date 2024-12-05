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
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        $user = Auth::guard('web')->user();

        // Cek apakah pengguna memiliki role 'panel_user' dan mencegah login di admin Filament
        if ($user->role->name === 'pasien' && $request->is('admin') && !$request->is('admin/*') || $user->role->name === 'panel_user' && $request->is('admin') && !$request->is('admin/*')) {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Cek apakah pengguna memiliki role 'dokter', 'klinik', atau 'super_admin' dan mencegah login di user
        // if (in_array($user->role->name, ['dokter', 'klinik', 'super_admin']) && !$request->is('admin/*')) {
        //     return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        // }

        return $next($request);
    }
}
