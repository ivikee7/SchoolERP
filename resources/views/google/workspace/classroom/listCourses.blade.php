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
                                <h3 class="card-title">Courses</h3>
                                <div class="card-title float-right">
                                    @can('classroom_class_create')
                                        <a href="{{ route('google.workspace.classroom.course.create') }}">
                                            <input type="button" value="Create Course" class="btn btn-sm btn-success">
                                        </a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-striped">
                                    {{-- @dd($courses); --}}
                                    @foreach ($courses as $course)
                                        <tbody class="table table-responsive" style="display: table-row-group;">
                                            <tr>
                                                <th>
                                                    <div class="row">
                                                        <a class="col col-sm-8 col-xs-12  border ml-2 rounded bg-primary text-center"
                                                            href="{{ route('google.workspace.classroom.course', $course->id) }}">{{ $course->name }}

                                                        </a>
                                                        <div class="col col-sm-2 col-xs-12 float-right">
                                                            <a href="{{ $course->alternateLink }}" target=”_blank”>
                                                                <span>
                                                                    <img class="rounded ml-1 mr-1"
                                                                        style="max-height: 1.5rem;"
                                                                        src="https://lh3.googleusercontent.com/EUHFjMpMj-UPEu6jfEEP8TPV7QxQerc-n_qulHi3MFPnK_63i5ldHApJsutq7wXqNmN9V2rmk9swsQ9I0eddAv77HIO4uv6gKt8haNAMqjiM9pqNu9w"
                                                                        alt="Classroom"></span>
                                                            </a>
                                                            <a href="{{ $course->teacherFolder['alternateLink'] }}"
                                                                target=”_blank”>
                                                                <span>
                                                                    <img class="rounded ml-1 mr-1"
                                                                        style="max-height: 1.5rem;"
                                                                        src="https://lh3.googleusercontent.com/AGsg9hOAylBkWuFrfSgOt8psYWcr3b-vZcmIVk0ocwx7KAVSu--tg1ZIAUSL7nAbORTHI5eZaweHYVPMJu5ac8Xw7GP_WiCs1w60=h120">
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <p class="blockquote-footer">Course Group Email<a
                                                            href="mailto: {{ $course->courseGroupEmail }}">
                                                            <em>{{ $course->courseGroupEmail }}</em></a>
                                                    </p>
                                                    <p class="blockquote-footer">Teacher Group Email<a
                                                            href="mailto: {{ $course->teacherGroupEmail }}" target=”_blank”>
                                                            <em>{{ $course->teacherGroupEmail }}</em></a>
                                                    </p>
                                                    <p class="blockquote-footer" target=”_blank”>
                                                        <em>{{ $course->description }}</em>
                                                    </p>

                                                </th>
                                                <th>
                                                    @can('classroom_class_create')
                                                        <a href="{{ route('google.workspace.classroom.course.delete', $course->id) }}"
                                                            target=”_blank”>
                                                            <button class="btn btn-sm btn-danger rounded">Delete</button>
                                                        </a>
                                                    @endcan
                                                    OwnerId: {{ $course->ownerId }}

                                                </th>
                                            </tr>
                                        </tbody>
                                    @endforeach
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
