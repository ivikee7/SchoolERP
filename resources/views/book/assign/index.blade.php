@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Users')
@section('content')
    @can('user_show')
        <div class="content-wrapper overlay">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            </section>
            <!-- Main content -->
            <section class="content attendance">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-6">
                                            <div class="card card-secondary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Class Books</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <select name="student" id="class"
                                                                class="form-control select2bs4 @error('student') border border-danger @enderror">
                                                                <option value="" selected disabled>Class</option>
                                                                @if ($classes ?? '')
                                                                    @foreach ($classes as $class)
                                                                        <option value="{{ $class->id }}"
                                                                            @if (old('class') == $class->id) selected @endif>
                                                                            {{ $class->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>

                                                        <div id="output-class">

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary btn-block">Remove</button>
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                        <div class="col-6">
                                            <div class="card card-secondary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Book list</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div id="output-book" class="col pre-scrollable"
                                                            style="max-height: 75vh">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.col -->
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {

            });
        </script>
    @endcan
@endsection()
@push('styles')
@endpush
@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $.ajax({
                type: 'get',
                url: "{{ route('book.assign.get.classes') }}",
                success: function(response) {
                    $.each(response, function(key, value) {
                        var id = key += 1;
                        $("#class").last().append(
                            "<option value=" + id + ">" + value.name +
                            "</option>"
                        );
                    });
                }
            });
        })

        $(document).ready(function() {
            $.ajax({
                type: 'get',
                url: "{{ route('book.assign.get.books') }}",
                success: function(response) {
                    $.each(response, function(key, value) {
                        var output_book_sn = key += 1;
                        $("#output-book").last().append(
                            "<div class='mt-1' style='display: block;'><div class='icheck-primary d-inline'> <input type='checkbox' id='checkboxPrimary" +
                            "OutputBook" +
                            value.id + "' name='id_is[]' value=" + value
                            .id + "> <label for='checkboxPrimary" +
                            "OutputBook" + value
                            .id + "'> " + output_book_sn + ' | ' +
                            value.title + " - Edition: " + value.edition + " Auther: " + value
                            .auther + " @" + value.price +
                            " </label> </div><br></div>");
                    });
                }
            });
        })

        $("#class").change(function(e) {
            e.preventDefault();
            $("#output-class").empty();
            var input_class = $("#class").val();
            $.ajax({
                type: 'get',
                url: "{{ route('book.assign.get.class.books') }}" + "/" + input_class,
                success: function(response) {
                    $.each(response, function(key, value) {
                        var sn_id = key += 1;
                        $("#output-class").last().append(
                            "<div class='mt-1'><div class='icheck-primary d-inline'> <input type='checkbox' id='checkboxPrimary" +
                            "OutputClass" +
                            value.id + "' name='id_is[]' value=" + value
                            .id + "> <label for='checkboxPrimary" +
                            "OutputClass" + value
                            .id + "'> " + sn_id + ' | ' +
                            value.title + " - Edition: " + value.edition + " Auther: " + value
                            .auther + " @" + value.price +
                            " </label> </div><br></div>");
                    });
                }
            });
        });
    </script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endpush
