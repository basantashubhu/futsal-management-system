
function pageLoaded() {
    // return;
    var DatatableAutoColumnHideDemo = function () {
        // basic demo
        var demo = function () {
            var datatable = $('#auto_column_hide').mDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '/pages/all',
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
                    autoHide: false,
                },

                // columns definition
                columns: [
                    {
                        field: 'page_name',
                        title: 'Page',
                        sortable: 'asc'
                    }, {
                        field: 'action',
                        title: 'Action',

                    }, {
                        field: 'a',
                        title: 'Action',
                        sortable: false,
                        template: function (row) {
                            return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route=/pages/edit/' + row.id + '">\
                                    <i class="la la-edit"></i></button> &nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-title="Delete Pages" data-modal-type="delete" data-modal-route=/pages/delete/' + row.id + '">\
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

    DatatableAutoColumnHideDemo.init();
}
