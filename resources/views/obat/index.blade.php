@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Data Obat</h4>
    <a href="{{ route('obat.create') }}" class="btn btn-primary mb-3">+ Tambah Obat</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama Obat</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Kadaluwarsa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($obat as $o)
                <tr>
                    <td>{{ $o->kode_obat }}</td>
                    <td>{{ $o->nama_obat }}</td>
                    <td>{{ $o->satuan }}</td>
                    <td>{{ $o->stok }}</td>
                    <td>{{ number_format($o->harga_beli, 0, ',', '.') }}</td>
                    <td>{{ number_format($o->harga_jual, 0, ',', '.') }}</td>
                    <td>{{ $o->kadaluwarsa }}</td>
                    <td>
                        <a href="{{ route('obat.edit', $o->id_obat) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('obat.destroy', $o->id_obat) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin ingin hapus?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
