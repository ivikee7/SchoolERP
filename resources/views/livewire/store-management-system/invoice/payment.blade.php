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
                                    <a href="{{ route('store-management-system.seller') }}">
                                        <input type="button" value="Seller" class="btn btn-sm btn-primary">
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row d-grid gap-3">
                                    <div class="card col-sm-12 col-md-6 col-lg-4">
                                        <div class="card-header">
                                            <h3 class="card-title text-center">{{ auth()->user()->first_name }}</h3>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered table-striped display"
                                                style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($payments as $key => $payment)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $payment->product_payment_gross_total }}</td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card col-sm-12 col-md-6 col-lg-4">
                                        <div class="card-header">
                                            <h3 class="card-title text-center">{{ auth()->user()->first_name }}</h3>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered table-striped display"
                                                style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($payments as $key => $payment)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $payment->product_payment_gross_total }}</td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card col-sm-12 col-md-6 col-lg-4">
                                        <div class="card-header">
                                            <h3 class="card-title text-center">{{ auth()->user()->first_name }}</h3>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered table-striped display"
                                                style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($payments as $key => $payment)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $payment->product_payment_gross_total }}</td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card col-sm-12 col-md-6 col-lg-4">
                                        <div class="card-header">
                                            <h3 class="card-title text-center">{{ auth()->user()->first_name }}</h3>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-bordered table-striped display"
                                                style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($payments as $key => $payment)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $payment->product_payment_gross_total }}</td>
                                                            <td></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
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
