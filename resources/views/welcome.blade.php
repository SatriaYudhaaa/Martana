<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Martana Futsal</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <!-- NAVBAR -->
    
<nav class="navbar">
    <a href="/" class="brand">MARTANA FUTSAL</a>

    <div>
        <a href="/" class="nav-link">Beranda</a>
        <a href="#lapangan" class="nav-link">Lapangan</a>
        <a href="#tentang" class="nav-link">Tentang Kami</a>

        @guest
            <a href="/login" class="nav-link">Login</a>
            <a href="/register" class="btn-martana">Daftar</a>
        @endguest

        @auth
            <span class="nav-link">
                Halo, {{ Auth::user()->name }}
            </span>

            <form action="/logout" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-martana">
                    Logout
                </button>
            </form>
        @endauth
    </div>
</nav>


    <!-- HERO -->
    <section class="hero">
        <div>
            <h1>Temukan Lapangan Futsal Favoritmu</h1>
            <p>
                Booking lapangan futsal jadi lebih mudah.
                Pilih lapangan, tentukan jadwal, dan nikmati permainanmu!
            </p>
            <a href="#lapangan" class="btn-martana">
                Cari Lapangan
            </a>
        </div>
    </section>

    <!-- PENCARIAN -->
    <section class="search-panel">
        <h2>Cari Lapangan Futsal</h2>

        <form action="#lapangan" method="GET">
            <input
                type="text"
                name="lokasi"
                placeholder="Masukkan lokasi lapangan"
            >

            <input
                type="date"
                name="tanggal"
            >

            <button type="submit" class="btn-martana">
                Cari Sekarang
            </button>
        </form>
    </section>

    <!-- DAFTAR LAPANGAN -->
    <section id="lapangan">
        <h2>Pilihan Lapangan Kami</h2>
        <p>Temukan lapangan yang sesuai dengan kebutuhan bermainmu.</p>

        <div class="field-card">
            <h3>Lapangan Futsal 1</h3>
            <p>Lapangan nyaman untuk pertandingan dan latihan futsal.</p>
            <a href="/login" class="btn-martana">Booking Sekarang</a>
        </div>

        <div class="field-card">
            <h3>Lapangan Futsal 2</h3>
            <p>Tempat bermain futsal bersama teman dan komunitas.</p>
            <a href="/login" class="btn-martana">Booking Sekarang</a>
        </div>

        <div class="field-card">
            <h3>Lapangan Futsal 3</h3>
            <p>Fasilitas lapangan untuk pengalaman bermain yang nyaman.</p>
            <a href="/login" class="btn-martana">Booking Sekarang</a>
        </div>
    </section>

    <!-- TENTANG KAMI -->
    <section id="tentang" class="about-section">
        <h2>Tentang Martana Futsal</h2>
        <p>
            Martana Futsal merupakan sistem informasi pemesanan
            lapangan futsal yang memudahkan pelanggan dalam melihat
            informasi lapangan dan melakukan pemesanan secara online.
        </p>
    </section>

    <!-- FOOTER -->
    <footer class="site-footer">
        <p>&copy; {{ date('Y') }} Martana Futsal. All Rights Reserved.</p>
    </footer>

</body>
</html>