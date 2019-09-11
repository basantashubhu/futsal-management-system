<script type="text/javascript">


    var DatatableAutoColumnHideDemo = function () {
        //== Private functions

        // basic demo
        var demo = function () {

            var datatable = $('.m_datatable').mDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '/user/settings/all',
                            method: 'GET'
                        },
                    },
                    pageSize: 10,
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
                    {
                        field: 'name',
                        title: 'Name',
                        sortable: 'asc'
                    },
                    {
                        field: 'code',
                        title: 'Code',

                    },
                    {
                        field: 'type',
                        title: 'Type',

                    },
                    {
                        field: 'value',
                        title: 'Value',

                    },
                    {
                        field: 'is_true',
                        title: 'Status',
                        template: function (row) {
                            if (row.is_true) {
                                return 'true'.ucfirst();
                            }
                            else {
                                return 'false'.ucfirst();
                            }
                        }

                    },
                    {
                        field: 'user',
                        title: 'User',
                        template: function (row) {
                            return row.user.name;
                        }

                    },
                    {
                        field: 'action',
                        title: 'Action',
                        sortable: false,
                        template: function (row) {

                            return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/user/settings/' + row.id + '/edit">\
                                    <i class="la la-edit"></i></button> &nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/settings/delete/'+row.id+'">\
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
        DatatableAutoColumnHideDemo.init();
    });
</script>