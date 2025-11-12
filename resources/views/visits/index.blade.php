@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Kunjungan</h1>

    {{-- Search pasien --}}
    <form method="GET" action="{{ route('visits.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Cari pasien..." value="{{ request('q') }}">
            <button class="btn btn-primary" type="submit">
                <i class="fa fa-search"></i> Cari
            </button>
        </div>
    </form>

    {{-- Tabel kunjungan --}}
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Poli</th>
                <th>Tanggal Kunjungan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($visits ?? [] as $visit)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $visit->patient_name }}</td>
                    <td>{{ $visit->poli_name }}</td>
                    <td>{{ $visit->visit_date->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('rekammedis.create', ['visit' => $visit->id]) }}" 
                           class="btn btn-sm btn-success">
                            <i class="fa fa-notes-medical"></i> Input Rekam Medis
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data kunjungan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="d-flex justify-content-end">
        {{ $visits->links() }}
    </div>
</div>
@endsection
