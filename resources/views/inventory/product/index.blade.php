@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Users')
@section('content')
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
                                <h3 class="card-title">Products</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('inventory.product.create') }}">
                                        <button class="btn btn-sm btn-success">New</button>
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-striped display" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Product Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display: table-row-group;">
                                        <tr>
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
                    [5, 10, 25, 50, 100, 500],
                    ['5 rows', '10 rows', '25 rows', '50 rows', '100 rows', '500 rows']
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
                ajax: '{!! route('inventory.product.render') !!}',
                columns: [{
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'product_description',
                        name: 'product_description'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                initComplete: function(settings, json) {
                    this.api().columns([0, 1]).every(function() {
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
    </script>
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
