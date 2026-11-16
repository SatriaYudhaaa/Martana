<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show($id)
    {
        $booking = Booking::with('court')->findOrFail($id);

        return view('payment.show', compact('booking'));
    }

    public function confirm(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Simulasi pembayaran
        $booking->update([
            'status' => 'confirmed',
        ]);

        return redirect()
            ->route('booking.index', [
                'tanggal' => $booking->booking_date,
            ])
            ->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}