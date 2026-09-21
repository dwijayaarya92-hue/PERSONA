@extends('layouts.mantis')

@section('title', 'Edit Data Bagian')

@section('content')

<div class="col-12">

    <div class="card border-0 shadow-sm">

        {{-- HEADER --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="ti ti-building me-2"></i>
                Edit Data Bagian
            </h4>

            <a href="{{ route('bagian.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left me-1"></i>
                Kembali
            </a>
        </div>

        {{-- BODY --}}
        <div class="card-body">

            <form
                action="{{ route('bagian.update', $bagian->id) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                {{-- NAMA BAGIAN --}}
                <div class="form-group mb-4">

                    <label for="nama_bagian" class="form-label fw-semibold">
                        Nama Bagian
                    </label>

                    <input
                        type="text"
                        name="nama_bagian"
                        id="nama_bagian"
                        class="form-control @error('nama_bagian') is-invalid @enderror"
                        value="{{ old('nama_bagian', $bagian->nama_bagian) }}"
                        placeholder="Masukkan nama bagian"
                        required
                    >

                    @error('nama_bagian')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- TOMBOL --}}
                <div class="d-flex gap-2">

                    <a
                        href="{{ route('bagian.index') }}"
                        class="btn btn-light"
                    >
                        <i class="ti ti-x me-1"></i>
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