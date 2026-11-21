<?php

namespace App\Http\Controllers\Penjaga;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    public function index()
    {
        $guard = Auth::guard('admin')->user();

        $attendance = DB::table('guard_attendances')
            ->where('guard_id', $guard->id)
            ->whereDate('attendance_date', now()->toDateString())
            ->first();

        return view('penjaga.presensi.index', compact('attendance'));
    }

    public function masuk()
    {
        $guard = Auth::guard('admin')->user();
        $tanggal = now()->toDateString();

        $sudahPresensi = DB::table('guard_attendances')
            ->where('guard_id', $guard->id)
            ->whereDate('attendance_date', $tanggal)
            ->exists();

        if ($sudahPresensi) {
            return redirect()
                ->route('penjaga.presensi')
                ->with('info', 'Kamu sudah melakukan presensi masuk hari ini.');
        }

        DB::table('guard_attendances')->insert([
            'guard_id' => $guard->id,
            'attendance_date' => $tanggal,
            'check_in' => now()->format('H:i:s'),
            'status' => 'hadir',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('penjaga.presensi')
            ->with('success', 'Berhasil melakukan presensi masuk.');
    }
}
