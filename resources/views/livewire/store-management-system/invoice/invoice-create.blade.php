<div>
    <x-loading-indicator />
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
                            <h3 class="card-title">Users</h3>
                            <div class="card-title float-right">
                                <a href="{{ route('user.create') }}">
                                    <input type="button" value="Add New" class="btn btn-sm btn-success">
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product ID</th>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $key => $product)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td><a
                                                                href="pages/examples/invoice.html">{{ $product->product_id }}</a>
                                                        </td>
                                                        <td>Call of Duty IV</td>
                                                        <td>{{ $product->product_cart_quantity }}</td>
                                                        <td>{{ $product->class_has_product_price }}</td>
                                                        <td>
                                                            <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                                {{ $product->class_has_product_price * $product->product_cart_quantity }}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th colspan="4"></th>
                                                    <th colspan="1">SubTotal</th>
                                                    <th>
                                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                            ₹{{ $total }}
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="4"></th>
                                                    <th colspan="1">Total</th>
                                                    <th>
                                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                            ₹{{ $total }}
                                                        </div>
                                                    </th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <div class="card-footer clearfix">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New
                                        Order</a>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All
                                        Orders</a>
                                </div>

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
