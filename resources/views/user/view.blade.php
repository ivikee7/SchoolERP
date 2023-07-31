@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | User Create')
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
                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('dist/img/male1.png') }}"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">
                                    {{ $user->title . ' ' . $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}
                                </h3>

                                <p class="text-muted text-center">{{ $user->role_name }}</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        {{-- <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                                <p class="text-muted">
                                    B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                <p class="text-muted">Malibu, California</p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                                <p class="text-muted">
                                    <span class="tag tag-danger">UI Design</span>
                                    <span class="tag tag-success">Coding</span>
                                    <span class="tag tag-info">Javascript</span>
                                    <span class="tag tag-warning">PHP</span>
                                    <span class="tag tag-primary">Node.js</span>
                                </p>

                                <hr>

                                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                                    fermentum enim neque.</p>
                            </div>
                            <!-- /.card-body -->
                        </div> --}}
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">User information</h3>
                                        <div class="card-title float-right">
                                            <a href="{{ route('user.index') }}">
                                                <input type="button" value="Users" class="btn btn-sm btn-primary">
                                            </a>
                                            <a href="{{ route('user.edit', $user->id) }}">
                                                <input type="button" value="Edit" class="btn btn-sm btn-primary">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Title</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->title }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">First name</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->first_name }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Middle Name</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->middle_name }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Last Name</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->last_name }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Contact Number</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->contact_number }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Contact Number2</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->contact_number2 }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Address Line1</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->address_line1 }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">City</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->city }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">State</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->state }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Pin Code</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->pin_code }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Country</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->country }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Transport</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->transport }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Aadhaar Number</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->aadhaar_number }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Blood Group</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->blood_group }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Mother Tongue</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->mother_tongue }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Date of Birth</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->date_of_birth }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Place of Birth</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->place_of_birth }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Gender</label>
                                                <input type="text" class="form-control" disabled
                                                    @if ($user->gender == 'M') value="MALE"
                                                @elseif ($user->gender == 'F')
                                                    value="FEMALE"
                                                @elseif ($user->gender == 'O')
                                                    value="OTHER" @endif>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Father Name</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->father_name }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Mother Name</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->mother_name }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Remarks</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->remarks }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Termination Date</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->termination_date }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Status</label>
                                                <input type="text" class="form-control" disabled
                                                    @if ($user->status == 1) value="Active"
                                                @elseif ($user->status == 0)
                                                    value="Suspended" @endif
                                                    value="{{ $user->status }}">
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mt-2">
                                                <label for="">Email</label>
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $user->email }}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
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
