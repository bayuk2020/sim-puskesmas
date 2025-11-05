@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3"><strong>Tambah Data Pasien</strong></h1>

<div class="card">
  <div class="card-body">
    <form action="{{ route('pasien.store') }}" method="POST">
      @csrf

      <div class="row g-3">
        {{-- Kolom kiri --}}
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">NIK</label>
            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                   value="{{ old('nik') }}" placeholder="Masukkan NIK pasien">
            @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Nama Pasien</label>
            <input type="text" name="nama_pasien" class="form-control @error('nama_pasien') is-invalid @enderror"
                   value="{{ old('nama_pasien') }}" placeholder="Masukkan nama lengkap pasien">
            @error('nama_pasien')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
              <option value="">-- Pilih --</option>
              <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
              <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
          </div>
        </div>

        {{-- Kolom kanan --}}
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan') }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Status Perkawinan</label>
            <select name="status_perkawinan" class="form-select">
              <option value="">-- Pilih --</option>
              <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
              <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
              <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
              <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
            </select>
          </div>
        </div>
      </div>

      <div class="mt-3 text-end">
        <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">
          <i class="fa-solid fa-save me-1"></i> Simpan Data
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