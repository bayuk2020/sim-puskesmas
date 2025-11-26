@extends('layouts.app')

@section('content')
<div class="container-fluid">

  <div class="card">
    <div class="card-header fw-bold">CATAT KUNJUNGAN</div>
    <div class="card-body">

      <h5 class="mb-3">IDENTITAS</h5>
      <table class="table table-sm">
        <tr>
          <th>Nama Pasien</th><td>{{ $patient->nama_pasien }}</td>
          <th>Nama KK</th><td>{{ $patient->nama_kk ?? '-' }}</td>
        </tr>
        <tr>
          <th>No Catatan Medik</th><td>{{ $patient->no_rm }}</td>
          <th>Alamat</th><td>{{ $patient->alamat }}</td>
        </tr>
        <tr>
          <th>NIK</th><td>{{ $patient->nik }}</td>
          <th>No BPJS</th><td>{{ $patient->no_bpjs ?? '-' }}</td>
        </tr>
      </table>

      <hr>

      <form action="{{ route('visits.store') }}" method="post">
        @csrf
        <input type="hidden" name="pasien_id" value="{{ $patient->id_pasien }}">

        <div class="row g-3">

          <div class="col-md-4">
            <label class="form-label">Petugas</label>
            <select name="staff_id" class="form-control" required>
              <option value="">-- pilih petugas --</option>
              @foreach($staffs as $s)
                <option value="{{ $s->id_pegawai }}">{{ $s->nama_pegawai }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">Poli</label>
            <select name="id_poli" id="selectPoli" class="form-control" required>
              <option value="">-- pilih poli --</option>
              @foreach($polis as $pol)
                <option value="{{ $pol->id_poli }}"
                        data-kode="{{ $pol->kode_poli }}">{{ $pol->nama_poli }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">Nomor Antrian</label>
            <input type="text" id="noAntrian" class="form-control" readonly placeholder="Pilih poli">
          </div>

          <div class="col-md-4">
            <label class="form-label">Tanggal Kunjungan</label>
            <input type="date" name="visit_date" class="form-control"
                   value="{{ now()->toDateString() }}" required>
          </div>

        </div>

        <div class="mt-4">
          <button class="btn btn-success">Catat Kunjungan</button>
          <a href="{{ route('visits.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

      </form>

    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectPoli = document.getElementById('selectPoli');
    const noAntrian = document.getElementById('noAntrian');

    selectPoli.addEventListener('change', function () {
        let poliId = this.value;

        if (!poliId) {
            noAntrian.value = "";
            return;
        }

        fetch(`/poli/${poliId}/nextQueue`)
        .then(res => res.json())
        .then(data => {
            noAntrian.value = data.next_antrian;
        })
        .catch(() => {
            noAntrian.value = "ERROR";
        });
    });
});
</script>
@endpush
