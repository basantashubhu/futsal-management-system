<script type="text/javascript">

    var DatatableAutoColumnHideDemo = function () {
        //== Private functions
        // basic demo
        var demo = function () {
            var datatable = $('.rate_type_datatable').mDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '/rate_type/all',
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
                        field: 'rate_metrics_type',
                        title: 'Rate Metrics Type',
                        sortable: false
                    },
                    {
                        field: 'rate_metrics',
                        title: 'Rate Metrics',
                        sortable: false
                    },
                    {
                        field: 'rate_unit',
                        title: 'Rate Unit',
                        sortable: false
                    },
                    {
                        field: 'action',
                        title: 'Action',
                        template: function (row) {
                            return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/rate_type/edit/' + row.id + '")>\
                                    <i class="la la-edit"></i></button> &nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/rate_type/delete/' + row.id + '">\
                                    <i class="la la-trash"></i></button>';
                        },
                    },
                ]
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