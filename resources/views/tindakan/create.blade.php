@extends('layouts.app')

@section('content')
<h1>Tambah Tindakan</h1>
<form action="{{ route('tindakan.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Tindakan</label>
        <input type="text" name="nama_tindakan" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Biaya (Rp)</label>
        <input type="number" name="biaya" class="form-control" required min="0">
    </div>
    <div class="mb-3">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('tindakan.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
