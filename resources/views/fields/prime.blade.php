
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARTANA PRIME | Detail Lapangan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: #f4f8f6;
            color: #18352c;
            font-family: Arial, sans-serif;
        }

        .detail-navbar {
            background: #fff;
            border-bottom: 1px solid #e5eee9;
            padding: 18px 0;
        }

        .brand {
            color: #087f5b;
            font-size: 1.4rem;
            font-weight: 800;
            text-decoration: none;
        }

        .detail-wrapper {
            max-width: 1100px;
            margin: 48px auto;
        }

        .back-link {
            color: #087f5b;
            text-decoration: none;
            font-weight: 600;
        }

        .field-image {
            width: 100%;
            height: 440px;
            object-fit: cover;
            border-radius: 22px;
            box-shadow: 0 15px 35px rgba(18, 60, 45, .12);
        }

        .detail-card {
            background: #fff;
            border: 1px solid #e5eee9;
            border-radius: 22px;
            padding: 32px;
            box-shadow: 0 12px 35px rgba(18, 60, 45, .06);
        }

        .field-badge {
            display: inline-block;
            background: #dff7eb;
            color: #087f5b;
            padding: 7px 13px;
            border-radius: 30px;
            font-size: .75rem;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .field-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            margin: 16px 0 10px;
        }

        .field-price {
            color: #087f5b;
            font-size: 2rem;
            font-weight: 800;
        }

        .info-item {
            background: #f4f8f6;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 10px;
        }

        .booking-btn {
            display: block;
            width: 100%;
            background: #087f5b;
            color: white;
            border: 0;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            font-weight: 700;
            margin-top: 24px;
        }

        .booking-btn:hover {
            background: #066b4c;
            color: white;
        }

        @media (max-width: 768px) {
            .detail-wrapper { margin: 24px auto; }
            .field-image { height: 280px; }
            .detail-card { padding: 24px; }
        }
    </style>
</head>
<body>

    <nav class="detail-navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('home') }}" class="brand">MARTANA</a>
            <a href="{{ route('home') }}" class="back-link">← Kembali ke Beranda</a>
        </div>
    </nav>

    <main class="container detail-wrapper">
        <div class="row g-4 align-items-start">
            <div class="col-lg-7">
                <img
                    src="{{ asset('images/lapangan-prime.jpg') }}"
                    alt="Lapangan MARTANA PRIME"
                    class="field-image"
                >

                <div class="detail-card mt-4">
                    <h3 class="fw-bold mb-3">Tentang Lapangan</h3>
                    <p class="text-secondary mb-0">
                        MARTANA PRIME merupakan lapangan futsal indoor dengan
                        permukaan vinyl, cocok untuk bermain bersama teman,
                        latihan tim, maupun pertandingan.
                    </p>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="detail-card">
                    <span class="field-badge">LAPANGAN PREMIUM</span>
                    <h1 class="field-title">MARTANA PRIME</h1>
                    <p class="text-secondary">Lapangan futsal indoor • Vinyl</p>

                    <div class="field-price">
                        Rp150.000 <span class="fs-6 text-secondary fw-normal">/ jam</span>
                    </div>

                    <hr class="my-4">

                    <h5 class="fw-bold mb-3">Informasi Lapangan</h5>

                    <div class="info-item">
                        <strong>Jenis Lapangan</strong>
                        <div class="text-secondary">Futsal indoor</div>
                    </div>

                    <div class="info-item">
                        <strong>Permukaan</strong>
                        <div class="text-secondary">Vinyl</div>
                    </div>

                    <div class="info-item">
                        <strong>Kapasitas Permainan</strong>
                        <div class="text-secondary">5 lawan 5</div>
                    </div>

                    <a href="{{ route('booking.index') }}" class="booking-btn">
                        Booking MARTANA PRIME →
                    </a>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
