@extends('master')
@section('title', auth()->user()->role_name . ' ' . auth()->user()->last_name . ' | Role Create')
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
                                <h3 class="card-title">Role Create</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('role.index') }}">
                                        <input type="button" value="Roles" class="btn btn-sm btn-warning">
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('role.store') }}" method="post">
                                        @csrf
                                        @method('post')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                                        <label for="">Role Name</label>
                                                        <input type="text"
                                                               class="form-control @error('role_name') border border-danger @enderror "
                                                               name="role_name"
                                                               @if (old('role_name')) value="{{ old('role_name') }}"
                                                               @endif
                                                               placeholder="Role Name">
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Permissions</label>
                                                            <select class="select2 @error('guard_name') border border-danger @enderror" multiple="multiple"
                                                                    data-placeholder="Select Permissions"
                                                                    style="width: 100%;"
                                                                    name="permissions[]">
                                                                @foreach($permissions as $permission)
                                                                    <option>{{$permission}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
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
