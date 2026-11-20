<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Memastikan booking memang milik customer yang login
    private function getCustomerBooking($id)
    {
        $booking = Booking::with('court')->findOrFail($id);

        abort_unless(
            (int) $booking->user_id === (int) Auth::guard('web')->id(),
            403,
            'Kamu tidak memiliki akses ke booking ini.'
        );

        return $booking;
    }

    // Halaman pembayaran
    public function show($id)
    {
        $booking = $this->getCustomerBooking($id);

        if ($booking->status !== 'pending') {
            return redirect()
                ->route('booking.index')
                ->with('error', 'Booking ini sudah diproses.');
        }

        return view('payment.show', compact('booking'));
    }

    // Mengirim pembayaran dan bukti transfer
    public function confirm(Request $request, $id)
    {
        $booking = $this->getCustomerBooking($id);

        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking ini sudah diproses.');
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:bca,dana,cash',

            'proof_transfer' => [
                'nullable',
                'required_if:payment_method,bca,dana',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ], [
            'payment_method.required' => 'Pilih metode pembayaran.',
            'payment_method.in' => 'Metode pembayaran tidak valid.',
            'proof_transfer.required_if' => 'Bukti transfer wajib diunggah.',
            'proof_transfer.image' => 'File harus berupa gambar.',
            'proof_transfer.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'proof_transfer.max' => 'Ukuran gambar maksimal 5 MB.',
        ]);

        // Mempertahankan bukti lama jika tidak ada upload baru
        $proofPath = $booking->proof_transfer;

        if ($request->hasFile('proof_transfer')) {
            $proofPath = $request->file('proof_transfer')
                ->store('proof-transfer', 'public');
        }

        // Pembayaran masuk, menunggu verifikasi penjaga
        $booking->update([
            'payment_method' => $validated['payment_method'],
            'proof_transfer' => $proofPath,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('payment.waiting', $booking->id)
            ->with(
                'success',
                'Pembayaran berhasil dikirim. Silakan tunggu verifikasi penjaga.'
            );
    }

    // Halaman status booking customer
    public function waiting($id)
    {
        $booking = $this->getCustomerBooking($id);

        // Tidak redirect ke invoice ketika sudah confirmed.
        // Halaman waiting akan berubah menjadi Booking Berhasil.
        return view('payment.waiting', compact('booking'));
    }

    // Halaman invoice dan download PNG
    public function receipt($id)
    {
        $booking = $this->getCustomerBooking($id);

        // Invoice hanya tersedia setelah dikonfirmasi penjaga
        abort_unless(
            $booking->status === 'confirmed',
            403,
            'Invoice tersedia setelah pembayaran dikonfirmasi.'
        );

        return view('payment.kwitansi', compact('booking'));
    }
}