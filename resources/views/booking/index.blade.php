
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Lapangan - Martana Sport</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --green: #07866b;
            --green-dark: #05634f;
            --green-light: #d1fae5;
            --navy: #102746;
            --muted: #64748b;
            --border: #dce5ed;
            --background: #f1f8fb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            color: var(--navy);
            font-family: Arial, sans-serif;
        }

        /* NAVBAR */
        .navbar-custom {
            margin: 15px 28px 20px;
            padding: 12px 36px;
            background: white;
            border-radius: 23px;
            box-shadow: 0 5px 20px rgba(20, 50, 70, .08);
        }

        .brand {
            color: var(--green-dark);
            font-size: 23px;
            font-weight: 800;
            line-height: 1.05;
            text-decoration: none;
        }

        .brand small {
            display: block;
            font-size: 16px;
            letter-spacing: 1px;
        }

        .nav-link {
            color: var(--navy);
            font-weight: 600;
            padding: 14px 17px !important;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--green-dark);
        }

        .nav-link.active {
            border-bottom: 3px solid var(--green);
        }

        .profile-icon {
            width: 45px;
            height: 45px;
            display: grid;
            place-items: center;
            border: 2px solid var(--border);
            border-radius: 50%;
            color: var(--green);
            font-size: 23px;
        }

        /* HERO */
        .hero {
            margin: 0 33px 22px;
            min-height: 220px;
            padding: 35px 48px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            border-radius: 27px;
            color: white;
            background:
                linear-gradient(90deg, rgba(0,77,62,.98), rgba(0,112,87,.85), rgba(0,77,62,.15)),
                url('/images/banner-futsal.jpg') center/cover,
                linear-gradient(110deg, #05745d, #079a78);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero small {
            color: #b7eadb;
            font-weight: 700;
            letter-spacing: 3px;
        }

        .hero h1 {
            margin: 8px 0;
            font-size: clamp(34px, 4vw, 52px);
            font-weight: 800;
        }

        .hero p {
            margin: 0;
            font-size: 18px;
        }

        .hero-line {
            width: 75px;
            height: 4px;
            border-radius: 5px;
            background: #a7f3d0;
            margin-top: 17px;
        }

        /* DATE FILTER */
        .date-section {
            margin: 0 42px 22px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .date-icon {
            width: 72px;
            height: 68px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            color: var(--green);
            background: #e1f6f1;
            border: 1px solid #c6eee4;
            border-radius: 17px;
            font-size: 30px;
        }

        .date-description {
            flex: 1;
        }

        .date-description h5 {
            margin: 0 0 5px;
            font-size: 18px;
            font-weight: 800;
        }

        .date-description p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
        }

        .date-control {
            width: 300px;
            flex-shrink: 0;
        }

        .date-control input {
            min-height: 55px;
            border: 1px solid var(--border);
            border-radius: 17px;
            font-weight: 700;
            color: var(--navy);
        }

        .date-control input:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 .2rem rgba(7,134,107,.12);
        }

        /* MAIN LAYOUT */
        .content-area {
            margin: 0 42px 35px;
        }

        .court-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) 360px;
            gap: 22px;
            align-items: start;
        }

        /* COURT CARD */
        .court-card {
            background: white;
            border: 1px solid #e5edf2;
            border-radius: 19px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(20, 50, 70, .07);
            transition: .2s;
        }

        .court-card.active {
            border: 2px solid var(--green);
            box-shadow: 0 7px 20px rgba(7,134,107,.12);
        }

        .court-image {
    width: 100%;
    height: 220px;
    position: relative;
    overflow: hidden;
    background: #e2e8f0;
}

.court-image img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    object-position: center;
}

.court-card:hover .court-image img {
    transform: scale(1.02);
}

        .selected-check {
            position: absolute;
            top: -13px;
            right: -8px;
            z-index: 2;
            width: 40px;
            height: 40px;
            display: none;
            align-items: center;
            justify-content: center;
            border: 3px solid white;
            border-radius: 50%;
            background: var(--green);
            color: white;
            font-size: 20px;
        }

        .court-card.active .selected-check {
            display: flex;
        }

        .court-content {
            padding: 13px 16px 16px;
        }

        .court-name {
            font-size: 21px;
            font-weight: 800;
            margin: 0 0 4px;
        }

        .court-description {
            color: var(--muted);
            font-size: 13px;
            min-height: 20px;
        }

        /* FACILITIES */
        .facility-list {
    display: flex;
    align-items: center;
    gap: 25px;
    margin: 15px 0;
    padding: 12px 0;
    border-top: 1px solid #edf1f5;
    border-bottom: 1px solid #edf1f5;
}

.facility-info {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #475569;
    font-size: 13px;
    font-weight: 600;
}

.facility-info i {
    color: var(--green);
    font-size: 18px;
}

@media (max-width: 420px) {
    .facility-list {
        gap: 15px;
        flex-wrap: wrap;
    }
}

        /* PRICE */
        .court-price {
            color: var(--green-dark);
            font-size: 27px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .court-price small {
            color: var(--muted);
            font-size: 13px;
            font-weight: 400;
        }

        .schedule-title {
            padding-top: 10px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 8px;
        }

        /* TIME SLOTS */
        .time-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 8px;
        }

        .time-slot {
            min-height: 37px;
            border: 1px solid #d5dee8;
            border-radius: 25px;
            background: white;
            color: var(--navy);
            font-size: 12px;
            font-weight: 600;
            padding: 5px 3px;
            transition: .2s;
        }

        .time-slot:hover:not(:disabled) {
            border-color: var(--green);
            color: var(--green);
            background: #f0fdf8;
        }

        .time-slot.selected {
            color: white;
            background: var(--green-dark);
            border-color: var(--green-dark);
        }

        .time-slot:disabled {
            color: #8793a4;
            background: #eef1f4;
            cursor: not-allowed;
            text-decoration: line-through;
        }

        .time-slot i {
            margin-right: 3px;
        }

        /* SELECT COURT BUTTON */
        .select-court-btn {
            width: 100%;
            min-height: 47px;
            margin-top: 15px;
            border: 1.5px solid var(--green);
            border-radius: 14px;
            color: var(--green-dark);
            background: white;
            font-weight: 700;
            transition: .2s;
        }

        .select-court-btn:hover,
        .court-card.active .select-court-btn {
            color: white;
            background: var(--green);
        }

        /* SUMMARY */
        .summary-card {
            position: sticky;
            top: 20px;
            padding: 22px;
            background: white;
            border: 1px solid #e5edf2;
            border-radius: 23px;
            box-shadow: 0 5px 18px rgba(20, 50, 70, .08);
        }

        .summary-heading {
            display: flex;
            align-items: center;
            gap: 13px;
            padding-bottom: 19px;
            border-bottom: 1px solid var(--border);
            font-size: 19px;
            font-weight: 800;
        }

        .summary-heading i {
            color: var(--green);
            font-size: 27px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            align-items: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .summary-row .left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .summary-row .left i {
            color: var(--green);
            font-size: 20px;
        }

        .summary-value {
            text-align: right;
            font-weight: 700;
        }

        .summary-photo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 22px;
        }

        .summary-photo img {
            width: 90px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
        }

        .summary-photo strong {
            display: block;
            font-size: 14px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid var(--border);
            font-weight: 800;
        }

        .total-price {
            color: var(--green-dark);
            font-size: 25px;
            white-space: nowrap;
        }

        .continue-btn {
            width: 100%;
            min-height: 53px;
            margin-top: 19px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(100deg, #087a65, #079a78);
            color: white;
            font-weight: 700;
            transition: .2s;
        }

        .continue-btn:hover:not(:disabled) {
            background: var(--green-dark);
            transform: translateY(-1px);
        }

        .continue-btn:disabled {
            background: #a8b9b5;
            cursor: not-allowed;
        }

        .summary-note {
            margin-top: 12px;
            color: var(--muted);
            text-align: center;
            font-size: 12px;
        }

        /* MODAL */
        .modal-content {
            border: 0;
            border-radius: 18px;
        }

        .modal-confirm {
            background: #ecfdf5;
            border-radius: 12px;
            padding: 15px;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .court-layout {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .summary-card {
                position: static;
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 768px) {
            .navbar-custom {
                margin: 10px;
                padding: 12px 16px;
            }

            .hero {
                margin: 0 14px 18px;
                min-height: 180px;
                padding: 25px;
            }

            .hero p {
                max-width: 85%;
                font-size: 14px;
            }

            .date-section {
                margin: 0 16px 18px;
                flex-wrap: wrap;
                gap: 12px;
            }

            .date-icon {
                width: 55px;
                height: 55px;
                font-size: 24px;
            }

            .date-description {
                min-width: calc(100% - 75px);
            }

            .date-control {
                width: 100%;
            }

            .content-area {
                margin: 0 14px 25px;
            }

            .court-layout {
                grid-template-columns: 1fr;
            }

            .summary-card {
                grid-column: auto;
            }

            .court-image {
                height: 210px;
            }
        }

        @media (max-width: 420px) {
            .court-content {
                padding: 12px;
            }

            .court-image {
                height: 175px;
            }

            .court-name {
                font-size: 19px;
            }

            .court-price {
                font-size: 24px;
            }

            .time-grid {
                gap: 7px;
            }

            .time-slot {
                font-size: 11px;
            }

            .facility-item span {
                font-size: 10px;
            }
        }
    </style>
</head>

<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand brand" href="/">
        <i class="bi bi-dribbble me-2"></i>
        MARTANA
        <small>SPORT</small>
    </a>

    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarMartana"
            aria-controls="navbarMartana" aria-expanded="false"
            aria-label="Buka navigasi">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMartana">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('booking.index') }}">Cek Jadwal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('booking.index') }}">Booking</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Riwayat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pembayaran</a>
            </li>
        </ul>

        <div class="profile-icon">
            <i class="bi bi-person-fill"></i>
        </div>
    </div>
</nav>

{{-- HERO --}}
<section class="hero">
    <div class="hero-content">
        <small>MARTANA FUTSAL</small>
        <h1>Booking Lapangan</h1>
        <p>Pilih jadwal, tentukan lapangan, dan nikmati permainan terbaik bersama kami!</p>
        <div class="hero-line"></div>
    </div>
</section>

{{-- PILIH TANGGAL --}}
<section class="date-section">

    <div class="date-icon">
        <i class="bi bi-calendar2-week-fill"></i>
    </div>

    <div class="date-description">
        <h5>Tanggal Booking</h5>
        <p>Pilih tanggal untuk melihat ketersediaan lapangan</p>
    </div>

    <form method="GET"
          action="{{ route('booking.index') }}"
          class="date-control">

        <input type="date"
               name="tanggal"
               class="form-control"
               value="{{ $tanggal }}"
               min="{{ now()->toDateString() }}"
               onchange="this.form.submit()"
               aria-label="Pilih tanggal booking">

    </form>

</section>

{{-- KONTEN --}}
<div class="content-area">

    <div class="court-layout">

        {{-- DAFTAR LAPANGAN --}}
        @forelse ($courts as $court)

            @php
                $courtName = strtolower($court->name);

                $isVinyl = \Illuminate\Support\Str::contains($courtName, 'vinyl');

                $photo = $isVinyl
                    ? 'images/lapangan-vinyl.jpg'
                    : 'images/lapangan-sintetis.jpg';

                $description = $isVinyl
                    ? 'Permukaan vinyl berkualitas, nyaman dan aman.'
                    : 'Rumput sintetis berkualitas, cocok untuk segala cuaca.';

                $facilities = $isVinyl
                    ? [
                        ['icon' => 'bi-layers-fill', 'text' => 'Lantai Vinyl'],
                        ['icon' => 'bi-people-fill', 'text' => 'Kapasitas maks. 10 orang'],
                        ['icon' => 'bi-snow', 'text' => 'Full AC'],
                        ['icon' => 'bi-shield-fill-check', 'text' => 'Standar FIFA'],
                    ]
                    : [
                        ['icon' => 'bi-tree-fill', 'text' => 'Rumput Sintetis'],
                        ['icon' => 'bi-people-fill', 'text' => 'Kapasitas maks. 10 orang'],
                        ['icon' => 'bi-brightness-high-fill', 'text' => 'Pencahayaan Optimal'],
                        ['icon' => 'bi-shield-fill-check', 'text' => 'Standar FIFA'],
                    ];
            @endphp

            @if (!request('court_id') || request('court_id') == $court->id)

                <article class="court-card"
                         data-court-id="{{ $court->id }}">

                    {{-- FOTO LAPANGAN --}}
                    <div class="court-image">
                        <img src="{{ asset($photo) }}"
                             alt="{{ $court->name }}"
                             onerror="this.onerror=null;this.src='https://placehold.co/800x450/e2f5ee/047857?text=Foto+Lapangan';">

                        <div class="selected-check">
                            <i class="bi bi-check-lg"></i>
                        </div>
                    </div>

                    <div class="court-content">

                        <h2 class="court-name">
                            {{ $court->name }}
                        </h2>

                        <div class="court-description">
                            {{ $description }}
                        </div>

                        
{{-- INFORMASI FASILITAS --}}
<div class="facility-list">

    <div class="facility-info">
        <i class="bi bi-layers-fill"></i>
        <span>{{ $isVinyl ? 'Lantai Vinyl' : 'Lantai Sintetis' }}</span>
    </div>

    <div class="facility-info">
        <i class="bi bi-people-fill"></i>
        <span>Kapasitas 10 Orang</span>
    </div>

</div>


                        {{-- HARGA --}}
                        <div class="court-price">
                            Rp{{ number_format($court->price_per_hour, 0, ',', '.') }}
                            <small>/ jam</small>
                        </div>

                        <div class="schedule-title">
                            Jadwal Tersedia
                        </div>

                        {{-- JADWAL --}}
                        <div class="time-grid">

                            @for ($hour = 8; $hour < 22; $hour++)

                                @php
                                    $start = sprintf('%02d:00:00', $hour);
                                    $end = sprintf('%02d:00:00', $hour + 1);

                                    $isOccupied = $bookings->contains(function ($booking) use ($court, $start, $end) {
                                        return $booking->court_id == $court->id
                                            && $booking->start_time < $end
                                            && $booking->end_time > $start;
                                    });
                                @endphp

                                <button
                                    type="button"
                                    class="time-slot"
                                    data-court-id="{{ $court->id }}"
                                    data-court-name="{{ $court->name }}"
                                    data-court-photo="{{ asset($photo) }}"
                                    data-price="{{ $court->price_per_hour }}"
                                    data-time="{{ substr($start, 0, 5) }} - {{ substr($end, 0, 5) }}"
                                    data-date="{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('D, d F Y') }}"
                                    {{ $isOccupied ? 'disabled' : '' }}
                                    aria-label="Pilih {{ $court->name }} pukul {{ substr($start, 0, 5) }}">

                                    {{ substr($start, 0, 5) }} – {{ substr($end, 0, 5) }}

                                    @if ($isOccupied)
                                        <span class="occupied-label">Terisi</span>
                                    @endif

                                </button>

                            @endfor

                        </div>

                        {{-- PILIH LAPANGAN --}}
                        <button type="button"
                                class="select-court-btn"
                                data-court-id="{{ $court->id }}">

                            <i class="bi bi-calendar2-week me-2"></i>
                            Pilih Lapangan Ini
                            <i class="bi bi-chevron-right float-end me-2"></i>

                        </button>

                    </div>
                </article>

            @endif

        @empty

            <div class="empty-courts">
                <i class="bi bi-building fs-1 d-block mb-3"></i>
                <strong>Belum ada data lapangan.</strong>
                <p class="mb-0 mt-2">Data lapangan belum tersedia.</p>
            </div>

        @endforelse

        {{-- RINGKASAN BOOKING --}}
        <aside class="summary-card">

            <div class="summary-heading">
                <i class="bi bi-clipboard2-check-fill"></i>
                Ringkasan Booking
            </div>

            <div class="summary-row">
                <div class="left">
                    <i class="bi bi-calendar3"></i>
                    <span>Tanggal</span>
                </div>

                <span class="summary-value" id="summary-date">
                    {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('D, d F Y') }}
                </span>
            </div>

            <div class="summary-photo">
                <img id="summary-photo"
                     src="https://placehold.co/180x120/e2f5ee/047857?text=Lapangan"
                     alt="Foto lapangan">

                <div>
                    <small class="text-muted">Lapangan</small>
                    <strong id="summary-court">Belum dipilih</strong>
                </div>
            </div>

            <div class="summary-row">
                <div class="left">
                    <i class="bi bi-clock"></i>
                    <span>Waktu</span>
                </div>

                <span class="summary-value" id="summary-time">-</span>
            </div>

            <div class="summary-row">
                <div class="left">
                    <i class="bi bi-hourglass-split"></i>
                    <span>Durasi</span>
                </div>

                <span class="summary-value">1 jam</span>
            </div>

            <div class="total-row">
                <span>Total Pembayaran</span>

                <span class="total-price" id="summary-price">
                    Rp0
                </span>
            </div>

            <button type="button"
                    class="continue-btn"
                    id="continue-button"
                    disabled>

                <i class="bi bi-credit-card me-2"></i>
                Lanjutkan Pembayaran
                <i class="bi bi-chevron-right ms-2"></i>

            </button>

            <div class="summary-note" id="summary-note">
                Pilih lapangan dan jam yang tersedia.
            </div>

        </aside>

    </div>
</div>

{{-- MODAL KONFIRMASI --}}
<div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">
                    Konfirmasi Pilihan Jadwal
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">

                <p class="text-muted">
                    Periksa kembali pilihan lapangan dan jadwal berikut.
                </p>

                <div class="modal-confirm">

                    <div class="mb-3">
                        <small class="text-muted">Lapangan</small>
                        <div class="fw-bold" id="modal-court">-</div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Tanggal</small>
                        <div class="fw-bold" id="modal-date">-</div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Waktu</small>
                        <div class="fw-bold" id="modal-time">-</div>
                    </div>

                    <div>
                        <small class="text-muted">Total Pembayaran</small>
                        <div class="fw-bold fs-4 text-success" id="modal-price">
                            Rp0
                        </div>
                    </div>

                </div>

                <div class="alert alert-info small mt-3 mb-0">
                    Pilihan ini merupakan pratinjau jadwal. Penyimpanan booking perlu dihubungkan dengan proses booking aplikasi.
                </div>

            </div>

            <div class="modal-footer border-0">
                <button type="button"
                        class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let selectedSlot = null;

    const continueButton = document.getElementById('continue-button');

    const courtCards = document.querySelectorAll('.court-card');
    const timeSlots = document.querySelectorAll('.time-slot:not(:disabled)');
    const courtButtons = document.querySelectorAll('.select-court-btn');

    function formatRupiah(number) {
        return 'Rp' + new Intl.NumberFormat('id-ID', {
            maximumFractionDigits: 0
        }).format(number);
    }

    function updateSummary(button) {
        selectedSlot = button;

        document.getElementById('summary-court').textContent =
            button.dataset.courtName;

        document.getElementById('summary-time').textContent =
            button.dataset.time.replace(' - ', ' – ');

        document.getElementById('summary-date').textContent =
            button.dataset.date;

        document.getElementById('summary-price').textContent =
            formatRupiah(Number(button.dataset.price));

        document.getElementById('summary-photo').src =
            button.dataset.courtPhoto;

        continueButton.disabled = false;

        document.getElementById('summary-note').textContent =
            'Jadwal berhasil dipilih. Periksa kembali ringkasan Anda.';
    }

    function selectCourtCard(courtId) {
        courtCards.forEach(card => {
            card.classList.toggle(
                'active',
                card.dataset.courtId === String(courtId)
            );
        });
    }

    // Klik pilihan jam.
    timeSlots.forEach(button => {
        button.addEventListener('click', function () {

            // Hapus tanda pilihan jam sebelumnya.
            timeSlots.forEach(slot => {
                slot.classList.remove('selected');
                slot.innerHTML = slot.dataset.time.replace(' - ', ' – ');
            });

            // Tandai jam yang dipilih.
            this.classList.add('selected');
            this.innerHTML =
                '<i class="bi bi-check-circle-fill"></i> ' +
                this.dataset.time.replace(' - ', ' – ');

            selectCourtCard(this.dataset.courtId);
            updateSummary(this);
        });
    });

    // Klik tombol pilih lapangan.
    courtButtons.forEach(button => {
        button.addEventListener('click', function () {
            const courtId = this.dataset.courtId;

            selectCourtCard(courtId);

            const existingSelection = selectedSlot &&
                selectedSlot.dataset.courtId === courtId;

            if (!existingSelection) {
                const firstAvailable = document.querySelector(
                    '.time-slot:not(:disabled)[data-court-id="' + courtId + '"]'
                );

                if (firstAvailable) {
                    firstAvailable.click();
                } else {
                    document.getElementById('summary-note').textContent =
                        'Tidak ada jadwal tersedia untuk lapangan ini.';
                }
            } else {
                document.getElementById('summary-note').textContent =
                    'Lapangan ini sedang dipilih.';
            }
        });
    });

    // Klik lanjutkan pembayaran: tampilkan konfirmasi pilihan.
    continueButton.addEventListener('click', function () {

        if (!selectedSlot) {
            alert('Silakan pilih lapangan dan jam terlebih dahulu.');
            return;
        }

        document.getElementById('modal-court').textContent =
            selectedSlot.dataset.courtName;

        document.getElementById('modal-date').textContent =
            selectedSlot.dataset.date;

        document.getElementById('modal-time').textContent =
            selectedSlot.dataset.time.replace(' - ', ' – ');

        document.getElementById('modal-price').textContent =
            formatRupiah(Number(selectedSlot.dataset.price));

        const modal = new bootstrap.Modal(
            document.getElementById('bookingModal')
        );

        modal.show();
    });
</script>

</body>
</html>