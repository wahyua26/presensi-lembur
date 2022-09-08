<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="https://jmtm.co.id" class="brand-link">
      <img src="{{ asset('AdminLTE/dist/img/logo.png') }}" alt="JMTM Logo" class="brand-image" style="opacity: 1">
      <span class="brand-text font-weight-light">PT JMTM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('storage/images/' . auth()->user()->foto) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ url('/profile', ['npp' => auth()->user()->npp]) }}" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Presensi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('presensi-masuk') }}" class="nav-link">
                    <i class="fas fa-sign-in-alt"></i>
                  <p>Presensi Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('presensi-keluar') }}" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                  <p>Presensi Keluar</p>
                </a>
              </li>
            </ul>
          </li> --}}
          <li class="nav-item">
            <a href="{{ route('presensi-masuk') }}" class="nav-link">
              <i class="nav-icon fas fa-clock"></i>
              <p>Presensi</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('halaman-rekap-karyawan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Presensi Per Karyawan</p>
                </a>
              </li>
              @if (auth()->user()->level == 'admin')
              <li class="nav-item">
                <a href="{{ route('halaman-rekap-keseluruhan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Presensi Keseluruhan</p>
                </a>
              </li>
              @endif
            </ul>
        @if (auth()->user()->level == 'admin')
        <li class="nav-item">
          <a href="{{ route('list-karyawan') }}" class="nav-link">
            <i class="fas fa-users"></i>
            <p>Karyawan</p>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>