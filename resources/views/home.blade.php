
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Martana Futsal</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7f4;
            color: #17251c;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 8%;
            background: white;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #167344;
        }

        .nav-links {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        nav a {
            text-decoration: none;
            color: #17251c;
        }

        .btn {
            display: inline-block;
            background: #167344;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn:hover {
            background: #105a35;
            transform: translateY(-2px);
        }

        .hero {
            padding: 90px 8%;
            background: linear-gradient(120deg, #102f20, #167344);
            color: white;
        }

        .hero h1 {
            font-size: clamp(36px, 5vw, 58px);
            max-width: 650px;
            margin-bottom: 20px;
        }

        .hero p {
            max-width: 550px;
            line-height: 1.7;
            margin-bottom: 28px;
            color: #e2f2e8;
        }

        section {
            padding: 60px 8%;
        }

        .section-title {
            margin-bottom: 24px;
        }

        .fields {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 24px;
        }

        .field-card {
            background: white;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 18px #0000000d;
            transition: 0.25s;
        }

        .field-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px #0000001a;
        }

        .field-image {
            height: 170px;
            background: linear-gradient(135deg, #b6d9bd, #397b4d);
            display: grid;
            place-items: center;
            color: white;
            font-size: 22px;
            font-weight: bold;
        }

        .field-info {
            padding: 20px;
        }

        .field-info p {
            margin: 12px 0 18px;
            color: #647067;
        }

        .booking-info {
            display: none;
            margin-top: 18px;
            padding: 18px;
            background: #e5f3e9;
            border-radius: 10px;
        }

        .booking-info.show {
            display: block;
        }

        footer {
            padding: 25px 8%;
            text-align: center;
            background: #102f20;
            color: white;
        }

        @media (max-width: 600px) {
            nav {
                align-items: flex-start;
                gap: 16px;
                flex-direction: column;
            }

            .nav-links {
                flex-wrap: wrap;
                gap: 14px;
            }

            .hero {
                padding-top: 65px;
                padding-bottom: 65px;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="logo">MARTANA</div>

        <div class="nav-links">
            <a href="#home">Home</a>
            <a href="#lapangan">Lapangan</a>
            <a href="#cara-booking">Cara Booking</a>
            <a href="/login">Login</a>
        </div>
    </nav>

    <header class="hero" id="home">
        <h1>Waktunya Main. Waktunya Martana.</h1>
        <p>
            Temukan lapangan futsal favoritmu, pilih jadwal yang tersedia,
            dan booking dengan mudah dari mana saja.
        </p>
        <a href="#lapangan" class="btn">Jelajahi Lapangan</a>
    </header>

    <section id="lapangan">
        <h2 class="section-title">Pilihan Lapangan</h2>

        <div class="fields">
            <article class="field-card">
                <div class="field-image">Lapangan 1</div>
                <div class="field-info">
                    <h3>Lapangan Premium</h3>
                    <p>Mulai dari Rp150.000 / jam</p>
                    <button class="btn" onclick="showBooking('booking-1')">
                        Lihat Jadwal
                    </button>
                    <div class="booking-info" id="booking-1">
                        <strong>Informasi jadwal</strong>
                        <p>Silakan login untuk memilih jadwal dan melakukan booking.</p>
                        <a href="/login">Login</a>
                    </div>
                </div>
            </article>

            <article class="field-card">
                <div class="field-image">Lapangan 2</div>
                <div class="field-info">
                    <h3>Lapangan Reguler</h3>
                    <p>Mulai dari Rp120.000 / jam</p>
                    <button class="btn" onclick="showBooking('booking-2')">
                        Lihat Jadwal
                    </button>
                    <div class="booking-info" id="booking-2">
                        <strong>Informasi jadwal</strong>
                        <p>Silakan login untuk memilih jadwal dan melakukan booking.</p>
                        <a href="/login">Login</a>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <section id="cara-booking">
        <h2 class="section-title">Cara Booking</h2>
        <ol>
            <li>Pilih lapangan yang kamu inginkan.</li>
            <li>Login atau buat akun.</li>
            <li>Pilih tanggal dan jam bermain.</li>
            <li>Lakukan pembayaran sesuai instruksi.</li>
        </ol>
    </section>

    <footer>
        <p>© 2026 Martana Futsal. Main bareng, makin seru.</p>
    </footer>

    <script>
        function showBooking(id) {
            const panel = document.getElementById(id);
            panel.classList.toggle('show');
        }
    </script>
</body>
</html>
