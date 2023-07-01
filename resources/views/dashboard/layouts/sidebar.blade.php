
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav " id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <i class="bi bi-grid-1x2"></i>
            Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/profiles') ? 'active' : '' }}" aria-current="page" href="/dashboard/profiles">
            <i class="bi bi-person"></i>
            Profil Pengguna
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
        <a class="nav-link {{ Request::is('dashboard/presensi*') ? 'active' : '' }}" href="/dashboard/presensi">
            <i class="bi bi-journal-check"></i>
            Presensi
        </a>
      </li>
      
    </ul>

    @can('sekdes')
    <ul class="sidebar-nav " id="sidebar-nav">
      <li class="nav-heading">Administrator</li>
      
     
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/kelola-presensi*') ? 'active' : '' }}" href="/dashboard/kelola-presensi">
            <i class="bi bi-journal-check"></i>
            Kelola Presensi
        </a>
      </li>
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
     
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/mutasi*') ? 'active' : '' }}" href="/dashboard/mutasi">
            <i class="bi bi-person-badge"></i>
            Kelola Mutasi
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/kepensiunan*') ? 'active' : '' }}" href="/dashboard/kepensiunan">
            <i class="bi bi-person-badge"></i>
            Kelola Kepensiunan
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/log-activity*') ? 'active' : '' }}" href="/dashboard/log-activity">
            <i class="bi bi-journal-check"></i>
            Log Activity
        </a>
      </li>
    </ul>
    @endcan

    @can('kades')
    <ul class="sidebar-nav " id="sidebar-nav">
      <li class="nav-heading">Administrator</li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/lihat-reports*') ? 'active' : '' }}" href="/dashboard/lihat-reports">
            <i class="bi bi-journal-text"></i>
            Lihat Laporan Kerja
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/lihat-presensi*') ? 'active' : '' }}" href="/dashboard/lihat-presensi">
            <i class="bi bi-journal-check"></i>
            Lihat Presensi Pegawai
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/lihat-cuti*') ? 'active' : '' }}" href="/dashboard/lihat-cuti">
            <i class="bi bi-calendar-check"></i>
            Lihat Cuti Pegawai
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/lihat-pegawai*') ? 'active' : '' }}" href="/dashboard/lihat-pegawai">
            <i class="bi bi-people"></i>
            Lihat Data Pegawai
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/penilaian*') ? 'active' : '' }}" href="/dashboard/penilaian">
            <i class="bi bi-file-bar-graph"></i>
            Kelola Penilaian Kinerja
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard/log-activity*') ? 'active' : '' }}" href="/dashboard/log-activity">
            <i class="bi bi-journal-check"></i>
            Log Activity
        </a>
      </li>
    </ul>
    @endcan

  </aside>
