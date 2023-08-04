@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | User Create')
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
                                <h3 class="card-title">Issue Book</h3>
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
                                <div>
                                    <form action="{{ route('inventry.library.book.borrow.store') }}" method="post" class="form-prevent-multiple-submits">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6 mt-2">
                                                        <label for="" class="ml-1 mr-1">Book</label>
                                                        <select name="borrow_book_id" id="search_input_book"
                                                            class="form-control select2 @error('borrow_book_id') border border-danger @enderror">
                                                            <option value="" selected disabled>Book</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6 mt-2">
                                                        <label for="" class="ml-1 mr-1">Borrowers</label>
                                                        <select name="borrow_user_id" id="search_input_user"
                                                            class="form-control select2 @error('borrow_user_id') border border-danger @enderror">
                                                            <option value="" selected disabled>Borrowers</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer">
                                                <button type="save" class="btn btn-primary button-prevent-multiple-submits">Save</button>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </form>
                                </div>
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
@push('scripts')
    <script>
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endpush

@push('scripts')
    <script>
        $('#search_input_user').select2({
            placeholder: "Choose user...",
            // minimumInputLength: 2,
            ajax: {
                url: '{{ route('inventry.library.book.borrow.getUsers') }}',
                dataType: 'json',
                data: function(params) {
                    return {
                        search_input_user: $.trim(params.term).split(' ') // Array
                        // search_input_user: $.trim(params.term) // String
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.user_id + ' | ' + item.user_name + ' | ' + item.user_role +
                                    ' | ' + item.class_name +
                                    ' | ' + item.user_farher_anme,
                                id: item.user_id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endpush

@push('scripts')
    <script>
        $('#search_input_book').select2({
            placeholder: "Choose book...",
            // minimumInputLength: 2,
            ajax: {
                url: '{{ route('inventry.library.book.borrow.getBooks') }}',
                dataType: 'json',
                data: function(params) {
                    return {

                        search_input_book: $.trim(params.term).split(' ') // Array
                        // search_input_book: $.trim(params.term) // String
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.book_id + '|' + item.accession_number + ' | ' + item
                                    .book_isbn + ' | ' + item
                                    .book_title + ' | ' + item
                                    .book_edition + ' | ' + item.book_published_at + ' | ' + item
                                    .book_author + ' | ' + item.publisher_name,
                                id: item.book_id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endpush
