<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentVerificationController extends Controller
{
    private function checkGuard()
    {
        $role = auth()->user()->role ?? '';

        abort_unless(
            in_array(strtolower($role), ['penjaga', 'owner']),
            403,
            'Kamu tidak memiliki akses ke halaman ini.'
        );
    }

    public function index()
    {
        $this->checkGuard();

        $payments = Payment::latest()->paginate(10);

        return view('guard.payments', compact('payments'));
    }

    public function verify($id)
    {
        $this->checkGuard();

        DB::transaction(function () use ($id) {
            $payment = Payment::where('id_pembayaran', $id)
                ->lockForUpdate()
                ->firstOrFail();

            abort_if(
                $payment->status_pembayaran === 'lunas',
                422,
                'Pembayaran sudah dikonfirmasi.'
            );

            $payment->update([
                'status_pembayaran' => 'lunas',
                'id_penjaga' => (string) auth()->id(),
                'verified_at' => now(),
                'catatan_verifikasi' => 'Pembayaran telah dikonfirmasi.',
            ]);
        });

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    public function reject(Request $request, $id)
    {
        $this->checkGuard();

        $request->validate([
            'catatan_verifikasi' => 'required|string|max:500',
        ]);

        $payment = Payment::where('id_pembayaran', $id)->firstOrFail();

        abort_if(
            $payment->status_pembayaran === 'lunas',
            422,
            'Pembayaran yang sudah lunas tidak dapat ditolak.'
        );

        $payment->update([
            'status_pembayaran' => 'ditolak',
            'id_penjaga' => (string) auth()->id(),
            'verified_at' => now(),
            'catatan_verifikasi' => $request->catatan_verifikasi,
        ]);

        return back()->with('success', 'Pembayaran ditolak.');
    }
}