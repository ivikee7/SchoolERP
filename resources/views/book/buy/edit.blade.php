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
                                    <a href="{{ route('user.show', $user->id) }}">
                                        <input type="button" value="View" class="btn btn-sm btn-primary">
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('user.update', $user->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    @if ($message ?? '')
                                                        <div class="alert alert-success text-center col-12">
                                                            {{ $message }}</div>
                                                    @endif
                                                    {{-- <div class="col-12 text-center">{!! Session::has('message') ? Session::get('message') : '' !!}</div> --}}
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Role</label>
                                                        <select name="role" id=""
                                                            class="form-control @error('role') border border-danger @enderror">
                                                            <option value="" selected disabled>Role</option>
                                                            @if ($roles ?? '')
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role->name }}"
                                                                        @if (old('role') == $role->name) selected @elseif ($user->role_name == $role->name) selected @endif>
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">
                                                            Title
                                                        </label>
                                                        <select name="title"
                                                            class="form-control @error('title') border border-danger @enderror">
                                                            <option value="" disabled selected>Title</option>
                                                            <option value="Mr"
                                                                @if (strtolower(old('title')) == strtolower('Mr')) selected @elseif (strtolower($user->title) == strtolower('Mr')) selected @endif>
                                                                Mr
                                                            </option>
                                                            <option value="Ms"
                                                                @if (strtolower(old('title')) == strtolower('Ms')) selected @elseif (strtolower($user->title) == strtolower('Ms')) selected @endif>
                                                                Ms
                                                            </option>
                                                            <option value="Mrs"
                                                                @if (strtolower(old('title')) == strtolower('Mrs')) selected @elseif (strtolower($user->title) == strtolower('Mrs')) selected @endif>
                                                                Mrs
                                                            </option>
                                                            <option value="Miss"
                                                                @if (strtolower(old('title')) == strtolower('Miss')) selected @elseif (strtolower($user->title) == strtolower('Miss')) selected @endif>
                                                                Miss
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">First name</label>
                                                        <input type="text"
                                                            class="form-control @error('first_name') border border-danger @enderror "
                                                            name="first_name"
                                                            @if (old('first_name')) value="{{ old('first_name') }}"
                                                            @elseif($user->first_name != '') value="{{ $user->first_name }}" @endif
                                                            placeholder="First name">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Middle Name</label>
                                                        <input type="text"
                                                            class="form-control @error('middle_name') border border-danger @enderror "
                                                            name="middle_name"
                                                            @if (old('middle_name')) value="{{ old('middle_name') }}"
                                                            @elseif($user->middle_name != '') value="{{ $user->middle_name }}" @endif
                                                            placeholder="Middle Name">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Last Name</label>
                                                        <input type="text"
                                                            class="form-control @error('last_name') border border-danger @enderror "
                                                            name="last_name"
                                                            @if (old('last_name')) value="{{ old('last_name') }}"
                                                            @elseif($user->last_name != '') value="{{ $user->last_name }}" @endif
                                                            placeholder="Last Name">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Contact Number</label>
                                                        <input type="text"
                                                            class="form-control @error('contact_number') border border-danger @enderror "
                                                            name="contact_number"
                                                            @if (old('contact_number')) value="{{ old('contact_number') }}"
                                                            @elseif($user->contact_number != '') value="{{ $user->contact_number }}" @endif
                                                            placeholder="Contact Number">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Contact Number2</label>
                                                        <input type="text"
                                                            class="form-control @error('contact_number2') border border-danger @enderror "
                                                            name="contact_number2"
                                                            @if (old('contact_number2')) value="{{ old('contact_number2') }}"
                                                            @elseif($user->contact_number2 != '') value="{{ $user->contact_number2 }}" @endif
                                                            placeholder="Contact Number2">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 mt-2">
                                                        <label for="">Address Line1</label>
                                                        <input type="text"
                                                            class="form-control @error('address_line1') border border-danger @enderror "
                                                            name="address_line1"
                                                            @if (old('address_line1')) value="{{ old('address_line1') }}"
                                                            @elseif($user->address_line1 != '') value="{{ $user->address_line1 }}" @endif
                                                            placeholder="Address Line1">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">City</label>
                                                        <input type="text"
                                                            class="form-control @error('city') border border-danger @enderror "
                                                            name="city"
                                                            @if (old('city')) value="{{ old('city') }}"
                                                            @elseif($user->city != '') value="{{ $user->city }}" @endif
                                                            placeholder="City">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">State</label>
                                                        <input type="text"
                                                            class="form-control @error('state') border border-danger @enderror "
                                                            name="state"
                                                            @if (old('state')) value="{{ old('state') }}"
                                                            @elseif($user->state != '') value="{{ $user->state }}" @endif
                                                            placeholder="State">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Pin Code</label>
                                                        <input type="text"
                                                            class="form-control @error('pin_code') border border-danger @enderror "
                                                            name="pin_code"
                                                            @if (old('pin_code')) value="{{ old('pin_code') }}"
                                                            @elseif($user->pin_code != '') value="{{ $user->pin_code }}" @endif
                                                            placeholder="Pin Code">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Country</label>
                                                        <input type="text"
                                                            class="form-control @error('country') border border-danger @enderror "
                                                            name="country"
                                                            @if (old('country')) value="{{ old('country') }}"
                                                            @elseif($user->country != '') value="{{ $user->country }}" @endif
                                                            placeholder="Country">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Transport</label>
                                                        <input type="text"
                                                            class="form-control @error('transport_id') border border-danger @enderror "
                                                            name="transport_id"
                                                            @if (old('transport_id')) value="{{ old('transport_id') }}"
                                                            @elseif($user->transport_id != '') value="{{ $user->transport_id }}" @endif
                                                            placeholder="Transport">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Aadhaar Number</label>
                                                        <input type="text"
                                                            class="form-control @error('aadhaar_number') border border-danger @enderror "
                                                            name="aadhaar_number"
                                                            @if (old('aadhaar_number')) value="{{ old('aadhaar_number') }}"
                                                            @elseif($user->aadhaar_number != '') value="{{ $user->aadhaar_number }}" @endif
                                                            placeholder="Aadhaar Number">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Blood Group</label>
                                                        <select name="blood_group" id=""
                                                            class="form-control @error('blood_group') border border-danger @enderror"
                                                            value="{{ old('blood_group') }}">
                                                            <option value="" selected disabled>Blood Group</option>
                                                            <option value="A+"
                                                                @if (old('blood_group') == 'A+') selected @elseif ($user->blood_group == 'A+') selected @endif>
                                                                A+
                                                            </option>
                                                            <option value="A-"
                                                                @if (old('blood_group') == 'A-') selected @elseif ($user->blood_group == 'A-') selected @endif>
                                                                A-
                                                            </option>
                                                            <option value="B+"
                                                                @if (old('blood_group') == 'B+') selected @elseif ($user->blood_group == 'B+') selected @endif>
                                                                B+
                                                            </option>
                                                            <option value="B-"
                                                                @if (old('blood_group') == 'B-') selected @elseif ($user->blood_group == 'B-') selected @endif>
                                                                B-
                                                            </option>
                                                            <option value="O+"
                                                                @if (old('blood_group') == 'O+') selected @elseif ($user->blood_group == 'O+') selected @endif>
                                                                O+
                                                            </option>
                                                            <option value="O-"
                                                                @if (old('blood_group') == 'O-') selected @elseif ($user->blood_group == 'O-') selected @endif>
                                                                O-
                                                            </option>
                                                            <option value="AB+"
                                                                @if (old('blood_group') == 'AB+') selected @elseif ($user->blood_group == 'AB+') selected @endif>
                                                                AB+
                                                            </option>
                                                            <option value="AB-"
                                                                @if (old('blood_group') == 'AB-') selected @elseif ($user->blood_group == 'AB-') selected @endif>
                                                                AB-
                                                            </option>
                                                            <option value="UNK"
                                                                @if (old('blood_group') == 'UNK') selected @elseif ($user->blood_group == 'UNK') selected @endif>
                                                                UNK
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Mother Tongue</label>
                                                        <input type="text"
                                                            class="form-control @error('mother_tongue') border border-danger @enderror "
                                                            name="mother_tongue"
                                                            @if (old('mother_tongue')) value="{{ old('mother_tongue') }}"
                                                            @elseif($user->mother_tongue != '') value="{{ $user->mother_tongue }}" @endif
                                                            placeholder="Mother Tongue">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Date of Birth</label>
                                                        <input type="date"
                                                            class="form-control @error('date_of_birth') border border-danger @enderror "
                                                            name="date_of_birth"
                                                            @if (old('date_of_birth')) value="{{ old('date_of_birth') }}"
                                                            @elseif($user->date_of_birth != '') value="{{ date('Y-m-d', strtotime($user->date_of_birth)) }}" @endif
                                                            placeholder="Date of Birth">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Place of Birth</label>
                                                        <input type="text"
                                                            class="form-control @error('place_of_birth') border border-danger @enderror "
                                                            name="place_of_birth"
                                                            @if (old('place_of_birth')) value="{{ old('place_of_birth') }}"
                                                            @elseif($user->place_of_birth != '') value="{{ $user->place_of_birth }}" @endif
                                                            placeholder="Place of Birth">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Gender</label>
                                                        <select name="gender" id=""
                                                            class="form-control @error('gender') border border-danger @enderror">
                                                            <option value="" selected disabled>Gender</option>
                                                            <option value="M"
                                                                @if (old('gender') == 'M') selected @elseif ($user->gender == 'M') selected @endif>
                                                                Male
                                                            </option>
                                                            <option value="F"
                                                                @if (old('gender') == 'F') selected @elseif ($user->gender == 'F') selected @endif>
                                                                Female
                                                            </option>
                                                            <option value="O"
                                                                @if (old('gender') == 'O') selected @elseif ($user->gender == 'O') selected @endif>
                                                                Other
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Father Name</label>
                                                        <input type="text"
                                                            class="form-control @error('father_name') border border-danger @enderror "
                                                            name="father_name"
                                                            @if (old('father_name')) value="{{ old('father_name') }}"
                                                            @elseif($user->father_name != '') value="{{ $user->father_name }}" @endif
                                                            placeholder="Father Name">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Mother Name</label>
                                                        <input type="text"
                                                            class="form-control @error('mother_name') border border-danger @enderror "
                                                            name="mother_name"
                                                            @if (old('mother_name')) value="{{ old('mother_name') }}"
                                                            @elseif($user->mother_name != '') value="{{ $user->mother_name }}" @endif
                                                            placeholder="Mother Name">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Remarks</label>
                                                        <input type="text"
                                                            class="form-control @error('remarks') border border-danger @enderror "
                                                            name="remarks"
                                                            @if (old('remarks')) value="{{ old('remarks') }}"
                                                            @elseif($user->remarks != '') value="{{ $user->remarks }}" @endif
                                                            placeholder="Remarks">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Termination Date</label>
                                                        <input type="date"
                                                            class="form-control @error('termination_date') border border-danger @enderror "
                                                            name="termination_date"
                                                            @if (old('termination_date')) value="{{ old('termination_date') }}"
                                                            @elseif($user->termination_date != '') value="{{ date('Y-m-d', strtotime($user->termination_date)) }}" @endif
                                                            placeholder="Termination Date">
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
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
                                                                Suspended</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 col-sm-12 mt-2">
                                                        <label for="">Email</label>
                                                        <input type="text"
                                                            class="form-control @error('email') border border-danger @enderror "
                                                            name="email"
                                                            @if (old('email')) value="{{ old('email') }}"
                                                            @elseif($user->email != '') value="{{ $user->email }}" @endif
                                                            placeholder="Email">
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
