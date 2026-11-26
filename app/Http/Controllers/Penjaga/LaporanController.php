<?php

namespace App\Http\Controllers\Penjaga;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis_laporan' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ], [
            'judul.required' => 'Judul laporan wajib diisi.',
            'jenis_laporan.required' => 'Jenis laporan wajib dipilih.',
            'file.required' => 'File laporan wajib diunggah.',
            'file.mimes' => 'Format file harus PDF, Word, atau Excel.',
            'file.max' => 'Ukuran file maksimal 10 MB.',
        ]);

        $admin = Auth::guard('admin')->user();

        // Simpan file ke storage/app/private/laporan
        $filePath = $request->file('file')->store('laporan');

        // Simpan informasi laporan ke database
        Laporan::create([
            'uploaded_by' => $admin->id,
            'judul' => $request->judul,
            'jenis_laporan' => $request->jenis_laporan,
            'keterangan' => $request->keterangan,
            'file_path' => $filePath,
        ]);

        return back()->with('success', 'Laporan berhasil diunggah!');
    }
}
