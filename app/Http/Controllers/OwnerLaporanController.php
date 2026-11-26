<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Support\Facades\Storage;

class OwnerLaporanController extends Controller
{
    // Menampilkan seluruh laporan dari Penjaga
    public function index()
    {
        $laporans = Laporan::with('penjaga')
            ->latest()
            ->paginate(10);

        $totalLaporan = Laporan::count();

        $activeMenu = 'laporan-penjaga';

        return view('owner.laporan.index', compact(
            'laporans',
            'totalLaporan',
            'activeMenu'
        ));
    }

    // Melihat file laporan di browser
    public function view($id)
    {
        $laporan = Laporan::findOrFail($id);

        if (!Storage::exists($laporan->file_path)) {
            abort(404, 'File laporan tidak ditemukan.');
        }

        $mimeType = Storage::mimeType($laporan->file_path);

        return response()->file(
            Storage::path($laporan->file_path),
            [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline; filename="' .
                    basename($laporan->file_path) . '"',
            ]
        );
    }

    // Mengunduh file laporan
    public function download($id)
    {
        $laporan = Laporan::findOrFail($id);

        if (!Storage::exists($laporan->file_path)) {
            abort(404, 'File laporan tidak ditemukan.');
        }

        return Storage::download(
            $laporan->file_path,
            basename($laporan->file_path)
        );
    }
}