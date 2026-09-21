@extends('layouts.mantis')

@section('content')
<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Form Data Pegawai</h4>
            <div>
                <a href="{{ route('pegawai.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group mb-3">
                    <label for="nama_pegawai" class="form-label">Nama Pegawai</label>
                    <input type="text" name="nama_pegawai" id="nama_pegawai" 
                        class="form-control @error('nama_pegawai') is-invalid @enderror" 
                        value="{{ old('nama_pegawai') }}" autofocus>
                    @error('nama_pegawai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="from-group my-2">
                    <label for="bagian_id">Bagian pegawai</label>
                    <select name="bagian_id" id="bagian_id" class="form-control @error('bagian_id')
                    is-invalid
                    @enderror">
                        <option value="">Pilih Bagian</option>
                        @foreach ($bagians as $bagian)
                        <option value="{{ $bagian->id }}" {{ old('bagian_id') == $bagian->id ? 'selected' : ''}}>
                        {{ $bagian->nama_bagian }}</option>
                        @endforeach
                    </select>
                    @error('bagian_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        value="{{ old('email') }}" autocomplete="off">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" name="nik" id="nik" 
                        class="form-control @error('nik') is-invalid @enderror" 
                        value="{{ old('nik') }}">
                    @error('nik')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="umur" class="form-label">Umur</label>
                    <input type="number" name="umur" id="umur" 
                        class="form-control @error('umur') is-invalid @enderror" 
                        value="{{ old('umur') }}">
                    @error('umur')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" 
                        class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                        value="{{ old('tanggal_lahir') }}">
                    @error('tanggal_lahir')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" 
                        class="form-control @error('tempat_lahir') is-invalid @enderror" 
                        value="{{ old('tempat_lahir') }}">
                    @error('tempat_lahir')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

               <div class="form-group my-2">
                <label for="foto">Foto Pegawai</label>
                <input type="file" name="foto" id="foto" 
                    class="form-control @error('foto')
                    is-invalid
                @enderror">
                @error('foto')
                <small class="text-danger">{{ $message }}</small>
                @enderror
               </div>

                <div class="form-group mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" 
                        class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                   <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection