import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'vendor/almasaeed2010/adminlte/plugins/fontawesome-free/css/all.css',
                'vendor/almasaeed2010/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
                'vendor/almasaeed2010/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
                'vendor/almasaeed2010/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
                'vendor/almasaeed2010/adminlte/plugins/toastr/toastr.min.css',
                'vendor/almasaeed2010/adminlte/plugins/select2/css/select2.min.css',
                'vendor/almasaeed2010/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                'vendor/almasaeed2010/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
                'vendor/almasaeed2010/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
                'vendor/almasaeed2010/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
                'vendor/almasaeed2010/adminlte/dist/css/adminlte.min.css',
                // default css
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
