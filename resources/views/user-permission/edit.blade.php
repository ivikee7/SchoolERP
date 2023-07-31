@extends('master')
@section('title', auth()->user()->role_name . ' ' . auth()->user()->last_name . ' | Role Edit')
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
                                    <a href="{{ route('user_permission.index') }}">
                                        <input type="button" value="Permissions" class="btn btn-sm btn-warning">
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('user_permission.update', $user->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Permissions</label>
                                                            <select class="select2 @error('permissions') border border-danger @enderror" multiple="multiple"
                                                                    data-placeholder="Select Permissions"
                                                                    style="width: 100%;"
                                                                    name="permissions[]">
                                                                @foreach($permissions as $permission)
                                                                    <option @if($user->hasDirectPermission($permission)) selected @endif>{{$permission}}</option>
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
