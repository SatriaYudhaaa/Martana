
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MARTANA | Booking Lapangan Futsal</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- Navbar MARTANA -->
    <nav class="navbar navbar-expand-lg sticky-top martana-navbar">
        <div class="container">

            <!-- Logo dan Brand -->
            <a href="{{ route('home') }}" class="brand">
                <img
                    src="{{ asset('images/martana-logo.png') }}"
                    alt="Logo MARTANA"
                    class="brand-logo"
                >
                <span>MARTANA</span>
            </a>

            <!-- Tombol Hamburger -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false"
                aria-label="Buka navigasi"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Navigasi -->
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">
                            Beranda
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#lapangan">
                            Lapangan
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#fasilitas">
                            Fasilitas
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#lokasi">
                            Lokasi
                        </a>
                    </li>

                    <!-- Menu Akun -->
                    <li class="nav-item navbar-auth-divider">
                        <span></span>
                    </li>

                    @if (Auth::check())
                        <li class="nav-item">
                            <span class="nav-link navbar-login-link">
                                {{ Auth::user()->name }}
                            </span>
                        </li>

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-martana navbar-booking-btn">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link navbar-login-link">
                                Login
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-martana navbar-booking-btn">
                                Register
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero MARTANA -->
    <section class="hero">
        <div class="container">
            <div class="hero-grid">

                <!-- Hero Text -->
                <div class="hero-content">
                    <span class="hero-badge">
                        <span class="hero-badge-dot"></span>
                        LAPANGAN FUTSAL PREMIUM
                    </span>

                    <h1>
                        Waktunya main.<br>
                        Booking lapangan<br>
                        <span>tanpa ribet.</span>
                    </h1>

                    <p class="hero-description">
                        Cari lapangan, pilih jam, dan konfirmasi booking
                        dalam beberapa langkah mudah.
                    </p>

                    <div class="hero-actions">
                        <a href="#booking" class="btn btn-martana">
                            Cari Jadwal
                            <span aria-hidden="true">→</span>
                        </a>

                        <a href="#lapangan" class="btn btn-hero-outline">
                            Lihat Lapangan
                        </a>
                    </div>

                    <div class="hero-highlights">
                        <div>
                            <strong>01</strong>
                            <span>Pilih lapangan</span>
                        </div>
                        <div>
                            <strong>02</strong>
                            <span>Tentukan jadwal</span>
                        </div>
                        <div>
                            <strong>03</strong>
                            <span>Booking mudah</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Visual -->
                <div class="hero-visual">
                    <div class="hero-visual-label">
                        <span class="hero-live-dot"></span>
                        READY TO PLAY
                    </div>

                    <div class="hero-field">
                        <div class="field-outline">
                            <div class="field-halfway"></div>
                            <div class="field-center-circle"></div>
                            <div class="field-goal field-goal-left"></div>
                            <div class="field-goal field-goal-right"></div>
                        </div>

                        <div class="hero-ball">⚽</div>
                    </div>

                    <div class="hero-visual-caption">
                        <span>YOUR GAME</span>
                        <strong>STARTS HERE.</strong>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- DAFTAR LAPANGAN -->
    <section class="field-section" id="lapangan">
        <div class="container">

            <div class="section-heading">
                <p class="section-eyebrow text-uppercase fw-bold mb-2">
                    PILIH LAPANGAN
                </p>

                <h2 class="section-title">
                    Temukan tempat bermainmu
                </h2>

                <p class="section-description">
                    Lapangan berkualitas untuk pertandingan yang lebih seru.
                    Pilih lapangan favoritmu dan booking dengan mudah.
                </p>
            </div>

            @php
                $fields = [
                    [
                        'name' => 'MARTANA PRIME',
                        'description' => 'Lapangan indoor • Vinyl',
                        'price' => '150.000',
                        'image' => 'images/lapangan-prime.jpg',
                        'tag' => 'PREMIUM',
                        'number' => '01',
                    ],
                    [
                        'name' => 'MARTANA ARENA',
                        'description' => 'Lapangan indoor • Sintetis',
                        'price' => '150.000',
                        'image' => 'images/lapangan-arena.jpg',
                        'tag' => 'BEST VALUE',
                        'number' => '02',
                    ],
                ];
            @endphp

            <div class="row g-4">
                @foreach ($fields as $field)
                    <div class="col-md-6 col-lg-5">
                        <article class="field-card">

                            <div class="field-card-image">
                                <img
                                    src="{{ asset($field['image']) }}"
                                    alt="{{ $field['name'] }}"
                                    class="field-photo"
                                >

                                <span class="field-number">
                                    {{ $field['number'] }}
                                </span>

                                <span class="field-tag">
                                    {{ $field['tag'] }}
                                </span>

                                <div class="field-image-caption">
                                    <span>INDOOR FUTSAL</span>
                                    <h3>{{ $field['name'] }}</h3>
                                </div>
                            </div>

                            <div class="field-card-body">
                                <div class="field-card-info">
                                    <p class="field-location">
                                        <span class="field-info-icon">▦</span>
                                        {{ $field['description'] }}
                                    </p>

                                    <p class="field-rating">
                                        <span class="rating-stars">★★★★★</span>
                                        <span>4.9</span>
                                        <span class="rating-separator">•</span>
                                        <span>5v5</span>
                                    </p>
                                </div>

                                <div class="field-card-bottom">
                                    <div class="field-price">
                                        <span class="price-label">Mulai dari</span>
                                        <strong>Rp{{ $field['price'] }}</strong>
                                        <span class="price-unit">/ jam</span>
                                    </div>

                                    <a href="#booking" class="field-detail-link">
                                        Booking
                                        <span aria-hidden="true">→</span>
                                    </a>
                                </div>
                            </div>

                        </article>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- Fasilitas MARTANA -->
    <section class="about-section" id="fasilitas">
        <div class="container">

            <div class="text-center">
                <p class="section-eyebrow text-uppercase fw-bold">
                    Fasilitas MARTANA
                </p>

                <h2 class="section-title mx-auto">
                    Semua yang Kamu Butuhkan untuk Bermain
                </h2>

                <p class="about-description mx-auto">
                    Nikmati pengalaman futsal yang lebih nyaman dengan
                    fasilitas yang mendukung setiap pertandingan.
                </p>
            </div>

            <div class="facility-grid">

                <article class="facility-card">
                    <div class="facility-icon">⚽</div>
                    <div>
                        <h3>Lapangan Berkualitas</h3>
                        <p>
                            Area bermain yang nyaman untuk latihan,
                            pertandingan, dan bermain bersama teman.
                        </p>
                    </div>
                </article>

                <article class="facility-card">
                    <div class="facility-icon">📅</div>
                    <div>
                        <h3>Booking Online</h3>
                        <p>
                            Pilih tanggal dan jam bermain dengan mudah
                            melalui sistem booking MARTANA.
                        </p>
                    </div>
                </article>

                <article class="facility-card">
                    <div class="facility-icon">👥</div>
                    <div>
                        <h3>Untuk Semua Tim</h3>
                        <p>
                            Cocok untuk bermain santai, latihan rutin,
                            maupun pertandingan bersama tim.
                        </p>
                    </div>
                </article>

                <article class="facility-card">
                    <div class="facility-icon">🕒</div>
                    <div>
                        <h3>Jadwal Fleksibel</h3>
                        <p>
                            Tentukan waktu bermain sesuai kebutuhan
                            dan ketersediaan jadwal lapangan.
                        </p>
                    </div>
                </article>

                <article class="facility-card">
                    <div class="facility-icon">💳</div>
                    <div>
                        <h3>Informasi Transparan</h3>
                        <p>
                            Lihat informasi jadwal dan harga sebelum
                            melakukan pemesanan.
                        </p>
                    </div>
                </article>

                <article class="facility-card">
                    <div class="facility-icon">🏆</div>
                    <div>
                        <h3>Pengalaman Bermain</h3>
                        <p>
                            Ciptakan momen seru dan kompetitif bersama
                            teman maupun rekan satu tim.
                        </p>
                    </div>
                </article>

            </div>

            <div class="facility-cta">
                <div>
                    <h3>Siap Meramaikan Lapangan?</h3>
                    <p>
                        Atur jadwalmu dan booking lapangan sekarang di MARTANA.
                    </p>
                </div>

                <a href="#booking" class="btn">
                    Booking Sekarang →
                </a>
            </div>

        </div>
    </section>
    <!-- LOKASI -->
    <section class="location-section" id="lokasi">
        <div class="container">
            <div class="location-content">
                <p class="section-eyebrow text-uppercase fw-bold mb-2">
                    Lokasi
                </p>

                <h2 class="section-title">
                    Temukan MARTANA
                </h2>

                <p class="about-description mt-3">
                Temukan tempat terbaik untuk bermain, berlatih, dan berkumpul bersama tim. MARTANA hadir untuk memberikan pengalaman futsal yang nyaman dengan proses booking yang praktis.

                Lapangan berkualitas untuk latihan dan pertandingan.

                Booking praktis tanpa perlu antre di lokasi.

                Jadwal fleksibel untuk menyesuaikan waktu bermain tim.

                Siap bertanding? Pilih jadwalmu dan rasakan pengalaman bermain bersama MARTANA!
                </p>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container footer-content">
            <span>
                MARTANA · Lapangan Futsal & Booking Online
            </span>

            <div class="footer-links">
                <a href="#lokasi">Kontak</a>
                <a href="#lokasi">Instagram</a>
                <a href="#fasilitas">Kebijakan</a>
            </div>

            <span>
                © {{ date('Y') }} MARTANA. All rights reserved.
            </span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: @json(session('success')),
            confirmButtonText: 'Oke',
            confirmButtonColor: '#087f5b'
        });
    @endif
</script>
</body>
</html>
