@extends('master')
@section('title', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' | Home')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if ($videos)
                            @foreach ($videos as $video)
                                <div class="card">
                                    <div class="card-header">{!! $video->name !!}</div>
                                    <div class="card-body">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" {!! $video->link !!}
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
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
@endpush
@push('scripts')
@endpush
