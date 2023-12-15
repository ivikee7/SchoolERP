@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | User Create')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Projects</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projects</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th style="width: 60%">
                                    Product Name
                                </th>
                                <th style="width: 10%">
                                    Price
                                </th>
                                <th style="width: 20%">
                                    Qty
                                </th>
                                <th style="width: 10%">
                                    Subtotal
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subtotal = null;
                            @endphp
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>
                                        {{ ++$key }} |
                                        {{ $product->class_has_product_id }} | {{ $product->product_name }}
                                    </td>
                                    <td>
                                        ₹{{ $price = $product->class_has_product_price }}
                                    </td>
                                    <td>
                                        {{ $quantity = 1 }}
                                    </td>
                                    <td>
                                        @php
                                            $subtotal = $subtotal + $price * $quantity;
                                        @endphp
                                        {{ $price * $quantity }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>

                                </td>
                                <td>
                                </td>
                                <td>
                                    Subtotal
                                </td>
                                <td>
                                    {{ $subtotal }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Continue</a>
                </div>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection()
@push('scripts')
    <script>
        $('#search_input_user').select2({
            placeholder: "Choose user...",
            // minimumInputLength: 2,
            ajax: {
                url: '{{ route('inventory.product.sale.getProducts') }}',
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
@endpush
