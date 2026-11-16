<?php

namespace App\Http\Controllers\Penjaga;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Booking::with('court')
            ->where('status', 'confirmed')
            ->latest('booking_date')
            ->paginate(10);

        return view('penjaga.transaksi.index', compact('transaksi'));
    }

    // Menampilkan kwitansi transaksi
    public function kwitansi($id)
    {
        $booking = Booking::with('court')
            ->where('status', 'confirmed')
            ->findOrFail($id);

        return view('penjaga.transaksi.kwitansi', compact('booking'));
    }
}