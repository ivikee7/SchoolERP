@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Permission')
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
                            <div class="card-header">
                                <h3 class="card-title">Course</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('google.workspace.classroom.listCourses') }}">
                                        <input type="button" value="Courses" class="btn btn-sm btn-success">
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-striped">
                                    {{-- @dd($course); --}}
                                    <tbody style="display: table-row-group;">
                                        <tr>
                                            <th>
                                                <a href="{{ $course->alternateLink }}">{{ $course->name }}</a><br>
                                                <p class="blockquote-footer">Course Group Email<a
                                                        href="mailto: {{ $course->courseGroupEmail }}">
                                                        <em>{{ $course->courseGroupEmail }}</em></a>
                                                </p>
                                                <p class="blockquote-footer">Teacher Group Email<a
                                                        href="mailto: {{ $course->teacherGroupEmail }}">
                                                        <em>{{ $course->teacherGroupEmail }}</em></a>
                                                </p>
                                                <p class="blockquote-footer"><a
                                                        href="{{ $course->teacherFolder['alternateLink'] }}">
                                                        <em>Drive Folder</em></a>
                                                </p>
                                                <p class="blockquote-footer"><em>{{ $course->description }}</em></p>

                                            </th>
                                            <th>
                                                Id: <a
                                                    href="{{ route('google.workspace.classroom.course', $course->id) }}">{{ $course->id }}</a>
                                                <br>
                                                OwnerId: {{ $course->ownerId }}
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
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
    {{-- Custom --}}
    <script src="{{ asset('custom.js') }}"></script>
@endpush
