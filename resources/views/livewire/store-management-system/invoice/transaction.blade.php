<div class="content-wrapper overlay">
    <x-loading-indicator />
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transactions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Transaction</li>
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
                            <h3 class="card-title">Seller</h3>
                            <div class="card-title float-right">
                                <a href="{{ route('store-management-system.invoice.transaction') }}" wire:navigate>
                                    <input type="button" value="Transaction" class="btn btn-sm btn-primary" />
                                </a>
                                <a href="{{ route('store-management-system.class-has-product') }}" wire:navigate>
                                    <input type="button" value="Class Has Product" class="btn btn-sm btn-primary" />
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
                                            <th>Buyer</th>
                                            <th>Invoice</th>
                                            <th>Total</th>
                                            <th>Received</th>
                                            <th>Due</th>
                                            <th>Method</th>
                                            <th>Remarks</th>
                                            <th>By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->product_payment_id }}</td>
                                                <td>{{ $this->user($transaction->product_invoice_buyer_id) }}</td>
                                                <td>{{ $transaction->product_payment_product_invoice_id }}</td>
                                                <td>{{ $transaction->product_payment_total_due }}</td>
                                                <td>{{ $transaction->product_payment_payment_received }}</td>
                                                <td>{{ $transaction->product_payment_remaining_due }}</td>
                                                <td>{{ $transaction->product_payment_method }}</td>
                                                <td>{{ $transaction->product_payment_remarks }}</td>
                                                <td>{{ $this->user($transaction->product_payment_created_by) }}
                                                    ({{ $transaction->product_payment_created_at }})
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    Showing
                                    {{ $transactions->perPage() * ($transactions->currentPage() - 1) + 1 }} to
                                    {{ $transactions->perPage() * $transactions->currentPage() }} of
                                    {{ $transactions->total() }}
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="d-flex flex-row-reverse">
                                        @if (count($transactions))
                                            {{ $transactions->links() }}
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
