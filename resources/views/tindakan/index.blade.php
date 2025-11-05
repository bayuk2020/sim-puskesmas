@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1>Data Tindakan</h1>
    <a href="{{ route('tindakan.create') }}" class="btn btn-primary">+ Tambah Tindakan</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Nama Tindakan</th>
            <th>Biaya (Rp)</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tindakan as $i => $t)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $t->nama_tindakan }}</td>
            <td>{{ number_format($t->biaya, 0, ',', '.') }}</td>
            <td>{{ $t->keterangan }}</td>
            <td>
                <a href="{{ route('tindakan.edit', $t->id_tindakan) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('tindakan.destroy', $t->id_tindakan) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
