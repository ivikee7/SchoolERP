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
                                                <th>SubTotal</th>
                                                <th>Discount</th>
                                                <th>Total</th>
                                                <th>Paid</th>
                                                <th>Due</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments as $key => $payment)
                                                @dd($payment);
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $payment->product_payment_id }}</td>
                                                    <td>{{ $payment->first_name . ' ' . $payment->middle_name . ' ' . $payment->last_name }}
                                                    </td>
                                                    <td>{{ $payment->product_payment_subtotal }}</td>
                                                    <td>{{ $payment->product_payment_discount }}
                                                    </td>
                                                    <td>{{ $payment->product_payment_gross_total }}</td>
                                                    <td>{{ $payment->product_payment_gross_total - $payment->product_payment_due }}
                                                    </td>
                                                    <td>{{ $payment->product_payment_due }}
                                                    </td>
                                                    <td>
                                                        {{-- <a wire:navigate class="btn btn-primary btn-xs"
                                                            href="{{ route('store-management-system.invoice', [$payment->id, $payment->product_payment_id]) }}">Invoice</a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        Showing
                                        {{ $payments->perPage() * ($payments->currentPage() - 1) + 1 }} to
                                        {{ $payments->perPage() * $payments->currentPage() }} of
                                        {{ $payments->total() }}
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="d-flex flex-row-reverse">
                                            @if (count($payments))
                                                {{ $payments->links() }}
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
