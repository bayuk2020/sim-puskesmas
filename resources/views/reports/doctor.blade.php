@"
@extends('layouts.app')

@section('content')
<div class='container'>
    <h1>Rekap Per Dokter</h1>
    <p>Ini halaman untuk menampilkan laporan per dokter.</p>
</div>
@endsection
"@ | Out-File -FilePath resources\views\reports\doctor.blade.php -Encoding UTF8
