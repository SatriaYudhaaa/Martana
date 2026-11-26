<?php

namespace App\Http\Controllers\Penjaga;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // MENAMPILKAN DATA TRANSAKSI
    public function index()
    {
        $transaksi = Booking::with('court')
            ->where('status', 'confirmed')
            ->latest('booking_date')
            ->paginate(10);

        return view('penjaga.transaksi.index', compact('transaksi'));
    }

    // MENAMPILKAN KWITANSI TRANSAKSI
    public function kwitansi($id)
    {
        $booking = Booking::with('court')
            ->where('status', 'confirmed')
            ->findOrFail($id);

        return view('penjaga.transaksi.kwitansi', compact('booking'));
    }

    // MENGHAPUS TRANSAKSI
    public function destroy($id)
    {
        $booking = Booking::where('status', 'confirmed')
            ->findOrFail($id);

        DB::transaction(function () use ($booking) {

            // Hapus data pembayaran terkait
            DB::table('payments')
                ->where('id_booking', (string) $booking->id)
                ->delete();

            // Hapus data booking/transaksi
            $booking->delete();
        });

        return redirect()
            ->route('penjaga.transaksi')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    // DOWNLOAD SELURUH DATA TRANSAKSI PDF
    public function exportPdf()
    {
        $transaksi = Booking::with('court')
            ->where('status', 'confirmed')
            ->orderByDesc('booking_date')
            ->orderByDesc('start_time')
            ->get();

        $pdf = Pdf::loadView(
            'penjaga.transaksi.pdf',
            compact('transaksi')
        )->setPaper('a4', 'landscape');

        return $pdf->download(
            'laporan-transaksi-' . now()->format('Y-m-d') . '.pdf'
        );
    }
}