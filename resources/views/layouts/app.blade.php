<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('assets/adminkit/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/adminkit/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
</head>

<body>
<div class="wrapper">

    {{-- Sidebar --}}
    @include('partials.sidebar')

    <div class="main">

        {{-- Navbar --}}
        @include('partials.navbar')

        <main class="content">
            <div class="container-fluid p-0">

                @yield('content')

                {{-- Notifikasi --}}
                @if (session('success') || session('error') || session('info'))
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const notyf = new Notyf({
                                duration: 5000,
                                position: { x: 'center', y: 'top' },
                                dismissible: true
                            });

                            @if (session('success'))
                            notyf.success(`{{ session('success') }}`);
                            @elseif(session('error'))
                            notyf.error(`{{ session('error') }}`);
                            @elseif(session('info'))
                            notyf.open({
                                type: 'info',
                                message: `{{ session('info') }}`,
                                background: '#17a2b8'
                            });
                            @endif
                        });
                    </script>
                @endif

            </div>
        </main>

        @include('partials.footer')

    </div>
</div>

{{-- Skrip utama --}}
<script src="{{ asset('assets/adminkit/js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script> window.feather && feather.replace(); </script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

{{-- =============================================
     LOAD SCRIPT DASHBOARD HANYA DI /dashboard
============================================= --}}
@if(request()->is('dashboard'))
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Cek masing-masing elemen sebelum render
            let line = document.getElementById("chartjs-dashboard-line");
            if (line) {
                let ctx = line.getContext("2d");
                let gradient = ctx.createLinearGradient(0, 0, 0, 225);
                gradient.addColorStop(0, "rgba(215,227,244,1)");
                gradient.addColorStop(1, "rgba(215,227,244,0)");

                new Chart(line, {
                    type: "line",
                    data: {
                        labels: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
                        datasets: [{
                            label: "Sales",
                            fill: true,
                            backgroundColor: gradient,
                            borderColor: "#3b7ddd",
                            data: [2115,1562,1584,1892,1587,1923,2566,2448,2805,3438,2917,3327]
                        }]
                    },
                    options: { maintainAspectRatio:false }
                });
            }

            let pie = document.getElementById("chartjs-dashboard-pie");
            if (pie) {
                new Chart(pie, {
                    type: "pie",
                    data: {
                        labels: ["Chrome","Firefox","IE"],
                        datasets: [{
                            data: [4306,3801,1689],
                            backgroundColor: ["#3b7ddd","#ffc107","#dc3545"]
                        }]
                    }
                });
            }

            let map = document.getElementById("world_map");
            if (map) {
                new jsVectorMap({
                    selector: "#world_map",
                    map: "world"
                });
            }

            let dt = document.getElementById("datetimepicker-dashboard");
            if (dt) {
                flatpickr(dt, { inline: true });
            }
        });
    </script>
@endif

{{-- =============================================
     STACK UNTUK SCRIPT TAMBAHAN PER HALAMAN
============================================= --}}
@stack('scripts')

</body>
</html>
