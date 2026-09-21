@extends('layouts.mantis')

@section('title', 'Data Bagian')

@section('content')

<div class="col-12">

    {{-- ========================================================= --}}
    {{-- JUDUL HALAMAN --}}
    {{-- ========================================================= --}}

    <div class="mb-4">
        <h3 class="fw-bold mb-1">
            Halaman Bagian
        </h3>

        <p class="text-muted mb-0">
            Kelola data bagian atau departemen perusahaan
        </p>
    </div>


    {{-- ========================================================= --}}
    {{-- CARD DATA BAGIAN --}}
    {{-- ========================================================= --}}

    <div class="card border-0 shadow-sm">

        {{-- ===================================================== --}}
        {{-- HEADER CARD --}}
        {{-- ===================================================== --}}

        <div class="card-header bg-white border-bottom py-4 px-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                {{-- JUDUL --}}
                <div>
                    <h4 class="mb-1">
                        Data Bagian
                    </h4>

                    <p class="text-muted mb-0">
                        Daftar bagian atau departemen perusahaan
                    </p>
                </div>


                {{-- TOMBOL TAMBAH --}}
                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahBagian">

                    <i class="ti ti-plus me-1"></i>
                    Tambah Bagian

                </button>

            </div>

        </div>


        {{-- ===================================================== --}}
        {{-- BODY CARD --}}
        {{-- ===================================================== --}}

        <div class="card-body px-4 py-4">


            {{-- ================================================= --}}
            {{-- FILTER & SEARCH --}}
            {{-- ================================================= --}}

            <div class="d-flex justify-content-between align-items-center mb-4 gap-3">


                {{-- ================================================= --}}
                {{-- FILTER BAGIAN - KIRI --}}
                {{-- ================================================= --}}

                <div class="dropdown">

                    <button
                        type="button"
                        class="btn btn-outline-secondary dropdown-toggle"
                        id="filterBagianButton"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="outside"
                        aria-expanded="false">

                        <i class="ti ti-filter me-1"></i>
                        Filter Bagian

                    </button>


                    {{-- DROPDOWN CHECKLIST --}}
                    <div
                        class="dropdown-menu dropdown-menu-start p-3 shadow-sm"
                        style="width: 250px; max-height: 350px; overflow-y: auto;">


                        {{-- SEMUA BAGIAN --}}
                        <div class="form-check mb-2">

                            <input
                                type="checkbox"
                                class="form-check-input bagian-filter"
                                id="filterAll"
                                value="all"
                                checked>

                            <label
                                class="form-check-label fw-semibold"
                                for="filterAll">

                                Semua Bagian

                            </label>

                        </div>


                        <hr class="my-2">


                        {{-- DAFTAR BAGIAN --}}
                        @foreach ($bagians as $bagian)

                            <div class="form-check mb-2">

                                <input
                                    type="checkbox"
                                    class="form-check-input bagian-filter"
                                    id="filterBagian{{ $bagian->id }}"
                                    value="{{ strtolower(trim($bagian->nama_bagian)) }}"
                                    checked>

                                <label
                                    class="form-check-label"
                                    for="filterBagian{{ $bagian->id }}">

                                    {{ $bagian->nama_bagian }}

                                </label>

                            </div>

                        @endforeach

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- SEARCH - KANAN --}}
                {{-- ================================================= --}}

                <div class="bagian-search">

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="ti ti-search"></i>
                        </span>

                        <input
                            type="text"
                            id="searchBagian"
                            class="form-control"
                            placeholder="Cari nama bagian..."
                            autocomplete="off">

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- TABLE --}}
            {{-- ================================================= --}}

            <div class="table-responsive">

                <table
                    class="table table-hover align-middle mb-0"
                    id="tableBagian">

                    <thead>

                        <tr>

                            {{-- NO --}}
                            <th style="width: 70px;">
                                No
                            </th>


                            {{-- BAGIAN --}}
                            <th>
                                Bagian
                            </th>


                            {{-- JUMLAH KARYAWAN --}}
                            <th style="width: 200px;">
                                Jumlah Karyawan
                            </th>


                            {{-- OPSI --}}
                            <th
                                class="text-end"
                                style="width: 290px;">

                                Opsi

                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($bagians as $index => $bagian)

                            <tr>


                                {{-- ================================================= --}}
                                {{-- NO --}}
                                {{-- ================================================= --}}

                                <td>
                                    {{ $index + 1 }}
                                </td>


                                {{-- ================================================= --}}
                                {{-- NAMA BAGIAN --}}
                                {{-- ================================================= --}}

                                <td>

                                    <span class="fw-semibold text-dark">
                                        {{ $bagian->nama_bagian }}
                                    </span>

                                </td>


                                {{-- ================================================= --}}
                                {{-- JUMLAH KARYAWAN --}}
                                {{-- ================================================= --}}

                                <td>

                                    <span class="badge bg-light-primary text-primary px-3 py-2">

                                        <i class="ti ti-users me-1"></i>

                                        {{ $bagian->pegawai_count ?? 0 }}

                                        Karyawan

                                    </span>

                                </td>


                                {{-- ================================================= --}}
                                {{-- OPSI --}}
                                {{-- ================================================= --}}

                                <td class="text-end">

                                    <div class="d-inline-flex align-items-center gap-2 flex-nowrap">


                                        {{-- DETAIL --}}
                                        <a
                                            href="{{ route('bagian.show', $bagian->id) }}"
                                            class="btn btn-info btn-sm text-white">

                                            <i class="ti ti-eye me-1"></i>
                                            Detail

                                        </a>


                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('bagian.edit', $bagian->id) }}"
                                            class="btn btn-warning btn-sm text-white">

                                            <i class="ti ti-edit me-1"></i>
                                            Edit

                                        </a>


                                        {{-- HAPUS --}}
                                        <form
                                            action="{{ route('bagian.destroy', $bagian->id) }}"
                                            method="POST"
                                            class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus data bagian ini?')">

                                                <i class="ti ti-trash me-1"></i>
                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr id="emptyRow">

                                <td
                                    colspan="4"
                                    class="text-center text-muted py-5">

                                    <i class="ti ti-database-off fs-3 d-block mb-2"></i>

                                    Belum ada data bagian.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- ================================================= --}}
            {{-- PESAN FILTER KOSONG --}}
            {{-- ================================================= --}}

            <div
                id="filterEmpty"
                class="text-center text-muted py-4 d-none">

                <i class="ti ti-filter-off fs-3 d-block mb-2"></i>

                Tidak ada bagian yang dipilih.

            </div>


            {{-- ================================================= --}}
            {{-- PESAN SEARCH KOSONG --}}
            {{-- ================================================= --}}

            <div
                id="searchEmpty"
                class="text-center text-muted py-4 d-none">

                <i class="ti ti-search-off fs-3 d-block mb-2"></i>

                Data bagian yang dicari tidak ditemukan.

            </div>

        </div>

    </div>

</div>



{{-- ============================================================= --}}
{{-- MODAL TAMBAH BAGIAN --}}
{{-- ============================================================= --}}

<div
    class="modal fade"
    id="modalTambahBagian"
    tabindex="-1"
    aria-labelledby="modalTambahBagianLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            {{-- MODAL HEADER --}}
            <div class="modal-header">

                <h5
                    class="modal-title"
                    id="modalTambahBagianLabel">

                    Tambah Bagian

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>


            {{-- FORM TAMBAH --}}
            <form
                action="{{ route('bagian.store') }}"
                method="POST">

                @csrf

                <div class="modal-body">

                    <div class="mb-3">

                        <label
                            for="nama_bagian"
                            class="form-label fw-semibold">

                            Nama Bagian

                        </label>


                        <input
                            type="text"
                            name="nama_bagian"
                            id="nama_bagian"
                            class="form-control @error('nama_bagian') is-invalid @enderror"
                            placeholder="Masukkan nama bagian..."
                            value="{{ old('nama_bagian') }}"
                            required>


                        @error('nama_bagian')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- MODAL FOOTER --}}
                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="ti ti-device-floppy me-1"></i>
                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- ============================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =========================================================
       ELEMENT
       ========================================================= */

    const table =
        document.getElementById('tableBagian');

    const searchInput =
        document.getElementById('searchBagian');

    const filterAll =
        document.getElementById('filterAll');

    const checkboxes =
        document.querySelectorAll('.bagian-filter');

    const filterEmpty =
        document.getElementById('filterEmpty');

    const searchEmpty =
        document.getElementById('searchEmpty');


    if (!table) {
        return;
    }


    /* =========================================================
       FUNGSI FILTER & SEARCH
       ========================================================= */

    function updateTable() {


        const rows =
            table.querySelectorAll(
                'tbody tr:not(#emptyRow)'
            );


        /* -----------------------------------------------------
           SEARCH
           ----------------------------------------------------- */

        const keyword =
            searchInput
                ? searchInput.value
                    .toLowerCase()
                    .trim()
                : '';


        /* -----------------------------------------------------
           BAGIAN YANG DIPILIH
           ----------------------------------------------------- */

        const selectedParts = [];


        checkboxes.forEach(function (checkbox) {

            if (
                checkbox.value !== 'all' &&
                checkbox.checked
            ) {

                selectedParts.push(
                    checkbox.value
                        .toLowerCase()
                        .trim()
                );

            }

        });


        /* -----------------------------------------------------
           CEK SEMUA BAGIAN
           ----------------------------------------------------- */

        const semuaDipilih =
            filterAll
                ? filterAll.checked
                : true;


        let visibleRows = 0;


        /* -----------------------------------------------------
           FILTER SETIAP BARIS
           ----------------------------------------------------- */

        rows.forEach(function (row) {


            const namaBagian =
                row.cells[1]
                    ? row.cells[1]
                        .textContent
                        .toLowerCase()
                        .trim()
                    : '';


            /* Cocok dengan search */
            const cocokSearch =
                keyword === '' ||
                namaBagian.includes(keyword);


            /* Cocok dengan checkbox */
            const cocokFilter =
                semuaDipilih ||
                selectedParts.includes(namaBagian);


            /* Tampilkan / sembunyikan */
            if (
                cocokSearch &&
                cocokFilter
            ) {

                row.style.display = '';
                visibleRows++;

            } else {

                row.style.display = 'none';

            }

        });


        /* =====================================================
           PESAN FILTER
           ===================================================== */

        if (filterEmpty) {

            if (
                !semuaDipilih &&
                selectedParts.length === 0
            ) {

                filterEmpty.classList.remove('d-none');

            } else {

                filterEmpty.classList.add('d-none');

            }

        }


        /* =====================================================
           PESAN SEARCH
           ===================================================== */

        if (searchEmpty) {

            if (
                keyword !== '' &&
                visibleRows === 0
            ) {

                searchEmpty.classList.remove('d-none');

            } else {

                searchEmpty.classList.add('d-none');

            }

        }

    }


    /* =========================================================
       EVENT SEARCH
       ========================================================= */

    if (searchInput) {

        searchInput.addEventListener(
            'input',
            function () {

                updateTable();

            }
        );

    }


    /* =========================================================
       EVENT CHECKBOX
       ========================================================= */

    checkboxes.forEach(function (checkbox) {


        checkbox.addEventListener(
            'change',
            function () {


                /* ------------------------------------------------
                   JIKA SEMUA BAGIAN DICENTANG
                   ------------------------------------------------ */

                if (
                    this.value === 'all' &&
                    this.checked
                ) {

                    checkboxes.forEach(
                        function (item) {

                            if (
                                item.value !== 'all'
                            ) {

                                item.checked = true;

                            }

                        }
                    );

                }


                /* ------------------------------------------------
                   JIKA SALAH SATU BAGIAN DIUBAH
                   ------------------------------------------------ */

                if (
                    this.value !== 'all'
                ) {


                    const bagianCheckboxes =
                        Array.from(checkboxes)
                            .filter(
                                function (item) {

                                    return (
                                        item.value !== 'all'
                                    );

                                }
                            );


                    const semuaTercentang =
                        bagianCheckboxes.length > 0 &&
                        bagianCheckboxes.every(
                            function (item) {

                                return item.checked;

                            }
                        );


                    if (filterAll) {

                        filterAll.checked =
                            semuaTercentang;

                    }

                }


                updateTable();

            }
        );

    });


    /* =========================================================
       FILTER AWAL
       ========================================================= */

    updateTable();

});

</script>



{{-- ============================================================= --}}
{{-- STYLE --}}
{{-- ============================================================= --}}

<style>


    /* =========================================================
       SEARCH
       ========================================================= */

    .bagian-search {
        width: 360px;
        max-width: 100%;
    }

    #searchBagian {
        height: 42px;
    }


    /* =========================================================
       TABLE
       ========================================================= */

    #tableBagian {
        width: 100%;
    }


    #tableBagian thead th {
        font-weight: 600;
        white-space: nowrap;
        vertical-align: middle;
    }


    #tableBagian tbody tr {
        height: 65px;
    }


    #tableBagian tbody td {
        vertical-align: middle;
    }


    /* =========================================================
       KOLOM OPSI
       ========================================================= */

    #tableBagian td:last-child {
        white-space: nowrap;
    }


    #tableBagian .btn-sm {
        min-width: 70px;
    }


    /* =========================================================
       BADGE JUMLAH KARYAWAN
       ========================================================= */

    #tableBagian .badge {
        font-weight: 500;
        white-space: nowrap;
    }


    /* =========================================================
       DROPDOWN FILTER
       ========================================================= */

    #filterBagianButton {
        height: 42px;
    }


    .dropdown-menu {
        border: 0;
        border-radius: 8px;
    }


    /* =========================================================
       CHECKBOX
       ========================================================= */

    .bagian-filter {
        cursor: pointer;
    }


    .form-check-label {
        cursor: pointer;
    }


    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 768px) {

        .bagian-search {
            width: 100%;
        }


        .d-flex.justify-content-between.align-items-center.mb-4 {
            flex-direction: column;
            align-items: stretch !important;
        }


        #filterBagianButton {
            width: 100%;
        }


        .dropdown {
            width: 100%;
        }

    }

</style>

@endsection