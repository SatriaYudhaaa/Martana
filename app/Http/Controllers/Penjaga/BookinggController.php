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

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking ini sudah diproses.');
        }

        $booking->update([
            'status' => 'confirmed',
        ]);

        return back()->with('success', 'Booking berhasil dikonfirmasi.');
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

        return back()->with('success', 'Booking berhasil dibatalkan.');
    }
}