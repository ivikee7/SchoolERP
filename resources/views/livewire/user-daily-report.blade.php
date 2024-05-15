<div>
    <x-loading-indicator />
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Daily
                        Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}" wire::navigate>Home</a></li>
                        </li>
                        <li class="breadcrumb-item active">User Daily
                            Report</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row mb-2">
                        <div class="col col-sm-6">
                            <div class="btn-group mb-2">
                                <button class="btn btn-secondary">Excel</button>
                                <button class="btn btn-secondary">CSV</button>
                                <button class="btn btn-secondary">Copy</button>
                                <button class="btn btn-secondary">Print</button>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <div class="float-right">
                                <div class="btn-group">
                                    <button class="btn btn-warning" type="button" data-toggle="collapse"
                                        data-target="#collapseInputReportType" aria-expanded="false"
                                        aria-controls="collapseInputReportType">
                                        <i class="fas fa-plus-circle"></i> Add New
                                        Report Type
                                    </button>
                                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                                        data-target="#collapseInputReport" aria-expanded="false"
                                        aria-controls="collapseInputReport">
                                        <i class="fas fa-plus-circle"></i> Add New
                                        Report
                                    </button>
                                    {{-- <button type="button" class="btn btn-default">All <span
                                            class="right badge badge-info">{{ $count_all }}</span>
                                    </button>
                                    <button type="button" class="btn btn-default"> Schedule <span
                                            class="right badge badge-primary">{{ $count_schedule }}</span>
                                    </button>
                                    <button type="button" class="btn btn-default"> Closed <span
                                            class="right badge badge-success">{{ $count_closed }}</span>
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="collapseInputReport">
                        <div class="card">
                            <form wire:submit="userReportStore" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 mt-2">
                                            <label for="" class="ml-1 mr-1">Job Description @if (!empty($job_description_characters_count))
                                                    <span
                                                        class="@if ($job_description_characters_count <= 255) text-danger @else text-success @endif"></span>
                                                    ({{ $job_description_characters_count }})
                                                @endif
                                            </label>
                                            <textarea wire:model.live="job_description" type="text"
                                                class="form-control @error('job_description') border border-danger @enderror " name="job_description" rows="7"
                                                value="{{ old('job_description') }}" minlength="1" maxlength="255" placeholder="Job Description" @required(true)></textarea>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="col-sm-12 mt-2">
                                                <label for="" class="ml-1 mr-1">Report Type</label>
                                                <select wire:model.live="user_report_type_id" id=""
                                                    class="form-control @error('user_report_type_name') border border-danger @enderror"
                                                    @required(true)>
                                                    <option value="" selected>Report Type</option>
                                                    @if ($user_report_types ?? '')
                                                        @foreach ($user_report_types as $user_report_type)
                                                            <option value="{{ $user_report_type->user_report_type_id }}"
                                                                @if (old('user_report_type_id') == $user_report_type->id) selected @endif>
                                                                {{ $user_report_type->user_report_type_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-sm-12 mt-2">
                                                <label for="" class="ml-1 mr-1">Start Time</label>
                                                <input wire:model.live="start_time" type="datetime-local"
                                                    class="form-control @error('start_time') border border-danger @enderror "
                                                    name="start_time" value="{{ old('start_time') }}"
                                                    placeholder="Start Time" @required(true)>
                                            </div>
                                            <div class="col-sm-12 mt-2">
                                                <label for="" class="ml-1 mr-1">End Time</label>
                                                <input wire:model.live="end_time" type="datetime-local"
                                                    class="form-control @error('end_time') border border-danger @enderror "
                                                    name="end_time" value="{{ old('end_time') }}" placeholder="End Time"
                                                    @required(true)>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="collapse" id="collapseInputReportType">
                        <div class="card">
                            <form wire:submit="reportTypeStore" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 mt-2">
                                            <label for="" class="ml-1 mr-1">User Report Type Name</label>
                                            <input wire:model.live="user_report_type_name" type="text"
                                                class="form-control @error('user_report_type_name') border border-danger @enderror "
                                                name="user_report_type_name" rows="4"
                                                value="{{ old('user_report_type_name') }}" minlength="1"
                                                maxlength="50" placeholder="Report Type Name"
                                                @required(true)></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                            </div>
                            <div class="table-responsive">
                                <table class="table display mb-0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Total Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display: table-row-group;">
                                        <tr>
                                            <th>
                                                <input type="text" wire:model.live='search.id'
                                                    class="form-control" placeholder="Id">
                                            </th>
                                            <th>
                                                <input type="text" wire:model.live='search.name'
                                                    class="form-control" placeholder="Name">
                                            </th>
                                            <th>
                                                <select wire:model.live='search.user_role_name' id=""
                                                    class="form-control @error('user_role_name') border border-danger @enderror"
                                                    @required(true)>
                                                    <option value="" selected>Role</option>
                                                    @if ($user_roles ?? '')
                                                        @foreach ($user_roles as $user_role)
                                                            <option value="{{ $user_role->id }}"
                                                                @if (old('user_role_name') == $user_role->name) selected @endif>
                                                                {{ $user_role->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </th>
                                            <th>
                                                <div class="col">
                                                    <select wire:model.live='search.report_type_id' id=""
                                                        class="form-control @error('user_report_type_name') border border-danger @enderror"
                                                        @required(true)>
                                                        <option value="" selected>Report Type</option>
                                                        @if ($user_report_types ?? '')
                                                            @foreach ($user_report_types as $user_report_type)
                                                                <option
                                                                    value="{{ $user_report_type->user_report_type_id }}"
                                                                    @if (old('user_report_type_id') == $user_report_type->id) selected @endif>
                                                                    {{ $user_report_type->user_report_type_name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </th>
                                            <th><input type="text" wire:model.live='search.job_description'
                                                    class="form-control" placeholder="Job Description"></th>
                                            <th colspan="3">
                                                <div class="form-group row">
                                                    <label for="inputStartDateFrom"
                                                        class="col-2 col-form-label text-nowrap">Start</label>
                                                    <div class="col-10">
                                                        <input type="datetime-local"
                                                            wire:model.live='search.start_date.from'
                                                            class="form-control" placeholder="Start Date"
                                                            id="inputStartDateFrom">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputStartDateTo"
                                                        class="col-2 col-form-label text-nowrap">To</label>
                                                    <div class="col-10">
                                                        <input type="datetime-local"
                                                            wire:model.live='search.start_date.to'
                                                            class="form-control mt-1" placeholder="Start Date"
                                                            id="inputStartDateTo">
                                                    </div>
                                                </div>
                                            </th>
                                            <td>
                                                <button wire:click="searchReset" type="button"
                                                    class="btn btn-default">Reset</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($userDailyReports as $key => $userDailyReport)
                                            <tr>
                                                <td>{{ $userDailyReport->user_daily_report_user_id }}</td>
                                                <td>{{ $this->user($userDailyReport->user_daily_report_user_id) }}
                                                </td>
                                                <td>{{ $this->userRoleName($userDailyReport->user_daily_report_user_id) }}
                                                </td>
                                                <td>{{ $this->userReportTypeName($userDailyReport->user_daily_report_user_report_type_id) }}
                                                </td>
                                                <td>{{ $userDailyReport->user_daily_report_job_description }}</td>
                                                <td>{{ $userDailyReport->user_daily_report_start_time }}</td>
                                                <td>{{ $userDailyReport->user_daily_report_end_time }}</td>
                                                <td>{{ $userDailyReport->user_daily_report_total_time }}</td>
                                                <td>
                                                    <div class="btn-group mb-2">
                                                        <button
                                                            wire:click='deleteUserDailyReport("{{ $userDailyReport->user_daily_report_id }}")'
                                                            type="button" class="btn btn-warning btn-sm"
                                                            name="deleteUserDailyReport"
                                                            class="btn btn-warning">Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    Showing
                                    {{ $userDailyReports->perPage() * ($userDailyReports->currentPage() - 1) + 1 }} to
                                    {{ $userDailyReports->perPage() * $userDailyReports->currentPage() }} of
                                    {{ $userDailyReports->total() }}
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="d-flex flex-row-reverse">
                                        @if (count($userDailyReports))
                                            {{ $userDailyReports->links() }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

@push('styles')
@endpush

@push('scripts')
    <script>
        $('#reservation').daterangepicker()
    </script>
@endpush
