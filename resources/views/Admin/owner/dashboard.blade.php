<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner | MARTANA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: #f4f8f6;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #142b25;
        }

        .navbar {
            background: linear-gradient(135deg, #064e3b, #087f5b);
            padding: 18px 5%;
        }

        .brand {
            color: white;
            font-size: 24px;
            font-weight: 900;
        }

        .content {
            padding: 45px 5%;
        }

        .welcome-card {
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,.06);
        }

        .btn-logout {
            background: white;
            color: #087f5b;
            border: none;
            border-radius: 9px;
            padding: 9px 18px;
            font-weight: 700;
        }
    </style>
</head>
<body>

    <nav class="navbar d-flex justify-content-between align-items-center">
        <div class="brand">MARTANA</div>

        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </nav>

    <main class="content">
        <div class="welcome-card">
            <h2 class="fw-bold">Dashboard Owner</h2>

            <p class="text-secondary mt-3">
                Selamat datang, {{ Auth::user()->name }}!
            </p>

            <p>
                Kamu login sebagai Owner MARTANA.
            </p>

            <hr>

            <h5 class="fw-bold">Panel Pengelolaan</h5>

            <p class="text-secondary">
                Nantinya, dari halaman ini kamu dapat mengelola akun penjaga,
                data lapangan, booking pelanggan, dan operasional MARTANA.
            </p>
        </div>
    </main>

</body>
</html>