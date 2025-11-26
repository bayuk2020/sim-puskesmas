@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"><strong>Data Obat</strong></h4>

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalObat" id="btnTambah">
            <i class="fa-solid fa-capsules me-1"></i> Tambah Obat
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>Kode</th>
                            <th>Nama Obat</th>
                            <th>Satuan</th>
                            <th>Stok</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Kadaluwarsa</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($obat as $o)
                        <tr>
                            <td>{{ $o->kode_obat }}</td>
                            <td>{{ $o->nama_obat }}</td>
                            <td>{{ $o->satuan }}</td>
                            <td>{{ $o->stok }}</td>

                            <td>Rp{{ number_format($o->harga_beli, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($o->harga_jual, 0, ',', '.') }}</td>

                            <td>{{ $o->kadaluwarsa }}</td>

                            <td class="text-center">

                                {{-- Tombol Edit --}}
                                <button class="btn btn-warning btn-sm btnEdit"
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
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('obat.destroy', $o->id_obat) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus {{ $o->nama_obat }}?')">

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

</div>


{{-- MODAL TAMBAH / EDIT --}}
<div class="modal fade" id="modalObat" tabindex="-1">
    <div class="modal-dialog modal-lg">

        <form id="formObat" method="POST">
            @csrf

            <div class="modal-content">

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="modalObatLabel">Tambah Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Kode Obat</label>
                            <input type="text" name="kode_obat" class="form-control" required>

                            <label class="form-label mt-2">Nama Obat</label>
                            <input type="text" name="nama_obat" class="form-control" required>

                            <label class="form-label mt-2">Satuan</label>
                            <input type="text" name="satuan" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" required>

                            <label class="form-label mt-2">Harga Beli</label>
                            <input type="number" name="harga_beli" class="form-control" required>

                            <label class="form-label mt-2">Harga Jual</label>
                            <input type="number" name="harga_jual" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label mt-2">Kadaluwarsa</label>
                            <input type="date" name="kadaluwarsa" class="form-control">

                            <label class="form-label mt-2">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="2"></textarea>
                        </div>

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


{{-- SCRIPT EDIT --}}
<script>
document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('modalObat');
    const form = document.getElementById('formObat');
    const title = document.getElementById('modalObatLabel');

    modal.addEventListener('show.bs.modal', e => {
        const btn = e.relatedTarget;

        // MODE EDIT
        if (btn.classList.contains('btnEdit')) {

            title.textContent = "Edit Obat";
            form.action = "/obat/" + btn.dataset.id;

            if (!form.querySelector('input[name="_method"]')) {
                form.insertAdjacentHTML("beforeend", 
                    `<input type="hidden" name="_method" value="PUT">`
                );
            }

            form.kode_obat.value = btn.dataset.kode;
            form.nama_obat.value = btn.dataset.nama;
            form.satuan.value = btn.dataset.satuan;
            form.stok.value = btn.dataset.stok;
            form.harga_beli.value = btn.dataset.hargabeli;
            form.harga_jual.value = btn.dataset.hargajual;
            form.kadaluwarsa.value = btn.dataset.kadaluwarsa;
            form.keterangan.value = btn.dataset.keterangan;

        } else {
            // MODE TAMBAH
            title.textContent = "Tambah Obat";
            form.action = "{{ route('obat.store') }}";

            let method = form.querySelector('input[name="_method"]');
            if (method) method.remove();

            form.reset();
        }
    });

});
</script>

@endsection
