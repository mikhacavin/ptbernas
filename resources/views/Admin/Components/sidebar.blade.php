<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="{{ asset('/assets/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-bar-chart-line"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/home" class="nav-link {{ request()->is('dashboard/home') ? 'active' : '' }}">
                        <i class="bi bi-house"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/about" class="nav-link {{ request()->is('dashboard/about') ? 'active' : '' }}">
                        <i class="bi bi-info-circle"></i>
                        <p>
                            About Us & Team
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/services"
                        class="nav-link {{ request()->is('dashboard/services') ? 'active' : '' }}">
                        <i class="bi bi-gift"></i>
                        <p>
                            Services
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/clients"
                        class="nav-link {{ request()->is('dashboard/clients') ? 'active' : '' }}">
                        <i class="bi bi-person-hearts"></i>
                        <p>
                            Clients & Works
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/galleries"
                        class="nav-link {{ request()->is('dashboard/galleries') ? 'active' : '' }}">
                        <i class="bi bi-journal-bookmark"></i>
                        <p>
                            Activity & Certification
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/testimonials"
                        class="nav-link {{ request()->is('dashboard/testimonials') ? 'active' : '' }}">
                        <i class="bi bi-chat-left-heart"></i>
                        <p>
                            Testimonials
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/blog" class="nav-link {{ request()->is('dashboard/blog') ? 'active' : '' }}">
                        <i class="bi bi-columns"></i>
                        <p>
                            Blog & Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/contact"
                        class="nav-link {{ request()->is('dashboard/contact') ? 'active' : '' }}">
                        <i class="bi bi-telephone-plus"></i>
                        <p>
                            Contact
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/header-footer"
                        class="nav-link {{ request()->is('dashboard/header-footer') ? 'active' : '' }}">
                        <i class="bi bi-view-stacked"></i>
                        <p>
                            Header & Footer
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/setting"
                        class="nav-link {{ request()->is('dashboard/setting') ? 'active' : '' }}">
                        <i class="bi bi-gear"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                        @csrf
                        @method('DELETE')
                        <button class="nav-link" type="submit">Logout</button>
                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
