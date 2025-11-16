<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="{{ route('dashboard') }}">
      <span class="align-middle"><i class="fa-solid fa-stethoscope me-2"></i> SIM-PUSKESMAS</span>
    </a>

    <ul class="sidebar-nav">
      <li class="sidebar-header">Menu Utama</li>

      <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('dashboard') }}">
          <i class="fa-solid fa-gauge-high me-2"></i>
          <span class="align-middle">Dashboard</span>
        </a>
      </li>

      <li class="sidebar-header">Data Master</li>

      <li class="sidebar-item {{ request()->routeIs('pasien.*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('pasien.index') }}">
          <i class="fa-solid fa-user-injured me-2"></i>
          <span class="align-middle">Pasien</span>
        </a>
      </li>

      <li class="sidebar-item {{ request()->routeIs('pegawai.*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('pegawai.index') }}">
          <i class="fa fa-users me-2"></i>
          <span class="align-middle">Pegawai</span>
        </a>
      </li>

      <li class="sidebar-item {{ request()->routeIs('poli.*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('poli.index') }}">
          <i class="fa-solid fa-hospital-user me-2"></i>
          <span class="align-middle">Poli</span>
        </a>
      </li>

      <li class="sidebar-item {{ request()->routeIs('obat.*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('obat.index') }}">
          <i class="fa-solid fa-capsules me-2"></i>
          <span class="align-middle">Obat</span>
        </a>
      </li>

      <li class="sidebar-item {{ request()->routeIs('tindakan.*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('tindakan.index') }}">
          <i class="fa-solid fa-stethoscope me-2"></i>
          <span class="align-middle">Tindakan</span>
        </a>
      </li>

      <li class="sidebar-header">Pelayanan</li>

      <li class="sidebar-item {{ request()->routeIs('visits.*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('visits.index') }}">
          <i class="fa-solid fa-notes-medical me-2"></i>
          <span class="align-middle">Kunjungan</span>
        </a>
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link" href="#">
          <i class="fa-solid fa-prescription-bottle-medical me-2"></i>
          <span class="align-middle">Resep</span>
        </a>
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link" href="#">
          <i class="fa-solid fa-money-bill-wave me-2"></i>
          <span class="align-middle">Pembayaran</span>
        </a>
      </li>

      <li class="sidebar-header">Laporan & Pengaturan</li>

      <li class="sidebar-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
  <a class="sidebar-link collapsed" href="#reportsMenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('reports.*') ? 'true' : 'false' }}">
    <i class="fa-solid fa-chart-line me-2"></i>
    <span class="align-middle">Laporan</span>
  </a>
  <ul class="collapse list-unstyled {{ request()->routeIs('reports.*') ? 'show' : '' }}" id="reportsMenu">
    <li>
      <a class="sidebar-link ms-4 {{ request()->routeIs('reports.daily') ? 'active' : '' }}" href="#">Rekap Harian</a>
    </li>
    <li>
      <a class="sidebar-link ms-4 {{ request()->routeIs('reports.monthly') ? 'active' : '' }}" href="#">Rekap Bulanan</a>
    </li>
    <li>
      <a class="sidebar-link ms-4 {{ request()->routeIs('reports.doctor') ? 'active' : '' }}" href="#">Per Dokter</a>
    </li>
    <li>
      <a class="sidebar-link ms-4 {{ request()->routeIs('reports.poli') ? 'active' : '' }}" href="#">Per Poli</a>
    </li>
  </ul>
</li>


      <li class="sidebar-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
        <a class="sidebar-link" href="#">
          <i class="fa-solid fa-gear me-2"></i>
          <span class="align-middle">Pengaturan</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
