@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Data Poli</h4>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('poli.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama Poli</label>
                    <input type="text" name="nama_poli" class="form-control" required placeholder="Masukkan nama poli">
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Tuliskan keterangan (opsional)"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('poli.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
