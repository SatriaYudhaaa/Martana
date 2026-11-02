
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Pembayaran | Martana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f2f6fc; color:#1d3557; }
        .card-status { max-width:620px; margin:70px auto; background:#fff; padding:38px; border-radius:20px; box-shadow:0 8px 28px #23466b12; }
        .status-icon { width:65px;height:65px;border-radius:50%;background:#e9f3ff;color:#3478c9;display:grid;place-items:center;font-size:28px;margin:auto; }
    </style>
</head>
<body>
<div class="container">
    <div class="card-status text-center">
        <div class="status-icon mb-3">
            {{ $payment->status_pembayaran === 'lunas' ? '✓' : '⌛' }}
        </div>

        <h3 class="fw-bold">Status Pembayaran</h3>
        <p class="text-secondary">Kode transaksi: {{ $payment->id_pembayaran }}</p>

        @if($payment->status_pembayaran === 'lunas')
            <div class="alert alert-success">Pembayaran berhasil dikonfirmasi.</div>
            <a href="{{ route('receipt.show', $payment->id_pembayaran) }}"
               class="btn btn-primary w-100">Lihat Kuitansi</a>
        @elseif($payment->status_pembayaran === 'ditolak')
            <div class="alert alert-danger">
                Pembayaran ditolak.
                <br>{{ $payment->catatan_verifikasi }}
            </div>
        @elseif($payment->status_pembayaran === 'menunggu_pembayaran_tunai')
            <div class="alert alert-info">
                Silakan lakukan pembayaran tunai langsung kepada penjaga.
            </div>
        @else
            <div class="alert alert-warning">
                Bukti pembayaran sedang menunggu pemeriksaan penjaga.
            </div>
        @endif

        <div class="text-start mt-4">
            <p><strong>Booking:</strong> {{ $payment->id_booking }}</p>
            <p><strong>Metode:</strong> {{ strtoupper($payment->metode_pembayaran) }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($payment->total_pembayaran, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> {{ str_replace('_', ' ', ucfirst($payment->status_pembayaran)) }}</p>
        </div>
    </div>
</div>
</body>
</html>
