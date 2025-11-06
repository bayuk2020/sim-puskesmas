@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Obat</h4>
    <form action="{{ route('obat.store') }}" method="POST">
        @csrf
        @include('obat.form')
        <button type="submit" class="btn btn-success mt-3">Simpan</button>
        <a href="{{ route('obat.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
