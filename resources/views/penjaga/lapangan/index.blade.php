@extends('penjaga.layouts.app')

@section('title', 'Kelola Lapangan')
@section('page-title', 'Kelola Data Lapangan')
@section('page-description', 'Kelola informasi, harga, dan status lapangan MARTANA.')

@section('content')

<style>
    .court-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .court-stat {
        background: white;
        border: 1px solid #e8eeeb;
        border-radius: 13px;
        padding: 19px;
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .court-stat-icon {
        width: 43px;
        height: 43px;
        border-radius: 11px;
        background: #e9f8f1;
        color: #08764f;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .court-stat small {
        color: #64748b;
        font-size: 11px;
    }

    .court-stat h3 {
        color: #172b25;
        font-size: 20px;
        font-weight: 800;
        margin-top: 4px;
    }

    .court-panel {
        background: white;
        border: 1px solid #e8eeeb;
        border-radius: 13px;
        padding: 20px;
    }

    .court-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .court-table-wrap {
        overflow-x: auto;
    }

    .court-table {
        width: 100%;
        min-width: 700px;
        border-collapse: collapse;
    }

    .court-table th {
        background: #f1f5f3;
        color: #475569;
        font-size: 11px;
        text-align: left;
        padding: 13px 11px;
    }

    .court-table td {
        padding: 14px 11px;
        border-bottom: 1px solid #edf0ee;
        font-size: 12px;
        color: #334155;
    }

    .court-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
    }

    .court-active {
        background: #dcfce7;
        color: #166534;
    }

    .court-inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    .court-button {
        border: 0;
        border-radius: 7px;
        padding: 8px 11px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-add {
        background: #08764f;
        color: white;
        padding: 11px 15px;
        border-radius: 8px;
    }

    .btn-edit {
        background: #e0f2fe;
        color: #075985;
    }

    .btn-delete {
        background: #fee2e2;
        color: #991b1b;
    }

    .court-message {
        padding: 13px 15px;
        border-radius: 9px;
        margin-bottom: 16px;
        font-size: 13px;
    }

    .court-success {
        background: #dcfce7;
        color: #166534;
    }

    .court-error {
        background: #fee2e2;
        color: #991b1b;
    }

    /* MODAL */
    .court-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 3000;
        background: rgba(0, 0, 0, .55);
        justify-content: center;
        align-items: center;
        padding: 18px;
    }

    .court-modal.show {
        display: flex;
    }

    .court-modal-content {
        width: 100%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        background: white;
        border-radius: 15px;
        padding: 24px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, .2);
    }

    .court-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .court-modal-header h3 {
        font-size: 18px;
        color: #183b2e;
    }

    .court-close {
        width: 32px;
        height: 32px;
        border: 0;
        border-radius: 8px;
        background: #f1f5f3;
        font-size: 20px;
        cursor: pointer;
    }

    .court-field {
        margin-bottom: 16px;
    }

    .court-field label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #33463e;
        margin-bottom: 7px;
    }

    .court-field input,
    .court-field select {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #dce5df;
        border-radius: 8px;
        font-size: 13px;
        outline: none;
    }

    .court-field input:focus,
    .court-field select:focus {
        border-color: #08764f;
    }

    .court-modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 9px;
        margin-top: 22px;
    }

    .btn-save {
        background: #08764f;
        color: white;
        padding: 10px 16px;
    }

    .btn-cancel {
        background: #eef3ef;
        color: #42534a;
        padding: 10px 16px;
    }

    @media(max-width: 700px) {
        .court-stats {
            grid-template-columns: 1fr;
        }
    }
</style>

{{-- NOTIFIKASI --}}
@if(session('success'))
    <div class="court-message court-success">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="court-message court-error">
        <i class="bi bi-exclamation-circle-fill"></i>
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="court-message court-error">
        <strong>Periksa kembali data:</strong>
        <ul style="margin:7px 0 0 18px">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- STATISTIK LAPANGAN --}}
<div class="court-stats">

    <div class="court-stat">
        <div class="court-stat-icon">
            <i class="bi bi-dribbble"></i>
        </div>
        <div>
            <small>Total Lapangan</small>
            <h3>{{ $totalCourts }}</h3>
        </div>
    </div>

    <div class="court-stat">
        <div class="court-stat-icon">
            <i class="bi bi-check-circle"></i>
        </div>
        <div>
            <small>Lapangan Aktif</small>
            <h3>{{ $activeCourts }}</h3>
        </div>
    </div>

    <div class="court-stat">
        <div class="court-stat-icon">
            <i class="bi bi-pause-circle"></i>
        </div>
        <div>
            <small>Lapangan Nonaktif</small>
            <h3>{{ $inactiveCourts }}</h3>
        </div>
    </div>

</div>

{{-- TABEL LAPANGAN --}}
<div class="court-panel">

    <div class="court-toolbar">

        <div>
            <h3 style="font-size:16px;font-weight:700;color:#183b2e">
                Daftar Lapangan
            </h3>

            <p style="font-size:11px;color:#84918b;margin-top:5px">
                Kelola nama, harga, dan status operasional lapangan.
            </p>
        </div>

        <button
            type="button"
            class="court-button btn-add"
            onclick="openCreateCourt()">

            <i class="bi bi-plus-lg"></i>
            Tambah Lapangan

        </button>

    </div>

    <div class="court-table-wrap">

        <table class="court-table">

            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Lapangan</th>
                    <th>Harga Per Jam</th>
                    <th>Total Booking</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($courts as $court)

                    <tr>

                        <td>
                            {{ $courts->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <strong>{{ $court->name }}</strong>
                        </td>

                        <td>
                            Rp{{ number_format($court->price_per_hour, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ $court->bookings_count }} Booking
                        </td>

                        <td>

                            @if($court->is_active)

                                <span class="court-status court-active">
                                    Aktif
                                </span>

                            @else

                                <span class="court-status court-inactive">
                                    Nonaktif
                                </span>

                            @endif

                        </td>

                        <td>

                            <div style="display:flex;gap:6px;flex-wrap:wrap">

                                {{-- EDIT --}}
                                <button
                                    type="button"
                                    class="court-button btn-edit"
                                    onclick="openEditCourt(this)"

                                    data-update-url="{{ route('penjaga.lapangan.update', $court->id) }}"
                                    data-name="{{ $court->name }}"
                                    data-price="{{ $court->price_per_hour }}"
                                    data-active="{{ $court->is_active ? 1 : 0 }}">

                                    <i class="bi bi-pencil"></i>
                                    Edit

                                </button>

                                {{-- HAPUS --}}
                                <form
                                    action="{{ route('penjaga.lapangan.destroy', $court->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus lapangan {{ $court->name }}? Lapangan hanya dapat dihapus jika belum memiliki riwayat booking.')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="court-button btn-delete">

                                        <i class="bi bi-trash"></i>
                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" style="text-align:center;padding:30px;color:#94a3b8">
                            Belum ada data lapangan.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div style="margin-top:18px">
        {{ $courts->links() }}
    </div>

</div>

{{-- MODAL TAMBAH / EDIT --}}
<div class="court-modal" id="courtModal">

    <div class="court-modal-content">

        <div class="court-modal-header">

            <h3 id="courtModalTitle">
                Tambah Lapangan
            </h3>

            <button
                type="button"
                class="court-close"
                onclick="closeCourtModal()">

                &times;

            </button>

        </div>

        <form
            id="courtForm"
            action="{{ route('penjaga.lapangan.store') }}"
            method="POST">

            @csrf

            <div id="courtMethodField"></div>

            <div class="court-field">

                <label for="court_name">
                    Nama Lapangan
                </label>

                <input
                    type="text"
                    id="court_name"
                    name="name"
                    maxlength="255"
                    placeholder="Contoh: Lapangan Martana Prime"
                    required>

            </div>

            <div class="court-field">

                <label for="court_price">
                    Harga Per Jam (Rp)
                </label>

                <input
                    type="number"
                    id="court_price"
                    name="price_per_hour"
                    min="1"
                    step="1000"
                    placeholder="Contoh: 150000"
                    required>

            </div>

            <div class="court-field">

                <label for="court_active">
                    Status Lapangan
                </label>

                <select
                    id="court_active"
                    name="is_active"
                    required>

                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>

                </select>

            </div>

            <div class="court-modal-actions">

                <button
                    type="button"
                    class="court-button btn-cancel"
                    onclick="closeCourtModal()">

                    Batal

                </button>

                <button
                    type="submit"
                    class="court-button btn-save"
                    id="courtSubmitButton">

                    Simpan Lapangan

                </button>

            </div>

        </form>

    </div>

</div>

<script>
    const courtModal = document.getElementById('courtModal');

    const courtForm = document.getElementById('courtForm');

    const courtStoreUrl = @json(route('penjaga.lapangan.store'));

    // MODAL TAMBAH
    function openCreateCourt() {

        courtForm.reset();

        courtForm.action = courtStoreUrl;

        document.getElementById('courtMethodField').innerHTML = '';

        document.getElementById('courtModalTitle').textContent =
            'Tambah Lapangan';

        document.getElementById('courtSubmitButton').textContent =
            'Tambah Lapangan';

        document.getElementById('court_active').value = '1';

        courtModal.classList.add('show');
    }

    // MODAL EDIT
    function openEditCourt(button) {

        courtForm.reset();

        courtForm.action = button.dataset.updateUrl;

        document.getElementById('courtMethodField').innerHTML =
            '<input type="hidden" name="_method" value="PUT">';

        document.getElementById('courtModalTitle').textContent =
            'Edit Lapangan';

        document.getElementById('courtSubmitButton').textContent =
            'Simpan Perubahan';

        document.getElementById('court_name').value =
            button.dataset.name;

        document.getElementById('court_price').value =
            button.dataset.price;

        document.getElementById('court_active').value =
            button.dataset.active;

        courtModal.classList.add('show');
    }

    // TUTUP MODAL
    function closeCourtModal() {
        courtModal.classList.remove('show');
    }

    // KLIK AREA LUAR MODAL
    courtModal.addEventListener('click', function(event) {
        if (event.target === courtModal) {
            closeCourtModal();
        }
    });

    // TOMBOL ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeCourtModal();
        }
    });
</script>

@endsection