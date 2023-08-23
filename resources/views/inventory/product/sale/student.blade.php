@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | User Create')
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
                                <h3 class="card-title">Sale Product</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('inventory.product.sale.render') }}">
                                        <button class="btn btn-sm btn-primary">Sold</button>
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('inventory.product.sale.getBooks') }}" method="post" class="">
                                    @csrf
                                    <div id="book_list">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6 mt-2">
                                                <label for="" class="ml-1 mr-1">Student</label>
                                                <select name="user_id" id="search_input_user"
                                                    class="form-control select2 @error('user_id') border border-danger @enderror">
                                                    <option value="" selected disabled>Student</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="save" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
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
        $('#search_input_user').select2({
            placeholder: "Choose user...",
            // minimumInputLength: 2,
            ajax: {
                url: '{{ route('inventory.product.sale.getUsers') }}',
                dataType: 'json',
                data: function(params) {
                    return {
                        search_input_user: $.trim(params.term).split(' ') // Array
                        // search_input_user: $.trim(params.term) // String
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.user_id + ' | ' + item.user_name + ' | ' + item.user_role +
                                    ' | ' + item.class_name +
                                    ' | ' + item.user_farher_anme,
                                id: item.user_id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endpush
