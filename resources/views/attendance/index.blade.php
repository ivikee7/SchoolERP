@extends('master')
@section('title', auth()->user()->first_name .' '. auth()->user()->last_name . ' | Attendance | ' . Carbon\Carbon::create($date)->isoFormat('D MMMM Y'))
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
        <!-- Main content -->
        <section class="content attendance">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Attendance</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('user.attendance.report.daily') }}">
                                        <input type="button" value="Daily Report" class="btn btn-sm btn-warning">
                                    </a>
                                    <a href="{{ route('user.attendance.report.monthly') }}">
                                        <input type="button" value="Monthly Report" class="btn btn-sm btn-warning">
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>In</th>
                                            <th>Out</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($users ?? '')
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->user_id }}</td>
                                                    <td>{{ $user->user_name }}</td>
                                                    <td>{{ $user->role }}</td>
                                                    <td>
                                                        @if ($user->in ?? '')
                                                            {{ date('H:i', strtotime($user->in)) }}
                                                        @endif
                                                        @can('attendance_create')
                                                            {{-- Auth()->user()->hasAllPermissions('attendance_create') --}}
                                                            @if (empty($user->in))
                                                                <button type="button" value="{{ $user->user_id }}"
                                                                    class="btn btn-sm btn-success btn-block btn-mark-attendance">
                                                                    In
                                                                </button>
                                                            @endif
                                                        @endcan

                                                    </td>
                                                    <td>
                                                        @if ($user->out ?? '')
                                                            {{ date('H:i', strtotime($user->out)) }}
                                                        @endif
                                                        @can('attendance_create')
                                                            @if (empty($user->out))
                                                                <button type="button" value="{{ $user->user_id }}"
                                                                    data="{{ $user->user_id }}"
                                                                    class="btn btn-sm btn-warning btn-block btn-mark-attendance">
                                                                    Out
                                                                </button>
                                                            @endif
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>In</th>
                                            <th>Out</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "processing": "<i class='fas fa-2x fa-sync-alt fa-spin'></i>",
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All'],
                ],
                "buttons": ["pageLength", "copy", "csv", "excel",
                    {
                        extend: "print",
                    },
                    {
                        extend: 'colvis',
                        text: "Columns",
                        postfixButtons: ['colvisRestore']
                    }
                ],
            });
            $("#example1").DataTable().buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $("#example1_wrapper .dt-buttons button").addClass('btn-sm');
        });
    </script>
    {{-- Custom --}}
    <script src="{{ asset('custom.js') }}"></script>
@endpush
