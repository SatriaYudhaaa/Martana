
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kuitansi Martana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#eef3f9; }
        .receipt { max-width:700px; margin:45px auto; background:white; padding:45px; border-radius:16px; }
        .brand { color:#245b9e; font-weight:800; letter-spacing:1px; }
        @media print {
            body { background:white; }
            .receipt { margin:0 auto; box-shadow:none!important; }
            .no-print { display:none!important; }
        }
    </style>
</head>
<body>
<div class="receipt shadow-sm">
    <div class="text-center border-bottom pb-4">
        <h2 class="brand">MARTANA FUTSAL</h2>
        <p class="text-secondary mb-0">Kuitansi Pembayaran Sewa Lapangan</p>
        <h4 class="mt-4 fw-bold">BUKTI PEMBAYARAN</h4>
        <span class="badge bg-success">LUNAS</span>
    </div>

    <div class="py-4">
        <div class="d-flex justify-content-between mb-3">
            <span class="text-secondary">Nomor transaksi</span>
            <strong>{{ $payment->id_pembayaran }}</strong>
        </div>
        <div class="d-flex justify-content-between mb-3">
            <span class="text-secondary">Kode booking</span>
            <strong>{{ $payment->id_booking }}</strong>
        </div>
        <div class="d-flex justify-content-between mb-3">
            <span class="text-secondary">Tanggal pembayaran</span>
            <strong>{{ $payment->tanggal_pembayaran }}</strong>
        </div>
        <div class="d-flex justify-content-between mb-3">
            <span class="text-secondary">Metode pembayaran</span>
            <strong>{{ strtoupper($payment->metode_pembayaran) }}</strong>
        </div>
        <hr>
        <div class="d-flex justify-content-between align-items-center">
            <span class="fw-bold">Total dibayar</span>
            <h3 class="text-primary fw-bold">
                Rp {{ number_format($payment->total_pembayaran, 0, ',', '.') }}
            </h3>
        </div>
    </div>

    <div class="text-center border-top pt-4">
        <p class="text-secondary small">
            Terima kasih telah menggunakan layanan Martana Futsal.
            Simpan kuitansi ini sebagai bukti pembayaran.
        </p>
        <button onclick="window.print()" class="btn btn-primary no-print">
            Cetak / Simpan sebagai PDF
        </button>
    </div>
</div>
</body>
</html>