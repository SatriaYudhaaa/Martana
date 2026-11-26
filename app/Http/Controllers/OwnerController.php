<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OwnerController extends Controller
{
    public function dashboard()
    {
        // =====================================
        // 1. STATISTIK BOOKING
        // =====================================

        $totalBookings = DB::table('bookings')->count();

        $todayBookings = DB::table('bookings')
            ->whereDate('booking_date', today())
            ->count();


        // =====================================
        // 2. STATISTIK LAPANGAN
        // =====================================

        $totalCourts = DB::table('courts')->count();

        $activeCourts = DB::table('courts')
            ->where('is_active', true)
            ->count();


        // =====================================
        // 3. STATISTIK PENJAGA
        // =====================================

        $totalGuards = DB::table('admins')
            ->where('role', 'penjaga')
            ->count();


        // =====================================
        // 4. TOTAL PENDAPATAN TERVERIFIKASI
        // =====================================

        $totalRevenue = DB::table('payments')
            ->whereNotNull('verified_at')
            ->sum('total_pembayaran');


        // =====================================
        // 5. GRAFIK PENDAPATAN
        // NOVEMBER 2026 - 12 BULAN KE DEPAN
        // =====================================

        // Bulan pertama grafik adalah November 2026.
        $startMonth = Carbon::create(2026, 11, 1)->startOfMonth();

        // Batas akhir periode grafik.
        $endMonth = $startMonth->copy()->addMonths(12);

        // Ambil pendapatan dari pembayaran terverifikasi.
        $monthlyRevenue = DB::table('payments')
            ->selectRaw("
                TO_CHAR(tanggal_pembayaran, 'YYYY-MM') AS bulan,
                SUM(total_pembayaran) AS total
            ")
            ->whereNotNull('verified_at')
            ->whereNotNull('tanggal_pembayaran')
            ->whereDate('tanggal_pembayaran', '>=', $startMonth->toDateString())
            ->whereDate('tanggal_pembayaran', '<', $endMonth->toDateString())
            ->groupByRaw("TO_CHAR(tanggal_pembayaran, 'YYYY-MM')")
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        $chartLabels = [];
        $chartValues = [];

        // Membuat 12 bulan mulai November 2026.
        for ($i = 0; $i < 12; $i++) {

            $month = $startMonth->copy()->addMonths($i);

            $key = $month->format('Y-m');

            // Label bulan untuk grafik.
            $chartLabels[] = $month->translatedFormat('M Y');

            // Jika belum ada pembayaran, nilai pendapatan = 0.
            $chartValues[] = (float) ($monthlyRevenue[$key]->total ?? 0);
        }


        // =====================================
        // 6. BOOKING TERBARU
        // =====================================

        $recentBookings = DB::table('bookings')
            ->leftJoin('users', 'bookings.user_id', '=', 'users.id')
            ->leftJoin('courts', 'bookings.court_id', '=', 'courts.id')
            ->select(
                'bookings.id',
                'bookings.customer_name',
                'bookings.booking_date',
                'bookings.start_time',
                'bookings.end_time',
                'bookings.total_price',
                'bookings.status',
                'users.name as user_name',
                'courts.name as court_name'
            )
            ->orderByDesc('bookings.created_at')
            ->limit(8)
            ->get();


        // =====================================
        // 7. TAMPILKAN DASHBOARD
        // =====================================
        
        return view('owner.dashboard', compact(
            'totalBookings',
            'todayBookings',
            'totalRevenue',
            'totalCourts',
            'activeCourts',
            'totalGuards',
            'chartLabels',
            'chartValues',
            'recentBookings'
        ));
    }
}