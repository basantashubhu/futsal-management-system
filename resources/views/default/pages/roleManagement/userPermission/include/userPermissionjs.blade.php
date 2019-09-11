<script type="text/javascript">

    var userPermission = function () {
        //== Private functions

        // basic demo
        var demo = function () {

            var datatable = $('.m_datatable').mDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '/userPermission/all',
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
                        title: 'User',
                        sortable: 'asc'

                    }, 
                    {field: 'role', title : 'Role'},
                    {
                        field: 'action',
                        title: 'Permission',
                        overflow: 'hidden',
                        template:function (row) {
                            var data = row.permission_name.split(',');
                            var action="";
                            for(var value of data)
                            {
                                action+='<span class="m-badge  m-badge--success m-badge--wide m-1 text-capitalize">'+ value +'</span> ';
                            }
                            return action;
                        },
                    },{
                        field: 'a',
                        title: 'Action',
                        template: function (row) {
                            return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route=/userPermission/edit/' + row.id + '>\
                                    <i class="la la-edit"></i></button> &nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route=/userPermission/delete/' + row.id + '>\
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
        userPermission.init();
    });
</script>