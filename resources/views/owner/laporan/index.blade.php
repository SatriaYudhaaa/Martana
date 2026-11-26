@extends('owner.layouts.app')

@section('title', 'Laporan Penjaga')
@section('page-title', 'Laporan Penjaga')
@section('page-description', 'Lihat dan unduh laporan yang telah diunggah oleh Penjaga Martana Futsal.')

@section('content')

<section class="stats">
    <div class="stat-card">
        <p>Total Laporan</p>
        <h2>{{ number_format($totalLaporan, 0, ',', '.') }}</h2>
        <small>Seluruh laporan yang telah diunggah Penjaga</small>
    </div>

    <div class="stat-card">
        <p>Laporan Ditampilkan</p>
        <h2>{{ $laporans->count() }}</h2>
        <small>Jumlah laporan pada halaman ini</small>
    </div>
</section>

<section class="panel">
    <div class="panel-header">
        <div>
            <h3>Daftar Laporan dari Penjaga</h3>
        </div>

        <span style="font-size:12px;color:#819087;">
            {{ $laporans->total() }} laporan
        </span>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>JUDUL LAPORAN</th>
                    <th>PENGUNGGAH</th>
                    <th>JENIS LAPORAN</th>
                    <th>KETERANGAN</th>
                    <th>TANGGAL UPLOAD</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>
                @forelse($laporans as $laporan)
                    <tr>
                        <td>
                            <strong>{{ $laporan->judul }}</strong>
                        </td>

                        <td>
                            {{ $laporan->penjaga->name ?? '-' }}
                        </td>

                        <td>
                            {{ $laporan->jenis_laporan }}
                        </td>

                        <td>
                            {{ $laporan->keterangan ?: '-' }}
                        </td>

                        <td>
                            {{ $laporan->created_at
                                ? $laporan->created_at->format('d/m/Y H:i')
                                : '-' }}
                        </td>

                        <td>
                            <a href="{{ route('owner.laporan-penjaga.view', $laporan->id) }}"
                            class="btn btn-light"
                            target="_blank">
                            Lihat
                        </a>
                        
                        <a href="{{ route('owner.laporan-penjaga.download', $laporan->id) }}"
                        class="btn btn-primary">
                        Download
                        </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada laporan yang diunggah oleh Penjaga.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        <span>
            Menampilkan {{ $laporans->firstItem() ?? 0 }}
            sampai {{ $laporans->lastItem() ?? 0 }}
            dari {{ $laporans->total() }} laporan
        </span>

        {{ $laporans->links() }}
    </div>
</section>

@endsection