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
                                <h3 class="card-title">Permission Assign</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('user_permission.index') }}">
                                        <input type="button" value="User Permissions" class="btn btn-sm btn-warning">
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('user_permission.store') }}" method="post">
                                        @csrf
                                        @method('post')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Search</label>
                                                            <select
                                                                class="input_search_date form-control select2 @error('id') border border-danger @enderror"
                                                                id="input_search_date" style="width: 100%;" name="id"
                                                                placeholder="User">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>Permissions</label>
                                                            <select
                                                                class="select2_permission @error('permissions') border border-danger @enderror"
                                                                multiple="multiple" data-placeholder="Select Permissions"
                                                                style="width: 100%;" name="permissions[]">
                                                                @foreach ($permissions as $permission)
                                                                    <option value="{{ $permission }}">{{ $permission }}
                                                                    </option>
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
        $(function() {
            //Initialize Select2 Elements
            $('.select2_permission').select2()
        })
    </script>
@endpush

@push('scripts')
    <script>
        $('#input_search_date').select2({
            placeholder: "Choose tags...",
            // minimumInputLength: 2,
            ajax: {
                url: '/user_permission_assign/data',
                dataType: 'json',
                data: function(params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.id + " | " + item.first_name + " " + item.middle_name + " " +
                                    item.last_name + " | " + " | " + item.role_name + " | " + item
                                    .email_alternate,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endpush
