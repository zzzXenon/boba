<aside class="app-sidebar bg-light shadow" style="width: 250px; position: fixed; height: 100vh; transition: transform 0.3s ease;">
    <div class="sidebar-brand text-center py-3">
        <a href="#" class="brand-link d-flex align-items-center justify-content-center">
            <img src="{{ asset('img/del.png') }}" alt="SIS" class="brand-image shadow rounded-circle" style="width: 50px; height: 50px;">
            <span class="brand-text fw-light ms-2 text-primary">SIS</span>
        </a>
    </div>
    <div class="sidebar-wrapper px-3">
        <nav class="mt-4">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="/parent/informationPage" class="nav-link {{ request()->is('parent/informationPage') ? 'active bg-primary text-white' : '' }}">
                        <i class="nav-icon bi bi-person-lines-fill"></i>
                        <span class="ms-2">Information</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/parent/pelanggaranPage" class="nav-link {{ request()->is('parent/pelanggaranPage') ? 'active bg-primary text-white' : '' }}">
                        <i class="nav-icon bi bi-exclamation-triangle-fill"></i>
                        <span class="ms-2">Pelanggaran</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
