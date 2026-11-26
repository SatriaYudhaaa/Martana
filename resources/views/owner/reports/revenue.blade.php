@extends('owner.layouts.app')

@section('title', 'Laporan Pendapatan')
@section('page-title', 'Laporan Pendapatan')
@section('page-description', 'Pantau dan kelola informasi pendapatan Martana Futsal.')

@section('content')

<style>
    .revenue-stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
    }

    .revenue-stat-icon,
    .section-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: #e8f5ed;
        color: #236b4c;
        flex-shrink: 0;
    }

    .section-icon {
        width: 36px;
        height: 36px;
        border-radius: 9px;
    }

    .revenue-stat-icon svg,
    .section-icon svg,
    .btn-icon svg,
    .revenue-status svg {
        width: 20px;
        height: 20px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .revenue-section-title {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-icon {
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }

    .revenue-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .revenue-status svg {
        width: 14px;
        height: 14px;
    }
</style>

<!-- STATISTIK PENDAPATAN -->
<section class="stats">

    <div class="stat-card">
        <div class="revenue-stat-top">
            <p>Total Pendapatan Terverifikasi</p>
            <div class="revenue-stat-icon">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="5" width="18" height="14" rx="2"/>
                    <path d="M3 10h18"/>
                    <path d="M7 15h3"/>
                    <path d="M16 15h1"/>
                </svg>
            </div>
        </div>

        <h2>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
        <small>Akumulasi pembayaran terverifikasi sesuai filter</small>
    </div>

    <div class="stat-card">
        <div class="revenue-stat-top">
            <p>Total Transaksi</p>
            <div class="revenue-stat-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M8 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8l-5-5z"/>
                    <path d="M14 3v5h7"/>
                    <path d="M8 13h8M8 17h8"/>
                </svg>
            </div>
        </div>

        <h2>{{ number_format($totalTransactions, 0, ',', '.') }}</h2>
        <small>Jumlah pembayaran terverifikasi</small>
    </div>

    <div class="stat-card">
        <div class="revenue-stat-top">
            <p>Rata-rata Transaksi</p>
            <div class="revenue-stat-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M3 3v18h18"/>
                    <path d="m7 14 4-4 4 3 6-7"/>
                </svg>
            </div>
        </div>

        <h2>
            Rp {{ number_format(
                $totalTransactions > 0 ? $totalRevenue / $totalTransactions : 0,
                0, ',', '.'
            ) }}
        </h2>
        <small>Rata-rata nilai setiap transaksi</small>
    </div>

</section>

<!-- FILTER LAPORAN -->
<section class="panel">

    <div class="panel-header">
        <div class="revenue-section-title">
            <div class="section-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M4 5h16M7 12h10M10 19h4"/>
                    <path d="M6 5v7M18 5v7"/>
                </svg>
            </div>

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
            <span class="btn-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M4 5h16M7 12h10M10 19h4"/>
                </svg>
                Terapkan Filter
            </span>
        </button>

        <a href="{{ route('owner.reports.revenue') }}"
           class="btn btn-light">
            <span class="btn-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M3 12a9 9 0 1 0 3-6.7L3 8"/>
                    <path d="M3 3v5h5"/>
                </svg>
                Reset
            </span>
        </a>

    </form>
</section>

<!-- RIWAYAT PENDAPATAN -->
<section class="panel">

    <div class="panel-header">

        <div class="revenue-section-title">
            <div class="section-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M8 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8l-5-5z"/>
                    <path d="M14 3v5h7"/>
                    <path d="M8 13h8M8 17h8"/>
                </svg>
            </div>

            <h3>Riwayat Pendapatan</h3>
        </div>

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
                        <td>
                            <strong>{{ $payment->id_pembayaran }}</strong>
                        </td>

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
                            <span class="status success revenue-status">
                                <svg viewBox="0 0 24 24">
                                    <path d="m5 12 4 4L19 6"/>
                                </svg>
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