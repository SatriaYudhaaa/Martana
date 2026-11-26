<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Booking MARTANA</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #26352d;
        }

        h2 {
            text-align: center;
            color: #08764f;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 20px;
            color: #637168;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #08764f;
            color: white;
            padding: 8px 5px;
        }

        td {
            border: 1px solid #dce5df;
            padding: 7px 5px;
        }

        .center {
            text-align: center;
        }

        .footer {
            margin-top: 15px;
            text-align: right;
            font-size: 9px;
        }
    </style>
</head>

<body>
    <h2>LAPORAN DATA BOOKING MARTANA</h2>

    <p class="subtitle">
        Dicetak pada {{ now()->format('d-m-Y H:i') }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Booking</th>
                <th>Pelanggan</th>
                <th>No. Telepon</th>
                <th>Lapangan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Durasi</th>
                <th>Total Harga</th>
                <th>Metode</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($bookings as $index => $booking)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>

                    <td>
                        BKG-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}
                    </td>

                    <td>{{ $booking->customer_name }}</td>
                    <td>{{ $booking->phone }}</td>
                    <td>{{ $booking->court->name ?? '-' }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('d-m-Y') }}
                    </td>

                    <td>
                        {{ substr($booking->start_time, 0, 5) }}
                        -
                        {{ substr($booking->end_time, 0, 5) }}
                    </td>

                    <td>{{ $booking->duration_hours }} jam</td>

                    <td>
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </td>

                    <td>{{ strtoupper($booking->payment_method ?? '-') }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="center">
                        Belum ada data booking.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer">
        Total data booking: {{ $bookings->count() }}
    </p>
</body>
</html>