
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi MARTANA</title>

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
    <h2>LAPORAN TRANSAKSI MARTANA</h2>

    <p class="subtitle">
        Dicetak pada {{ now()->format('d-m-Y H:i') }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Booking</th>
                <th>Pelanggan</th>
                <th>Lapangan</th>
                <th>Tanggal Booking</th>
                <th>Jam</th>
                <th>Durasi</th>
                <th>Metode Pembayaran</th>
                <th>Total Pembayaran</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($transaksi as $index => $item)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>

                    <td>
                        BKG-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}
                    </td>

                    <td>{{ $item->customer_name }}</td>
                    <td>{{ $item->court->name ?? '-' }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->booking_date)->format('d-m-Y') }}
                    </td>

                    <td>
                        {{ substr($item->start_time, 0, 5) }}
                        -
                        {{ substr($item->end_time, 0, 5) }}
                    </td>

                    <td>{{ $item->duration_hours }} jam</td>

                    <td>
                        {{ strtoupper($item->payment_method ?? '-') }}
                    </td>

                    <td>
                        Rp {{ number_format($item->total_price, 0, ',', '.') }}
                    </td>

                    <td>Berhasil</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="center">
                        Belum ada data transaksi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer">
        Total transaksi berhasil: {{ $transaksi->count() }}
    </p>
</body>
</html>