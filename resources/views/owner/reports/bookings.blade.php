
@extends('owner.layouts.app')

@section('title', 'Laporan Booking')
@section('page-title', 'Laporan Booking')
@section('page-description', 'Pantau seluruh aktivitas pemesanan lapangan Martana.')

@section('content')

<section class="stats">
    <div class="stat-card">
        <p>Total Booking</p>
        <h2>{{ number_format($totalBookings, 0, ',', '.') }}</h2>
        <small>Jumlah booking sesuai filter</small>
    </div>

    <div class="stat-card">
        <p>Booking Ditampilkan</p>
        <h2>{{ $bookings->count() }}</h2>
        <small>Data pada halaman ini</small>
    </div>

    <div class="stat-card">
        <p>Filter Status</p>
        <h2 style="font-size:19px;">
            {{ request('status') ? ucfirst(request('status')) : 'Semua' }}
        </h2>
        <small>Status booking yang dipilih</small>
    </div>
</section>

<section class="panel">
    <div class="panel-header">
        <h3>Filter Data Booking</h3>
    </div>

    <form action="{{ route('owner.reports.bookings') }}"
          method="GET"
          class="filter-form">

        <div class="filter-group">
            <label for="start_date">Dari Tanggal</label>
            <input type="date"
                   id="start_date"
                   name="start_date"
                   value="{{ request('start_date') }}">
        </div>

        <div class="filter-group">
            <label for="end_date">Sampai Tanggal</label>
            <input type="date"
                   id="end_date"
                   name="end_date"
                   value="{{ request('end_date') }}">
        </div>

        <div class="filter-group">
            <label for="status">Status Booking</label>
            <select name="status" id="status">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>
                    Confirmed
                </option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                    Cancelled
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Terapkan Filter
        </button>

        <a href="{{ route('owner.reports.bookings') }}"
           class="btn btn-light">
            Reset
        </a>
    </form>
</section>

<section class="panel">
    <div class="panel-header">
        <h3>Daftar Seluruh Booking</h3>
        <span style="font-size:12px;color:#819087;">
            {{ $bookings->total() }} data booking
        </span>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID BOOKING</th>
                    <th>NAMA PELANGGAN</th>
                    <th>LAPANGAN</th>
                    <th>TANGGAL</th>
                    <th>JAM</th>
                    <th>DURASI</th>
                    <th>TOTAL HARGA</th>
                    <th>STATUS</th>
                </tr>
            </thead>

            <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td><strong>#{{ $booking->id }}</strong></td>

                        <td>
                            {{ $booking->customer_name ?: ($booking->user_name ?: '-') }}
                        </td>

                        <td>{{ $booking->court_name ?: '-' }}</td>

                        <td>
                            {{ $booking->booking_date
                                ? \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y')
                                : '-' }}
                        </td>

                        <td>
                            {{ substr($booking->start_time ?? '-', 0, 5) }}
                            -
                            {{ substr($booking->end_time ?? '-', 0, 5) }}
                        </td>

                        <td>
                            {{ $booking->duration_hours ?? '-' }}
                            {{ $booking->duration_hours ? 'jam' : '' }}
                        </td>

                        <td>
                            <strong>
                                Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}
                            </strong>
                        </td>

                        <td>
                            @php
                                $status = strtolower($booking->status ?? 'pending');
                            @endphp

                            <span class="status
                                {{ $status === 'confirmed' ? 'success' : ($status === 'cancelled' ? 'danger' : '') }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty">
                            Belum ada data booking yang sesuai dengan filter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        <span>
            Menampilkan {{ $bookings->firstItem() ?? 0 }}
            sampai {{ $bookings->lastItem() ?? 0 }}
            dari {{ $bookings->total() }} data
        </span>

        {{ $bookings->links() }}
    </div>
</section>

@endsection