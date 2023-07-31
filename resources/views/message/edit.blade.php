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
                                <h3 class="card-title">Message Ediit</h3>
                                <div class="card-title float-right">
                                    <a href="{{ route('message.index') }}">
                                        <input type="button" value="View Messages" class="btn btn-sm btn-primary">
                                    </a>
                                    <a href="{{ route('message.create') }}">
                                        <input type="button" value="Create" class="btn btn-sm btn-primary">
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('message.update', $message->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="card">
                                        <div class="card-body">
                                            <textarea name="message" class="summernote @error('first_name') border border-danger @enderror">{{ $message->message }}</textarea>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="save" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </form>
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
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endpush
@push('scripts')
    {{-- Summernote  & Plugins --}}
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            // Summernote
            $('.summernote').summernote({
                // toolbar: [
                //     // [groupName, [list of button]]
                //     ['style', ['bold', 'italic', 'underline', 'clear']],
                //     ['font', ['strikethrough', 'superscript', 'subscript']],
                //     ['fontsize', ['fontsize']],
                //     ['color', ['color']],
                //     ['para', ['ul', 'ol', 'paragraph']],
                //     ['height', ['height']]
                // ]
            });
        })
    </script>
@endpush
