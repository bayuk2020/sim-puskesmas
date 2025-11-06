@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Tindakan</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTindakan" id="btnTambah">
            + Tambah Tindakan
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Tindakan</th>
                        <th>Biaya (Rp)</th>
                        <th>Keterangan</th>
                        <th width="160px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tindakan as $i => $t)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $t->nama_tindakan }}</td>
                            <td>{{ number_format($t->biaya, 0, ',', '.') }}</td>
                            <td>{{ $t->keterangan ?? '-' }}</td>
                            <td>
                                <button 
                                    class="btn btn-sm btn-warning btnEdit"
                                    data-id="{{ $t->id_tindakan }}"
                                    data-nama="{{ $t->nama_tindakan }}"
                                    data-biaya="{{ $t->biaya }}"
                                    data-keterangan="{{ $t->keterangan }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalTindakan">
                                    Edit
                                </button>

                                <form action="{{ route('tindakan.destroy', $t->id_tindakan) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus {{ $t->nama_tindakan }}?')">
                                        Hapus
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

{{-- Modal Dinamis Tambah/Edit --}}
<div class="modal fade" id="modalTindakan" tabindex="-1">
    <div class="modal-dialog">
        <form id="formTindakan" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="modalTindakanLabel">Tambah Tindakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Tindakan</label>
                        <input type="text" name="nama_tindakan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Biaya (Rp)</label>
                        <input type="number" name="biaya" class="form-control" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnSubmit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Script Modal Dinamis --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalTindakan');
    const form = document.getElementById('formTindakan');
    const title = document.getElementById('modalTindakanLabel');
    const btnSubmit = document.getElementById('btnSubmit');

    modal.addEventListener('show.bs.modal', function (e) {
        const btn = e.relatedTarget;

        // Mode Edit
        if (btn.classList.contains('btnEdit')) {
            title.textContent = 'Edit Tindakan';
            btnSubmit.textContent = 'Simpan Perubahan';
            form.action = '/tindakan/' + btn.dataset.id;

            // Tambahkan _method PUT jika belum ada
            if (!form.querySelector('input[name="_method"]')) {
                form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT">');
            }

            // Isi data ke form
            form.nama_tindakan.value = btn.dataset.nama;
            form.biaya.value = btn.dataset.biaya;
            form.keterangan.value = btn.dataset.keterangan || '';
        } 
        // Mode Tambah
        else {
            title.textContent = 'Tambah Tindakan';
            btnSubmit.textContent = 'Simpan';
            form.action = '{{ route('tindakan.store') }}';
            form.querySelector('input[name="_method"]')?.remove();
            form.reset();
        }
    });
});
</script>
@endsection
