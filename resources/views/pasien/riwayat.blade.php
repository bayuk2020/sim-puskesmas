@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Riwayat Kunjungan - {{ $pasien->nama_pasien }}</h1>
<div class="card">
  <div class="card-body table-responsive">
    <table class="table table-striped">
      <thead class="table-primary">
        <tr>
          <th>Tanggal</th>
          <th>Poli</th>
          <th>Keluhan</th>
          <th>Diagnosa</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($pasien->kunjungans as $k)
        <tr>
          <td>{{ \Carbon\Carbon::parse($k->tanggal_kunjungan)->format('d/m/Y') }}</td>
          <td>{{ $k->poli->nama_poli ?? '-' }}</td>
          <td>{{ $k->keluhan }}</td>
          <td>{{ $k->diagnosa }}</td>
          <td>{{ $k->status }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
