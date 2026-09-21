<!DOCTYPE html>
<html lang="id">

<head>

    <title>Login | Aplikasi Manajemen Pegawai</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description"
          content="Aplikasi Manajemen Pegawai">
    <meta name="author"
          content="Aplikasi Manajemen Pegawai">

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

    @vite(['resources/js/app.js'])

</head>


<body>

    <!-- Pre-loader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- End Pre-loader -->


    <!-- Main Login -->
    <div class="auth-main">

        <div class="auth-wrapper v3">

            <div class="auth-form">

                <!-- Header -->
                <div class="auth-header text-center">

                    <a href="{{ url('/') }}">

                        <img
                            src="{{ asset('template/dist/assets/images/logo-dark.svg') }}"
                            alt="Logo"
                            style="max-width: 220px;"
                        >

                    </a>

                </div>


                <!-- Login Card -->
                <div class="card my-3">

                    <div class="card-body">


                        <!-- Judul -->
                        <div class="text-center mb-4">

                            <h3 class="mb-1">
                                <b>Login</b>
                            </h3>

                            <p class="text-muted mb-0">
                                Silakan masuk ke akun Anda
                            </p>

                        </div>


                        <!-- Pesan Berhasil -->
                        @if (session('success'))

                            <div class="alert alert-success" role="alert">

                                <i class="ti ti-check me-1"></i>

                                {{ session('success') }}

                            </div>

                        @endif


                        <!-- Pesan Error -->
                        @if (session('error'))

                            <div class="alert alert-danger" role="alert">

                                <i class="ti ti-alert-circle me-1"></i>

                                {{ session('error') }}

                            </div>

                        @endif


                        <!-- Form Login -->
                        <form action="{{ route('login') }}" method="POST">

                            @csrf


                            <!-- Email -->
                            <div class="form-group mb-3">

                                <label for="email" class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Masukkan email"
                                    autocomplete="email"
                                    required
                                    autofocus
                                >

                                @error('email')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <!-- Password -->
                            <div class="form-group mb-3">

                                <label for="password" class="form-label">
                                    Password
                                </label>

                                <div class="input-group">

                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Masukkan password"
                                        autocomplete="current-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePassword()"
                                        title="Tampilkan password"
                                    >
                                        <i class="ti ti-eye" id="passwordIcon"></i>
                                    </button>

                                </div>

                                @error('password')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <!-- Remember & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mt-2">

                                <div class="form-check">

                                    <input
                                        class="form-check-input input-primary"
                                        type="checkbox"
                                        id="remember"
                                        name="remember"
                                        {{ old('remember') ? 'checked' : '' }}
                                    >

                                    <label
                                        class="form-check-label text-muted"
                                        for="remember"
                                    >
                                        Ingat saya
                                    </label>

                                </div>


                                @if (Route::has('password.request'))

                                    <a
                                        href="{{ route('password.request') }}"
                                        class="text-primary"
                                    >
                                        Lupa Password?
                                    </a>

                                @endif

                            </div>


                            <!-- Tombol Login -->
                            <div class="d-grid mt-4">

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    <i class="ti ti-login me-1"></i>
                                    Login
                                </button>

                            </div>

                        </form>

                    </div>

                </div>


                <!-- Footer -->
                <div class="auth-footer text-center">

                    <p class="m-0 text-muted">
                        © {{ date('Y') }} Aplikasi Manajemen Pegawai
                    </p>

                </div>

            </div>

        </div>

    </div>
    <!-- End Main Login -->


    <!-- Required JS -->
    <script src="{{ asset('template/dist/assets/js/plugins/popper.min.js') }}"></script>

    <script src="{{ asset('template/dist/assets/js/plugins/simplebar.min.js') }}"></script>

    <script src="{{ asset('template/dist/assets/js/plugins/bootstrap.min.js') }}"></script>

    <script src="{{ asset('template/dist/assets/js/fonts/custom-font.js') }}"></script>

    <script src="{{ asset('template/dist/assets/js/pcoded.js') }}"></script>

    <script src="{{ asset('template/dist/assets/js/plugins/feather.min.js') }}"></script>


    <!-- Template Configuration -->
    <script>
        layout_change('light');
        change_box_container('false');
        layout_rtl_change('false');
        preset_change('preset-1');
        font_change('Public-Sans');
    </script>


    <!-- Toggle Password -->
    <script>

        function togglePassword() {

            const password = document.getElementById('password');
            const icon = document.getElementById('passwordIcon');

            if (password.type === 'password') {

                password.type = 'text';

                icon.classList.remove('ti-eye');
                icon.classList.add('ti-eye-off');

            } else {

                password.type = 'password';

                icon.classList.remove('ti-eye-off');
                icon.classList.add('ti-eye');

            }

        }

    </script>

</body>

</html>