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
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6 mt-2">
                                        <label for="" class="ml-1 mr-1">Student</label>
                                        <select name="borrow_user_id" id="search_input_user"
                                            class="form-control select2 @error('borrow_user_id') border border-danger @enderror">
                                            <option value="" selected disabled>Student</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-xl-6 col-lg-6 mt-2">
                                        <label for="" class="ml-1 mr-1">Class</label>
                                        <select name="class_id" id="search_input_class"
                                            class="form-control @error('class_id') border border-danger @enderror">
                                            <option value="" selected disabled>Class</option>
                                            @if ($classes ?? '')
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        @if (old('class_id') == $class->id) selected @endif>
                                                        {{ $class->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-body">
                                <form action="{{ route('inventory.product.sale.store') }}" method="post" class="">
                                    @csrf
                                    <div id="book_list">
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

@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#search_input_user, #search_input_class").change(function(e) {

            e.preventDefault();
            console.log($("#search_input_user").val() + '|' + $("#search_input_class").val());

            $("#book_list").empty();
            // var search_input_user = $("#search_input_user").val();
            // var search_input_class = $("#search_input_class").val();

            $.ajax({
                type: 'get',
                url: "{!! route('inventory.product.sale.getBookOfClass') !!}",
                data: {
                    search_input_user: $("#search_input_user").val(),
                    search_input_class: $("#search_input_class").val(),
                },
                success: function(response) {
                    // var data = $.parseJSON(response);
                    $.each(response, function(key, value) {
                        var sn_id = key += 1;
                        $("#book_list").last().append(
                            '<div class="col col-md-6"><div class="form-group row">' +
                            '<label for="' +
                            value.product_id +
                            '" class="col col-form-label">' + sn_id + ' | ' +
                            value.product_name +
                            '</label>' +
                            '<div class="col col-sm-3">' +
                            '<input type="number" data-product="' + value.product_id +
                            '" name="product_id[]" value="' +
                            sn_id +
                            '" class="form-control" id="' +
                            value.product_id +
                            '"placeholder="Qty" style="display:none">' +
                            '<input type="number" data-product="' + value.product_id +
                            '" name="quantity[]" value="' +
                            sn_id +
                            '" class="form-control" id="' +
                            value.product_id +
                            '"placeholder="Qty">Default: ' + sn_id +
                            '</div></div></div>'
                        );
                    });
                }
            });
        });
    </script>
@endpush
