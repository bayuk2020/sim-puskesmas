@extends('layouts.app')

@section('content')
<div class="container">

  {{-- Success / Error Messages --}}
  @if(session('success'))
    <div class="d-none" id="flash-success" data-message="{{ session('success') }}"></div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Ada kesalahan pada input:</strong>
      <ul class="mb-0">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Search Card --}}
  <div class="card mb-4">
    <div class="card-header">Pencarian Pasien</div>
    <div class="card-body">
      <form action="{{ route('visits.search') }}" method="get" class="row g-3">
        <div class="col-md-8">
          <input type="text" name="q" value="{{ old('q', $q ?? '') }}" class="form-control"
                 placeholder="Nama / No RM / NIK / Alamat">
        </div>
        <div class="col-md-4">
          <button class="btn btn-success">Cari</button>
          <a href="{{ route('visits.index') }}" class="btn btn-secondary">Reset</a>
        </div>
      </form>
    </div>
  </div>

  {{-- Results --}}
  @if(!empty($patients) && $patients->count())
    <div class="card mb-4">
      <div class="card-header">Hasil Pencarian ({{ $patients->count() }})</div>
      <div class="card-body p-0">
        <table class="table mb-0">
          <thead>
            <tr>
              <th>No</th>
              <th>No RM</th>
              <th>Nama</th>
              <th>NIK</th>
              <th>Tgl Lahir</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($patients as $i => $p)
              <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $p->no_rm ?? '-' }}</td>
                <td class="fw-bold">{{ $p->nama_pasien }}</td>
                <td>{{ $p->nik ?? '-' }}</td>
                <td>{{ optional($p->tanggal_lahir)->toDateString() ?? '-' }}</td>
                <td>{{ \Illuminate\Support\Str::limit($p->alamat, 40) }}</td>
                <td>
                  <!-- tombol buka modal, data-* akan dipakai JS untuk mengisi modal -->
                  <button type="button"
                          class="btn btn-success btn-sm btn-open-visit-modal"
                          data-id="{{ $p->id_pasien }}"
                          data-no_rm="{{ $p->no_rm }}"
                          data-nama="{{ $p->nama_pasien }}"
                          data-nik="{{ $p->nik }}"
                          data-alamat="{{ $p->alamat }}"
                          data-tgl_lahir="{{ optional($p->tanggal_lahir)->toDateString() }}">
                    Kunjungan
                  </button>

                  <a href="{{ route('patients.show', $p->id_pasien) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @elseif(isset($q))
    <div class="alert alert-info">Tidak ditemukan pasien dengan kata kunci: <strong>{{ $q }}</strong></div>
  @endif

</div>

{{-- Modal: Create Visit --}}
<div class="modal fade" id="modalVisit" tabindex="-1" aria-labelledby="modalVisitLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="formCreateVisit" action="{{ route('visits.store') }}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalVisitLabel">Catat Kunjungan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>

        <div class="modal-body">
          {{-- IDENTITAS PASIEN (horizontal) --}}
          <div class="mb-3 border rounded p-3">
            <div class="row">
              <div class="col-md-4"><strong>Nama</strong><div id="mv_nama"></div></div>
              <div class="col-md-3"><strong>No RM</strong><div id="mv_no_rm"></div></div>
              <div class="col-md-3"><strong>NIK</strong><div id="mv_nik"></div></div>
              <div class="col-md-2"><strong>Tgl Lahir</strong><div id="mv_tgl_lahir"></div></div>
            </div>
            <div class="row mt-2">
              <div class="col-12"><strong>Alamat</strong><div id="mv_alamat"></div></div>
            </div>
          </div>

          {{-- Hidden pasien_id --}}
          <input type="hidden" name="pasien_id" id="mv_pasien_id" value="{{ old('pasien_id') }}">

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Petugas</label>
              <select name="staff_id" id="mv_staff_id" class="form-control">
                <option value="">-- pilih petugas --</option>
                @foreach($staffs as $s)
                  <option value="{{ $s->id_pegawai }}" {{ old('staff_id') == $s->id_pegawai ? 'selected' : '' }}>
                    {{ $s->nama_pegawai }} ({{ $s->jabatan }})
                  </option>
                @endforeach
              </select>
              @error('staff_id') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
              <label class="form-label">Poli</label>
              <select name="poli_id" id="mv_poli_id" class="form-control">
                <option value="">-- pilih poli --</option>
                @foreach($polis as $pol)
                  <option value="{{ $pol->id_poli }}" {{ old('poli_id') == $pol->id_poli ? 'selected' : '' }}>
                    {{ $pol->nama_poli }}
                  </option>
                @endforeach
              </select>
              @error('poli_id') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
              <label class="form-label">Status Kunjungan</label>
              <select name="status" id="mv_status" class="form-control">
                <option value="menunggu" {{ old('status')=='menunggu' ? 'selected' : '' }}>menunggu</option>
                <option value="in_consult" {{ old('status')=='in_consult' ? 'selected' : '' }}>diperiksa</option>
                <option value="selesai" {{ old('status')=='selesai' ? 'selected' : '' }}>selesai</option>
                <option value="batal" {{ old('status')=='batal' ? 'selected' : '' }}>batal</option>
              </select>
              @error('status') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
              <label class="form-label">Tanggal Kunjungan</label>
              <input type="date" name="visit_date" id="mv_visit_date" class="form-control"
                     value="{{ old('visit_date', now()->toDateString()) }}">
              @error('visit_date') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Catat Kunjungan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<!-- Pastikan AdminKit/Bootstrap & Notyf sudah disertakan di layout -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Notyf success
  const flash = document.getElementById('flash-success');
  if (flash) {
    const msg = flash.dataset.message || '';
    if (msg) {
      // Notyf instance (AdminKit biasanya sudah include Notyf)
      try { new Notyf().success(msg); } catch(e) { alert(msg); }
    }
  }

  // handler tombol buka modal: ambil data-* dari row dan isi modal
  const buttons = document.querySelectorAll('.btn-open-visit-modal');
  const modal = new bootstrap.Modal(document.getElementById('modalVisit'));

  buttons.forEach(btn => {
    btn.addEventListener('click', function () {
      const id = this.dataset.id;
      const no_rm = this.dataset.no_rm || '-';
      const nama = this.dataset.nama || '-';
      const nik = this.dataset.nik || '-';
      const alamat = this.dataset.alamat || '-';
      const tgl = this.dataset.tgl_lahir || '-';

      // isi elemen modal
      document.getElementById('mv_pasien_id').value = id;
      document.getElementById('mv_no_rm').innerText = no_rm;
      document.getElementById('mv_nama').innerText = nama;
      document.getElementById('mv_nik').innerText = nik;
      document.getElementById('mv_alamat').innerText = alamat;
      document.getElementById('mv_tgl_lahir').innerText = tgl;

      // reset form errors visuals (optional)
      // buka modal
      modal.show();
    });
  });

  // Jika server menginstruksikan modal terbuka kembali (mis: validasi gagal),
  // controller bisa redirect back()->withInput()->with('open_modal', true)->with('patient_id', $id)
  @if(session('open_modal') && session('patient_id'))
    (function() {
      // cari tombol yang berisi data-id = session patient_id dan trigger click
      const pid = @json(session('patient_id'));
      const btn = document.querySelector('.btn-open-visit-modal[data-id="'+pid+'"]');
      if (btn) {
        btn.click();
        // buka juga modal jika click handler tidak memanggil modal (safety)
        try { modal.show(); } catch(e) {}
      } else {
        // jika pasien tidak ada di hasil saat ini, isi hanya pasien_id & show modal
        document.getElementById('mv_pasien_id').value = pid;
        modal.show();
      }
    })();
  @endif

});
</script>
@endsection
