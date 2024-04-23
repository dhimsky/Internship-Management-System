<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-users"></i>
        <p>
            Magang
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">2</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
        </li>
        <li class="nav-item">
            <a
                href="{{ route('admin.employees.index') }}"
                class="nav-link">
                <i class="far fa-user nav-icon"></i>
                <p>Peserta Magang</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="{{ route('admin.employees.attendance') }}"
                class="nav-link">
                <i class="far fa-calendar-check-o nav-icon"></i>
                <p>Absensi Magang</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-calendar-times-o"></i>
        <p>
            Daftar Cuti Karyawan
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">1</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="{{ route('admin.leaves.index') }}"
                class="nav-link"
            >
                <i class="far fa-calendar-minus nav-icon"></i>
                <p>Cuti</p>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a
                href="{{ route('admin.expenses.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Expenses</p>
            </a>
        </li> -->
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-gear"></i>
        <p>
            Kelola
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">4</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
            href="{{ route('admin.admin.index') }}"
            class="nav-link">
            <i class="fa fa-user nav-icon"></i>
            <p>Data Admin</p>
        </a>
            <a
                href="{{ route('admin.iploc.index') }}"
                class="nav-link">
                <i class="fa fa-location-arrow nav-icon"></i>
                <p>IP dan Lokasi</p>
            </a>
            <a
                href="{{ route('admin.division.index') }}"
                class="nav-link">
                <i class="fa fa-users nav-icon"></i>
                <p>Divisi</p>
            </a>
            <a
                href="{{ route('admin.campus.index') }}"
                class="nav-link">
                <i class="far fa-building nav-icon"></i>
                <p>Kampus</p>
            </a>
        </li>
    </ul>
</li>
<!-- <li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-calendar-minus-o"></i>
        <p>
            Hari Libur
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">2</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="{{ route('admin.holidays.create') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Tambah Hari Libur</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="{{ route('admin.holidays.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Hari Libur</p>
            </a>
        </li>
    </ul>
</li> -->