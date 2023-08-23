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
                                    <form action="{!! route('inventory.product.class.update', $class_has_products->class_has_product_id) !!}" method="post">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Price</label>
                                                        <input type="text"
                                                            class="form-control @error('class_has_product_price') border border-danger @enderror "
                                                            name="class_has_product_price"
                                                            @if (old('class_has_product_price')) value="{{ old('class_has_product_price') }}"
                                                            @elseif($class_has_products->class_has_product_price != '') value="{{ $class_has_products->class_has_product_price }}" @endif
                                                            placeholder="Price">
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
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
@endpush
