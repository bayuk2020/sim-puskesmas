@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Poli</h4>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalPoli">
      + Tambah Poli
    </button>
  </div>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card shadow-sm">
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead class="table-success">
          <tr>
            <th>ID</th>
            <th>Nama Poli</th>
            <th>Keterangan</th>
            <th width="160px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($poli as $p)
            <tr>
              <td>{{ $p->id_poli }}</td>
              <td>{{ $p->nama_poli }}</td>
              <td>{{ $p->keterangan ?? '-' }}</td>
              <td>
                <button class="btn btn-sm btn-warning btnEdit"
                        data-id="{{ $p->id_poli }}"
                        data-nama="{{ $p->nama_poli }}"
                        data-ket="{{ $p->keterangan ?? '' }}"
                        data-bs-toggle="modal" data-bs-target="#modalPoli">
                  Edit
                </button>

                <form action="{{ route('poli.destroy', $p->id_poli) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus data ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- Modal Tambah/Edit Poli --}}
<div class="modal fade" id="modalPoli" tabindex="-1">
  <div class="modal-dialog">
    <form id="formPoli" action="{{ route('poli.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-white" id="modalPoliLabel">Tambah Poli</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Nama Poli</label>
            <input type="text" name="nama_poli" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="2"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- JavaScript Modal Dinamis --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modal = document.getElementById('modalPoli');
  const form = document.getElementById('formPoli');
  const title = document.getElementById('modalPoliLabel');

  modal.addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;

    if (btn.classList.contains('btnEdit')) {
      title.textContent = 'Edit Data Poli';
      form.action = '/poli/' + btn.dataset.id;
      if (!form.querySelector('input[name="_method"]')) {
        form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT">');
      }

      form.nama_poli.value = btn.dataset.nama;
      form.keterangan.value = btn.dataset.ket;

    } else {
      title.textContent = 'Tambah Poli';
      form.action = '{{ route('poli.store') }}';
      const method = form.querySelector('input[name="_method"]');
      if (method) method.remove();
      form.reset();
    }
  });
});
</script>
@endsection
