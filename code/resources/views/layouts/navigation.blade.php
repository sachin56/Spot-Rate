<!-- partial:../../partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
            <span class="menu-title">Dashboard</span>
        </a>
        </li>
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
        <li class="nav-item">
        <a class="nav-link" href="{{ route('pricing') }}">
            <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
            <span class="menu-title">Pricing</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('billing') }}">
            <span class="icon-bg"><i class="mdi mdi-format-list-bulleted menu-icon"></i></span>
            <span class="menu-title">Billing</span>
        </a>
        </li>
        {{-- <li class="nav-item">
        <a class="nav-link" href="../../pages/charts/chartjs.html">
            <span class="icon-bg"><i class="mdi mdi-chart-bar menu-icon"></i></span>
            <span class="menu-title">Charts</span>
        </a>
        </li> --}}

        <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <span class="icon-bg"><i class="mdi mdi-lock menu-icon"></i></span>
            <span class="menu-title">User Pages</span>
            <i class="menu-arrow"></i>
        </a>

        </li>
        <li class="nav-item documentation-link">
        <a class="nav-link" href="" target="_blank">
            <span class="icon-bg">
            <i class="mdi mdi-file-document-box menu-icon"></i>
            </span>
            <span class="menu-title">Documentation</span>
        </a>
        </li>
        <li class="nav-item sidebar-user-actions">
        <div class="user-details">
            <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="d-flex align-items-center">
                <div class="sidebar-profile-img">
                    <img src="../../assets/images/faces/face28.png" alt="image">
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
            <div class="badge badge-danger">3</div>
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
        <li class="nav-item sidebar-user-actions">
        <div class="sidebar-user-menu">
            <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mdi mdi-logout menu-icon"></i>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            <span class="menu-title">Log Out</span></a>
        </div>
        </li>
    </ul>
</nav>
    <!-- partial -->