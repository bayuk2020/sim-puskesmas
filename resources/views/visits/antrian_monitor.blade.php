@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">

    <h2 class="mb-4 fw-bold">Monitoring Antrian Poliklinik</h2>

    <div class="row g-4">

        @foreach($result as $item)
        <div class="col-md-4">
            <div class="card shadow-sm">

                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $item['poli']->nama_poli }}</h5>
                </div>

                <div class="card-body">

                    {{-- Sedang Dilayani --}}
                    <div class="mb-3 text-center">
                        <small class="text-muted">Sedang Dilayani</small>
                        <div class="display-5 fw-bold text-primary">
                            {{ $item['current']->no_antrian ?? '-' }}
                        </div>
                        <div class="fw-semibold">
                            {{ $item['current']->pasien->nama_pasien ?? 'Tidak ada' }}
                        </div>
                    </div>

                    <hr>

                    {{-- Berikutnya --}}
                    <div class="mb-3 text-center">
                        <small class="text-muted">Berikutnya</small>
                        <div class="fs-4 fw-bold text-success">
                            {{ $item['next']->no_antrian ?? '-' }}
                        </div>
                    </div>

                    {{-- Sisa --}}
                    <div class="text-center">
                        <span class="badge bg-warning text-dark fs-6">
                            Sisa Antrian: {{ $item['sisa'] }}
                        </span>
                    </div>

                </div>

            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection

@push('scripts')
<script>
    // refresh otomatis setiap 20 detik
    setInterval(() => {
        location.reload();
    }, 20000);
</script>
@endpush
