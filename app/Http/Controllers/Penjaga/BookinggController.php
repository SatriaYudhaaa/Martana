<?php

namespace App\Http\Controllers\Penjaga;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Court;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BookinggController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('court')
            ->latest()
            ->paginate(10);

        $courts = Court::orderBy('name')->get();

        return view('penjaga.booking.index', compact('bookings', 'courts'));
    }

    // DOWNLOAD SELURUH DATA BOOKING PDF
    public function exportPdf()
    {
        $bookings = Booking::with('court')
            ->orderByDesc('booking_date')
            ->orderByDesc('start_time')
            ->get();

        $pdf = Pdf::loadView('penjaga.booking.pdf', compact('bookings'))
            ->setPaper('a4', 'landscape');

        return $pdf->download(
            'laporan-booking-' . now()->format('Y-m-d') . '.pdf'
        );
    }

    // TAMBAH BOOKING
    public function store(Request $request)
    {
        $data = $this->validateBooking($request);

        $booking = DB::transaction(function () use ($data, $request) {

            $court = Court::where('is_active', true)
                ->lockForUpdate()
                ->findOrFail($data['court_id']);

            $duration = $this->validateDuration(
                $data['booking_date'],
                $data['start_time'],
                $data['end_time']
            );

            $this->ensureScheduleAvailable(
                $court->id,
                $data['booking_date'],
                $data['start_time'],
                $data['end_time']
            );

            $proofPath = $request->hasFile('proof_transfer')
                ? $request->file('proof_transfer')->store('bukti-transfer', 'public')
                : null;

            return Booking::create([
                'user_id' => null,
                'customer_name' => $data['customer_name'],
                'phone' => $data['phone'],
                'court_id' => $court->id,
                'booking_date' => $data['booking_date'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'duration_hours' => $duration,
                'total_price' => (int) round(
                    $duration * (float) $court->price_per_hour
                ),
                'status' => 'pending',
                'payment_method' => $data['payment_method'] ?? null,
                'proof_transfer' => $proofPath,
            ]);
        });

        return redirect()->route('penjaga.booking')
            ->with(
                'success',
                'Booking berhasil ditambahkan. Kode: BKG-' .
                str_pad($booking->id, 3, '0', STR_PAD_LEFT)
            );
    }

    // EDIT BOOKING
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if (!in_array($booking->status, ['pending', 'confirmed'], true)) {
            return back()->with(
                'error',
                'Booking cancelled tidak dapat diedit.'
            );
        }

        $data = $this->validateBooking($request);

        DB::transaction(function () use ($booking, $data, $request) {

            $court = Court::lockForUpdate()
                ->findOrFail($data['court_id']);

            if (
                !$court->is_active &&
                (int) $court->id !== (int) $booking->court_id
            ) {
                throw ValidationException::withMessages([
                    'court_id' => 'Lapangan yang dipilih sedang tidak aktif.',
                ]);
            }

            $duration = $this->validateDuration(
                $data['booking_date'],
                $data['start_time'],
                $data['end_time']
            );

            $this->ensureScheduleAvailable(
                $court->id,
                $data['booking_date'],
                $data['start_time'],
                $data['end_time'],
                $booking->id
            );

            $proofPath = $booking->proof_transfer;

            if ($request->hasFile('proof_transfer')) {

                $newPath = $request->file('proof_transfer')
                    ->store('bukti-transfer', 'public');

                if ($proofPath) {
                    Storage::disk('public')->delete($proofPath);
                }

                $proofPath = $newPath;
            }

            $booking->update([
                'customer_name' => $data['customer_name'],
                'phone' => $data['phone'],
                'court_id' => $court->id,
                'booking_date' => $data['booking_date'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'duration_hours' => $duration,
                'total_price' => (int) round(
                    $duration * (float) $court->price_per_hour
                ),
                'payment_method' => $data['payment_method'] ?? null,
                'proof_transfer' => $proofPath,

                // Status dan transaction_id tetap dipertahankan.
            ]);
        });

        return redirect()->route('penjaga.booking')
            ->with('success', 'Data booking berhasil diperbarui.');
    }

    // HAPUS BOOKING
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        if (!in_array($booking->status, ['pending', 'confirmed'], true)) {
            return back()->with(
                'error',
                'Hanya booking pending atau confirmed yang dapat dihapus.'
            );
        }

        if ($booking->proof_transfer) {
            Storage::disk('public')->delete($booking->proof_transfer);
        }

        $booking->delete();

        return redirect()->route('penjaga.booking')
            ->with('success', 'Booking berhasil dihapus.');
    }

    
    // KONFIRMASI PEMBAYARAN
    public function confirm($id)
    {
        DB::transaction(function () use ($id) {

            $booking = Booking::whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($booking->status !== 'pending') {
                throw ValidationException::withMessages([
                    'booking' => 'Booking ini sudah diproses.'
                ]);
            }

            if (empty($booking->payment_method)) {
                throw ValidationException::withMessages([
                    'payment_method' => 'Metode pembayaran belum dipilih.'
                ]);
            }

            if (
                in_array(strtolower($booking->payment_method), ['bca', 'dana']) &&
                empty($booking->proof_transfer)
            ) {
                throw ValidationException::withMessages([
                    'proof_transfer' => 'Bukti transfer belum tersedia.'
                ]);
            }

            $now = now();

            $payment = DB::table('payments')
                ->where('id_booking', (string) $booking->id)
                ->first();

            $paymentData = [
                'tanggal_pembayaran' => $now->toDateString(),
                'metode_pembayaran' => $booking->payment_method,
                'total_pembayaran' => $booking->total_price,
                'status_pembayaran' => 'terverifikasi',
                'bukti_pembayaran' => $booking->proof_transfer,
                'verified_at' => $now,
                'updated_at' => $now,
            ];

            if ($payment) {
                DB::table('payments')
                    ->where('id_booking', (string) $booking->id)
                    ->update($paymentData);
            } else {
                $paymentData['id_pembayaran'] =
                    \Illuminate\Support\Str::upper(
                        \Illuminate\Support\Str::random(15)
                    );

                $paymentData['id_booking'] = (string) $booking->id;
                $paymentData['id_penjaga'] = null;
                $paymentData['created_at'] = $now;

                DB::table('payments')->insert($paymentData);
            }

            $booking->update([
                'status' => 'confirmed'
            ]);
        });

        return back()->with(
            'success',
            'Pembayaran berhasil diverifikasi dan booking dikonfirmasi.'
        );
    }


    // FITUR LAMA: BATALKAN BOOKING
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== 'pending') {
            return back()->with(
                'error',
                'Booking ini sudah diproses.'
            );
        }

        $booking->update([
            'status' => 'cancelled'
        ]);

        return back()->with(
            'success',
            'Booking berhasil dibatalkan.'
        );
    }

    // VALIDASI INPUT BOOKING
    private function validateBooking(Request $request): array
    {
        return $request->validate([
            'customer_name' => [
                'required',
                'string',
                'max:255'
            ],

            'phone' => [
                'required',
                'string',
                'max:20'
            ],

            'court_id' => [
                'required',
                'integer',
                'exists:courts,id'
            ],

            'booking_date' => [
                'required',
                'date',
                'after_or_equal:today'
            ],

            'start_time' => [
                'required',
                'date_format:H:i'
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time'
            ],

            'payment_method' => [
                'nullable',
                'in:bca,dana,cash'
            ],

            'proof_transfer' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:5120'
            ],

        ], [
            'booking_date.after_or_equal' =>
                'Tanggal booking tidak boleh sebelum hari ini.',

            'proof_transfer.mimes' =>
                'Bukti pembayaran harus berupa JPG, PNG, atau PDF.',

            'proof_transfer.max' =>
                'Ukuran bukti pembayaran maksimal 5 MB.',
        ]);
    }

    // VALIDASI DURASI
    private function validateDuration(
        string $date,
        string $start,
        string $end
    ): int {

        $startAt = Carbon::parse($date . ' ' . $start);
        $endAt = Carbon::parse($date . ' ' . $end);

        $minutes = $startAt->diffInMinutes($endAt);

        if ($minutes <= 0 || $minutes % 60 !== 0) {
            throw ValidationException::withMessages([
                'end_time' =>
                    'Durasi booking harus dalam kelipatan 1 jam.',
            ]);
        }

        return (int) ($minutes / 60);
    }

    // CEK BENTROK JADWAL
    private function ensureScheduleAvailable(
        int $courtId,
        string $date,
        string $start,
        string $end,
        ?int $ignoreBookingId = null
    ): void {

        $query = Booking::where('court_id', $courtId)
            ->whereDate('booking_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('start_time', '<', $end)
            ->where('end_time', '>', $start);

        if ($ignoreBookingId) {
            $query->where('id', '!=', $ignoreBookingId);
        }

        if ($query->exists()) {
            throw ValidationException::withMessages([
                'start_time' =>
                    'Jadwal lapangan sudah terisi pada rentang waktu tersebut.',
            ]);
        }
    }
}