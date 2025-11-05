@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Pegawai</h4>
        <a href="{{ route('pegawai.create') }}" class="btn btn-success">+ Tambah Pegawai</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Jenis Kelamin</th>
                        <th>No. HP</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pegawai as $p)
                        <tr>
                            <td>{{ $p->id_pegawai }}</td>
                            <td>{{ $p->nip ?? '-' }}</td>
                            <td>{{ $p->nama_pegawai }}</td>
                            <td>{{ $p->jabatan ?? '-' }}</td>
                            <td>{{ $p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $p->no_hp ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $p->status == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('pegawai.edit', $p->id_pegawai) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('pegawai.destroy', $p->id_pegawai) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus data?')" class="btn btn-sm btn-danger">Hapus</button>
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
