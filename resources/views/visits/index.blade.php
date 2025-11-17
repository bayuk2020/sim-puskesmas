@extends('layouts.app')

@section('content')
<style>
    
    .sidebar-kunjungan { width: 260px; }

    .konten-kanan { flex: 1; }

    
    .table thead th {
        background: #c7e8c4; 
        font-weight: bold;
        text-align: center;
        padding-left: 0.5rem; 
        padding-right: 0.5rem;
        vertical-align: middle;
    }

  
    .aksi-btn {
        display: flex;
        gap: 6px;
        justify-content: center;
        padding: 5px 0;
    }

    
    .full-width-card {
        width: 100%;
        margin-top: 15px; 
    }
</style>

<div class="container-fluid mt-3">

    {{-- BARIS UTAMA (Sidebar Kiri & Formulir Kanan) --}}
    <div class="d-flex gap-3">

        {{-- KUNJUNGAN KIRI --}}
        <div class="sidebar-kunjungan">
            <div class="card shadow-sm">
                <div class="card-header fw-bold text-center">KUNJUNGAN</div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('visits.index') }}" class="list-group-item list-group-item-action active">Cari Pasien</a>
                    <a href="#" class="list-group-item list-group-item-action">Online</a>
                    <a href="#" class="list-group-item list-group-item-action">Antrian</a>
                </div>
            </div>
        </div>

        {{-- KANAN (Formulir Pendaftaran) --}}
        <div class="konten-kanan">

            {{-- PENDAFTARAN --}}
            <div class="card shadow-sm mb-3">
                <div class="card-header fw-bold">Pendaftaran Kunjungan Pasien</div>
                <div class="card-body">

                    <h5 class="mb-3">Pencarian Pasien</h5>

                    <form action="{{ route('visits.index') }}" method="get" class="row g-3">

                        @php $f = $filters ?? []; @endphp

                        <div class="col-md-6">
                            <label class="form-label">Nama Pasien</label>
                            <input type="text" name="nama" class="form-control" value="{{ $f['nama'] ?? '' }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama KK</label>
                            <input type="text" name="nama_kk" class="form-control" value="{{ $f['namaKK'] ?? '' }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">No CM</label>
                            <input type="text" name="no_cm" class="form-control" value="{{ $f['noCM'] ?? '' }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">NIK</label>
                            <input type="text" name="nik" class="form-control" value="{{ $f['nik'] ?? '' }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Kelurahan</label>
                            <input type="text" name="kelurahan" class="form-control" value="{{ $f['kelurahan'] ?? '' }}">
                        </div>

                        <div class="col-12 mt-2">
                            <button class="btn btn-success">Cari</button>
                            <a href="{{ route('visits.index') }}" class="btn btn-secondary">Reset</a>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
    
    {{--- BAGIAN HASIL PENCARIAN (LEBAR PENUH) ---}}
    <div class="full-width-card">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">Hasil Pencarian</div>

            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 10%">No CM</th>
                            <th style="width: 10%">Nama</th>
                            <th style="width: 10%">Nama KK</th>
                            <th style="width: 18%">Tgl Lahir</th> <th style="width: 22%">Alamat</th>    <th style="width: 15%">Kelurahan</th>
                            <th style="width: 10%">Aksi</th>
                            {{-- Total: 5+10+10+10+18+22+15+10 = 100% --}}
                        </tr>
                    </thead>
                    <tbody>

                    @forelse($patients as $i => $p)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $p->no_rm }}</td>
                            <td>{{ $p->nama_pasien }}</td>
                            <td>{{ $p->nama_kk ?? '-' }}</td>
                            <td class="text-center">{{ optional($p->tanggal_lahir)->format('Y-m-d') }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td class="text-center">{{ $p->kelurahan ?? '-' }}</td>
                            <td>
                                <div class="aksi-btn">
                                    <a href="{{ route('visits.create', $p->id_pasien) }}" class="btn btn-success btn-sm">Kunjungan</a>
                                    <!-- <button class="btn btn-warning btn-sm">Booking</button> -->
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-3">Belum ada data</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--- END HASIL PENCARIAN ---}}

</div>
@endsection