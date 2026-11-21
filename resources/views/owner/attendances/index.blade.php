@extends('owner.layouts.app')

@section('title', 'Presensi Penjaga')
@section('page-title', 'Presensi Penjaga')
@section('page-description', 'Pantau rekap kehadiran bulanan penjaga MARTANA.')

@section('content')

<div class="stats">
    <div class="stat-card">
        <p>Total Penjaga Aktif</p>
        <h2>{{ $totalGuards }}</h2>
        <small>Penjaga terdaftar aktif</small>
    </div>

    <div class="stat-card">
        <p>Total Hadir</p>
        <h2>{{ $totalCheckins }}</h2>
        <small>Catatan check-in bulan ini</small>
    </div>

    <div class="stat-card">
        <p>Belum Presensi</p>
        <h2>{{ $totalBelumPresensi }}</h2>
        <small>Tanggal tanpa check-in tercatat</small>
    </div>
</div>

<div class="panel">
    <div class="panel-header">
        <h3>Filter Rekap Presensi</h3>
    </div>

    <form method="GET"
          action="{{ route('owner.attendances.index') }}"
          class="filter-form">

        <div class="filter-group">
            <label>Bulan Presensi</label>
            <input type="month"
                   name="bulan"
                   value="{{ $bulan }}">
        </div>

        <div class="filter-group">
            <label>Nama Penjaga</label>
            <select name="guard_id">
                <option value="">Semua Penjaga</option>

                @foreach($guards as $guard)
                    <option value="{{ $guard->id }}"
                        {{ (string) $guardId === (string) $guard->id ? 'selected' : '' }}>
                        {{ $guard->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Tampilkan
        </button>

        <a href="{{ route('owner.attendances.index') }}"
           class="btn btn-light">
            Reset
        </a>
    </form>
</div>

<div class="panel">
    <div class="panel-header">
        <h3>Rekap Kehadiran Penjaga</h3>

        <span style="font-size:12px;color:#819087;">
            {{ \Carbon\Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y') }}
        </span>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Penjaga</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($dailyRecap as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td>
                            <strong>{{ $item->name }}</strong>
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->attendance_date)->format('d/m/Y') }}
                        </td>

                        <td>
                            @if($item->check_in)
                                {{ \Carbon\Carbon::parse($item->check_in)->format('H:i') }}
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            @if($item->status === 'Hadir')
                                <span class="status success">
                                    Hadir
                                </span>
                            @else
                                <span class="status danger">
                                    Belum Presensi
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">
                            Belum ada data penjaga untuk periode ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        <span>
            Menampilkan {{ $dailyRecap->count() }} data rekap
        </span>
    </div>
</div>

@endsection
