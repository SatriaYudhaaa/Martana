
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Pembayaran | Martana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f2f6fc; color:#1d3557; }
        .panel { background:#fff; border:0; border-radius:16px; box-shadow:0 6px 24px #23466b10; }
        .table th { color:#71839a; font-size:12px; text-transform:uppercase; }
    </style>
</head>
<body>
<div class="container py-5">
    <h2 class="fw-bold">Verifikasi Pembayaran</h2>
    <p class="text-secondary">Periksa transaksi pelanggan sebelum mengonfirmasi.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="panel p-3 mt-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Booking</th>
                        <th>Metode</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->id_pembayaran }}</td>
                        <td>{{ $payment->id_booking }}</td>
                        <td>{{ strtoupper($payment->metode_pembayaran) }}</td>
                        <td>Rp {{ number_format($payment->total_pembayaran, 0, ',', '.') }}</td>
                        <td>{{ str_replace('_', ' ', $payment->status_pembayaran) }}</td>
                        <td style="min-width:220px">
                            @if($payment->status_pembayaran !== 'lunas')
                                <form method="POST"
                                      action="{{ route('guard.payments.verify', $payment->id_pembayaran) }}"
                                      class="mb-2">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success btn-sm w-100">
                                        Konfirmasi Lunas
                                    </button>
                                </form>

                                <form method="POST"
                                      action="{{ route('guard.payments.reject', $payment->id_pembayaran) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="text" name="catatan_verifikasi"
                                           class="form-control form-control-sm mb-2"
                                           placeholder="Alasan penolakan" required>
                                    <button class="btn btn-outline-danger btn-sm w-100">
                                        Tolak Pembayaran
                                    </button>
                                </form>
                            @else
                                <span class="badge bg-success">Sudah lunas</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-secondary py-4">
                            Belum ada transaksi pembayaran.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{ $payments->links() }}
    </div>
</div>
</body>
</html>