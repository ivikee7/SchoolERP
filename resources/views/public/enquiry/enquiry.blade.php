<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Public Enquiry</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    {{-- logos --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">

            <div class="text-center">
                <hr>
                <a href="{{ asset('/') }}" class="h1" style="color: #ae54ff;"><b>ENQUIRY</b></a>
                <hr>
            </div>

            <div class="card-body">
                <form action="{{ route('api.public.enquiry') }}" method="post">
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    @csrf
                    <div class="input-group mb-3">
                        <input type="full_name" class="form-control" name="full_name" placeholder="Full Name"
                            value="{{ old('full_name') }}">
                    </div>
                    <span class="text-danger">
                        @error('full_name')
                            {{ $message }}
                        @enderror
                    </span>

                    <div class="input-group mb-3">
                        <input type="contact_number" class="form-control" name="contact_number"
                            placeholder="Mobile Number" value="{{ old('contact_number') }}">
                    </div>
                    <span class="text-danger">
                        @error('contact_number')
                            {{ $message }}
                        @enderror
                    </span>

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email ID"
                            value="{{ old('email') }}">
                    </div>
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                    <!-- textarea -->
                    <div class="input-group mb-3">
                        <textarea class="form-control" rows="3" name="message" placeholder="Message" value="{{ old('message') }}"></textarea>
                    </div>
                    <span class="text-danger">
                        @error('message')
                            {{ $message }}
                        @enderror
                    </span>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-block text-white"
                                style="background-color: rgb(255, 42, 110);">Submit</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
