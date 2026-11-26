<?php

namespace App\Http\Controllers\Penjaga;

use App\Http\Controllers\Controller;
use App\Models\Court;
use Illuminate\Http\Request;

class KelolaLapanganController extends Controller
{
    // MENAMPILKAN DATA LAPANGAN
    public function index()
    {
        $courts = Court::withCount('bookings')
            ->orderBy('name')
            ->paginate(10);

        $totalCourts = Court::count();

        $activeCourts = Court::where('is_active', true)->count();

        $inactiveCourts = Court::where('is_active', false)->count();

        return view('penjaga.lapangan.index', compact(
            'courts',
            'totalCourts',
            'activeCourts',
            'inactiveCourts'
        ));
    }

    // TAMBAH LAPANGAN
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price_per_hour' => ['required', 'numeric', 'min:1'],
            'is_active' => ['required', 'boolean'],
        ], [
            'name.required' => 'Nama lapangan wajib diisi.',
            'price_per_hour.required' => 'Harga lapangan wajib diisi.',
            'price_per_hour.numeric' => 'Harga harus berupa angka.',
            'price_per_hour.min' => 'Harga minimal Rp1.',
            'is_active.required' => 'Status lapangan wajib dipilih.',
        ]);

        Court::create($validated);

        return redirect()
            ->route('penjaga.lapangan.index')
            ->with('success', 'Data lapangan berhasil ditambahkan.');
    }

    // EDIT LAPANGAN
    public function update(Request $request, $id)
    {
        $court = Court::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price_per_hour' => ['required', 'numeric', 'min:1'],
            'is_active' => ['required', 'boolean'],
        ], [
            'name.required' => 'Nama lapangan wajib diisi.',
            'price_per_hour.required' => 'Harga lapangan wajib diisi.',
            'price_per_hour.numeric' => 'Harga harus berupa angka.',
            'price_per_hour.min' => 'Harga minimal Rp1.',
            'is_active.required' => 'Status lapangan wajib dipilih.',
        ]);

        $court->update($validated);

        return redirect()
            ->route('penjaga.lapangan.index')
            ->with('success', 'Data lapangan berhasil diperbarui.');
    }

    // HAPUS LAPANGAN
    public function destroy($id)
    {
        $court = Court::withCount('bookings')->findOrFail($id);

        // Mencegah riwayat booking ikut terhapus
        if ($court->bookings_count > 0) {
            return redirect()
                ->route('penjaga.lapangan.index')
                ->with(
                    'error',
                    'Lapangan tidak dapat dihapus karena memiliki riwayat booking. Silakan nonaktifkan lapangan.'
                );
        }

        $court->delete();

        return redirect()
            ->route('penjaga.lapangan.index')
            ->with('success', 'Data lapangan berhasil dihapus.');
    }
}