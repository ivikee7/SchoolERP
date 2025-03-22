<div>
    <x-loading-indicator />
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('store-management-system.seller') }}"
                                wire:navigate>Seller</a>
                        </li>
                        <li class="breadcrumb-item active">Products</li>
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
                            <h3 class="card-title">Products</h3>
                            <div class="card-title float-right">
                                <a href="{{ route('store-management-system.cart', $id) }}" wire:navigate>
                                    <button type="button" value="" class="btn btn-sm btn-primary">
                                        <i class="fas fa-shopping-cart"></i> Cart <span
                                            class="badge badge-warning right">{{ $addToCartCountProducts }}</span></button>
                                </a>
                                <a href="{{ route('store-management-system.seller') }}" wire:navigate>
                                    <input type="button" value="Seller" class="btn btn-sm btn-primary" />
                                </a>
                                <a href="{{ route('store-management-system.invoices') }}" wire:navigate>
                                    <input type="button" value="Invoices" class="btn btn-sm btn-primary" />
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- @dd($products) --}}
                                @foreach ($products->student->class->classHasProduct as $item)
                                    <div class="col col-md-6 col-xl-4">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-info">
                                                <img src="{{ asset('/dist/img/book.png') }}" class="border"
                                                    width="100" height="100" alt="Product">
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">
                                                    {{ $item->product->product_name }}
                                                </span>
                                                <span class="info-box-text">
                                                    ({{ $item->product->product_description }}) ({{ $item->session->name }})
                                                </span>
                                                <div class="progress">
                                                    <div class="progress-bar bg-info" style="width: 100%"></div>
                                                </div>
                                                <span class="progress-description">
                                                    <div class="row">
                                                        <span class="col col-6">Price
                                                            ₹{{ $item->class_has_product_price }}</span>
                                                        <div class="col col-6">
                                                            <div class="d-flex flex-row-reverse">
                                                                <input
                                                                    wire:click='addToCart({{ $id }}, "{{ $item->class_has_product_id }}")'
                                                                    type="button" class="btn btn-primary btn-sm"
                                                                    name="adToCart" value="Add To Cart" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
