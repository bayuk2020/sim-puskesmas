@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Data Poli</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            
            <form action="{{ route('poli.update', $poli->id_poli) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Kode Poli</label>
                    <input 
                        type="text" 
                        name="kode_poli" 
                        class="form-control @error('kode_poli') is-invalid @enderror"
                        value="{{ old('kode_poli', $poli->kode_poli) }}"
                        required
                    >
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
                        value="{{ old('nama_poli', $poli->nama_poli) }}"
                        required
                    >
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
                    >{{ old('keterangan', $poli->keterangan) }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Perbarui</button>
                <a href="{{ route('poli.index') }}" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>
</div>
@endsection
