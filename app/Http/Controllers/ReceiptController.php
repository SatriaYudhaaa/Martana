<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class ReceiptController extends Controller
{
    public function show($id)
    {
        $payment = Payment::where('id_pembayaran', $id)
            ->firstOrFail();

        abort_unless(
            $payment->status_pembayaran === 'lunas',
            403,
            'Kuitansi tersedia setelah pembayaran dikonfirmasi.'
        );

        return view('receipt.show', compact('payment'));
    }
}
