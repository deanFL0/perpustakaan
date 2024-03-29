<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #135b71;">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('adminlte') }}/dist/img/pgri.png" alt="Logo PGRI"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte') }}/dist/img/user.png" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->nama }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-tachometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('buku') }}" class="nav-link {{ Request::is('buku*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-briefcase"></i>
                        <p>
                                Pendataan Buku
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('program*') ? 'active' : '' }}">
                        <i class="fa-solid fa-layer-group"></i>
                        <p>
                            Program Kerja Perpustakaan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/program" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Program Kerja Perpustakaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/program/create" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Program Perpustakaan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        <p>
                            Kontrol Pengguna
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="/user" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Pengguna</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/user/create" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Pengguna</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="nav-item">
                    <form action="/logout" method="post" class="nav-link">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
