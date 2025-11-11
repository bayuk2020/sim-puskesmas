@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Input Rekam Medis untuk: {{ $visit->pasien->nama_pasien }}</h4>

    <form action="{{ route('rekammedis.store', $visit->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <input type="text" name="keluhan" id="keluhan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="diagnosa" class="form-label">Diagnosa</label>
            <input type="text" name="diagnosa" id="diagnosa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tindakan" class="form-label">Tindakan</label>
            <input type="text" name="tindakan" id="tindakan" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan Rekam Medis</button>
    </form>
</div>
@endsection
