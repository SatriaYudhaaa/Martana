
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice MARTANA SPORT</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f0f3f1;
            padding: 30px 15px;
            color: #293a32;
        }

        .invoice {
            width: 100%;
            max-width: 850px;
            margin: auto;
            background: white;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
        }

        .header {
            background: #194638;
            padding: 48px 55px;
            color: white;
        }

        .header h1 {
            font-size: 36px;
            font-weight: 900;
            letter-spacing: 2px;
        }

        .header p {
            margin-top: 25px;
            font-size: 17px;
            color: #d4e5dc;
        }

        .content {
            padding: 45px 55px;
        }

        .title-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .title-row h2 {
            font-size: 30px;
            color: #194638;
            font-weight: 900;
        }

        .subtitle {
            margin-top: 15px;
            color: #849188;
            font-size: 16px;
        }

        .invoice-icon {
            background: #e3f4eb;
            color: #00865d;
            width: 75px;
            height: 75px;
            border-radius: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 38px;
            flex-shrink: 0;
        }

        .invoice-number {
            background: #eff6f1;
            padding: 23px 28px;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 35px;
            color: #718078;
        }

        .invoice-number strong {
            font-size: 25px;
            color: #00845b;
        }

        .section {
            margin-bottom: 35px;
        }

        .section h3 {
            font-size: 19px;
            color: #194638;
            font-weight: 900;
            margin-bottom: 23px;
        }

        .row-data {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 17px 0;
            border-bottom: 1px solid #e9eee9;
            font-size: 17px;
        }

        .row-data span {
            color: #7b8995;
        }

        .row-data strong {
            color: #293a32;
            text-align: right;
        }

        .paid {
            display: inline-block;
            background: #e1f5e9;
            color: #00865b !important;
            padding: 10px 16px;
            border-radius: 25px;
            font-size: 13px;
            white-space: nowrap;
        }

        .total {
            background: #194638;
            color: white;
            padding: 27px 30px;
            border-radius: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            font-size: 20px;
            margin-top: 38px;
        }

        .total strong {
            font-size: 30px;
            white-space: nowrap;
        }

        .footer {
            border-top: 1px dashed #d5dfd7;
            margin-top: 35px;
            padding-top: 35px;
            text-align: center;
            color: #87948b;
            line-height: 1.8;
        }

        .footer strong {
            display: block;
            margin-top: 25px;
        }

        .actions {
            text-align: center;
            margin: 25px auto;
        }

        .download-btn {
            border: none;
            background: #00845b;
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .download-btn:hover {
            background: #006c49;
        }

        .back-btn {
            display: inline-block;
            margin-left: 10px;
            text-decoration: none;
            background: #e5eee8;
            color: #194638;
            padding: 15px 25px;
            border-radius: 10px;
            font-weight: bold;
        }

        @media(max-width: 600px) {
            body {
                padding: 12px;
            }

            .header {
                padding: 30px 23px;
            }

            .header h1 {
                font-size: 27px;
            }

            .content {
                padding: 28px 23px;
            }

            .title-row h2 {
                font-size: 22px;
            }

            .row-data {
                font-size: 14px;
            }

            .invoice-number {
                font-size: 13px;
                padding: 18px;
            }

            .invoice-number strong {
                font-size: 19px;
            }

            .total {
                font-size: 15px;
                padding: 22px 18px;
            }

            .total strong {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

<div class="invoice" id="invoice">

    <div class="header">
        <h1>MARTANA SPORT</h1>
        <p>Sistem Informasi Booking Lapangan Futsal</p>
    </div>

    <div class="content">

        <div class="title-row">
            <div>
                <h2>INVOICE PEMBAYARAN</h2>
                <p class="subtitle">
                    Bukti resmi pemesanan lapangan futsal
                </p>
            </div>

            <div class="invoice-icon">▤</div>
        </div>

        <div class="invoice-number">
            <span>Nomor Invoice / Kode Booking</span>

            <strong>
                BKG-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}
            </strong>
        </div>

        <div class="section">
            <h3>INFORMASI PELANGGAN</h3>

            <div class="row-data">
                <span>Nama Pelanggan</span>
                <strong>{{ $booking->customer_name ?? '-' }}</strong>
            </div>

            <div class="row-data">
                <span>Nomor Telepon</span>
                <strong>{{ $booking->phone ?? '-' }}</strong>
            </div>
        </div>

        <div class="section">
            <h3>DETAIL PEMESANAN</h3>

            <div class="row-data">
                <span>Nama Lapangan</span>
                <strong>{{ $booking->court->name ?? '-' }}</strong>
            </div>

            <div class="row-data">
                <span>Tanggal Booking</span>
                <strong>
                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                </strong>
            </div>

            <div class="row-data">
                <span>Jam Booking</span>
                <strong>
                    {{ substr($booking->start_time, 0, 5) }}
                    -
                    {{ substr($booking->end_time, 0, 5) }}
                </strong>
            </div>

            <div class="row-data">
                <span>Durasi</span>
                <strong>{{ $booking->duration_hours }} jam</strong>
            </div>
        </div>

        <div class="section">
            <h3>INFORMASI PEMBAYARAN</h3>

            <div class="row-data">
                <span>Metode Pembayaran</span>
                <strong>
                    {{ strtoupper($booking->payment_method ?? '-') }}
                </strong>
            </div>

            <div class="row-data">
                <span>Status Pembayaran</span>
                <strong class="paid">LUNAS / DIKONFIRMASI</strong>
            </div>
        </div>

        <div class="total">
            <span>TOTAL PEMBAYARAN</span>

            <strong>
                Rp{{ number_format($booking->total_price, 0, ',', '.') }}
            </strong>
        </div>

        <div class="footer">
            <strong>TERIMA KASIH TELAH MEMILIH MARTANA SPORT!</strong>

            <p>
                Simpan invoice ini sebagai bukti pemesanan lapangan.
            </p>

            <strong>MARTANA SPORT</strong>
        </div>

    </div>

</div>

<div class="actions">
    <button class="download-btn" id="downloadBtn" onclick="downloadInvoice()">
        Download Kwitansi PNG
    </button>

    <a href="{{ route('booking.index') }}" class="back-btn">
        Kembali
    </a>
</div>

<script>
    async function downloadInvoice() {
        const button = document.getElementById('downloadBtn');
        const invoice = document.getElementById('invoice');

        if (typeof html2canvas === 'undefined') {
            alert('Library gambar belum berhasil dimuat. Periksa koneksi internet.');
            return;
        }

        button.disabled = true;
        button.innerText = 'Menyiapkan PNG...';

        try {
            const canvas = await html2canvas(invoice, {
                scale: 2,
                backgroundColor: '#ffffff',
                useCORS: true,
                logging: false
            });

            const link = document.createElement('a');

            link.download = 'Invoice-MARTANA-BKG-{{ $booking->id }}.png';
            link.href = canvas.toDataURL('image/png');

            link.click();

        } catch (error) {
            console.error(error);
            alert('Gagal membuat gambar invoice. Silakan coba lagi.');
        } finally {
            button.disabled = false;
            button.innerText = 'Download Kwitansi PNG';
        }
    }
</script>

</body>
</html>