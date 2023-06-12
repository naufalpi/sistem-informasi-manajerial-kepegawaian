{{-- <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/reports*') ? 'active' : '' }}" href="/dashboard/reports">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    My Posts
                </a>
            </li>
        </ul>
    </div>
</nav> --}}

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav " id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <i class="bi bi-grid"></i>
            Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/reports*') ? 'active' : '' }}" href="/dashboard/reports">
            <i class="bi bi-journal-text"></i>
            Kelola Laporan Kerja
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/cuti/pegawai*') ? 'active' : '' }}" href="/dashboard/cuti/pegawai">
            <i class="bi bi-calendar-plus"></i>
            Ajukan Cuti
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/') ? 'active' : '' }}" href="/dashboard/reports">
            <i class="bi bi-journal-check"></i>
            Kelola Presensi
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/profiles') ? 'active' : '' }}" href="/dashboard/profiles">
            <i class="bi bi-person"></i>
            Profil Pengguna
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/') ? 'active' : '' }}" href="/dashboard/">
            <i class="bi bi-person-badge"></i>
            Kelola Mutasi
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/') ? 'active' : '' }}" href="/dashboard/">
            <i class="bi bi-person-badge"></i>
            Kelola Kepensiunan
        </a>
      </li>
    </ul>

    @can('admin')
    <ul class="sidebar-nav " id="sidebar-nav">
      <li class="nav-heading">Administrator</li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/cuti/admin*') ? 'active' : '' }}" href="/dashboard/cuti/admin">
          <i class="bi bi-calendar-check"></i>
            Kelola Cuti
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/pegawai*') ? 'active' : '' }}" href="/dashboard/pegawai">
            <i class="bi bi-people"></i>
            Kelola Data Pegawai
        </a>
      </li>
    </ul>
    @endcan

  </aside>
  <!-- End Sidebar-->
