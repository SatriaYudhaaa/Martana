
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Owner Panel') | Martana</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f5f8f6;
            color: #243b32;
        }

        .dashboard {
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 255px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 25px 18px;
            background: #103f32;
            color: white;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 4px 5px 25px;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .brand-logo {
            width: 43px;
            height: 43px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .brand-info h2 {
            font-size: 19px;
            font-weight: 800;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .brand-info p {
            color: #b8e8d1;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-top: 4px;
        }

        .menu-title {
            color: #a9c8ba;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            margin: 30px 12px 12px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 10px;
            text-decoration: none;
            color: #d4e6dc;
            border-radius: 9px;
            font-size: 13px;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #187d60;
            color: white;
        }

        .menu-icon {
            width: 31px;
            height: 31px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            background: rgba(220,248,234,.13);
            color: #d9f3e7;
            font-size: 16px;
            flex-shrink: 0;
        }

        .menu a.active .menu-icon {
            background: #d9f3e7;
            color: #145b43;
        }

        .sidebar-bottom {
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,.15);
            padding-top: 17px;
        }

        .owner-profile {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 9px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #d9f3e7;
            color: #145b43;
            display: grid;
            place-items: center;
            font-weight: bold;
        }

        .owner-profile strong {
            font-size: 13px;
        }

        .owner-profile small {
            display: block;
            color: #b8d5c8;
            font-size: 11px;
            margin-top: 3px;
        }

        .logout {
            width: 100%;
            border: 0;
            background: transparent;
            color: #f2c9c9;
            text-align: left;
            padding: 12px;
            cursor: pointer;
            font-size: 13px;
        }

        .logout:hover {
            background: rgba(255,255,255,.08);
            border-radius: 9px;
        }

        /* MAIN */
        .main {
            margin-left: 255px;
            min-height: 100vh;
            padding: 32px 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 27px;
        }

        .topbar h1 {
            font-size: 25px;
            color: #183f32;
        }

        .topbar p {
            font-size: 13px;
            color: #819087;
            margin-top: 6px;
        }

        .date-label {
            background: white;
            border: 1px solid #e5ece7;
            padding: 11px 15px;
            border-radius: 10px;
            font-size: 12px;
            color: #557064;
            white-space: nowrap;
        }

        /* CARDS */
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 17px;
            margin-bottom: 22px;
        }

        .stat-card {
            background: white;
            border: 1px solid #e8eee9;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 3px 12px rgba(20,60,40,.035);
        }

        .stat-card p {
            color: #819087;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .stat-card h2 {
            font-size: 23px;
            color: #173f31;
        }

        .stat-card small {
            display: block;
            margin-top: 7px;
            color: #8b9b91;
            font-size: 11px;
        }

        /* PANEL */
        .panel {
            background: white;
            border: 1px solid #e8eee9;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
            box-shadow: 0 3px 12px rgba(20,60,40,.035);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .panel-header h3 {
            font-size: 15px;
            color: #214536;
        }

        /* FILTER */
        .filter-form {
            display: flex;
            flex-wrap: wrap;
            align-items: end;
            gap: 12px;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .filter-group label {
            font-size: 11px;
            font-weight: 600;
            color: #60776b;
        }

        .filter-group input,
        .filter-group select {
            min-width: 155px;
            padding: 10px 12px;
            border: 1px solid #dfe9e2;
            border-radius: 8px;
            background: #fff;
            color: #355344;
            font-size: 12px;
            outline: none;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            border-color: #23845b;
        }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border: none;
            border-radius: 8px;
            padding: 11px 16px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: .2s;
        }

        .btn-primary {
            background: #187d60;
            color: white;
        }

        .btn-primary:hover {
            background: #105c45;
        }

        .btn-light {
            background: #eaf4ee;
            color: #246849;
        }

        .btn-light:hover {
            background: #dceee3;
        }

        /* TABLE */
        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th {
            background: #f0f7f2;
            color: #557064;
            text-align: left;
            padding: 14px 12px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        td {
            padding: 15px 12px;
            border-bottom: 1px solid #edf1ee;
            font-size: 12px;
            color: #52665b;
            vertical-align: middle;
        }

        td strong {
            color: #284d3c;
        }

        tbody tr:hover {
            background: #f9fcfa;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            background: #fff3d9;
            color: #a66b12;
            white-space: nowrap;
        }

        .status.success {
            background: #e1f5e9;
            color: #24764c;
        }

        .status.danger {
            background: #fde8e8;
            color: #b33b3b;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #91a096;
        }

        /* PAGINATION */
        .pagination-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 12px;
            color: #819087;
        }

        .pagination-wrapper nav {
            display: flex;
            gap: 5px;
        }

        .pagination-wrapper a,
        .pagination-wrapper span {
            display: inline-block;
            padding: 8px 11px;
            border: 1px solid #e1eae4;
            border-radius: 7px;
            color: #28684b;
            text-decoration: none;
            background: white;
        }

        .pagination-wrapper span[aria-current="page"] {
            background: #187d60;
            color: white;
            border-color: #187d60;
        }

        @media(max-width: 1000px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 700px) {
            .sidebar {
                width: 75px;
                padding: 20px 9px;
            }

            .brand {
                justify-content: center;
                padding: 0 0 20px;
            }

            .brand-logo {
                width: 38px;
                height: 38px;
            }

            .brand-info,
            .menu-title,
            .menu-label,
            .owner-profile div:not(.avatar),
            .logout-label {
                display: none;
            }

            .menu a {
                justify-content: center;
                padding: 10px 5px;
            }

            .main {
                margin-left: 75px;
                padding: 22px 14px;
            }

            .stats {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .stat-card {
                padding: 14px;
            }

            .stat-card h2 {
                font-size: 18px;
            }

            .topbar h1 {
                font-size: 20px;
            }

            .date-label {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
<div class="dashboard">

    <aside class="sidebar">
        <div class="brand">
            <img
                src="{{ asset('images/logo-martana.png') }}"
                alt="Logo Martana"
                class="brand-logo"
            >

            <div class="brand-info">
                <h2>MARTANA</h2>
                <p>OWNER PANEL</p>
            </div>
        </div>

        <div class="menu-title">MENU UTAMA</div>

        <nav class="menu">
            <a href="{{ route('owner.dashboard') }}"
               class="{{ ($activeMenu ?? '') === 'dashboard' ? 'active' : '' }}">
                <span class="menu-icon">⌂</span>
                <span class="menu-label">Dashboard</span>
            </a>

            <a href="{{ route('owner.reports.revenue') }}"
               class="{{ ($activeMenu ?? '') === 'revenue' ? 'active' : '' }}">
                <span class="menu-icon">▤</span>
                <span class="menu-label">Laporan Pendapatan</span>
            </a>

            <a href="{{ route('owner.reports.bookings') }}"
               class="{{ ($activeMenu ?? '') === 'bookings' ? 'active' : '' }}">
                <span class="menu-icon">▦</span>
                <span class="menu-label">Laporan Booking</span>
            </a>

            <a href="{{ route('owner.guards.index') }}"
               class="{{ ($activeMenu ?? '') === 'guards' ? 'active' : '' }}">
                <span class="menu-icon">♟</span>
                <span class="menu-label">Kelola Penjaga</span>
            </a>

        </nav>

        <div class="sidebar-bottom">
            <div class="owner-profile">
                <div class="avatar">O</div>
                <div>
                    <strong>Owner Martana</strong>
                    <small>Administrator</small>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout">
                    ↪ <span class="logout-label">Keluar dari akun</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main">
        <div class="topbar">
            <div>
                <h1>@yield('page-title')</h1>
                <p>@yield('page-description')</p>
            </div>

            <div class="date-label">
                ◷ {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>

        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>