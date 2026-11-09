<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class OwnerGuardController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        $dayName = $today->format('l');

        // TOTAL PENJAGA
        $totalGuards = DB::table('admins')
            ->where('role', 'penjaga')
            ->count();

        $activeGuards = DB::table('admins')
            ->where('role', 'penjaga')
            ->where('is_active', true)
            ->count();

        // JADWAL SHIFT HARI INI
        $todaySchedules = DB::table('guard_schedules')
            ->join('admins', 'guard_schedules.guard_id', '=', 'admins.id')
            ->where('admins.role', 'penjaga')
            ->where('admins.is_active', true)
            ->where('guard_schedules.day_of_week', $dayName)
            ->where('guard_schedules.is_active', true)
            ->select(
                'guard_schedules.*',
                'admins.name',
                'admins.phone'
            )
            ->orderBy('guard_schedules.start_time')
            ->get();

        // PRESENSI HARI INI
        $todayAttendances = DB::table('guard_attendances')
            ->whereDate('attendance_date', $today)
            ->get()
            ->keyBy('guard_id');

        $presentToday = $todayAttendances
            ->where('status', 'hadir')
            ->count();

        $scheduledToday = $todaySchedules->pluck('guard_id')->unique()->count();

        $absentToday = max(0, $scheduledToday - $presentToday);

        $attendanceRate = $scheduledToday > 0
            ? round(($presentToday / $scheduledToday) * 100)
            : 0;

        // PENCARIAN DAN DAFTAR PENJAGA
        $search = $request->input('search');

        $guardsQuery = DB::table('admins')
            ->where('role', 'penjaga')
            ->select('id', 'name', 'email', 'phone', 'is_active');

        if ($search) {
            $guardsQuery->where(function ($query) use ($search) {
                $query->where('name', 'ilike', "%{$search}%")
                    ->orWhere('phone', 'ilike', "%{$search}%")
                    ->orWhere('email', 'ilike', "%{$search}%");
            });
        }

        $guards = $guardsQuery
            ->orderBy('name')
            ->paginate(5)
            ->withQueryString();

        // REKAP KEHADIRAN MINGGU INI
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();

        $weeklyPresent = DB::table('guard_attendances')
            ->whereBetween('attendance_date', [
                $weekStart->toDateString(),
                $weekEnd->toDateString()
            ])
            ->where('status', 'hadir')
            ->count();

        $weeklyTotal = DB::table('guard_attendances')
            ->whereBetween('attendance_date', [
                $weekStart->toDateString(),
                $weekEnd->toDateString()
            ])
            ->count();

        $weeklyRate = $weeklyTotal > 0
            ? round(($weeklyPresent / $weeklyTotal) * 100)
            : 0;

        return view('owner.guards.index', compact(
            'totalGuards',
            'activeGuards',
            'presentToday',
            'absentToday',
            'attendanceRate',
            'guards',
            'search',
            'todaySchedules',
            'todayAttendances',
            'weeklyPresent',
            'weeklyTotal',
            'weeklyRate'
        ))->with('activeMenu', 'guards');
    }

    // TAMBAH PENJAGA
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8',
        ]);

        DB::table('admins')->insert([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => 'penjaga',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('owner.guards.index')
            ->with('success', 'Penjaga berhasil ditambahkan.');
    }

    // EDIT PENJAGA
    public function update(Request $request, $id)
    {
        $guard = DB::table('admins')
            ->where('id', $id)
            ->where('role', 'penjaga')
            ->first();

        abort_if(!$guard, 404);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('admins', 'email')->ignore($id),
            ],
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8',
            'is_active' => 'required|boolean',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'is_active' => $validated['is_active'],
            'updated_at' => now(),
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        DB::table('admins')
            ->where('id', $id)
            ->where('role', 'penjaga')
            ->update($data);

        return redirect()
            ->route('owner.guards.index')
            ->with('success', 'Data penjaga berhasil diperbarui.');
    }

    // HAPUS PENJAGA
    public function destroy($id)
    {
        $guard = DB::table('admins')
            ->where('id', $id)
            ->where('role', 'penjaga')
            ->first();

        abort_if(!$guard, 404);

        DB::table('admins')
            ->where('id', $id)
            ->where('role', 'penjaga')
            ->delete();

        return redirect()
            ->route('owner.guards.index')
            ->with('success', 'Penjaga berhasil dihapus.');
    }
}