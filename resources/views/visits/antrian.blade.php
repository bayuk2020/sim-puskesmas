@extends('layouts.app')

@section('title', 'Antrian Poliklinik')

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title mb-0">Antrian Poliklinik</h1>
                </div>
                <div class="card-body">
                    <!-- Header Tanggal dan Info -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <h4 class="mb-0 me-3">{{ \Carbon\Carbon::now()->translatedFormat('d-m-Y') }}</h4>
                                <span class="badge bg-primary fs-6">Antrian umum</span>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h4 class="mb-0">{{ \Carbon\Carbon::now()->format('h:i:s A') }}</h4>
                        </div>
                    </div>

                    <!-- Data Antrian -->
                    <div class="row">
                        <!-- Kolom Kiri - Antrian Saat Ini -->
                        <div class="col-md-6">
                            <div class="card bg-light">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">Sedang Dipanggil</h5>
                                </div>
                                <div class="card-body text-center py-5">
                                    @if($currentVisit)
                                        <div class="display-1 fw-bold text-primary mb-3">
                                            {{ $currentVisit->no_antrian }}
                                        </div>
                                        <h3 class="mb-2">{{ $currentVisit->pasien->nama_pasien ?? 'N/A' }}</h3>
                                        <p class="text-muted">Poli: {{ $currentVisit->poli->nama_poli ?? 'Umum' }}</p>
                                    @else
                                        <div class="text-muted">
                                            <i class="fas fa-user-clock fa-3x mb-3"></i>
                                            <p>Tidak ada antrian saat ini</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan - Antrian Selanjutnya -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Antrian Selanjutnya</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Pasien</th>
                                                    <th>No Antrian</th>
                                                    <th>Poli</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($nextVisits as $visit)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $visit->pasien->nama_pasien ?? 'N/A' }}</td>
                                                        <td>
                                                            <span class="badge bg-secondary fs-6">
                                                                {{ $visit->no_antrian }}
                                                            </span>
                                                        </td>
                                                        <td>{{ $visit->poli->nama_poli ?? 'Umum' }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center text-muted">
                                                            Tidak ada antrian selanjutnya
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="alert alert-info">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <i class="fas fa-info-circle fa-2x"></i>
                                    </div>
                                    <div>
                                        <h5 class="alert-heading">Informasi</h5>
                                        <p class="mb-0">
                                            Silakan menunggu hingga nomor antrian Anda dipanggil. 
                                            Pastikan Anda telah melakukan pendaftaran ulang di loket.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .display-1 {
        font-size: 5rem;
        font-weight: 700;
    }
    
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto refresh setiap 30 detik
    setInterval(function() {
        window.location.reload();
    }, 30000);

    // Update waktu secara real-time
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', { 
            hour12: true,
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        document.querySelector('.text-md-end h4').textContent = timeString;
    }
    
    setInterval(updateTime, 1000);
</script>
@endpush