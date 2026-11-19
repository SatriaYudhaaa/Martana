<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Menampilkan halaman login pengelola
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    // Memproses login Owner dan penjaga
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::guard('admin')->attempt(
            $credentials,
            $request->boolean('remember')
        )) {
            $request->session()->regenerate();

            $admin = Auth::guard('admin')->user();

            if ($admin->role === 'owner') {
                return redirect()->route('owner.dashboard');
            }

            if ($admin->role === 'penjaga') {
                return redirect()->route('penjaga.dashboard');
            }

            Auth::guard('admin')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Role akun tidak dikenali.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Logout pengelola
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Kamu berhasil logout.');
    }
}