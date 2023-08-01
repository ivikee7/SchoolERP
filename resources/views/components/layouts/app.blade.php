<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? env('APP_NAME') }}</title>

    {{-- Google Font: Source Sans Pro --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/pro/v5.10.0/css/all.css') }}">
    {{-- Ionicons --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- iCheck for checkboxes and radio inputs --}}
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

<body>
    {{ $slot }}

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
        $('.form-prevent-multiple-submits').on('submit', function () {
            $('.button-prevent-multiple-submits').attr('disabled', true);
        });

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
