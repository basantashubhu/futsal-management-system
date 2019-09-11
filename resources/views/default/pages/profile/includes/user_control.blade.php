<div class="tab-pane" id="user_control">
	<div class="m-portlet__body">
            <!--begin: Datatable -->
            <div class="m_datatable" id="auto_column_hide"></div>
            <!--end: Datatable -->
    </div>
</div>
<script type="text/javascript">
    loadCookie('users', '#searchUsersForm');
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
                            url: '/user/all',
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
                        field: 'name',
                        title: 'User',
                        sortable: 'asc'
                    }, {
                        field: 'full_name',
                        title: 'Name',
                        sortable: 'asc'
                    },{
                        field: 'email',
                        title: 'Email',
                        template: function(row)
                        {
                            return'<span style="text-transform: lowercase !important;">'+row.email+'</span>';
                        }
                    }, {
                        field: 'role_name',
                        title: 'Role',
                    }, {
                        field: 'rpt_mgrs',
                        title: 'Reporting manager',
                    },
                    {
                        field: 'is_locked',
                        title: 'Locked',
                        template: function (row) {
                            return row.is_locked ? 'Yes' : 'No';
                        },

                    },
                    {
                        field: 'action',
                        title: 'Action',
                        sortable: false,
                        template: function (row) {
                            if (row.id != 1) {

                                var btn = '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-route="userProfile/' + row.id + '">\
                                    <i class="la la-eye"></i></button>\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/user/edit/' + row.id + '">\
                                    <i class="la la-edit"></i></button>\
                                        <button class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/user/changePassword/' + row.id + '" title="Change Password">\
                                    <i class="la la-key"></i></button>\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/user/delete/' + row.id + '">\
                                    <i class="la la-trash"></i></button>';

                                if (row.is_locked) {
                                    btn += '<button class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/userlogs/unlock/' + row.id + '" title="Unlock">\
                                    <i class="fa fa-unlock"></i></button>';
                                }
                                else {
                                    btn += '<button class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/userlogs/lock/' + row.id + '" title="Lock off">\
                                    <i class="flaticon-lock-1"></i></button>';
                                }
                                return btn;
                            }
                        },
                    },]
            });

            $(document).off('input','#UserName').on('input','#UserName',function (e) {
                $('#usersControll').find('input[name!="name"]').val('');
                var val = $(this).val();
                if(val.length >= 3){
                    var data = [{name: 'name', value: $(this).val()}];
                    setCookie('users', JSON.stringify(data));
                    datatable.search($(this).val(),'name');
                }
                if(val.length == 0){
                    deleteCookie('users');
                    reloadDatatable('.m_datatable');
                }
            });
            $(document).off('input','#UserEmail').on('input','#UserEmail',function (e) {
                $('#usersControll').find('input[name!="email"]').val('');
                var val = $(this).val();
                if(val.length >= 3){
                    var data = [{name: 'email', value: $(this).val()}];
                    setCookie('users', JSON.stringify(data));
                    datatable.search($(this).val(),'email');
                }
                if(val.length == 0){
                    deleteCookie('users');
                    reloadDatatable('.m_datatable');
                }
            })
            $(document).off('input','#UserRole').on('input','#UserRole',function (e) {
                $('#usersControll').find('input[name!="role"]').val('');
                var val = $(this).val();
                if(val.length >= 3){
                    var data = [{name: 'role', value: $(this).val()}];
                    setCookie('users', JSON.stringify(data));
                    datatable.search($(this).val(),'role');
                }
                if(val.length == 0){
                    deleteCookie('users');
                    reloadDatatable('.m_datatable');
                }
            })


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