<?php

namespace App\Http\Controllers\Penjaga;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Court;
use App\Models\Laporan;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        // Booking hari ini
        $totalBookings = Booking::whereDate('booking_date', $today)
            ->whereIn('status', ['pending', 'confirmed'])
            ->count();

        // Total lapangan aktif
        $totalCourts = Court::where('is_active', true)->count();

        // Lapangan yang digunakan hari ini
        $courtsUsed = Booking::whereDate('booking_date', $today)
            ->whereIn('status', ['pending', 'confirmed'])
            ->distinct()
            ->count('court_id');

        // Jadwal booking hari ini
        $todayBookings = Booking::with('court')
            ->whereDate('booking_date', $today)
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('start_time')
            ->get();

        // Pendapatan dari booking yang sudah dikonfirmasi
        $todayRevenue = Booking::whereDate('booking_date', $today)
            ->where('status', 'confirmed')
            ->sum('total_price');

        // Total laporan yang sudah diunggah
        $pendingReports = Laporan::count();

        // Lima laporan terbaru
        $recentReports = Laporan::latest()
            ->take(5)
            ->get();

        // Data presensi
        $attendance = null;

        return view('penjaga.dashboard', compact(
            'totalBookings',
            'totalCourts',
            'courtsUsed',
            'todayRevenue',
            'pendingReports',
            'todayBookings',
            'recentReports',
            'attendance'
        ));
    }
}
