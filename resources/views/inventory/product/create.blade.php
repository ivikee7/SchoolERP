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
                                <h3 class="card-title">Create Product</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('inventory.product.render') }}">
                                        <button class="btn btn-sm btn-primary">Products</button>
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('inventory.product.store') }}" method="post" class="">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">Product Name</label>
                                                    <input type="text"
                                                        class="form-control @error('product_name') border border-danger @enderror "
                                                        name="product_name" value="{{ old('product_name') }}"
                                                        placeholder="Product Name">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">Product Description</label>
                                                    <input type="text"
                                                        class="form-control @error('product_description') border border-danger @enderror "
                                                        name="product_description" value="{{ old('product_description') }}"
                                                        placeholder="Product Description">
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                    <label for="" class="ml-1 mr-1">Category</label>
                                                    <select name="product_category_id" id=""
                                                        class="form-control @error('product_category_id') border border-danger @enderror">
                                                        <option value="" selected disabled>Category</option>
                                                        @if ($categories ?? '')
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->product_category_id }}"
                                                                    @if (old('product_category_id') == $category->product_category_id) selected @endif>
                                                                    {{ $category->product_category_name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="save" class="btn btn-primary">Save</button>
                                        </div>
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
