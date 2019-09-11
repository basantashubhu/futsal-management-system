<script type="text/javascript">
    $(document).off('click', '#changeTable').on('click', '#changeTable', function(e){
        var self = $(this);
        if(self.prop('checked')){
            $('#statusChange').text('Done Status Only');
            $('.note_datatable_notDone').hide();
            $('.note_datatable_done').show();
        }else{
            $('.note_datatable_notDone').show();
            $('.note_datatable_done').hide();
            $('#statusChange').text('Not Done Status Only');
        }
    });
    var datatable = $('.note_datatable_done').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/notes/orgAll/{{$organization->id}}/done',
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
                field: 'start',
                title: 'Date',
                sortable: 'desc',
                width:70,
                template:function (row) {
                    return moment( row.start).format(std.config.date_format);
                }
            },
            {
                field: 'activity',
                title: 'Activity',
                sortable: false,
                width: 60,
            },
            {
                field: 'notes',
                title: 'Description',
                width: 200,
            },
            {
                field: 'action',
                title: 'Action',
                width: 50,
                template: function (row) {
                    return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"' +
                        ' data-modal-route="/note/edit/' + row.id + '">' +
                        '<i class="la la-eye"></i>' +
                        '</button>';
                },
            }
        ]
    });
    var datatable1 = $('#notDone_status').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/note/orgAll/{{$organization->id}}/notDone',
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
                field: 'start',
                title: 'Date',
                sortable: 'desc',
                width:68,
                template:function (row) {
                    return moment( row.start).format(std.config.date_format);
                }
            },
            {
                field: 'activity',
                title: 'Activity',
                width: 60,
            },
            {
                field: 'notes',
                title: 'Description',
                width: 200,
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