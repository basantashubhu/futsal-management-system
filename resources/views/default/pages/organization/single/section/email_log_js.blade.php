<script type="text/javascript">
    var datatable = $('.email_log_datatable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/email_log/organization/{{$organization->id}}',
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
            scroll: true,
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
            autoHide: false,
        },

        // columns definition
        columns: [
            {
                field: 'sent_date',
                title: 'Sent Date',
                sortable: 'desc',
                width: 200,
            },
            {
                field: 'sent_status',
                title: 'Status',
                width: 100,
            },
            {
                field: 'action',
                title: 'Action',
                width: 50,
                template: function (row) {
                    return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"' +
                        ' data-modal-route="/viewSingleEmailLog/' + row.id + '">' +
                        '<i class="la la-eye"></i>' +
                        '</button>';
                },
            },]
    });
</script>