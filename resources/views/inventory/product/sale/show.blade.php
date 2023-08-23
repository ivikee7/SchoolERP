@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Users')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Invoice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <small class="float-right">Date:
                                            {{ date('d-M-Y', strtotime($invoice->created_at)) }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <!-- /.col -->
                                <div class="col-sm-6 invoice-col">
                                    To
                                    <address>
                                        <strong>{{ $buyer->first_name . ' ' . $buyer->middle_name . ' ' . $buyer->last_name }}</strong><br>
                                        {{ $buyer->address_line1 }}<br>
                                        @if ($buyer->address_line2 != '')
                                            {{ $buyer->address_line2 }}<br>
                                        @endif
                                        Phone: {{ $buyer->contact_number }}<br>
                                        Email: {{ $buyer->email }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 invoice-col">
                                    <b class="float-right">Invoice
                                        #{{ date('Y/m/', strtotime($invoice->created_at)) . $invoice->product_invoice_id }}</b><br>
                                    <br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoice_items as $key => $invoice_item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $invoice_item->product_name }}</td>
                                                    <td>{{ $invoice_item->product_description }}</td>
                                                    <td>₹{{ $invoice_item->product_invoice_item_price }}</td>
                                                    <td>{{ $invoice_item->product_invoice_item_quantity }}</td>
                                                    <td>₹{{ $invoice_item->product_invoice_item_subtotal }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">

                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <p class="lead">Amount Due
                                        {{ date('d-M-Y', strtotime($invoice->product_invoice_due_date)) }}</p>

                                    <div class="table-responsive  table-sm">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>₹{{ $invoice->product_invoice_subtotal }}</td>
                                            </tr>
                                            @if ($invoice->product_invoice_discount > 0)
                                                <tr>
                                                    <th>Discount:</th>
                                                    <td>₹{{ $invoice->product_invoice_discount }}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <th>Total:</th>
                                                <td>₹{{ $invoice->product_invoice_gross_total }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="{{ route('inventory.product.sale.invoice.print', $invoice->product_invoice_id) }}"
                                        rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i>
                                        Print</a>
                                    <button type="button" class="btn btn-success float-right"><i
                                            class="far fa-credit-card"></i> Submit
                                        Payment
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection()

@push('styles')
@endpush
@push('scripts')
@endpush
