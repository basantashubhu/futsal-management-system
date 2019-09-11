<script type="text/javascript">
    var datatable = $('.note_datatable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/note/getAll',
                    method: 'GET'
                },
            },
            pageSize: 50,
            saveState: false,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,

        },
        layout: {
            theme: 'default',
            class: '',
            scroll: false,
            height: 550,
            footer: false
        },

        // column sorting
        sortable: true,

        pagination: true,

        toolbar: {
            // toolbar items
            items: {
                // pagination
                pagination: {
                    // page size select
                    pageSizeSelect: [10, 20, 30, 50, 100],
                },
            },
        },

        search: {
            input: $('#generalSearch'),
        },

        rows: {
            autoHide: true,
        },

        // columns definition
        columns: [
            {
                field: 'start',
                title: 'Date',
                sortable: 'desc',
                width: 100,
                template:function (row) {
                    return moment(row.start).format(std.config.date_format)
                }
            },
            {
                field: 'segment',
                title: 'Segment',
                sortable: false,
                width: 80,
            },
            {
                field: 'activity',
                title: 'Activity',
                sortable: false,
                width: 80,
            },
            {
                field: 'notes',
                title: 'Description',
            },
            {
                field: 'action',
                title: 'Action',
                width: 100,
                template: function (row) {
                    return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"' +
                        ' data-modal-route="/note/edit/' + row.id + '">' +
                        '<i class="la la-eye"></i>' +
                        '</button><button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"' +
                        ' data-modal-route="/note/edit/' + row.id + '">' +
                        '<i class="la la-edit"></i>' +
                        '</button><button class="m-portlet__nav-link btn m-btn m-btn-danger m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"' +
                        ' data-modal-route="/note/delete/' + row.id + '">' +
                        '<i class="la la-trash"></i>' +
                        '</button>';
                },
            },]
    });
    $('#TableName').off('blur').on('blur', function (e) {
        datatable.search($(this).val(), 'tablename');
    });
    $('#TableId').off('blur').on('blur', function (e) {
        datatable.search($(this).val(), 'tableid');
    });

    $('#notes-todo').load('/notes/todo/today');

    // const ctx = $(document.getElementById("doughnutChartNote")).empty();
    // new Chart(ctx, {
    //     "type": "doughnut",
    //     "data": {
    //         "labels": ["Open", "On Process", "Closed"],
    //         "datasets": [{
    //             "data": [{{ $total_notes - $on_process_notes - $completed_notes }}, {{ $on_process_notes }}, {{ $completed_notes }}],
    //             "backgroundColor": ["#00c5dc", "#ffb822", "rgb(255, 99, 132)"]
    //         }]
    //     },
    //     "options": {
    //         "legend": {
    //             "position": "right"
    //         }
    //     }
    // });
</script>