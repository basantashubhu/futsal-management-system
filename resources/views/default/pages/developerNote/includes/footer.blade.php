<script type="text/javascript">
    $('#developerNoteStatusFilter').selectpicker();
    var datatable = $('#developernoteTable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/developernote/getAll',
                    method: 'GET'
                },
            },
            pageSize: 50,
            saveState: false,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
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
            autoHide: true,
        },

        // columns definition
        columns: [
            {field: 'created_at', title: 'Date', width: 100, template: ({created_at}) => moment(created_at).format(std.config.date_format)},
            {field: 'page', title: 'Page', width: 200},
            {field: 'creatorname', title: 'Assigned by'},
            {field: 'is_done', title: 'Status', template: ({is_done}) => is_done ? 'Done' : 'Pending'},
            {field: 'reciever', title: 'Picked up by',},
            {field: 'action', title: 'Action', sortable: false, width: 120,
                template: function (row) {
                    if(row.is_done){
                        return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" ' +
                            'data-undone-route="/developernote/undone/' + row.id + '" title="Undone">' +
                            '<i class="la la-remove"></i>' +
                            '</button>';
                    }
                    return `
                        <button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
                        data-modal-route="/developer-note/edit/${row.id}"><i class="la la-edit"></i></button> &nbsp;
                        <button class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill"
                        data-modal-route="/developer-note/addClient/${row.id}">
                        <i class="la la-user-plus"></i></button>
                        <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"
                        data-delete-modal="/developer-note/delete/${row.id}">
                        <i class="la la-trash"></i></button>`
                },
            },
            {
                field: 'text',
                title: 'Text',
                width: 1000
            }
        ]
    });
    $('#developerNoteStatusFilter').on('change', function () {
        datatable.search($(this).val(), 'status');
    });

    $(document).off('click', '.developernote-exporter').on('click', '.developernote-exporter', function (e) {
        var exporttype = $(this).attr('data-export-type');
        var url = 'developernote/export/' + exporttype+'?';
        var data = $('#developerQuickSearch').serialize();
        window.open(url+data);
    });

    $(document).off('click', '[data-undone-route]').on('click', '[data-undone-route]', function () {
        const self = $(this);
        const undoneCallback = function() {
            toastr.success('Developer note marked undone successfully.');
            reloadDatatable('#developernoteTable');
        }
        confirmAction({
            btn: 'btn-danger', action: 'Undone',
            message: 'Undone developer note?',
            ajax: {
                url: self.attr('data-undone-route'), method: 'post',
                success: undoneCallback
            }
        });
    });

    $(document).off('click', '[data-delete-modal]').on('click', '[data-delete-modal]', function () {
        const self = $(this);
        const deleteCallback = function() {
            toastr.success('Developer note deleted successfully.');
            reloadDatatable('#developernoteTable');
        }
        confirmAction({
            btn: 'btn-danger', action: 'Delete',
            message: 'Are you sure you want to delete developer note?',
            ajax: {
                url: self.attr('data-delete-modal'), method: 'post',
                success: deleteCallback
            }
        });
    });
</script>