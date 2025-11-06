@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Data Obat</h4>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalObat" id="btnTambah">+ Tambah Obat</button>

    @if (session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama Obat</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Kadaluwarsa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($obat as $o)
            <tr>
                <td>{{ $o->kode_obat }}</td>
                <td>{{ $o->nama_obat }}</td>
                <td>{{ $o->satuan }}</td>
                <td>{{ $o->stok }}</td>
                <td>Rp{{ number_format($o->harga_beli, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($o->harga_jual, 0, ',', '.') }}</td>
                <td>{{ $o->kadaluwarsa }}</td>
                <td>
                    <button 
                        class="btn btn-sm btn-warning btnEdit"
                        data-id="{{ $o->id_obat }}"
                        data-kode="{{ $o->kode_obat }}"
                        data-nama="{{ $o->nama_obat }}"
                        data-satuan="{{ $o->satuan }}"
                        data-stok="{{ $o->stok }}"
                        data-hargabeli="{{ $o->harga_beli }}"
                        data-hargajual="{{ $o->harga_jual }}"
                        data-kadaluwarsa="{{ $o->kadaluwarsa }}"
                        data-keterangan="{{ $o->keterangan }}"
                        data-bs-toggle="modal"
                        data-bs-target="#modalObat">
                        Edit
                    </button>

                    <form action="{{ route('obat.destroy', $o->id_obat) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus {{ $o->nama_obat }}?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Modal Dinamis Tambah/Edit --}}
<div class="modal fade" id="modalObat" tabindex="-1">
    <div class="modal-dialog">
        <form id="formObat" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="modalObatLabel">Tambah Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Kode Obat</label>
                        <input type="text" name="kode_obat" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Nama Obat</label>
                        <input type="text" name="nama_obat" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Satuan</label>
                        <input type="text" name="satuan" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Harga Beli</label>
                        <input type="number" step="0.01" name="harga_beli" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Harga Jual</label>
                        <input type="number" step="0.01" name="harga_jual" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Kadaluwarsa</label>
                        <input type="date" name="kadaluwarsa" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnSubmit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Script Modal Tambah/Edit --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalObat');
    const form = document.getElementById('formObat');
    const title = document.getElementById('modalObatLabel');
    const btnSubmit = document.getElementById('btnSubmit');
    const btnTambah = document.getElementById('btnTambah');

    modal.addEventListener('show.bs.modal', function (e) {
        const btn = e.relatedTarget;

        if (btn.classList.contains('btnEdit')) {
            title.textContent = 'Edit Data Obat';
            btnSubmit.textContent = 'Simpan Perubahan';
            form.action = '/obat/' + btn.dataset.id;
            form.querySelector('input[name="_method"]')?.remove();
            form.insertAdjacentHTML('beforeend', '<input type="hidden" name="_method" value="PUT">');

            form.kode_obat.value = btn.dataset.kode;
            form.nama_obat.value = btn.dataset.nama;
            form.satuan.value = btn.dataset.satuan;
            form.stok.value = btn.dataset.stok;
            form.harga_beli.value = btn.dataset.hargabeli;
            form.harga_jual.value = btn.dataset.hargajual;
            form.kadaluwarsa.value = btn.dataset.kadaluwarsa;
            form.keterangan.value = btn.dataset.keterangan || '';
        } else {
            title.textContent = 'Tambah Obat';
            btnSubmit.textContent = 'Simpan';
            form.action = '{{ route('obat.store') }}';
            form.querySelector('input[name="_method"]')?.remove();
            form.reset();
        }
    });
});
</script>
@endsection
