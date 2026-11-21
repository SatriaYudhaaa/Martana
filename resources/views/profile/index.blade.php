<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | MARTANA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

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
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Arial, sans-serif;
            color: var(--text);
            background: #f3f8f5;
        }

        .navbar-martana {
            background: #fff;
            padding: 18px 0;
            box-shadow: 0 3px 18px rgba(0, 0, 0, .05);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--green-dark);
            text-decoration: none;
            font-size: 26px;
            font-weight: 900;
        }

        .brand img {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--green);
            font-weight: 700;
            text-decoration: none;
        }

        .back-link:hover {
            color: var(--green-dark);
        }

        .profile-container {
            max-width: 850px;
            margin: 55px auto;
            padding: 0 18px;
        }

        .profile-card {
            background: #fff;
            border-radius: 24px;
            padding: 38px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, .07);
            border: 1px solid #e4eee8;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 32px;
            padding-bottom: 28px;
            border-bottom: 1px solid #e7eee9;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #087f5b, #10b981);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .profile-name {
            font-size: 26px;
            font-weight: 800;
            margin: 0;
        }

        .profile-role {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 14px;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 800;
            margin: 0;
        }

        .form-label {
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 9px;
        }

        .form-control {
            min-height: 52px;
            padding: 12px 16px;
            border: 1px solid #dce7e0;
            border-radius: 12px;
            background: #f9fbfa;
        }

        .form-control:focus {
            border-color: var(--green);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(8, 127, 91, .12);
        }

        .form-control:disabled {
            background: #f3f7f5;
            color: #34463e;
            opacity: 1;
            cursor: default;
        }

        .btn-edit,
        .btn-save {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            padding: 11px 20px;
            border: none;
            border-radius: 12px;
            background: var(--green);
            color: white;
            font-weight: 800;
            transition: .2s;
        }

        .btn-edit:hover,
        .btn-save:hover {
            background: var(--green-dark);
            color: white;
        }

        .btn-cancel {
            min-height: 46px;
            padding: 11px 20px;
            border: 1px solid #d5e5dc;
            border-radius: 12px;
            background: #fff;
            color: #34463e;
            font-weight: 700;
        }

        .btn-cancel:hover {
            background: #f3f7f5;
        }

        .info-box {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            border-radius: 12px;
            background: #ecfdf5;
            color: #047857;
            font-size: 13px;
            margin-bottom: 28px;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 10px;
        }

        .hidden {
            display: none !important;
        }

        @media (max-width: 600px) {
            .profile-container {
                margin: 25px auto;
            }

            .profile-card {
                padding: 25px 20px;
            }

            .profile-header {
                gap: 15px;
            }

            .avatar {
                width: 65px;
                height: 65px;
                font-size: 27px;
            }

            .profile-name {
                font-size: 21px;
            }

            .section-heading {
                align-items: flex-start;
            }

            .btn-edit {
                padding: 10px 12px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar-martana">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('images/martana-logo.png') }}" alt="MARTANA">
                MARTANA
            </a>

            <a href="{{ route('home') }}" class="back-link">
                <i data-lucide="arrow-left"></i>
                Kembali
            </a>
        </div>
    </nav>

    <!-- HALAMAN PROFIL -->
    <main class="profile-container">
        <div class="profile-card">

            <!-- IDENTITAS PELANGGAN -->
            <div class="profile-header">
                <div class="avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div>
                    <h1 class="profile-name">{{ $user->name }}</h1>
                    <p class="profile-role">Akun Pelanggan MARTANA</p>
                </div>
            </div>

            <!-- JUDUL DAN TOMBOL EDIT -->
            <div class="section-heading">
                <h2 class="section-title">Informasi Pribadi</h2>

                <button
                    type="button"
                    id="editButton"
                    class="btn-edit"
                    onclick="aktifkanEdit()"
                >
                    <i data-lucide="pencil" style="width:18px;height:18px;"></i>
                    Edit Profil
                </button>
            </div>

            <div class="info-box">
                <i data-lucide="shield-check"></i>
                <span id="infoText">
                    Klik tombol Edit Profil untuk memperbarui informasi akunmu.
                </span>
            </div>

            <!-- FORM PROFIL -->
            <form
                id="profileForm"
                action="{{ route('profile.update') }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="form-label">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}"
                        required
                        disabled
                    >

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        required
                        disabled
                    >

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="phone" class="form-label">
                        Nomor HP
                    </label>

                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $user->phone) }}"
                        placeholder="08xxxxxxxxxx"
                        pattern="08[0-9]{10}"
                        minlength="12"
                        maxlength="12"
                        required
                        disabled
                    >

                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- TOMBOL SIMPAN DAN BATAL -->
                <div id="editActions" class="action-buttons hidden">
                    <button
                        type="button"
                        class="btn-cancel"
                        onclick="batalkanEdit()"
                    >
                        Batal
                    </button>

                    <button type="submit" class="btn-save">
                        <i
                            data-lucide="save"
                            style="width:18px;height:18px;"
                        ></i>
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const form = document.getElementById('profileForm');
        const inputs = form.querySelectorAll('input.form-control');
        const editButton = document.getElementById('editButton');
        const editActions = document.getElementById('editActions');
        const infoText = document.getElementById('infoText');

        function aktifkanEdit() {
            inputs.forEach(input => {
                input.disabled = false;
            });

            editButton.classList.add('hidden');
            editActions.classList.remove('hidden');

            infoText.textContent =
                'Silakan ubah informasi akunmu, lalu klik Simpan Perubahan.';

            document.getElementById('name').focus();
        }

        function batalkanEdit() {
            form.reset();

            inputs.forEach(input => {
                input.disabled = true;
            });

            editButton.classList.remove('hidden');
            editActions.classList.add('hidden');

            infoText.textContent =
                'Klik tombol Edit Profil untuk memperbarui informasi akunmu.';
        }

        lucide.createIcons();

        // Jika validasi Laravel gagal, form otomatis terbuka kembali
        @if ($errors->any())
            aktifkanEdit();
        @endif

        // Notifikasi ketika profil berhasil diperbarui
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Profil Berhasil Diperbarui!',
                text: @json(session('success')),
                confirmButtonColor: '#087f5b',
                confirmButtonText: 'Oke'
            });
        @endif
    </script>

</body>
</html>