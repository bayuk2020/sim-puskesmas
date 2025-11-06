@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Obat</h4>
    <form action="{{ route('obat.update', $obat->id_obat) }}" method="POST">
        @csrf @method('PUT')
        @include('obat.form')
        <button type="submit" class="btn btn-success mt-3">Perbarui</button>
        <a href="{{ route('obat.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
