@extends('penjaga.layouts.app')

@section('title', 'Data Booking')
@section('page-title', 'Data Booking')
@section('page-description', 'Periksa pemesanan dan bukti pembayaran pelanggan.')

@section('content')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

<style>
    .booking-card {
        background: #fff;
        border: 1px solid #e8eee9;
        border-radius: 14px;
        padding: 20px;
    }

    .booking-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 18px;
    }

    .booking-table-wrap {
        overflow-x: auto;
        margin-top: 18px;
    }

    .booking-table {
        width: 100%;
        min-width: 1100px;
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

    .action-form {
        display: flex;
        gap: 7px;
        align-items: center;
        flex-wrap: wrap;
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

    .confirm-btn,
    .edit-btn,
    .add-btn {
        background: #e2f5e9;
        color: #207346;
    }

    .cancel-btn,
    .delete-btn {
        background: #fde8e7;
        color: #b33c35;
    }

    .add-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 11px 15px;
        border: 0;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
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

    .waiting-action {
        color: #9a6900;
        font-size: 11px;
        font-weight: 600;
    }

    /* MODAL */
    .booking-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(10, 25, 19, .58);
        z-index: 2000;
        align-items: center;
        justify-content: center;
        padding: 18px;
    }

    .booking-modal.show {
        display: flex;
    }

    .booking-modal-panel {
        background: #fff;
        border-radius: 15px;
        width: min(720px, 100%);
        max-height: 92vh;
        overflow-y: auto;
        padding: 22px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, .2);
    }

    .booking-modal-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .booking-modal-head h3 {
        font-size: 19px;
        color: #183f32;
        margin: 0;
    }

    .modal-close {
        border: 0;
        background: #eef3ef;
        border-radius: 8px;
        width: 34px;
        height: 34px;
        font-size: 20px;
        cursor: pointer;
        color: #42534a;
    }

    .booking-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .booking-field {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .booking-field label {
        font-size: 12px;
        font-weight: 700;
        color: #42534a;
    }

    .booking-field input,
    .booking-field select {
        width: 100%;
        padding: 10px 11px;
        border: 1px solid #dce5df;
        border-radius: 8px;
        font: inherit;
        font-size: 13px;
        background: #fff;
    }

    .booking-field small {
        font-size: 11px;
        color: #84918b;
    }

    .booking-modal-actions {
        display: flex;
        gap: 9px;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .modal-submit {
        background: #08764f;
        color: #fff;
        border: 0;
        border-radius: 8px;
        padding: 10px 16px;
        font-weight: 700;
        cursor: pointer;
    }

    .modal-cancel {
        background: #eef3ef;
        color: #42534a;
        border: 0;
        border-radius: 8px;
        padding: 10px 16px;
        font-weight: 700;
        cursor: pointer;
    }

    @media(max-width: 650px) {
        .booking-form-grid {
            grid-template-columns: 1fr;
        }

        .booking-modal-panel {
            padding: 16px;
        }
    }
</style>

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

@if ($errors->any())
    <div class="message error-message">
        <strong>Data belum berhasil disimpan:</strong>

        <ul style="margin:7px 0 0 18px">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- TABEL BOOKING --}}
<div class="booking-card">

    <div class="booking-toolbar">

        <h3 style="font-size:17px;font-weight:700;color:#183f32;margin:0">
            Daftar Pemesanan
        </h3>

        {{-- TOMBOL DOWNLOAD PDF DAN TAMBAH BOOKING --}}
        <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">

            <a
                href="{{ route('penjaga.booking.export-pdf') }}"
                class="add-btn"
                style="background:#08764f;color:#fff;text-decoration:none;">

                <i class="bi bi-file-earmark-pdf"></i>
                Download PDF

            </a>

            <button
                type="button"
                class="add-btn"
                onclick="openCreateBooking()">

                <i class="bi bi-plus-lg"></i>
                Tambah Booking

            </button>

        </div>

    </div>

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

                        <small style="color:#87938b">
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

                    {{-- METODE --}}
                    <td>
                        @if ($method === 'bca')
                            <strong>BCA</strong>

                        @elseif ($method === 'dana')
                            <strong>DANA</strong>

                        @elseif ($method === 'cash')
                            <strong>Cash</strong>

                        @else
                            <span style="color:#87938b">
                                Belum dipilih
                            </span>
                        @endif
                    </td>

                    {{-- BUKTI PEMBAYARAN --}}
                    <td>

                        @if ($hasProof)

                            <a
                                class="proof-link"
                                href="{{ Storage::disk('public')->url($booking->proof_transfer) }}"
                                target="_blank"
                                rel="noopener noreferrer">

                                <i class="bi bi-image"></i>
                                Lihat Bukti

                            </a>

                        @elseif ($method === 'cash')

                            <span style="color:#207346;font-weight:600">
                                Bayar di Tempat
                            </span>

                        @else

                            <span style="color:#87938b;font-size:12px">
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

                        <div class="action-form">

                            {{-- EDIT DAN HAPUS --}}
                            @if (in_array($booking->status, ['pending', 'confirmed'], true))

                                <button
                                    type="button"
                                    class="action-btn edit-btn"
                                    onclick="openEditBooking(this)"

                                    data-update-url="{{ route('penjaga.booking.update', $booking->id) }}"
                                    data-customer="{{ $booking->customer_name }}"
                                    data-phone="{{ $booking->phone }}"
                                    data-court="{{ $booking->court_id }}"
                                    data-date="{{ \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d') }}"
                                    data-start="{{ substr($booking->start_time, 0, 5) }}"
                                    data-end="{{ substr($booking->end_time, 0, 5) }}"
                                    data-method="{{ $booking->payment_method }}">

                                    <i class="bi bi-pencil"></i>
                                    Edit

                                </button>

                                <form
                                    action="{{ route('penjaga.booking.destroy', $booking->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin menghapus BKG-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}? Data booking dan bukti pembayarannya akan dihapus permanen.')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-btn delete-btn">

                                        <i class="bi bi-trash"></i>
                                        Hapus

                                    </button>

                                </form>

                            @endif

                            {{-- KONFIRMASI DAN PEMBATALAN --}}
                            @if ($canConfirm)

                                <form
                                    action="{{ route('penjaga.booking.confirm', $booking->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Pastikan pembayaran sudah diperiksa. Yakin ingin mengonfirmasi booking ini?')">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="action-btn confirm-btn">

                                        <i class="bi bi-check-circle"></i>
                                        Konfirmasi

                                    </button>

                                </form>

                                <form
                                    action="{{ route('penjaga.booking.cancel', $booking->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin membatalkan booking ini?')">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="action-btn cancel-btn">

                                        <i class="bi bi-x-circle"></i>
                                        Batalkan

                                    </button>

                                </form>

                            @elseif ($booking->status === 'pending' && $isTransfer && !$hasProof)

                                <span class="waiting-action">
                                    Menunggu bukti
                                </span>

                            @elseif ($booking->status === 'pending' && !$method)

                                <span class="waiting-action">
                                    Menunggu pembayaran
                                </span>

                            @endif

                        </div>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="10"
                        style="text-align:center;padding:28px;color:#87938b">

                        Belum ada data booking.

                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    {{-- PAGINATION --}}
    <div style="margin-top:18px">
        {{ $bookings->links() }}
    </div>

</div>


{{-- MODAL TAMBAH DAN EDIT --}}
<div class="booking-modal" id="bookingModal" aria-hidden="true">

    <div
        class="booking-modal-panel"
        role="dialog"
        aria-modal="true"
        aria-labelledby="bookingModalTitle">

        <div class="booking-modal-head">

            <h3 id="bookingModalTitle">
                Tambah Booking
            </h3>

            <button
                type="button"
                class="modal-close"
                onclick="closeBookingModal()">

                &times;

            </button>

        </div>

        <form
            id="bookingForm"
            action="{{ route('penjaga.booking.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div id="bookingMethodField"></div>

            <div class="booking-form-grid">

                {{-- NAMA --}}
                <div class="booking-field">

                    <label for="modal_customer_name">
                        Nama pelanggan
                    </label>

                    <input
                        id="modal_customer_name"
                        name="customer_name"
                        type="text"
                        maxlength="255"
                        required>

                </div>

                {{-- TELEPON --}}
                <div class="booking-field">

                    <label for="modal_phone">
                        Nomor telepon
                    </label>

                    <input
                        id="modal_phone"
                        name="phone"
                        type="text"
                        maxlength="20"
                        required>

                </div>

                {{-- LAPANGAN --}}
                <div class="booking-field">

                    <label for="modal_court_id">
                        Lapangan
                    </label>

                    <select
                        id="modal_court_id"
                        name="court_id"
                        required>

                        <option value="">
                            Pilih lapangan
                        </option>

                        @foreach ($courts as $court)

                            <option
                                value="{{ $court->id }}"
                                {{ !$court->is_active ? 'disabled' : '' }}>

                                {{ $court->name }}
                                —
                                Rp{{ number_format($court->price_per_hour, 0, ',', '.') }}/jam

                                {{ !$court->is_active ? '(Nonaktif)' : '' }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- TANGGAL --}}
                <div class="booking-field">

                    <label for="modal_booking_date">
                        Tanggal booking
                    </label>

                    <input
                        id="modal_booking_date"
                        name="booking_date"
                        type="date"
                        min="{{ now()->toDateString() }}"
                        value="{{ now()->toDateString() }}"
                        required>

                </div>

                {{-- JAM MULAI --}}
                <div class="booking-field">

                    <label for="modal_start_time">
                        Jam mulai
                    </label>

                    <input
                        id="modal_start_time"
                        name="start_time"
                        type="time"
                        value="08:00"
                        required>

                </div>

                {{-- JAM SELESAI --}}
                <div class="booking-field">

                    <label for="modal_end_time">
                        Jam selesai
                    </label>

                    <input
                        id="modal_end_time"
                        name="end_time"
                        type="time"
                        value="09:00"
                        required>

                    <small>
                        Durasi harus kelipatan 1 jam.
                    </small>

                </div>

                {{-- METODE PEMBAYARAN --}}
                <div class="booking-field">

                    <label for="modal_payment_method">
                        Metode pembayaran
                    </label>

                    <select
                        id="modal_payment_method"
                        name="payment_method">

                        <option value="">
                            Belum dipilih
                        </option>

                        <option value="bca">BCA</option>
                        <option value="dana">DANA</option>
                        <option value="cash">Cash</option>

                    </select>

                </div>

                {{-- BUKTI PEMBAYARAN --}}
                <div class="booking-field">

                    <label for="modal_proof_transfer">
                        Bukti pembayaran (opsional)
                    </label>

                    <input
                        id="modal_proof_transfer"
                        name="proof_transfer"
                        type="file"
                        accept=".jpg,.jpeg,.png,.pdf">

                    <small>
                        JPG, PNG, atau PDF; maksimal 5 MB.
                    </small>

                </div>

            </div>

            <div class="booking-modal-actions">

                <button
                    type="button"
                    class="modal-cancel"
                    onclick="closeBookingModal()">

                    Batal

                </button>

                <button
                    type="submit"
                    class="modal-submit"
                    id="bookingSubmitButton">

                    Simpan Booking

                </button>

            </div>

        </form>

    </div>

</div>


{{-- JAVASCRIPT MODAL --}}
<script>

    const bookingModal = document.getElementById('bookingModal');

    const bookingForm = document.getElementById('bookingForm');

    const bookingStoreUrl = @json(route('penjaga.booking.store'));


    // BUKA MODAL TAMBAH
    function openCreateBooking() {

        bookingForm.reset();

        bookingForm.action = bookingStoreUrl;

        document.getElementById('bookingMethodField').innerHTML = '';

        document.getElementById('bookingModalTitle').textContent =
            'Tambah Booking';

        document.getElementById('bookingSubmitButton').textContent =
            'Tambah Booking';

        document.getElementById('modal_booking_date').value =
            new Date().toISOString().slice(0, 10);

        document.getElementById('modal_start_time').value = '08:00';

        document.getElementById('modal_end_time').value = '09:00';

        showBookingModal();
    }


    // BUKA MODAL EDIT
    function openEditBooking(button) {

        bookingForm.reset();

        bookingForm.action = button.dataset.updateUrl;

        document.getElementById('bookingMethodField').innerHTML =
            '<input type="hidden" name="_method" value="PUT">';

        document.getElementById('bookingModalTitle').textContent =
            'Edit Booking';

        document.getElementById('bookingSubmitButton').textContent =
            'Simpan Perubahan';

        document.getElementById('modal_customer_name').value =
            button.dataset.customer || '';

        document.getElementById('modal_phone').value =
            button.dataset.phone || '';

        document.getElementById('modal_court_id').value =
            button.dataset.court || '';

        document.getElementById('modal_booking_date').value =
            button.dataset.date || '';

        document.getElementById('modal_start_time').value =
            button.dataset.start || '';

        document.getElementById('modal_end_time').value =
            button.dataset.end || '';

        document.getElementById('modal_payment_method').value =
            button.dataset.method || '';

        showBookingModal();
    }


    // TAMPILKAN MODAL
    function showBookingModal() {

        bookingModal.classList.add('show');

        bookingModal.setAttribute('aria-hidden', 'false');

        document.body.style.overflow = 'hidden';
    }


    // TUTUP MODAL
    function closeBookingModal() {

        bookingModal.classList.remove('show');

        bookingModal.setAttribute('aria-hidden', 'true');

        document.body.style.overflow = '';
    }


    // KLIK DI LUAR MODAL
    bookingModal.addEventListener('click', function(event) {

        if (event.target === bookingModal) {
            closeBookingModal();
        }

    });


    // TUTUP DENGAN TOMBOL ESC
    document.addEventListener('keydown', function(event) {

        if (
            event.key === 'Escape' &&
            bookingModal.classList.contains('show')
        ) {
            closeBookingModal();
        }

    });

</script>

@endsection