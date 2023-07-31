@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Students class strength')
@section('content')
    @can('student_access')
        <div class="content-wrapper overlay">
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
                                    <h3 class="card-title">Students</h3>
                                    <div class="card-title float-right">
                                        <a href="{{ route('student.create') }}">
                                            <input type="button" value="Add New" class="btn btn-sm btn-primary">
                                        </a>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead class="text-center">
                                            <tr>
                                                <th rowspan="2" class="align-middle">Class</th>
                                                <th colspan="4">Sections</th>
                                                <th rowspan="2" class="align-middle">Class Strength</th>
                                            </tr>
                                            <tr>
                                                <th>Harmony</th>
                                                <th>Empathy</th>
                                                <th>Integrity</th>
                                                <th>Courage</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5" class="text-right">Total Strength</th>
                                                <th id="total-strength"></th>
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var table = $('table').DataTable({
                    dom: 'lB',
                    lengthMenu: [
                        [-1],
                    ],
                    buttons: [{
                            extend: 'copy',
                            footer: true
                        },
                        {
                            extend: 'csv',
                            footer: true
                        },
                        {
                            extend: 'excel',
                            footer: true
                        },
                        {
                            extend: 'print',
                            footer: true,
                            customize: function(win) {
                                $(win.document.body).find('table').addClass('display h3 text-center');
                                $(win.document.body).find('tfoot').attr('colspan', 5);
                            }
                        }
                    ],
                    order: [
                        [0, "asc"]
                    ],
                    lengthChange: false,
                    autoWidth: false,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    language: {
                        processing: "<i class='fas fa-2x fa-sync-alt fa-spin'></i>",
                    },
                    ajax: '{{ route('class.student.strength.ajax') }}',
                    columns: [{
                            data: 'class_name',
                            name: 'class_name',
                            searchable: false,
                            orderable: false,
                        },
                        {
                            data: 'harmony',
                            name: 'harmony',
                            searchable: false,
                            orderable: false,
                        },
                        {
                            data: 'empathy',
                            name: 'empathy',
                            searchable: false,
                            orderable: false,
                        },
                        {
                            data: 'integrity',
                            name: 'integrity',
                            searchable: false,
                            orderable: false,
                        },
                        {
                            data: 'courage',
                            name: 'courage',
                            searchable: false,
                            orderable: false,
                        },
                        {
                            data: 'class_strength',
                            name: 'class_strength',
                            searchable: false,
                            orderable: false,
                        }
                    ]
                });

                table.on('draw', function() {
                    var response = table.ajax.json();
                    $("#total-strength").append(response.total);
                })

                $(".dataTables_filter, .dataTables_paginate").addClass("d-md-inline float-md-right");
                $(".dataTables_info").addClass("d-md-inline float-md-left");
            });
        </script>
    @endcan
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
