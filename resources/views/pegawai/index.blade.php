@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3"><strong>Data Pegawai</strong></h1>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0">Daftar Pegawai</h5>
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPegawai">
      <i class="fa-solid fa-user-plus me-1"></i> Tambah Pegawai
    </button>
  </div>

  <div class="card-body">
    <!-- Form Pencarian -->
    <form method="GET" action="{{ route('pegawai.index') }}" class="mb-3">
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Cari nama atau NIP..." value="{{ request('search') }}">
        <button class="btn btn-outline-secondary" type="submit"><i class="fa-solid fa-search"></i></button>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead class="table-success">
          <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama Pegawai</th>
            <th>Jabatan</th>
            <th>Jenis Kelamin</th>
            <th>No HP</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($pegawai as $p)
            <tr>
              <td>{{ $loop->iteration }}</td>
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
              <td class="text-center">
                <button class="btn btn-warning btn-sm btnEdit" 
                        data-id="{{ $p->id_pegawai }}"
                        data-nip="{{ $p->nip }}"
                        data-nama="{{ $p->nama_pegawai }}"
                        data-jabatan="{{ $p->jabatan }}"
                        data-jk="{{ $p->jenis_kelamin }}"
                        data-nohp="{{ $p->no_hp }}"
                        data-status="{{ $p->status }}"
                        data-bs-toggle="modal" data-bs-target="#modalPegawai">
                  <i class="fa-solid fa-pen-to-square"></i>
                </button>

                <form action="{{ route('pegawai.destroy', $p->id_pegawai) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus pegawai ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center">Tidak ada data pegawai</td>
            </tr>
          @endforelse
        </tbody>
      </table>

      <!-- Modal Tambah/Edit Pegawai -->
      <div class="modal fade" id="modalPegawai" tabindex="-1" aria-labelledby="modalPegawaiLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-success text-white">
              <h5 class="modal-title" id="modalPegawaiLabel">Tambah Data Pegawai</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="formPegawai" action="{{ route('pegawai.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">NIP</label>
                    <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP">

                    <label class="form-label mt-2">Nama Pegawai</label>
                    <input type="text" name="nama_pegawai" class="form-control" required>

                    <label class="form-label mt-2">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                      <option value="">-- Pilih --</option>
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                  </div>

                  <div class="col-md-6">
                    <label class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" placeholder="Masukkan jabatan">

                    <label class="form-label mt-2">No HP</label>
                    <input type="text" name="no_hp" class="form-control" placeholder="Masukkan nomor HP">

                    <label class="form-label mt-2">Status</label>
                    <select name="status" class="form-select">
                      <option value="Aktif">Aktif</option>
                      <option value="Nonaktif">Nonaktif</option>
                    </select>
                  </div>
                </div>
                <div class="mt-3 text-end">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-success"><i class="fa-solid fa-save me-1"></i> Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="mt-3">
      {{ $pegawai->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('modalPegawai');
  const form = document.getElementById('formPegawai');
  const title = document.getElementById('modalPegawaiLabel');

  modal.addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;

    if (btn.classList.contains('btnEdit')) {
      title.textContent = 'Edit Data Pegawai';
      form.action = '/pegawai/' + btn.dataset.id;
      if (!form.querySelector('input[name="_method"]')) {
        form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT">');
      }

      form.nip.value = btn.dataset.nip;
      form.nama_pegawai.value = btn.dataset.nama;
      form.jabatan.value = btn.dataset.jabatan;
      form.jenis_kelamin.value = btn.dataset.jk;
      form.no_hp.value = btn.dataset.nohp;
      form.status.value = btn.dataset.status;

    } else {
      title.textContent = 'Tambah Data Pegawai';
      form.action = '{{ route('pegawai.store') }}';
      const method = form.querySelector('input[name="_method"]');
      if (method) method.remove();
      form.reset();
    }
  });
});
</script>
@endsection
