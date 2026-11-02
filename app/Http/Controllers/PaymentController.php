<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    private function getBooking($id)
    {
        abort_unless(Schema::hasTable('bookings'), 500,
            'Tabel bookings belum tersedia. Sesuaikan dengan migration tim booking.');

        $booking = DB::table('bookings')
            ->where('id_booking', $id)
            ->first();

        abort_if(!$booking, 404, 'Data booking tidak ditemukan.');

        // Nilai harus berasal dari database, bukan input pelanggan.
        $amount = $booking->total_pembayaran
            ?? $booking->total_harga
            ?? null;

        abort_if($amount === null || $amount <= 0, 422,
            'Total booking belum tersedia. Hubungkan dengan perhitungan harga booking.');

        return [$booking, $amount];
    }

    public function create($bookingId)
    {
        [$booking, $amount] = $this->getBooking($bookingId);

        $payment = Payment::where('id_booking', $bookingId)->first();

        if ($payment) {
            return redirect()->route('payment.status', $payment->id_pembayaran);
        }

        return view('payment.index', compact(
            'booking', 'amount', 'bookingId'
        ));
    }

    public function store(Request $request, $bookingId)
    {
        [$booking, $amount] = $this->getBooking($bookingId);

        $request->validate([
            'metode_pembayaran' => 'required|in:dana,va,tunai',
            'bukti_pembayaran' => 'required_if:metode_pembayaran,dana,va|nullable|file|mimes:jpg,jpeg,png,pdf|max:3072',
        ]);

        $existing = Payment::where('id_booking', $bookingId)->first();

        if ($existing) {
            return redirect()->route('payment.status', $existing->id_pembayaran);
        }

        $proof = null;

        if ($request->hasFile('bukti_pembayaran')) {
            // Disimpan di private storage, bukan folder public.
            $proof = $request->file('bukti_pembayaran')
                ->store('payment-proofs');
        }

        $method = $request->metode_pembayaran;

        $payment = Payment::create([
            'id_pembayaran' => 'PAY' . Str::upper(Str::random(12)),
            'id_booking' => $bookingId,
            'tanggal_pembayaran' => now()->toDateString(),
            'metode_pembayaran' => $method,
            'total_pembayaran' => $amount,
            'status_pembayaran' => $method === 'tunai'
                ? 'menunggu_pembayaran_tunai'
                : 'menunggu_verifikasi',
            'bukti_pembayaran' => $proof,
        ]);

        return redirect()->route('payment.status', $payment->id_pembayaran)
            ->with('success', 'Data pembayaran berhasil disimpan.');
    }

    public function status($id)
    {
        $payment = Payment::where('id_pembayaran', $id)->firstOrFail();

        return view('payment.status', compact('payment'));
    }
}
