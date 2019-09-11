<script type="text/javascript">

    var rolePermission = function () {
        //== Private functions

        // basic demo
        var demo = function () {

            var datatable = $('.m_datatable').mDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '/rolePermission/all',
                            method: 'GET'
                        },
                    },
                    // pageSize: 10,
                    saveState: false,
                    // serverPaging: true,
                    serverFiltering: true,
                    serverSorting: true,
                },

                // column sorting
                sortable: true,

                pagination: false,

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
                        field: 'name',
                        title: 'Role',
                        sortable: 'asc',
                        width:'150'

                    },{
                        field: 'a',
                        title: 'Action',
                        width:'150',
                        template: function (row) {
                            return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route=/rolePermission/edit/' + row.id + '>\
                                    <i class="la la-eye"></i></button> &nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route=/rolePermission/delete/' + row.id + '>\
                                    <i class="la la-trash"></i></button>';
                        },
                    },]
            });

        };

        return {
            // public functions
            init: function () {
                demo();
            },
        };
    }();

    jQuery(document).ready(function () {
        rolePermission.init();
    });
</script>