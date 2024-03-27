<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <x-loading-indicator />
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('store-management-system.seller') }}"
                                wire:navigate>Seller</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('store-management-system.products', $id) }}"
                                wire:navigate>Products</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('store-management-system.cart', $id) }}"
                                wire:navigate>Cart</a>
                        </li>
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
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Note:</h5>
                        This page has been enhanced for printing. Click the print button at
                        the bottom of the invoice to test.
                    </div>

                    <div class="card">
                        {{-- <div class="card-header">

                        </div> --}}
                        <div class="card-body">
                            <div class="card">
                                <!-- Main content -->
                                <div class="invoice p-3">
                                    <!-- title row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                {{-- <i class="fas fa-globe"></i> --}}
                                                India Book Center
                                                <small class="float-right">Date:
                                                    {{ date('Y-M-d', strtotime($invoice[0]->product_invoice_created_at)) }}</small>
                                            </h4>
                                        </div>
                                        <!-- /.col -->
                                    </div>

                                    <!-- info row -->
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            From
                                            <address>
                                                <strong>{{ Auth()->user()->first_name }}
                                                    {{ Auth()->user()->middle_name }}
                                                    {{ Auth()->user()->last_name }}</strong><br>
                                                {{ Auth()->user()->address_line1 }}<br>
                                                {{ Auth()->user()->city }} {{ Auth()->user()->state }}
                                                {{ Auth()->user()->pin_code }}<br>
                                                Phone: {{ Auth()->user()->contact_number }}<br>
                                                Email: {{ Auth()->user()->email }}
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            To
                                            <address>
                                                <strong>{{ $user->first_name }} {{ $user->middle_name }}
                                                    {{ $user->last_name }}</strong><br>
                                                <span class="text-wrap">{{ $user->address_line1 }}</span><br>
                                                <span class="text-wrap">{{ $user->city }} {{ $user->state }}
                                                    {{ $user->pin_code }}</span><br>
                                                Phone: {{ $user->contact_number }}<br>
                                                Email: {{ $user->email }}
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            <b>Invoice {{ $invoice[0]->product_invoice_id }}</b>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Description</th>
                                                        <th>Price</th>
                                                        <th>Qty</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @dd($products) --}}
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
                                        <div class="col-5">
                                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                                {{-- Etsy doostang zoodles disqus groupon greplin oooj voxy
                                                zoodles, weebly ning heekya handango imeem
                                                plugg
                                                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt
                                                zimbra. --}}
                                            </p>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-7">
                                            <p class="lead">Amount Due
                                                {{ date('Y-m-d', strtotime($invoice[0]->product_invoice_created_at)) }}
                                            </p>

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:50%">Subtotal:</th>
                                                        <td>₹{{ $product_invoice->product_invoice_subtotal }}</td>
                                                    </tr>
                                                    @if ($product_invoice->product_invoice_discount > 0)
                                                        <tr>
                                                            <th>Discount:</th>
                                                            <td>₹{{ $product_invoice->product_invoice_discount }}</td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td>₹{{ $product_invoice->product_invoice_gross_total }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Due:</th>
                                                        <td>₹{{ $product_invoice->product_invoice_gross_total - $this->productInvoicePaidAmount($product_invoice->product_invoice_id) }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                    {{-- @dd($remaining_payment); --}}
                                    <!-- this row will not appear when printing -->
                                    <div class="row no-print">
                                        <div class="col-12">
                                            <a href="{{ route('store-management-system.invoice-print', [$id, $product_invoice_id]) }}"
                                                rel="noopener" target="_blank" class="btn btn-default"><i
                                                    class="fas fa-print"></i>
                                                Print</a>
                                            {{-- @dd($invoice[0]->product_invoice_id) --}}
                                            {{-- <a type="button" class="btn btn-success float-right"
                                                wire:click="payment('{{ $invoice[0]->product_invoice_id }}')">₹
                                                Payment
                                            </a> --}}
                                            @can('store_management_system_owner')
                                                @if (
                                                    $product_invoice->product_invoice_gross_total -
                                                        $this->productInvoicePaidAmount($product_invoice->product_invoice_id) >
                                                        0)
                                                    <button type="button" class="btn btn-primary float-right"
                                                        data-toggle="modal" data-target="#modal-discount">
                                                        ₹ Discount
                                                    </button>
                                                @endif
                                            @endcan
                                            @can('store_management_system_manage')
                                                @if (
                                                    $product_invoice->product_invoice_gross_total -
                                                        $this->productInvoicePaidAmount($product_invoice->product_invoice_id) >
                                                        0)
                                                    <button type="button" class="btn btn-primary float-right"
                                                        data-toggle="modal" data-target="#modal-payment"
                                                        style="margin-right: 5px;">
                                                        ₹ Payment
                                                    </button>
                                                @endif
                                            @endcan
                                            {{-- <button type="button" class="btn btn-primary float-right"
                                                style="margin-right: 5px;">
                                                <i class="fas fa-download"></i> Generate PDF
                                            </button> --}}
                                        </div>
                                    </div>
                                </div>
                                <!-- /.invoice -->
                            </div>
                        </div>
                    </div>
                    {{-- invlice payments --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payment Details</h3>
                            <div class="card-title float-right">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Total</th>
                                                <th>Paid</th>
                                                <th>Due</th>
                                                <th>Date</th>
                                                <th>Received By</th>
                                                <th>Method</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoice_payments as $kay => $invoice_payment)
                                                <tr>
                                                    <td>{{ $kay + 1 }}</td>
                                                    <td>₹{{ $invoice_payment->product_payment_total_due }}</td>
                                                    <td>₹{{ $invoice_payment->product_payment_payment_received }}</td>
                                                    <td>₹{{ $invoice_payment->product_payment_remaining_due }}</td>
                                                    <td>{{ $invoice_payment->product_payment_created_at }}
                                                    </td>
                                                    <td>{{ $this->user($invoice_payment->product_payment_created_by) }}
                                                    </td>
                                                    <td>{{ $invoice_payment->product_payment_method }}
                                                    </td>
                                                    <td>{{ $invoice_payment->product_payment_remarks }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    {{-- payment --}}
    <div class="modal fade" id="modal-payment" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form wire:submit="payment('{{ $invoice[0]->product_invoice_id }}')" action="" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Payment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col col-12">
                                <label for="" class="ml-1 mr-1">Payable</label>
                                <input type="text" class="form-control"
                                    value="{{ $product_invoice->product_invoice_due }}" placeholder="Payable"
                                    @disabled(true)>
                            </div>
                            <div class="col col-12">
                                <label for="" class="ml-1 mr-1">Received amount</label>
                                <input wire:model="payment_received" name="payment_received" type="text"
                                    class="form-control" value="" placeholder="Received amount">
                            </div>
                            <div class="col col-12">
                                <label for="" class="ml-1 mr-1">Method</label>
                                <select wire:model="product_payment_method" name="product_payment_method"
                                    class="form-control" @required(true)>
                                    <option @selected(true) value="">Select</option>
                                    <option value="Online">Online</option>
                                    <option value="Cash">Cash</option>
                                </select>
                            </div>
                            <div class="col col-12">
                                <label for="" class="ml-1 mr-1">Remarks</label>
                                <input wire:model="product_payment_remarks" name="product_payment_remarks"
                                    type="text" class="form-control" value="" placeholder="Payment remarks"
                                    @required(true)>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                    </div>
                </form>
            </div>

        </div>

    </div>

    {{-- discount --}}
    <div class="modal fade" id="modal-discount" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form wire:submit="discount('{{ $invoice[0]->product_invoice_id }}')" action="" method="post">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Payment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col col-12">
                                <label for="" class="ml-1 mr-1">Payable</label>
                                <input type="text" class="form-control"
                                    value="{{ $product_invoice->product_invoice_due }}" placeholder="Payable"
                                    @disabled(true)>
                            </div>
                            <div class="col col-12">
                                <label for="" class="ml-1 mr-1">Discount amount</label>
                                <input wire:model="payment_discount" name="payment_discount" type="number"
                                    class="form-control" placeholder="Discount amount" min="0">
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
<!-- /.content-wrapper -->
@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('modal_close_payment', (event) => {
                $('#modal-payment').modal('hide');
            });

            Livewire.on('modal_close_discount', (event) => {
                $('#modal-discount').modal('hide');
            });
        });
    </script>
@endpush
