<?php

namespace App\Http\Controllers\Penjaga;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class KelolaAkunController extends Controller
{
    
    public function index(Request $request)
    {
        // Query khusus akun pelanggan
        $baseQuery = User::where('role', 'pelanggan');

        // Statistik akun berdasarkan database
        $totalPelanggan = (clone $baseQuery)->count();

        $totalAktif = (clone $baseQuery)
            ->where('is_active', true)
            ->count();

        $totalNonaktif = (clone $baseQuery)
            ->where('is_active', false)
            ->count();

        // Query daftar pelanggan
        $query = User::where('role', 'pelanggan');

        // Pencarian nama atau email
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'ilike', "%{$search}%")
                  ->orWhere('email', 'ilike', "%{$search}%");
            });
        }

        // Filter status akun
        if ($request->status === 'aktif') {
            $query->where('is_active', true);
        } elseif ($request->status === 'nonaktif') {
            $query->where('is_active', false);
        }

        // Ambil data pelanggan
        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjaga.kelola-akun.index', compact(
            'users',
            'totalPelanggan',
            'totalAktif',
            'totalNonaktif'
        ));
    }
}
