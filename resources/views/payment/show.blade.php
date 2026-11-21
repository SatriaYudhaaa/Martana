<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Martana Sport</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f2f6f3;
            margin: 0;
            padding: 30px 16px;
            color: #26382e;
        }

        .container {
            max-width: 620px;
            margin: auto;
            background: white;
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 5px 24px rgba(0,0,0,.05);
        }

        h1 {
            color: #176b3a;
            margin: 0 0 8px;
            font-size: 25px;
        }

        .subtitle {
            color: #78857d;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin: 24px 0 12px;
            color: #234c36;
        }

        .detail {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 11px 0;
            border-bottom: 1px solid #edf1ed;
            font-size: 14px;
        }

        .detail span:first-child {
            color: #78857d;
        }

        .detail strong {
            text-align: right;
        }

        .total {
            background: #edf7ef;
            border-radius: 10px;
            padding: 17px;
            margin-top: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .total span {
            color: #42614d;
            font-weight: bold;
        }

        .total strong {
            font-size: 21px;
            color: #176b3a;
        }

        .method-option {
            display: block;
            border: 1px solid #dce7de;
            border-radius: 11px;
            padding: 15px;
            margin-bottom: 11px;
            cursor: pointer;
            transition: .2s;
        }

        .method-option:has(input:checked) {
            border: 2px solid #23834c;
            background: #f2faf4;
        }

        .method-option input {
            margin-right: 9px;
            accent-color: #176b3a;
        }

        .method-name {
            font-weight: bold;
            color: #254b35;
        }

        .method-description {
            display: block;
            color: #7b887f;
            font-size: 12px;
            margin: 7px 0 0 24px;
        }

        .payment-info {
            display: none;
            background: #f4f8f5;
            border-radius: 10px;
            padding: 16px;
            margin: 14px 0;
            font-size: 14px;
            line-height: 1.7;
        }

        .payment-info strong {
            color: #176b3a;
        }

        .upload-box {
            display: none;
            margin-top: 15px;
        }

        .upload-box label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 9px;
        }

        .upload-box input {
            width: 100%;
            padding: 12px;
            border: 1px dashed #a9bcae;
            border-radius: 9px;
            background: #fafcfa;
        }

        .cash-info {
            display: none;
            background: #fff8e8;
            color: #775b1c;
            border-radius: 10px;
            padding: 14px;
            font-size: 13px;
            line-height: 1.6;
            margin-top: 14px;
        }

        .submit-btn {
            width: 100%;
            background: #176b3a;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 9px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 22px;
        }

        .submit-btn:hover {
            background: #12552e;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 17px;
            color: #63806c;
            font-size: 13px;
            text-decoration: none;
        }

        .error-message {
            color: #c0392b;
            font-size: 13px;
            margin-top: 8px;
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .detail {
                font-size: 13px;
            }

            .total strong {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Pembayaran Booking</h1>
    <p class="subtitle">Silakan pilih metode pembayaran untuk menyelesaikan pemesanan.</p>

    <div class="section-title">Detail Pemesanan</div>

    <div class="detail">
        <span>Nama Pelanggan</span>
        <strong>{{ $booking->customer_name }}</strong>
    </div>

    <div class="detail">
        <span>Lapangan</span>
        <strong>{{ $booking->court->name ?? $booking->field ?? '-' }}</strong>
    </div>

    <div class="detail">
        <span>Tanggal</span>
        <strong>{{ $booking->booking_date }}</strong>
    </div>

    <div class="detail">
        <span>Waktu</span>
        <strong>
            {{ substr($booking->start_time, 0, 5) }}
            -
            {{ substr($booking->end_time, 0, 5) }}
        </strong>
    </div>

    <div class="total">
        <span>Total Pembayaran</span>
        <strong>Rp{{ number_format($booking->total_price, 0, ',', '.') }}</strong>
    </div>

    <form action="{{ route('payment.confirm', $booking->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="section-title">Pilih Metode Pembayaran</div>

        <label class="method-option">
            <input type="radio" name="payment_method" value="bca" required>
            <span class="method-name">Transfer Bank BCA</span>
            <span class="method-description">Transfer ke rekening BCA Martana.</span>
        </label>

        <label class="method-option">
            <input type="radio" name="payment_method" value="dana">
            <span class="method-name">DANA</span>
            <span class="method-description">Transfer melalui aplikasi DANA.</span>
        </label>

        <label class="method-option">
            <input type="radio" name="payment_method" value="cash">
            <span class="method-name">Cash di Tempat</span>
            <span class="method-description">Bayar langsung kepada penjaga saat datang.</span>
        </label>

        <div class="payment-info" id="bcaInfo">
            <strong>Informasi Transfer BCA</strong><br>
            Bank: BCA<br>
            Nomor Rekening: <strong>901746034987</strong><br>
            Atas Nama: <strong>Baim</strong>
        </div>

        <div class="payment-info" id="danaInfo">
            <strong>Informasi Transfer DANA</strong><br>
            Nomor DANA: <strong>081318231225</strong><br>
            Atas Nama: <strong>Baim</strong>
        </div>

        <div class="upload-box" id="uploadBox">
            <label for="proof_transfer">Upload Bukti Transfer</label>
            <input
                type="file"
                name="proof_transfer"
                id="proof_transfer"
                accept="image/jpeg,image/png,image/jpg"
            >
            <small style="display:block;color:#78857d;margin-top:7px;">
                Format JPG, JPEG, atau PNG. Maksimal 5 MB.
            </small>
        </div>

        <div class="cash-info" id="cashInfo">
            Kamu memilih pembayaran Cash di Tempat.
            Silakan lakukan pembayaran langsung kepada penjaga
            ketika datang ke lokasi Martana.
        </div>

        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <button type="submit" class="submit-btn">
            Kirim Pembayaran
        </button>
    </form>

    <a href="{{ route('booking.index') }}" class="back-link">
        Kembali ke halaman booking
    </a>

</div>

<script>
    const methods = document.querySelectorAll('input[name="payment_method"]');
    const bcaInfo = document.getElementById('bcaInfo');
    const danaInfo = document.getElementById('danaInfo');
    const uploadBox = document.getElementById('uploadBox');
    const cashInfo = document.getElementById('cashInfo');
    const proofInput = document.getElementById('proof_transfer');

    methods.forEach(method => {
        method.addEventListener('change', function () {
            bcaInfo.style.display = 'none';
            danaInfo.style.display = 'none';
            uploadBox.style.display = 'none';
            cashInfo.style.display = 'none';

            proofInput.required = false;

            if (this.value === 'bca') {
                bcaInfo.style.display = 'block';
                uploadBox.style.display = 'block';
                proofInput.required = true;
            }

            if (this.value === 'dana') {
                danaInfo.style.display = 'block';
                uploadBox.style.display = 'block';
                proofInput.required = true;
            }

            if (this.value === 'cash') {
                cashInfo.style.display = 'block';
            }
        });
    });
</script>

</body>
</html>