<div class="m-portlet m-portlet--mobile m-t-10">
    <div class="m-portlet__body">
        <div class="user_activity" id="user_activity"></div>
    </div>
</div>
<script>
    var userActivity = $('.note_datatable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/note/getUserAll',
                    method: 'GET'
                },
            },
            pageSize: 10,
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
                field: 'end',
                title: 'Date',
                sortable: 'desc',
                width: 100,
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
                width: 50,
                template: function (row) {
                    return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"' +
                            ' data-modal-route="/note/view/' + row.id + '">' +
                            '<i class="la la-eye"></i>' +
                            '</button>';
                },
            },]
    });
</script>