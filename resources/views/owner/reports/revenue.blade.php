@extends('owner.layouts.app')

@section('title', 'Laporan Pendapatan')
@section('page-title', 'Laporan Pendapatan')
@section('page-description', 'Pantau dan kelola informasi pendapatan Martana Futsal.')

@section('content')

<section class="stats">
    <div class="stat-card">
        <p>Total Pendapatan Terverifikasi</p>
        <h2>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
        <small>Akumulasi pembayaran terverifikasi sesuai filter</small>
    </div>

    <div class="stat-card">
        <p>Total Transaksi</p>
        <h2>{{ number_format($totalTransactions, 0, ',', '.') }}</h2>
        <small>Jumlah pembayaran terverifikasi</small>
    </div>

    <div class="stat-card">
        <p>Rata-rata Transaksi</p>
        <h2>
            Rp {{ number_format(
                $totalTransactions > 0 ? $totalRevenue / $totalTransactions : 0,
                0, ',', '.'
            ) }}
        </h2>
        <small>Rata-rata nilai setiap transaksi</small>
    </div>
</section>

<section class="panel">
    <div class="panel-header">
        <div>
            <h3>Filter Laporan Pendapatan</h3>
        </div>
    </div>

    <form action="{{ route('owner.reports.revenue') }}"
          method="GET"
          class="filter-form">

        <div class="filter-group">
            <label for="start_date">Dari Tanggal</label>
            <input type="date"
                   id="start_date"
                   name="start_date"
                   value="{{ request('start_date') }}">
        </div>

        <div class="filter-group">
            <label for="end_date">Sampai Tanggal</label>
            <input type="date"
                   id="end_date"
                   name="end_date"
                   value="{{ request('end_date') }}">
        </div>

        <button type="submit" class="btn btn-primary">
            Terapkan Filter
        </button>

        <a href="{{ route('owner.reports.revenue') }}"
           class="btn btn-light">
            Reset
        </a>
    </form>
</section>

<section class="panel">
    <div class="panel-header">
        <h3>Riwayat Pendapatan</h3>
        <span style="font-size:12px;color:#819087;">
            {{ $payments->total() }} transaksi
        </span>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID PEMBAYARAN</th>
                    <th>ID BOOKING</th>
                    <th>TANGGAL</th>
                    <th>METODE PEMBAYARAN</th>
                    <th>TOTAL PEMBAYARAN</th>
                    <th>STATUS</th>
                </tr>
            </thead>

            <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td><strong>{{ $payment->id_pembayaran }}</strong></td>
                        <td>{{ $payment->id_booking }}</td>

                        <td>
                            {{ $payment->tanggal_pembayaran
                                ? \Carbon\Carbon::parse($payment->tanggal_pembayaran)->format('d/m/Y')
                                : '-' }}
                        </td>

                        <td>{{ $payment->metode_pembayaran ?: '-' }}</td>

                        <td>
                            <strong>
                                Rp {{ number_format($payment->total_pembayaran, 0, ',', '.') }}
                            </strong>
                        </td>

                        <td>
                            <span class="status success">
                                Terverifikasi
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada pembayaran terverifikasi pada periode ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        <span>
            Menampilkan {{ $payments->firstItem() ?? 0 }}
            sampai {{ $payments->lastItem() ?? 0 }}
            dari {{ $payments->total() }} data
        </span>

        {{ $payments->links() }}
    </div>
</section>

@endsection