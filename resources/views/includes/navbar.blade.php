<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"
                ><i class="fas fa-bars"></i
            ></a>
        </li>

    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown user user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                {{-- @if (Auth::user()->employee)
                <img src="/storage/{{ Auth::user()->employee->photo }}" class="user-image img-circle elevation-2" alt="User Image">
                @else
                <img src="" class="user-image img-circle elevation-2" alt="User Image">
                @endif --}}
                <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-primary">
                {{-- @if (Auth::user()->employee)
                <img  src="/storage/employee_photos/{{ Auth::user()->employee->photo }}"
                class="img-circle elevation-2" alt="User Image">
                @else
                <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                @endif --}}
        
                <p>
                    {{ Auth::user()->name }}
                    @if ( Auth::user()->employee )
                    - {{ Auth::user()->employee->division->name }}, {{ Auth::user()->employee->campus->name }}
                    @endif 
                </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body text-center">
                    @if ( Auth::user()->employee )
                    <small>Berakhir pada {{ \Carbon\Carbon::parse(Auth::user()->employee->intern_period)->format('d F Y') }}
                    </small>
                    @endif 
                <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                <div class="pull-left">
                    @if ( Auth::user()->employee )
                    <a href="{{ route('employee.profile') }}" class="btn btn-default btn-flat">Profile</a>
                    @else
                    <a href="{{ route('admin.reset-password') }}" class="btn btn-default btn-flat">Change Password</a>
                    @endif
                </div>
                <div class="pull-right">
                    <a href="{{ route('logout') }}" 
                    class="btn btn-default btn-flat"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                    >Sign out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>