
@extends('penjaga.layouts.app')

@section('title', 'Dashboard Penjaga')
@section('page-title', 'Dashboard Penjaga')
@section('page-description', 'Kelola operasional lapangan, presensi, dan laporan harian.')

@section('content')

<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 18px;
    }

    .stat-card, .panel {
        background: #fff;
        border: 1px solid #e8eeeb;
        border-radius: 13px;
        box-shadow: 0 3px 12px rgba(0,0,0,.035);
    }

    .stat-card {
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .stat-icon {
        width: 43px;
        height: 43px;
        flex-shrink: 0;
        border-radius: 11px;
        background: #e9f8f1;
        color: #08764f;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .stat-card small {
        color: #64748b;
        font-size: 11px;
    }

    .stat-card h3 {
        margin-top: 5px;
        font-size: 19px;
        font-weight: 800;
        color: #172b25;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 18px;
    }

    .panel {
        padding: 19px;
        min-width: 0;
    }

    .panel-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 700;
        color: #172b25;
    }

    .panel-title i {
        color: #08764f;
        font-size: 18px;
    }

    .clock {
        text-align: center;
        font-size: 35px;
        font-weight: 800;
        color: #102a22;
        margin: 20px 0;
        font-variant-numeric: tabular-nums;
    }

    .attendance-status {
        width: fit-content;
        max-width: 100%;
        margin: auto;
        padding: 10px 15px;
        background: #ecfdf3;
        color: #087b46;
        border-radius: 10px;
        font-size: 12px;
        text-align: center;
    }

    .attendance-actions {
        display: flex;
        gap: 12px;
        margin-top: 25px;
    }

    .btn-attendance {
        flex: 1;
        padding: 11px 10px;
        border-radius: 8px;
        border: 1px solid #07834f;
        background: white;
        color: #07834f;
        font-size: 12px;
        font-weight: 700;
        text-align: center;
        cursor: pointer;
    }

    .btn-attendance.primary {
        background: #07834f;
        color: white;
    }

    .btn-attendance:hover:not(:disabled) {
        background: #066b41;
        color: white;
    }

    .btn-attendance:disabled {
        background: #e5e7eb;
        color: #64748b;
        border-color: #e5e7eb;
        cursor: not-allowed;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        padding: 14px 0;
        border-bottom: 1px solid #edf0ee;
        font-size: 12px;
    }

    .summary-row:last-child {
        border-bottom: none;
    }

    .summary-row span {
        color: #64748b;
    }

    .table-wrap {
        overflow-x: auto;
    }

    .booking-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 470px;
    }

    .booking-table th {
        background: #f1f5f3;
        color: #475569;
        font-size: 11px;
        text-align: left;
        padding: 12px 9px;
    }

    .booking-table td {
        padding: 13px 9px;
        border-bottom: 1px solid #edf0ee;
        font-size: 11px;
        color: #334155;
    }

    .status {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
    }

    .status-confirmed {
        background: #dcfce7;
        color: #166534;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-other {
        background: #dbeafe;
        color: #1e40af;
    }

    .view-all {
        margin-left: auto;
        color: #08764f;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
    }

    .empty-state {
        padding: 25px;
        text-align: center;
        color: #94a3b8;
        font-size: 12px;
    }

    .report-item {
        padding: 13px 0;
        border-bottom: 1px solid #edf0ee;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .report-item:last-child {
        border-bottom: none;
    }

    .report-icon {
        color: #08764f;
        font-size: 19px;
    }

    .report-item strong {
        font-size: 11px;
        display: block;
        margin-bottom: 5px;
    }

    .report-item p {
        font-size: 11px;
        color: #64748b;
        line-height: 1.5;
    }

    /* POP UP PRESENSI */
    .modal-martana[hidden] {
        display: none !important;
    }

    .modal-martana {
        position: fixed;
        inset: 0;
        z-index: 99999;
        background: rgba(0,0,0,.55);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-martana-content {
        background: white;
        width: 100%;
        max-width: 400px;
        padding: 35px 25px;
        border-radius: 18px;
        text-align: center;
        box-shadow: 0 10px 40px rgba(0,0,0,.2);
    }

    .modal-martana-icon {
        color: #0b8b5b;
        font-size: 60px;
        margin-bottom: 12px;
    }

    .modal-martana-content h3 {
        color: #183b2e;
        font-size: 23px;
        font-weight: 700;
    }

    .modal-martana-content p {
        color: #68766f;
        margin: 12px 0 22px;
    }

    .modal-martana-content button {
        background: #08764f;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 11px 35px;
        cursor: pointer;
        font-weight: 600;
    }

    @media(max-width: 1100px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width: 700px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .attendance-actions {
            flex-direction: column;
        }
    }

    @media(max-width: 420px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $totalBookings = $totalBookings ?? 0;
    $courtsUsed = $courtsUsed ?? 0;
    $totalCourts = $totalCourts ?? 0;
    $todayRevenue = $todayRevenue ?? 0;
    $pendingReports = $pendingReports ?? 0;

    $todayBookings = $todayBookings ?? collect();
    $recentReports = $recentReports ?? collect();
@endphp

{{-- STATISTIK --}}
<div class="stats-grid">

    <div class="stat-card">
        <div class="stat-icon">
            <i class="bi bi-calendar-event"></i>
        </div>
        <div>
            <small>Booking Hari Ini</small>
            <h3>{{ $totalBookings }} Sesi</h3>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="bi bi-people"></i>
        </div>
        <div>
            <small>Lapangan Terpakai</small>
            <h3>{{ $courtsUsed }} / {{ $totalCourts }}</h3>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="bi bi-cash-coin"></i>
        </div>
        <div>
            <small>Pendapatan Hari Ini</small>
            <h3>Rp {{ number_format($todayRevenue, 0, ',', '.') }}</h3>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="bi bi-clipboard-check"></i>
        </div>
        <div>
            <small>Laporan Menunggu</small>
            <h3>{{ $pendingReports }}</h3>
        </div>
    </div>

</div>

{{-- PRESENSI DAN RINGKASAN --}}
<div class="dashboard-grid">

    {{-- PRESENSI HARI INI --}}
    <div class="panel">

        <div class="panel-title">
            <i class="bi bi-clock"></i>
            Presensi Hari Ini
        </div>

        <div class="clock" id="digitalClock">00:00:00</div>

        <div class="attendance-status" id="dashboardStatus">
            <i class="bi bi-info-circle-fill"></i>
            Belum Melakukan Presensi Masuk
        </div>

        <div class="attendance-actions">

            <button
                type="button"
                id="dashboardTombolMasuk"
                class="btn-attendance primary"
                style="width:100%"
                onclick="presensiMasukDashboard()">

                <i class="bi bi-arrow-right-circle"></i>
                Presensi Masuk

            </button>

        </div>

    </div>

    {{-- RINGKASAN PRESENSI --}}
    <div class="panel">

        <div class="panel-title">
            <i class="bi bi-person-check"></i>
            Ringkasan Presensi
        </div>

        <div class="summary-row">
            <span>Tanggal</span>
            <strong id="ringkasanTanggal">
                {{ now()->translatedFormat('d F Y') }}
            </strong>
        </div>

        <div class="summary-row">
            <span>Jam Masuk</span>
            <strong id="ringkasanJamMasuk">-</strong>
        </div>

        <div class="summary-row">
            <span>Status</span>
            <strong id="ringkasanStatus" style="color:#d97706">
                Belum Presensi
            </strong>
        </div>

    </div>

</div>

{{-- POP UP BERHASIL --}}
<div id="modalPresensiDashboard" class="modal-martana" hidden>
    <div class="modal-martana-content">

        <div class="modal-martana-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>

        <h3>Berhasil!</h3>

        <p>Berhasil melakukan presensi masuk.</p>

        <button type="button" onclick="tutupModalDashboard()">
            OK
        </button>

    </div>
</div>

{{-- JADWAL BOOKING --}}
<div class="dashboard-grid">

    <div class="panel">

        <div class="panel-title">
            <i class="bi bi-calendar-week"></i>
            Jadwal Booking Hari Ini

            <a href="{{ url('/penjaga/booking') }}" class="view-all">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="table-wrap">
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Lapangan</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($todayBookings as $booking)

                        @php
                            $status = strtolower($booking->status ?? '');
                        @endphp

                        <tr>
                            <td>
                                {{ $booking->start_time ?? '-' }}
                                -
                                {{ $booking->end_time ?? '-' }}
                            </td>

                            <td>
                                {{ $booking->court->name ?? '-' }}
                            </td>

                            <td>
                                <span class="status
                                    {{ $status == 'confirmed'
                                        ? 'status-confirmed'
                                        : ($status == 'pending'
                                            ? 'status-pending'
                                            : 'status-other') }}">
                                    {{ ucfirst($booking->status ?? 'Tidak diketahui') }}
                                </span>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="3" class="empty-state">
                                <i class="bi bi-calendar-x"
                                   style="font-size:25px"></i>
                                <br>
                                Belum ada booking hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    {{-- LAPORAN TERAKHIR --}}
    <div class="panel">

        <div class="panel-title">
            <i class="bi bi-file-earmark-text"></i>
            Laporan Terakhir

            <a href="{{ url('/penjaga/laporan') }}" class="view-all">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        @forelse($recentReports as $report)

            <div class="report-item">
                <i class="bi bi-file-earmark-text report-icon"></i>

                <div>
                    <strong>
                        {{ $report->judul ?? 'Laporan Operasional' }}
                    </strong>

                    <p>
                        {{ $report->deskripsi ?? '-' }}
                    </p>
                </div>
            </div>

        @empty

            <div class="empty-state">
                <i class="bi bi-file-earmark"
                   style="font-size:25px"></i>
                <br>
                Belum ada laporan terbaru.
            </div>

        @endforelse

    </div>

</div>

<script>
    function tanggalPresensiDashboard() {
        const sekarang = new Date();

        const tahun = sekarang.getFullYear();
        const bulan = String(sekarang.getMonth() + 1).padStart(2, '0');
        const hari = String(sekarang.getDate()).padStart(2, '0');

        return `${tahun}-${bulan}-${hari}`;
    }

    function updateClock() {
        const now = new Date();

        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        document.getElementById('digitalClock').textContent =
            `${hours}:${minutes}:${seconds}`;
    }

    function perbaruiDashboardPresensi() {
        const data = JSON.parse(
            localStorage.getItem('presensiMartana') || '{}'
        );

        const tanggalHariIni = tanggalPresensiDashboard();

        const tombol = document.getElementById('dashboardTombolMasuk');
        const status = document.getElementById('dashboardStatus');

        const jamMasuk = document.getElementById('ringkasanJamMasuk');
        const statusRingkasan = document.getElementById('ringkasanStatus');

        if (data.tanggal === tanggalHariIni) {
            status.innerHTML = `
                <i class="bi bi-check-circle-fill"></i>
                Sudah Presensi Masuk (${data.jam})
            `;

            tombol.disabled = true;
            tombol.innerHTML = `
                <i class="bi bi-check-circle"></i>
                Sudah Presensi Masuk
            `;

            jamMasuk.textContent = data.jam;
            statusRingkasan.textContent = 'Hadir';
            statusRingkasan.style.color = '#08764f';

        } else {
            status.innerHTML = `
                <i class="bi bi-info-circle-fill"></i>
                Belum Melakukan Presensi Masuk
            `;

            tombol.disabled = false;
            tombol.innerHTML = `
                <i class="bi bi-arrow-right-circle"></i>
                Presensi Masuk
            `;

            jamMasuk.textContent = '-';
            statusRingkasan.textContent = 'Belum Presensi';
            statusRingkasan.style.color = '#d97706';
        }
    }

    function presensiMasukDashboard() {
        const tanggalHariIni = tanggalPresensiDashboard();

        const dataLama = JSON.parse(
            localStorage.getItem('presensiMartana') || '{}'
        );

        if (dataLama.tanggal === tanggalHariIni) {
            return;
        }

        const jam = new Date().toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });

        const dataBaru = {
            tanggal: tanggalHariIni,
            jam: jam
        };

        localStorage.setItem(
            'presensiMartana',
            JSON.stringify(dataBaru)
        );

        perbaruiDashboardPresensi();

        document.getElementById('modalPresensiDashboard').hidden = false;
    }

    function tutupModalDashboard() {
        document.getElementById('modalPresensiDashboard').hidden = true;
    }

    updateClock();
    setInterval(updateClock, 1000);

    perbaruiDashboardPresensi();
</script>

@endsection