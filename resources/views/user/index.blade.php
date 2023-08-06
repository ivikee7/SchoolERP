@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Users')
@section('content')
    @can('user_show')
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
                                    <h3 class="card-title">Users</h3>
                                    <div class="card-title float-right">
                                        <a href="{{ route('user.create') }}">
                                            <input type="button" value="Add New" class="btn btn-sm btn-success">
                                        </a>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-sm table-bordered table-striped display" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Full Name</th>
                                                <th>Role</th>
                                                <th>Gender</th>
                                                <th>Father Name</th>
                                                <th>Mother Name</th>
                                                <th>School Email</th>
                                                <th>Remarks</th>
                                                <th>Contact Number</th>
                                                <th>Transport</th>
                                                <th>Mother Tongue</th>
                                                <th>Date of Birth</th>
                                                <th>Address</th>
                                                <th>Created By</th>
                                                <th>Updated By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot style="display: table-row-group;">
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                        </tbody>
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
                $('table').DataTable({
                    dom: 'lBfrtip',
                    lengthMenu: [
                        [5, 10, 25, 50, 100, -1],
                        ['5 rows', '10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
                    ],
                    buttons: [
                        'pageLength',
                        {
                            extend: 'copy',
                            exportOptions: {
                                columns: [":visible"]
                            }
                        },
                        {
                            extend: 'csv',
                            exportOptions: {
                                columns: [":visible"]
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: [":visible"]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [":visible"]
                            }
                        },
                        {
                            extend: 'colvis',
                            text: "Columns",
                            postfixButtons: ['colvisRestore']
                        }
                    ],
                    order: [
                        [0, "desc"]
                    ],
                    responsive: true,
                    lengthChange: false,
                    autoWidth: false,
                    processing: "<i class='fas fa-2x fa-sync-alt fa-spin'></i>",
                    serverSide: true,
                    language: {
                        processing: "<i class='fas fa-2x fa-sync-alt fa-spin'></i>",
                    },
                    ajax: '{{ route('user.index') }}',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'full_name',
                            name: 'full_name'
                        },
                        {
                            data: 'role_name',
                            name: 'role_name'
                        },
                        {
                            data: 'gender',
                            name: 'gender'
                        },
                        {
                            data: 'father_name',
                            name: 'father_name'
                        },
                        {
                            data: 'mother_name',
                            name: 'mother_name'
                        },
                        {
                            data: 'email_alternate',
                            name: 'email_alternate',
                            visible: false
                        },
                        {
                            data: 'remarks',
                            name: 'remarks',
                            visible: false
                        },
                        {
                            data: 'contact_number',
                            name: 'contact_number'
                        },
                        {
                            data: 'transport',
                            name: 'transport',
                            visible: false
                        },
                        {
                            data: 'mother_tongue',
                            name: 'mother_tongue',
                            visible: false
                        },
                        {
                            data: 'date_of_birth',
                            name: 'date_of_birth',
                            visible: false
                        },
                        {
                            data: 'address',
                            name: 'address',
                            visible: false
                        },
                        {
                            data: 'created_by',
                            name: 'created_by',
                            searchable: false,
                            visible: false
                        },
                        {
                            data: 'updated_by',
                            name: 'updated_by',
                            searchable: false,
                            visible: false
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            print: false
                            // searchable: false,
                            // orderable: false
                        }
                    ],
                    initComplete: function(settings, json) {
                        this.api().columns([0, 1, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]).every(function() {
                            var column = this;
                            var input = document.createElement("input");
                            input.className = "form-control form-control-sm";
                            $(input).appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                    column.search(val ? val : '', true, false).draw();
                                });
                        });
                        this.api().columns([2, 3, 15]).every(function() {
                            var column = this;
                            // Generate select
                            var select = $(
                                    '<select class="form-control form-control-sm"><option value="">Show All</option></select>'
                                    )
                                .appendTo($(column.footer()).empty())
                                // Search when selection is changed
                                .on('change', function() {
                                    var val = $(this).val();
                                    column.search(this.value ? '^' + this.value + '$' : '',
                                        true, false).draw();
                                });
                            // Capture the data from the JSON to populate the select boxes with all the options
                            var extraData = (function(i) {
                                switch (i) {
                                    case 2:
                                        return json.allRoles;
                                    case 3:
                                        return json.allGenders;
                                    case 15:
                                        return json.allStatus;
                                }
                            })(column.index());
                            // Draw select options
                            extraData.forEach(function(d) {
                                if (column.search() === d) {
                                    select.append('<option value="' + d +
                                        '" selected="selected">' + d + '</option>')
                                } else {
                                    select.append('<option value="' + d + '">' + d +
                                        '</option>')
                                }
                            });
                        });
                    },
                });
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
