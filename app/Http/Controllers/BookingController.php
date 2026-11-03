<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Court;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->input(
            'tanggal',
            now()->toDateString()
        );

        $courts = Court::where('is_active', true)->get();

        $bookings = Booking::with('court')
            ->whereDate('booking_date', $tanggal)
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('start_time')
            ->get();

        return view('booking.index', compact(
            'courts',
            'bookings',
            'tanggal'
        ));
    }

    public function history()
    {
        $bookings = Booking::with('court')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('booking.history', compact('bookings'));
    }
}