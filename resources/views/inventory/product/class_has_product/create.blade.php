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
                                    <a href="{{ route('inventory.product.render') }}">
                                        <button class="btn btn-sm btn-primary">Products</button>
                                    </a>
                                    <a href="{{ route('inventory.product.create') }}">
                                        <button class="btn btn-sm btn-success">New</button>
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div>
                                    <form action="{!! route('inventory.product.class.store', $id) !!}" method="post">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Product</label>
                                                        <select
                                                            class="form-control @error('product_id') border border-danger @enderror"
                                                            data-placeholder="Select Products" style="width: 100%;"
                                                            name="product_id">
                                                            <option value="" disabled>Product</option>
                                                            @if ($products ?? '')
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->product_id }}"
                                                                        @if (old('product_id') == $product->product_id) selected @endif>
                                                                        {{ $product->product_name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Price</label>
                                                        <input type="text"
                                                            class="form-control @error('class_has_product_price') border border-danger @enderror "
                                                            name="class_has_product_price" placeholder="Price">
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
@push('scripts')
@endpush
