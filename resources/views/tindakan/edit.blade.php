@extends('layouts.app')

@section('content')
<h1>Edit Tindakan</h1>
<form action="{{ route('tindakan.update', $tindakan->id_tindakan) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Nama Tindakan</label>
        <input type="text" name="nama_tindakan" value="{{ $tindakan->nama_tindakan }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Biaya (Rp)</label>
        <input type="number" name="biaya" value="{{ $tindakan->biaya }}" class="form-control" required min="0">
    </div>
    <div class="mb-3">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control">{{ $tindakan->keterangan }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('tindakan.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
