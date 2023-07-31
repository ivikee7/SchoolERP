@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Registrations')
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
                                <h3 class="card-title">Student Registrations</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('registration.create') }}">
                                        <input type="button" value="Add New" class="btn btn-sm btn-primary">
                                    </a>
                                    <a href="{{ route('registration.index') }}">
                                        <input type="button" value="Registrations" class="btn btn-sm btn-primary">
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Reg No</th>
                                        <th>OReg No</th>
                                        <th>Title</th>
                                        <th>First Name</th>
                                        <th>Gender</th>
                                        <th>DOB</th>
                                        <th>Father Name</th>
                                        <th>Father Qualification</th>
                                        <th>Father Occupation</th>
                                        <th>Father Contact Number</th>
                                        <th>Mother Name</th>
                                        <th>Mother Qualification</th>
                                        <th>Mother Occupation</th>
                                        <th>Mother Contact Number</th>
                                        <th>Address</th>
                                        <th>Reg. Class</th>
                                        <th>Last Attended School</th>
                                        <th>Last Attended Class</th>
                                        <th>Created By</th>
                                        <th>Updated By</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Reg No</th>
                                        <th>OReg No</th>
                                        <th>Title</th>
                                        <th>First Name</th>
                                        <th>Gender</th>
                                        <th>DOB</th>
                                        <th>Father Name</th>
                                        <th>Father Qualification</th>
                                        <th>Father Occupation</th>
                                        <th>Father Contact Number</th>
                                        <th>Mother Name</th>
                                        <th>Mother Qualification</th>
                                        <th>Mother Occupation</th>
                                        <th>Mother Contact Number</th>
                                        <th>Address</th>
                                        <th>Reg. Class</th>
                                        <th>Last Attended School</th>
                                        <th>Last Attended Class</th>
                                        <th>Created By</th>
                                        <th>Updated By</th>
                                        <th>Action</th>
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
@push('styles')
    {{-- DataTables --}}
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@push('scripts')
    {{-- DataTables  & Plugins --}}
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    {{-- Custom --}}
    <script src="{{ asset('custom.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('table').DataTable({
                dom: 'lBfrtip',
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    ['5 rows', '10 rows', '25 rows', '50 rows', 'Show all']
                ],
                buttons: [
                    'pageLength',
                    'copy',
                    'csv',
                    'excel',
                    'pdfHtml5',
                    'print',
                    {
                        extend: 'colvis',
                        text: "Columns",
                        postfixButtons: ['colvisRestore']
                    }
                ],
                processing: true,
                serverSide: true,
                order: [
                    [0, "desc"]
                ],
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                language: {
                    processing: "<i class='fas fa-2x fa-sync-alt fa-spin'></i>",
                },
                ajax: '{{ route('registration.trashed.index') }}',
                columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'registration_number',
                    name: 'registration_number',
                    visible: false
                }, {
                    data: 'title',
                    name: 'title',
                    visible: false
                }, {
                    data: 'full_name',
                    name: 'full_name'
                }, {
                    data: 'gender',
                    name: 'gender'
                }, {
                    data: 'date_of_birth',
                    name: 'date_of_birth'
                }, {
                    data: 'father_name',
                    name: 'father_name'
                }, {
                    data: 'father_qualification',
                    name: 'father_qualification',
                    visible: false
                }, {
                    data: 'father_occupation',
                    name: 'father_occupation',
                    visible: false
                }, {
                    data: 'father_contact_number',
                    name: 'father_contact_number'
                }, {
                    data: 'mother_name',
                    name: 'mother_name'
                }, {
                    data: 'mother_qualification',
                    name: 'mother_qualification',
                    visible: false
                }, {
                    data: 'mother_occupation',
                    name: 'mother_occupation',
                    visible: false
                }, {
                    data: 'mother_contact_number',
                    name: 'mother_contact_number'
                }, {
                    data: 'address',
                    name: 'address'
                }, {
                    data: 'registration_class',
                    name: 'registration_class'
                }, {
                    data: 'last_attended_school',
                    name: 'last_attended_school'
                }, {
                    data: 'last_attended_class',
                    name: 'last_attended_class'
                }, {
                    data: 'created_by',
                    name: 'created_by',
                    visible: false
                }, {
                    data: 'updated_by',
                    name: 'updated_by',
                    visible: false
                }, {
                    data: 'action',
                    name: 'action'
                },]
            });
            $(".dataTables_filter, .dataTables_paginate").addClass("d-md-inline float-md-right");
            $(".dataTables_info").addClass("d-md-inline float-md-left");
        });
        @can('registration_delete')
        $("table").on('click', 'td .registration-delete', function () {
            var id = $(this).val();
            registrationDelete(id);
        });

        function registrationDelete(id) {
            var token = $("meta[name='csrf-token']").attr("content");
            var table = $("button").closest("table").DataTable();
            $.ajax({
                url: "{{ route('registration.destroy', '') }}" + "/" + id,
                type: 'delete',
                data: {
                    'id=': id,
                    '_token': token,
                },
                success: function (response) {
                    table.cell({focused: true}).row().remove();
                    table.draw();
                },
                error: function (response) {
                    alert('Failed!');
                }
            });
        };
        @endcan()
    </script>

@endpush
