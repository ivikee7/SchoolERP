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
                                <h3 class="card-title">User Create</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('user.index') }}">
                                        <input type="button" value="View Users" class="btn btn-sm btn-primary">
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('user.store') }}" method="post">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    @if ($message ?? '')
                                                        <div class="alert alert-success text-center col-12">
                                                            {{ $message }}</div>
                                                    @endif
                                                    {{-- <div class="col-12 text-center">{!! Session::has('message') ? Session::get('message') : '' !!}</div> --}}
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Role</label>
                                                        <select name="role" id=""
                                                            class="form-control @error('role') border border-danger @enderror">
                                                            <option value="" selected disabled>Role</option>
                                                            @if ($roles ?? '')
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role->name }}"
                                                                        @if (old('role') == $role->name) selected @endif>
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">
                                                            Title
                                                        </label>
                                                        <select name="title"
                                                            class="form-control @error('title') border border-danger @enderror">
                                                            <option value="" disabled selected>Title</option>
                                                            <option value="Mr."
                                                                @if (old('title') == 'Mr.') selected @endif>Mr.
                                                            </option>
                                                            <option value="Ms."
                                                                @if (old('title') == 'Ms.') selected @endif>Ms.
                                                            </option>
                                                            <option value="Mrs."
                                                                @if (old('title') == 'Mrs.') selected @endif>Mrs.
                                                            </option>
                                                            <option value="Miss"
                                                                @if (old('title') == 'Miss') selected @endif>Miss
                                                            </option>
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
                                                        <label for="" class="ml-1 mr-1">Contact Number</label>
                                                        <input type="text"
                                                            class="form-control @error('contact_number') border border-danger @enderror "
                                                            name="contact_number" value="{{ old('contact_number') }}"
                                                            placeholder="Contact Number">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Contact Number2</label>
                                                        <input type="text"
                                                            class="form-control @error('contact_number2') border border-danger @enderror "
                                                            name="contact_number2" value="{{ old('contact_number2') }}"
                                                            placeholder="Contact Number2">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Email</label>
                                                        <input type="text"
                                                            class="form-control @error('email') border border-danger @enderror "
                                                            name="email" value="{{ old('email') }}" placeholder="Email">
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
                                                            name="city" value="{{ old('city') }}"
                                                            placeholder="City">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">State</label>
                                                        <input type="text"
                                                            class="form-control @error('state') border border-danger @enderror "
                                                            name="state" value="{{ old('state') }}"
                                                            placeholder="State">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Pin Code</label>
                                                        <input type="text"
                                                            class="form-control @error('pin_code') border border-danger @enderror "
                                                            name="pin_code" value="{{ old('pin_code') }}"
                                                            placeholder="Pin Code">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Country</label>
                                                        <input type="text"
                                                            class="form-control @error('country') border border-danger @enderror "
                                                            name="country"
                                                            value="@if (old('country')) {{ old('country') }} else {{ 'INDIA' }} @endif"
                                                            placeholder="Country">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Transport</label>
                                                        <select name="transport_id" id=""
                                                            class="form-control @error('transport_id') border border-danger @enderror">
                                                            <option value="" selected disabled>Transport</option>
                                                            @if ($routes ?? '')
                                                                @foreach ($routes as $route)
                                                                    <option value="{{ $route->id }}"
                                                                        @if (old('transport_id') == $route->id) selected @endif>
                                                                        {{ $route->route_name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Aadhaar Number</label>
                                                        <input type="text"
                                                            class="form-control @error('aadhaar_number') border border-danger @enderror "
                                                            name="aadhaar_number" placeholder="Aadhaar Number">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Blood Group</label>
                                                        <select name="blood_group" id=""
                                                            class="form-control @error('blood_group') border border-danger @enderror"
                                                            value="{{ old('blood_group') }}">
                                                            <option value="" selected disabled>Blood Group</option>
                                                            <option value="A+"
                                                                @if (old('blood_group') == 'A+') selected @endif>A+
                                                            </option>
                                                            <option value="A-"
                                                                @if (old('blood_group') == 'A-') selected @endif>A-
                                                            </option>
                                                            <option value="B+"
                                                                @if (old('blood_group') == 'B+') selected @endif>B+
                                                            </option>
                                                            <option value="B-"
                                                                @if (old('blood_group') == 'B-') selected @endif>B-
                                                            </option>
                                                            <option value="O+"
                                                                @if (old('blood_group') == 'O+') selected @endif>O+
                                                            </option>
                                                            <option value="O-"
                                                                @if (old('blood_group') == 'O-') selected @endif>O-
                                                            </option>
                                                            <option value="AB+"
                                                                @if (old('blood_group') == 'AB+') selected @endif>AB+
                                                            </option>
                                                            <option value="AB-"
                                                                @if (old('blood_group') == 'AB-') selected @endif>AB-
                                                            </option>
                                                            <option value="UNK"
                                                                @if (old('blood_group') == 'UNK') selected @endif>UNK
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Mother Tongue</label>
                                                        <input type="text"
                                                            class="form-control @error('mother_tongue') border border-danger @enderror "
                                                            name="mother_tongue" value="{{ old('mother_tongue') }}"
                                                            placeholder="Mother Tongue">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Date of Birth</label>
                                                        <input type="date"
                                                            class="form-control @error('date_of_birth') border border-danger @enderror "
                                                            name="date_of_birth" value="{{ old('date_of_birth') }}"
                                                            placeholder="Date of Birth">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Place of Birth</label>
                                                        <input type="text"
                                                            class="form-control @error('place_of_birth') border border-danger @enderror "
                                                            name="place_of_birth" value="{{ old('place_of_birth') }}"
                                                            placeholder="Place of Birth">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Gender</label>
                                                        <select name="gender" id=""
                                                            class="form-control @error('gender') border border-danger @enderror">
                                                            <option value="" selected disabled>Gender</option>
                                                            <option value="M"
                                                                @if (old('gender') == 'M') selected @endif>Male
                                                            </option>
                                                            <option value="F"
                                                                @if (old('gender') == 'F') selected @endif>Female
                                                            </option>
                                                            <option value="O"
                                                                @if (old('gender') == 'O') selected @endif>Other
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Father Name</label>
                                                        <input type="text"
                                                            class="form-control @error('father_name') border border-danger @enderror "
                                                            name="father_name" value="{{ old('father_name') }}"
                                                            placeholder="Father Name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Mother Name</label>
                                                        <input type="text"
                                                            class="form-control @error('mother_name') border border-danger @enderror "
                                                            name="mother_name" value="{{ old('mother_name') }}"
                                                            placeholder="Mother Name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Remarks</label>
                                                        <input type="text"
                                                            class="form-control @error('remarks') border border-danger @enderror "
                                                            name="remarks" value="{{ old('remarks') }}"
                                                            placeholder="Remarks">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Status</label>
                                                        <select name="status" id=""
                                                            class="form-control @error('status') border border-danger @enderror">
                                                            <option value="" selected disabled>Status</option>
                                                            <option value="1"
                                                                @if (old('status') == '1') selected @endif>Active
                                                            </option>
                                                            <option value="0"
                                                                @if (old('status') == '0') selected @endif>
                                                                Suspended</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Joining Date</label>
                                                        <input type="date"
                                                            class="form-control @error('joining_date') border border-danger @enderror "
                                                            name="joining_date" value="{{ old('joining_date') }}"
                                                            placeholder="Joining Date">
                                                    </div>


                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Allocated Casual
                                                            Leave</label>
                                                        <input type="text"
                                                            class="form-control @error('allocated_casual_leave') border border-danger @enderror "
                                                            name="allocated_casual_leave"
                                                            value="{{ old('allocated_casual_leave') }}"
                                                            placeholder="Allocated Casual Leave">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Allocated Sick
                                                            Leave</label>
                                                        <input type="text"
                                                            class="form-control @error('allocated_sick_leave') border border-danger @enderror "
                                                            name="allocated_sick_leave"
                                                            value="{{ old('allocated_sick_leave') }}"
                                                            placeholder="Allocated Sick Leave">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">PF Number</label>
                                                        <input type="text"
                                                            class="form-control @error('pf_number') border border-danger @enderror "
                                                            name="pf_number" value="{{ old('pf_number') }}"
                                                            placeholder="PF Number">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">ESI Number</label>
                                                        <input type="text"
                                                            class="form-control @error('esi_number') border border-danger @enderror "
                                                            name="esi_number" value="{{ old('esi_number') }}"
                                                            placeholder="ESI Number">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Bank Account
                                                            Number</label>
                                                        <input type="text"
                                                            class="form-control @error('bank_account_number') border border-danger @enderror "
                                                            name="bank_account_number"
                                                            value="{{ old('bank_account_number') }}"
                                                            placeholder="Bank Account Number">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">IFSC Code</label>
                                                        <input type="text"
                                                            class="form-control @error('ifsc_code') border border-danger @enderror "
                                                            name="ifsc_code" value="{{ old('ifsc_code') }}"
                                                            placeholder="IFSC Code">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Un Number</label>
                                                        <input type="text"
                                                            class="form-control @error('un_number') border border-danger @enderror "
                                                            name="un_number" value="{{ old('un_number') }}"
                                                            placeholder="Un Number">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Pan Number</label>
                                                        <input type="text"
                                                            class="form-control @error('pan_number') border border-danger @enderror "
                                                            name="pan_number" value="{{ old('pan_number') }}"
                                                            placeholder="Pan Number">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Travel Allowance</label>
                                                        <input type="text"
                                                            class="form-control @error('travel_allowance') border border-danger @enderror "
                                                            name="travel_allowance" value="{{ old('travel_allowance') }}"
                                                            placeholder="Travel Allowance">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Gross Salary</label>
                                                        <input type="text"
                                                            class="form-control @error('gross_salary') border border-danger @enderror "
                                                            name="gross_salary" value="{{ old('gross_salary') }}"
                                                            placeholder="Gross Salary">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Basic Salary</label>
                                                        <input type="text"
                                                            class="form-control @error('basic_salary') border border-danger @enderror "
                                                            name="basic_salary" value="{{ old('basic_salary') }}"
                                                            placeholder="Basic Salary">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Grade Salary</label>
                                                        <input type="text"
                                                            class="form-control @error('grade_salary') border border-danger @enderror "
                                                            name="grade_salary" value="{{ old('grade_salary') }}"
                                                            placeholder="Grade Salary">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">PF</label>
                                                        <select name="pf" id=""
                                                            class="form-control @error('pf') border border-danger @enderror">
                                                            <option value="" selected disabled>Select</option>
                                                            <option value="Y"
                                                                @if (old('pf') == 'Y') selected @endif>Yes
                                                            </option>
                                                            <option value="N"
                                                                @if (old('pf') == 'N') selected @endif>
                                                                No</option>
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
