@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Leave Create')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
        <!-- Main content -->
        <section class="content attendance">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Leave Create</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('user.attendance.leave.management.index') }}">
                                        <input type="button" value="Preview leave" class="btn btn-sm btn-primary">
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('user.attendance.leave.management.store') }}" method="post">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">From Date</label>
                                                        <input type="date"
                                                            class="form-control @error('leave_from') border border-danger @enderror "
                                                            name="leave_from" value="{{ old('leave_from') }}"
                                                            placeholder="Leave From"
                                                            required>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">To Date</label>
                                                        <input type="date"
                                                            class="form-control @error('leave_to') border border-danger @enderror "
                                                            name="leave_to" value="{{ old('leave_to') }}"
                                                            placeholder="Leave To"
                                                            required>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Message</label>
                                                        <input type="text"
                                                            class="form-control @error('message') border border-danger @enderror "
                                                            name="message" value="{{ old('message') }}"
                                                            placeholder="Message"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer">
                                                <button type="save" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </form>
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
@endsection()
