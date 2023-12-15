<footer class="main-footer no-print">
    {{-- To the right --}}
    <div class="float-right d-none d-sm-inline">
        <b>Version</b> Development
    </div>
    {{-- Default to the left --}}
    <strong>Copyright &copy; 2022-{{ date('Y') }} <a
            href="{{ asset('/') }}">{{ config('app.name') }}</a>.</strong>
    All
    rights reserved.
</footer>
