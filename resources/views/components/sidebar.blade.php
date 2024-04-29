<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- Brand Logo --}}
    <a href="{{ route('index') }}" class="brand-link">
        <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}"
            class="brand-image img-circle elevation-3 bg-white p-1">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-host-scrollbar-vertical-hidden">
        {{-- Sidebar user panel (optional) --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('profile') }}"
                    class="d-block">{{ Auth()->user()->first_name . ' ' . Auth()->user()->last_name }}
                    | {{ Auth()->user()->id }}</a>
            </div>
        </div>

        {{-- SidebarSearch Form --}}
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy" data-widget="treeview"
                role="menu" data-accordion="false">
                {{-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library --}}

                {{-- Store Management System --}}
                @can('store_management_system_access')
                    <li class="nav-item {{ Request::is('store-management-system*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('store-management-system*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-warehouse"></i>
                            <p>
                                Store Management System
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('store-management-system.seller') }}" wire:navigate
                                    class="nav-link {{ Request::is('store-management-system/seller*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book-reader"></i>
                                    <p>Seller</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                {{-- Appointment --}}
                @can('appointment_access')
                    <li class="nav-item">
                        <a href="{{ route('appointment') }}" wire:navigate
                            class="nav-link {{ Request::is('appointment*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Appointment</p>
                        </a>
                    </li>
                @endcan

                {{-- Appointment --}}
                @can('appointment_access')
                    <li class="nav-item">
                        <a href="{{ route('whatsapp') }}" wire:navigate
                            class="nav-link {{ Request::is('whatsapp*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>WhatsApp</p>
                        </a>
                    </li>
                @endcan

                {{-- User Daily Report --}}
                @can('user_daily_report_access')
                    <li class="nav-item">
                        <a href="{{ route('user-daily-report') }}" wire:navigate
                            class="nav-link {{ Request::is('user-daily-report*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>User Daily Report</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="sidebar-custom">
        <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
        <a href="#" class="btn btn-secondary hide-on-collapse pos-right">Help</a>
    </div>
    <!-- /.sidebar-custom -->
</aside>
