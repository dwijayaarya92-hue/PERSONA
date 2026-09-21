@extends('layouts.mantis')

@section('title', 'Edit Profil')

@section('content')

<div class="col-12">

    <div class="card">

        {{-- HEADER --}}
        <div class="card-header">
            <div class="d-flex align-items-center">

                <div
                    class="d-flex align-items-center justify-content-center bg-light-primary rounded-circle me-3"
                    style="width: 50px; height: 50px;"
                >
                    <i class="ti ti-user fs-3 text-primary"></i>
                </div>

                <div>
                    <h4 class="mb-1">Edit Profil</h4>

                    <p class="text-muted mb-0">
                        Ubah informasi akun Anda
                    </p>
                </div>

            </div>
        </div>


        {{-- FORM --}}
        <div class="card-body">

            <form
                action="{{ route('profile.update') }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                {{-- NAMA --}}
                <div class="mb-3">

                    <label for="name" class="form-label">
                        Nama
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}"
                        placeholder="Masukkan nama"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- EMAIL --}}
                <div class="mb-3">

                    <label for="email" class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        placeholder="Masukkan email"
                        required
                    >

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <hr class="my-4">


                {{-- PASSWORD --}}
                <h5 class="mb-1">
                    Ubah Password
                </h5>

                <p class="text-muted mb-3">
                    Kosongkan bagian ini jika tidak ingin mengubah password.
                </p>


                {{-- PASSWORD BARU --}}
                <div class="mb-3">

                    <label for="password" class="form-label">
                        Password Baru
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan password baru"
                    >

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- KONFIRMASI PASSWORD --}}
                <div class="mb-4">

                    <label for="password_confirmation" class="form-label">
                        Konfirmasi Password Baru
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi password baru"
                    >

                </div>


                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2">

                    <a
                        href="{{ route('home') }}"
                        class="btn btn-light"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="ti ti-device-floppy me-1"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection