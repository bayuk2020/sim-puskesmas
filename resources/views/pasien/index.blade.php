@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3"><strong>Data Pasien</strong></h1>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0">Daftar Pasien</h5>
    <div>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPasien">
          <i class="fa-solid fa-user-plus me-1"></i> Tambah Pasien
        </button>

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
                <button class="btn btn-warning btn-sm btnEdit" 
                        data-id="{{ $p->id_pasien }}" 
                        data-nama="{{ $p->nama_pasien }}" 
                        data-nik="{{ $p->nik }}" 
                        data-jk="{{ $p->jenis_kelamin }}" 
                        data-tanggallahir="{{ $p->tanggal_lahir }}" 
                        data-alamat="{{ $p->alamat }}" 
                        data-nohp="{{ $p->no_hp }}" 
                        data-bs-toggle="modal" data-bs-target="#modalPasien">
                  <i class="fa-solid fa-pen-to-square"></i>
                </button>


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
      <!-- Modal Tambah/Edit Pasien -->
      <div class="modal fade" id="modalPasien" tabindex="-1" aria-labelledby="modalPasienLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="modalPasienLabel">Tambah Data Pasien</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="formPasien" action="{{ route('pasien.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">NIK</label>
                    <input type="text" name="nik" class="form-control" required>

                    <label class="form-label mt-2">Nama Pasien</label>
                    <input type="text" name="nama_pasien" class="form-control" required>

                    <label class="form-label mt-2">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                      <option value="">-- Pilih --</option>
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                    </select>

                    <label class="form-label mt-2">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control">
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3"></textarea>

                    <label class="form-label mt-2">No HP</label>
                    <input type="text" name="no_hp" class="form-control">

                    <label class="form-label mt-2">Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control">
                  </div>
                </div>
                <div class="mt-3 text-end">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-1"></i> Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="mt-3">
      {{ $pasiens->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('modalPasien');
  const form = document.getElementById('formPasien');
  const title = document.getElementById('modalPasienLabel');

  modal.addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    if (btn.classList.contains('btnEdit')) {
      title.textContent = 'Edit Data Pasien';
      form.action = '/pasien/' + btn.dataset.id;
      form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT">');
      
      form.nik.value = btn.dataset.nik;
      form.nama_pasien.value = btn.dataset.nama;
      form.jenis_kelamin.value = btn.dataset.jk;
      form.alamat.value = btn.dataset.alamat;
      form.no_hp.value = btn.dataset.nohp;

      // ✅ Tambahkan ini
      if (btn.dataset.tanggallahir) {
        form.tanggal_lahir.value = btn.dataset.tanggallahir;
      } else {
        form.tanggal_lahir.value = '';
      }

    } else {
      title.textContent = 'Tambah Data Pasien';
      form.action = '{{ route('pasien.store') }}';
      const method = form.querySelector('input[name="_method"]');
      if (method) method.remove();
      form.reset();
    }
  });
});
</script>


@endsection
