<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('index') }}" class="brand-link">
        <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }} Logo" class="brand-image img-circle elevation-3 "
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth()->user()->first_name . ' ' . Auth()->user()->last_name }}
                    | {{ Auth()->user()->id }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
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
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-regular fa-users"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Search</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create</p>
                                </a>
                            </li>
                        @endcan
                        {{-- {{ Attendance Menu }} --}}
                        @can('attendance_access')
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-id-badge"></i>
                                    <p>
                                        Attendance
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('user.attendance.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Attendance</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('user.attendance.report.daily') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Report Daily</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('user.attendance.report.monthly') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Report Monthly</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        {{-- {{ Leave Management }} --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-portrait"></i>
                                <p>
                                    Leave Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('user.attendance.leave.management.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Preview</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('user.attendance.leave.management.edit') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Edit</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                {{-- Enquiry Menu --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-regular fa-user-graduate"></i>
                        <p>
                            Student
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('student_access')
                            <li class="nav-item">
                                <a href="{{ route('student.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Search</p>
                                </a>
                            </li>
                        @endcan
                        @can('registration_access')
                            <li class="nav-item">
                                <a href="{{ route('registration.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Registration</p>
                                </a>
                            </li>
                        @endcan
                        @can('enquiry_access')
                            <li class="nav-item">
                                <a href="{{ route('enquiry.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Enquiry</p>
                                </a>
                            </li>
                        @endcan
                        @can('enquiry_access')
                            <li class="nav-item">
                                <a href="{{ route('website.enquiry.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Website Enquiry</p>
                                </a>
                            </li>
                        @endcan
                        @can('admission_edit')
                            <li class="nav-item">
                                <a href="{{ route('student.change.class.section.edit') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Change Class Section</p>
                                </a>
                            </li>
                        @endcan
                        @can('student_access')
                            <li class="nav-item">
                                <a href="{{ route('student.class.students') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Class Students</p>
                                </a>
                            </li>
                        @endcan
                        @can('student_access')
                            <li class="nav-item">
                                <a href="{{ route('class.student.strength.ajax') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Class Students Strength</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                {{-- Message --}}
                @can('student_access')
                    <li class="nav-item">
                        <a href="{{ route('message.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Message</p>
                        </a>
                    </li>
                @endcan

                {{-- Inventory Management --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            Inventory Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('inventry.library.book.render') }}" class="nav-link">
                                <i class="nav-icon fas fa-books"></i>
                                <p>Library</p>
                            </a>
                        </li>
                        {{-- Product --}}
                        <li class="nav-item">
                            <a href="{{ route('inventory.product.render') }}" class="nav-link">
                                <i class="nav-icon fas fa-books"></i>
                                <p>Product</p>
                            </a>
                        </li>
                        {{-- Sale --}}
                        <li class="nav-item">
                            <a href="{{ route('inventory.product.sale.render') }}" class="nav-link">
                                <i class="nav-icon fas fa-books"></i>
                                <p>Sale</p>
                            </a>
                        </li>
                        {{-- Sale --}}
                        <li class="nav-item">
                            <a href="{{ route('inventory.product.sale.getStudents') }}" class="nav-link">
                                <i class="nav-icon fas fa-books"></i>
                                <p>Students</p>
                            </a>
                        </li>
                    </ul>
                </li>

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

                {{-- Substitution --}}
                @can('substitution_access')
                    <li class="nav-item">
                        <a href="{{ route('substitution') }}" wire:navigate
                            class="nav-link {{ Request::is('substitution*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Substitution</p>
                        </a>
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

                {{-- Google Workspace --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-google"></i>
                        <p>
                            Google Workspace
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    @can('role_access')
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    {{--                                <i class="nav-icon fas fa-regular fa-user-tag"></i> --}}
                                    <i class="nav-icon fab fa-google"></i>
                                    <p>
                                        Google Admin
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('google.workspace.admin.listUser') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Users</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('gsuite.users.create.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Bulk users create</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('gsuite.users.update.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Bulk users update</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endcan
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users-class"></i>
                                <p>
                                    Classroom
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('google.workspace.classroom.listCourses') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Classes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>
                                    Gmail
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inbox</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                {{-- {{ Role & Permission Menu }} --}}
                @can('role_access')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-regular fa-user-tag"></i>
                            <p>
                                Permissions Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('permission.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user_permission.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Users Permissions</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
