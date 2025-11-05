@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Daftar Pegawai Nonaktif</h4>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-danger">
                    <tr>
                        <th>ID</th>
                        <th>Nama Pegawai</th>
                        <th>Jabatan</th>
                        <th>Jenis Kelamin</th>
                        <th>No HP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pegawai as $p)
                        <tr>
                            <td>{{ $p->id_pegawai }}</td>
                            <td>{{ $p->nama_pegawai }}</td>
                            <td>{{ $p->jabatan }}</td>
                            <td>{{ $p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $p->no_hp }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
