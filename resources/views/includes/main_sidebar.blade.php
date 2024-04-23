<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-3" style = "z-index: 1040 !important;">
    <a 
        @can('admin-access')
            href="{{ route('admin.index') }}"
        @endcan
        @can('employee-access')
            href="{{ route('employee.index') }}"
        @endcan
        class="brand-link text-left">
        <img src="{{ asset('/') }}images/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />
        <span class="brand-text font-weight-light ">IMS</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">
                @can('admin-access')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard Admin
                        </p>
                    </a>
                </li>
                @include('includes.admin.sidebar_items')
                @endcan
                @can('employee-access')
                <li class="nav-item">
                    <a href="{{ route('employee.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard Karyawan
                        </p>
                    </a>
                </li>
                @include('includes.employee.sidebar_items')
                @endcan
            </ul>
        </nav>
    </div>
</aside>
