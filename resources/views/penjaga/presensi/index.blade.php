
@extends('penjaga.layouts.app')

@section('content')

<style>
    .presensi-page {
        padding: 10px 0 30px;
    }

    .presensi-card {
        background: #fff;
        border-radius: 16px;
        padding: 45px 25px;
        text-align: center;
        box-shadow: 0 4px 18px rgba(0,0,0,.06);
        border: 1px solid #edf0ed;
        max-width: 850px;
    }

    .presensi-icon {
        width: 85px;
        height: 85px;
        border-radius: 50%;
        background: #e7f5ee;
        color: #08764f;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 38px;
        margin: 0 auto 20px;
    }

    .presensi-button {
        background: #08764f;
        color: white;
        border: none;
        padding: 14px 30px;
        border-radius: 9px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 15px;
    }

    .presensi-button:hover {
        background: #065c3d;
    }

    .presensi-button:disabled {
        background: #8aa99b;
        cursor: not-allowed;
    }

    .presensi-status {
        padding: 15px;
        border-radius: 9px;
        margin: 20px auto;
        max-width: 500px;
        background: #f0f8f3;
        color: #08764f;
    }

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
        animation: muncul .2s ease;
    }

    .modal-martana-icon {
        color: #0b8b5b;
        font-size: 65px;
        margin-bottom: 12px;
    }

    .modal-martana-content h3 {
        color: #183b2e;
        font-size: 23px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .modal-martana-content p {
        color: #68766f;
        margin-bottom: 22px;
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

    @keyframes muncul {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="presensi-page">

    <div style="margin-bottom:25px;">
        <h2 style="font-weight:700;color:#183b2e;">
            Presensi Penjaga
        </h2>
        <p style="color:#75817a;">
            Catat kehadiran masuk penjaga hari ini.
        </p>
    </div>

    <div class="presensi-card">

        <div class="presensi-icon">
            <i class="bi bi-clock-history"></i>
        </div>

        <h3 style="font-weight:700;color:#183b2e;">
            Presensi Masuk
        </h3>

        <p id="tanggalPresensi" style="color:#75817a;"></p>

        <div id="statusPresensi"></div>

        <button
            type="button"
            id="tombolMasuk"
            class="presensi-button"
            onclick="presensiMasuk()">
            <i class="bi bi-box-arrow-in-right"></i>
            Presensi Masuk
        </button>

    </div>
</div>

<!-- POP UP BERHASIL -->
<div id="modalBerhasil" class="modal-martana" hidden>
    <div class="modal-martana-content">

        <div class="modal-martana-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>

        <h3>Berhasil!</h3>

        <p>Berhasil melakukan presensi masuk.</p>

        <button type="button" onclick="tutupModal()">
            OK
        </button>

    </div>
</div>

<script>
    function tanggalLokal() {
        const sekarang = new Date();
        const tahun = sekarang.getFullYear();
        const bulan = String(sekarang.getMonth() + 1).padStart(2, '0');
        const hari = String(sekarang.getDate()).padStart(2, '0');

        return `${tahun}-${bulan}-${hari}`;
    }

    function tampilkanTanggal() {
        document.getElementById('tanggalPresensi').textContent =
            new Date().toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
    }

    function perbaruiPresensi() {
        const data = JSON.parse(
            localStorage.getItem('presensiMartana') || '{}'
        );

        const tombol = document.getElementById('tombolMasuk');
        const status = document.getElementById('statusPresensi');

        if (data.tanggal === tanggalLokal()) {
            status.innerHTML = `
                <div class="presensi-status">
                    <i class="bi bi-check-circle-fill"></i>
                    Kamu sudah melakukan presensi masuk hari ini.
                    <br><br>
                    <strong>Jam masuk: ${data.jam}</strong>
                </div>
            `;

            tombol.disabled = true;
            tombol.innerHTML = `
                <i class="bi bi-check-circle"></i>
                Sudah Presensi Masuk
            `;
        } else {
            status.innerHTML = `
                <div style="color:#75817a;margin:20px 0;">
                    Kamu belum melakukan presensi masuk hari ini.
                </div>
            `;

            tombol.disabled = false;
            tombol.innerHTML = `
                <i class="bi bi-box-arrow-in-right"></i>
                Presensi Masuk
            `;
        }
    }

    function presensiMasuk() {
        const dataLama = JSON.parse(
            localStorage.getItem('presensiMartana') || '{}'
        );

        if (dataLama.tanggal === tanggalLokal()) {
            return;
        }

        const jam = new Date().toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });

        const dataBaru = {
            tanggal: tanggalLokal(),
            jam: jam
        };

        localStorage.setItem(
            'presensiMartana',
            JSON.stringify(dataBaru)
        );

        perbaruiPresensi();

        document.getElementById('modalBerhasil').hidden = false;
    }

    function tutupModal() {
        document.getElementById('modalBerhasil').hidden = true;
    }

    tampilkanTanggal();
    perbaruiPresensi();
</script>

@endsection