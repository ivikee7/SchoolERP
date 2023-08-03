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
                                <h3 class="card-title">Create Book</h3>
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
                                    <form action="{{ route('inventry.library.book.store') }}" method="post"
                                        class="form-prevent-multiple-submits">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Supplier</label>
                                                        <select name="supplier_id" id=""
                                                            class="form-control select2 @error('supplier_id') border border-danger @enderror">
                                                            <option value="" selected disabled>Supplier</option>
                                                            @if ($suppliers ?? '')
                                                                @foreach ($suppliers as $supplier)
                                                                    <option value="{{ $supplier->id }}"
                                                                        @if (old('supplier_id') == $supplier->id) selected @endif>
                                                                        {{ $supplier->supplier_name }}
                                                                        @if (!$supplier->supplier_address == '')
                                                                            ({{ $supplier->supplier_address }})
                                                                        @endif
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Book Name</label>
                                                        <input type="text"
                                                            class="form-control @error('book_title') border border-danger @enderror "
                                                            name="book_title" value="{{ old('book_title') }}"
                                                            placeholder="Book Name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Edition</label>
                                                        <input type="text"
                                                            class="form-control @error('book_edition') border border-danger @enderror "
                                                            name="book_edition" value="{{ old('book_edition') }}"
                                                            placeholder="Edition">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Year Of Publish</label>
                                                        <input type="year"
                                                            class="form-control @error('book_published_at') border border-danger @enderror "
                                                            name="book_published_at" value="{{ old('book_published_at') }}"
                                                            placeholder="Year Of Publish">
                                                    </div>
                                                    {{-- <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Author</label>
                                                        <input type="text"
                                                            class="form-control @error('book_author') border border-danger @enderror "
                                                            id="search_input_author" name="book_author"
                                                            value="{{ old('book_author') }}"
                                                            placeholder="Author">
                                                    </div> --}}

                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2"
                                                        id="search_input_author">
                                                        <label for="" class="ml-1 mr-1">Author</label>
                                                        <input type="text" list="authors" id="author"
                                                            class="form-control @error('book_author') border border-danger @enderror "
                                                            name="book_author" value="{{ old('book_author') }}"
                                                            placeholder="Author">
                                                    </div>
                                                    <datalist id="authors">
                                                    </datalist>

                                                    {{-- <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">Author</label>
                                                    <select name="author_id" id=""
                                                        class="form-control select2 @error('author_id') border border-danger @enderror">
                                                        <option value="" selected disabled>Author</option>
                                                        @if ($authors ?? '')
                                                        @foreach ($authors as $author)
                                                        <option value="{{ $author->id }}" @if (old('author_id') == $author->id) selected @endif>
                                                            {{ $author->author_name }} @if (!$author->author_note == '')
                                                            ({{ $author->author_note }})
                                                            @endif
                                                        </option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div> --}}
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Publisher</label>
                                                        <select name="publisher_id" id=""
                                                            class="form-control select2 @error('publisher_id') border border-danger @enderror">
                                                            <option value="" selected disabled>Publisher</option>
                                                            @if ($publishers ?? '')
                                                                @foreach ($publishers as $publisher)
                                                                    <option value="{{ $publisher->id }}"
                                                                        @if (old('publisher_id') == $publisher->id) selected @endif>
                                                                        {{ $publisher->publisher_name }}
                                                                        @if (!$publisher->publisher_location == '')
                                                                            ({{ $publisher->publisher_location }})
                                                                        @endif
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    {{-- <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <div class="form-group">
                                                        <label>Auther</label>
                                                        <select
                                                            class="search_input_author form-control select2 @error('author_id') border border-danger @enderror"
                                                            id="search_input_author" style="width: 100%;"
                                                            name="author_id" placeholder="Auther">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <div class="form-group">
                                                        <label>Publisher</label>
                                                        <select
                                                            class="search_input_publisher form-control select2 @error('publisher_id') border border-danger @enderror"
                                                            id="search_input_publisher" style="width: 100%;"
                                                            name="publisher_id" placeholder="Publisher">
                                                        </select>
                                                    </div>
                                                </div> --}}
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">ISBN</label>
                                                        <input type="text"
                                                            class="form-control @error('book_isbn') border border-danger @enderror "
                                                            name="book_isbn" value="{{ old('book_isbn') }}"
                                                            placeholder="ISBN">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Pages</label>
                                                        <input type="text"
                                                            class="form-control @error('book_pages') border border-danger @enderror "
                                                            name="book_pages" value="{{ old('book_pages') }}"
                                                            placeholder="Pages">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Category</label>
                                                        <select name="category_id" id=""
                                                            class="form-control @error('category_id') border border-danger @enderror">
                                                            <option value="" selected disabled>Category</option>
                                                            @if ($categories ?? '')
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        @if (old('category_id') == $category->id) selected @endif>
                                                                        {{ $category->category_name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Language</label>
                                                        <select name="language_id" id=""
                                                            class="form-control @error('language_id') border border-danger @enderror">
                                                            <option value="" selected disabled>Language</option>
                                                            @if ($languages ?? '')
                                                                @foreach ($languages as $language)
                                                                    <option value="{{ $language->id }}"
                                                                        @if (old('language_id') == $language->id) selected @endif>
                                                                        {{ $language->language_name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Class</label>
                                                        <select name="class_id" id=""
                                                            class="form-control @error('class_id') border border-danger @enderror">
                                                            <option value="" selected disabled>Class</option>
                                                            <option value="">None</option>
                                                            @if ($classes ?? '')
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id }}"
                                                                        @if (old('class_id') == $class->id) selected @endif>
                                                                        {{ $class->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Subject</label>
                                                        <select name="subject_id" id=""
                                                            class="form-control @error('subject_id') border border-danger @enderror">
                                                            <option value="" selected disabled>Subject</option>
                                                            <option value="">None</option>
                                                            @if ($subjects ?? '')
                                                                @foreach ($subjects as $subject)
                                                                    <option value="{{ $subject->id }}"
                                                                        @if (old('subject_id') == $subject->id) selected @endif>
                                                                        {{ $subject->subject_name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Location</label>
                                                        <select name="location_id" id=""
                                                            class="form-control @error('location_id') border border-danger @enderror">
                                                            <option value="" selected disabled>Location</option>
                                                            @if ($locations ?? '')
                                                                @foreach ($locations as $location)
                                                                    <option value="{{ $location->id }}"
                                                                        @if (old('location_id') == $location->id) selected @endif>
                                                                        {{ $location->location_name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    {{-- <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">Number Of Books</label>
                                                    <input type="integer"
                                                        class="form-control @error('number_of_book') border border-danger @enderror "
                                                        name="number_of_book" value="{{ old('number_of_book') }}"
                                                        placeholder="Number Of Books">
                                                </div> --}}
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Price</label>
                                                        <input type="integer"
                                                            class="form-control @error('book_price') border border-danger @enderror "
                                                            name="book_price" value="{{ old('book_price') }}"
                                                            placeholder="Price">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Note</label>
                                                        <input type="text"
                                                            class="form-control @error('book_note') border border-danger @enderror "
                                                            name="book_note" value="{{ old('book_note') }}"
                                                            placeholder="Note">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Purchased Date</label>
                                                        <input type="date"
                                                            class="form-control @error('purchased_at') border border-danger @enderror "
                                                            name="purchased_at" value="{{ old('purchased_at') }}"
                                                            placeholder="Purchased Date">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Accession Number</label>
                                                        <input type="number"
                                                            class="form-control @error('accession_number') border border-danger @enderror "
                                                            name="accession_number" value="{{ old('accession_number') }}"
                                                            placeholder="Accession Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer">
                                                <button type="save"
                                                    class="btn btn-primary button-prevent-multiple-submits">Save</button>
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

{{-- @push('scripts')
<script>
    $(function() {
            //Initialize Select2 Elements
            $('.select2_permission').select2()
        });
        $('#search_input_author').select2({
            placeholder: "Choose author...",
            // minimumInputLength: 2,
            ajax: {
                url: '{{ route('inventry.library.book.author') }}',
                dataType: 'json',
                data: function(params) {
                    return {
                        search_input_author: $.trim(params.term)
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.author_name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
</script>
@endpush --}}

{{-- @push('scripts')
<script>
    $(function() {
            //Initialize Select2 Elements
            $('.select2_permission').select2()
        });
        $('#search_input_publisher').select2({
            placeholder: "Choose publisher...",
            // minimumInputLength: 2,
            ajax: {
                url: '{{ route('inventry.library.book.publisher') }}',
                dataType: 'json',
                data: function(params) {
                    return {
                        search_input_publisher: $.trim(params.term)
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.publisher_name + ' ' + item.publisher_location,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
</script>
@endpush --}}

@push('scripts')
    <script type="module">
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $("#search_input_author :input").on("keyup", function(e) {
                e.preventDefault();
                var el = $(this);
                var id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{!! route('inventry.library.book.getAuthors') !!}",
                    method: 'get',
                    dataType: 'json',
                    data: 'search_input_author=' + $(this).val(),
                    success: function(response) {
                        $('#authors').empty();
                        $.each(response, function(key, value) {
                            $("#authors").last().append(
                                '<option value="' + value.book_author +
                                '"></option>'
                            );
                        });
                    }
                });
            })
        });
    </script>
    {{-- <script>
        $('#search_input_author').select2({
            placeholder: "Choose book...",
            // minimumInputLength: 2,
            ajax: {
                url: '{{ route('inventry.library.book.getAuthors') }}',
                dataType: 'json',
                data: function(params) {
                    return {

                        search_input_authors: $.trim(params.term).split(' ') // Array
                        // search_input_book: $.trim(params.term) // String
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.book_author,
                                id: item.book_author
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script> --}}
@endpush
