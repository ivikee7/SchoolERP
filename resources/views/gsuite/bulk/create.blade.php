@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | G-Suite | Users create')
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
                                <div class="card-header">
                                    <div id="search-input">
                                        <input type="text" name="ids" id="ids" class="form-control form-control-sm"
                                               placeholder="ID's (Comma separated)"></input>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-sm table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>First Name [Required]</th>
                                            <th>Last Name [Required]</th>
                                            <th>Email Address [Required]</th>
                                            <th>Password [Required]</th>
                                            <th>Password Hash Function [UPLOAD ONLY]</th>
                                            <th>Org Unit Path [Required]</th>
                                            <th>New Primary Email [UPLOAD ONLY]</th>
                                            <th>Recovery Email</th>
                                            <th>Home Secondary Email</th>
                                            <th>Work Secondary Email</th>
                                            <th>Recovery Phone [MUST BE IN THE E.164 FORMAT]</th>
                                            <th>Work Phone</th>
                                            <th>Home Phone</th>
                                            <th>Mobile Phone</th>
                                            <th>Work Address</th>
                                            <th>Home Address</th>
                                            <th>Employee ID</th>
                                            <th>Employee Type</th>
                                            <th>Employee Title</th>
                                            <th>Manager Email</th>
                                            <th>Department</th>
                                            <th>Cost Center</th>
                                            <th>Building ID</th>
                                            <th>Floor Name</th>
                                            <th>Floor Section</th>
                                            <th>Change Password at Next Sign-In</th>
                                            <th>New Status [UPLOAD ONLY]</th>
                                            <th>Advanced Protection Program enrollment</th>
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
                                        <tbody></tbody>
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
            document.addEventListener('DOMContentLoaded', function () {
                var oTable = $('table').DataTable({
                    dom: 'lBfrtip',
                    lengthMenu: [
                        [5, 10, 25, 50, 100, -1],
                        ['5 rows', '10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
                    ],
                    buttons: [
                        'pageLength',
                        'copy',
                        'csv',
                        // 'excel',
                        {
                            extend: 'excel',
                            title: '',
                        },
                        'print',
                        {
                            extend: 'colvis',
                            text: "Columns",
                            postfixButtons: ['colvisRestore']
                        }
                    ],
                    order: [
                        [0, "desc"]
                    ],
                    lengthChange: false,
                    autoWidth: false,
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    language: {
                        processing: "<i class='fas fa-2x fa-sync-alt fa-spin'></i>",
                    },
                    ajax: {
                        url: '{{ route('gsuite.users.create.index') }}',
                        data: function (d) {
                            d.ids = $('input[name=ids]').val();
                        }
                    },
                    columns: [
                        {
                            data: 'f_name',
                            name: 'f_name'
                        },
                        {
                            data: 'l_name',
                            name: 'l_name'
                        },
                        {
                            data: 'email_alternate',
                            name: 'email_alternate'
                        },
                        {
                            data: 'password',
                            name: 'password'
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'org_unit_path',
                            name: 'org_unit_path'
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'recovery_phone',
                            name: 'recovery_phone',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'none',
                            name: 'none',
                            visible: false
                        },
                        {
                            data: 'change_password_at_next_sign_in',
                            name: 'change_password_at_next_sign_in'
                        },
                        {
                            data: 'new_status',
                            name: 'new_status'
                        },
                        {
                            data: 'advanced_protection_program_enrollment',
                            name: 'advanced_protection_program_enrollment'
                        },
                    ],
                    initComplete: function() {
                        this.api().columns().every(function() {
                            var column = this;
                            var input = document.createElement("input");
                            input.className = "form-control form-control-sm";
                            $(input).appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                    column.search(val ? val : '', true, false).draw();
                                });
                        });
                    },
                });
                $('#search-input #ids').on('change', function (e) {
                        console.log('Ids: '+$('input[name=ids]').val());
                        oTable.draw();
                        e.preventDefault();
                    }
                );
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
