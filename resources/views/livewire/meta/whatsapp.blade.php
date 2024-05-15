<div>
    <x-loading-indicator />
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Appointment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}" wire::navigate>Home</a></li>
                        </li>
                        <li class="breadcrumb-item active">Appointment</li>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modal-create-appointment"><i class="fas fa-plus-circle"></i> Add
                                New
                                Appointment</button>
                        </div>
                        <div class="col col-sm-6">
                            <div class="float-right">
                                <div class="btn-group">
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
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table display mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Whatsapp Number</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($appointments as $key => $appointment)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $appointment->appointment_name }}</td>
                                                <td>{{ $appointment->appointment_clint_name }}</td>
                                                <td>{{ $appointment->appointment_status }}</td>
                                                <td>Action</td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
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

    {{-- Create Model --}}
    <div class="modal fade" id="modal-create-appointment" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit="whatsappMessageSend">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">New Appointment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-2">
                                <label for="" class="ml-1 mr-1">Type</label>
                                <select wire:model.live="type" @required(true) id=""
                                    class="form-control @error('type') border border-danger @enderror">
                                    <option value="" @selected(true)>Select</option>
                                    <option value="template" @if (old('type') == 'template') selected @endif>Template
                                    </option>
                                    <option value="text" @if (old('type') == 'text') selected @endif>
                                        Text</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <label for="" class="ml-1 mr-1">Template</label>
                                <select wire:model.live="template" @required(true) id=""
                                    class="form-control @error('template') border border-danger @enderror">
                                    <option value="" @selected(true)>Select</option>
                                    <option value="hello_world" @if (old('template') == 'hello_world') selected @endif>
                                        hello_world
                                    </option>
                                    <option value="join_our_community_page"
                                        @if (old('template') == 'join_our_community_page') selected @endif>
                                        join_our_community_page</option>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="" class="ml-1 mr-1">Whatsapp Numbers</label>
                                    <textarea wire:model.live="whatsapp_numbers" class="form-control" rows="3" placeholder="Number ..."></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="" class="ml-1 mr-1">Whatsapp Message</label>
                                    <textarea wire:model.live="whatsapp_message" textarea[] class="form-control" rows="3" placeholder="Message ..."></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.content-wrapper -->

@push('styles')
@endpush

@push('scripts')
@endpush
