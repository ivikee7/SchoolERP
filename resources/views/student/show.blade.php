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
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('dist/img/male1.png') }}" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center">
                                    {{ $user->id . ' | ' . $user->title . ' ' . $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}
                                </h3>
                                <p class="text-muted text-center">
                                    {{ $user->role_name }}
                                    |
                                    @if ($user->gender == 'M')
                                        <span>MALE</span>
                                    @elseif ($user->gender == 'F')
                                        <span>FEMALE</span>
                                    @elseif ($user->gender == 'O')
                                        <span>OTHER</span>
                                    @endif
                                    <br>
                                    @if ($user->status == 1)
                                        <span class="text-warning bg-success pl-1 pr-1 rounded">Active</span>
                                    @else
                                        <span class="text-warning bg-danger pl-1 pr-1 rounded">Suspended</span>
                                    @endif
                                    |
                                    @if ($user->admission_status == 1)
                                        <span class="text-warning bg-success pl-1 pr-1 rounded">Active</span>
                                    @else
                                        <span class="text-warning bg-danger pl-1 pr-1 rounded">Inactive</span>
                                    @endif
                                </p>
                                @if ($user->role_name == 'STUDENT')
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Class</b> <a class="float-right">{{ $user->class_name }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Section</b> <a class="float-right">{{ $user->section_name }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Transport</b> <a class="float-right">{{ $user->transport_route_name }}</a>
                                        </li>
                                    </ul>
                                @endif
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Basic Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-user-tie mr-1"></i> Father Name</strong>
                                <p class="text-muted">{{ $user->father_name }}</p>
                                <hr>
                                <strong><i class="fas fa-user-alt mr-1"></i> Mother Name</strong>
                                <p class="text-muted">{{ $user->mother_name }}</p>
                                <hr>
                                <strong><i class="fas fa-mobile-android mr-1"></i> Contact Number</strong>
                                <p class="text-muted">{{ $user->contact_number }}@if ($user->contact_number2)
                                        | {{ $user->contact_number2 }}
                                    @endif
                                </p>
                                <hr>
                                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                                <p class="text-muted">{{ $user->email }}</p>
                                <hr>
                                <strong><i class="fas fa-envelope mr-1"></i> School Email</strong>
                                <p class="text-muted">{{ $user->email_alternate }}</p>
                                <hr>
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                                <p class="text-muted">{{ $user->address_line1 }} {{ $user->city }} {{ $user->state }}
                                    {{ $user->country }} {{ $user->pin_code }}</p>
                                <hr>
                                <strong><i class="fas fa-id-card mr-1"></i> Aadhar Number</strong>
                                <p class="text-muted">{{ $user->aadhaar_number }}</p>
                                <hr>
                                <strong><i class="fas fa-calendar-day mr-1"></i> Date of Birth</strong>
                                <p class="text-muted">{{ date('Y-M-d', strtotime($user->date_of_birth)) }}</p>
                                <hr>
                                <strong><i class="far fa-file-alt mr-1"></i> Remarks</strong>
                                <p class="text-muted">{{ $user->remarks }}</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a
                                            class="nav-link @if ($errors->any()) @else active @endif"
                                            href="#profile" data-toggle="tab">Additional information</a></li>
                                    @can('student_edit')
                                        <li class="nav-item"><a class="nav-link @if ($errors->any()) active @endif"
                                                href="#update" data-toggle="tab">Update</a>
                                        </li>
                                    @endcan
                                    <span class="float-right ml-1">
                                        <a href="{{ route('student.index') }}">
                                            <input type="button" value="Students" class="btn btn-warning">
                                        </a>
                                        {{-- <a href="{{ route('student.edit', $user->id) }}">
                                            <input type="button" value="Edit" class="btn btn-warning">
                                        </a> --}}
                                    </span>
                                </ul>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="@if ($errors->any()) @else active @endif tab-pane"
                                        id="profile">
                                        <div class="row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                <div class="card card-primary">
                                                    <div class="card-body">
                                                        <strong> Local Guardian </strong>
                                                        <p class="text-muted">
                                                            {{ $admission->local_guardian_profile_id ?? '' }}
                                                            {{ $admission->local_guardian_name ?? '' }}
                                                        </p>
                                                        <hr>
                                                        <strong> Relationship</strong>
                                                        <p class="text-muted">
                                                            {{ $admission->relationship ?? '' }}
                                                        </p>
                                                        <hr>
                                                        <strong> Student Quota</strong>
                                                        <p class="text-muted">
                                                            {{ $admission->student_quota_id ?? '' }}
                                                        </p>
                                                        <hr>
                                                        <strong> Registration</strong>
                                                        <p class="text-muted">
                                                            {{ $admission->registration_id ?? '' }}
                                                        </p>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                <div class="card card-primary">
                                                    <div class="card-body">
                                                        <strong> Acadamic Session</strong>
                                                        <p class="text-muted">
                                                            {{ $admission->academic_session_id ?? '' }}
                                                        </p>
                                                        <hr>
                                                        <strong> Acadamic Session</strong>
                                                        <p class="text-muted">
                                                            {{ $promotion->student_admission_id ?? '' }}
                                                        </p>
                                                        <hr>
                                                        <strong> Acadamic Session</strong>
                                                        <p class="text-muted">
                                                            {{ $promotion->student_class_id ?? '' }}
                                                        </p>
                                                        <hr>
                                                        <strong> Acadamic Session</strong>
                                                        <p class="text-muted">
                                                            {{ $promotion->student_section_id ?? '' }}
                                                        </p>
                                                        <hr>
                                                        <strong> Acadamic Session</strong>
                                                        <p class="text-muted">
                                                            {{ $promotion->promotion_status ?? '' }}
                                                        </p>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @can('user_edit')
                                        <div class="tab-pane @if($errors->any()) active @endif" id="update">
                                            <form action="{{ route('student.update', $user->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">
                                                                    Title
                                                                </label>
                                                                <select name="title"
                                                                    class="form-control @error('title') border border-danger @enderror">
                                                                    <option value="" disabled selected>Title</option>
                                                                    <option value="Mr"
                                                                        @if (strtolower(old('title')) == strtolower('Mr')) selected
                                                                            @elseif (strtolower($user->title) == strtolower('Mr')) selected @endif>
                                                                        Mr
                                                                    </option>
                                                                    <option value="Ms"
                                                                        @if (strtolower(old('title')) == strtolower('Ms')) selected
                                                                            @elseif (strtolower($user->title) == strtolower('Ms')) selected @endif>
                                                                        Ms
                                                                    </option>
                                                                    <option value="Mrs"
                                                                        @if (strtolower(old('title')) == strtolower('Mrs')) selected
                                                                            @elseif (strtolower($user->title) == strtolower('Mrs')) selected @endif>
                                                                        Mrs
                                                                    </option>
                                                                    <option value="Miss"
                                                                        @if (strtolower(old('title')) == strtolower('Miss')) selected
                                                                            @elseif (strtolower($user->title) == strtolower('Miss')) selected @endif>
                                                                        Miss
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">First name</label>
                                                                <input type="text"
                                                                    class="form-control @error('first_name') border border-danger @enderror "
                                                                    name="first_name"
                                                                    @if (old('first_name')) value="{{ old('first_name') }}"
                                                                       @elseif($user->first_name != '') value="{{ $user->first_name }}" @endif
                                                                    placeholder="First name">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Middle Name</label>
                                                                <input type="text"
                                                                    class="form-control @error('middle_name') border border-danger @enderror "
                                                                    name="middle_name"
                                                                    @if (old('middle_name')) value="{{ old('middle_name') }}"
                                                                       @elseif($user->middle_name != '') value="{{ $user->middle_name }}" @endif
                                                                    placeholder="Middle Name">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Last Name</label>
                                                                <input type="text"
                                                                    class="form-control @error('last_name') border border-danger @enderror "
                                                                    name="last_name"
                                                                    @if (old('last_name')) value="{{ old('last_name') }}"
                                                                       @elseif($user->last_name != '') value="{{ $user->last_name }}" @endif
                                                                    placeholder="Last Name">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Contact Number</label>
                                                                <input type="text"
                                                                    class="form-control @error('contact_number') border border-danger @enderror "
                                                                    name="contact_number"
                                                                    @if (old('contact_number')) value="{{ old('contact_number') }}"
                                                                       @elseif($user->contact_number != '') value="{{ $user->contact_number }}" @endif
                                                                    placeholder="Contact Number">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Contact Number2</label>
                                                                <input type="text"
                                                                    class="form-control @error('contact_number2') border border-danger @enderror "
                                                                    name="contact_number2"
                                                                    @if (old('contact_number2')) value="{{ old('contact_number2') }}"
                                                                       @elseif($user->contact_number2 != '') value="{{ $user->contact_number2 }}" @endif
                                                                    placeholder="Contact Number2">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Email</label>
                                                                <input type="text"
                                                                    class="form-control @error('email') border border-danger @enderror "
                                                                    name="email"
                                                                    @if (old('email')) value="{{ old('email') }}"
                                                                       @elseif($user->email != '') value="{{ $user->email }}" @endif
                                                                    placeholder="Email">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-2">
                                                                <label for="">Address Line1</label>
                                                                <input type="text"
                                                                    class="form-control @error('address_line1') border border-danger @enderror "
                                                                    name="address_line1"
                                                                    @if (old('address_line1')) value="{{ old('address_line1') }}"
                                                                       @elseif($user->address_line1 != '') value="{{ $user->address_line1 }}" @endif
                                                                    placeholder="Address Line1">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">City</label>
                                                                <input type="text"
                                                                    class="form-control @error('city') border border-danger @enderror "
                                                                    name="city"
                                                                    @if (old('city')) value="{{ old('city') }}"
                                                                       @elseif($user->city != '') value="{{ $user->city }}" @endif
                                                                    placeholder="City">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">State</label>
                                                                <input type="text"
                                                                    class="form-control @error('state') border border-danger @enderror "
                                                                    name="state"
                                                                    @if (old('state')) value="{{ old('state') }}"
                                                                       @elseif($user->state != '') value="{{ $user->state }}" @endif
                                                                    placeholder="State">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Pin Code</label>
                                                                <input type="text"
                                                                    class="form-control @error('pin_code') border border-danger @enderror "
                                                                    name="pin_code"
                                                                    @if (old('pin_code')) value="{{ old('pin_code') }}"
                                                                       @elseif($user->pin_code != '') value="{{ $user->pin_code }}" @endif
                                                                    placeholder="Pin Code">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Country</label>
                                                                <input type="text"
                                                                    class="form-control @error('country') border border-danger @enderror "
                                                                    name="country"
                                                                    @if (old('country')) value="{{ old('country') }}"
                                                                       @elseif($user->country != '') value="{{ $user->country }}" @endif
                                                                    placeholder="Country">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Transport</label>
                                                                <select name="transport_id" id=""
                                                                    class="form-control @error('transport_id') border border-danger @enderror">
                                                                    <option value="" selected disabled>Transport
                                                                    </option>
                                                                    @if ($routes ?? '')
                                                                        @foreach ($routes as $route)
                                                                            <option value="{{ $route->id }}"
                                                                                @if (old('transport_id') == $route->id) selected
                                                                                    @elseif ($user->transport_route_name == $route->route_name) selected @endif>
                                                                                {{ $route->route_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Aadhaar Number</label>
                                                                <input type="text"
                                                                    class="form-control @error('aadhaar_number') border border-danger @enderror "
                                                                    name="aadhaar_number"
                                                                    @if (old('aadhaar_number')) value="{{ old('aadhaar_number') }}"
                                                                       @elseif($user->aadhaar_number != '') value="{{ $user->aadhaar_number }}" @endif
                                                                    placeholder="Aadhaar Number">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Blood Group</label>
                                                                <select name="blood_group" id=""
                                                                    class="form-control @error('blood_group') border border-danger @enderror"
                                                                    value="{{ old('blood_group') }}">
                                                                    <option value="" selected disabled>Blood Group
                                                                    </option>
                                                                    <option value="A+"
                                                                        @if (strtolower(old('blood_group')) == strtolower('A+')) selected
                                                                            @elseif (strtolower($user->blood_group) == strtolower('A+')) selected @endif>
                                                                        A+
                                                                    </option>
                                                                    <option value="A-"
                                                                        @if (strtolower(old('blood_group')) == strtolower('A-')) selected
                                                                            @elseif (strtolower($user->blood_group) == strtolower('A-')) selected @endif>
                                                                        A-
                                                                    </option>
                                                                    <option value="B+"
                                                                        @if (strtolower(old('blood_group')) == strtolower('B+')) selected
                                                                            @elseif (strtolower($user->blood_group) == strtolower('B+')) selected @endif>
                                                                        B+
                                                                    </option>
                                                                    <option value="B-"
                                                                        @if (strtolower(old('blood_group')) == strtolower('B-')) selected
                                                                            @elseif (strtolower($user->blood_group) == strtolower('B-')) selected @endif>
                                                                        B-
                                                                    </option>
                                                                    <option value="O+"
                                                                        @if (strtolower(old('blood_group')) == strtolower('O+')) selected
                                                                            @elseif (strtolower($user->blood_group) == strtolower('O+')) selected @endif>
                                                                        O+
                                                                    </option>
                                                                    <option value="O-"
                                                                        @if (strtolower(old('blood_group')) == strtolower('O-')) selected
                                                                            @elseif (strtolower($user->blood_group) == strtolower('O-')) selected @endif>
                                                                        O-
                                                                    </option>
                                                                    <option value="AB+"
                                                                        @if (strtolower(old('blood_group')) == strtolower('AB+')) selected
                                                                            @elseif (strtolower($user->blood_group) == strtolower('AB+')) selected @endif>
                                                                        AB+
                                                                    </option>
                                                                    <option value="AB-"
                                                                        @if (strtolower(old('blood_group')) == strtolower('AB-')) selected
                                                                            @elseif (strtolower($user->blood_group) == strtolower('AB-')) selected @endif>
                                                                        AB-
                                                                    </option>
                                                                    <option value="UNK"
                                                                        @if (strtolower(old('blood_group')) == strtolower('UNK')) selected
                                                                            @elseif (strtolower($user->blood_group) == strtolower('UNK')) selected @endif>
                                                                        UNK
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Gender</label>
                                                                <select name="gender" id=""
                                                                    class="form-control @error('gender') border border-danger @enderror">
                                                                    <option value="" selected disabled>Gender</option>
                                                                    <option value="M"
                                                                        @if (old('gender') == 'M') selected
                                                                            @elseif ($user->gender == 'M') selected @endif>
                                                                        Male
                                                                    </option>
                                                                    <option value="F"
                                                                        @if (old('gender') == 'F') selected
                                                                            @elseif ($user->gender == 'F') selected @endif>
                                                                        Female
                                                                    </option>
                                                                    <option value="O"
                                                                        @if (old('gender') == 'O') selected
                                                                            @elseif ($user->gender == 'O') selected @endif>
                                                                        Other
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Mother Tongue</label>
                                                                <input type="text"
                                                                    class="form-control @error('mother_tongue') border border-danger @enderror "
                                                                    name="mother_tongue"
                                                                    @if (old('mother_tongue')) value="{{ old('mother_tongue') }}"
                                                                       @elseif($user->mother_tongue != '') value="{{ $user->mother_tongue }}" @endif
                                                                    placeholder="Mother Tongue">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Date of Birth</label>
                                                                <input type="date"
                                                                    class="form-control @error('date_of_birth') border border-danger @enderror "
                                                                    name="date_of_birth"
                                                                    @if (old('date_of_birth')) value="{{ old('date_of_birth') }}"
                                                                       @elseif($user->date_of_birth != '') value="{{ date('Y-m-d', strtotime($user->date_of_birth)) }}" @endif
                                                                    placeholder="Date of Birth">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Place of Birth</label>
                                                                <input type="text"
                                                                    class="form-control @error('place_of_birth') border border-danger @enderror "
                                                                    name="place_of_birth"
                                                                    @if (old('place_of_birth')) value="{{ old('place_of_birth') }}"
                                                                       @elseif($user->place_of_birth != '') value="{{ $user->place_of_birth }}" @endif
                                                                    placeholder="Place of Birth">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Remarks</label>
                                                                <input type="text"
                                                                    class="form-control @error('remarks') border border-danger @enderror "
                                                                    name="remarks"
                                                                    @if (old('remarks')) value="{{ old('remarks') }}"
                                                                       @elseif($user->remarks != '') value="{{ $user->remarks }}" @endif
                                                                    placeholder="Remarks">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Father Name</label>
                                                                <input type="text"
                                                                    class="form-control @error('father_name') border border-danger @enderror "
                                                                    name="father_name"
                                                                    @if (old('father_name')) value="{{ old('father_name') }}"
                                                                       @elseif($user->father_name != '') value="{{ $user->father_name }}" @endif
                                                                    placeholder="Father Name">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Mother Name</label>
                                                                <input type="text"
                                                                    class="form-control @error('mother_name') border border-danger @enderror "
                                                                    name="mother_name"
                                                                    @if (old('mother_name')) value="{{ old('mother_name') }}"
                                                                       @elseif($user->mother_name != '') value="{{ $user->mother_name }}" @endif
                                                                    placeholder="Mother Name">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Termination Date</label>
                                                                <input type="date"
                                                                    class="form-control @error('termination_date') border border-danger @enderror "
                                                                    name="termination_date"
                                                                    @if (old('termination_date')) value="{{ old('termination_date') }}"
                                                                       @elseif($user->termination_date != '') value="{{ date('Y-m-d', strtotime($user->termination_date)) }}" @endif
                                                                    placeholder="Termination Date">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">User Status</label>
                                                                <select name="status" id=""
                                                                    class="form-control @error('status') border border-danger @enderror">
                                                                    <option value="" selected disabled>Status</option>
                                                                    <option value="1"
                                                                        @if (old('status') == '1') selected
                                                                            @elseif ($user->status == '1') selected @endif>
                                                                        Active
                                                                    </option>
                                                                    <option value="0"
                                                                        @if (old('status') == '0') selected
                                                                            @elseif ($user->status == '0') selected @endif>
                                                                        Suspended
                                                                    </option>
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
                                            <form action="{{ route('admission.update', $user->admission_id) }}"
                                                method="post">
                                                @csrf
                                                @method('put')
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Local Guardian</label>
                                                                <select name="local_guardian" id=""
                                                                    class="form-control @error('local_guardian') border border-danger @enderror">
                                                                    <option value="" selected>None</option>
                                                                    @if ($local_guardians ?? '')
                                                                        @foreach ($local_guardians as $local_guardian)
                                                                            <option value="{{ $local_guardian->id }}"
                                                                                @if ($local_guardian->id == $user->local_guardian_profile_id) selected
                                                                                    @elseif (old('local_guardian') == $local_guardian->id) selected @endif>
                                                                                {{ $local_guardian->id . ' | ' . $local_guardian->title . ' ' . $local_guardian->first_name . ' ' . $local_guardian->middle_name . ' ' . $local_guardian->last_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Relationship</label>
                                                                <input type="text"
                                                                    class="form-control @error('relationship') border border-danger @enderror "
                                                                    name="relationship"
                                                                    @if ($user->relationship) value="{{ $user->relationship }}"
                                                                       @elseif (old('relationship'))
                                                                           value="{{ old('relationship') }}"
                                                                       @else
                                                                           {{ '' }} @endif
                                                                    placeholder="Relationship">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Quota</label>
                                                                <select name="quota" id=""
                                                                    class="form-control @error('quota') border border-danger @enderror">
                                                                    <option value="" selected disabled>Quota
                                                                    </option>
                                                                    @if ($quotas ?? '')
                                                                        @foreach ($quotas as $quota)
                                                                            <option value="{{ $quota->id }}"
                                                                                @if ($quota->id == $user->student_quota_id) selected
                                                                                    @elseif (old('quota') == $quota->id) selected @endif>
                                                                                {{ $quota->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Acadamic Session</label>
                                                                <select name="acadamic_session" id=""
                                                                    class="form-control @error('acadamic_session') border border-danger @enderror">
                                                                    <option value="" selected disabled>Acadamic Session
                                                                    </option>
                                                                    @if ($acadamic_sessions ?? '')
                                                                        @foreach ($acadamic_sessions as $academic_session)
                                                                            <option value="{{ $academic_session->id }}"
                                                                                @if ($academic_session->id == $user->academic_session_id) selected
                                                                                    @elseif (old('acadamic_session') == $academic_session->id) selected @endif>
                                                                                {{ $academic_session->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Class</label>
                                                                <select name="class" id=""
                                                                    class="form-control @error('class') border border-danger @enderror">
                                                                    <option value="" selected disabled>Class
                                                                    </option>
                                                                    @if ($classes ?? '')
                                                                        @foreach ($classes as $class)
                                                                            <option value="{{ $class->id }}"
                                                                                @if ($class->id == $user->current_class_id) selected
                                                                                    @elseif (old('class') == $class->id) selected @endif>
                                                                                {{ $class->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Section</label>
                                                                <select name="section" id=""
                                                                    class="form-control @error('section') border border-danger @enderror">
                                                                    <option value="" selected disabled>Section
                                                                    </option>
                                                                    @if ($sections ?? '')
                                                                        @foreach ($sections as $section)
                                                                            <option value="{{ $section->id }}"
                                                                                @if ($section->id == $user->current_section_id) selected
                                                                                    @elseif (old('section') == $section->id) selected @endif>
                                                                                {{ $section->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Admission Status</label>
                                                                <select name="admission_status" id=""
                                                                    class="form-control @error('admission_status') border border-danger @enderror">
                                                                    <option value="" selected disabled>Admission Status
                                                                    </option>
                                                                    <option value="1"
                                                                        @if (old('admission_status') == '1') selected
                                                                            @elseif ($user->admission_status == '1') selected @endif>
                                                                        Active
                                                                    </option>
                                                                    <option value="0"
                                                                        @if (old('admission_status') == '0') selected
                                                                            @elseif ($user->admission_status == '0') selected @endif>
                                                                        Inactive
                                                                    </option>
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
                                    @endcan
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
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
