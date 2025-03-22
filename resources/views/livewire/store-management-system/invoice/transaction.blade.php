<div>
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
                                <div class="row">
                                    <div class="form-group pr-1">
                                        <input type="date" class="form-control form-control-sm" name="date"
                                            wire:model.live="date">
                                    </div>
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
                                    <a href="{{ route('store-management-system.invoice.transaction') }}" wire:navigate
                                        class="pr-1">
                                        <input type="button" value="Transaction" class="btn btn-sm btn-primary" />
                                    </a>
                                    <a href="{{ route('store-management-system.class-has-product') }}" wire:navigate
                                        class="pr-1">
                                        <input type="button" value="Class Has Product"
                                            class="btn btn-sm btn-primary" />
                                    </a>
                                    <a href="{{ route('store-management-system.invoices') }}" wire:navigate
                                        class="pr-1">
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
                                            <th>TID</th>
                                            <th>StuID</th>
                                            <th>Student</th>
                                            <th>Invoice</th>
                                            <th>Total</th>
                                            <th>Rem.</th>
                                            <th>Received</th>
                                            <th>Due</th>
                                            <th>Method</th>
                                            <th>Remarks</th>
                                            <th>By</th>
                                            <th>At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->product_payment_id }}</td>
                                                <td>{{ $transaction->invoice->student->id }}</td>
                                                <td>
                                                    {{ $transaction->invoice->student->first_name }}
                                                    {{ $transaction->invoice->student->middel_name }}
                                                    {{ $transaction->invoice->student->last_name }}
                                                </td>
                                                <td>{{ $transaction->invoice->product_invoice_id }}</td>
                                                <td>{{ $transaction->invoice->product_invoice_subtotal }}</td>
                                                <td>{{ $transaction->product_payment_total_due }}</td>
                                                <td>{{ $transaction->product_payment_payment_received }}</td>
                                                <td>{{ $transaction->product_payment_remaining_due }}</td>
                                                <td>{{ $transaction->product_payment_method }}</td>
                                                <td>{{ $transaction->product_payment_remarks }}</td>
                                                <td>
                                                    ({{ $transaction->creator->id }})
                                                    {{ $transaction->creator->first_name }}
                                                    {{ $transaction->creator->middle_name }}
                                                    {{ $transaction->creator->last_name }}
                                                    {{-- {{ $this->user($transaction->product_payment_created_by) }} --}}
                                                </td>
                                                <td>
                                                    {{ $transaction->product_payment_created_at }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>{{ $transactions->sum('product_payment_payment_received') }}</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
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

            {{-- Date Details --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Overview</h3>
                            <div class="card-title float-right">
                            </div>
                        </div>
                        <!-- /.card-header -->

                        {{-- new start --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-striped display" style="width: 100%">
                                    <tr>
                                        <th>Total</th>
                                        <th>Discount</th>
                                        <th>Received</th>
                                        <th>Due</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $total['amount_total'] }}</td>
                                        <td>{{ $total['amount_discount'] }}</td>
                                        <td>{{ $total['amount_received'] }}</td>
                                        <td>{{ $total['amount_due'] }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-striped display" style="width: 100%">
                                    <tr>
                                        <th>Cash</th>
                                        <th>Online</th>
                                        <th>Total</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ $total['amount_cash'] }}
                                            @if ($date)
                                                <br>
                                                ({{ $date }})
                                            @endif
                                        </td>
                                        <td>
                                            {{ $total['amount_online'] }}
                                            @if ($date)
                                                <br>
                                                ({{ $date }})
                                            @endif
                                        </td>
                                        <td>
                                            {{ $total['amount_cash_and_online'] }}
                                            @if ($date)
                                                <br>
                                                ({{ $date }})
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        {{-- new end --}}

                        {{-- <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered table-striped display" style="width: 100%">
                                    <tr>
                                        <th>sub_total</th>
                                        <th>discount</th>
                                        <th>gross_total</th>
                                        <th>due</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $transactions_total['sub_total'] }}</td>
                                        <td>{{ $transactions_total['discount'] }}</td>
                                        <td>{{ $transactions_total['gross_total'] }}</td>
                                        <td>{{ $transactions_total['due'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div> --}}
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            {{-- Date Details End --}}

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
