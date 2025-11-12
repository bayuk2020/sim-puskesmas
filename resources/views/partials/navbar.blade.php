@php
use Illuminate\Support\Facades\Auth;
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container-fluid">
    {{-- Brand --}}
    <a class="navbar-brand fw-semibold text-dark" href="{{ route('dashboard') }}">
      {{ config('app.name', 'SIMPUS') }}
    </a>

    {{-- Right menu --}}
    <ul class="navbar-nav ms-auto align-items-center">
      @auth
        {{-- Notifikasi --}}
        <li class="nav-item me-3 dropdown">
          <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="align-middle" data-feather="bell"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              3 {{-- jumlah notifikasi --}}
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
            <li><h6 class="dropdown-header">Notifikasi</h6></li>
            <li><a class="dropdown-item" href="#">Notifikasi 1</a></li>
            <li><a class="dropdown-item" href="#">Notifikasi 2</a></li>
            <li><a class="dropdown-item" href="#">Notifikasi 3</a></li>
          </ul>
        </li>

        {{-- Pesan / Chat --}}
        <li class="nav-item me-3 dropdown">
          <a class="nav-link position-relative" href="#" id="messagesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="align-middle" data-feather="mail"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
              2 {{-- jumlah pesan --}}
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="messagesDropdown">
            <li><h6 class="dropdown-header">Pesan</h6></li>
            <li><a class="dropdown-item" href="#">Pesan dari Admin 1</a></li>
            <li><a class="dropdown-item" href="#">Pesan dari Admin 2</a></li>
          </ul>
        </li>

        {{-- User dropdown --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
             role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('assets/adminkit/img/avatars/avatar.jpg') }}" 
                 class="avatar rounded-circle me-2" width="32" height="32" alt="{{ Auth::user()->name }}">
            <span class="text-dark">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
              <h6 class="dropdown-header">{{ Auth::user()->email }}</h6>
            </li>
            <li>
              <a class="dropdown-item" href="#">
                <i class="align-middle me-1" data-feather="user"></i> Profil
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('password.request') }}">
                <i class="align-middle me-1" data-feather="lock"></i> Reset Password
              </a>
            </li>
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

      @guest
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
      @endguest
    </ul>
  </div>
</nav>
