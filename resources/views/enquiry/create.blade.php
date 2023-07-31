@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Enquiry Create')
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
                                <h3 class="card-title">Admission Enquiry</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('enquiry.index') }}">
                                        <input type="button" value="View Enquires" class="btn btn-sm btn-primary">
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('enquiry.store') }}" method="POST">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">

                                                <div class="row">
                                                    @if (Session::get('message'))
                                                        <div class="alert alert-success text-center col-12">
                                                            {{ Session::get('message') }}</div>
                                                    @endif
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">
                                                            Title
                                                        </label>
                                                        <select name="title" id=""
                                                            class="form-control @error('title') border border-danger @enderror">
                                                            <option value="" disabled selected>Title</option>
                                                            <option value="Mr" @if (strtolower(old('title')) == strtolower("Mr")) @selected(true) @endif>Mr</option>
                                                            <option value="Miss" @if (strtolower(old('title')) == strtolower("Miss")) @selected(true) @endif>Miss</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">First name</label>
                                                        <input type="text"
                                                            class="form-control @error('first_name') border border-danger @enderror "
                                                            name="first_name" value="{{ old('first_name') }}"
                                                            placeholder="First name">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Middle Name</label>
                                                        <input type="text"
                                                            class="form-control @error('middle_name') border border-danger @enderror "
                                                            name="middle_name" value="{{ old('middle_name') }}"
                                                            placeholder="Middle Name">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Last Name</label>
                                                        <input type="text"
                                                            class="form-control @error('last_name') border border-danger @enderror "
                                                            name="last_name" value="{{ old('last_name') }}"
                                                            placeholder="Last Name">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Gender</label>
                                                        <select name="gender" id=""
                                                            class="form-control @error('gender') border border-danger @enderror"
                                                            value="{{ old('gender') }}">
                                                            <option value="" selected disabled>Gender</option>
                                                            <option value="M" @if (strtolower(old('gender')) == strtolower("M")) @selected(true) @endif>Male</option>
                                                            <option value="F" @if (strtolower(old('gender')) == strtolower("F")) @selected(true) @endif>Female</option>
                                                            <option value="O" @if (strtolower(old('gender')) == strtolower("O")) @selected(true) @endif>Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Date of Birth</label>
                                                        <input type="date"
                                                            class="form-control @error('date_of_birth') border border-danger @enderror "
                                                            name="date_of_birth" value="{{ old('date_of_birth') }}"
                                                            placeholder="DOB">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mt-2">
                                                        <label for="">Address Line1</label>
                                                        <input type="text"
                                                            class="form-control @error('address_line1') border border-danger @enderror "
                                                            name="address_line1" value="{{ old('address_line1') }}"
                                                            placeholder="Address Line1">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">City</label>
                                                        <input type="text"
                                                            class="form-control @error('city') border border-danger @enderror "
                                                            name="city" value="{{ old('city') }}" placeholder="City">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">State</label>
                                                        <input type="text"
                                                            class="form-control @error('state') border border-danger @enderror "
                                                            name="state" value="{{ old('state') }}" placeholder="State">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Pin Code</label>
                                                        <input type="text"
                                                            class="form-control @error('pin_code') border border-danger @enderror "
                                                            name="pin_code" value="{{ old('pin_code') }}"
                                                            placeholder="Pin Code">
                                                    </div>

                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Father name</label>
                                                        <input type="text"
                                                            class="form-control @error('father_name') border border-danger @enderror "
                                                            name="father_name" value="{{ old('father_name') }}"
                                                            placeholder="Father name">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Mother name</label>
                                                        <input type="text"
                                                            class="form-control @error('mother_name') border border-danger @enderror "
                                                            name="mother_name" value="{{ old('mother_name') }}"
                                                            placeholder="Mother name">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Contact Number</label>
                                                        <input type="text"
                                                            class="form-control @error('contact_number') border border-danger @enderror "
                                                            name="contact_number" value="{{ old('contact_number') }}"
                                                            placeholder="Contact Number">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Contact Number2</label>
                                                        <input type="text"
                                                            class="form-control @error('contact_number2') border border-danger @enderror "
                                                            name="contact_number2" value="{{ old('contact_number2') }}"
                                                            placeholder="Contact Number2">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Enquiry Class</label>
                                                        <select name="enquiry_class_id" id=""
                                                            class="form-control @error('enquiry_class_id') border border-danger @enderror">
                                                            <option value="" selected disabled>Class</option>
                                                            @foreach ($classes as $class)
                                                                <option value="{{ $class->id }}" @if (old('enquiry_class_id') == $class->id) @selected(true) @endif>{{ $class->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Last Attended School</label>
                                                        <input type="text"
                                                            class="form-control @error('last_attended_school') border border-danger @enderror "
                                                            name="last_attended_school"
                                                            value="{{ old('last_attended_school') }}"
                                                            placeholder="Last Attended School">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Last Attended Class</label>
                                                        <select type="text" name="last_attended_class" id=""
                                                            class="form-control @error('last_attended_class') border border-danger @enderror">
                                                            <option value="" selected disabled>Class</option>
                                                            @foreach ($classes as $class)
                                                                <option value="{{ $class->id }}"
                                                                    @if (old('last_attended_class') == $class->id) @selected(true) @endif>
                                                                    {{ $class->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Source</label>
                                                        <select type="text" name="source" id=""
                                                            class="form-control @error('source') border border-danger @enderror">
                                                            <option value="" selected disabled>Select</option>
                                                            <option value="Website"
                                                                @if (strtolower(old('source')) == strtolower('Website')) @selected(true) @endif>
                                                                Website
                                                            </option>
                                                            <option value="Hoading"
                                                                @if (strtolower(old('source')) == strtolower('Hoading')) @selected(true) @endif>
                                                                Hoading
                                                            </option>
                                                            <option value="Relevant"
                                                                @if (strtolower(old('source')) == strtolower('Relevant')) @selected(true) @endif>
                                                                Relevant
                                                            </option>
                                                            <option value="Social Media"
                                                                @if (strtolower(old('source')) == strtolower('Social Media')) @selected(true) @endif>
                                                                Social Media
                                                            </option>
                                                            <option value="News"
                                                                @if (strtolower(old('source')) == strtolower('News')) @selected(true) @endif>
                                                                News
                                                            </option>
                                                            <option value="Other"
                                                                @if (strtolower(old('source')) == strtolower('Other')) @selected(true) @endif>
                                                                Other
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer">
                                                <button type="reset" class="btn btn-warning">Reset</button>
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
