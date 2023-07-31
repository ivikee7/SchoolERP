@extends('master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Registration</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Registration</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content attendance">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Registration</h3>
                                <div class="card-title float-sm-right">
                                    <a href="{{ route('registration.create') }}">
                                        <input type="button" value="Create Registration" class="btn btn-sm btn-primary">
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-striped datatable">
                                    <thead>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('ajax') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'registration_number',
                        name: 'registration_number'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'middle_name',
                        name: 'middle_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'date_of_birth',
                        name: 'date_of_birth'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'father_name',
                        name: 'father_name'
                    },
                    {
                        data: 'father_qualification',
                        name: 'father_qualification'
                    },
                    {
                        data: 'father_occupation',
                        name: 'father_occupation'
                    },
                    {
                        data: 'father_contact_number',
                        name: 'father_contact_number'
                    },
                    {
                        data: 'mother_name',
                        name: 'mother_name'
                    },
                    {
                        data: 'mother_qualification',
                        name: 'mother_qualification'
                    },

                    {
                        data: 'mother_occupation',
                        name: 'mother_occupation'
                    },
                    {
                        data: 'mother_contact_number',
                        name: 'mother_contact_number'
                    },
                    {
                        data: 'mother_contact_number',
                        name: 'mother_contact_number'
                    },
                    {
                        data: 'address_line1',
                        name: 'address_line1'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'state',
                        name: 'state'
                    },
                    {
                        data: 'pin_code',
                        name: 'pin_code'
                    },
                    {
                        data: 'registration_class_id',
                        name: 'registration_class_id'
                    },
                    {
                        data: 'last_attended_school',
                        name: 'last_attended_school'
                    },
                    {
                        data: 'last_attended_class_id',
                        name: 'last_attended_class_id'
                    },
                    {
                        data: 'created_by',
                        name: 'created_by'
                    },
                    {
                        data: 'updated_by',
                        name: 'updated_by'
                    }
                ]
            });
        });
    </script>
@endsection()
