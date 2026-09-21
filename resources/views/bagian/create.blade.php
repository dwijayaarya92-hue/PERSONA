@extends('layouts.mantis')

@section('content')
<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Form Data Bagian</h4>
            <div>
                <a href="{{ route('bagian.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('bagian.store') }}" method="POST">
                @csrf
                
                <div class="form-group mb-3">
                    <label for="nama_bagian" class="form-label">Nama Bagian</label>
                    <input type="text" name="nama_bagian" id="nama_bagian" 
                        class="form-control @error('nama_bagian') is-invalid @enderror" 
                        value="{{ old('nama_bagian') }}" autofocus>
                    @error('nama_bagian')
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