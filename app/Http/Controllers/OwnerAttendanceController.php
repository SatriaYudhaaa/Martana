<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class OwnerAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'bulan' => 'nullable|date_format:Y-m',
            'guard_id' => 'nullable|integer',
        ]);

        $bulan = $request->input('bulan', now()->format('Y-m'));
        $guardId = $request->input('guard_id');

        $awalBulan = Carbon::createFromFormat('Y-m', $bulan)
            ->startOfMonth();

        $akhirBulan = $awalBulan->copy()->endOfMonth();

        // Bulan berjalan hanya sampai hari ini.
        // Bulan lampau menampilkan seluruh tanggal.
        $tanggalAkhir = $akhirBulan->greaterThan(now())
            ? now()->copy()->startOfDay()
            : $akhirBulan;

        // Daftar penjaga aktif
        $guardsQuery = DB::table('admins')
            ->where('role', 'penjaga')
            ->where('is_active', true)
            ->orderBy('name');

        if ($guardId) {
            $guardsQuery->where('id', $guardId);
        }

        $guards = $guardsQuery->get(['id', 'name']);

        // Ambil seluruh catatan presensi dalam bulan
        $attendanceRecords = DB::table('guard_attendances')
            ->whereIn('guard_id', $guards->pluck('id'))
            ->whereBetween('attendance_date', [
                $awalBulan->toDateString(),
                $tanggalAkhir->toDateString()
            ])
            ->get()
            ->keyBy(function ($item) {
                return $item->guard_id . '_' .
                    Carbon::parse($item->attendance_date)->format('Y-m-d');
            });

        // Buat rekap setiap tanggal untuk setiap penjaga
        $dailyRecap = collect();

        if ($tanggalAkhir->greaterThanOrEqualTo($awalBulan)) {
            $period = CarbonPeriod::create(
                $awalBulan,
                $tanggalAkhir
            );

            foreach ($period as $date) {
                foreach ($guards as $guard) {
                    $tanggal = $date->format('Y-m-d');

                    $key = $guard->id . '_' . $tanggal;

                    $record = $attendanceRecords->get($key);

                    $hadir = $record
                        && $record->check_in
                        && $record->status === 'hadir';

                    $dailyRecap->push((object) [
                        'name' => $guard->name,
                        'attendance_date' => $tanggal,
                        'check_in' => $record?->check_in,
                        'status' => $hadir
                            ? 'Hadir'
                            : 'Belum Presensi',
                    ]);
                }
            }
        }

        // Rekap jumlah
        $totalGuards = $guards->count();

        $totalCheckins = $dailyRecap
            ->where('status', 'Hadir')
            ->count();

        $totalBelumPresensi = $dailyRecap
            ->where('status', 'Belum Presensi')
            ->count();

        $totalHariPresensi = $dailyRecap
            ->where('status', 'Hadir')
            ->pluck('attendance_date')
            ->unique()
            ->count();

        return view('owner.attendances.index', compact(
            'bulan',
            'guardId',
            'guards',
            'dailyRecap',
            'totalGuards',
            'totalCheckins',
            'totalBelumPresensi',
            'totalHariPresensi'
        ))->with('activeMenu', 'attendances');
    }
}
