<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="/" class="d-block">{{ Auth::user()->username }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        @if (Auth::user()->id_role == 1)
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.kriteria') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kriteria</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.subkriteria') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Subkriteria</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>
                                Analisa
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.alternatif') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Alternatif</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.perhitungan') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hasil Perhitungan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.hasil') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hasil Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.riwayat') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Riwayat Analisa
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">PENGATURAN</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.profile') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="nav-icon fas fa-door-open"></i>
                            <p>
                                logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        @else
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>
                                Analisa
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('alternatif') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Alternatif</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('perhitungan') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hasil Perhitungan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('hasil') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hasil Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('riwayat') }}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Riwayat Analisa
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">PENGATURAN</li>
                    <li class="nav-item">
                        <a href="{{ route('profile') }}" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">
                            <i class="nav-icon fas fa-door-open"></i>
                            <p>
                                logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        @endif
    </div>
    <!-- /.sidebar -->
</aside>
