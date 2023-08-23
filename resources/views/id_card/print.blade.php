<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $user->id . ' | ' . $user->first_name . ' ' . $user->last_name }} | {{ config('app.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/pro/v5.10.0/css/all.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice border" style="border-radius: 10px; width:204px; height:324px; font-size:50%;">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <img src="{{ asset('logo.png') }}" class="img-fluid" style="max-width: 10%;" alt="Logo">
                        <img src="{{ asset('logo-name.png') }}" class="img-fluid"
                            style="max-width: 25%; margin-left: 5%; margin-right: 13%;" alt="Logo Name">
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col text-center" style="line-height: 115%;">
                    <strong class="text-danger">Affiliated to C.B.S.E Affi. No. 330653</strong><br>
                    <strong>Bhogipur Near Sahpur, Jaganpura, Patna - 804453</strong><br>
                    <strong>Helpline No. +91-8873002602/03/2009</strong><br>
                    <strong>Session - 2023-24</strong><br>
                </div>
            </div>
            <!-- /.row -->
            <div class="col" style="background-color: #006515; padding-top:0.5em;">
            </div>
            <!-- /.row -->
            <!-- Table row -->
            <div class="row invoice-info">
                <div class="col col-12 text-center mt-2" style="font-size:150%;">
                    <img src="{{ asset('logo.png') }}" class="rounded mx-auto border border-secondry" alt="Image"
                        style="max-width: 40%; padding: 0.2em;">
                </div>
                <div class="col col-12 text-center" style="font-size:150%;">
                    <strong class="text-center">{{ $user->first_name . ' ' . $user->last_name }}</strong><br>
                </div>
            </div>
            <!-- /.row -->
            <div class="col text-white" style="background-color: #006515; padding-top:none;">
                <div class="row">
                    <div class="col-6">CONV: Transport</div>
                    <div class="col-6 text-right">Principal Sign</div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
