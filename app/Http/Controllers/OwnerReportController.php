<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerReportController extends Controller
{
    public function revenue(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = DB::table('payments')
            ->whereNotNull('verified_at');

        if ($startDate) {
            $query->whereDate('tanggal_pembayaran', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('tanggal_pembayaran', '<=', $endDate);
        }

        $totalRevenue = (clone $query)->sum('total_pembayaran');
        $totalTransactions = (clone $query)->count();

        $payments = $query
            ->orderByDesc('tanggal_pembayaran')
            ->paginate(15)
            ->withQueryString();

        return view('owner.reports.revenue', compact(
            'startDate',
            'endDate',
            'totalRevenue',
            'totalTransactions',
            'payments'
        ));
    }

    public function bookings(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');

        $query = DB::table('bookings')
            ->leftJoin('courts', 'bookings.court_id', '=', 'courts.id')
            ->leftJoin('users', 'bookings.user_id', '=', 'users.id')
            ->select(
                'bookings.*',
                'courts.name as court_name',
                'users.name as user_name'
            );

        if ($startDate) {
            $query->whereDate('bookings.booking_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('bookings.booking_date', '<=', $endDate);
        }

        if ($status) {
            $query->where('bookings.status', $status);
        }

        $totalBookings = (clone $query)->count();

        $bookings = $query
            ->orderByDesc('bookings.booking_date')
            ->orderByDesc('bookings.start_time')
            ->paginate(15)
            ->withQueryString();

        return view('owner.reports.bookings', compact(
            'startDate',
            'endDate',
            'status',
            'totalBookings',
            'bookings'
        ));
    }
}