<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="/dashboard">
      <span class="align-middle"><i class="fa-solid fa-stethoscope me-2"></i> SIM-PUSKESMAS</span>
    </a>

    <ul class="sidebar-nav">
      <li class="sidebar-header">Menu Utama</li>

      <li class="sidebar-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="sidebar-link" href="/dashboard">
          <i class="fa-solid fa-gauge-high me-2"></i>
          <span class="align-middle">Dashboard</span>
        </a>
      </li>

      <li class="sidebar-header">Data Master</li>

      <li class="sidebar-item {{ request()->is('pasien*') ? 'active' : '' }}">
        <a class="sidebar-link" href="/pasien">
          <i class="fa-solid fa-user-injured me-2"></i>
          <span class="align-middle">Pasien</span>
        </a>
      </li>

      <li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('pegawai.index') }}">
        <i class="fa fa-users"></i> Pegawai
    </a>
</li>


      <li class="sidebar-item {{ request()->is('poli*') ? 'active' : '' }}">
  <a class="sidebar-link" href="{{ route('poli.index') }}">
    <i class="fa-solid fa-hospital-user me-2"></i>
    <span class="align-middle">Poli</span>
  </a>
</li>


      <li class="sidebar-item {{ request()->is('obat*') ? 'active' : '' }}">
  <a class="sidebar-link" href="{{ route('obat.index') }}">
    <i class="fa-solid fa-capsules me-2"></i>
    <span class="align-middle">Obat</span>
  </a>
</li>


      <li class="sidebar-item {{ request()->is('tindakan*') ? 'active' : '' }}">
  <a class="sidebar-link" href="{{ route('tindakan.index') }}">
    <i class="fa-solid fa-stethoscope me-2"></i>
    <span class="align-middle">Tindakan</span>
  </a>
</li>


      <li class="sidebar-header">Pelayanan</li>

      <li class="sidebar-item {{ request()->is('kunjungan*') ? 'active' : '' }}">
        <a class="sidebar-link" href="/dashboard">
          <i class="fa-solid fa-notes-medical me-2"></i>
          <span class="align-middle">Kunjungan</span>
        </a>
      </li>

      <li class="sidebar-item {{ request()->is('resep*') ? 'active' : '' }}">
        <a class="sidebar-link" href="/dashboard">
          <i class="fa-solid fa-prescription-bottle-medical me-2"></i>
          <span class="align-middle">Resep</span>
        </a>
      </li>

      <li class="sidebar-item {{ request()->is('pembayaran*') ? 'active' : '' }}">
        <a class="sidebar-link" href="/dashboard">
          <i class="fa-solid fa-money-bill-wave me-2"></i>
          <span class="align-middle">Pembayaran</span>
        </a>
      </li>

      <li class="sidebar-header">Laporan & Pengaturan</li>

      <li class="sidebar-item {{ request()->is('laporan*') ? 'active' : '' }}">
        <a class="sidebar-link" href="/dashboard">
          <i class="fa-solid fa-chart-line me-2"></i>
          <span class="align-middle">Laporan</span>
        </a>
      </li>

      <li class="sidebar-item {{ request()->is('user*') ? 'active' : '' }}">
        <a class="sidebar-link" href="/dashboard">
          <i class="fa-solid fa-gear me-2"></i>
          <span class="align-middle">Pengaturan</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
git commit -m "Perbaru"
