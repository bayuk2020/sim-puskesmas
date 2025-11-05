@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Data Pegawai</h4>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pegawai.update', $pegawai->id_pegawai) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>NIP</label>
                    <input type="text" name="nip" class="form-control" value="{{ $pegawai->nip }}">
                </div>

                <div class="mb-3">
                    <label>Nama Pegawai</label>
                    <input type="text" name="nama_pegawai" class="form-control" value="{{ $pegawai->nama_pegawai }}" required>
                </div>

                <div class="mb-3">
                    <label>Jabatan</label>
                    <select name="jabatan" class="form-select">
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach(['Admin','Loket','Dokter Umum','Dokter Gigi','Farmasi','KIA','Laboran','Perawat','Bidan','Kasir'] as $jab)
                            <option value="{{ $jab }}" {{ $pegawai->jabatan == $jab ? 'selected' : '' }}>{{ $jab }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select">
                        <option value="L" {{ $pegawai->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $pegawai->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control">{{ $pegawai->alamat }}</textarea>
                </div>

                <div class="mb-3">
                    <label>No. HP</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ $pegawai->no_hp }}">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="Aktif" {{ $pegawai->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Nonaktif" {{ $pegawai->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Perbarui</button>
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
