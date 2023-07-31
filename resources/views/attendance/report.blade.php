@extends('master') @section('content')
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
                                <h3 class="card-title">Attendance</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('attendance.index') }}">
                                        <input type="button" value="Attendance" class="btn btn-sm btn-primary">
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            @if ($days ?? '')
                                                @foreach ($days as $day)
                                                    <th>{{ $day }}</th>
                                                @endforeach
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            @if ($days ?? '')
                                                @foreach ($days as $day)
                                                    <th>{{ $day }}</th>
                                                @endforeach
                                            @endif
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
    <script>
        // document.addEventListener('DOMContentLoaded', function () {
        //     let table = new DataTable('table');
        // });
        document.addEventListener("DOMContentLoaded", function(event) {
            $('table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('attendance.report.view') }}'
            });
        });
    </script>
@endsection()
