@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Image Index')
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
                                <h3 class="card-title">User Index</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('user.index') }}">
                                        <input type="button" value="View Users" class="btn btn-sm btn-primary">
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('image.update', $id) }}" method="post">
                                        @csrf
                                        <div>
                                            <div class="card card-primary card-outline">
                                                <div class="card-body box-profile">
                                                    <div class="text-center">
                                                        <img class="profile-user-img img-fluid img-circle"
                                                            style="height: 200px; width: 200px"
                                                            src="../../dist/img/user4-128x128.jpg"
                                                            alt="User profile picture">
                                                    </div>
                                                        <input type="file" name="image" class="form form-control">
                                                    </div>
                                                </div>
                                                <br>
                                                <button type="save" class="btn btn-block btn-primary">Save</button>
                                            </div>
                                        </div>
                                </div>
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
