<script type="text/javascript">
    var ClientDatatable = $('.client_api_database').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: 'client/api/all',
                    method: 'GET'
                },
            },
            pageSize: 20,
            saveState: false,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,

        },
        layout: {
            scroll: false,
            smoothScroll: {
                scrollbarShown: false
            }
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
            // auto hide columns, if rows overflow
            autoHide: false,
        },
        // columns definition
        columns: [
            {
                field: 'created_at',
                title: 'Date',
                width: 80,
                sortable: 'desc',
                template: function (row) {
                    return moment(row.created_at).format(std.config.date_format);
                }
            },
            {
                field: 'client',
                title: 'Client',
                width: 70
            },
            {
                field: 'name',
                title: 'Key Name',
                width: 90
            },

            {
                field: 'redirect',
                title: 'Redirect Url',
                width: 150
            },
            {
                field: 'id',
                title: 'Client Id',
                width: 75,
            },

            {
                field: 'action',
                title: 'Action',
                template: function (row) {
                    return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/clientapi/edit/' + row.id + '">\
                                    <i class="la la-edit"></i></button> &nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/clientapi/revoke/' + row.id + '">\
                                    <i class="la la-trash"></i></button>';
                },
            },]
    });

    $('#ApiClientName').on('blur', function (e) {
        ClientDatatable.search($(this).val(), 'cname');
    });
    $('#APIidFilter').on('blur', function (e) {
        ClientDatatable.search($(this).val(), 'AID');
    });
    $('#ApiKeyName').on('blur', function (e) {
        ClientDatatable.search($(this).val(), 'kname');
    });
    $('#ApiRedirectName').on('blur', function (e) {
        ClientDatatable.search($(this).val(), 'rurl');
    });
</script>