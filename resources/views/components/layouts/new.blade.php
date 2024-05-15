<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    @livewireStyles
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>

<body class="hold-transition layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <x-layouts.partials.navbar />
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <x-layouts.partials.sidebar />


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            {{ $slot }}
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <x-layouts.partials.control-sidebar />
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <x-layouts.partials.footer />
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @livewireScripts
    @vite(['resources/js/app.js'])
    @stack('scripts')

    @once
        <script type="module">
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            document.addEventListener('livewire:initialized', () => {
                Livewire.on('swal', (event) => {
                    Toast.fire(event[0]);
                });
            });
        </script>
    @endonce

    @once
        <script type="module">
            $(document).ready(function() {
                $('input').attr('autocomplete', 'off');
            });
        </script>
    @endonce

    @once

        <script type="module">
            /** On submit of the form disable the submit button */
            jQuery('.form-prevent-multiple-submits').on('submit', function() {
                $('.button-prevent-multiple-submits').attr('disabled', true);
            });
        </script>
    @endonce

</body>

</html>
