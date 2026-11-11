<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengelola | MARTANA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --green: #087f5b;
            --green-dark: #075b43;
            --text: #142b25;
            --muted: #718096;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            font-family: "Segoe UI", Arial, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 15% 15%, rgba(16, 185, 129, .28), transparent 35%),
                radial-gradient(circle at 85% 85%, rgba(52, 211, 153, .25), transparent 35%),
                linear-gradient(135deg, #064e3b, #047857 55%, #059669);
        }

        .login-card {
            width: 100%;
            max-width: 460px;
            padding: 40px;
            background: rgba(255, 255, 255, .98);
            border: 1px solid rgba(255, 255, 255, .5);
            border-radius: 24px;
            box-shadow: 0 24px 70px rgba(0, 0, 0, .22);
        }

        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 28px;
            color: var(--green);
            font-size: 28px;
            font-weight: 900;
        }

        .brand img {
            width: 52px;
            height: 52px;
            object-fit: contain;
        }

        .form-title {
            margin: 0;
            text-align: center;
            font-size: 30px;
            font-weight: 800;
        }

        .form-subtitle {
            margin: 8px 0 28px;
            text-align: center;
            color: var(--muted);
        }

        .form-label {
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 700;
        }

        .required-star {
            color: #dc3545;
            margin-left: 3px;
            font-weight: 800;
        }

        .required-text {
            color: #dc3545;
            font-size: 12px;
            font-weight: 500;
        }

        .form-control {
            min-height: 50px;
            padding: 12px 15px;
            border: 1px solid #dbe4e0;
            border-radius: 12px;
            background: #f9fbfa;
        }

        .form-control:focus {
            border-color: var(--green);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(8, 127, 91, .12);
        }

        .btn-login {
            min-height: 50px;
            border: 0;
            border-radius: 12px;
            color: #fff;
            background: var(--green);
            font-weight: 800;
            transition: .2s ease;
        }

        .btn-login:hover {
            color: #fff;
            background: var(--green-dark);
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(8, 127, 91, .2);
        }

        .register-link {
            color: var(--green);
            font-weight: 800;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 28px 22px;
            }

            .form-title {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <main class="login-card">
        <div class="brand">
            <img src="{{ asset('images/martana-logo.png') }}" alt="Logo MARTANA">
            <span>MARTANA</span>
        </div>

        <h1 class="form-title">Login Pengelola</h1>
        <p class="form-subtitle">
            Khusus Owner dan penjaga lapangan MARTANA.
        </p>

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">
                    Email
                    <span class="required-star">*</span>
                    <span class="required-text">wajib diisi</span>
                </label>

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

                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">
                    Password
                    <span class="required-star">*</span>
                    <span class="required-text">wajib diisi</span>
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >

                @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-login w-100">
                Login Pengelola
            </button>
        </form>

        <p class="text-center mt-4 mb-0">
            Login sebagai pelanggan?
            <a href="{{ route('login') }}" class="register-link">Klik di sini</a>
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