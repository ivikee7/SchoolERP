<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Invoice Print</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/pro/v5.10.0/css/all.css') }}">
    {{-- Theme style --}}
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="" style="font-size: 12px">
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <div class="row">
                <div class="col-6">
                    <div class="border p-1">
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
                            <div class="col-sm-8 invoice-col">
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
                            <div class="col-sm-4 invoice-col">
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
                                <p class="h6 font-weight-light">Amount Due
                                    {{ date('d-M-Y', strtotime($invoice->product_invoice_due_date)) }}</p>

                                <div class="table-responsive">
                                    <table class="table table-sm">
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
                    </div>
                </div>
                <div class="col-6">
                    <div class="border p-1">
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
                            <div class="col-sm-8 invoice-col">
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
                            <div class="col-sm-4 invoice-col">
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
                                <p class="h6 font-weight-light">Amount Due
                                    {{ date('d-M-Y', strtotime($invoice->product_invoice_due_date)) }}</p>

                                <div class="table-responsive">
                                    <table class="table table-sm">
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
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
