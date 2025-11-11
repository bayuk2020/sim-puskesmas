@"
@extends('layouts.app')

@section('content')
<div class='container'>
    <h1>Rekap Per Poli</h1>
    <p>Ini halaman untuk menampilkan laporan per poli.</p>
</div>
@endsection
"@ | Out-File -FilePath resources\views\reports\poli.blade.php -Encoding UTF8
