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
                                data-target="#modal-create-add"><i class="fas fa-plus-circle"></i> Add New</button>
                            <div class="card-title float-right">
                                <div class="row">
                                    <div class="form-group pr-1">
                                        <select class="form-control form-control-sm" wire:model.live="acadamic_session">
                                            <option @selected(true) @disabled(true)>select
                                            </option>
                                            @if ($acadamic_sessions)
                                                @foreach ($acadamic_sessions as $as)
                                                    <option value="{{ $as->id }}">{{ $as->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <a href="{{ route('store-management-system.product-manage') }}" wire:navigate>
                                        <input type="button" value="Manage Product" class="btn btn-sm btn-primary" />
                                    </a>
                                    <a href="{{ route('store-management-system.seller') }}" wire:navigate>
                                        <input type="button" value="Seller" class="btn btn-sm btn-primary" />
                                    </a>
                                    <a href="{{ route('store-management-system.invoices') }}" wire:navigate>
                                        <input type="button" value="Invoices" class="btn btn-sm btn-primary" />
                                    </a>

                                </div>
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
                                            <th>Class Name</th>
                                            <th>Products</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($class_has_products as $class_has_product)
                                            <tr>
                                                <td>{{ $class_has_product->id }}</td>
                                                <td>{{ $class_has_product->class_name }}</td>
                                                <td>
                                                    @foreach ($this->getProductsOfClass($class_has_product->id, $acadamic_session) as $product)
                                                        <span
                                                            class="badge badge-primary">{{ $product->product_name . '(' . $product->academic_session_name . ')' . ' ₹' . $product->class_has_product_price }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{-- <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#modal-create-edit">
                                                        <i class="fas fa-edit"></i></button> --}}
                                                    <a wire:navigate class="btn btn-primary btn-xs"
                                                        href="{{ route('store-management-system.class-has-product-manage', [$class_has_product->id]) }}"><i
                                                            class="fas fa-edit"></i> Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    Showing
                                    {{ $class_has_products->perPage() * ($class_has_products->currentPage() - 1) + 1 }}
                                    to
                                    {{ $class_has_products->perPage() * $class_has_products->currentPage() }} of
                                    {{ $class_has_products->total() }}
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="d-flex flex-row-reverse">
                                        @if (count($class_has_products))
                                            {{ $class_has_products->links() }}
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
    <div class="modal fade" id="modal-create-add" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit="assignProducts({{ $class_id }})">
                    <div class="modal-header">
                        <h4 class="modal-title">Assign product to class</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-2">
                                <label for="" class="ml-1 mr-1">Class</label>
                                <div class="form-group">
                                    <select class="form-control" wire:model.live="class_id">
                                        <option>Select</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <label for="" class="ml-1 mr-1">Session</label>
                                <div class="form-group">
                                    <select class="form-control" wire:model.live="academic_session_id">
                                        <option>Select</option>
                                        @foreach ($sessions as $session)
                                            <option value="{{ $session->id }}">
                                                {{ $session->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <label for="" class="ml-1 mr-1">Product</label>
                                <div class="form-group">
                                    <select class="form-control" wire:model.live="product_id">
                                        <option>Select</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->product_id }}">
                                                {{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <label for="" class="ml-1 mr-1">Price</label>
                                <input wire:model.live="price" type="text" class="form-control"
                                    placeholder="Price">
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
            Livewire.on('model_assign_hide', (event) => {
                $('#modal-create-add').modal('hide');
            });

            Livewire.on('model_assign_show', (event) => {
                $('#modal-create-add').modal('show');
            });
        });
    </script>
@endpush
