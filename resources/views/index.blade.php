@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Home')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h5 class="text-primary text-center">
                                    <b>{{ Auth()->user()->id .' | ' .Auth()->user()->first_name .' ' .Auth()->user()->middle_name .' ' .Auth()->user()->last_name .' | ' .Auth()->user()->roles->pluck('name')[0] }}</b>
                                </h5>
                                <hr>
                                @if (date('Y-m-d', strtotime(Auth::user()->date_of_birth)) == date('Y-m-d', strtotime(now())))
                                    <p class="h1 bg-warning text-center p-3 rounded"><span class="text-secondary">
                                            <b class="text-white">{{ strtoupper('!! Happy birthday !!') }}</b>
                                        </span>
                                    </p>
                                @endif
                                <hr>
                                <!-- Info boxes -->
                                <div class="row">
                                    @foreach ($attendance_details as $attendance)
                                        <div class="col-12 col-sm-6 col-md-3">
                                            <div class="info-box">
                                                <div class="info-box-content">
                                                    <span
                                                        class="info-box-text m-0 bg-info rounded text-center">{{ json_decode($attendance)->role }}</span>
                                                    <div class="row pl-2 pr-2">
                                                        <span class="info-box-number col col-xl-6 text-primary rounded">
                                                            Present: - {{ json_decode($attendance)->present }}
                                                        </span>
                                                        <span class="info-box-number col col-xl-6 text-secondary rounded">
                                                            Absent: -
                                                            {{ json_decode($attendance)->total - json_decode($attendance)->present }}
                                                        </span>
                                                    </div>
                                                </div><!-- /.info-box-content -->
                                            </div><!-- /.info-box -->
                                        </div><!-- /.col -->
                                    @endforeach
                                </div><!-- /.row -->
                                <hr>
                            </div>
                        </div><!-- /.card -->
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-primary text-center">
                                            <b>Employees Birthday</b>
                                        </h5>
                                        @foreach ($employee_birthdays as $employee_birthday)
                                            <h6 class="m-1">
                                                <hr>
                                                {{ $employee_birthday->id }}
                                                | {{ $employee_birthday->first_name }}
                                                {{ $employee_birthday->middle_name }}
                                                {{ $employee_birthday->last_name }}
                                                | {{ $employee_birthday->role_name }}
                                                | {{ date('Y-M-d', strtotime($employee_birthday->date_of_birth)) }}
                                                | {{ date('Y', strtotime(now())) - $employee_birthday->year }} Years
                                            </h6>
                                        @endforeach
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-primary text-center">
                                            <b>Students Birthday</b>
                                        </h5>
                                        @foreach ($student_birthdays as $student_birthday)
                                            <h6 class="m-1">
                                                <hr>
                                                {{ $student_birthday->id }}
                                                | {{ $student_birthday->first_name }} {{ $student_birthday->middle_name }}
                                                {{ $student_birthday->last_name }}
                                                | {{ date('Y-M-d', strtotime($student_birthday->date_of_birth)) }}
                                                | {{ date('Y', strtotime(now())) - $student_birthday->year }} Years
                                            </h6>
                                        @endforeach
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection()

@push('styles')
    {{-- DataTables --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@push('scripts')
    {{-- DataTables  & Plugins --}}
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    {{-- Custom --}}
    <script src="{{ asset('custom.js') }}"></script>
@endpush
