<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    // Menampilkan halaman booking
    public function index(Request $request)
    {
        $tanggal = $request->query('tanggal', now()->toDateString());

        if (!strtotime($tanggal)) {
            $tanggal = now()->toDateString();
        }

        $courts = Court::where('is_active', true)->get();

        $bookings = Booking::where('booking_date', $tanggal)
            ->whereIn('status', ['pending', 'confirmed'])
            ->get();

        return view('booking.index', compact(
            'tanggal',
            'courts',
            'bookings'
        ));
    }

// Menyimpan booking dan mengarahkan ke pembayaran
public function store(Request $request)
{
    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'court_id' => 'required|exists:courts,id',
        'booking_date' => 'required|date|after_or_equal:today',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
    ]);

    $court = Court::where('is_active', true)
        ->findOrFail($validated['court_id']);

    // Pastikan jadwal belum dipesan
    $isBooked = Booking::where('court_id', $court->id)
        ->where('booking_date', $validated['booking_date'])
        ->whereIn('status', ['pending', 'confirmed'])
        ->where('start_time', '<', $validated['end_time'])
        ->where('end_time', '>', $validated['start_time'])
        ->exists();

    if ($isBooked) {
        return back()
            ->withInput()
            ->withErrors([
                'start_time' => 'Jadwal ini sudah dibooking. Silakan pilih jam lain.',
            ]);
    }

    $start = Carbon::createFromFormat('H:i', $validated['start_time']);
    $end = Carbon::createFromFormat('H:i', $validated['end_time']);

    $durationHours = $start->diffInMinutes($end) / 60;

    $validated['duration_hours'] = $durationHours;
    $validated['total_price'] = (int) (
        $durationHours * $court->price_per_hour
    );
    $validated['status'] = 'pending';

    $booking = Booking::create($validated);

    return redirect()->route('payment.show', $booking->id);
}
}