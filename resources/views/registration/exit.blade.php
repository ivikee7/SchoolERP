@extends('master') @section('content')
    @php
        use Carbon\Carbon;
        use App\Http\Controllers\UserController;
        $registrations = UserController::getRegistration();
    @endphp
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
                                <h3 class="card-title">Student Registration Edit</h3>
                                <div class="card-title float-sm-right">
                                    <a href="{{ route('student.registration.update') }}">
                                        <input type="button" value="Add new Registration"
                                               class="btn btn-sm btn-primary">
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-striped datatable">
                                    <thead>
                                    <tr>
                                        <th>Reg</th>
                                        <th>RegOld</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>DOB</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Pin Code</th>
                                        <th>Father Name</th>
                                        <th>Father Qualification</th>
                                        <th>Father Occupation</th>
                                        <th>Father Contact Number</th>
                                        <th>Mother Name</th>
                                        <th>Mother Qualification</th>
                                        <th>Mother Occupation</th>
                                        <th>Mother Contact_number</th>
                                        <th>Registration Class</th>
                                        <th>Last Attended School</th>
                                        <th>Last Attended Class</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($registrations as $registration)
                                        <tr>
                                            <td>{{ $registration->id }}</td>
                                            <td>{{ $registration->registration_number }}</td>
                                            <td>{{ $registration->first_name . ' ' . $registration->middle_name . ' ' . $registration->last_name }}
                                            </td>
                                            <td>{{ $registration->gender }}</td>
                                            <td>{{ $registration->date_of_birth }}</td>
                                            <td>{{ $registration->address_line1 }}</td>
                                            <td>{{ $registration->city }}</td>
                                            <td>{{ $registration->state }}</td>
                                            <td>{{ $registration->pin_code }}</td>
                                            <td>{{ $registration->father_name }}</td>
                                            <td>{{ $registration->father_qualification }}</td>
                                            <td>{{ $registration->father_occupation }}</td>
                                            <td>{{ $registration->father_contact_number }}</td>
                                            <td>{{ $registration->mother_name }}</td>
                                            <td>{{ $registration->mother_qualification }}</td>
                                            <td>{{ $registration->mother_occupation }}</td>
                                            <td>{{ $registration->mother_contact_number }}</td>
                                            <td>{{ $registration->registration_class_id }}</td>
                                            <td>{{ $registration->last_attended_school }}</td>
                                            <td>{{ $registration->last_attended_class_id }}</td>
                                            <td>{{ $registration->created_by }}</td>
                                            <td>{{ $registration->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Reg</th>
                                        <th>RegOld</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>DOB</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Pin Code</th>
                                        <th>Father Name</th>
                                        <th>Father Qualification</th>
                                        <th>Father Occupation</th>
                                        <th>Father Contact Number</th>
                                        <th>Mother Name</th>
                                        <th>Mother Qualification</th>
                                        <th>Mother Occupation</th>
                                        <th>Mother Contact_number</th>
                                        <th>Registration Class</th>
                                        <th>Last Attended School</th>
                                        <th>Last Attended Class</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                    </tr>
                                    </tfoot>
                                </table>
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
