@extends('owner.layouts.app')

@section('title', 'Kelola Penjaga')
@section('page-title', 'Kelola Penjaga')
@section('page-description', 'Kelola informasi, jadwal kerja, dan kehadiran penjaga Martana.')

@section('content')

<style>
    .guard-layout {
        display: grid;
        grid-template-columns: minmax(0, 2fr) minmax(260px, .9fr);
        gap: 18px;
    }

    .guard-stat {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .guard-stat-icon {
        width: 43px;
        height: 43px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        background: #e1f5eb;
        color: #087b58;
        font-size: 19px;
        flex-shrink: 0;
    }

    .guard-stat p {
        margin: 0 0 6px;
    }

    .guard-stat h2 {
        font-size: 22px;
    }

    .guard-stat small {
        color: #14815b;
    }

    .search-box {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .search-box input {
        width: 190px;
        padding: 10px 12px;
        border: 1px solid #dfe9e2;
        border-radius: 9px;
        outline: none;
        font-size: 12px;
    }

    .guard-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #e1f5eb;
        color: #087b58;
        display: inline-grid;
        place-items: center;
        font-weight: bold;
        margin-right: 8px;
        vertical-align: middle;
    }

    .guard-name {
        display: inline-flex;
        align-items: center;
        color: #284d3c;
        font-weight: 600;
    }

    .action-group {
        display: flex;
        gap: 7px;
    }

    .icon-btn {
        width: 33px;
        height: 33px;
        border: 0;
        border-radius: 8px;
        cursor: pointer;
        font-size: 15px;
    }

    .edit-btn {
        background: #e0f5ec;
        color: #087b58;
    }

    .delete-btn {
        background: #fde8e8;
        color: #c34242;
    }

    .attendance-ring {
        width: 150px;
        height: 150px;
        margin: 10px auto 20px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        background: conic-gradient(
            #079b70 {{ $weeklyRate }}%,
            #e8efec {{ $weeklyRate }}%
        );
        position: relative;
    }

    .attendance-ring::before {
        content: "";
        position: absolute;
        width: 112px;
        height: 112px;
        background: white;
        border-radius: 50%;
    }

    .ring-text {
        z-index: 1;
        text-align: center;
    }

    .ring-text strong {
        font-size: 25px;
        color: #087b58;
        display: block;
    }

    .ring-text span {
        font-size: 11px;
        color: #60776b;
    }

    .legend {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 12px 0;
        font-size: 12px;
        color: #557064;
    }

    .legend-dot {
        width: 9px;
        height: 9px;
        display: inline-block;
        border-radius: 50%;
        margin-right: 7px;
    }

    .shift-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
        padding: 13px 0;
        border-bottom: 1px solid #edf1ee;
        font-size: 11px;
    }

    .shift-item:last-child {
        border-bottom: none;
    }

    .shift-name {
        font-weight: 600;
        color: #284d3c;
    }

    .shift-time {
        color: #718278;
        display: block;
        margin-top: 4px;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 500;
        background: rgba(10, 35, 25, .5);
        align-items: center;
        justify-content: center;
        padding: 15px;
    }

    .modal-overlay.show {
        display: flex;
    }

    .modal-box {
        background: white;
        width: 100%;
        max-width: 460px;
        max-height: 90vh;
        overflow-y: auto;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 15px 50px rgba(0,0,0,.15);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .modal-header h3 {
        color: #214536;
        font-size: 17px;
    }

    .close-modal {
        border: 0;
        background: none;
        font-size: 23px;
        cursor: pointer;
        color: #718278;
    }

    .form-field {
        margin-bottom: 14px;
    }

    .form-field label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 7px;
        color: #557064;
    }

    .form-field input,
    .form-field select {
        width: 100%;
        padding: 11px 12px;
        border: 1px solid #dfe9e2;
        border-radius: 8px;
        font-size: 13px;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 20px;
    }

    .alert-success {
        padding: 13px 16px;
        border-radius: 9px;
        background: #e1f5e9;
        color: #24764c;
        margin-bottom: 18px;
        font-size: 13px;
    }

    .alert-error {
        padding: 12px;
        border-radius: 8px;
        background: #fde8e8;
        color: #b33b3b;
        font-size: 12px;
        margin-bottom: 15px;
    }

    @media(max-width: 1050px) {
        .guard-layout {
            grid-template-columns: 1fr;
        }
    }
</style>

@if(session('success'))
    <div class="alert-success">
        ✓ {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert-error">
        <strong>Periksa kembali data:</strong>
        <ul style="margin:7px 0 0 18px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- STATISTIK -->
<section class="stats">

    <div class="stat-card">
        <div class="guard-stat">
            <div class="guard-stat-icon">♟</div>
            <div>
                <p>Total Penjaga</p>
                <h2>{{ $totalGuards }} Orang</h2>
                <small>{{ $activeGuards }} aktif</small>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="guard-stat">
            <div class="guard-stat-icon">✓</div>
            <div>
                <p>Hadir Hari Ini</p>
                <h2>{{ $presentToday }} Orang</h2>
                <small>Presensi tercatat</small>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="guard-stat">
            <div class="guard-stat-icon">◷</div>
            <div>
                <p>Tidak Hadir</p>
                <h2>{{ $absentToday }} Orang</h2>
                <small>Dari jadwal shift hari ini</small>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="guard-stat">
            <div class="guard-stat-icon">◉</div>
            <div>
                <p>Rata-rata Kehadiran</p>
                <h2>{{ $attendanceRate }}%</h2>
                <small>Perbandingan hari ini</small>
            </div>
        </div>
    </div>

</section>

<div class="guard-layout">

    <!-- DAFTAR PENJAGA -->
    <section class="panel">

        <div class="panel-header" style="flex-wrap:wrap;">
            <h3>♟ Daftar Penjaga</h3>

            <div class="search-box">
                <form action="{{ route('owner.guards.index') }}" method="GET">
                    <input
                        type="search"
                        name="search"
                        placeholder="Cari nama penjaga..."
                        value="{{ $search }}"
                    >
                </form>

                <button class="btn btn-primary" onclick="openAddModal()">
                    + Tambah Penjaga
                </button>
            </div>
        </div>

        <div class="table-wrapper">
            <table style="min-width:650px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Penjaga</th>
                        <th>Kontak</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($guards as $index => $guard)
                        <tr>
                            <td>{{ $guards->firstItem() + $index }}</td>

                            <td>
                                <span class="guard-name">
                                    <span class="guard-avatar">
                                        {{ strtoupper(substr($guard->name, 0, 1)) }}
                                    </span>
                                    {{ $guard->name }}
                                </span>
                            </td>

                            <td>{{ $guard->phone ?: '-' }}</td>

                            <td>
                                @if($guard->is_active)
                                    <span class="status success">● Aktif</span>
                                @else
                                    <span class="status danger">● Nonaktif</span>
                                @endif
                            </td>

                            <td>
                                <div class="action-group">
                                    <button
                                        class="icon-btn edit-btn"
                                        title="Edit penjaga"
                                        onclick='openEditModal(@json($guard))'
                                    >✎</button>

                                    <form
                                        action="{{ route('owner.guards.destroy', $guard->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus penjaga ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button class="icon-btn delete-btn" title="Hapus penjaga">
                                            ♜
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty">
                                Belum ada data penjaga.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            <span>
                Menampilkan {{ $guards->firstItem() ?? 0 }}
                - {{ $guards->lastItem() ?? 0 }}
                dari {{ $guards->total() }} data
            </span>

            {{ $guards->links() }}
        </div>

    </section>

    <!-- REKAP DAN SHIFT -->
    <div>

        <section class="panel">
            <div class="panel-header">
                <h3>▣ Rekap Presensi</h3>
                <span style="font-size:11px;color:#819087;">Minggu Ini</span>
            </div>

            <div class="attendance-ring">
                <div class="ring-text">
                    <strong>{{ $weeklyRate }}%</strong>
                    <span>Kehadiran</span>
                </div>
            </div>

            <div class="legend">
                <span>
                    <span class="legend-dot" style="background:#079b70;"></span>
                    Hadir
                </span>
                <strong>{{ $weeklyPresent }} Catatan</strong>
            </div>

            <div class="legend">
                <span>
                    <span class="legend-dot" style="background:#aebbc5;"></span>
                    Catatan presensi lainnya
                </span>
                <strong>{{ max(0, $weeklyTotal - $weeklyPresent) }}</strong>
            </div>

            <p style="font-size:10px;color:#89968e;margin-top:12px;">
                Persentase dihitung dari catatan presensi yang tersimpan minggu ini.
            </p>
        </section>

        <section class="panel">
            <div class="panel-header">
                <h3>◷ Jadwal Shift Penjaga</h3>
                <span style="font-size:11px;color:#819087;">
                    {{ $todaySchedules->count() }} Jadwal
                </span>
            </div>

            @forelse($todaySchedules as $shift)
                <div class="shift-item">
                    <div>
                        <span class="shift-name">{{ $shift->name }}</span>
                        <span class="shift-time">
                            {{ substr($shift->start_time, 0, 5) }}
                            - {{ substr($shift->end_time, 0, 5) }}
                        </span>
                    </div>

                    @php
                        $attendance = $todayAttendances->get($shift->guard_id);
                    @endphp

                    @if($attendance && $attendance->status === 'hadir')
                        <span class="status success">Hadir</span>
                    @elseif($attendance)
                        <span class="status danger">{{ ucfirst($attendance->status) }}</span>
                    @else
                        <span class="status">Belum Absen</span>
                    @endif
                </div>
            @empty
                <div class="empty">
                    Belum ada jadwal shift untuk hari ini.
                </div>
            @endforelse
        </section>

    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal-overlay" id="addModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Tambah Penjaga</h3>
            <button class="close-modal" onclick="closeModal('addModal')">×</button>
        </div>

        <form action="{{ route('owner.guards.store') }}" method="POST">
            @csrf

            <div class="form-field">
                <label>Nama Penjaga</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-field">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-field">
                <label>Nomor Telepon</label>
                <input type="text" name="phone" required>
            </div>

            <div class="form-field">
                <label>Password</label>
                <input type="password" name="password" minlength="8" required>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-light" onclick="closeModal('addModal')">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    Simpan Penjaga
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal-overlay" id="editModal">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Edit Penjaga</h3>
            <button class="close-modal" onclick="closeModal('editModal')">×</button>
        </div>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <div class="form-field">
                <label>Nama Penjaga</label>
                <input type="text" name="name" id="editName" required>
            </div>

            <div class="form-field">
                <label>Email</label>
                <input type="email" name="email" id="editEmail" required>
            </div>

            <div class="form-field">
                <label>Nomor Telepon</label>
                <input type="text" name="phone" id="editPhone" required>
            </div>

            <div class="form-field">
                <label>Password Baru (kosongkan jika tidak diganti)</label>
                <input type="password" name="password" minlength="8">
            </div>

            <div class="form-field">
                <label>Status Akun</label>
                <select name="is_active" id="editActive" required>
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-light" onclick="closeModal('editModal')">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddModal() {
        document.getElementById('addModal').classList.add('show');
    }

    function openEditModal(guard) {
        document.getElementById('editForm').action =
            "{{ url('/owner/kelola/penjaga') }}/" + guard.id;

        document.getElementById('editName').value = guard.name;
        document.getElementById('editEmail').value = guard.email;
        document.getElementById('editPhone').value = guard.phone || '';
        document.getElementById('editActive').value = guard.is_active ? '1' : '0';

        document.getElementById('editModal').classList.add('show');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('show');
    }

    document.querySelectorAll('.modal-overlay').forEach(function(modal) {
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.remove('show');
            }
        });
    });
</script>

@endsection