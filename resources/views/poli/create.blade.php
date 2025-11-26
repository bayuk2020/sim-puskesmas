@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Data Poli</h4>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('poli.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Kode Poli</label>
                    <input 
                        type="text" 
                        name="kode_poli" 
                        class="form-control @error('kode_poli') is-invalid @enderror" 
                        value="{{ old('kode_poli') }}"
                        required 
                        placeholder="Masukkan kode poli">
                    @error('kode_poli')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Poli</label>
                    <input 
                        type="text" 
                        name="nama_poli" 
                        class="form-control @error('nama_poli') is-invalid @enderror"
                        value="{{ old('nama_poli') }}"
                        required 
                        placeholder="Masukkan nama poli">
                    @error('nama_poli')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea 
                        name="keterangan" 
                        class="form-control @error('keterangan') is-invalid @enderror"
                        rows="3"
                        placeholder="Tuliskan keterangan (opsional)">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('poli.index') }}" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>
</div>
@endsection
