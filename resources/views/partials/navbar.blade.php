@php
  use Illuminate\Support\Facades\Auth;

  // Helper active class
  function nav_active($patterns) {
      foreach ((array) $patterns as $p) {
          if (request()->routeIs($p)) return 'active';
      }
      return '';
  }
@endphp

<nav class="navbar navbar-expand navbar-light navbar-bg shadow-sm">
  {{-- Sidebar toggle (AdminKit) --}}
  <a class="sidebar-toggle js-sidebar-toggle">
    <i class="hamburger align-self-center"></i>
  </a>

  {{-- Brand / Klinik name --}}
  <a class="navbar-brand ms-2 fw-semibold text-dark" href="{{ route('dashboard') }}">
    {{ config('app.name', 'SIMPUS') }}
  </a>

  <div class="navbar-collapse collapse">
    <ul class="navbar-nav me-auto">
      @auth
        {{-- Menu modul utama - atur sesuai role kalau perlu --}}
        <li class="nav-item">
          {{-- <a class="nav-link {{ nav_active(['visits.*']) }}" href="{{ route('visits.index') }}">  --}}
          <a class="nav-link {{ nav_active(['visits.*']) }}" href="#"> 
            <i class="align-middle me-1" data-feather="calendar"></i> Kunjungan
          </a>
        </li>
        <li class="nav-item">
          {{-- <a class="nav-link {{ nav_active(['prescriptions.*']) }}" href="{{ route('prescriptions.index') }}"> --}}
            <i class="align-middle me-1" data-feather="file-text"></i> Resep
          </a>
        </li>
        <li class="nav-item">
          {{-- <a class="nav-link {{ nav_active(['payments.*']) }}" href="{{ route('payments.index') }}"> --}}
            <i class="align-middle me-1" data-feather="credit-card"></i> Pembayaran
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ nav_active(['reports.*']) }}" href="#" id="reportDropdown"
             role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="align-middle me-1" data-feather="bar-chart-2"></i> Laporan
          </a>
          <ul class="dropdown-menu" aria-labelledby="reportDropdown">
            {{-- <li><a class="dropdown-item" href="{{ route('reports.daily') }}">Rekap Harian</a></li>
            <li><a class="dropdown-item" href="{{ route('reports.monthly') }}">Rekap Bulanan</a></li>
            <li><a class="dropdown-item" href="{{ route('reports.doctor') }}">Per Dokter</a></li>
            <li><a class="dropdown-item" href="{{ route('reports.poli') }}">Per Poli</a></li> --}}
          </ul>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link {{ nav_active(['settings.*']) }}" href="{{ route('settings.index') }}">
            <i class="align-middle me-1" data-feather="settings"></i> Pengaturan
          </a>
        </li> --}}
      @endauth
    </ul>

    <ul class="navbar-nav ms-auto navbar-align">
      {{-- (Opsional) Notifikasi / Pesan bisa disini --}}

      @guest
        @if (Route::has('login'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
        @endif
        @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
          </li>
        @endif
      @endguest

      @auth
        {{-- User dropdown + Logout --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" id="userDropdown"
             role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('assets/adminkit/img/avatars/avatar.jpg') }}"
                 class="avatar img-fluid rounded me-1" alt="{{ Auth::user()->name }}" />
            <span class="text-dark">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><h6 class="dropdown-header">{{ Auth::user()->email }}</h6></li>
            {{-- <li><a class="dropdown-item" href="{{ route('profile.show') }}"> --}}
              <i class="align-middle me-1" data-feather="user"></i> Profil
            </a></li>
            <li><a class="dropdown-item" href="{{ route('password.request') }}">
              <i class="align-middle me-1" data-feather="lock"></i> Reset Password
            </a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="align-middle me-1" data-feather="log-out"></i> Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </li>
      @endauth
    </ul>
  </div>
</nav>
