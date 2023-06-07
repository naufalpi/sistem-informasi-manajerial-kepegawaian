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
            <i class="bi bi-grid"></i>
            Kelola Laporan Kerja
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/') ? 'active' : '' }}" href="/dashboard/">
            <i class="bi bi-grid"></i>
            Ajukan Cuti
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/') ? 'active' : '' }}" href="/dashboard/reports">
            <i class="bi bi-grid"></i>
            Kelola Presensi
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/') ? 'active' : '' }}" href="/dashboard/">
            <i class="bi bi-grid"></i>
            Profil Pengguna
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/') ? 'active' : '' }}" href="/dashboard/">
            <i class="bi bi-grid"></i>
            Kelola Data Pegawai
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/') ? 'active' : '' }}" href="/dashboard/">
            <i class="bi bi-grid"></i>
            Kelola Mutasi
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/') ? 'active' : '' }}" href="/dashboard/">
            <i class="bi bi-grid"></i>
            Kelola Kepensiunan
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/') ? 'active' : '' }}" href="/dashboard/">
            <i class="bi bi-grid"></i>
            Kelola Cuti Pegawai
        </a>
      </li>
    </ul>

    @can('admin')
    <ul class="sidebar-nav " id="sidebar-nav">
      <li class="nav-heading">Administrator</li>

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">
            <i class="bi bi-grid"></i>
            Categories
        </a>
      </li>
    </ul>
    @endcan

  </aside>
  <!-- End Sidebar-->
