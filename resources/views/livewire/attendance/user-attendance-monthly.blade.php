<div>
    <x-loading-indicator />
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attendance Monthly</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}" wire::navigate>Home</a></li>
                        </li>
                        <li class="breadcrumb-item active">Attendance Monthly</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col ">
                <div class="card card-primary">
                    <div class="text-center">
                        {{-- card header --}}
                        <div class="card-header">
                            <h3 class="card-title">
                            </h3>
                        </div>

                        {{-- card body --}}
                        <div class="card-body">
                            <livewire:attendance.user-attendance-monthly />
                        </div>

                        {{-- card footer` --}}
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@push('styles')
@endpush

@push('scripts')
@endpush
