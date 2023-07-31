@extends('master')
@section('title', auth()->user()->first_name .' '. auth()->user()->last_name . ' | Registration Create')
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
                                <h3 class="card-title">Student Registration Create</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('registration.index') }}">
                                        <input type="button" value="View Registrations" class="btn btn-sm btn-primary">
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('registration.store') }}" method="post">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    @if (Session::get('message'))
                                                        <div class="alert alert-success text-center col-12">
                                                            {{ Session::get('message') }}</div>
                                                    @endif
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">
                                                            Title
                                                        </label>
                                                        <select name="title" id=""
                                                                class="form-control @error('title') border border-danger @enderror">
                                                            <option value="" disabled selected>Title</option>
                                                            <option value="Mr" @if (strtolower(old('title')) == strtolower("Mr")) @selected(true) @endif>Mr</option>
                                                            <option value="Miss" @if (strtolower(old('title')) == strtolower("Miss")) @selected(true) @endif>Miss</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">First name</label>
                                                        <input type="text"
                                                               class="form-control @error('first_name') border border-danger @enderror "
                                                               name="first_name" value="{{ old('first_name') }}"
                                                               placeholder="First name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Middle Name</label>
                                                        <input type="text"
                                                               class="form-control @error('middle_name') border border-danger @enderror "
                                                               name="middle_name" value="{{ old('middle_name') }}"
                                                               placeholder="Middle Name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Last Name</label>
                                                        <input type="text"
                                                               class="form-control @error('last_name') border border-danger @enderror "
                                                               name="last_name" value="{{ old('last_name') }}"
                                                               placeholder="Last Name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Gender</label>
                                                        <select name="gender" id=""
                                                                class="form-control @error('gender') border border-danger @enderror"
                                                                value="{{ old('gender') }}">
                                                            <option value="" selected disabled>Gender</option>
                                                            <option value="M" @if (strtolower(old('gender')) == strtolower("M")) @selected(true) @endif>Male</option>
                                                            <option value="F" @if (strtolower(old('gender')) == strtolower("F")) @selected(true) @endif>Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">DOB</label>
                                                        <input type="date"
                                                               class="form-control @error('date_of_birth') border border-danger @enderror "
                                                               name="date_of_birth" value="{{ old('date_of_birth') }}"
                                                               placeholder="DOB">
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-6 mt-2">
                                                        <label for="" class="ml-1 mr-1">Address Line1</label>
                                                        <input type="text"
                                                               class="form-control @error('address_line1') border border-danger @enderror "
                                                               name="address_line1" value="{{ old('address_line1') }}"
                                                               placeholder="Address Line1">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">City</label>
                                                        <input type="text"
                                                               class="form-control @error('city') border border-danger @enderror "
                                                               name="city" value="{{ old('city') }}" placeholder="City">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">State</label>
                                                        <input type="text"
                                                               class="form-control @error('state') border border-danger @enderror "
                                                               name="state" value="{{ old('state') }}"
                                                               placeholder="State">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Pin</label>
                                                        <input type="text"
                                                               class="form-control @error('pin_code') border border-danger @enderror "
                                                               name="pin_code" value="{{ old('pin_code') }}"
                                                               placeholder="Pin Code">
                                                    </div>

                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Father name</label>
                                                        <input type="text"
                                                               class="form-control @error('father_name') border border-danger @enderror "
                                                               name="father_name" value="{{ old('father_name') }}"
                                                               placeholder="Father name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Father Qualification</label>
                                                        <input type="text"
                                                               class="form-control @error('father_qualification') border border-danger @enderror "
                                                               name="father_qualification"
                                                               value="{{ old('father_qualification') }}"
                                                               placeholder="Father Qualification">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Father Occupation</label>
                                                        <input type="text"
                                                               class="form-control @error('father_occupation') border border-danger @enderror "
                                                               name="father_occupation"
                                                               value="{{ old('father_occupation') }}"
                                                               placeholder="Father Occupation">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Father Contact Number</label>
                                                        <input type="text"
                                                               class="form-control @error('father_contact_number') border border-danger @enderror "
                                                               name="father_contact_number"
                                                               value="{{ old('father_contact_number') }}"
                                                               placeholder="Father Contact Number">
                                                    </div>

                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Mother name</label>
                                                        <input type="text"
                                                               class="form-control @error('mother_name') border border-danger @enderror "
                                                               name="mother_name" value="{{ old('mother_name') }}"
                                                               placeholder="Mother name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Mother Qualification</label>
                                                        <input type="text"
                                                               class="form-control @error('mother_qualification') border border-danger @enderror "
                                                               name="mother_qualification"
                                                               value="{{ old('mother_qualification') }}"
                                                               placeholder="Mother Qualification">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Mother Occupation</label>
                                                        <input type="text"
                                                               class="form-control @error('mother_occupation') border border-danger @enderror "
                                                               name="mother_occupation"
                                                               value="{{ old('mother_occupation') }}"
                                                               placeholder="Mother Occupation">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Mother Contact Number</label>
                                                        <input type="text"
                                                               class="form-control @error('mother_contact_number') border border-danger @enderror "
                                                               name="mother_contact_number"
                                                               value="{{ old('mother_contact_number') }}"
                                                               placeholder="Mother Contact Number">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Registration Class</label>
                                                        <select name="registration_class_id" id=""
                                                                class="form-control @error('registration_class_id') border border-danger @enderror">
                                                            <option value="" selected disabled>Class</option>
                                                            @if ($classes ?? '')
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id }}" @if (old('registration_class_id') == $class->id) @selected(true) @endif>
                                                                        {{ $class->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Last Attended School</label>
                                                        <input type="text"
                                                               class="form-control @error('last_attended_school') border border-danger @enderror "
                                                               name="last_attended_school"
                                                               value="{{ old('last_attended_school') }}"
                                                               placeholder="Last Attended School">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Last Attended Class</label>
                                                        <select type="text" name="last_attended_class_id" id=""
                                                                class="form-control @error('last_attended_class_id') border border-danger @enderror">
                                                            <option value="" selected disabled>Class</option>
                                                            @if ($classes ?? '')
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id }}" @if (old('last_attended_class_id') == $class->id) @selected(true) @endif>
                                                                        {{ $class->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Payment Mode</label>
                                                        <select type="text" name="payment_mode" id=""
                                                                class="form-control @error('payment_mode') border border-danger @enderror">
                                                            <option value="" selected disabled>Payment Mode</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Cheque">Cheque</option>
                                                            <option value="QR Code">QR Code</option>
                                                            <option value="Bank">Bank</option>
                                                            <option value="Other">Other</option>
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
