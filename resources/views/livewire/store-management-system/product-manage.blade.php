<div>
    <x-loading-indicator />
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('store-management-system.seller') }}">Seller</a>
                        </li>
                        <li class="breadcrumb-item active">Manage Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content attendance">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h3 class="card-title">Seller</h3> --}}
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal-create-product"><i class="fas fa-plus-circle"></i> Add New</button>
                            <div class="card-title float-right">

                                <a href="{{ route('store-management-system.class-has-product') }}" wire:navigate>
                                    <input type="button" value="Class Has Product" class="btn btn-sm btn-primary" />
                                </a>
                                <a href="{{ route('store-management-system.seller') }}" wire:navigate>
                                    <input type="button" value="Seller" class="btn btn-sm btn-primary" />
                                </a>
                                <a href="{{ route('store-management-system.invoices') }}" wire:navigate>
                                    <input type="button" value="Invoices" class="btn btn-sm btn-primary" />
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dt-buttons btn-group flex-wrap">

                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group row d-flex">
                                        <label class="col-sm col-form-label d-flex flex-row-reverse">Search:</label>
                                        <div class="col-sm">
                                            <input type="search" wire:model.live='search' class="form-control"
                                                placeholder="Search...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-striped display" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->product_id }}</td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->product_category_name }}</td>
                                                <td>
                                                    {{-- <a href="{{ route('store-management-system.product-management', $product->id) }}"
                                                        wire:navigate class="btn btn-primary rounded-pill">
                                                        <i class="fas fa-arrow-right"></i>
                                                    </a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    Showing
                                    {{ $products->perPage() * ($products->currentPage() - 1) + 1 }} to
                                    {{ $products->perPage() * $products->currentPage() }} of
                                    {{ $products->total() }}
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="d-flex flex-row-reverse">
                                        @if (count($products))
                                            {{ $products->links() }}
                                        @endif
                                    </div>
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
    {{-- Add Model --}}
    <div class="modal fade" id="modal-create-product" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form wire:submit="store">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Product</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-2">
                                <label for="" class="ml-1 mr-1">Product Name</label>
                                <input wire:model.live="product_name" type="text" class="form-control"
                                    placeholder="Product Name">
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <label for="" class="ml-1 mr-1">Product Description</label>
                                <input wire:model.live="product_description" type="text" class="form-control"
                                    placeholder="Product Description">
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <label for="" class="ml-1 mr-1">Product</label>
                                <div class="form-group">
                                    <select class="form-control" wire:model.live="product_category_id">
                                        <option>Select</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->product_category_id }}">
                                                {{ $category->product_category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

@push('styles')
    {{-- DataTables --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    {{-- DataTables  & Plugins --}}
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
@endpush
@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('closeModelCreate', (event) => {
                $('#modal-create-product').modal('hide');
            });
        });
    </script>
@endpush
