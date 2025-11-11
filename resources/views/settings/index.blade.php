@"
@extends('layouts.app')

@section('content')
<div class='container'>
    <h1>Pengaturan</h1>
    <p>Ini halaman pengaturan aplikasi.</p>
</div>
@endsection
"@ | Out-File -FilePath resources\views\settings\index.blade.php -Encoding UTF8
