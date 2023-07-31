@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Student Profile')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('student.change.class.section.update') }}"
                                      method="post" class="col-12">
                                    @csrf
                                    @method('post')
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="card card-secondary">
                                                <div class="card-header">
                                                    <h3 class="card-title">From Class</h3>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <!-- select -->
                                                            <div class="form-group">
                                                                <select
                                                                    class="form-control from_search_students @error('from_class') border border-danger @enderror"
                                                                    name="from_class"
                                                                    id="from_class">
                                                                    <option disabled selected>Class</option>
                                                                    @if($student_classes)
                                                                        @foreach($student_classes as $student_class)
                                                                            <option
                                                                                value="{{ $student_class->id }}">{{ $student_class->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <!-- select -->
                                                            <div class="form-group">
                                                                <select
                                                                    class="form-control from_search_students @error('from_section') border border-danger @enderror"
                                                                    name="from_section"
                                                                    id="from_section">
                                                                    <option disabled selected>Section</option>
                                                                    @if($student_sections)
                                                                        @foreach($student_sections as $student_section)
                                                                            <option
                                                                                value="{{ $student_section->id }}">{{ $student_section->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="from_students_data">

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.col -->

                                        <div class="col-6">
                                            <div class="card card-secondary">
                                                <div class="card-header">
                                                    <h3 class="card-title">To Class</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <!-- select -->
                                                            <div class="form-group">
                                                                <select
                                                                    class="form-control to_search_students @error('to_class') border border-danger @enderror"
                                                                    name="to_class"
                                                                    id="to_class">
                                                                    <option disabled selected>Class</option>
                                                                    @if($student_classes)
                                                                        @foreach($student_classes as $student_class)
                                                                            <option
                                                                                value="{{ $student_class->id }}">{{ $student_class->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <!-- select -->
                                                            <div class="form-group">
                                                                <select
                                                                    class="form-control to_search_students @error('to_section') border border-danger @enderror"
                                                                    name="to_section"
                                                                    id="to_section">
                                                                    <option disabled selected>Section</option>
                                                                    @if($student_sections)
                                                                        @foreach($student_sections as $student_section)
                                                                            <option
                                                                                value="{{ $student_section->id }}">{{ $student_section->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="to_students_data">

                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection()
@push('scripts')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".from_search_students").change(function (e) {

            e.preventDefault();

            $("#from_students_data").empty();
            var from_class = $("#from_class").val();
            var from_section = $("#from_section").val();

            $.ajax({
                type: 'get',
                url: "{{ route('student.change.class.section.ajax.students') }}",
                data: {class: from_class, section: from_section},
                success: function (response) {
                    var data = $.parseJSON(response);
                    $.each(data, function (key, value) {
                        var sn_id = key += 1;
                        $("#from_students_data").last().append("<div class='mt-1'><div class='icheck-primary d-inline'> <input type='checkbox' id='checkboxPrimary" + value.admission_id + "' name='id_is[]' value=" + value.admission_id + "> <label for='checkboxPrimary" + value.admission_id + "'> " + sn_id + ' | ' + +value.id + " | " + value.first_name + " " + value.middle_name + " " + value.last_name + " -- " + value.father_name + " </label> </div><br></div>");
                    });
                }
            });
        });

        $(".to_search_students").change(function (e) {

            e.preventDefault();

            $("#to_students_data").empty();
            var to_class = $("#to_class").val();
            var to_section = $("#to_section").val();

            console.log('Changed' + to_class + to_section);

            $.ajax({
                type: 'get',
                url: "{{ route('student.change.class.section.ajax.students') }}",
                data: {class: to_class, section: to_section},
                success: function (response) {
                    var data = $.parseJSON(response);
                    $.each(data, function (key, value) {
                        var sn_id = key += 1;
                        $("#to_students_data").last().append("<div class='mt-1'><div class='icheck-primary d-inline'><label> " + sn_id + ' | ' + value.id + " | " + value.first_name + " " + value.middle_name + " " + value.last_name + " -- " + value.father_name + " </label></div><br></div>");
                    });
                }
            });
        });

    </script>
@endpush
