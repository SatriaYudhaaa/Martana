
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner | Martana</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 255px;
            background: #103f32;
            color: white;
            padding: 28px 18px;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
        }

        <div class="brand">
    <img
        src="{{ asset('images/martana-logo.png') }}"
        alt="Logo Martana"
        class="brand-logo"
    >

    <div class="brand-info">
        <h2>MARTANA</h2>
        <p>OWNER PANEL</p>
    </div>
</div>

        .menu-title {
            color: #a9c8ba;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
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
            gap: 13px;
            padding: 13px 12px;
            text-decoration: none;
            color: #d4e6dc;
            border-radius: 10px;
            font-size: 13px;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #23644d;
            color: white;
        }

        .menu-icon {
            width: 31px;
            height: 31px;
            display: grid;
            place-items: center;
            border-radius: 9px;
            background: rgba(220, 248, 234, .13);
            font-size: 16px;
        }

        .sidebar-bottom {
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,.15);
            padding-top: 18px;
        }

        .owner-profile {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px;
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
            margin-top: 3px;
            font-size: 11px;
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

        /* MAIN CONTENT */
        .main {
            margin-left: 255px;
            width: calc(100% - 255px);
            padding: 32px 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
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
        }

        /* STAT CARDS */
        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 17px;
            margin-bottom: 22px;
        }

        .stat-card {
            background: white;
            border: 1px solid #e8eee9;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 3px 12px rgba(20, 60, 40, .035);
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: #e5f5ec;
            color: #21734f;
            display: grid;
            place-items: center;
            font-size: 19px;
        }

        .stat-card p {
            font-size: 12px;
            color: #819087;
            margin-top: 15px;
        }

        .stat-card h2 {
            font-size: 23px;
            color: #173f31;
            margin-top: 7px;
        }

        .stat-card small {
            display: block;
            color: #8b9b91;
            font-size: 11px;
            margin-top: 6px;
        }

        /* CONTENT GRID */
        .content-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 20px;
            margin-bottom: 22px;
        }

        .panel {
            background: white;
            border: 1px solid #e8eee9;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 3px 12px rgba(20, 60, 40, .035);
            min-width: 0;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .panel-header h3 {
            font-size: 15px;
            color: #214536;
        }

        .panel-header a {
            color: #26835b;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
        }

        .chart-container {
            height: 270px;
            position: relative;
        }

        /* QUICK SUMMARY */
        .summary-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid #edf1ee;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .summary-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #e9f5ee;
            display: grid;
            place-items: center;
            color: #287b56;
        }

        .summary-left strong {
            display: block;
            font-size: 12px;
        }

        .summary-left small {
            display: block;
            font-size: 11px;
            color: #89968e;
            margin-top: 4px;
        }

        .summary-number {
            font-size: 17px;
            font-weight: 700;
            color: #1d6548;
        }

        /* BOOKING TABLE */
        .table-panel {
            background: white;
            border: 1px solid #e8eee9;
            border-radius: 14px;
            padding: 22px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 720px;
        }

        th {
            text-align: left;
            padding: 13px 12px;
            font-size: 11px;
            color: #829188;
            background: #f7faf8;
            font-weight: 700;
        }

        td {
            padding: 15px 12px;
            border-bottom: 1px solid #edf1ee;
            font-size: 12px;
            color: #52665b;
        }

        td strong {
            color: #284d3c;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            background: #fff3d9;
            color: #a66b12;
        }

        .status.confirmed {
            background: #e1f5e9;
            color: #24764c;
        }

        .status.cancelled {
            background: #fde8e8;
            color: #b33b3b;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #91a096;
        }

        @media (max-width: 1100px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                width: 75px;
                padding: 20px 9px;
            }

            .brand {
                justify-content: center;
                padding: 0 0 25px;
            }

            .brand-text,
            .menu-title,
            .menu-label,
            .owner-profile div:not(.avatar),
            .logout-label {
                display: none;
            }

            .menu a {
                justify-content: center;
                padding: 11px 5px;
            }

            .menu-icon {
                width: 38px;
                height: 38px;
            }

            .owner-profile {
                justify-content: center;
                padding: 8px 0;
            }

            .logout {
                text-align: center;
            }

            .main {
                margin-left: 75px;
                width: calc(100% - 75px);
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
</head>

<body>
<div class="dashboard">

    <!-- SIDEBAR -->
<aside class="sidebar">
    <div class="brand" style="
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        gap: 12px;
        width: 100%;
        padding: 5px 7px 24px;
        border-bottom: 1px solid rgba(255,255,255,.15);
    ">
        <img
            src="{{ asset('images/logo-martana.png') }}"
            alt="Logo Martana"
            style="
                width: 48px;
                height: 48px;
                object-fit: contain;
                flex-shrink: 0;
                display: block;
                border-radius: 8px;
            "
        >

        <div class="brand-text" style="
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 0;
        ">
            <h2 style="
                color: #ffffff;
                font-size: 20px;
                font-weight: 800;
                letter-spacing: .5px;
                line-height: 1.2;
                margin: 0;
                white-space: nowrap;
            ">MARTANA</h2>

            <p style="
                color: #b8e8d1;
                font-size: 12px;
                font-weight: 600;
                margin: 4px 0 0;
                white-space: nowrap;
            ">OWNER PANEL</p>
        </div>
    </div>

        <nav class="menu">
            <a href="{{ route('owner.dashboard') }}" class="active">
                <span class="menu-icon">⌂</span>
                <span class="menu-label">Dashboard</span>
            </a>

            <a href="{{ route('owner.reports.revenue') }}">
                <span class="menu-icon">▤</span>
                <span class="menu-label">Laporan Pendapatan</span>
            </a>

            <a href="{{ route('owner.reports.bookings') }}">
                <span class="menu-icon">▦</span>
                <span class="menu-label">Laporan Booking</span>
            </a>

            <a href="{{ route('owner.guards.index') }}">
                <span class="menu-icon">♙</span>
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

    <!-- MAIN CONTENT -->
    <main class="main">

        <div class="topbar">
            <div>
                <h1>Dashboard Owner</h1>
                <p>Selamat datang di halaman pengelolaan Martana Futsal.</p>
            </div>

            <div class="date-label">
                ◷ {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>

        <!-- STATISTIK -->
        <section class="stats">

            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-icon">▦</span>
                </div>
                <p>Total Booking</p>
                <h2>{{ number_format($totalBookings, 0, ',', '.') }}</h2>
                <small>Seluruh data booking</small>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-icon">◷</span>
                </div>
                <p>Booking Hari Ini</p>
                <h2>{{ number_format($todayBookings, 0, ',', '.') }}</h2>
                <small>Berdasarkan tanggal booking</small>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-icon">Rp</span>
                </div>
                <p>Total Pendapatan</p>
                <h2 style="font-size:20px;">
                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                </h2>
                <small>Pembayaran yang telah diverifikasi</small>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <span class="stat-icon">▤</span>
                </div>
                <p>Lapangan Aktif</p>
                <h2>{{ $activeCourts }} / {{ $totalCourts }}</h2>
                <small>{{ $totalGuards }} penjaga terdaftar</small>
            </div>

        </section>

        <!-- GRAFIK DAN RINGKASAN -->
        <section class="content-grid">

            <div class="panel">
                <div class="panel-header">
                    <h3>Grafik Pendapatan</h3>
                    <span style="font-size:11px;color:#89968e;">
                        12 Bulan Terakhir
                    </span>
                </div>

                <div class="chart-container">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h3>Ringkasan Operasional</h3>
                </div>

                <div class="summary-item">
                    <div class="summary-left">
                        <div class="summary-icon">▦</div>
                        <div>
                            <strong>Total Lapangan</strong>
                            <small>Seluruh lapangan</small>
                        </div>
                    </div>
                    <span class="summary-number">{{ $totalCourts }}</span>
                </div>

                <div class="summary-item">
                    <div class="summary-left">
                        <div class="summary-icon">✓</div>
                        <div>
                            <strong>Lapangan Aktif</strong>
                            <small>Siap digunakan</small>
                        </div>
                    </div>
                    <span class="summary-number">{{ $activeCourts }}</span>
                </div>

                <div class="summary-item">
                    <div class="summary-left">
                        <div class="summary-icon">♙</div>
                        <div>
                            <strong>Jumlah Penjaga</strong>
                            <small>Petugas terdaftar</small>
                        </div>
                    </div>
                    <span class="summary-number">{{ $totalGuards }}</span>
                </div>

                <div class="summary-item">
                    <div class="summary-left">
                        <div class="summary-icon">◷</div>
                        <div>
                            <strong>Booking Hari Ini</strong>
                            <small>Jadwal hari ini</small>
                        </div>
                    </div>
                    <span class="summary-number">{{ $todayBookings }}</span>
                </div>
            </div>

        </section>

        <!-- BOOKING TERBARU -->
        <section class="table-panel">
            <div class="panel-header">
                <h3>Booking Terbaru</h3>
                <a href="{{ route('owner.reports.bookings') }}">
                    Lihat Semua →
                </a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID BOOKING</th>
                        <th>PELANGGAN</th>
                        <th>LAPANGAN</th>
                        <th>TANGGAL</th>
                        <th>JAM</th>
                        <th>TOTAL</th>
                        <th>STATUS</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($recentBookings as $booking)
                        <tr>
                            <td><strong>#{{ $booking->id }}</strong></td>

                            <td>
                                {{ $booking->customer_name ?: ($booking->user_name ?: '-') }}
                            </td>

                            <td>{{ $booking->court_name ?: '-' }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}
                            </td>

                            <td>
                                {{ substr($booking->start_time, 0, 5) }}
                                -
                                {{ substr($booking->end_time, 0, 5) }}
                            </td>

                            <td>
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>

                            <td>
                                @php
                                    $status = strtolower($booking->status ?? 'pending');
                                @endphp

                                <span class="status {{ $status }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty">
                                Belum ada data booking.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

    </main>
</div>

<script>
    const labels = @json($chartLabels);
    const values = @json($chartValues);

    const ctx = document.getElementById('revenueChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan',
                data: values,
                borderColor: '#23845b',
                backgroundColor: 'rgba(35, 132, 91, 0.12)',
                borderWidth: 3,
                fill: true,
                tension: 0.35,
                pointRadius: 4,
                pointBackgroundColor: '#23845b'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID')
                                .format(context.raw);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID')
                                .format(value);
                        }
                    },
                    grid: {
                        color: '#edf2ee'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>

</body>
</html>