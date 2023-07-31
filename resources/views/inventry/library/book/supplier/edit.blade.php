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
                                <h3 class="card-title">Edit Category</h3>
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
                                    <form action="{{ route('inventry.library.book.supplier.update', $supplier->id) }}"
                                        method="post">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Supplier Name</label>
                                                        <input type="text"
                                                            class="form-control @error('supplier_name') border border-danger @enderror "
                                                            name="supplier_name"
                                                            @if (old('supplier_name')) value="{{ old('supplier_name') }}"
                                                                @elseif ($supplier->supplier_name) value="{{ $supplier->supplier_name }}" @endif
                                                            placeholder="Supplier Name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Address</label>
                                                        <input type="text"
                                                            class="form-control @error('supplier_address') border border-danger @enderror "
                                                            name="supplier_address"
                                                            @if (old('supplier_address')) value="{{ old('supplier_address') }}"
                                                                @elseif ($supplier->supplier_address) value="{{ $supplier->supplier_address }}" @endif
                                                            placeholder="Address">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Contact Number</label>
                                                        <input type="text"
                                                            class="form-control @error('supplier_contact') border border-danger @enderror "
                                                            name="supplier_contact"
                                                            @if (old('supplier_contact')) value="{{ old('supplier_contact') }}"
                                                                @elseif ($supplier->supplier_contact) value="{{ $supplier->supplier_contact }}" @endif
                                                            placeholder="Contact Number">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Contact Number</label>
                                                        <input type="text"
                                                            class="form-control @error('supplier_contact2') border border-danger @enderror "
                                                            name="supplier_contact2"
                                                            @if (old('supplier_contact2')) value="{{ old('supplier_contact2') }}"
                                                                @elseif ($supplier->supplier_contact2) value="{{ $supplier->supplier_contact2 }}" @endif
                                                            placeholder="Contact Number">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Email</label>
                                                        <input type="text"
                                                            class="form-control @error('supplier_email') border border-danger @enderror "
                                                            name="supplier_email"
                                                            @if (old('supplier_email')) value="{{ old('supplier_email') }}"
                                                                @elseif ($supplier->supplier_email) value="{{ $supplier->supplier_email }}" @endif
                                                            placeholder="Email">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Status</label>
                                                        <select name="supplier_status" id=""
                                                            class="form-control @error('supplier_status') border border-danger @enderror">
                                                            <option value="" selected disabled>Status</option>
                                                            <option value="1"
                                                                @if (old('supplier_status') == '1') selected
                                                                @elseif ($supplier->supplier_status == '1') selected @endif>
                                                                Active
                                                            </option>
                                                            <option value="0"
                                                                @if (old('supplier_status') == '0') selected
                                                                @elseif ($supplier->supplier_status == '0') selected @endif>
                                                                Suspended</option>
                                                        </select>
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
