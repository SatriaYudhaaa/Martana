<?php

namespace App\Http\Controllers\Penjaga;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PresensiController extends Controller
{
    public function index()
    {
        $attendance = DB::table('presensis')
            ->where('user_id', Auth::id())
            ->where('tanggal', now()->toDateString())
            ->first();

        return view('penjaga.presensi.index', compact('attendance'));
    }

    public function masuk()
    {
        $userId = Auth::id();
        $tanggal = now()->toDateString();

        $sudahPresensi = DB::table('presensis')
            ->where('user_id', $userId)
            ->where('tanggal', $tanggal)
            ->exists();

        if ($sudahPresensi) {
            return redirect()
                ->route('penjaga.presensi')
                ->with('info', 'Kamu sudah melakukan presensi masuk hari ini.');
        }

        DB::table('presensis')->insert([
            'user_id' => $userId,
            'tanggal' => $tanggal,
            'jam_masuk' => now()->format('H:i:s'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('penjaga.presensi')
            ->with('success', 'Berhasil melakukan presensi masuk.');
    }
}
