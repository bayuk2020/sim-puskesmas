@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Poli</h4>
        <a href="{{ route('poli.create') }}" class="btn btn-success">+ Tambah Poli</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Nama Poli</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($poli as $p)
                        <tr>
                            <td>{{ $p->id_poli }}</td>
                            <td>{{ $p->nama_poli }}</td>
                            <td>{{ $p->keterangan ?? '-' }}</td>
                            <td>
                                <a href="{{ route('poli.edit', $p->id_poli) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('poli.destroy', $p->id_poli) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus data ini?')" class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
