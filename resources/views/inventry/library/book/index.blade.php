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
                            <h3 class="card-title">Books</h3>
                            <div class="card-title float-right">
                                <a href="{{ route('inventry.library.book.borrow.create') }}">
                                    <button class="btn btn-sm btn-success">Issue Book</button>
                                </a>
                                <a href="{{ route('inventry.library.book.borrow.render') }}">
                                    <button class="btn btn-sm btn-primary">Issued Book</button>
                                </a>
                                <a href="{{ route('inventry.library.book.borrow.returneds') }}">
                                    <button class="btn btn-sm btn-primary">Return Book</button>
                                </a>
                                <a href="{{ route('inventry.library.book.borrow.losts') }}">
                                    <button class="btn btn-sm btn-primary">Lost Book</button>
                                </a>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        View
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('inventry.library.book.render') }}" class="dropdown-item"
                                            type="button">Book</a>
                                        <a href="{{ route('inventry.library.book.location.render') }}"
                                            class="dropdown-item" type="button">Location</a>
                                        <a href="{{ route('inventry.library.book.category.render') }}"
                                            class="dropdown-item" type="button">Categorie</a>
                                        <a href="{{ route('inventry.library.book.publisher.render') }}"
                                            class="dropdown-item" type="button">Publisher</a>
                                        <a href="{{ route('inventry.library.book.supplier.render') }}"
                                            class="dropdown-item" type="button">Supplier</a>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-success dropdown-toggle"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Create
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{ route('inventry.library.book.create') }}" class="dropdown-item"
                                            type="button">Book</a>
                                        <a href="{{ route('inventry.library.book.location.create') }}"
                                            class="dropdown-item" type="button">Location</a>
                                        <a href="{{ route('inventry.library.book.category.create') }}"
                                            class="dropdown-item" type="button">Category</a>
                                        <a href="{{ route('inventry.library.book.publisher.create') }}"
                                            class="dropdown-item" type="button">Publisher</a>
                                        <a href="{{ route('inventry.library.book.supplier.create') }}"
                                            class="dropdown-item" type="button">Supplier</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-sm table-bordered table-striped display" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Accession Number</th>
                                        <th>Author</th>
                                        <th>Title/Name</th>
                                        <th>Language</th>
                                        <th>Publisher</th>
                                        <th>Edition</th>
                                        <th>ISBN</th>
                                        <th>Pages</th>
                                        <th>Category</th>
                                        <th>Location</th>
                                        <th>Class</th>
                                        <th>Subject</th>
                                        <th>Price</th>
                                        <th>Note</th>
                                        <th>Purchased At</th>
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
                ajax: '{{ route('inventry.library.book.render') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    }, {
                        data: 'accession_number',
                        name: 'accession_number'
                    },
                    {
                        data: 'author_name',
                        name: 'author_name'
                    },
                    {
                        data: 'book_title',
                        name: 'book_title'
                    },
                    {
                        data: 'language_name',
                        name: 'language_name'
                    },
                    {
                        data: 'publisher_name',
                        name: 'publisher_name'
                    },
                    {
                        data: 'book_edition',
                        name: 'book_edition'
                    },
                    {
                        data: 'book_isbn',
                        name: 'book_isbn',
                        visible: false
                    },
                    {
                        data: 'book_pages',
                        name: 'book_pages',
                        visible: false
                    },
                    {
                        data: 'category_name',
                        name: 'category_name',
                        visible: false
                    },
                    {
                        data: 'location_name',
                        name: 'location_name'
                    },
                    {
                        data: 'class_name',
                        name: 'class_name',
                        visible: false
                    },
                    {
                        data: 'subject_name',
                        name: 'subject_name',
                        visible: false
                    },
                    {
                        data: 'book_price',
                        name: 'book_price',
                        visible: false
                    },
                    {
                        data: 'book_note',
                        name: 'book_note',
                        visible: false
                    },
                    {
                        data: 'purchased_at',
                        name: 'purchased_at',
                        visible: false
                    },
                    {
                        data: 'creator',
                        name: 'creator',
                        visible: false
                    },
                    {
                        data: 'updater',
                        name: 'updater',
                        visible: false
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
                initComplete: function(settings, json) {
                    this.api().columns([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13]).every(function() {
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
{{-- DataTables & Plugins --}}
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
