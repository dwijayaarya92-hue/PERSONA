@extends('layouts.mantis')

@section('title', 'Lupa Password')

@section('content')

<div class="col-12">

    <div class="row justify-content-center">

        <div class="col-md-7 col-lg-6">

            <div class="card border-0 shadow-sm">

                {{-- HEADER --}}
                <div class="card-header bg-white border-bottom py-4">

                    <div class="text-center">

                        <div class="mb-3">
                            <i class="ti ti-lock-question text-primary"
                               style="font-size: 45px;"></i>
                        </div>

                        <h4 class="mb-1 fw-bold">
                            Lupa Password
                        </h4>

                        <p class="text-muted mb-0">
                            Silakan masukkan email dan password baru Anda.
                        </p>

                    </div>

                </div>


                {{-- BODY --}}
                <div class="card-body p-4">

                    {{-- PESAN ERROR UMUM --}}
                    @if (session('error'))

                        <div class="alert alert-danger" role="alert">

                            <i class="ti ti-alert-circle me-1"></i>

                            {{ session('error') }}

                        </div>

                    @endif


                    {{-- PESAN BERHASIL --}}
                    @if (session('success'))

                        <div class="alert alert-success" role="alert">

                            <i class="ti ti-circle-check me-1"></i>

                            {{ session('success') }}

                        </div>

                    @endif


                    {{-- VALIDASI --}}
                    @if ($errors->any())

                        <div class="alert alert-danger" role="alert">

                            <div class="fw-semibold mb-1">
                                Terdapat kesalahan:
                            </div>

                            <ul class="mb-0 ps-3">

                                @foreach ($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- FORM --}}
                    <form
                        method="POST"
                        action="{{ route('password.reset.direct') }}">

                        @csrf


                        {{-- EMAIL --}}
                        <div class="mb-3">

                            <label
                                for="email"
                                class="form-label fw-semibold">

                                Email

                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-white">
                                    <i class="ti ti-mail"></i>
                                </span>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}"
                                    placeholder="Masukkan email terdaftar"
                                    autocomplete="email"
                                    required
                                    autofocus>

                            </div>

                            @error('email')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- PASSWORD BARU --}}
                        <div class="mb-3">

                            <label
                                for="password"
                                class="form-label fw-semibold">

                                Password Baru

                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-white">
                                    <i class="ti ti-lock"></i>
                                </span>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Masukkan password baru"
                                    autocomplete="new-password"
                                    required>

                                <button
                                    type="button"
                                    class="btn btn-outline-secondary"
                                    onclick="togglePassword('password', 'iconPassword')">

                                    <i
                                        class="ti ti-eye"
                                        id="iconPassword">
                                    </i>

                                </button>

                            </div>

                            @error('password')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                            @enderror

                            <small class="text-muted">
                                Minimal 8 karakter.
                            </small>

                        </div>


                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="mb-4">

                            <label
                                for="password_confirmation"
                                class="form-label fw-semibold">

                                Konfirmasi Password Baru

                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-white">
                                    <i class="ti ti-lock-check"></i>
                                </span>

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Masukkan ulang password baru"
                                    autocomplete="new-password"
                                    required>

                                <button
                                    type="button"
                                    class="btn btn-outline-secondary"
                                    onclick="togglePassword('password_confirmation', 'iconPasswordConfirmation')">

                                    <i
                                        class="ti ti-eye"
                                        id="iconPasswordConfirmation">
                                    </i>

                                </button>

                            </div>

                        </div>


                        {{-- TOMBOL --}}
                        <div class="d-flex justify-content-between align-items-center">

                            <a
                                href="{{ route('login') }}"
                                class="btn btn-light">

                                <i class="ti ti-arrow-left me-1"></i>

                                Kembali ke Login

                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="ti ti-lock-check me-1"></i>

                                Ubah Password

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ===================================================== --}}
{{-- JAVASCRIPT --}}
{{-- ===================================================== --}}

<script>

function togglePassword(inputId, iconId) {

    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === 'password') {

        input.type = 'text';

        icon.classList.remove('ti-eye');
        icon.classList.add('ti-eye-off');

    } else {

        input.type = 'password';

        icon.classList.remove('ti-eye-off');
        icon.classList.add('ti-eye');

    }

}

</script>

@endsection