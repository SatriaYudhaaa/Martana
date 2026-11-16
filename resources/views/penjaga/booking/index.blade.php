
@extends('penjaga.layouts.app')

@section('content')

<style>
    .booking-heading {
        margin-bottom: 22px;
    }

    .booking-heading h2 {
        color: #183f32;
        font-size: 25px;
        font-weight: 700;
        margin: 0 0 6px;
    }

    .booking-heading p {
        color: #7b8790;
        font-size: 14px;
        margin: 0;
    }

    .booking-card {
        background: #fff;
        border: 1px solid #e8eee9;
        border-radius: 14px;
        padding: 20px;
    }

    .booking-table-wrap {
        overflow-x: auto;
        margin-top: 18px;
    }

    .booking-table {
        width: 100%;
        min-width: 950px;
        border-collapse: collapse;
    }

    .booking-table th {
        background: #f5f8f5;
        color: #637168;
        font-size: 12px;
        padding: 13px;
        text-align: left;
        white-space: nowrap;
    }

    .booking-table td {
        padding: 14px 13px;
        border-bottom: 1px solid #edf1ed;
        color: #39483f;
        font-size: 13px;
    }

    .status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .pending {
        background: #fff3d9;
        color: #9a6900;
    }

    .confirmed {
        background: #e2f5e9;
        color: #207346;
    }

    .cancelled {
        background: #fde8e7;
        color: #b33c35;
    }

    .proof-link {
        color: #176b3a;
        font-weight: 700;
        text-decoration: none;
    }

    .proof-link:hover {
        text-decoration: underline;
    }

    .action-form {
        display: flex;
        gap: 7px;
    }

    .action-btn {
        border: 0;
        border-radius: 7px;
        padding: 8px 10px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .confirm-btn {
        background: #e2f5e9;
        color: #207346;
    }

    .cancel-btn {
        background: #fde8e7;
        color: #b33c35;
    }

    .message {
        padding: 12px 15px;
        border-radius: 9px;
        margin-bottom: 16px;
        font-size: 14px;
    }

    .success-message {
        background: #e2f5e9;
        color: #207346;
    }

    .error-message {
        background: #fde8e7;
        color: #b33c35;
    }

    .empty-message {
        text-align: center;
        padding: 28px !important;
        color: #87938b !important;
    }
</style>

<div class="booking-heading">
    <h2>Data Booking</h2>
    <p>Periksa pemesanan dan bukti pembayaran pelanggan.</p>
</div>

@if (session('success'))
    <div class="message success-message">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="message error-message">
        {{ session('error') }}
    </div>
@endif

<div class="booking-card">
    <h3 style="font-size:17px;font-weight:700;color:#183f32;margin:0;">
        Daftar Pemesanan
    </h3>

    <div class="booking-table-wrap">
        <table class="booking-table">
            <thead>
                <tr>
                    <th>Kode Booking</th>
                    <th>Pelanggan</th>
                    <th>Lapangan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Total</th>
                    <th>Metode</th>
                    <th>Bukti Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>
                            BKG-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}
                        </td>

                        <td>{{ $booking->customer_name }}</td>

                        <td>{{ $booking->court->name ?? $booking->field ?? '-' }}</td>

                        <td>{{ $booking->booking_date }}</td>

                        <td>
                            {{ substr($booking->start_time, 0, 5) }}
                            -
                            {{ substr($booking->end_time, 0, 5) }}
                        </td>

                        <td>
                            Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ strtoupper($booking->payment_method ?? 'Belum dipilih') }}
                        </td>

                        <td>
                            @if ($booking->proof_transfer)
                                <a class="proof-link"
                                   href="{{ asset('storage/' . $booking->proof_transfer) }}"
                                   target="_blank">
                                    Lihat Bukti Transfer
                                </a>
                            @elseif ($booking->payment_method === 'cash')
                                <span>Bayar di Tempat</span>
                            @else
                                <span style="color:#87938b;">Belum ada bukti</span>
                            @endif
                        </td>

                        <td>
                            <span class="status {{ $booking->status }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>

                        <td>
                            @if ($booking->status === 'pending' && $booking->payment_method)
                                <div class="action-form">
                                    <form action="{{ route('penjaga.booking.confirm', $booking->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin mengonfirmasi booking ini?')">
                                        @csrf
                                        <button type="submit" class="action-btn confirm-btn">
                                            Konfirmasi
                                        </button>
                                    </form>

                                    <form action="{{ route('penjaga.booking.cancel', $booking->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin membatalkan booking ini?')">
                                        @csrf
                                        <button type="submit" class="action-btn cancel-btn">
                                            Batalkan
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span style="color:#87938b;">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="empty-message">
                            Belum ada data booking.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:18px;">
        {{ $bookings->links() }}
    </div>
</div>

@endsection