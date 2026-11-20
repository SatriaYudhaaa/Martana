@extends('penjaga.layouts.app')

@section('content')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

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
        min-width: 1050px;
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
        vertical-align: middle;
    }

    .status {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
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
        white-space: nowrap;
    }

    .proof-link:hover {
        text-decoration: underline;
    }

    .no-proof {
        color: #87938b;
        font-size: 12px;
    }

    .action-form {
        display: flex;
        gap: 7px;
        align-items: center;
    }

    .action-btn {
        border: 0;
        border-radius: 7px;
        padding: 8px 10px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        white-space: nowrap;
    }

    .confirm-btn {
        background: #e2f5e9;
        color: #207346;
    }

    .confirm-btn:hover {
        background: #c9ecd6;
    }

    .cancel-btn {
        background: #fde8e7;
        color: #b33c35;
    }

    .cancel-btn:hover {
        background: #fbd4d2;
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

    .waiting-action {
        color: #9a6900;
        font-size: 11px;
        font-weight: 600;
    }
</style>

<div class="booking-heading">
    <h2>Data Booking</h2>
    <p>Periksa pemesanan dan bukti pembayaran pelanggan.</p>
</div>

{{-- NOTIFIKASI --}}
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

                    @php
                        $method = strtolower($booking->payment_method ?? '');

                        $isTransfer = in_array($method, ['bca', 'dana']);

                        $hasProof = !empty($booking->proof_transfer);

                        $canConfirm = $booking->status === 'pending'
                            && !empty($method)
                            && (!$isTransfer || $hasProof);

                        $statusClass = match ($booking->status) {
                            'pending' => 'pending',
                            'confirmed' => 'confirmed',
                            'cancelled' => 'cancelled',
                            default => 'pending',
                        };
                    @endphp

                    <tr>

                        {{-- KODE BOOKING --}}
                        <td>
                            <strong>
                                BKG-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}
                            </strong>
                        </td>

                        {{-- PELANGGAN --}}
                        <td>
                            {{ $booking->customer_name ?? '-' }}
                            <br>
                            <small style="color:#87938b;">
                                {{ $booking->phone ?? '-' }}
                            </small>
                        </td>

                        {{-- LAPANGAN --}}
                        <td>
                            {{ $booking->court->name ?? '-' }}
                        </td>

                        {{-- TANGGAL --}}
                        <td>
                            {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d M Y') }}
                        </td>

                        {{-- JAM --}}
                        <td>
                            {{ substr($booking->start_time, 0, 5) }}
                            -
                            {{ substr($booking->end_time, 0, 5) }}
                        </td>

                        {{-- TOTAL --}}
                        <td>
                            <strong>
                                Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                            </strong>
                        </td>

                        {{-- METODE PEMBAYARAN --}}
                        <td>
                            @if ($method === 'bca')
                                <strong>BCA</strong>
                            @elseif ($method === 'dana')
                                <strong>DANA</strong>
                            @elseif ($method === 'cash')
                                <strong>Cash</strong>
                            @else
                                <span style="color:#87938b;">
                                    Belum dipilih
                                </span>
                            @endif
                        </td>

                        {{-- BUKTI PEMBAYARAN --}}
                        <td>
                            @if ($hasProof)

                                <a class="proof-link"
                                   href="{{ Storage::disk('public')->url($booking->proof_transfer) }}"
                                   target="_blank"
                                   rel="noopener noreferrer">

                                    <i class="bi bi-image"></i>
                                    Lihat Bukti

                                </a>

                            @elseif ($method === 'cash')

                                <span style="color:#207346;font-weight:600;">
                                    Bayar di Tempat
                                </span>

                            @else

                                <span class="no-proof">
                                    Belum ada bukti
                                </span>

                            @endif
                        </td>

                        {{-- STATUS --}}
                        <td>
                            <span class="status {{ $statusClass }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>

                        {{-- AKSI --}}
                        <td>

                            @if ($canConfirm)

                                <div class="action-form">

                                    {{-- KONFIRMASI --}}
                                    <form action="{{ route('penjaga.booking.confirm', $booking->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Pastikan pembayaran sudah diperiksa. Yakin ingin mengonfirmasi booking ini?')">

                                        @csrf

                                        <button type="submit"
                                                class="action-btn confirm-btn">

                                            <i class="bi bi-check-circle"></i>
                                            Konfirmasi

                                        </button>

                                    </form>

                                    {{-- BATALKAN --}}
                                    <form action="{{ route('penjaga.booking.cancel', $booking->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin membatalkan booking ini?')">

                                        @csrf

                                        <button type="submit"
                                                class="action-btn cancel-btn">

                                            <i class="bi bi-x-circle"></i>
                                            Batalkan

                                        </button>

                                    </form>

                                </div>

                            @elseif ($booking->status === 'pending' && $isTransfer && !$hasProof)

                                <span class="waiting-action">
                                    Menunggu bukti
                                </span>

                            @elseif ($booking->status === 'pending' && !$method)

                                <span class="waiting-action">
                                    Menunggu pembayaran
                                </span>

                            @else

                                <span style="color:#87938b;">
                                    -
                                </span>

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

    {{-- PAGINATION --}}
    <div style="margin-top:18px;">
        {{ $bookings->links() }}
    </div>

</div>

@endsection