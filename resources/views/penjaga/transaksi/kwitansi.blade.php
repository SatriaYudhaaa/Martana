<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Martana Sport</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Library untuk membuat gambar PNG -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px 20px;
            background: #eef2ef;
            font-family: Arial, sans-serif;
            color: #26352e;
        }

        .receipt {
            width: 100%;
            max-width: 720px;
            margin: auto;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
        }

        .receipt-header {
            background: #183f32;
            color: white;
            padding: 35px 40px;
        }

        .brand {
            font-size: 25px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .receipt-header p {
            margin-bottom: 0;
            color: #d1e5d9;
            font-size: 13px;
        }

        .receipt-body {
            padding: 35px 40px;
        }

        .invoice-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .receipt-title {
            font-size: 23px;
            font-weight: 800;
            color: #183f32;
            margin: 0 0 8px;
        }

        .receipt-subtitle {
            color: #849188;
            font-size: 13px;
            margin: 0;
        }

        .invoice-icon {
            width: 55px;
            height: 55px;
            background: #e2f5e9;
            color: #087f5b;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
        }

        .booking-code {
            background: #f0f7f2;
            padding: 17px 20px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .booking-code span {
            color: #718077;
            font-size: 13px;
        }

        .booking-code strong {
            color: #087f5b;
            font-size: 18px;
        }

        .section-title {
            color: #183f32;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .5px;
            margin: 25px 0 12px;
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 13px 0;
            border-bottom: 1px solid #edf1ed;
            font-size: 14px;
        }

        .receipt-row span {
            color: #7b8790;
        }

        .receipt-row strong {
            color: #26352e;
            text-align: right;
        }

        .status {
            color: #087f5b !important;
            background: #e2f5e9;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 11px;
        }

        .total-box {
            background: #183f32;
            color: white;
            padding: 23px;
            border-radius: 12px;
            margin-top: 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .total-box span {
            font-size: 14px;
        }

        .total-box strong {
            font-size: 22px;
        }

        .receipt-footer {
            text-align: center;
            padding: 25px 15px;
            border-top: 1px dashed #d8e0da;
            margin-top: 30px;
            color: #849188;
            font-size: 12px;
            line-height: 1.7;
        }

        .actions {
            max-width: 720px;
            margin: 22px auto 0;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .btn {
            padding: 13px 22px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-weight: 700;
            font-size: 13px;
        }

        .btn-back {
            background: white;
            color: #183f32;
        }

        .btn-download {
            background: #087f5b;
            color: white;
        }

        .btn-download:hover {
            background: #056747;
        }

        .btn:disabled {
            opacity: .65;
            cursor: wait;
        }

        @media(max-width: 600px) {
            body {
                padding: 15px 10px;
            }

            .receipt-header,
            .receipt-body {
                padding: 25px 20px;
            }

            .receipt-row {
                font-size: 12px;
            }

            .total-box strong {
                font-size: 17px;
            }

            .receipt-title {
                font-size: 19px;
            }
        }

        @page {
            size: A4 portrait;
            margin: 15mm;
        }

        @media print {
            html, body {
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .receipt {
                max-width: none !important;
                box-shadow: none !important;
                border-radius: 0 !important;
            }

            .actions {
                display: none !important;
            }
        }
    </style>
</head>

<body>

<!-- AREA INVOICE YANG AKAN DIUNDUH -->
<div class="receipt" id="invoice">

    <div class="receipt-header">
        <div class="brand">MARTANA SPORT</div>
        <p>Sistem Informasi Booking Lapangan Futsal</p>
    </div>

    <div class="receipt-body">

        <div class="invoice-label">
            <div>
                <h1 class="receipt-title">INVOICE PEMBAYARAN</h1>
                <p class="receipt-subtitle">
                    Bukti resmi pemesanan lapangan futsal
                </p>
            </div>

            <div class="invoice-icon">
                <i class="bi bi-receipt-cutoff"></i>
            </div>
        </div>

        <div class="booking-code">
            <span>Nomor Invoice / Kode Booking</span>
            <strong>BKG-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}</strong>
        </div>

        <h3 class="section-title">INFORMASI PELANGGAN</h3>

        <div class="receipt-row">
            <span>Nama Pelanggan</span>
            <strong>{{ $booking->customer_name }}</strong>
        </div>

        <div class="receipt-row">
            <span>Nomor Telepon</span>
            <strong>{{ $booking->phone }}</strong>
        </div>

        <h3 class="section-title">DETAIL PEMESANAN</h3>

        <div class="receipt-row">
            <span>Nama Lapangan</span>
            <strong>{{ $booking->court->name ?? '-' }}</strong>
        </div>

        <div class="receipt-row">
            <span>Tanggal Booking</span>
            <strong>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</strong>
        </div>

        <div class="receipt-row">
            <span>Jam Booking</span>
            <strong>
                {{ substr($booking->start_time, 0, 5) }}
                - {{ substr($booking->end_time, 0, 5) }}
            </strong>
        </div>

        <div class="receipt-row">
            <span>Durasi</span>
            <strong>{{ $booking->duration_hours }} jam</strong>
        </div>

        <h3 class="section-title">INFORMASI PEMBAYARAN</h3>

        <div class="receipt-row">
            <span>Metode Pembayaran</span>
            <strong>{{ strtoupper($booking->payment_method ?? '-') }}</strong>
        </div>

        <div class="receipt-row">
            <span>Status Pembayaran</span>
            <strong class="status">LUNAS / DIKONFIRMASI</strong>
        </div>

        <div class="total-box">
            <span>TOTAL PEMBAYARAN</span>
            <strong>
                Rp{{ number_format($booking->total_price, 0, ',', '.') }}
            </strong>
        </div>

        <div class="receipt-footer">
            <strong>TERIMA KASIH TELAH MEMILIH MARTANA SPORT!</strong>
            <br>
            Simpan invoice ini sebagai bukti pemesanan lapangan.
            <br><br>
            <strong>MARTANA SPORT</strong>
        </div>

    </div>
</div>

<!-- TOMBOL DI LUAR AREA INVOICE -->
<div class="actions">

    <a href="{{ route('customer.booking.history') }}" class="btn btn-back">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>

    <button type="button" class="btn btn-download" id="downloadButton" onclick="downloadInvoice()">
        <i class="bi bi-download"></i>
        Download Kwitansi PNG
    </button>

</div>

<script>
async function downloadInvoice() {
    const invoice = document.getElementById('invoice');
    const button = document.getElementById('downloadButton');

    if (typeof html2canvas === 'undefined') {
        alert('Library gambar belum berhasil dimuat. Periksa koneksi internet lalu refresh halaman.');
        return;
    }

    button.disabled = true;
    button.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyiapkan PNG...';

    try {
        const canvas = await html2canvas(invoice, {
            scale: 3,
            backgroundColor: '#ffffff',
            useCORS: true,
            logging: false,
            windowWidth: 900
        });

        const link = document.createElement('a');

        link.download = 'Invoice-Martana-BKG-{{ $booking->id }}.png';
        link.href = canvas.toDataURL('image/png');

        document.body.appendChild(link);
        link.click();
        link.remove();

    } catch (error) {
        console.error(error);
        alert('Gagal membuat gambar kwitansi. Silakan refresh halaman dan coba lagi.');
    } finally {
        button.disabled = false;
        button.innerHTML = '<i class="bi bi-download"></i> Download Kwitansi PNG';
    }
}
</script>

</body>
</html>
