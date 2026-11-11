<?php

namespace App\Http\Controllers\Penjaga;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class KelolaAkunController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Hanya tampilkan akun pelanggan
        // Sesuaikan kondisi role setelah kita cek struktur tabel users.

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'ilike', "%{$search}%")
                  ->orWhere('email', 'ilike', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('penjaga.kelola-akun.index', compact('users'));
    }
}
