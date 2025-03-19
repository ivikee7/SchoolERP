<main>
    <div class="wrapper">
        <!-- Main content -->
        <div class="row" style="font-size:20px;">
            <div class="col-6">
                <section class="invoice border p-2">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                {{-- <i class="fas fa-globe"></i> --}}
                                India Book Center
                                <small class="float-right">Date:
                                    {{ date('Y-M-d h:i:s', strtotime($invoice_new->product_invoice_created_at)) }}</small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <!-- /.col -->
                        <div class="col-sm-9 invoice-col">
                            To
                            <address>
                                <strong>{{ $invoice_new->student->first_name }} {{ $invoice_new->student->middle_name }}
                                    {{ $invoice_new->student->last_name }}</strong><br>
                                <span class="text-wrap">{{ $invoice_new->student->address_line1 }}</span><br>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 invoice-col">
                            <b>Invoice {{ $invoice_new->product_invoice_id }}</b>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-sm table-smtable-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Class</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoice_new->items as $item)
                                        <tr>
                                            <td>{{ $item->classHasProduct->product->product_name }}
                                                @if ($item->classHasProduct->product->product_description)
                                                <br>
                                                    ({{ $item->classHasProduct->product->product_description }})
                                                @endif
                                            </td>
                                            <td>{{ $item->classHasProduct->class->name }}</td>
                                            <td>₹{{ $item->product_invoice_item_price }}</td>
                                            <td>{{ $item->product_invoice_item_quantity }}</td>
                                            <td>₹{{ $item->product_invoice_item_quantity * $item->product_invoice_item_price }}
                                            </td>
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
                            {{-- <p class="lead">Payment Methods:</p>
                            <img src="../../dist/img/credit/visa.png" alt="Visa">
                            <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                            <img src="../../dist/img/credit/american-express.png" alt="American Express">
                            <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy
                                zoodles, weebly ning heekya handango imeem
                                plugg
                                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt
                                zimbra.
                            </p> --}}
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>₹{{ $total }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Tax (9.3%)</th>
                                        <td>$10.34</td>
                                    </tr> --}}
                                    {{-- <tr>
                                        <th>Shipping:</th>
                                        <td>$5.80</td>
                                    </tr> --}}
                                    @if ($invoice_new->product_invoice_discount > 0)
                                        <tr>
                                            <th>Discount:</th>
                                            <td>₹{{ $invoice_new->product_invoice_discount }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>Total:</th>
                                        <td>₹{{ $invoice_new->product_invoice_gross_total }}</td>
                                    </tr>
                                    <tr>
                                        <th>Due:</th>
                                        <td>₹{{ $invoice_new->product_invoice_gross_total - $this->productInvoicePaidAmount($invoice_new->product_invoice_id) }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <div class="col-6">
                <section class="invoice border p-2">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                {{-- <i class="fas fa-globe"></i> --}}
                                India Book Center
                                <small class="float-right">Date:
                                    {{ date('Y-M-d h:i:s', strtotime($invoice_new->product_invoice_created_at)) }}</small>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <!-- /.col -->
                        <div class="col-sm-9 invoice-col">
                            To
                            <address>
                                <strong>{{ $invoice_new->student->first_name }}
                                    {{ $invoice_new->student->middle_name }}
                                    {{ $invoice_new->student->last_name }}</strong><br>
                                <span class="text-wrap">{{ $invoice_new->student->address_line1 }}</span><br>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 invoice-col">
                            <b>Invoice {{ $invoice_new->product_invoice_id }}</b>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-sm table-smtable-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Class</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoice_new->items as $item)
                                        <tr>
                                            <td>{{ $item->classHasProduct->product->product_name }}
                                                @if ($item->classHasProduct->product->product_description)
                                                <br>
                                                    ({{ $item->classHasProduct->product->product_description }})
                                                @endif
                                            </td>
                                            <td>{{ $item->classHasProduct->class->name }}</td>
                                            <td>₹{{ $item->product_invoice_item_price }}</td>
                                            <td>{{ $item->product_invoice_item_quantity }}</td>
                                            <td>₹{{ $item->product_invoice_item_quantity * $item->product_invoice_item_price }}
                                            </td>
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
                            {{-- <p class="lead">Payment Methods:</p>
                            <img src="../../dist/img/credit/visa.png" alt="Visa">
                            <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                            <img src="../../dist/img/credit/american-express.png" alt="American Express">
                            <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy
                                zoodles, weebly ning heekya handango imeem
                                plugg
                                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt
                                zimbra.
                            </p> --}}
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td>₹{{ $total }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th>Tax (9.3%)</th>
                                        <td>$10.34</td>
                                    </tr> --}}
                                    {{-- <tr>
                                        <th>Shipping:</th>
                                        <td>$5.80</td>
                                    </tr> --}}
                                    @if ($invoice_new->product_invoice_discount > 0)
                                        <tr>
                                            <th>Discount:</th>
                                            <td>₹{{ $invoice_new->product_invoice_discount }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>Total:</th>
                                        <td>₹{{ $invoice_new->product_invoice_gross_total }}</td>
                                    </tr>
                                    <tr>
                                        <th>Due:</th>
                                        <td>₹{{ $invoice_new->product_invoice_gross_total - $this->productInvoicePaidAmount($invoice_new->product_invoice_id) }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
        </div>

    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</main>
