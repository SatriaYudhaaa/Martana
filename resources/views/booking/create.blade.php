<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Lapangan | MARTANA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: #f4f8f6;
            color: #18352c;
        }

        .booking-card {
            max-width: 760px;
            margin: 48px auto;
            padding: 36px;
            background: white;
            border: 1px solid #e5eee9;
            border-radius: 22px;
            box-shadow: 0 12px 35px rgba(18, 60, 45, .07);
        }

        .brand {
            color: #087f5b;
            font-weight: 800;
            font-size: 1.4rem;
            text-decoration: none;
        }

        .booking-btn {
            width: 100%;
            background: #087f5b;
            color: white;
            border: 0;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
        }

        .booking-btn:hover {
            background: #066b4c;
        }
    </style>
</head>
<body>
    <nav class="bg-white border-bottom py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('home') }}" class="brand">MARTANA</a>
            <a href="{{ route('home') }}" class="text-success text-decoration-none">
                ← Kembali ke Beranda
            </a>
        </div>
    </nav>

    <main class="container">
        <div class="booking-card">
            <h1 class="fw-bold mb-2">Booking Lapangan</h1>
            <p class="text-secondary mb-4">
                Isi detail pemesanan dan pilih waktu bermainmu.
            </p>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('booking.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="customer_name" class="form-label">Nama Pemesan</label>
                    <input
                        type="text"
                        id="customer_name"
                        name="customer_name"
                        class="form-control"
                        value="{{ old('customer_name', Auth::user()->name ?? '') }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor WhatsApp</label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone') }}"
                        placeholder="Contoh: 081234567890"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="field" class="form-label">Pilih Lapangan</label>
                    <select id="field" name="field" class="form-select" required>
                        <option value="">-- Pilih Lapangan --</option>
                        <option value="prime" {{ old('field', $selectedField) === 'prime' ? 'selected' : '' }}>
                            MARTANA PRIME — Vinyl
                        </option>
                        <option value="arena" {{ old('field', $selectedField) === 'arena' ? 'selected' : '' }}>
                            MARTANA ARENA — Sintetis
                        </option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="booking_date" class="form-label">Tanggal</label>
                        <input
                            type="date"
                            id="booking_date"
                            name="booking_date"
                            class="form-control"
                            min="{{ date('Y-m-d') }}"
                            value="{{ old('booking_date') }}"
                            required
                        >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="start_time" class="form-label">Jam Mulai</label>
                        <input
                            type="time"
                            id="start_time"
                            name="start_time"
                            class="form-control"
                            value="{{ old('start_time') }}"
                            required
                        >
                    </div>
                </div>

                <div class="mb-4">
                    <label for="duration_hours" class="form-label">Durasi</label>
                    <select id="duration_hours" name="duration_hours" class="form-select" required>
                        <option value="">-- Pilih Durasi --</option>
                        @for ($hour = 1; $hour <= 5; $hour++)
                            <option value="{{ $hour }}" {{ (string) old('duration_hours') === (string) $hour ? 'selected' : '' }}>
                                {{ $hour }} jam
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="alert alert-light border">
                    Harga: <strong>Rp150.000 / jam</strong>
                    <br>
                    Total akan dihitung berdasarkan durasi booking.
                </div>

                <button type="submit" class="booking-btn">
                    Kirim Booking
                </button>
            </form>
        </div>
    </main>
</body>
</html>
