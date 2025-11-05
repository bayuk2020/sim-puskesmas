@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3"><strong>Edit Data Pasien</strong></h1>

<div class="card">
  <div class="card-body">
    <form action="{{ route('pasien.update', $pasien->id_pasien) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="row g-3">
        {{-- Kolom kiri --}}
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">No RM</label>
            <input type="text" class="form-control" value="{{ $pasien->no_rm }}" disabled>
          </div>

          <div class="mb-3">
            <label class="form-label">NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ old('nik', $pasien->nik) }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Nama Pasien</label>
            <input type="text" name="nama_pasien" class="form-control" value="{{ old('nama_pasien', $pasien->nama_pasien) }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select">
              <option value="L" {{ $pasien->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
              <option value="P" {{ $pasien->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ $pasien->tanggal_lahir }}">
          </div>
        </div>

        {{-- Kolom kanan --}}
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3">{{ $pasien->alamat }}</textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $pasien->no_hp }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" value="{{ $pasien->pekerjaan }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Status Perkawinan</label>
            <select name="status_perkawinan" class="form-select">
              <option value="">-- Pilih --</option>
              <option value="Belum Kawin" {{ $pasien->status_perkawinan == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
              <option value="Kawin" {{ $pasien->status_perkawinan == 'Kawin' ? 'selected' : '' }}>Kawin</option>
              <option value="Cerai Hidup" {{ $pasien->status_perkawinan == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
              <option value="Cerai Mati" {{ $pasien->status_perkawinan == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
            </select>
          </div>
        </div>
      </div>

      <div class="mt-3 text-end">
        <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-warning">
          <i class="fa-solid fa-save me-1"></i> Perbarui
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('input[name="nik"], input[name="no_hp"]').forEach(input => {
  input.addEventListener('keypress', function(e) {
    if (!/[0-9]/.test(e.key)) e.preventDefault();
  });
});
</script>
@endpush