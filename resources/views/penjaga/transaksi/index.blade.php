@extends('penjaga.layouts.app')

@section('content')

<style>
    .transaction-heading {
        margin-bottom: 22px;
    }

    .transaction-heading h2 {
        color: #183f32;
        font-size: 25px;
        font-weight: 700;
        margin: 0 0 6px;
    }

    .transaction-heading p {
        color: #7b8790;
        font-size: 14px;
        margin: 0;
    }

    .transaction-card {
        background: #fff;
        border: 1px solid #e8eee9;
        border-radius: 14px;
        padding: 20px;
    }

    .transaction-table-wrap {
        overflow-x: auto;
        margin-top: 18px;
    }

    .transaction-table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .transaction-table th {
        background: #f5f8f5;
        color: #637168;
        font-size: 12px;
        padding: 13px;
        text-align: left;
    }

    .transaction-table td {
        padding: 14px 13px;
        border-bottom: 1px solid #edf1ed;
        color: #39483f;
        font-size: 13px;
    }

    .transaction-code {
        color: #1d6248;
        font-weight: 700;
    }

    .transaction-status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        background: #e2f5e9;
        color: #207346;
        font-size: 11px;
        font-weight: 700;
    }

    .btn-receipt {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        border: none;
        border-radius: 7px;
        background: #087f5b;
        color: white;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
        transition: .2s;
    }

    .btn-receipt:hover {
        background: #005640;
        color: white;
        transform: translateY(-1px);
    }

    .transaction-empty {
        text-align: center;
        padding: 30px !important;
        color: #87938b !important;
    }
</style>

<div class="transaction-heading">
    <h2>Data Transaksi</h2>
    <p>Daftar transaksi dari booking yang telah dikonfirmasi.</p>
</div>

<div class="transaction-card">
    <h3 style="font-size:17px;font-weight:700;color:#183f32;margin:0;">
        Riwayat Transaksi
    </h3>

    <div class="transaction-table-wrap">
        <table class="transaction-table">
            <thead>
                <tr>
                    <th>Kode Booking</th>
                    <th>Nama Pelanggan</th>
                    <th>Lapangan</th>
                    <th>Tanggal Booking</th>
                    <th>Jam</th>
                    <th>Total Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($transaksi as $item)
                    <tr>
                        <td class="transaction-code">
                            BKG-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}
                        </td>

                        <td>{{ $item->customer_name }}</td>

                        <td>{{ $item->court->name ?? '-' }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->booking_date)->format('d M Y') }}
                        </td>

                        <td>
                            {{ substr($item->start_time, 0, 5) }}
                            -
                            {{ substr($item->end_time, 0, 5) }}
                        </td>

                        <td>
                            Rp {{ number_format($item->total_price, 0, ',', '.') }}
                        </td>

                        <td>
                            <span class="transaction-status">Berhasil</span>
                        </td>

                        <td>
                            <a href="{{ route('penjaga.transaksi.kwitansi', $item->id) }}"
                               target="_blank"
                               class="btn-receipt">
                                <i class="bi bi-printer"></i>
                                Cetak Kwitansi
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="transaction-empty">
                            <i class="bi bi-receipt" style="font-size:30px;display:block;margin-bottom:8px;"></i>
                            Belum ada transaksi yang dikonfirmasi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:18px;">
        {{ $transaksi->links() }}
    </div>
</div>

@endsection