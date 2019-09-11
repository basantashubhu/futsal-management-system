<script type="text/javascript">
    var DatatableAutoColumnHideDemo = function () {
        //== Private functions
        // basic demo
        var demo = function () {
            var datatable = $('.treatment_datatable').mDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '/treatment/all',
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
                        field: 'treatment_name',
                        title: 'Procedure Name',
                        sortable: 'asc',
                        width: 200
                    },
                    {
                        field: 'treatment_type',
                        title: 'Procedure Type',
                        sortable: false,
                        template: function(row) {
                            return row.treatment_type.ucfirst();
                        }
                    },
                    {
                        field: 'is_must',
                        title: 'Is Must',
                        template: function(row){
                            if(row.is_must){
                                return '<button class="btn btn-sm m-btn--pill btn-success c-p">Yes</button>';
                            }
                            else{
                                return '<button class="btn btn-sm m-btn--pill btn-warning m-badge--wide c-p">No</button>';
                            }
                        }
                    },
                    {
                        field: 'action',
                        title: 'Action',
                        template: function (row) {
                            return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/viewTreatment/' + row.id + '")>\
                                    <i class="la la-eye"></i></button> &nbsp;\
                            <button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/editTreatment/' + row.id + '")>\
                                    <i class="la la-edit"></i></button> &nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/treatment/delete/' + row.id + '">\
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