<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Martana Sport</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }

        h1 {
            margin-top: 0;
        }

        .detail {
            margin: 10px 0;
        }

        .total {
            font-size: 22px;
            font-weight: bold;
            margin: 20px 0;
        }

        button {
            background: #176b3a;
            color: white;
            border: 0;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pembayaran Booking</h1>

        <div class="detail">
            <strong>Nama:</strong> {{ $booking->customer_name }}
        </div>

        <div class="detail">
            <strong>Lapangan:</strong> {{ $booking->court->name }}
        </div>

        <div class="detail">
            <strong>Tanggal:</strong> {{ $booking->booking_date }}
        </div>

        <div class="detail">
            <strong>Waktu:</strong>
            {{ substr($booking->start_time, 0, 5) }}
            -
            {{ substr($booking->end_time, 0, 5) }}
        </div>

        <div class="total">
            Total: Rp{{ number_format($booking->total_price, 0, ',', '.') }}
        </div>

        <p>Ini adalah pembayaran simulasi untuk keperluan tugas.</p>

        <form action="{{ route('payment.confirm', $booking->id) }}" method="POST">
            @csrf
            <button type="submit">Konfirmasi Pembayaran</button>
        </form>
    </div>
</body>
</html>