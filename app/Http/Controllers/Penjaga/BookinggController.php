<?php

namespace App\Http\Controllers\Penjaga;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookinggController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('court')
            ->latest()
            ->paginate(10);

        return view('penjaga.booking.index', compact('bookings'));
    }

    public function confirm($id)
    {
        $booking = Booking::findOrFail($id);

        // Pastikan booking belum diproses
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking ini sudah diproses.');
        }

        // Pastikan metode pembayaran sudah dipilih
        if (empty($booking->payment_method)) {
            return back()->with('error', 'Metode pembayaran belum dipilih.');
        }

        // Transfer wajib memiliki bukti pembayaran
        if (
            in_array(strtolower($booking->payment_method), ['bca', 'dana'])
            && empty($booking->proof_transfer)
        ) {
            return back()->with('error', 'Bukti transfer belum tersedia.');
        }

        // Konfirmasi pembayaran
        $booking->update([
            'status' => 'confirmed',
        ]);

        return back()->with(
            'success',
            'Pembayaran berhasil diverifikasi dan booking dikonfirmasi.'
        );
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking ini sudah diproses.');
        }

        $booking->update([
            'status' => 'cancelled',
        ]);

        return back()->with(
            'success',
            'Booking berhasil dibatalkan.'
        );
    }
}