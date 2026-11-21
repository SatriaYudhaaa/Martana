
@extends('penjaga.layouts.app')

@section('title', 'Kelola Akun')
@section('page-title', 'Kelola Akun Pelanggan')
@section('page-description', 'Lihat dan kelola informasi akun pelanggan Martana Futsal.')

@section('content')

<style>
    .account-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 22px;
    }

    .account-card,
    .account-panel {
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

    .account-toolbar {
        display: flex;
        gap: 12px;
        margin: 18px 0;
        flex-wrap: wrap;
    }

    .account-toolbar input,
    .account-toolbar select {
        padding: 11px 13px;
        border: 1px solid #dce5df;
        border-radius: 8px;
        outline: none;
        background: white;
        font-family: inherit;
    }

    .account-toolbar input {
        flex: 1;
        min-width: 200px;
    }

    .account-toolbar button {
        padding: 11px 18px;
        border: none;
        border-radius: 8px;
        background: #08764f;
        color: white;
        cursor: pointer;
        font-weight: 600;
    }

    .reset-button {
        display: inline-flex;
        align-items: center;
        padding: 11px 15px;
        border: 1px solid #dce5df;
        border-radius: 8px;
        color: #475569;
        text-decoration: none;
        font-size: 13px;
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
        font-size: 11px;
        font-weight: 700;
    }

    .badge-active {
        background: #dcfce7;
        color: #166534;
    }

    .badge-inactive {
        background: #fee2e2;
        color: #991b1b;
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

    .pagination-wrapper {
        margin-top: 18px;
    }

    @media(max-width: 850px) {
        .account-stats {
            grid-template-columns: 1fr;
        }
    }
</style>

{{-- STATISTIK --}}
<div class="account-stats">

    <div class="account-card">
        <small>
            <i class="bi bi-people me-2"></i>
            Total Akun Pelanggan
        </small>
        <h3>{{ $totalPelanggan }}</h3>
    </div>

    <div class="account-card">
        <small>
            <i class="bi bi-person-check me-2"></i>
            Akun Aktif
        </small>
        <h3>{{ $totalAktif }}</h3>
    </div>

    <div class="account-card">
        <small>
            <i class="bi bi-person-x me-2"></i>
            Akun Nonaktif
        </small>
        <h3>{{ $totalNonaktif }}</h3>
    </div>

</div>

{{-- DAFTAR PELANGGAN --}}
<div class="account-panel">

    <h4 style="font-size:16px;font-weight:700;">
        <i class="bi bi-person-lines-fill me-2" style="color:#08764f;"></i>
        Daftar Akun Pelanggan
    </h4>

    {{-- PENCARIAN DAN FILTER --}}
    <form action="{{ route('penjaga.kelola-akun') }}" method="GET">
        <div class="account-toolbar">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama atau email pelanggan..."
            >

            <select name="status">
                <option value="">Semua Status</option>
                <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>

            <button type="submit">
                <i class="bi bi-search"></i>
                Cari
            </button>

            <a href="{{ route('penjaga.kelola-akun') }}" class="reset-button">
                Reset
            </a>

        </div>
    </form>

    {{-- TABEL --}}
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

            <tbody>

                @forelse($users as $index => $user)

                    <tr>

                        <td>
                            {{ $users->firstItem() + $index }}
                        </td>

                        <td>
                            <strong>{{ $user->name }}</strong>
                        </td>

                        <td>{{ $user->email }}</td>

                        <td>{{ $user->phone ?: '-' }}</td>

                        <td>
                            @if($user->is_active)
                                <span class="account-badge badge-active">
                                    Aktif
                                </span>
                            @else
                                <span class="account-badge badge-inactive">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <td>
                            <button
                                type="button"
                                class="detail-button"
                                data-name="{{ $user->name }}"
                                data-email="{{ $user->email }}"
                                data-phone="{{ $user->phone ?: '-' }}"
                                data-date="{{ $user->created_at ? $user->created_at->format('d F Y') : '-' }}"
                                data-status="{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}"
                                onclick="lihatDetail(this)"
                            >
                                <i class="bi bi-eye"></i>
                                Detail
                            </button>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" style="text-align:center;padding:25px;">
                            Tidak ada akun pelanggan ditemukan.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- PAGINATION --}}
    <div class="pagination-wrapper">
        {{ $users->links() }}
    </div>

    <p style="font-size:11px;color:#94a3b8;margin-top:15px;">
        Data pelanggan diambil langsung dari database MARTANA.
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

        <button
            type="button"
            class="close-button"
            onclick="tutupDetail()"
        >
            Tutup
        </button>

    </div>

</div>

<script>
    function lihatDetail(button) {
        document.getElementById('detailNama').textContent =
            button.dataset.name;

        document.getElementById('detailEmail').textContent =
            button.dataset.email;

        document.getElementById('detailTelepon').textContent =
            button.dataset.phone;

        document.getElementById('detailTanggal').textContent =
            button.dataset.date;

        document.getElementById('detailStatus').textContent =
            button.dataset.status;

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

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            tutupDetail();
        }
    });
</script>

@endsection
