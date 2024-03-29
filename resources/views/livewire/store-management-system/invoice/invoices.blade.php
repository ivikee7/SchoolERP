<main>
    <div class="content-wrapper">
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
                            <li class="breadcrumb-item"><a
                                    href="{{ route('store-management-system.seller') }}">Seller</a>
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
                                    <a href="{{ route('store-management-system.seller') }}">
                                        <input type="button" value="Seller" class="btn btn-sm btn-primary">
                                    </a>
                                    <a href="{{ route('store-management-system.invoice.payment') }}">
                                        <input type="button" value="Payment" class="btn btn-sm btn-primary">
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
                                    <table class="table table-sm table-bordered table-striped display"
                                        style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Invoice</th>
                                                <th>Buyer Name</th>
                                                <th>Class</th>
                                                <th>SubTotal</th>
                                                <th>Discount</th>
                                                <th>Total</th>
                                                <th>Paid</th>
                                                <th>Due</th>
                                                <th>Discount By</th>
                                                <th>Discount At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoices as $key => $invoice)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $invoice->product_invoice_id }}</td>
                                                    <td>{{ $invoice->first_name . ' ' . $invoice->middle_name . ' ' . $invoice->last_name }}
                                                    </td>
                                                    <td>{{ $this->getClass($invoice->product_invoice_id) }}
                                                    </td>
                                                    <td>{{ $invoice->product_invoice_subtotal }}</td>
                                                    <td>{{ $invoice->product_invoice_discount }}</td>
                                                    <td>{{ $invoice->product_invoice_gross_total }}</td>
                                                    <td>{{ $invoice->product_invoice_gross_total - $invoice->product_invoice_due }}
                                                    </td>
                                                    <td>{{ $invoice->product_invoice_due }}</td>
                                                    <td>{{ $this->user($invoice->product_invoice_discount_by) }}</td>
                                                    <td>{{ $invoice->product_invoice_discount_at }}</td>
                                                    <td><a wire:navigate class="btn btn-primary btn-xs"
                                                            href="{{ route('store-management-system.invoice', [$invoice->id, $invoice->product_invoice_id]) }}">Invoice</a>
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
                                                <th>{{ $invoices->sum('product_invoice_subtotal') }}</th>
                                                <th>{{ $invoices->sum('product_invoice_discount') }}</th>
                                                <th>{{ $invoices->sum('product_invoice_gross_total') }}</th>
                                                <th>{{ $invoices->sum('product_invoice_gross_total') - $invoices->sum('product_invoice_due') }}
                                                </th>
                                                <th>{{ $invoices->sum('product_invoice_due') }}</th>
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
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</main>
