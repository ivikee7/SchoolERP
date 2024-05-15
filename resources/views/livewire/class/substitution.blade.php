<div>
    <x-loading-indicator />
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Substitutions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Substitutions</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sticky-top mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Draggable Events</h4>
                            </div>
                            {{-- @dd($teachers) --}}
                            <div class="card-body p-1">
                                @foreach ($teachers as $teacher)
                                    <div class="user-block border border-light m-1 p-1 rounded">
                                        <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Image">
                                        <span class="username"><a href="#">{{ $teacher->first_name }}
                                                {{ $teacher->middle_name }} {{ $teacher->last_name }}
                                                ({{ $teacher->name }})
                                            </a></span>
                                        <span class="description">Shared publicly - 7:30 PM Today</span>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <form wire:submit='save'>
                            <div class="card-body">
                                @foreach ($classes as $class)
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ $class->name }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Time</th>
                                                            @foreach ($sections as $section)
                                                                <th scope="col">{{ $section->name }}</th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for ($i = 1; $i <= $periods; $i++)
                                                            <tr>
                                                                <td scope="row">{{ $i }}</td>
                                                                <th scope="col">
                                                                    <input
                                                                        wire:model.live='input.{{ $class->name }}.{{ $section->name }}.{{ $i }}.time_start'
                                                                        type="time" class="form-control">
                                                                    <input
                                                                        wire:model.live='input.{{ $class->name }}.{{ $section->name }}.{{ $i }}.time_end'
                                                                        type="time" class="form-control mt-1">
                                                                </th>
                                                                @foreach ($sections as $section)
                                                                    <td scope="col">
                                                                        <input
                                                                            wire:model.live='input.{{ $class->name }}.{{ $section->name }}.{{ $i }}.teacher_primary'
                                                                            type="text" class="form-control">
                                                                        <input
                                                                            wire:model.live='input.{{ $class->name }}.{{ $section->name }}.{{ $i }}.teacher_secondary'
                                                                            type="text" class="form-control mt-1">
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- / card body --}}
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                            </div>
                            {{-- / card-footer --}}
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

@push('styles')
@endpush
@push('scripts')
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endpush
