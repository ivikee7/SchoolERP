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
                                <h3 class="card-title">Edit Publisher</h3>
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
                                    <form action="{{ route('inventry.library.book.publisher.update', $publisher->id) }}"
                                        method="post">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Publisher Name</label>
                                                        <input type="text"
                                                            class="form-control @error('publisher_name') border border-danger @enderror "
                                                            name="publisher_name"
                                                            @if (old('publisher_name')) value="{{ old('publisher_name') }}"
                                                                @elseif ($publisher->publisher_name) value="{{ $publisher->publisher_name }}" @endif
                                                            placeholder="Publisher Name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Email</label>
                                                        <input type="email"
                                                            class="form-control @error('publisher_email') border border-danger @enderror "
                                                            name="publisher_email"
                                                            @if (old('publisher_email')) value="{{ old('publisher_email') }}"
                                                                @elseif ($publisher->publisher_email) value="{{ $publisher->publisher_email }}" @endif
                                                            placeholder="Email">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Contact
                                                            Number</label>
                                                        <input type="text"
                                                            class="form-control @error('publisher_contact') border border-danger @enderror "
                                                            name="publisher_contact"
                                                            @if (old('publisher_contact')) value="{{ old('publisher_contact') }}"
                                                                @elseif ($publisher->publisher_contact) value="{{ $publisher->publisher_contact }}" @endif
                                                            placeholder="Contact Number">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Contact
                                                            Number2</label>
                                                        <input type="text"
                                                            class="form-control @error('publisher_contact2') border border-danger @enderror "
                                                            name="publisher_contact2"
                                                            @if (old('publisher_contact2')) value="{{ old('publisher_contact2') }}"
                                                                @elseif ($publisher->publisher_contact2) value="{{ $publisher->publisher_contact2 }}" @endif
                                                            placeholder="Contact Number2">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Address</label>
                                                        <input type="text"
                                                            class="form-control @error('publisher_location') border border-danger @enderror "
                                                            name="publisher_location"
                                                            @if (old('publisher_location')) value="{{ old('publisher_location') }}"
                                                                @elseif ($publisher->publisher_location) value="{{ $publisher->publisher_location }}" @endif
                                                            placeholder="Address">
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
