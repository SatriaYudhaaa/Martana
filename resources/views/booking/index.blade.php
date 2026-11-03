
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Lapangan - Martana Sport</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --green: #08a879;
            --green-dark: #005640;
            --green-deep: #004b3a;
            --green-light: #a7f3d0;
            --navy: #102746;
            --muted: #64748b;
            --border: #e1ebe6;
            --background: #f5f8fa;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            color: var(--navy);
            font-family: "Inter", "Segoe UI", Arial, sans-serif;
        }

        /* NAVBAR */
        .navbar-custom {
            min-height: 78px;
            margin: 0;
            padding: 14px max(24px, calc((100% - 1080px) / 2));
            background: #fff;
            border-bottom: 1px solid #e8efec;
            box-shadow: 0 2px 12px rgba(0, 40, 30, .06);
        }

        .brand {
            color: var(--green-dark);
            font-size: 22px;
            font-weight: 800;
            line-height: 1.05;
            text-decoration: none;
        }

        .brand small {
            display: block;
            font-size: 13px;
            letter-spacing: 1.5px;
        }

        .nav-link {
            padding: 14px 17px !important;
            color: var(--navy);
            font-size: 14px;
            font-weight: 600;
            transition: color .2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--green-dark);
        }

        .nav-link.active {
            border-bottom: 2px solid var(--green);
        }

        .profile-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border: 2px solid var(--border);
            border-radius: 50%;
            color: var(--green);
            font-size: 22px;
        }

        /* HERO */
        .hero {
            position: relative;
            display: flex;
            align-items: center;
            min-height: 220px;
            margin: 0 0 28px;
            padding: 42px max(28px, calc((100% - 1080px) / 2));
            overflow: hidden;
            border-radius: 0 0 24px 24px;
            color: #fff;
            background:
                radial-gradient(circle at 90% 20%, rgba(30, 190, 140, .28), transparent 35%),
                linear-gradient(110deg, #004b3a 0%, #00664e 55%, #078568 100%);
        }

        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero small {
            color: var(--green-light);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2.5px;
        }

        .hero h1 {
            margin: 10px 0;
            color: #fff;
            font-size: clamp(36px, 4vw, 54px);
            font-weight: 900;
            letter-spacing: -1.5px;
            line-height: 1.08;
        }

        .hero p {
            max-width: 650px;
            margin: 0;
            color: #ecfdf5;
            font-size: 16px;
            line-height: 1.7;
        }

        .hero-line {
            width: 63px;
            height: 4px;
            margin-top: 17px;
            border-radius: 5px;
            background: var(--green-light);
        }

        /* DATE FILTER */
        .date-section {
            max-width: 1320px;
            display: flex;
            align-items: center;
            gap: 20px;
            margin: 0 auto 24px;
            padding: 0 24px;
        }

        .date-icon {
            width: 60px;
            height: 60px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border: 1px solid #c8eade;
            border-radius: 14px;
            background: #e3f5ef;
            color: var(--green-dark);
            font-size: 26px;
        }

        .date-description {
            flex: 1;
        }

        .date-description h5 {
            margin: 0 0 5px;
            font-size: 17px;
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
            min-height: 50px;
            border: 1px solid var(--border);
            border-radius: 12px;
            color: var(--navy);
            font-weight: 700;
        }

        .date-control input:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 .2rem rgba(8, 168, 121, .12);
        }

        /* MAIN LAYOUT */
        .content-area {
            max-width: 1320px;
            margin: 0 auto 40px;
            padding: 0 24px;
        }

        .court-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) 300px;
            gap: 20px;
            align-items: start;
        }

        /* COURT CARD */
        .court-card {
            overflow: hidden;
            border: 1px solid #e4ece8;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 5px 18px rgba(0, 50, 35, .06);
            transition: border-color .2s, box-shadow .2s, transform .2s;
        }

        .court-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 9px 24px rgba(0, 50, 35, .09);
        }

        .court-card.active {
            border: 2px solid var(--green);
            box-shadow: 0 8px 22px rgba(8, 168, 121, .12);
        }

        .court-image {
            position: relative;
            width: 100%;
            height: 210px;
            overflow: hidden;
            background: #dff4ec;
        }

        .court-image img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            object-position: center;
            transition: transform .3s ease;
        }

        .court-card:hover .court-image img {
            transform: scale(1.03);
        }

        .selected-check {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 2;
            width: 36px;
            height: 36px;
            display: none;
            align-items: center;
            justify-content: center;
            border: 2px solid #fff;
            border-radius: 50%;
            background: var(--green);
            color: #fff;
            font-size: 19px;
        }

        .court-card.active .selected-check {
            display: flex;
        }

        .court-content {
            padding: 18px;
        }

        .court-name {
            margin: 0 0 5px;
            color: #142b25;
            font-size: 21px;
            font-weight: 800;
        }

        .court-description {
            min-height: 20px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.5;
        }

        /* FACILITIES */
        .facility-list {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px 20px;
            margin: 15px 0;
            padding: 13px 0;
            border-top: 1px solid #edf1f5;
            border-bottom: 1px solid #edf1f5;
        }

        .facility-info {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        .facility-info i {
            color: var(--green);
            font-size: 17px;
        }

        /* PRICE */
        .court-price {
            margin-bottom: 12px;
            color: var(--green-dark);
            font-size: 26px;
            font-weight: 900;
        }

        .court-price small {
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
        }

        .schedule-title {
            margin-bottom: 9px;
            padding-top: 12px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 12px;
        }

        /* TIME SLOTS */
        .time-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 7px;
        }

        .time-slot {
            min-height: 37px;
            padding: 6px 3px;
            border: 1px solid #d8e6e0;
            border-radius: 9px;
            background: #fff;
            color: #174536;
            font-size: 11px;
            font-weight: 600;
            transition: .2s ease;
        }

        .time-slot:hover:not(:disabled) {
            border-color: var(--green);
            background: #ecfdf5;
            color: var(--green-dark);
        }

        .time-slot.selected {
            border-color: var(--green-dark);
            background: var(--green-dark);
            color: #fff;
        }

        .time-slot:disabled {
            border-color: #e5e7eb;
            background: #f1f5f9;
            color: #94a3b8;
            cursor: not-allowed;
            text-decoration: line-through;
        }

        .time-slot i {
            margin-right: 3px;
        }

        .occupied-label {
            display: block;
            font-size: 9px;
            text-decoration: none;
        }

        /* SELECT COURT BUTTON */
        .select-court-btn {
            width: 100%;
            min-height: 45px;
            margin-top: 15px;
            border: 1px solid var(--green);
            border-radius: 10px;
            background: #fff;
            color: var(--green-dark);
            font-size: 13px;
            font-weight: 800;
            transition: .2s;
        }

        .select-court-btn:hover,
        .court-card.active .select-court-btn {
            background: var(--green-dark);
            color: #fff;
        }

        /* SUMMARY */
        .summary-card {
            position: sticky;
            top: 20px;
            padding: 22px;
            border: 1px solid #e4ece8;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 5px 18px rgba(0, 50, 35, .06);
        }

        .summary-heading {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--border);
            font-size: 17px;
            font-weight: 800;
        }

        .summary-heading i {
            color: var(--green);
            font-size: 25px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: 19px;
            font-size: 12px;
        }

        .summary-row .left {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .summary-row .left i {
            color: var(--green);
            font-size: 18px;
        }

        .summary-value {
            text-align: right;
            font-weight: 700;
        }

        .summary-photo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 20px;
        }

        .summary-photo img {
            width: 75px;
            height: 58px;
            flex-shrink: 0;
            border-radius: 9px;
            object-fit: cover;
        }

        .summary-photo strong {
            display: block;
            font-size: 13px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            padding-top: 17px;
            border-top: 1px solid var(--border);
            font-size: 13px;
            font-weight: 800;
        }

        .total-price {
            color: var(--green-dark);
            font-size: 23px;
            white-space: nowrap;
        }

        .continue-btn {
            width: 100%;
            min-height: 48px;
            margin-top: 18px;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(100deg, var(--green), #078568);
            color: #fff;
            font-size: 13px;
            font-weight: 800;
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
            font-size: 11px;
            line-height: 1.5;
        }

        .empty-courts {
            grid-column: 1 / -1;
            padding: 50px 20px;
            border: 1px dashed #cbd5e1;
            border-radius: 18px;
            background: #fff;
            color: var(--muted);
            text-align: center;
        }

        /* MODAL */
        .modal-content {
            border: 0;
            border-radius: 18px;
        }

        .modal-confirm {
            padding: 15px;
            border-radius: 12px;
            background: #ecfdf5;
        }

        /* RESPONSIVE */
        @media (max-width: 1100px) {
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
                padding: 12px 20px;
            }

            .hero {
                min-height: 180px;
                padding: 32px 24px;
                margin-bottom: 22px;
                border-radius: 0 0 18px 18px;
            }

            .hero h1 {
                font-size: clamp(32px, 8vw, 44px);
            }

            .hero p {
                max-width: 100%;
                font-size: 14px;
            }

            .date-section {
                flex-wrap: wrap;
                gap: 12px;
                padding: 0 18px;
            }

            .date-icon {
                width: 52px;
                height: 52px;
                font-size: 23px;
            }

            .date-description {
                min-width: calc(100% - 70px);
            }

            .date-control {
                width: 100%;
            }

            .content-area {
                padding: 0 18px;
            }

            .court-layout {
                grid-template-columns: 1fr;
            }

            .summary-card {
                grid-column: auto;
            }
        }

        @media (max-width: 420px) {
            .court-content {
                padding: 14px;
            }

            .court-image {
                height: 180px;
            }

            .court-name {
                font-size: 19px;
            }

            .court-price {
                font-size: 23px;
            }

            .time-grid {
                gap: 6px;
            }

            .time-slot {
                font-size: 10px;
            }
        }
        /* ===== FINAL OVERRIDE: SELARASKAN DENGAN HOMEPAGE MARTANA ===== */

/* Samakan lebar konten dengan homepage */
.date-section,
.content-area {
    width: 100%;
    max-width: 1130px;
    margin-left: auto;
    margin-right: auto;
    padding-left: 24px;
    padding-right: 24px;
}

/* Navbar lebih rapi dan konsisten */
.navbar-custom {
    min-height: 78px;
    margin: 0;
    padding: 14px max(24px, calc((100% - 1130px) / 2));
    border-radius: 0;
    background: #fff;
    box-shadow: 0 2px 12px rgba(0, 40, 30, .06);
    border-bottom: 1px solid #e8efec;
}

/* Hero */
.hero {
    min-height: 245px;
    margin: 0 0 28px;
    padding: 42px max(24px, calc((100% - 1130px) / 2));
    border-radius: 0 0 24px 24px;
    background:
        radial-gradient(circle at 90% 20%, rgba(30, 190, 140, .28), transparent 35%),
        linear-gradient(110deg, #004b3a 0%, #00664e 55%, #078568 100%);
}

.hero h1 {
    font-size: clamp(36px, 4vw, 54px);
    letter-spacing: -1.5px;
}

.hero p {
    font-size: 16px;
    line-height: 1.7;
}

/* Area tanggal */
.date-section {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 24px;
}

.date-control {
    width: 280px;
}

.date-control input {
    min-height: 52px;
    border-radius: 12px;
}

/* Kartu lapangan dan ringkasan */
.court-layout {
    grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) 280px;
    gap: 20px;
    align-items: start;
}

.court-card,
.summary-card {
    border: 1px solid #e4ece8;
    border-radius: 18px;
    box-shadow: 0 5px 18px rgba(0, 50, 35, .06);
}

.court-image {
    height: 190px;
    background: #e2f5ee;
}

.court-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.court-content {
    padding: 18px;
}

.court-name {
    font-size: 22px;
}

.facility-list {
    flex-wrap: wrap;
    gap: 12px 20px;
}

.time-slot {
    min-height: 38px;
    border-radius: 10px;
}

.summary-card {
    padding: 20px;
    position: sticky;
    top: 20px;
}

/* Tablet */
@media (max-width: 1100px) {
    .date-section,
    .content-area {
        max-width: 900px;
    }

    .court-layout {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .summary-card {
        grid-column: 1 / -1;
        position: static;
    }
}

/* HP */
@media (max-width: 768px) {
    .navbar-custom {
        padding: 12px 20px;
    }

    .hero {
        min-height: 200px;
        padding: 32px 24px;
        margin-bottom: 22px;
    }

    .date-section,
    .content-area {
        padding-left: 18px;
        padding-right: 18px;
    }

    .date-section {
        flex-wrap: wrap;
    }

    .date-control {
        width: 100%;
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
            <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('booking.index') }}">Cek Jadwal</a></li>
            <li class="nav-item"><a class="nav-link active" href="{{ route('booking.index') }}">Booking</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Riwayat</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Pembayaran</a></li>
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
    <div class="date-icon"><i class="bi bi-calendar2-week-fill"></i></div>

    <div class="date-description">
        <h5>Tanggal Booking</h5>
        <p>Pilih tanggal untuk melihat ketersediaan lapangan</p>
    </div>

    <form method="GET" action="{{ route('booking.index') }}" class="date-control">
        <input
            type="date"
            name="tanggal"
            class="form-control"
            value="{{ $tanggal }}"
            min="{{ now()->toDateString() }}"
            onchange="this.form.submit()"
            aria-label="Pilih tanggal booking"
        >
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
                    ? 'images/lapangan-arena.jpg'
                    : 'images/lapangan-prime.jpg';

                $description = $isVinyl
                    ? 'Permukaan vinyl berkualitas, nyaman dan aman.'
                    : 'Rumput sintetis berkualitas, cocok untuk segala cuaca.';
            @endphp

            @if (!request('court_id') || request('court_id') == $court->id)
                <article class="court-card" data-court-id="{{ $court->id }}">
                    <div class="court-image">
                        <img
                            src="{{ asset($photo) }}"
                            alt="{{ $court->name }}"
                            onerror="this.onerror=null;this.src='https://placehold.co/800x450/e2f5ee/047857?text=Foto+Lapangan';"
                        >
                        <div class="selected-check"><i class="bi bi-check-lg"></i></div>
                    </div>

                    <div class="court-content">
                        <h2 class="court-name">{{ $court->name }}</h2>
                        <div class="court-description">{{ $description }}</div>

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

                        <div class="court-price">
                            Rp{{ number_format($court->price_per_hour, 0, ',', '.') }}
                            <small>/ jam</small>
                        </div>

                        <div class="schedule-title">Jadwal Tersedia</div>

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
                                    data-booking-date="{{ $tanggal }}"
                                    data-start-time="{{ substr($start, 0, 5) }}"
                                    data-end-time="{{ substr($end, 0, 5) }}"
                                    {{ $isOccupied ? 'disabled' : '' }}
                                    aria-label="Pilih {{ $court->name }} pukul {{ substr($start, 0, 5) }}"
                                >
                                    {{ substr($start, 0, 5) }} – {{ substr($end, 0, 5) }}

                                    @if ($isOccupied)
                                        <span class="occupied-label">Terisi</span>
                                    @endif
                                </button>
                            @endfor
                        </div>

                        <button
                            type="button"
                            class="select-court-btn"
                            data-court-id="{{ $court->id }}"
                        >
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
                <img
                    id="summary-photo"
                    src="https://placehold.co/180x120/e2f5ee/047857?text=Lapangan"
                    alt="Foto lapangan"
                >
                <div>
                    <small class="text-muted">Lapangan</small>
                    <strong id="summary-court">Belum dipilih</strong>
                </div>
            </div>

            <div class="summary-row">
                <div class="left"><i class="bi bi-clock"></i><span>Waktu</span></div>
                <span class="summary-value" id="summary-time">-</span>
            </div>

            <div class="summary-row">
                <div class="left"><i class="bi bi-hourglass-split"></i><span>Durasi</span></div>
                <span class="summary-value">1 jam</span>
            </div>

            <div class="total-row">
                <span>Total Pembayaran</span>
                <span class="total-price" id="summary-price">Rp0</span>
            </div>

            <button type="button" class="continue-btn" id="continue-button" disabled>
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

{{-- MODAL FORM BOOKING --}}
<div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="booking-form" action="{{ route('booking.store') }}" method="POST">
                @csrf

                <input type="hidden" name="court_id" id="form-court-id">
                <input type="hidden" name="booking_date" id="form-booking-date">
                <input type="hidden" name="start_time" id="form-start-time">
                <input type="hidden" name="end_time" id="form-end-time">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Data Pemesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Nama Lengkap</label>
                        <input type="text" name="customer_name" id="customer_name"
                               class="form-control" required maxlength="255">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor HP</label>
                        <input type="tel" name="phone" id="phone"
                               class="form-control" required maxlength="20">
                    </div>

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
                            <div class="fw-bold fs-4 text-success" id="modal-price">Rp0</div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        Lanjut ke Pembayaran
                    </button>
                </div>
            </form>
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

    timeSlots.forEach(button => {
        button.addEventListener('click', function () {
            timeSlots.forEach(slot => {
                slot.classList.remove('selected');
                slot.innerHTML = slot.dataset.time.replace(' - ', ' – ');
            });

            this.classList.add('selected');
            this.innerHTML =
                '<i class="bi bi-check-circle-fill"></i> ' +
                this.dataset.time.replace(' - ', ' – ');

            selectCourtCard(this.dataset.courtId);
            updateSummary(this);
        });
    });

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

    continueButton.addEventListener('click', function () {
        if (!selectedSlot) {
            alert('Silakan pilih lapangan dan jam terlebih dahulu.');
            return;
        }

        const data = selectedSlot.dataset;

        document.getElementById('modal-court').textContent = data.courtName;
        document.getElementById('modal-date').textContent = data.date;
        document.getElementById('modal-time').textContent =
            data.time.replace(' - ', ' – ');
        document.getElementById('modal-price').textContent =
            formatRupiah(Number(data.price));

        document.getElementById('form-court-id').value = data.courtId;
        document.getElementById('form-booking-date').value = data.bookingDate;
        document.getElementById('form-start-time').value = data.startTime;
        document.getElementById('form-end-time').value = data.endTime;

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('bookingModal')
        ).show();
    });
</script>

</body>
</html>
