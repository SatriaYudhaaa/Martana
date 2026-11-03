<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran | Martana Futsal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --green-dark: #173D2B;
            --green: #286344;
            --green-light: #EAF3EC;
            --sage: #A8D5A0;
            --background: #F6F8F5;
            --text: #26352C;
            --muted: #7C8A80;
            --border: #E5EBE5;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            color: var(--text);
            font-family: 'Inter', sans-serif;
        }

        .navbar-martana {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 18px 0;
        }

        .brand {
            color: var(--green-dark);
            font-size: 23px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .brand span {
            color: var(--green);
            font-weight: 500;
        }

        .nav-label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
        }

        .page-container {
            max-width: 1120px;
            margin: auto;
            padding: 55px 24px 80px;
        }

        .page-heading {
            margin-bottom: 35px;
        }

        .eyebrow {
            color: var(--green);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .page-heading h1 {
            color: var(--green-dark);
            font-size: 34px;
            font-weight: 800;
            margin: 12px 0;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 15px;
        }

        .section-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(23, 61, 43, .04);
        }

        .section-title {
            color: var(--green-dark);
            font-size: 17px;
            font-weight: 800;
            margin-bottom: 23px;
        }

        .booking-code {
            background: var(--green-light);
            color: var(--green-dark);
            padding: 7px 13px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 700;
        }

        .summary-label {
            color: var(--muted);
            font-size: 14px;
        }

        .total-box {
            background: var(--green-dark);
            color: #fff;
            border-radius: 13px;
            padding: 23px;
            margin-top: 20px;
        }

        .total-box small {
            color: #D0E2D3;
        }

        .total-price {
            font-size: 27px;
            font-weight: 800;
            margin-top: 7px;
        }

        .method-option {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 19px;
            border: 1px solid var(--border);
            border-radius: 12px;
            cursor: pointer;
            transition: .2s ease;
        }

        .method-option:hover {
            border-color: var(--green);
            background: #FAFCFA;
        }

        .method-option:has(input:checked) {
            border: 2px solid var(--green);
            background: var(--green-light);
            padding: 18px;
        }

        .method-option input {
            accent-color: var(--green);
            width: 17px;
            height: 17px;
            margin-top: 3px;
            flex-shrink: 0;
        }

        .method-icon {
            width: 43px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--green-light);
            color: var(--green);
            border-radius: 10px;
            font-size: 20px;
            flex-shrink: 0;
        }

        .method-name {
            color: var(--green-dark);
            font-size: 14px;
            font-weight: 700;
        }

        .method-description {
            color: var(--muted);
            font-size: 12px;
            margin-top: 5px;
            line-height: 1.6;
        }

        .upload-box {
            background: #FAFCFA;
            border: 1px dashed #A8BDAA;
            border-radius: 12px;
            padding: 20px;
        }

        .form-label {
            color: var(--green-dark);
            font-size: 13px;
            font-weight: 700;
        }

        .form-control {
            border-color: var(--border);
            border-radius: 9px;
            padding: 12px;
            font-size: 13px;
        }

        .form-control:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(40, 99, 68, .10);
        }

        .btn-submit {
            display: block;
            width: 100%;
            background: var(--green);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px;
            font-size: 14px;
            font-weight: 700;
            transition: .2s;
        }

        .btn-submit:hover {
            background: var(--green-dark);
            color: white;
        }

        .info-note {
            background: var(--green-light);
            color: var(--green-dark);
            border-radius: 10px;
            padding: 15px;
            font-size: 12px;
            line-height: 1.7;
        }

        .footer {
            border-top: 1px solid var(--border);
            background: #fff;
            padding: 22px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .page-container {
                padding: 35px 16px 50px;
            }

            .page-heading h1 {
                font-size: 26px;
            }

            .section-card {
                padding: 21px;
            }

            .total-price {
                font-size: 23px;
            }

            .nav-label {
                font-size: 11px;
            }
        }
    </style>
</head>

<body>

<header class="navbar-martana">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="brand">
            MARTANA <span>FUTSAL</span>
        </div>

        <div class="nav-label">
            <i class="bi bi-shield-check me-1"></i>
            Pembayaran Aman
        </div>
    </div>
</header>

<main class="page-container">

    <div class="page-heading">
        <div class="eyebrow">TRANSAKSI BOOKING</div>
        <h1>Selesaikan Pembayaran</h1>
        <p>Silakan periksa detail booking dan pilih metode pembayaran Anda.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('payment.store', $bookingId) }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">

            <div class="col-lg-5">
                <div class="section-card h-100">

                    <h5 class="section-title">
                        <i class="bi bi-receipt me-2"></i>
                        Ringkasan Booking
                    </h5>

                    <div class="mb-4">
                        <div class="summary-label mb-2">Kode Booking</div>
                        <span class="booking-code">{{ $bookingId }}</span>
                    </div>

                    <hr style="border-color: var(--border);">

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="summary-label">Status</span>
                        <span class="badge rounded-pill"
                              style="background:#FFF4D9;color:#946B13;padding:8px 12px;">
                            Menunggu Pembayaran
                        </span>
                    </div>

                    <div class="total-box">
                        <small>Total yang harus dibayar</small>
                        <div class="total-price">
                            Rp {{ number_format($amount, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="info-note mt-4">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        Pastikan jumlah pembayaran sesuai dengan total tagihan sebelum melanjutkan transaksi.
                    </div>

                </div>
            </div>

            <div class="col-lg-7">
                <div class="section-card">

                    <h5 class="section-title">
                        <i class="bi bi-wallet2 me-2"></i>
                        Metode Pembayaran
                    </h5>

                    <div class="d-grid gap-3">

                        <label class="method-option">
                            <input type="radio"
                                   name="metode_pembayaran"
                                   value="dana"
                                   required
                                   {{ old('metode_pembayaran') == 'dana' ? 'checked' : '' }}>

                            <div class="method-icon">
                                <i class="bi bi-phone"></i>
                            </div>

                            <div>
                                <div class="method-name">DANA</div>
                                <div class="method-description">
                                    Transfer melalui aplikasi DANA ke nomor DANA penjaga.
                                </div>
                            </div>
                        </label>

                        <label class="method-option">
                            <input type="radio"
                                   name="metode_pembayaran"
                                   value="va"
                                   {{ old('metode_pembayaran') == 'va' ? 'checked' : '' }}>

                            <div class="method-icon">
                                <i class="bi bi-bank"></i>
                            </div>

                            <div>
                                <div class="method-name">Transfer Bank / Virtual Account</div>
                                <div class="method-description">
                                    Lakukan transfer melalui rekening atau nomor VA tujuan.
                                </div>
                            </div>
                        </label>

                        <label class="method-option">
                            <input type="radio"
                                   name="metode_pembayaran"
                                   value="tunai"
                                   {{ old('metode_pembayaran') == 'tunai' ? 'checked' : '' }}>

                            <div class="method-icon">
                                <i class="bi bi-cash-stack"></i>
                            </div>

                            <div>
                                <div class="method-name">Tunai di Lokasi</div>
                                <div class="method-description">
                                    Pembayaran dilakukan langsung kepada penjaga lapangan.
                                </div>
                            </div>
                        </label>

                    </div>

                    <div class="mt-4">
                        <label class="form-label mb-2">
                            Bukti Transfer
                        </label>

                        <div class="upload-box">
                            <input type="file"
                                   name="bukti_pembayaran"
                                   class="form-control"
                                   accept=".jpg,.jpeg,.png,.pdf">

                            <div class="form-text mt-2">
                                Upload bukti transfer untuk pembayaran DANA atau Bank.
                                Format JPG, PNG, atau PDF. Maksimal 3 MB.
                                Tidak diperlukan untuk pembayaran tunai.
                            </div>
                        </div>
                    </div>

                    <div class="info-note mt-4">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Bukti pembayaran akan diperiksa oleh penjaga sebelum transaksi dinyatakan berhasil.
                    </div>

                    <button type="submit" class="btn-submit mt-4">
                        Konfirmasi Pembayaran
                        <i class="bi bi-arrow-right ms-2"></i>
                    </button>

                </div>
            </div>

        </div>
    </form>

</main>

<footer class="footer">
    © {{ date('Y') }} Martana Futsal. All Rights Reserved.
</footer>

</body>
</html>