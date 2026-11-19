<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Ambil akun dari guard admin
        $admin = Auth::guard('admin')->user();

        // Jika belum login sebagai pengelola
        if (!$admin) {
            return redirect()->route('admin.login');
        }

        // Periksa role akun
        if (!in_array($admin->role, $roles, true)) {
            abort(403, 'Kamu tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}