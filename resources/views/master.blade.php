<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title') </title>
    {{-- Google Font: Source Sans Pro --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/pro/v5.10.0/css/all.css') }}">
    {{-- Ionicons --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{--    iCheck for checkboxes and radio inputs --}}
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    {{-- Toastr --}}
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    {{-- logos --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    {{-- Theme style --}}
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    @stack('styles')

</head>

<body
    class=" @if (!empty(json_decode(Auth()->user()->settings, true)) && !json_decode(Auth()->user()->settings, true)['body'] == '') {{ json_decode(Auth()->user()->settings, true)['body'] }} @else layout-fixed layout-navbar-fixed layout-footer-fixed text-sm @endif">
    <div class="wrapper">
        {{-- Preloader --}}
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('logo.png') }}" alt="{{ config('app.name') }} Logo"
                height="60" width="60">
        </div>
        {{-- Navbar --}}
        <nav
            class=" @if (
                !empty(json_decode(Auth()->user()->settings, true)) &&
                    !json_decode(Auth()->user()->settings, true)['body_wrapper_nav'] == '') {{ json_decode(Auth()->user()->settings, true)['body_wrapper_nav'] }} @else main-header navbar navbar-expand navbar-white navbar-light @endif">
            {{-- Left navbar links --}}
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('index') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ asset('contacts') }}" class="nav-link">Contact</a>
                </li>
            </ul>

            {{-- Right navbar links --}}
            <ul class="navbar-nav ml-auto">
                {{-- Navbar Search --}}
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                {{-- Cart --}}
                @if (session()->get('cart'))
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">{{ '-' }}</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item text-center">
                                -
                            </a>
                        </div>
                    </li>
                @endif
                {{-- User manage it selt --}}
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-regular fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span
                            class="dropdown-header">{{ Auth()->user()->first_name . ' ' . Auth()->user()->last_name }}
                            | {{ Auth()->user()->id }}</span>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <i class="fas fa-regular fa-user-gear mr-2"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="" class="dropdown-item">
                            <i class="fas fa-solid fa-key mr-2"></i> Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-right-from-bracket mr-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        {{-- /.navbar --}}
        {{-- Main Sidebar Container --}}
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            {{-- Brand Logo --}}
            <a href="{{ route('index') }}" class="brand-link">
                <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}"
                    class="brand-image img-circle elevation-3 bg-white p-1">
                <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
            </a>

            {{-- Sidebar --}}
            <div class="sidebar">
                {{-- Sidebar user panel (optional) --}}
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                    <div class="image" style="">
                        <img src="@if (!empty(Auth()->user()->media_id)) {{ asset(\App\Models\Media::find(Auth()->user()->media_id)->select('media_path')->get()[0]->media_path) }} @elseif (Auth()->user()->gender == 'M') {{ asset('dist/img/male.png') }} @elseif (Auth()->user()->gender == 'F') {{ asset('dist/img/female.png') }} @elseif (Auth()->user()->gender == 'O') {{ asset('dist/img/boxed-bg.jpg') }} @endif"
                            class="img-circle elevation-2" style="" alt="User">
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

                {{-- Sidebar Menu --}}
                <nav class="mt-2">
                    <ul class=" @if (
                        !empty(json_decode(Auth()->user()->settings, true)) &&
                            !json_decode(Auth()->user()->settings, true)['body_wrapper_sidebar_nav_ul'] == '') {{ json_decode(Auth()->user()->settings, true)['body_wrapper_sidebar_nav_ul'] }}
                        @else
                        nav nav-pills nav-sidebar flex-column nav-compact nav-flat nav-lagect nav-child-indent @endif "
                        data-widget="treeview" role="menu" data-accordion="false">
                        {{-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library --}}
                        {{-- Users Menu --}}
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
                                    {{-- {{ Attendance Menu }} --}}
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-regular fa-clipboard-user"></i>
                                            <p>
                                                Attendance
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Daily Report</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Monthly Report</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                                {{-- {{ Leave Management }} --}}
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-regular fa-clipboard-user"></i>
                                        <p>
                                            Leave Management
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('user.attendance.leave.management.index') }}"
                                                class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Preview</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('user.attendance.leave.management.edit') }}"
                                                class="nav-link">
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
                        <li class="nav-item">
                            @can('student_access')
                            <li class="nav-item">
                                <a href="{{ route('message.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Message</p>
                                </a>
                            </li>
                        @endcan
                        </li>

                        {{-- {{ Attendance Menu }} --}}
                        @can('attendance_access')
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-regular fa-clipboard-user"></i>
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

                        {{-- Inventory Management --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                {{-- <i class="nav-icon fab fa-google"></i> --}}
                                <i class="nav-icon fas fa-inventory"></i>
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
                                                <a href="{{ route('google.workspace.admin.listUser') }}"
                                                    class="nav-link">
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
                                            <a href="{{ route('google.workspace.classroom.listCourses') }}"
                                                class="nav-link">
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
                {{-- /.sidebar-menu --}}
            </div>
            {{-- /.sidebar --}}
        </aside>
        @yield('content')
        {{-- Control Sidebar --}}
        <aside class="control-sidebar control-sidebar-dark">
            {{-- Control sidebar content goes here --}}
            {{-- <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div> --}}
        </aside>
        {{-- /.control-sidebar --}}
        {{-- Main Footer --}}
        <footer
            class=" @if (
                !empty(json_decode(Auth()->user()->settings, true)) &&
                    !json_decode(Auth()->user()->settings, true)['body_footer'] == '') {{ json_decode(Auth()->user()->settings, true)['body_footer'] }}
            @else
            main-footer @endif ">
            {{-- To the right --}}
            <div class="float-right d-none d-sm-inline">
                <b>Version</b> Development
            </div>
            {{-- Default to the left --}}
            <strong>Copyright &copy; 2022-{{ date('Y') }} <a
                    href="{{ asset('/') }}">{{ config('app.name') }}</a>.</strong>
            All
            rights reserved.
        </footer>
    </div>
    {{-- ./wrapper --}}
    {{-- REQUIRED SCRIPTS --}}

    {{-- jQuery --}}
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    {{-- Bootstrap 4 --}}
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- SweetAlert2 --}}
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- Toastr --}}
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    {{-- Select2 --}}
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    {{-- AdminLTE App --}}
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    {{-- AdminLTE for demo purposes --}}
    <script src="{{ asset('dist/js/controller.js') }}"></script>

    {{-- Custom --}}
    <script src="{{ asset('custom.js') }}"></script>

    @stack('scripts')

    <script>
        $(document).ready(function() {
            $('input').attr('autocomplete', 'off');
        });

        /** On submit of the form disable the submit button */
        $('.form-prevent-multiple-submits').on('submit', function() {
            $('.button-prevent-multiple-submits').attr('disabled', true);
        });

        /** Automatic focus search field  */
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#theme-style-save').on('click', function() {
                var body = ($('body').prop("classList").value).replace('control-sidebar-slide-open', '');
                var body_wrapper_nav = $('body .wrapper').children('nav:first').prop("classList").value;
                var body_wrapper_sidebar_nav_ul = $('.sidebar').children('nav:first').children('ul:first')
                    .prop("classList").value;
                var body_wrapper_sidebar_aside = $('.sidebar').parents('aside:first').prop("classList")
                    .value;
                var body_wrapper_sidebar_aside_div = $('body .wrapper').children('aside:first').children(
                    'div:first').prop("classList").value;
                var body_footer = $('footer').prop("classList").value;
                // 'div = $('.sidebar').parents('aside div:first').prop("classList").value;
                // 'brand = $('.sidebar').parents('aside a:first').prop("classList").value;
                // 'control_sidebar_content_css = $('.control_sidebar_content').css();
                var themeStyle = {
                    'theme': {
                        'body': body,
                        'body_wrapper_nav': body_wrapper_nav,
                        'body_wrapper_sidebar_nav_ul': body_wrapper_sidebar_nav_ul,
                        'body_wrapper_sidebar_aside': body_wrapper_sidebar_aside,
                        'body_wrapper_sidebar_aside_div': body_wrapper_sidebar_aside_div,
                        'body_footer': body_footer
                    }
                };

                console.log(themeStyle);
                $.ajax({
                    url: "{{ route('theme.setting') }}",
                    type: "get",
                    contentType: 'json',
                    data: themeStyle,
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr) {
                        console.log("Error found!");
                    }
                });
            });
        });
    </script>

    @if (!empty(!empty($status)))
        <script>
            $(function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                var status = "{{ $status }}";
                console.log(status.charAt(0).toUpperCase() + status.slice(1));
                $('.swalDefaultSuccess', function() {
                    Toast.fire({
                        icon: status,
                        title: "{{ $message }}"
                    })
                });
            });
        </script>
    @endif

</body>

</html>
