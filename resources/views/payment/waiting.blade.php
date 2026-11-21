
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Status Booking - MARTANA SPORT</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f3f7f4;
            color: #263b32;
            min-height: 100vh;
            padding: 30px 15px;
        }

        .container {
            width: 100%;
            max-width: 650px;
            margin: 30px auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0,0,0,.08);
        }

        .header {
            background: #194638;
            color: white;
            padding: 30px;
        }

        .header h1 {
            font-size: 27px;
            letter-spacing: 2px;
        }

        .header p {
            margin-top: 8px;
            color: #d0e4d9;
        }

        .content {
            padding: 35px;
            text-align: center;
        }

        .icon {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            margin: 0 auto 22px;
        }

        .icon.pending {
            background: #fff4d9;
            color: #d18b18;
        }

        .icon.success {
            background: #e1f5e9;
            color: #00865b;
        }

        .icon.cancelled {
            background: #fde8e8;
            color: #c0392b;
        }

        h2 {
            color: #194638;
            margin-bottom: 12px;
            font-size: 25px;
        }

        .description {
            color: #78857d;
            line-height: 1.7;
            margin-bottom: 22px;
        }

        .status {
            display: inline-block;
            padding: 11px 22px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 25px;
        }

        .status.pending {
            background: #fff0cf;
            color: #a66b0c;
        }

        .status.success {
            background: #e1f5e9;
            color: #00865b;
        }

        .status.cancelled {
            background: #fde8e8;
            color: #c0392b;
        }

        .info {
            text-align: left;
            background: #f2f7f3;
            border-radius: 13px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .info h3 {
            color: #194638;
            font-size: 16px;
            margin-bottom: 12px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 13px 0;
            border-bottom: 1px solid #e1e9e3;
            font-size: 14px;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .label {
            color: #7a8980;
        }

        .value {
            font-weight: bold;
            text-align: right;
            color: #293a32;
        }

        .proof {
            margin: 25px 0;
            padding: 20px;
            border: 1px solid #e1e9e3;
            border-radius: 13px;
            text-align: left;
        }

        .proof h3 {
            color: #194638;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .proof p {
            font-size: 13px;
            color: #78857d;
            margin-bottom: 15px;
        }

        .proof img {
            display: block;
            width: 100%;
            max-width: 350px;
            max-height: 400px;
            object-fit: contain;
            border-radius: 10px;
            border: 1px solid #e1e9e3;
            margin: auto;
        }

        .notice {
            background: #fff8e8;
            color: #94620e;
            padding: 18px;
            border-radius: 12px;
            line-height: 1.6;
            font-size: 14px;
            margin: 20px 0;
        }

        .success-notice {
            background: #eaf7ef;
            color: #087f5b;
            padding: 18px;
            border-radius: 12px;
            line-height: 1.6;
            font-size: 14px;
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            background: #194638;
            color: white;
            text-decoration: none;
            padding: 14px 25px;
            border-radius: 10px;
            margin: 10px 5px 0;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .button:hover {
            background: #0e3529;
        }

        .button.download {
            background: #00845b;
        }

        .button.download:hover {
            background: #006c49;
        }

        .footer {
            color: #87948c;
            font-size: 13px;
            margin-top: 28px;
            line-height: 1.7;
        }

        .refresh-note {
            font-size: 12px;
            color: #9aa69e;
            margin-top: 18px;
        }

        @media(max-width: 480px) {
            .content {
                padding: 25px 18px;
            }

            .header {
                padding: 25px 20px;
            }

            .header h1 {
                font-size: 23px;
            }

            .info-row {
                font-size: 12px;
            }

            h2 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>MARTANA SPORT</h1>
        <p>Sistem Informasi Booking Lapangan Futsal</p>
    </div>

    <div class="content">

        {{-- STATUS PENDING --}}
        @if($booking->status === 'pending')

            <div class="icon pending">◷</div>

            <h2>Menunggu Verifikasi</h2>

            <p class="description">
                Pembayaran kamu berhasil dikirim.
                Silakan tunggu penjaga memeriksa pembayaran
                dan mengonfirmasi booking kamu.
            </p>

            <div class="status pending">
                MENUNGGU KONFIRMASI
            </div>

        {{-- STATUS CONFIRMED --}}
        @elseif($booking->status === 'confirmed')

            <div class="icon success">✓</div>

            <h2>Booking Berhasil!</h2>

            <p class="description">
                Selamat! Pembayaran kamu sudah dikonfirmasi
                oleh penjaga MARTANA SPORT.
                Booking lapangan kamu berhasil.
            </p>

            <div class="status success">
                PEMBAYARAN LUNAS
            </div>

            <div class="success-notice">
                <strong>Pembayaran Berhasil Dikonfirmasi!</strong>
                <br>
                Kwitansi resmi pemesanan kamu sudah tersedia.
                Silakan download dan simpan sebagai bukti booking.
            </div>

        {{-- STATUS CANCELLED --}}
        @elseif($booking->status === 'cancelled')

            <div class="icon cancelled">✕</div>

            <h2>Booking Dibatalkan</h2>

            <p class="description">
                Mohon maaf, booking kamu telah dibatalkan
                oleh penjaga MARTANA SPORT.
                Silakan hubungi penjaga untuk informasi lebih lanjut.
            </p>

            <div class="status cancelled">
                BOOKING DIBATALKAN
            </div>

        @endif


        {{-- INFORMASI BOOKING --}}
        <div class="info">

            <h3>INFORMASI PEMESANAN</h3>

            <div class="info-row">
                <span class="label">Kode Booking</span>
                <span class="value">
                    BKG-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}
                </span>
            </div>

            <div class="info-row">
                <span class="label">Nama Pelanggan</span>
                <span class="value">
                    {{ $booking->customer_name ?? '-' }}
                </span>
            </div>

            <div class="info-row">
                <span class="label">Lapangan</span>
                <span class="value">
                    {{ $booking->court->name ?? '-' }}
                </span>
            </div>

            <div class="info-row">
                <span class="label">Tanggal Booking</span>
                <span class="value">
                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                </span>
            </div>

            <div class="info-row">
                <span class="label">Jam Booking</span>
                <span class="value">
                    {{ substr($booking->start_time, 0, 5) }}
                    -
                    {{ substr($booking->end_time, 0, 5) }}
                </span>
            </div>

            <div class="info-row">
                <span class="label">Metode Pembayaran</span>
                <span class="value">
                    {{ strtoupper($booking->payment_method ?? '-') }}
                </span>
            </div>

            <div class="info-row">
                <span class="label">Total Pembayaran</span>
                <span class="value">
                    Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                </span>
            </div>

        </div>


        {{-- BUKTI TRANSFER HANYA SAAT PENDING --}}
        @if($booking->status === 'pending')

            @if($booking->proof_transfer)

                <div class="proof">

                    <h3>Bukti Transfer Kamu</h3>

                    <p>
                        Berikut adalah gambar bukti pembayaran
                        yang sudah kamu kirimkan.
                    </p>

                    <img
                        src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($booking->proof_transfer) }}"
                        alt="Bukti Transfer Customer"
                    >

                </div>

            @elseif($booking->payment_method === 'cash')

                <div class="notice">
                    <strong>Pembayaran Tunai</strong>
                    <br>
                    Kamu memilih pembayaran di tempat.
                    Silakan lakukan pembayaran kepada penjaga lapangan.
                </div>

            @else

                <div class="notice">
                    Bukti transfer belum tersedia.
                </div>

            @endif

        @endif


        {{-- TOMBOL BERDASARKAN STATUS --}}
        @if($booking->status === 'confirmed')

            <a
                href="{{ route('payment.receipt', $booking->id) }}"
                class="button download"
            >
                Download Kwitansi PNG
            </a>

        @elseif($booking->status === 'pending')

            <a href="{{ route('booking.index') }}" class="button">
                Kembali ke Jadwal Lapangan
            </a>

            <p class="refresh-note">
                Status pembayaran diperiksa otomatis setiap 10 detik.
            </p>

        @elseif($booking->status === 'cancelled')

            <a href="{{ route('booking.index') }}" class="button">
                Kembali ke Jadwal Lapangan
            </a>

        @endif


        <div class="footer">
            MARTANA SPORT<br>
            Terima kasih telah melakukan booking bersama kami.
        </div>

    </div>

</div>


{{-- PEMBARUAN STATUS OTOMATIS --}}
@if($booking->status === 'pending')
<script>
    setTimeout(function () {
        window.location.reload();
    }, 10000);
</script>
@endif

</body>
</html>