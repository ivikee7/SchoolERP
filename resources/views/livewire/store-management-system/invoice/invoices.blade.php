<main>
    <div>
        <x-loading-indicator />
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Seller</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('store-management-system.seller') }}">Seller</a>
                            </li>
                            <li class="breadcrumb-item active">Invoices</li>
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
                                <h3 class="card-title">Invoices</h3>
                                <div class="card-title float-right">
                                    <div class="row">
                                        <div class="form-group pr-1">
                                            <select class="form-control form-control-sm"
                                                wire:model.live="acadamic_session">
                                                <option @selected(true) @disabled(true)>select
                                                </option>
                                                @if ($acadamic_sessions)
                                                    @foreach ($acadamic_sessions as $as)
                                                        <option value="{{ $as->id }}">{{ $as->name }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>
                                        <a href="{{ route('store-management-system.seller') }}">
                                            <input type="button" value="Seller" class="btn btn-sm btn-primary">
                                        </a>
                                        <a href="{{ route('store-management-system.invoice.payment') }}">
                                            <input type="button" value="Payment" class="btn btn-sm btn-primary">
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
                                    <table class="table table-sm table-bordered table-striped display"
                                        style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Invoice</th>
                                                <th>StuId</th>
                                                <th>Student</th>
                                                <th>Class</th>
                                                <th>SubTotal</th>
                                                <th>Discount</th>
                                                <th>Total</th>
                                                <th>Paid</th>
                                                <th>Due</th>
                                                <th>Discount By</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            {{-- @dd($invoices) --}}

                                            {{-- new --}}
                                            @foreach ($invoices as $key => $invoice)
                                                {{-- @dd($invoice) --}}
                                                <tr>
                                                    <td>{{ $invoice->product_invoice_id }}</td>
                                                    <td>{{ $invoice->product_invoice_buyer_id }}</td>
                                                    <td>{{ $invoice->student->first_name . ' ' . $invoice->student->middle_name . ' ' . $invoice->student->last_name }}
                                                    </td>
                                                    <td>{{ $invoice->class->name }}
                                                    </td>
                                                    <td>{{ $invoice->product_invoice_subtotal }}</td>
                                                    <td>{{ $invoice->product_invoice_discount }}</td>
                                                    <td>{{ $invoice->product_invoice_gross_total }}</td>
                                                    <td>{{ $invoice->product_invoice_gross_total - $invoice->product_invoice_due }}
                                                    </td>
                                                    <td>{{ $invoice->product_invoice_due }}</td>
                                                    <td>
                                                        @if ($invoice->product_invoice_discount_by)
                                                            ({{ $invoice->discountBy->id }})
                                                            {{ $invoice->discountBy->first_name }}
                                                            {{ $invoice->discountBy->middle_name }}
                                                            {{ $invoice->discountBy->last_name }}
                                                            ({{ $invoice->product_invoice_discount_at }})
                                                        @endif
                                                    </td>
                                                    <td>
                                                        ({{ $invoice->creator->id }})
                                                        {{ $invoice->creator->first_name }}
                                                        {{ $invoice->creator->middle_name }}
                                                        {{ $invoice->creator->last_name }}
                                                        ({{ $invoice->product_invoice_created_at }})
                                                    </td>
                                                    <td><a wire:navigate class="btn btn-primary btn-xs"
                                                            href="{{ route('store-management-system.invoice', [$invoice->student->id, $invoice->product_invoice_id]) }}">Invoice</a>
                                                        @if (!$this->paymentNotReceived($invoice->product_invoice_id))
                                                            <button
                                                                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                                                wire:click="destroy({{ $invoice->product_invoice_id }})"
                                                                class="btn btn-warning btn-xs">Delete!</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{-- new end --}}

                                            {{-- @foreach ($invoices as $key => $invoice)
                                                <tr>
                                                    <td>{{ $invoice->product_invoice_buyer_id }}</td>
                                                    <td>{{ $invoice->product_invoice_id }}</td>
                                                    <td>{{ $invoice->first_name . ' ' . $invoice->middle_name . ' ' . $invoice->last_name }}
                                                    </td>
                                                    <td>{{ $this->getClass($invoice->product_invoice_id) }}
                                                    </td>
                                                    <td>{{ $this->getSection($invoice->product_invoice_buyer_id) }}
                                                    </td>
                                                    <td>{{ $invoice->product_invoice_subtotal }}</td>
                                                    <td>{{ $invoice->product_invoice_discount }}</td>
                                                    <td>{{ $invoice->product_invoice_gross_total }}</td>
                                                    <td>{{ $invoice->product_invoice_gross_total - $invoice->product_invoice_due }}
                                                    </td>
                                                    <td>{{ $invoice->product_invoice_due }}</td>
                                                    <td>{{ $this->user($invoice->product_invoice_discount_by) }}</td>
                                                    <td>{{ $invoice->product_invoice_discount_at }}</td>
                                                    <td>{{ $invoice->product_invoice_created_at }}</td>
                                                    <td><a wire:navigate class="btn btn-primary btn-xs"
                                                            href="{{ route('store-management-system.invoice', [$invoice->id, $invoice->product_invoice_id]) }}">Invoice</a>
                                                        @if (!$this->paymentNotReceived($invoice->product_invoice_id))
                                                            <button
                                                                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                                                wire:click="destroy({{ $invoice->product_invoice_id }})"
                                                                class="btn btn-warning btn-xs">Delete!</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>{{ $invoices->sum('product_invoice_subtotal') }}</th>
                                                <th>{{ $invoices->sum('product_invoice_discount') }}</th>
                                                <th>{{ $invoices->sum('product_invoice_gross_total') }}</th>
                                                <th>{{ $invoices->sum('product_invoice_gross_total') - $invoices->sum('product_invoice_due') }}
                                                </th>
                                                <th>{{ $invoices->sum('product_invoice_due') }}</th>
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
                                        {{ $invoices->perPage() * ($invoices->currentPage() - 1) + 1 }} to
                                        {{ $invoices->perPage() * $invoices->currentPage() }} of
                                        {{ $invoices->total() }}
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="d-flex flex-row-reverse">
                                            @if (count($invoices))
                                                {{ $invoices->links() }}
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
                                    <table class="table table-sm table-bordered table-striped display"
                                        style="width: 100%">
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
                                    <table class="table table-sm table-bordered table-striped display"
                                        style="width: 100%">
                                        <tr>
                                            <th>Cash</th>
                                            <th>Online</th>
                                        </tr>
                                        <tr>
                                            <td>{{ $total['amount_cash'] }}</td>
                                            <td>{{ $total['amount_online'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            {{-- new end --}}

                            {{-- <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-striped display"
                                        style="width: 100%">
                                        <tr>
                                            <th>SubTotal</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                            <th>Received</th>
                                            <th>Due</th>
                                        </tr>
                                        <tr>
                                            <td>{{ (float) $transactions_total['sub_total'] }}</td>
                                            <td>{{ (float) $transactions_total['discount'] }}</td>
                                            <td>{{ (float) $transactions_total['gross_total'] }}</td>
                                            <td>{{ (float) $transactions_total['gross_total'] - (float) $transactions_total['due'] }}
                                            </td>
                                            <td>{{ (float) $transactions_total['due'] }}</td>
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

</main>
