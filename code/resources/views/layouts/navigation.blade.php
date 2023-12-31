<!-- partial:../../partials/_sidebar.html -->
@if (Auth::guard('admin')->check())
<?php $roles=App\Http\Controllers\URolesController::getrolesAdmin(); ?>
@else
<?php $roles=App\Http\Controllers\URolesController::getroles(); ?>
@endif


<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        @if(Auth::getDefaultDriver())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @endif

        @if(Auth::guard('admin')->check())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @endif

        @if (Auth::guard('admin')->check())
        <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
            <span class="menu-title">AE</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('AEAdmin') }}">Request Form</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('AETable') }}">Request Form Table</a></li>
            </ul>
        </div>
        </li>
        @endif

        @if ($roles->contains('role_id',2))
        <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
            <span class="menu-title">AE</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('user_request_rate') }}">Request Form</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('user_ae_table') }}">Request Form Table</a></li>
            </ul>
        </div>
        </li>
        @endif

        @if (Auth::guard('admin')->check())
        <li class="nav-item">
        <a class="nav-link" href="{{ route('pricing') }}">
            <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
            <span class="menu-title">Pricing</span>
        </a>
        </li>
        @endif

        @if ($roles->contains('role_id',3))
        <li class="nav-item">
        <a class="nav-link" href="{{ route('user_pricing') }}">
            <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
            <span class="menu-title">Pricing</span>
        </a>
        </li>
        @endif

        @if($roles->contains('role_id',3))
        <li class="nav-item">
        <a class="nav-link" href="{{ route('user_billing') }}">
            <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
            <span class="menu-title">All Detalis</span>
        </a>
        </li>
        @endif

        @if(Auth::guard('admin')->check())
        <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <span class="icon-bg"><i class="mdi mdi-lock menu-icon"></i></span>
            <span class="menu-title">User Manage</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('user') }}">Users</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('role') }}">Roles</a></li>
            </ul>
        </div>   
        </li>
        @endif
        {{-- <li class="nav-item documentation-link">
        <a class="nav-link" href="" target="_blank">
            <span class="icon-bg">
            <i class="mdi mdi-file-document-box menu-icon"></i>
            </span>
            <span class="menu-title">Documentation</span>
        </a>
        </li> --}}
        <li class="nav-item sidebar-user-actions">
        <div class="user-details">
            <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="d-flex align-items-center">
                <div class="sidebar-profile-img">
                    <img src="../../assets/images/faces/profile.png" alt="image">
                </div>
                <div class="sidebar-profile-text">
                    <p class="mb-1">
                        @if (Auth::guard('admin')->check())
                        {{Auth::guard('admin')->user()->name}}
                      @else
                        {{Auth::user()->name}}
                      @endif
                    </p>
                </div>
                </div>
            </div>
            {{-- <div class="badge badge-danger"></div> --}}
            </div>
        </div>
        </li>
        <li class="nav-item sidebar-user-actions">
        <div class="sidebar-user-menu">
            <a href="#" class="nav-link"><i class="mdi mdi-settings menu-icon"></i>
            <span class="menu-title">Settings</span>
            </a>
        </div>
        </li>
        <li class="nav-item sidebar-user-actions">
        <div class="sidebar-user-menu">
            <a href="#" class="nav-link"><i class="mdi mdi-speedometer menu-icon"></i>
            <span class="menu-title">Take Tour</span></a>
        </div>
        </li>
        @if(Auth::guard('admin')->check())
        <li class="nav-item sidebar-user-actions">
        <div class="sidebar-user-menu">
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mdi mdi-logout menu-icon"></i>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            <span class="menu-title">Log Out</span></a>
        </div>
        </li>
        @else
        <li class="nav-item sidebar-user-actions">
            <div class="sidebar-user-menu">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mdi mdi-logout menu-icon"></i>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                <span class="menu-title">Log Out</span></a>
        @endif
    </ul>
</nav>
    <!-- partial -->