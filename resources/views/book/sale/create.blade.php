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
                                <h3 class="card-title">Books</h3>
                                <div class="card-title float-right">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('book.sale.store') }}" method="post">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    @if ($message ?? '')
                                                        <div class="alert alert-success text-center col-12">
                                                            {{ $message }}</div>
                                                    @endif
                                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                        <label for="" class=" ml-1 mr-1">Select Student</label>
                                                        <select name="student" id=""
                                                            class="form-control select2 @error('student') border border-danger @enderror">
                                                            <option value="" selected disabled>Student</option>
                                                            @if ($students ?? '')
                                                                @foreach ($students as $student)
                                                                    <option value="{{ $student->id }}"
                                                                        @if (old('student') == $student->id) selected @endif>
                                                                        {{ $student->id . ' | ' . $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name . ' | ' . $student->father_name . ' | ' . $student->student_class . ' | ' . $student->student_section }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
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

@push('styles')
@endpush
@push('scripts')
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
