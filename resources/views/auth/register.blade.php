
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | MARTANA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --green: #087f5b;
            --green-dark: #064e3b;
            --mint: #a7f3d0;
            --text: #142b25;
            --muted: #718096;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 40px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Segoe UI", Arial, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 10% 10%, rgba(16, 185, 129, .25), transparent 32%),
                radial-gradient(circle at 90% 90%, rgba(52, 211, 153, .22), transparent 32%),
                linear-gradient(135deg, #043f31, #047857 55%, #059669);
        }

        .register-card {
            width: 100%;
            max-width: 520px;
            padding: 38px;
            background: #fff;
            border: 1px solid rgba(255, 255, 255, .6);
            border-radius: 26px;
            box-shadow: 0 28px 80px rgba(0, 0, 0, .25);
        }

        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 24px;
            color: var(--green);
            font-size: 28px;
            font-weight: 900;
        }

        .brand img {
            width: 52px;
            height: 52px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .form-title {
            margin: 0;
            text-align: center;
            font-size: 30px;
            font-weight: 850;
            letter-spacing: -1px;
        }

        .form-subtitle {
            margin: 8px 0 28px;
            text-align: center;
            color: var(--muted);
            font-size: 14px;
        }

        .form-label {
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 750;
        }

        .form-control {
            min-height: 50px;
            padding: 12px 15px;
            border: 1px solid #dce6e1;
            border-radius: 12px;
            background: #f8fbf9;
            font-size: 15px;
        }

        .form-control:focus {
            border-color: var(--green);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(8, 127, 91, .12);
        }

        .form-text {
            margin-top: 6px;
            color: var(--muted);
            font-size: 12px;
        }

        .btn-register {
            min-height: 52px;
            border: 0;
            border-radius: 13px;
            color: white;
            background: var(--green);
            font-weight: 800;
            transition: .2s ease;
        }

        .btn-register:hover {
            color: white;
            background: var(--green-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(8, 127, 91, .2);
        }

        .login-link {
            color: var(--green);
            font-weight: 800;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: #a0ada7;
            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e5ece8;
        }

        @media (max-width: 480px) {
            body {
                padding: 20px 12px;
            }

            .register-card {
                padding: 28px 22px;
                border-radius: 20px;
            }

            .form-title {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <main class="register-card">
        <div class="brand">
            <img src="{{ asset('images/martana-logo.png') }}" alt="Logo MARTANA">
            <span>MARTANA</span>
        </div>

        <h1 class="form-title">Buat Akun</h1>
        <p class="form-subtitle">Gabung dan mulai booking lapangan favoritmu.</p>

        @if ($errors->any())
            <div class="alert alert-danger rounded-3">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    placeholder="Masukkan nama lengkap"
                    value="{{ old('name') }}"
                    autocomplete="name"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    placeholder="nama@email.com"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Nomor HP</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    class="form-control"
                    placeholder="08xxxxxxxxxx"
                    value="{{ old('phone') }}"
                    inputmode="numeric"
                    pattern="08[0-9]{10}"
                    maxlength="12"
                    minlength="12"
                    autocomplete="tel"
                    required
                >
                <div class="form-text">Nomor harus diawali 08 dan terdiri dari 12 digit.</div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Minimal 8 karakter"
                    minlength="8"
                    autocomplete="new-password"
                    required
                >
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Ulangi password"
                    minlength="8"
                    autocomplete="new-password"
                    required
                >
            </div>

            <button type="submit" class="btn btn-register w-100">
                Daftar Sekarang <span class="ms-2">→</span>
            </button>
        </form>

        <div class="divider">ATAU</div>

        <p class="text-center mb-0 text-secondary">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="login-link">Login</a>
        </p>
    </main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: @json(session('success')),
            confirmButtonText: 'Oke',
            confirmButtonColor: '#087f5b'
        });
    @endif
</script>
</body>
</html>
