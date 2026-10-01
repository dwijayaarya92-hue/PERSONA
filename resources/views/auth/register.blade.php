<!DOCTYPE html>
<html lang="id">

<head>
    <title>Daftar - Aplikasi Manajemen Pegawai</title>

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
          href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap">

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

    <!-- Mantis CSS -->
    <link rel="stylesheet"
          href="{{ asset('template/dist/assets/css/style.css') }}">

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
    <!-- End Pre-loader -->


    <!-- Authentication -->
    <div class="auth-main">
        <div class="auth-wrapper v3">

            <div class="auth-form">

                <!-- Logo -->
                <div class="auth-header">
                    <a href="{{ url('/') }}">
                        <img
                            src="{{ asset('template/dist/assets/images/logo-dark.svg') }}"
                            alt="Logo"
                            style="max-height: 45px;"
                        >
                    </a>
                </div>


                <!-- Register Card -->
                <div class="card my-5">

                    <div class="card-body">

                        <!-- Header -->
                        <div class="text-center mb-4">

                            <h3 class="mb-2">
                                <b>Daftar Akun</b>
                            </h3>

                            <p class="text-muted mb-0">
                                Buat akun baru untuk menggunakan aplikasi
                            </p>

                        </div>


                        <!-- Register Form -->
                        <form
                            method="POST"
                            action="{{ route('register') }}"
                        >

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
                                    value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Masukkan nama lengkap"
                                    autocomplete="name"
                                    autofocus
                                >

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
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
                                    value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Masukkan alamat email"
                                    autocomplete="email"
                                >

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
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
                                >

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
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
                                >

                            </div>


                            <!-- Informasi Role -->
                            <div class="alert alert-light-primary mb-4">

                                <div class="d-flex align-items-center">

                                    <i class="ti ti-info-circle me-2 fs-4"></i>

                                    <div>
                                        <strong>Informasi</strong>
                                        <br>
                                        Akun yang didaftarkan akan memiliki
                                        role <strong>Staff</strong>.
                                    </div>

                                </div>

                            </div>


                            <!-- Button -->
                            <div class="d-grid mt-3">

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    <i class="ti ti-user-plus me-1"></i>
                                    Buat Akun
                                </button>

                            </div>

                        </form>


                        <!-- Login -->
                        <div class="text-center mt-4">

                            <p class="text-muted mb-0">
                                Sudah memiliki akun?
                                <a
                                    href="{{ route('login') }}"
                                    class="link-primary"
                                >
                                    Login di sini
                                </a>
                            </p>

                        </div>

                    </div>

                </div>


                <!-- Footer -->
                <div class="text-center text-muted">

                    <p class="mb-0">
                        &copy; {{ date('Y') }}
                        Aplikasi Manajemen Pegawai
                    </p>

                </div>

            </div>

        </div>
    </div>
    <!-- End Authentication -->


    <!-- Required JS -->

    <script src="{{ asset('template/dist/assets/js/plugins/popper.min.js') }}"></script>

    <script src="{{ asset('template/dist/assets/js/plugins/simplebar.min.js') }}"></script>

    <script src="{{ asset('template/dist/assets/js/plugins/bootstrap.min.js') }}"></script>

    <script src="{{ asset('template/dist/assets/js/fonts/custom-font.js') }}"></script>

    <script src="{{ asset('template/dist/assets/js/pcoded.js') }}"></script>

    <script src="{{ asset('template/dist/assets/js/plugins/feather.min.js') }}"></script>


    <!-- Layout -->
    <script>
        layout_change('light');
        change_box_container('false');
        layout_rtl_change('false');
        preset_change('preset-1');
        font_change('Public-Sans');
    </script>

</body>

</html>