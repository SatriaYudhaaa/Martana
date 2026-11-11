
@extends('penjaga.layouts.app')

@section('title', 'Kelola Akun')
@section('page-title', 'Kelola Akun Pelanggan')
@section('page-description', 'Lihat dan kelola informasi akun pelanggan Martana Futsal.')

@section('content')

<style>
    .account-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 22px;
    }

    .account-card {
        background: white;
        border: 1px solid #e8eeeb;
        border-radius: 13px;
        padding: 20px;
        box-shadow: 0 3px 12px rgba(0,0,0,.035);
    }

    .account-card small {
        color: #64748b;
    }

    .account-card h3 {
        font-size: 25px;
        font-weight: 800;
        color: #08764f;
        margin-top: 8px;
    }

    .account-panel {
        background: white;
        border: 1px solid #e8eeeb;
        border-radius: 13px;
        padding: 20px;
    }

    .account-toolbar {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .account-toolbar input,
    .account-toolbar select {
        padding: 11px 13px;
        border: 1px solid #dce5df;
        border-radius: 8px;
        outline: none;
        background: white;
    }

    .account-toolbar input {
        flex: 1;
        min-width: 200px;
    }

    .account-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 650px;
    }

    .account-table th {
        background: #f1f5f3;
        color: #475569;
        text-align: left;
        padding: 14px 12px;
        font-size: 12px;
    }

    .account-table td {
        padding: 14px 12px;
        border-bottom: 1px solid #edf0ee;
        font-size: 12px;
        color: #334155;
    }

    .account-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        background: #dcfce7;
        color: #166534;
        font-size: 11px;
        font-weight: 700;
    }

    .detail-button {
        border: none;
        background: #e9f8f1;
        color: #08764f;
        padding: 7px 12px;
        border-radius: 7px;
        cursor: pointer;
        font-weight: 600;
        font-size: 11px;
    }

    .account-modal[hidden] {
        display: none !important;
    }

    .account-modal {
        position: fixed;
        inset: 0;
        z-index: 99999;
        background: rgba(0,0,0,.5);
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .account-modal-content {
        background: white;
        border-radius: 15px;
        padding: 25px;
        width: 100%;
        max-width: 430px;
    }

    .account-modal-content h3 {
        color: #183b2e;
        margin-bottom: 20px;
    }

    .detail-row {
        padding: 12px 0;
        border-bottom: 1px solid #edf0ee;
        font-size: 13px;
    }

    .detail-row span {
        color: #64748b;
        display: block;
        margin-bottom: 5px;
    }

    .close-button {
        margin-top: 20px;
        background: #08764f;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        cursor: pointer;
    }

    @media(max-width: 600px) {
        .account-stats {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    // DATA SIMULASI PELANGGAN
    $pelanggan = [
        [
            'id' => 1,
            'nama' => 'Andi Saputra',
            'email' => 'andi@gmail.com',
            'telepon' => '081234567890',
            'tanggal' => '05 November 2026',
            'status' => 'Aktif'
        ],
        [
            'id' => 2,
            'nama' => 'Budi Pratama',
            'email' => 'budi@gmail.com',
            'telepon' => '081298765432',
            'tanggal' => '06 November 2026',
            'status' => 'Aktif'
        ],
        [
            'id' => 3,
            'nama' => 'Citra Amelia',
            'email' => 'citra@gmail.com',
            'telepon' => '082112345678',
            'tanggal' => '06 November 2026',
            'status' => 'Aktif'
        ],
        [
            'id' => 4,
            'nama' => 'Dimas Ramadhan',
            'email' => 'dimas@gmail.com',
            'telepon' => '085712345678',
            'tanggal' => '07 November 2026',
            'status' => 'Aktif'
        ],
        [
            'id' => 5,
            'nama' => 'Eka Putri',
            'email' => 'eka@gmail.com',
            'telepon' => '081345678912',
            'tanggal' => '07 November 2026',
            'status' => 'Aktif'
        ],
    ];
@endphp

{{-- STATISTIK --}}
<div class="account-stats">

    <div class="account-card">
        <small>
            <i class="bi bi-people me-2"></i>
            Total Akun Pelanggan
        </small>
        <h3 id="totalPelanggan">{{ count($pelanggan) }}</h3>
    </div>

    <div class="account-card">
        <small>
            <i class="bi bi-person-check me-2"></i>
            Akun Aktif
        </small>
        <h3>{{ count(array_filter($pelanggan, fn($p) => $p['status'] === 'Aktif')) }}</h3>
    </div>

</div>

{{-- TABEL PELANGGAN --}}
<div class="account-panel">

    <h4 style="font-size:16px;font-weight:700;margin-bottom:18px;">
        <i class="bi bi-person-lines-fill me-2" style="color:#08764f;"></i>
        Daftar Akun Pelanggan
    </h4>

    <div class="account-toolbar">

        <input
            type="text"
            id="cariPelanggan"
            placeholder="Cari nama atau email pelanggan..."
            oninput="filterPelanggan()">

        <select id="filterStatus" onchange="filterPelanggan()">
            <option value="">Semua Status</option>
            <option value="Aktif">Aktif</option>
        </select>

    </div>

    <div style="overflow-x:auto;">
        <table class="account-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Pelanggan</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody id="daftarPelanggan">

                @foreach($pelanggan as $index => $p)
                    <tr
                        data-nama="{{ strtolower($p['nama']) }}"
                        data-email="{{ strtolower($p['email']) }}"
                        data-status="{{ $p['status'] }}">

                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $p['nama'] }}</strong></td>
                        <td>{{ $p['email'] }}</td>
                        <td>{{ $p['telepon'] }}</td>

                        <td>
                            <span class="account-badge">
                                {{ $p['status'] }}
                            </span>
                        </td>

                        <td>
                            <button
                                type="button"
                                class="detail-button"
                                onclick='lihatDetail(@json($p))'>
                                <i class="bi bi-eye"></i>
                                Detail
                            </button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div id="pesanKosong"
         style="display:none;text-align:center;padding:25px;color:#94a3b8;">
        Pelanggan tidak ditemukan.
    </div>

    <p style="font-size:11px;color:#94a3b8;margin-top:15px;">
        * Data di halaman ini masih berupa simulasi.
    </p>

</div>

{{-- MODAL DETAIL --}}
<div id="modalDetailAkun" class="account-modal" hidden>
    <div class="account-modal-content">

        <h3>
            <i class="bi bi-person-circle me-2" style="color:#08764f;"></i>
            Detail Pelanggan
        </h3>

        <div class="detail-row">
            <span>Nama Lengkap</span>
            <strong id="detailNama"></strong>
        </div>

        <div class="detail-row">
            <span>Email</span>
            <strong id="detailEmail"></strong>
        </div>

        <div class="detail-row">
            <span>Nomor HP</span>
            <strong id="detailTelepon"></strong>
        </div>

        <div class="detail-row">
            <span>Tanggal Registrasi</span>
            <strong id="detailTanggal"></strong>
        </div>

        <div class="detail-row">
            <span>Status Akun</span>
            <strong id="detailStatus"></strong>
        </div>

        <button type="button"
                class="close-button"
                onclick="tutupDetail()">
            Tutup
        </button>

    </div>
</div>

<script>
    function filterPelanggan() {
        const keyword = document
            .getElementById('cariPelanggan')
            .value.toLowerCase();

        const status = document
            .getElementById('filterStatus')
            .value;

        const rows = document.querySelectorAll(
            '#daftarPelanggan tr'
        );

        let jumlahTampil = 0;

        rows.forEach(row => {
            const nama = row.dataset.nama;
            const email = row.dataset.email;
            const statusAkun = row.dataset.status;

            const cocokKeyword =
                nama.includes(keyword) ||
                email.includes(keyword);

            const cocokStatus =
                status === '' || statusAkun === status;

            const tampil = cocokKeyword && cocokStatus;

            row.style.display = tampil ? '' : 'none';

            if (tampil) jumlahTampil++;
        });

        document.getElementById('pesanKosong').style.display =
            jumlahTampil === 0 ? 'block' : 'none';
    }

    function lihatDetail(pelanggan) {
        document.getElementById('detailNama').textContent =
            pelanggan.nama;

        document.getElementById('detailEmail').textContent =
            pelanggan.email;

        document.getElementById('detailTelepon').textContent =
            pelanggan.telepon;

        document.getElementById('detailTanggal').textContent =
            pelanggan.tanggal;

        document.getElementById('detailStatus').textContent =
            pelanggan.status;

        document.getElementById('modalDetailAkun').hidden = false;
    }

    function tutupDetail() {
        document.getElementById('modalDetailAkun').hidden = true;
    }

    document.getElementById('modalDetailAkun').addEventListener(
        'click',
        function(event) {
            if (event.target === this) {
                tutupDetail();
            }
        }
    );
</script>

@endsection