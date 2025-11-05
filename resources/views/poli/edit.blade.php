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
                    <label>Nama Poli</label>
                    <input type="text" name="nama_poli" class="form-control" value="{{ $poli->nama_poli }}" required>
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3">{{ $poli->keterangan }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Perbarui</button>
                <a href="{{ route('poli.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
