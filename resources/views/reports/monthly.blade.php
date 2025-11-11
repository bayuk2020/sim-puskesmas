@"
@extends('layouts.app')

@section('content')
<div class='container'>
    <h1>Rekap Bulanan</h1>
    <p>Ini halaman untuk menampilkan laporan bulanan.</p>
</div>
@endsection
"@ | Out-File -FilePath resources\views\reports\monthly.blade.php -Encoding UTF8
