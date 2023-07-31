$(document).ready(function () {
    // Datatables Featured
    // $('.datatable').DataTable({
    //     dom: 'lBfrtip',
    //     lengthMenu: [
    //         [10, 25, 50, -1],
    //         ['10 rows', '25 rows', '50 rows', 'Show all']
    //     ],
    //     buttons: [
    //         'pageLength',
    //         'copy',
    //         'csv',
    //         'excel',
    //         {
    //             extend: 'pdfHtml5',
    //             orientation: 'landscape',
    //             pageSize: 'LEGAL',
    //         },
    //         {
    //             extend: 'print',
    //             orientation: 'landscape',
    //             pageSize: 'LEGAL',
    //         },
    //         'colvis',
    //     ],
    //     language: {
    //         processing: "<i class='fas fa-2x fa-sync-alt fa-spin'></i>",
    //     },
    //     responsive: true, lengthChange: false, autoWidth: false,
    // });

    // $(".dataTables_filter, .dataTables_paginate").addClass("d-md-inline float-md-right");
    // $(".dataTables_info").addClass("d-md-inline float-md-left");
});

$(document).ready(function () {
    $(document).on('click', '.btn-mark-attendance', function (e) {
        e.preventDefault();
        var el = $(this);
        var id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "attendance",
            method: 'post',
            dataType: 'json',
            data: 'id=' + id,
            success: function (response) {
                var date = new Date($.parseJSON(JSON.stringify(response)).datetime);
                var time = (date.getHours() + ':' + date.getMinutes());
                // alert('Success!: ' + time);
                el.parent().html(time);
                el.remove();
            },
            error: function (response) {
                alert('Failed!');
            }
        });
    });
});
