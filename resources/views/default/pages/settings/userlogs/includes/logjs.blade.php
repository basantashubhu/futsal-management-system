<script type="text/javascript">
    loadCookie('user_logs', '#searchUsersLogForm');
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
                            url: '/userlogs/all',
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
                    {
                        field: 'user',
                        title: 'User',
                        sortable:false,
                        template: function (row) {
                            return row.name;
                        }

                    },


                    {
                        field: 'fingerprint',
                        title: 'Fingerprint',

                    },
                    {
                        field: 'browser',
                        title: 'Browser',

                    },

                    {
                        field: 'os',
                        title: 'Os',

                    },
                    {
                        field: 'location',
                        title: 'Location'

                    },
                    {
                        field: 'login_timestamp',
                        title: 'Login At',
                        sortable:'desc'
                    },
                    {
                        field: 'last_call_timestamp',
                        title: 'Last Ping At',
                    },
                    {
                        field: 'action',
                        title: 'Action',
                        sortable: false,
                        template: function (row) {
                            if (row.is_active )
                                if (row.user != 'dsc'){
                                    return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/userlogs/remove/' + row.userid + '" title="Log off">\
                                    <i class="flaticon-logout"></i></button>'+
                                        '<button class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/userlogs/lock/' + row.userid + '" title="Lock off">\
                                    <i class="flaticon-lock-1"></i></button>';
                                }else {
                                    return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/userlogs/remove/' + row.userid + '" title="Log off">\
                                    <i class="flaticon-logout"></i></button>';
                                }
                        },
                    },]
            });

            $(document).off('input','#UserName').on('input','#UserName',function (e) {
                e.preventDefault();
                // $('#usersLogs').find('input[name!="name"]').val('');
                var val = $(this).val();
                if(val.length >= 3){
                    var data = [{name: 'name', value: $(this).val()}];
                    setCookie('user_logs', JSON.stringify(data));
                    datatable.search($(this).val(),'name');
                }
                if(val.length == 0){
                    deleteCookie('user_logs');
                    reloadDatatable('.m_datatable');
                }
            });
            $(document).off('input','#LogOs').on('input','#LogOs',function (e) {
                e.preventDefault();
                // $('#usersLogs').find('input[name!="os"]').val('');
                var val = $(this).val();
                if(val.length >= 3){
                    var data = [{name: 'os', value: $(this).val()}];
                    setCookie('user_logs', JSON.stringify(data));
                    datatable.search($(this).val(),'os');
                }
                if(val.length == 0){
                    deleteCookie('user_logs');
                    reloadDatatable('.m_datatable');
                }
            });
            $(document).off('input','#LogFingerprint').on('input','#LogFingerprint',function (e) {
                e.preventDefault();
                // $('#usersLogs').find('input[name!="fingerprint"]').val('');
                var val = $(this).val();
                if(val.length >= 3){
                    var data = [{name: 'fingerprint', value: $(this).val()}];
                    setCookie('user_logs', JSON.stringify(data));
                    datatable.search($(this).val(),'fingerprint');
                }
                if(val.length == 0){
                    deleteCookie('user_logs');
                    reloadDatatable('.m_datatable');
                }
            });
            $(document).off('input','#LogBrowser').on('input','#LogBrowser',function (e) {
                e.preventDefault();
                // $('#usersLogs').find('input[name!="browser"]').val('');
                var val = $(this).val();
                if(val.length >= 3){
                    var data = [{name: 'browser', value: $(this).val()}];
                    setCookie('user_logs', JSON.stringify(data));
                    datatable.search($(this).val(),'browser');
                }
                if(val.length == 0){
                    deleteCookie('user_logs');
                    reloadDatatable('.m_datatable');
                }
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