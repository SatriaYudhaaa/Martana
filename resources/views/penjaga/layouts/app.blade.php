<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Penjaga') | Martana Futsal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7f6;
            color: #172b25;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 255px;
            height: 100vh;
            background: linear-gradient(180deg, #064e3b, #003f32);
            color: white;
            padding: 24px 17px;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 4px 9px 32px;
        }

        .brand-logo {
            width: 43px;
            height: 43px;
            border-radius: 11px;
            background: #ffffff;
            color: #08764f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            flex-shrink: 0;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .brand-subtitle {
            color: #a7f3d0;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.3px;
            margin-top: 3px;
        }

        .menu-label {
            color: #a7cfc0;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.4px;
            padding: 0 12px 12px;
        }

        .menu-list {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 12px;
            border-radius: 9px;
            color: #e0f2e9;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: .2s ease;
        }

        .menu-item i {
            font-size: 17px;
            width: 19px;
            text-align: center;
        }

        .menu-item:hover {
            background: rgba(255,255,255,.10);
            color: white;
        }

        .menu-item.active {
            background: #16835e;
            color: white;
            font-weight: 700;
        }

        /* SIDEBAR PROFILE */
        .sidebar-bottom {
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,.13);
            padding-top: 18px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 7px 16px;
        }

        .profile-icon {
            width: 37px;
            height: 37px;
            background: #d1fae5;
            color: #065f46;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .profile-name {
            font-size: 12px;
            font-weight: 700;
        }

        .profile-email {
            font-size: 10px;
            color: #a7f3d0;
            margin-top: 3px;
            overflow-wrap: anywhere;
        }

        .logout-button {
            width: 100%;
            border: none;
            background: transparent;
            color: #fce7e7;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 9px;
            font-family: inherit;
            font-size: 13px;
            cursor: pointer;
            text-align: left;
            border-radius: 8px;
        }

        .logout-button:hover {
            background: rgba(255,255,255,.10);
        }

        /* MAIN CONTENT */
        .main {
            margin-left: 255px;
            min-height: 100vh;
        }

        .topbar {
            height: 76px;
            background: white;
            border-bottom: 1px solid #e9eeeb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
        }

        .topbar-title {
            font-size: 13px;
            font-weight: 700;
        }

        .topbar-subtitle {
            font-size: 11px;
            color: #84918b;
            margin-top: 4px;
        }

        .topbar-date {
            background: #fff;
            border: 1px solid #e5eae7;
            border-radius: 9px;
            padding: 9px 13px;
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 11px;
            font-weight: 600;
            color: #33463e;
        }

        .topbar-date i {
            font-size: 16px;
            color: #08764f;
        }

        .content {
            padding: 30px 32px;
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 25px;
            font-weight: 800;
            color: #111f19;
            margin-bottom: 7px;
        }

        .page-heading p {
            font-size: 13px;
            color: #64748b;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .sidebar {
                width: 215px;
            }

            .main {
                margin-left: 215px;
            }

            .content {
                padding: 25px 20px;
            }

            .topbar {
                padding: 0 20px;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                width: 68px;
                padding: 20px 9px;
            }

            .brand {
                justify-content: center;
                padding: 5px 0 30px;
            }

            .brand-text,
            .menu-label,
            .menu-item span,
            .profile-text,
            .logout-text {
                display: none;
            }

            .menu-item {
                justify-content: center;
                padding: 13px 5px;
            }

            .menu-item i {
                font-size: 19px;
            }

            .profile {
                justify-content: center;
                padding: 0 0 15px;
            }

            .main {
                margin-left: 68px;
            }

            .topbar {
                padding: 0 13px;
            }

            .topbar-date {
                font-size: 9px;
                padding: 8px;
            }

            .content {
                padding: 22px 13px;
            }

            .page-heading h1 {
                font-size: 21px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="brand">
            <div class="brand-logo">
                <img src="{{ asset('images/martana-logo.png') }}" alt="Logo Martana">
            </div>

            <div class="brand-text">
                <div class="brand-name">MARTANA</div>
                <div class="brand-subtitle">FUTSAL</div>
            </div>
        </div>

        <div class="menu-label">MENU UTAMA</div>

        <nav class="menu-list">

            <a href="{{ url('/penjaga') }}"
               class="menu-item {{ request()->is('penjaga') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ url('/penjaga/presensi') }}"
               class="menu-item {{ request()->is('penjaga/presensi*') ? 'active' : '' }}">
                <i class="bi bi-calendar-plus"></i>
                <span>Presensi</span>
            </a>

            <a href="{{ url('/penjaga/booking') }}"
               class="menu-item {{ request()->is('penjaga/booking*') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i>
                <span>Booking</span>
            </a>

            <a href="{{ url('/penjaga/transaksi') }}"
               class="menu-item {{ request()->is('penjaga/transaksi*') ? 'active' : '' }}">
                <i class="bi bi-wallet2"></i>
                <span>Transaksi</span>
            </a>

            <a href="{{ url('/penjaga/kelola-akun') }}"
                class="menu-item {{ request()->is('penjaga/kelola-akun*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Kelola Akun</span>
            </a>

        </nav>

        {{-- PROFILE DAN LOGOUT --}}
        <div class="sidebar-bottom">

            <div class="profile">
                <div class="profile-icon">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="profile-text">
                    <div class="profile-name">Penjaga</div>
                    <div class="profile-email">
                        {{ auth()->user()->email ?? 'petugas@martana.id' }}
                    </div>
                </div>
            </div>

            <form action="{{ url('/logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-button">
                    <i class="bi bi-box-arrow-left"></i>
                    <span class="logout-text">Logout</span>
                </button>
            </form>

        </div>

    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="main">

        <header class="topbar">

            <div>
                <div class="topbar-title">Panel Penjaga</div>
                <div class="topbar-subtitle">
                    Sistem Informasi Pengelolaan Lapangan Futsal Martana
                </div>
            </div>

            <div class="topbar-date">
                <i class="bi bi-calendar3"></i>
                <span>{{ now()->translatedFormat('l, d F Y') }}</span>
            </div>

        </header>

        <section class="content">

            <div class="page-heading">
                <h1>@yield('page-title', 'Dashboard Penjaga')</h1>
                <p>
                    @yield('page-description', 'Kelola operasional lapangan Martana Futsal.')
                </p>
            </div>

            @yield('content')

        </section>

    </main>

    @stack('scripts')

</body>
</html>