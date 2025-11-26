@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"><strong>Data Poli</strong></h4>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalPoli">
            <i class="fa-solid fa-plus me-1"></i> Tambah Poli
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-success">
                    <tr>
                        <th width="70">ID</th>
                        <th width="120">Kode</th>
                        <th>Nama Poli</th>
                        <th>Keterangan</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($poli as $p)
                    <tr>
                        <td>{{ $p->id_poli }}</td>
                        <td>{{ $p->kode_poli }}</td>
                        <td>{{ $p->nama_poli }}</td>
                        <td>{{ $p->keterangan ?? '-' }}</td>

                        <td class="text-center">

                            {{-- Tombol Edit --}}
                            <button class="btn btn-warning btn-sm btnEdit"
                                data-id="{{ $p->id_poli }}"
                                data-kode="{{ $p->kode_poli }}"
                                data-nama="{{ $p->nama_poli }}"
                                data-ket="{{ $p->keterangan }}"
                                data-bs-toggle="modal"
                                data-bs-target="#modalPoli">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>

                            {{-- Tombol Hapus --}}
                            <form action="{{ url('poli/'.$p->id_poli) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus poli ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>

{{-- MODAL TAMBAH + EDIT --}}
<div class="modal fade" id="modalPoli" tabindex="-1">
    <div class="modal-dialog">
        <form id="formPoli" method="POST" action="{{ route('poli.store') }}">
            @csrf
            <div class="modal-content">

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalTitle">Tambah Poli</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Kode Poli</label>
                        <input type="text" name="kode_poli" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Poli</label>
                        <input type="text" name="nama_poli" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit">
                        <i class="fa-solid fa-save me-1"></i> Simpan
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('modalPoli');
    const form = document.getElementById('formPoli');
    const title = document.getElementById('modalTitle');

    modal.addEventListener('show.bs.modal', function (e) {
        const btn = e.relatedTarget;

        // MODE EDIT
        if (btn.classList.contains('btnEdit')) {
            title.textContent = "Edit Poli";
            form.action = "/poli/" + btn.dataset.id;

            if (!form.querySelector('input[name=\"_method\"]')) {
                form.insertAdjacentHTML('beforeend',
                    '<input type=\"hidden\" name=\"_method\" value=\"PUT\">'
                );
            }

            form.querySelector('input[name=\"kode_poli\"]').value = btn.dataset.kode;
            form.querySelector('input[name=\"nama_poli\"]').value = btn.dataset.nama;
            form.querySelector('textarea[name=\"keterangan\"]').value = btn.dataset.ket;

        } 
        // MODE TAMBAH
        else {
            title.textContent = "Tambah Poli";
            form.action = "{{ route('poli.store') }}";

            let method = form.querySelector('input[name=\"_method\"]');
            if (method) method.remove();

            form.reset();
        }
    });
});
</script>
@endpush
