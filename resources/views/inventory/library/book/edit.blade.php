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
                            <h3 class="card-title">Edit Book</h3>
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
                                <form action="{{ route('inventry.library.book.update', $book->id) }}" method="post">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">Source</label>
                                                    <select name="supplier_id" id=""
                                                        class="form-control select2 @error('supplier_id') border border-danger @enderror">
                                                        <option value="" selected disabled>Source</option>
                                                        @if ($suppliers ?? '')
                                                        @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}"
                                                            @if(old('supplier_id')==$supplier->id) selected
                                                            @elseif ($book->supplier_id == $supplier->id) selected
                                                            @endif>
                                                            {{ $supplier->supplier_name }}
                                                            @if(!$supplier->supplier_address == '')
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
                                                        name="book_title" @if (old('book_title'))
                                                        value="{{ old('book_title') }}" @elseif ($book->book_title)
                                                    value="{{ $book->book_title }}" @endif
                                                    placeholder="Book Name">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">Edition</label>
                                                    <input type="text"
                                                        class="form-control @error('book_edition') border border-danger @enderror "
                                                        name="book_edition" @if (old('book_edition'))
                                                        value="{{ old('book_edition') }}" @elseif ($book->book_edition)
                                                    value="{{ $book->book_edition }}" @endif
                                                    placeholder="Edition">
                                                </div>
                                                {{-- <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">Author</label>
                                                    <select name="author_id" id=""
                                                        class="form-control select2 @error('author_id') border border-danger @enderror">
                                                        <option value="" selected disabled>Author</option>
                                                        @if ($authors ?? '')
                                                        @foreach ($authors as $author)
                                                        <option value="{{ $author->id }}" @if
                                                            (old('author_id')==$author->id) selected @elseif
                                                            ($book->author_id == $author->id) selected @endif>
                                                            {{ $author->author_name }} @if (!$author->author_note == '')
                                                            ({{ $author->author_note }})
                                                            @endif
                                                        </option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div> --}}

                                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">Author</label>
                                                    <input type="text"
                                                        class="form-control @error('book_author') border border-danger @enderror "
                                                        name="book_author" @if (old('book_author'))
                                                        value="{{ old('book_author') }}" @elseif ($book->book_author)
                                                    value="{{ $book->book_author }}" @endif
                                                    placeholder="Author">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">Publisher</label>
                                                    <select name="publisher_id" id=""
                                                        class="form-control select2 @error('publisher_id') border border-danger @enderror">
                                                        <option value="" selected disabled>Publisher</option>
                                                        @if($publishers ?? '')
                                                        @foreach($publishers as $publisher)
                                                        <option value="{{ $publisher->id }}"
                                                            @if(old('publisher_id')==$publisher->id) selected
                                                            @elseif($book->publisher_id == $publisher->id) selected
                                                            @endif>
                                                            {{ $publisher->publisher_name }}
                                                            @if(!$publisher->publisher_location == '')
                                                            ({{ $publisher->publisher_location }})
                                                            @endif
                                                        </option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">ISBN</label>
                                                    <input type="text"
                                                        class="form-control @error('book_isbn') border border-danger @enderror "
                                                        name="book_isbn" @if (old('book_isbn'))
                                                        value="{{ old('book_isbn') }}" @elseif ($book->book_isbn)
                                                    value="{{ $book->book_isbn }}" @endif
                                                    placeholder="ISBN">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">Pages</label>
                                                    <input type="text"
                                                        class="form-control @error('book_pages') border border-danger @enderror "
                                                        name="book_pages" @if (old('book_pages'))
                                                        value="{{ old('book_pages') }}" @elseif ($book->book_pages)
                                                    value="{{ $book->book_pages }}" @endif
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
                                                            @if(old('category_id')==$category->id) selected
                                                            @elseif($book->category_id == $category->id) selected
                                                            @endif>
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
                                                            @if(old('language_id')==$language->id) selected
                                                            @elseif($book->language_id == $language->id) selected
                                                            @endif>
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
                                                        <option value="{{ $class->id }}" @if(old('class_id')==$class->
                                                            id) selected
                                                            @elseif($book->class_id == $class->id) selected
                                                            @endif>
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
                                                            @if(old('subject_id')==$subject->id) selected
                                                            @elseif($book->subject_id == $subject->id) selected @endif>
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
                                                        <option value="" selected>Location</option>
                                                        @if ($locations ?? '')
                                                        @foreach ($locations as $location)
                                                        <option value="{{ $location->id }}"
                                                            @if(old('location_id')==$location->id) selected
                                                            @elseif($book->location_id == $location->id) selected
                                                            @endif>
                                                            {{ $location->location_name }}
                                                        </option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">Price</label>
                                                    <input type="number"
                                                        class="form-control @error('book_price') border border-danger @enderror "
                                                        name="book_price" @if(old('book_price'))
                                                        value="{{ old('book_price') }}" @elseif($book->book_price)
                                                    value="{{ $book->book_price }}" @endif
                                                    placeholder="Price">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">Note</label>
                                                    <input type="text"
                                                        class="form-control @error('book_note') border border-danger @enderror "
                                                        name="book_note" @if(old('book_note'))
                                                        value="{{ old('book_note') }}" @elseif($book->book_note)
                                                    value="{{ $book->book_note }}" @endif
                                                    placeholder="Note">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">Purchased Date</label>
                                                    <input type="date"
                                                        class="form-control @error('purchased_at') border border-danger @enderror "
                                                        name="purchased_at" @if(old('purchased_at'))
                                                        value="{{ old('purchased_at') }}" @elseif($book->purchased_at)
                                                    value="{{ $book->purchased_at }}" @endif
                                                    placeholder="Purchased Date">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="save" class="btn btn-primary">Save</button>
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
@endpush

@push('scripts')
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
<script>
    //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
</script>
@endpush
