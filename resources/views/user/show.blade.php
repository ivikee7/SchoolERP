@extends('master')
@section('title', Auth()->user()->first_name . ' ' . Auth()->user()->last_name . ' | User Profile')
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
                                        src="@if (!empty($image->media_path)) {{ asset($image->media_path) }} @elseif ($user->gender == 'M') {{ asset('dist/img/male1.png') }} @elseif ($user->gender == 'F') {{ asset('dist/img/female1.png') }} @elseif ($user->gender == 'O') {{ asset('dist/img/boxed-bg.jpg') }} @endif"
                                        alt="User profile picture">
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('image.index', $user->id) }}"><i class="fa-solid fa-user-pen"></i></a>
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

                                </p>
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
                                <strong><i class="fas fa-user-alt mr-1"></i> Email</strong>
                                <p class="text-muted">{{ $user->email }}</p>
                                <hr>
                                <strong><i class="fas fa-user-alt mr-1"></i> School Email</strong>
                                <p class="text-muted">{{ $user->email_alternate }}</p>
                                <hr>
                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                                <p class="text-muted">{{ $user->address_line1 }}, {{ $user->city }},
                                    {{ $user->state }},
                                    {{ $user->country }}, {{ $user->pin_code }}</p>
                                <hr>
                                <strong><i class="fas fa-calendar-day mr-1"></i> Date of
                                    Birth</strong>
                                <p class="text-muted">
                                    {{ date('Y-M-d', strtotime($user->date_of_birth)) }}</p>
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
                                            class="nav-link @if ($errors->any()) @else active @endif "
                                            href="#profile" data-toggle="tab">User
                                            information</a></li>
                                    {{-- <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                                    </li> --}}
                                    @can('user_edit')
                                        <li class="nav-item"><a
                                                class="nav-link @if ($errors->any()) active @endif "
                                                href="#update" data-toggle="tab">Update</a>
                                        </li>
                                    @endcan
                                    <span class="float-right ml-1">
                                        <a href="{{ route('user.index') }}">
                                            <input type="button" value="Users" class="btn btn-warning">
                                        </a>
                                        {{-- <a href="{{ route('user.edit', $user->id) }}">
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
                                                        <strong> Joining
                                                            Date</strong>
                                                        <p class="text-muted">
                                                            @if ($user->joining_date)
                                                                {{ date('Y-M-d', strtotime($user->joining_date)) }}
                                                            @endif
                                                        </p>
                                                        <hr>
                                                        <strong> Termination
                                                            Date</strong>
                                                        <p class="text-muted">
                                                            @if ($user->termination_date)
                                                                {{ date('Y-M-d', strtotime($user->termination_date)) }}
                                                            @endif
                                                        </p>
                                                        <hr>
                                                        <strong> Allocated Casual Leave</strong>
                                                        <p class="text-muted">
                                                            {{ $user->allocated_casual_leave }}
                                                        </p>
                                                        <hr>
                                                        <strong> Allocated Sick Leave</strong>
                                                        <p class="text-muted">
                                                            {{ $user->allocated_sick_leave }}
                                                        </p>
                                                        <hr>
                                                        <strong> Travel Allowance</strong>
                                                        <p class="text-muted">
                                                            {{ $user->travel_allowance }}
                                                        </p>
                                                        <hr>
                                                        <strong> Gross Salary</strong>
                                                        <p class="text-muted">
                                                            {{ $user->gross_salary }}
                                                        </p>
                                                        <hr>
                                                        <strong> Basic Salary</strong>
                                                        <p class="text-muted">
                                                            {{ $user->basic_salary }}
                                                        </p>
                                                        <hr>
                                                        <strong> Grade Salary</strong>
                                                        <p class="text-muted">
                                                            {{ $user->grade_salary }}
                                                        </p>
                                                        <hr>
                                                        <strong> Salary Review Date</strong>
                                                        <p class="text-muted">
                                                            {{ $user->salary_review_date }}
                                                        </p>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                <div class="card card-primary">
                                                    <div class="card-body">
                                                        <strong> Bank Account Number</strong>
                                                        <p class="text-muted">
                                                            {{ $user->bank_account_number }}
                                                        </p>
                                                        <hr>
                                                        <strong> IFSC Code</strong>
                                                        <p class="text-muted">
                                                            {{ $user->ifsc_code }}
                                                        </p>
                                                        <hr>
                                                        <strong> PAN Number</strong>
                                                        <p class="text-muted">
                                                            {{ $user->pan_number }}
                                                        </p>
                                                        <hr>
                                                        <strong> PF</strong>
                                                        <p class="text-muted">
                                                            @if ($user->pf == 1)
                                                                YES
                                                            @else
                                                                NO
                                                            @endif
                                                        </p>
                                                        <hr>
                                                        <strong> PF Number</strong>
                                                        <p class="text-muted">
                                                            {{ $user->pf_number }}
                                                        </p>
                                                        <hr>
                                                        <strong> ESI Number</strong>
                                                        <p class="text-muted">
                                                            {{ $user->esi_number }}
                                                        </p>
                                                        <hr>
                                                        <strong> Union Number</strong>
                                                        <p class="text-muted">
                                                            {{ $user->un_number }}
                                                        </p>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="activity">
                                        <!-- Post -->
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                    src="../../dist/img/user1-128x128.jpg" alt="user image">
                                                <span class="username">
                                                    <a href="#">Jonathan Burke Jr.</a>
                                                    <a href="#" class="float-right btn-tool"><i
                                                            class="fas fa-times"></i></a>
                                                </span>
                                                <span class="description">Shared publicly - 7:30 PM today</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                Lorem ipsum represents a long-held tradition for designers,
                                                typographers and the like. Some people hate it and argue for
                                                its demise, but others ignore the hate as they create awesome
                                                tools to help create filler text for everyone from bacon lovers
                                                to Charlie Sheen fans.
                                            </p>

                                            <p>
                                                <a href="#" class="link-black text-sm mr-2"><i
                                                        class="fas fa-share mr-1"></i> Share</a>
                                                <a href="#" class="link-black text-sm"><i
                                                        class="far fa-thumbs-up mr-1"></i> Like</a>
                                                <span class="float-right">
                                                    <a href="#" class="link-black text-sm">
                                                        <i class="far fa-comments mr-1"></i> Comments (5)
                                                    </a>
                                                </span>
                                            </p>

                                            <input class="form-control form-control-sm" type="text"
                                                placeholder="Type a comment">
                                        </div>
                                        <!-- /.post -->

                                        <!-- Post -->
                                        <div class="post clearfix">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                    src="../../dist/img/user7-128x128.jpg" alt="User Image">
                                                <span class="username">
                                                    <a href="#">Sarah Ross</a>
                                                    <a href="#" class="float-right btn-tool"><i
                                                            class="fas fa-times"></i></a>
                                                </span>
                                                <span class="description">Sent you a message - 3 days ago</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                Lorem ipsum represents a long-held tradition for designers,
                                                typographers and the like. Some people hate it and argue for
                                                its demise, but others ignore the hate as they create awesome
                                                tools to help create filler text for everyone from bacon lovers
                                                to Charlie Sheen fans.
                                            </p>

                                            <form class="form-horizontal">
                                                <div class="input-group input-group-sm mb-0">
                                                    <input class="form-control form-control-sm" placeholder="Response">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-danger">Send</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.post -->

                                        <!-- Post -->
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                    src="../../dist/img/user6-128x128.jpg" alt="User Image">
                                                <span class="username">
                                                    <a href="#">Adam Jones</a>
                                                    <a href="#" class="float-right btn-tool"><i
                                                            class="fas fa-times"></i></a>
                                                </span>
                                                <span class="description">Posted 5 photos - 5 days ago</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="row mb-3">
                                                <div class="col-sm-6">
                                                    <img class="img-fluid" src="../../dist/img/photo1.png"
                                                        alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <img class="img-fluid mb-3" src="../../dist/img/photo2.png"
                                                                alt="Photo">
                                                            <img class="img-fluid" src="../../dist/img/photo3.jpg"
                                                                alt="Photo">
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-6">
                                                            <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg"
                                                                alt="Photo">
                                                            <img class="img-fluid" src="../../dist/img/photo1.png"
                                                                alt="Photo">
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            <p>
                                                <a href="#" class="link-black text-sm mr-2"><i
                                                        class="fas fa-share mr-1"></i> Share</a>
                                                <a href="#" class="link-black text-sm"><i
                                                        class="far fa-thumbs-up mr-1"></i> Like</a>
                                                <span class="float-right">
                                                    <a href="#" class="link-black text-sm">
                                                        <i class="far fa-comments mr-1"></i> Comments (5)
                                                    </a>
                                                </span>
                                            </p>

                                            <input class="form-control form-control-sm" type="text"
                                                placeholder="Type a comment">
                                        </div>
                                        <!-- /.post -->
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="timeline">
                                        <!-- The timeline -->
                                        <div class="timeline timeline-inverse">
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-danger">
                                                    10 Feb. 2014 </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-envelope bg-primary"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent
                                                        you an email</h3>

                                                    <div class="timeline-body">
                                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo
                                                        kaboodle
                                                        quora plaxo ideeli hulu weebly balihoo...
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-user bg-info"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                                    <h3 class="timeline-header border-0"><a href="#">Sarah Young</a>
                                                        accepted your friend request
                                                    </h3>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-comments bg-warning"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented
                                                        on your post</h3>

                                                    <div class="timeline-body">
                                                        Take me to your leader!
                                                        Switzerland is small and neutral!
                                                        We are more like Germany, ambitious and misunderstood!
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a href="#" class="btn btn-warning btn-flat btn-sm">View
                                                            comment</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-success">
                                                    3 Jan. 2014
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-camera bg-purple"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded
                                                        new photos</h3>

                                                    <div class="timeline-body">
                                                        {{-- <img src="https://placehold.it/150x100" alt="...">
                                                        <img src="https://placehold.it/150x100" alt="...">
                                                        <img src="https://placehold.it/150x100" alt="...">
                                                        <img src="https://placehold.it/150x100" alt="..."> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <div>
                                                <i class="far fa-clock bg-gray"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-pane -->

                                    @can('user_edit')
                                        <div class="@if ($errors->any()) active @endif tab-pane" id="update">
                                            <form action="{{ route('user.update', $user->id) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 mt-2">
                                                                <label for="">Role</label>
                                                                <select name="role" id=""
                                                                    class="form-control @error('role') border border-danger @enderror">
                                                                    <option value="" selected disabled>Role</option>
                                                                    @if ($roles ?? '')
                                                                        @foreach ($roles as $role)
                                                                            <option value="{{ $role->name }}"
                                                                                @if (old('role') == $role->name) selected
                                                                                    @elseif ($user->role_name == $role->name) selected @endif>
                                                                                {{ $role->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
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
                                                                <label for="">Status</label>
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
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mt-2">
                                                                <label for="">Image</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="custom-file">
                                                                        <input type="file" name="image"
                                                                            class="custom-file-input" id="inputGroupFile03">
                                                                        <label class="custom-file-label"
                                                                            for="inputGroupFile03">Choose file</label>
                                                                    </div>
                                                                </div>
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
                                            <form action="{{ route('user.information.update', $user->id) }}" method="post">
                                                @csrf
                                                @method('post')
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                                <label for="" class="ml-1 mr-1">Joining Date</label>
                                                                <input type="date"
                                                                    class="form-control @error('joining_date') border border-danger @enderror "
                                                                    name="joining_date"
                                                                    @if (old('joining_date')) value="{{ old('joining_date') }}"
                                                                       @elseif($user->joining_date != '') value="{{ date('Y-m-d', strtotime($user->joining_date)) }}" @endif
                                                                    placeholder="Joining Date">
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                                <label for="" class="ml-1 mr-1">Allocated Casual
                                                                    Leave</label>
                                                                <input type="text"
                                                                    class="form-control @error('allocated_casual_leave') border border-danger @enderror "
                                                                    name="allocated_casual_leave"
                                                                    @if (old('allocated_casual_leave')) value="{{ old('allocated_casual_leave') }}"
                                                                       @elseif($user->allocated_casual_leave != '') value="{{ $user->allocated_casual_leave }}" @endif
                                                                    placeholder="Allocated Casual Leave">
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                                <label for="" class="ml-1 mr-1">Allocated Sick
                                                                    Leave</label>
                                                                <input type="text"
                                                                    class="form-control @error('allocated_sick_leave') border border-danger @enderror "
                                                                    name="allocated_sick_leave"
                                                                    @if (old('allocated_sick_leave')) value="{{ old('allocated_sick_leave') }}"
                                                                       @elseif($user->allocated_sick_leave != '') value="{{ $user->allocated_sick_leave }}" @endif
                                                                    placeholder="Allocated Sick Leave">
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                                <label for="" class="ml-1 mr-1">PF Number</label>
                                                                <input type="text"
                                                                    class="form-control @error('pf_number') border border-danger @enderror "
                                                                    name="pf_number"
                                                                    @if (old('pf_number')) value="{{ old('pf_number') }}"
                                                                       @elseif($user->pf_number != '') value="{{ $user->pf_number }}" @endif
                                                                    placeholder="PF Number">
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                                <label for="" class="ml-1 mr-1">ESI Number</label>
                                                                <input type="text"
                                                                    class="form-control @error('esi_number') border border-danger @enderror "
                                                                    name="esi_number"
                                                                    @if (old('esi_number')) value="{{ old('esi_number') }}"
                                                                       @elseif($user->esi_number != '') value="{{ $user->esi_number }}" @endif
                                                                    placeholder="ESI Number">
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                                <label for="" class="ml-1 mr-1">Bank Account
                                                                    Number</label>
                                                                <input type="text"
                                                                    class="form-control @error('bank_account_number') border border-danger @enderror "
                                                                    name="bank_account_number"
                                                                    @if (old('bank_account_number')) value="{{ old('bank_account_number') }}"
                                                                       @elseif($user->bank_account_number != '') value="{{ $user->bank_account_number }}" @endif
                                                                    placeholder="Bank Account Number">
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                                <label for="" class="ml-1 mr-1">IFSC Code</label>
                                                                <input type="text"
                                                                    class="form-control @error('ifsc_code') border border-danger @enderror "
                                                                    name="ifsc_code"
                                                                    @if (old('ifsc_code')) value="{{ old('ifsc_code') }}"
                                                                       @elseif($user->ifsc_code != '') value="{{ $user->ifsc_code }}" @endif
                                                                    value="{{ old('ifsc_code') }}" placeholder="IFSC Code">
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                                <label for="" class="ml-1 mr-1">Un Number</label>
                                                                <input type="text"
                                                                    class="form-control @error('un_number') border border-danger @enderror "
                                                                    name="un_number"
                                                                    @if (old('un_number')) value="{{ old('un_number') }}"
                                                                       @elseif($user->un_number != '') value="{{ $user->un_number }}" @endif
                                                                    placeholder="Un Number">
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                                <label for="" class="ml-1 mr-1">Pan Number</label>
                                                                <input type="text"
                                                                    class="form-control @error('pan_number') border border-danger @enderror "
                                                                    name="pan_number"
                                                                    @if (old('pan_number')) value="{{ old('pan_number') }}"
                                                                       @elseif($user->pan_number != '') value="{{ $user->pan_number }}" @endif
                                                                    placeholder="Pan Number">
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                                <label for="" class="ml-1 mr-1">Travel
                                                                    Allowance</label>
                                                                <input type="text"
                                                                    class="form-control @error('travel_allowance') border border-danger @enderror "
                                                                    name="travel_allowance"
                                                                    @if (old('travel_allowance')) value="{{ old('travel_allowance') }}"
                                                                       @elseif($user->travel_allowance != '') value="{{ $user->travel_allowance }}" @endif
                                                                    value="{{ old('travel_allowance') }}"
                                                                    placeholder="Travel Allowance">
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                                <label for="" class="ml-1 mr-1">Gross Salary</label>
                                                                <input type="text"
                                                                    class="form-control @error('gross_salary') border border-danger @enderror "
                                                                    name="gross_salary"
                                                                    @if (old('gross_salary')) value="{{ old('gross_salary') }}"
                                                                       @elseif($user->gross_salary != '') value="{{ $user->gross_salary }}" @endif
                                                                    placeholder="Gross Salary">
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                                <label for="" class="ml-1 mr-1">Basic Salary</label>
                                                                <input type="text"
                                                                    class="form-control @error('basic_salary') border border-danger @enderror "
                                                                    name="basic_salary"
                                                                    @if (old('basic_salary')) value="{{ old('basic_salary') }}"
                                                                       @elseif($user->basic_salary != '') value="{{ $user->basic_salary }}" @endif
                                                                    placeholder="Basic Salary">
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                                <label for="" class="ml-1 mr-1">Grade Salary</label>
                                                                <input type="text"
                                                                    class="form-control @error('grade_salary') border border-danger @enderror "
                                                                    name="grade_salary"
                                                                    @if (old('grade_salary')) value="{{ old('grade_salary') }}"
                                                                       @elseif($user->grade_salary != '') value="{{ $user->grade_salary }}" @endif
                                                                    value="{{ old('grade_salary') }}"
                                                                    placeholder="Grade Salary">
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-2">
                                                                <label for="" class="ml-1 mr-1">PF</label>
                                                                <select name="pf" id=""
                                                                    class="form-control @error('pf') border border-danger @enderror">

                                                                    <option value="" selected disabled>Select</option>
                                                                    <option value="1"
                                                                        @if (old('pf') == '1') selected
                                                                            @elseif ($user->pf == '1') selected @endif>
                                                                        Yes
                                                                    </option>
                                                                    <option value="0"
                                                                        @if (old('pf') == '0') selected
                                                                            @elseif ($user->pf == '0') selected @endif>
                                                                        No
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
                                        <!-- /.tab-pane -->
                                    @endcan
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
