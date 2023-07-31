@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Student Create')
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
                                <h3 class="card-title">Student Create</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('student.index') }}">
                                        <input type="button" value="View Students" class="btn btn-sm btn-primary">
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('student.store') }}" method="post">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">

                                                <div class="row">
                                                    @if ($message ?? '')
                                                        <div class="alert alert-success text-center col-12">
                                                            {{ $message }}</div>
                                                    @endif
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">
                                                            Title
                                                        </label>
                                                        <select name="title"
                                                            class="form-control @error('title') border border-danger @enderror">
                                                            <option value="" disabled selected>Title</option>
                                                            <option value="Mr."
                                                                @if (strtolower(old('title')) == strtolower('Mr')) selected @elseif(strtolower($registration->title) == strtolower('Mr')) selected @endif>
                                                                Mr
                                                            </option>
                                                            <option value="Ms."
                                                                @if (strtolower(old('title')) == strtolower('Ms')) selected @elseif(strtolower($registration->title) == strtolower('Ms')) selected @endif>
                                                                Ms
                                                            </option>
                                                            <option value="Mrs."
                                                                @if (strtolower(old('title')) == strtolower('Mrs')) selected @elseif(strtolower($registration->title) == strtolower('Mrs')) selected @endif>
                                                                Mrs
                                                            </option>
                                                            <option value="Miss"
                                                                @if (strtolower(old('title')) == strtolower('Miss')) selected @elseif(strtolower($registration->title) == strtolower('Miss')) selected @endif>
                                                                Miss
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">First name</label>
                                                        <input type="text"
                                                            class="form-control @error('first_name') border border-danger @enderror "
                                                            name="first_name"
                                                            @if (old('first_name')) value="{{ old('first_name') }}"
                                                                @elseif ($registration->first_name) value="{{ $registration->first_name }}" @endif
                                                            placeholder="First name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Middle Name</label>
                                                        <input type="text"
                                                            class="form-control @error('middle_name') border border-danger @enderror "
                                                            name="middle_name"
                                                            @if (old('middle_name')) value="{{ old('middle_name') }}"
                                                                @elseif ($registration->middle_name) value="{{ $registration->middle_name }}" @endif
                                                            placeholder="Middle Name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Last Name</label>
                                                        <input type="text"
                                                            class="form-control @error('last_name') border border-danger @enderror "
                                                            name="last_name"
                                                            @if (old('last_name')) value="{{ old('last_name') }}"
                                                                @elseif ($registration->last_name) value="{{ $registration->last_name }}" @endif
                                                            placeholder="Last Name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Contact Number</label>
                                                        <input type="text"
                                                            class="form-control @error('contact_number') border border-danger @enderror "
                                                            name="contact_number"
                                                            @if (old('contact_number')) value="{{ old('contact_number') }}"
                                                                @elseif ($registration->father_contact_number) value="{{ $registration->father_contact_number }}" @endif
                                                            placeholder="Contact Number">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Contact Number2</label>
                                                        <input type="text"
                                                            class="form-control @error('contact_number2') border border-danger @enderror "
                                                            name="contact_number2"
                                                            @if (old('contact_number2')) value="{{ old('contact_number2') }}"
                                                                @elseif ($registration->mother_contact_number) value="{{ $registration->mother_contact_number }}" @endif
                                                            placeholder="Contact Number2">
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-6 mt-2">
                                                        <label for="" class="ml-1 mr-1">Address Line1</label>
                                                        <input type="text"
                                                            class="form-control @error('address_line1') border border-danger @enderror "
                                                            name="address_line1"
                                                            @if (old('address_line1')) value="{{ old('address_line1') }}"
                                                                @elseif ($registration->address_line1) value="{{ $registration->address_line1 }}" @endif
                                                            placeholder="Address Line1">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">City</label>
                                                        <input type="text"
                                                            class="form-control @error('city') border border-danger @enderror "
                                                            name="city"
                                                            @if (old('city')) value="{{ old('city') }}"
                                                                @elseif ($registration->city) value="{{ $registration->city }}" @endif
                                                            placeholder="City">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">State</label>
                                                        <input type="text"
                                                            class="form-control @error('state') border border-danger @enderror "
                                                            name="state"
                                                            @if (old('state')) value="{{ old('state') }}"
                                                                @elseif ($registration->state) value="{{ $registration->state }}" @endif
                                                            placeholder="State">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Pin Code</label>
                                                        <input type="text"
                                                            class="form-control @error('pin_code') border border-danger @enderror "
                                                            name="pin_code"
                                                            @if (old('pin_code')) value="{{ old('pin_code') }}"
                                                                @elseif ($registration->pin_code) value="{{ $registration->pin_code }}" @endif
                                                            placeholder="Pin Code">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Country</label>
                                                        <input type="text"
                                                            class="form-control @error('country') border border-danger @enderror "
                                                            name="country"
                                                            @if (old('country')) value="{{ old('country') }}"
                                                                @elseif ($registration->country)
                                                                value="{{ $registration->country }}"
                                                                @else
                                                                value="INDIA" @endif
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
                                                            name="date_of_birth"
                                                            @if (old('date_of_birth')) value="{{ old('date_of_birth') }}"
                                                                @elseif ($registration->date_of_birth)
                                                                value="{{ date('Y-m-d', strtotime($registration->date_of_birth)) }}" @endif
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
                                                                @if (old('gender') == 'M') selected @elseif ($registration->gender == "M") selected @endif>Male
                                                            </option>
                                                            <option value="F"
                                                                @if (old('gender') == 'F') selected @elseif ($registration->gender == "F") selected @endif>Female
                                                            </option>
                                                            <option value="O"
                                                                @if (old('gender') == 'O') selected @elseif ($registration->gender == "O") selected @endif>Other
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Father Name</label>
                                                        <input type="text"
                                                            class="form-control @error('father_name') border border-danger @enderror "
                                                            name="father_name"
                                                            @if (old('father_name')) value="{{ old('father_name') }}"
                                                                @elseif ($registration->father_name) value="{{ $registration->father_name }}" @endif
                                                            placeholder="Father Name">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Mother Name</label>
                                                        <input type="text"
                                                            class="form-control @error('mother_name') border border-danger @enderror "
                                                            name="mother_name"
                                                            @if (old('mother_name')) value="{{ old('mother_name') }}"
                                                                @elseif ($registration->mother_name) value="{{ $registration->mother_name }}" @endif
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
                                                        <label for="" class="ml-1 mr-1">Termination Date</label>
                                                        <input type="date"
                                                            class="form-control @error('termination_date') border border-danger @enderror "
                                                            name="termination_date" value="{{ old('termination_date') }}"
                                                            placeholder="Termination Date">
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
                                                        <label for="" class="ml-1 mr-1">Email</label>
                                                        <input type="text"
                                                            class="form-control @error('email') border border-danger @enderror "
                                                            name="email" value="{{ old('email') }}"
                                                            placeholder="Email">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Local Guardian</label>
                                                        <select name="local_guardian" id=""
                                                            class="form-control @error('local_guardian') border border-danger @enderror">
                                                            <option value="" selected>None</option>
                                                            @if ($local_guardians ?? '')
                                                                @foreach ($local_guardians as $local_guardian)
                                                                    <option value="{{ $local_guardian->id }}"
                                                                        @if (old('local_guardian') == $local_guardian->id) selected @endif>
                                                                        {{ $local_guardian->id . ' | ' . $local_guardian->title . ' ' . $local_guardian->first_name . ' ' . $local_guardian->middle_name . ' ' . $local_guardian->last_name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Relationship</label>
                                                        <input type="text"
                                                            class="form-control @error('relationship') border border-danger @enderror "
                                                            name="relationship"
                                                            value="@php
                                                                if (old('relationship')) {
                                                                    echo old('relationship');
                                                                } else {
                                                                    echo 'NONE';
                                                                }
                                                            @endphp"
                                                            placeholder="Relationship">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Quota</label>
                                                        <select name="quota" id=""
                                                            class="form-control @error('quota') border border-danger @enderror">
                                                            <option value="" selected disabled>Quota
                                                            </option>
                                                            @if ($quotas ?? '')
                                                                @foreach ($quotas as $quota)
                                                                    <option value="{{ $quota->id }}"
                                                                        @if (old('quota') == $quota->id) selected @endif>
                                                                        {{ $quota->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Registration Number</label>
                                                        <input type="text"
                                                            class="form-control @error('registration_number') border border-danger @enderror "
                                                            name="registration_number"
                                                            @if (old('registration_number')) value="{{ old('registration_number') }}"
                                                                @elseif ($registration->id) value="{{ $registration->id }}" @endif
                                                            placeholder="Registration Number">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Acadamic Session</label>
                                                        <select name="acadamic_session" id=""
                                                            class="form-control @error('acadamic_session') border border-danger @enderror">
                                                            <option value="" selected disabled>Acadamic Session
                                                            </option>
                                                            @if ($acadamic_sessions ?? '')
                                                                @foreach ($acadamic_sessions as $acadamic_session)
                                                                    <option value="{{ $acadamic_session->id }}"
                                                                        @if (old('acadamic_session') == $acadamic_session->id) selected @endif>
                                                                        {{ $acadamic_session->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Class</label>
                                                        <select name="class" id=""
                                                            class="form-control @error('class') border border-danger @enderror">
                                                            <option value="" selected disabled>Class
                                                            </option>
                                                            @if ($classes ?? '')
                                                                @foreach ($classes as $class)
                                                                    <option value="{{ $class->id }}"
                                                                        @if (old('class') == $class->id) selected @elseif ($registration->registration_class_id == $class->id) selected @endif>
                                                                        {{ $class->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                        <label for="" class="ml-1 mr-1">Section</label>
                                                        <select name="section" id=""
                                                            class="form-control @error('section') border border-danger @enderror">
                                                            <option value="" selected disabled>Section
                                                            </option>
                                                            @if ($sections ?? '')
                                                                @foreach ($sections as $section)
                                                                    <option value="{{ $section->id }}"
                                                                        @if (old('section') == $section->id) selected @endif>
                                                                        {{ $section->name }}
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
