<!DOCTYPE html>
<html lang="id">

<head>
    <title>Daftar | Aplikasi Manajemen Pegawai</title>

    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description"
        content="Aplikasi Manajemen Pegawai">
    <meta name="author"
        content="Persona">

    <!-- Favicon -->
    <link rel="icon"
        href="{{ asset('template/dist/assets/images/favicon.svg') }}"
        type="image/x-icon">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">

    <!-- Tabler Icons -->
    <link rel="stylesheet"
        href="{{ asset('template/dist/assets/fonts/tabler-icons.min.css') }}">

    <!-- Feather Icons -->
    <link rel="stylesheet"
        href="{{ asset('template/dist/assets/fonts/feather.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="{{ asset('template/dist/assets/fonts/fontawesome.css') }}">

    <!-- Material Icons -->
    <link rel="stylesheet"
        href="{{ asset('template/dist/assets/fonts/material.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet"
        href="{{ asset('template/dist/assets/css/style.css') }}"
        id="main-style-link">

    <link rel="stylesheet"
        href="{{ asset('template/dist/assets/css/style-preset.css') }}">
</head>

<body>

    <!-- Pre-loader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">

                <!-- Header -->
                <div class="auth-header">
                    <a href="{{ url('/') }}">
                        <img
                            src="{{ asset('template/dist/assets/images/logo-dark.svg') }}"
                            alt="Logo Aplikasi Manajemen Pegawai">
                    </a>
                </div>

                <!-- Card -->
                <div class="card my-5">
                    <div class="card-body">

                        <!-- Judul -->
                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <div>
                                <h3 class="mb-1">
                                    <b>Buat Akun</b>
                                </h3>

                                <p class="text-muted mb-0">
                                    Daftar untuk menggunakan aplikasi
                                </p>
                            </div>

                            <a href="{{ route('login') }}"
                                class="link-primary">
                                Login
                            </a>
                        </div>

                        <!-- Form Register -->
                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <!-- Nama -->
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Nama Lengkap
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Masukkan nama lengkap"
                                    value="{{ old('name') }}"
                                    autocomplete="name"
                                    required>

                                @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Email
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Masukkan email"
                                    value="{{ old('email') }}"
                                    autocomplete="email"
                                    required>

                                @error('email')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Password
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Minimal 8 karakter"
                                    autocomplete="new-password"
                                    required>

                                @error('password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Konfirmasi Password
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Ulangi password"
                                    autocomplete="new-password"
                                    required>
                            </div>

                            <!-- Informasi Role -->
                            <div class="alert alert-light-primary mb-3">
                                <div class="d-flex align-items-center">
                                    <i class="ti ti-info-circle me-2"></i>

                                    <div>
                                        <strong>Informasi</strong>
                                        <br>
                                        Akun yang didaftarkan akan memiliki
                                        role <strong>Staff</strong>.
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol -->
                            <div class="d-grid mt-4">
                                <button
                                    type="submit"
                                    class="btn btn-primary">
                                    <i class="ti ti-user-plus me-1"></i>
                                    Buat Akun
                                </button>
                            </div>

                        </form>

                        <!-- Link Login -->
                        <div class="text-center mt-4">
                            <span class="text-muted">
                                Sudah punya akun?
                            </span>

                            <a
                                href="{{ route('login') }}"
                                class="link-primary fw-semibold ms-1">
                                Login di sini
                            </a>
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="auth-footer row">

                    <div class="col my-1">
                        <p class="m-0">
                            © {{ date('Y') }} Persona
                        </p>
                    </div>

                    <div class="col-auto my-1">
                        <ul class="list-inline footer-link mb-0">
                            <li class="list-inline-item">
                                <a href="{{ url('/') }}">
                                    Home
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Required JS -->
    <script src="{{ asset('template/dist/assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('template/dist/assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('template/dist/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/dist/assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('template/dist/assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('template/dist/assets/js/plugins/feather.min.js') }}"></script>

    <script>
        layout_change('light');
        change_box_container('false');
        layout_rtl_change('false');
        preset_change("preset-1");
        font_change("Public-Sans");
    </script>

</body>

</html>