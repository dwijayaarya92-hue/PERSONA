@extends('layouts.mantis')

@section('title', 'Data Pegawai')

@section('content')

<div class="col-12">

    {{-- JUDUL HALAMAN --}}
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Halaman Pegawai</h2>
        <p class="text-muted mb-0">
            Kelola data pegawai perusahaan
        </p>
    </div>

    {{-- CARD DATA PEGAWAI --}}
    <div class="card border-0 shadow-sm">

        {{-- HEADER --}}
        <div class="card-header bg-white py-4 px-4
                    d-flex justify-content-between align-items-center">

            <div>
                <h4 class="mb-1 fw-bold">Data Pegawai</h4>
                <p class="text-muted mb-0">
                    Daftar seluruh data pegawai
                </p>
            </div>

            <a href="{{ route('pegawai.create') }}"
               class="btn btn-primary">
                <i class="ti ti-plus me-1"></i>
                Tambah Data
            </a>

        </div>

        {{-- BODY --}}
        <div class="card-body px-4">

            <div class="table-responsive">

                <table class="table table-hover align-middle"
                       id="table">

                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Pegawai</th>
                            <th>Bagian</th>
                            <th>Email</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th width="120" class="text-center">
                                Opsi
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($pegawai as $index => $data)

                        <tr>

                            {{-- NO --}}
                            <td>
                                {{ $index + 1 }}
                            </td>

                            {{-- NAMA --}}
                            <td>
                                <span class="fw-semibold">
                                    {{ $data->nama_pegawai }}
                                </span>
                            </td>

                            {{-- BAGIAN --}}
                            <td>
                                {{ $data->bagian->nama_bagian ?? '-' }}
                            </td>

                            {{-- EMAIL --}}
                            <td>
                                {{ $data->user->email ?? '-' }}
                            </td>

                            {{-- NIK --}}
                            <td>
                                {{ $data->nik }}
                            </td>

                            {{-- JENIS KELAMIN --}}
                            <td>
                                {{ $data->jenis_kelamin }}
                            </td>

                            {{-- UMUR --}}
                            <td>
                                {{ $data->umur }} Tahun
                            </td>

                            {{-- TEMPAT & TANGGAL LAHIR --}}
                            <td>
                                {{ $data->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d-m-Y') }}
                            </td>

                            {{-- ALAMAT --}}
                            <td>
                                {{ $data->alamat }}
                            </td>

                            {{-- FOTO --}}
                            <td>
                                @if ($data->foto)

                                    <a href="{{ asset('storage/foto_pegawai/' . $data->foto) }}"
                                       target="_blank"
                                       class="btn btn-light btn-sm">

                                        <i class="ti ti-photo me-1"></i>
                                        Lihat

                                    </a>

                                @else

                                    <span class="text-muted">
                                        Tidak ada
                                    </span>

                                @endif
                            </td>

                            {{-- OPSI --}}
                            <td class="text-center">

                                <div class="dropdown">

                                    <button
                                        class="btn btn-primary btn-sm dropdown-toggle"
                                        type="button"
                                        data-bs-toggle="dropdown">

                                        <i class="ti ti-settings me-1"></i>
                                        Aksi

                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">

                                        {{-- DETAIL --}}
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{ route('pegawai.show', $data->id) }}">

                                                <i class="ti ti-eye me-2"></i>
                                                Detail

                                            </a>
                                        </li>

                                        {{-- EDIT --}}
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{ route('pegawai.edit', $data->id) }}">

                                                <i class="ti ti-edit me-2"></i>
                                                Edit

                                            </a>
                                        </li>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        {{-- HAPUS --}}
                                        <li>
                                            <form
                                                action="{{ route('pegawai.destroy', $data->id) }}"
                                                method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="dropdown-item text-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data pegawai ini?')">

                                                    <i class="ti ti-trash me-2"></i>
                                                    Hapus

                                                </button>

                                            </form>
                                        </li>

                                    </ul>

                                </div>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="11"
                                class="text-center py-4">

                                <i class="ti ti-users-off fs-2 text-muted"></i>

                                <p class="text-muted mb-0 mt-2">
                                    Belum ada data pegawai.
                                </p>

                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection