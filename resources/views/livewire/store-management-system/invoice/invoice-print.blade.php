<main>
    <div class="wrapper">
        <!-- Main content -->
        <div class="row">
            <div class="col-6">
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                {{-- <i class="fas fa-globe"></i> --}}
                                India Book Center
                                <small class="float-right">Date:
                                    {{ date('Y-M-d h:i:s', strtotime($invoice[0]->product_invoice_created_at)) }}</small>
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
                                <strong>{{ $user->first_name }} {{ $user->middle_name }}
                                    {{ $user->last_name }}</strong><br>
                                <span class="text-wrap">{{ $user->address_line1 }}</span><br>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 invoice-col">
                            <b>Invoice {{ $invoice[0]->product_invoice_id }}</b>
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
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_description }}</td>
                                            <td>₹{{ $product->product_invoice_item_price }}</td>
                                            <td>{{ $product->product_invoice_item_quantity }}</td>
                                            <td>₹{{ $product->product_invoice_item_quantity * $product->product_invoice_item_price }}
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
                            <p class="lead">Amount Due
                                {{ date('Y-m-d', strtotime($invoice[0]->product_invoice_created_at)) }}</p>

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
                                    <tr>
                                        <th>Total:</th>
                                        <td>₹{{ $total }}</td>
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
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                {{-- <i class="fas fa-globe"></i> --}}
                                India Book Center
                                <small class="float-right">Date:
                                    {{ date('Y-M-d h:i:s', strtotime($invoice[0]->product_invoice_created_at)) }}</small>
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
                                <strong>{{ $user->first_name }} {{ $user->middle_name }}
                                    {{ $user->last_name }}</strong><br>
                                <span class="text-wrap">{{ $user->address_line1 }}</span><br>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 invoice-col">
                            <b>Invoice {{ $invoice[0]->product_invoice_id }}</b>
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
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_description }}</td>
                                            <td>₹{{ $product->product_invoice_item_price }}</td>
                                            <td>{{ $product->product_invoice_item_quantity }}</td>
                                            <td>₹{{ $product->product_invoice_item_quantity * $product->product_invoice_item_price }}
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
                            <p class="lead">Amount Due
                                {{ date('Y-m-d', strtotime($invoice[0]->product_invoice_created_at)) }}</p>

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
                                    <tr>
                                        <th>Total:</th>
                                        <td>₹{{ $total }}</td>
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
