@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Pegawai Baru</h4>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pegawai.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>NIP</label>
                    <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP (opsional)">
                </div>

                <div class="mb-3">
                    <label>Nama Pegawai</label>
                    <input type="text" name="nama_pegawai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Jabatan</label>
                    <select name="jabatan" class="form-select">
                        <option value="">-- Pilih Jabatan --</option>
                        <option>Admin</option>
                        <option>Loket</option>
                        <option>Dokter Umum</option>
                        <option>Dokter Gigi</option>
                        <option>Farmasi</option>
                        <option>KIA</option>
                        <option>Laboran</option>
                        <option>Perawat</option>
                        <option>Bidan</option>
                        <option>Kasir</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2"></textarea>
                </div>

                <div class="mb-3">
                    <label>No. HP</label>
                    <input type="text" name="no_hp" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
