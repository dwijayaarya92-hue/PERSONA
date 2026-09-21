@extends('layouts.mantis')

@section('content')
<div class="pc-content">
  <!-- [ Page Header ] start -->
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title">
            <h2 class="mb-0">Detail Bagian</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Page Header ] end -->

  <!-- [ Main Content ] start -->
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4 class="card-title mb-0">Data Bagian: {{ $bagian->nama_bagian }}</h4>
          
          <!-- Tombol Kembali -->
          <a href="{{ route('bagian.index') }}" class="btn btn-secondary btn-sm">
            <i class="ti ti-arrow-left"></i> Kembali
          </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead>
                <tr>
                  <th style="width: 5%;">No</th>
                  <th>Nama Pegawai</th>
                  <th>Email</th>
                  <th>Jenis Kelamin</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($bagian->pegawai as $index => $item)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $item->nama_pegawai }}</td>          
                  <td>{{ $item->user?->email }}</td>
                  <td>{{ $item->jenis_kelamin }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="text-center text-muted py-4">
                    Belum ada pegawai yang terdaftar pada bagian ini.
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
</div>
@endsection