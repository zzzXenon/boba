<nav class="app-header navbar navbar-expand" style="background: #E4E7E8; box-shadow: 0px 6px 8px rgba(0, 111, 255, 0.25);">   
     <div class="container-fluid">
        <!-- Sidebar toggle button -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>

        <!-- Navbar menu on the right -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- Placeholder User Image -->
                    <img src="{{ asset('img/wairor.png') }}" class="user-image shadow rounded-circle" style="width: 35px; height: 35px;" alt="User Image">
                    <span class="d-none d-md-inline">Mario Agustin Sijabat</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="userDropdown">
                    <li class="user-header text-center">
                        <img src="{{ asset('img/wairor.png') }}" class="user-image shadow rounded-circle mb-3" style="width: 80px; height: 80px;" alt="User Image">
                        <p>
                            <strong>Mario Agustin Sijabat</strong>
                            <small>Member since -</small>
                        </p>
                    </li>
                    <li class="user-footer d-flex justify-content-between">
                        <a href="#" class="btn btn-outline-primary">Profile</a>
                        <a href="#" class="btn btn-outline-danger">Sign out</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
