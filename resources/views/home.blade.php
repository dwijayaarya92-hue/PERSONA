@extends('layouts.mantis')

@section('title', 'Dashboard')

@section('content')

@php
    $user = Auth::user();

    // Mengambil role akun yang sedang login
    $role = strtolower($user->role ?? 'user');

    // Mengubah nama role agar lebih rapi
    $namaRole = match ($role) {
        'admin', 'administrator' => 'Admin',
        'supervisor' => 'Supervisor',
        'pegawai' => 'Pegawai',
        'user' => 'User',
        default => ucfirst($role),
    };
@endphp


{{-- =========================
    JUDUL HALAMAN (PENGGANTI BREADCRUMB)
========================= --}}
<div class="col-12 mb-3">
    <div class="page-header-title">
        <h2 class="mb-0 fw-bold">Dashboard</h2>
    </div>
</div>


{{-- =========================
    WELCOME CARD
========================= --}}
<div class="col-12 mb-4">
    <div
        class="card border-0 shadow-sm overflow-hidden"
        style="
            border-radius: 18px;
            background: linear-gradient(135deg, #4680ff 0%, #5b9cff 100%);
        "
    >
        <div class="card-body p-4 p-md-5">

            <div class="row align-items-center">

                {{-- TEKS --}}
                <div class="col-md-8">

                    <span
                        class="badge rounded-pill mb-3 px-3 py-2"
                        style="
                            background: rgba(255,255,255,0.20);
                            color: white;
                        "
                    >
                        Dashboard
                    </span>

                    <h1
                        class="fw-bold mb-2"
                        style="color: white;"
                    >
                        Selamat Datang, {{ $namaRole }}!
                    </h1>

                    <p
                        class="mb-0"
                        style="
                            color: rgba(255,255,255,0.90);
                            font-size: 16px;
                        "
                    >
                        Halo {{ $user->name }}, selamat datang di
                        Aplikasi Manajemen Pegawai.
                    </p>

                </div>


                {{-- ICON --}}
                <div class="col-md-4 text-md-end text-center mt-4 mt-md-0">

                    <div
                        class="d-inline-flex align-items-center justify-content-center rounded-circle"
                        style="
                            width: 110px;
                            height: 110px;
                            background: rgba(255,255,255,0.18);
                        "
                    >
                        <i
                            class="ti ti-users"
                            style="
                                font-size: 55px;
                                color: white;
                            "
                        ></i>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>


{{-- =========================
    SCORECARD
========================= --}}

<div class="col-md-6 mb-4">

    <div
        class="card border-0 shadow-sm h-100"
        style="border-radius: 18px;"
    >

        <div class="card-body p-4">

            <div class="d-flex align-items-center">

                {{-- ICON --}}
                <div
                    class="d-flex align-items-center justify-content-center rounded-3"
                    style="
                        width: 65px;
                        height: 65px;
                        background: #e8f1ff;
                        flex-shrink: 0;
                    "
                >
                    <i
                        class="ti ti-users"
                        style="
                            font-size: 32px;
                            color: #4680ff;
                        "
                    ></i>
                </div>

                {{-- DATA --}}
                <div class="ms-3">

                    <p class="text-muted mb-1">
                        Total Pegawai
                    </p>

                    <h2
                        class="fw-bold mb-0"
                        style="font-size: 30px;"
                    >
                        {{ $totalPegawai }}
                    </h2>

                    <small class="text-muted">
                        Data pegawai terdaftar
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- TOTAL BAGIAN --}}
<div class="col-md-6 mb-4">

    <div
        class="card border-0 shadow-sm h-100"
        style="border-radius: 18px;"
    >

        <div class="card-body p-4">

            <div class="d-flex align-items-center">

                {{-- ICON --}}
                <div
                    class="d-flex align-items-center justify-content-center rounded-3"
                    style="
                        width: 65px;
                        height: 65px;
                        background: #e8f1ff;
                        flex-shrink: 0;
                    "
                >
                    <i
                        class="ti ti-building"
                        style="
                            font-size: 32px;
                            color: #4680ff;
                        "
                    ></i>
                </div>

                {{-- DATA --}}
                <div class="ms-3">

                    <p class="text-muted mb-1">
                        Total Bagian
                    </p>

                    <h2
                        class="fw-bold mb-0"
                        style="font-size: 30px;"
                    >
                        {{ $totalBagian }}
                    </h2>

                    <small class="text-muted">
                        Bagian dalam perusahaan
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================
    INFORMASI AKUN
========================= --}}
<div class="col-12">

    <div
        class="card border-0 shadow-sm"
        style="border-radius: 18px;"
    >

        <div class="card-body p-4">

            <div class="d-flex align-items-center">

                <div
                    class="d-flex align-items-center justify-content-center rounded-circle"
                    style="
                        width: 50px;
                        height: 50px;
                        background: #f1f5f9;
                    "
                >
                    <i
                        class="ti ti-user"
                        style="
                            font-size: 25px;
                            color: #4680ff;
                        "
                    ></i>
                </div>

                <div class="ms-3">

                    <h6 class="mb-1 fw-bold">
                        Akun yang sedang login
                    </h6>

                    <span class="text-muted">
                        {{ $user->name }}
                        •
                        {{ $namaRole }}
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection