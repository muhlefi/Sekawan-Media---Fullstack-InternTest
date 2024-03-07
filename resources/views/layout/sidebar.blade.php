<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('dbassets/img/nikelnusa.png') }}" alt="Logo" width="80px" height="45px">
        </div>
        <div class="sidebar-brand-text mx-2">NikelNusa<sup>CP</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if (Request::is('dashboard')) active @endif">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pemesanan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if (Request::is(['/dashboard/pengajuan', 'dashboard/followup','/dashboard/persetujuan'])) active @endif">
        <a class="nav-link collapsed " href="#"
            data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pesan Kendaraan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Proses Kendaraan:</h6>
                @if (Auth::user()->role == 'karyawan' || Auth::user()->role == 'admin')
                    <a class="collapse-item" href="/dashboard/pengajuan">Pengajuan Kendaraan</a>
                @endif
                @if (Auth::user()->role == 'admin')
                    <a class="collapse-item" href="/dashboard/followup">Follow Up Pemesanan</a>
                @endif
                @if (Auth::user()->role == 'approver')
                    <a class="collapse-item" href="/dashboard/persetujuan">Persetujuan Kendaraan</a>
                @endif
            </div>
        </div>
    </li>

    @if (Auth::user()->role == 'karyawan')
        <li class="nav-item @if (Request::is('dashboard/status')) active @endif">
            <a class="nav-link" href="/dashboard/status">
                <i class="fas fa-fw fa-hourglass"></i>
                <span>Status Pemesanan</span>
            </a>
        </li>
    @endif

    @if (Auth::user()->role == 'approver')
        <li class="nav-item @if (Request::is('dashboard/riwayat')) active @endif">
            <a class="nav-link" href="/dashboard/riwayat">
                <i class="fas fa-fw fa-archive"></i>
                <span>Riwayat Pemesanan</span>
            </a>
        </li>
    @endif

    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'approver')
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Data Admin
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item @if (Request::is(['home', 'dashboard'])) active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-sitemap"></i>
                <span>Laman Website</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Halaman Tampilan:</h6>
                    <a class="collapse-item" href="/home">Home</a>
                    <a class="collapse-item" href="/dashboard">Dashboard</a>
                </div>
            </div>
        </li>

        <li class="nav-item @if (Request::is('dashboard/akun','dashboard/pemesanan','dashboard/kendaraan')) active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-globe"></i>
                <span>Data Website</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Basis Data:</h6>
                    @if (Auth::user()->role == 'admin')
                        <a class="collapse-item" href="/dashboard/akun">Data Akun</a>
                        <a class="collapse-item" href="/dashboard/kendaraan">Data Kendaraan</a>
                    @endif
                    <a class="collapse-item" href="/dashboard/pemesanan">Data Pemesanan</a>
                </div>
            </div>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
