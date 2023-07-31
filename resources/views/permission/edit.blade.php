@extends('master')
@section('title', auth()->user()->role_name . ' ' . auth()->user()->last_name . ' | Permission Edit')
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
                                <h3 class="card-title">Role Edit</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('permission.index') }}">
                                        <input type="button" value="Permissions" class="btn btn-sm btn-warning">
                                    </a>
                                    <a href="{{ route('permission.create') }}">
                                        <input type="button" value="Permission Create" class="btn btn-sm btn-warning">
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('permission.update', $permission->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                        <label for="">Permission Name</label>
                                                        <input type="text"
                                                               class="form-control @error('permission_name') border border-danger @enderror "
                                                               name="permission_name"
                                                               @if (old('permission_name')) value="{{ old('permission_name') }}"
                                                               @elseif($permission->name != '') value="{{ $permission->name }}"
                                                               @endif
                                                               placeholder="Permission Name">
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

@push('scripts')
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
@endpush
