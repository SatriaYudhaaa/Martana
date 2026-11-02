
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran | Martana Futsal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f2f6fc; color:#1d3557; font-family:Arial,sans-serif; }
        .topbar { background:#fff; padding:18px 0; border-bottom:1px solid #e6edf6; }
        .brand { font-weight:800; color:#245b9e; letter-spacing:.4px; }
        .payment-card { background:white; border:0; border-radius:18px; box-shadow:0 8px 28px #23466b12; }
        .method { display:block; border:1px solid #e1e9f3; padding:17px; border-radius:13px; cursor:pointer; transition:.2s; }
        .method:has(input:checked) { border:2px solid #3478c9; background:#f1f7ff; }
        .method input { accent-color:#3478c9; }
        .btn-main { background:#3478c9; color:white; border:0; border-radius:12px; padding:13px; font-weight:700; }
        .btn-main:hover { background:#245b9e; color:white; }
        .muted { color:#8191a7; }
    </style>
</head>
<body>
<header class="topbar">
    <div class="container d-flex justify-content-between">
        <div class="brand fs-4">MARTANA <span class="text-dark fw-normal">FUTSAL</span></div>
        <span class="muted">Pembayaran Booking</span>
    </div>
</header>

<main class="container py-5" style="max-width:850px">
    <div class="mb-4">
        <span class="text-primary fw-semibold small">LANGKAH TERAKHIR</span>
        <h2 class="fw-bold mt-2">Selesaikan Pembayaran</h2>
        <p class="muted">Pilih metode pembayaran yang paling nyaman untukmu.</p>
    </div>

    <div class="payment-card p-4 mb-4">
        <h5 class="fw-bold mb-3">Ringkasan Booking</h5>
        <div class="d-flex justify-content-between py-2 border-bottom">
            <span class="muted">Kode Booking</span>
            <strong>{{ $bookingId }}</strong>
        </div>
        <div class="d-flex justify-content-between py-3">
            <span class="muted">Total Pembayaran</span>
            <h4 class="fw-bold text-primary mb-0">
                Rp {{ number_format($amount, 0, ',', '.') }}
            </h4>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('payment.store', $bookingId) }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        <div class="payment-card p-4">
            <h5 class="fw-bold mb-3">Pilih Metode Pembayaran</h5>

            <div class="d-grid gap-3">
                <label class="method">
                    <input type="radio" name="metode_pembayaran"
                           value="dana" required>
                    <strong class="ms-2">DANA</strong>
                    <div class="small muted ms-4 mt-1">
                        Transfer ke nomor DANA penjaga.
                    </div>
                </label>

                <label class="method">
                    <input type="radio" name="metode_pembayaran"
                           value="va">
                    <strong class="ms-2">Transfer Bank / VA</strong>
                    <div class="small muted ms-4 mt-1">
                        Transfer ke rekening atau nomor VA tujuan.
                    </div>
                </label>

                <label class="method">
                    <input type="radio" name="metode_pembayaran"
                           value="tunai">
                    <strong class="ms-2">Tunai di Lokasi</strong>
                    <div class="small muted ms-4 mt-1">
                        Bayar langsung kepada penjaga lapangan.
                    </div>
                </label>
            </div>

            <div class="alert alert-info mt-4 mb-0 small">
                Untuk DANA dan transfer bank, siapkan bukti transfer.
                Pembayaran akan diperiksa oleh penjaga.
            </div>

            <label class="form-label fw-semibold mt-4">
                Bukti Transfer (DANA / Bank)
            </label>
            <input type="file" name="bukti_pembayaran"
                   class="form-control" accept=".jpg,.jpeg,.png,.pdf">
            <div class="form-text">
                Format JPG, PNG, atau PDF. Maksimal 3 MB.
                Tidak diperlukan untuk pembayaran tunai.
            </div>

            <button type="submit" class="btn btn-main w-100 mt-4">
                Lanjutkan Pembayaran
            </button>
        </div>
    </form>
</main>
</body>
</html>