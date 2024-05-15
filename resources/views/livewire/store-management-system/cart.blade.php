<div>
    <x-loading-indicator />
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cart</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('store-management-system.seller') }}"
                                wire:navigate>Seller</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('store-management-system.products', $id) }}"
                                wire:navigate>Products</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content attendance">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Cart</h3>
                            <div class="card-title float-right">
                                <a href="{{ route('store-management-system.products', $id) }}" wire:navigate>
                                    <input type="button" value="Products" class="btn btn-sm btn-primary" />
                                </a>
                                <a href="{{ route('store-management-system.seller') }}" wire:navigate>
                                    <input type="button" value="Seller" class="btn btn-sm btn-primary" />
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <!-- /.card-body -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product ID</th>
                                                    <th>Item</th>
                                                    <th>Price</th>
                                                    <th></th>
                                                    <th class="text-center">Quantity</th>
                                                    <th></th>
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
                                                        <td>{{ $product->product_name }}</td>
                                                        <td>₹{{ $product->class_has_product_price }}</td>
                                                        <td>
                                                            <a class="btn bg-warning btn-sm"
                                                                wire:click="addToCartDecrease({{ $id }}, '{{ $product->product_cart_product_id }}')">
                                                                -
                                                            </a>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $product->product_cart_quantity }}
                                                        </td>
                                                        <td class="text-center">
                                                            <a class="btn btn-success btn-sm"
                                                                wire:click="addToCartIncrease({{ $id }}, '{{ $product->product_cart_product_id }}')">
                                                                +
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                                ₹{{ $product->class_has_product_price * $product->product_cart_quantity }}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th colspan="6"></th>
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
                                    <a wire:click="cartClear({{ $id }})"
                                        class="btn btn-sm btn-info float-left">Clear Cart</a>
                                    <a wire:click="createInvoice({{ $id }})"
                                        class="btn btn-sm btn-secondary float-right">Generate Invoice</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
