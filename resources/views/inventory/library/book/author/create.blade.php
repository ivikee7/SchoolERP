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
                                <h3 class="card-title">Create Author</h3>
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
                                    <form action="{{ route('inventry.library.book.author.store') }}" method="post" class="form-prevent-multiple-submits">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Author Name</label>
                                                        <input type="text"
                                                            class="form-control @error('author_name') border border-danger @enderror "
                                                            name="author_name" value="{{ old('author_name') }}"
                                                            placeholder="Author Name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Author Note</label>
                                                        <input type="text"
                                                            class="form-control @error('author_note') border border-danger @enderror "
                                                            name="author_note" value="{{ old('author_note') }}"
                                                            placeholder="Author Note">
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
