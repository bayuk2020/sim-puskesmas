@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3"><strong>Data Pasien</strong></h1>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0">Daftar Pasien</h5>
    <div>
        <a href="{{ route('pasien.create') }}" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-user-plus me-1"></i> Tambah Pasien
        </a>
        <a href="{{ route('pasien.export') }}" class="btn btn-success btn-sm">
            <i class="fa-solid fa-file-excel me-1"></i> Export Excel
        </a>
    </div>
  </div>

  <div class="card-body">
    <form method="GET" action="{{ route('pasien.index') }}" class="mb-3">
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Cari nama, NIK, atau No RM..." value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit"><i class="fa-solid fa-search"></i></button>
      </div>
    </form>

    <form method="GET" class="row g-2 mb-3">
  <div class="col-md-3">
    <select name="jk" class="form-select">
      <option value="">Semua Jenis Kelamin</option>
      <option value="L" {{ request('jk') == 'L' ? 'selected' : '' }}>Laki-laki</option>
      <option value="P" {{ request('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
    </select>
  </div>
  <div class="col-md-3">
    <input type="text" name="pekerjaan" class="form-control" placeholder="Cari pekerjaan..." value="{{ request('pekerjaan') }}">
  </div>
  <div class="col-md-2">
    <button class="btn btn-primary w-100"><i class="fa fa-filter me-1"></i> Filter</button>
  </div>
</form>


    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead class="table-primary">
          <tr>
            <th>No</th>
            <th>No RM</th>
            <th>NIK</th>
            <th>Nama Pasien</th>
            <th>JK</th>
            <th>Umur</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($pasiens as $index => $p)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $p->no_rm }}</td>
              <td>{{ $p->nik }}</td>
              <td>{{ $p->nama_pasien }}</td>
              <td>{{ $p->jenis_kelamin }}</td>
              <td>
                @php
                  $umur = \Carbon\Carbon::parse($p->tanggal_lahir)->age ?? '-';
                @endphp
                {{ $umur }} th
              </td>
              <td>{{ Str::limit($p->alamat, 30) }}</td>
              <td>{{ $p->no_hp }}</td>
              <td class="text-center">
                <a href="{{ route('pasien.show', $p->id_pasien) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></a>
                <a href="{{ route('pasien.edit', $p->id_pasien) }}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                <form action="{{ route('pasien.destroy', $p->id_pasien) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus pasien ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="text-center">Tidak ada data pasien</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-3">
      {{ $pasiens->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
@endsection
