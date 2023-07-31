@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Enquiries')
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
                                <h3 class="card-title">Admission Enquiries</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('website.enquiry.index') }}">
                                        <input type="button" value="Website Enquiries" class="btn btn-sm btn-primary">
                                    </a>
                                    <a href="{{ route('enquiry.create') }}">
                                        <input type="button" value="Add New" class="btn btn-sm btn-success">
                                    </a>
                                    @can('enquiry_delete')
                                        <a href="{{ route('enquiry.trashed.index') }}">
                                            <button type="button" value="Trashed" class="btn btn-sm btn-secondary">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </a>
                                    @endcan
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Full Name</th>
                                            <th>Gender</th>
                                            <th>DOB</th>
                                            <th>Enquiry for Class</th>
                                            <th>Father Name</th>
                                            <th>Mother Name</th>
                                            <th>Contact Number</th>
                                            <th>Address</th>
                                            <th>Source</th>
                                            <th>Last School</th>
                                            <th>Created By</th>
                                            <th>Updated By</th>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('table').DataTable({
                dom: 'lBfrtip',
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    ['5 rows', '10 rows', '25 rows', '50 rows', 'Show all']
                ],
                buttons: [
                    'pageLength',
                    'copy',
                    'csv',
                    'excel',
                    'print',
                    {
                        extend: 'colvis',
                        text: "Columns",
                        postfixButtons: ['colvisRestore']
                    }
                ],
                processing: true,
                serverSide: true,
                order: [
                    [0, "desc"]
                ],
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                language: {
                    processing: "<i class='fas fa-2x fa-sync-alt fa-spin'></i>",
                },
                ajax: '{{ route('enquiry.index') }}',
                columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'full_name',
                    name: 'full_name'
                }, {
                    data: 'gender',
                    name: 'gender'
                }, {
                    data: 'date_of_birth',
                    name: 'date_of_birth',
                    visible: false
                }, {
                    data: 'classname',
                    name: 'classname'
                }, {
                    data: 'father_name',
                    name: 'father_name'
                }, {
                    data: 'mother_name',
                    name: 'mother_name'
                }, {
                    data: 'contact_number',
                    name: 'contact_number'
                }, {
                    data: 'address',
                    name: 'address'
                }, {
                    data: 'source',
                    name: 'source'
                }, {
                    data: 'last_attended_school',
                    name: 'last_attended_school',
                    visible: false
                }, {
                    data: 'created_by',
                    name: 'created_by'
                }, {
                    data: 'updated_by',
                    name: 'updated_by',
                    visible: false
                }, {
                    data: 'action',
                    name: 'action',
                    visible: false
                }],
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
            $(".dataTables_filter, .dataTables_paginate").addClass("d-md-inline float-md-right");
            $(".dataTables_info").addClass("d-md-inline float-md-left");
        });

        @can('enquiry_delete')
            $("table").on('click', 'td .enquiry-delete', function() {
                var id = $(this).val();
                enquiryDelete(id);
            });

            function enquiryDelete(id) {
                var token = $("meta[name='csrf-token']").attr("content");
                var table = $("button").closest("table").DataTable();
                $.ajax({
                    url: "{{ route('enquiry.destroy', '') }}" + "/" + id,
                    type: 'delete',
                    data: {
                        'id=': id,
                        '_token': token,
                    },
                    success: function(response) {
                        table.cell({
                            focused: true
                        }).row().remove();
                        table.draw();
                    },
                    error: function(response) {
                        alert('Failed!');
                    }
                });
            };
        @endcan ()
    </script>
@endpush
