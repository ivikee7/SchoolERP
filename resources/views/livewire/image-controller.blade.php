<div>
    <x-loading-indicator />
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile Image</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}" wire::navigate>Home</a></li>
                        </li>
                        <li class="breadcrumb-item active">Profile Image</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col col-6">
                <div class="card card-primary">
                    <div class="text-center">
                        <div class="card-header">
                            <h3 class="card-title">{{ $user->first_name }} {{ $user->middle_name }}
                                {{ $user->last_name }} |
                                {{ $user->id }} | Image change
                            </h3>
                        </div>

                        <div class="card-body">
                            @if ($image)
                                <img class="profile-user-img img-fluid img-circle" style="height: 15em; width: 15em;"
                                    src="{{ $image->temporaryUrl() }}" alt="User profile picture">
                            @else
                                <img class="profile-user-img img-fluid img-circle" style="height: 15em; width: 15em;"
                                    @if ($user->media_id != '' && $user->media_id != null && \App\Models\Media::find($user->media_id)->exists()) src="{{ asset('/' . \App\Models\Media::query()->findOrFail($user->media_id)['media_path']) }}" @elseif ($user->gender == 'M') src="{{ asset('/' . 'dist/img/male1.png') }}" @elseif ($user->gender == 'F') src="{{ asset('/' . 'dist/img/female1.png') }}" @elseif ($user->gender == 'O') src="{{ asset('/' . 'dist/img/boxed-bg.jpg') }}" @endif
                                    alt="User profile picture">
                            @endif
                            @error('image')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="card-footer">
                            <form wire:submit.prevent="save({{ $id }})">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input type="file" wire:model.live="image"
                                                class="form-control form-control-file">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="float-right">
                                            <button type="submit" class="btn btn-success">Upload</button>
                                            <button type="reset" wire:click='cancel'
                                                class="btn btn-warning">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endpush
