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
                        }
                    },
                    // pageSize: 10,
                    saveState: false,
                    // serverPaging: true,
                    serverFiltering: true,
                    serverSorting: true
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
                            pageSizeSelect: [10, 20, 30, 50, 100]
                        }
                    }
                },

                search: {
                    input: $('#generalSearch')
                },

                rows: {
                    // auto hide columns, if rows overflow
                    autoHide: false
                },

                // columns definition
                columns: [
                    {
                        field: 'name', width: 130,
                        title: 'Username'
                    }, {
                        field: 'full_name',
                        title: 'Name',
                        template: ({full_name}) => '<span style="text-transform: capitalize !important;">' + full_name + '</span>'
                    }, {
                        field: 'email',
                        title: 'Email',
                        template: function (row) {
                            return '<span style="text-transform: unset !important;">' + row.email + '</span>';
                        }
                    }, {
                        field: 'role_name',
                        sortable: 'desc',
                        title: 'Role'

                    },
                    {
                        field: 'is_locked',
                        title: 'Locked',
                        template: function (row) {
                            return row.is_locked ? 'Yes' : 'No';
                        }

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
                                } else {
                                    btn += '<button class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/userlogs/lock/' + row.id + '" title="Lock off">\
                                    <i class="flaticon-lock-1"></i></button>';
                                }
                                return btn;
                            }
                        }
                    }]
            });

            $(document).off('input', '#UserName').on('input', '#UserName', function (e) {
                // $('#usersControll').find('input[name!="name"]').val('');
                var val = $(this).val();
                if (val.length >= 3) {
                    put_filter('users', {name: 'name', value: val});
                    datatable.search(val, 'name');
                }
                if (val.length === 0) {
                    deleteCookieOf('users', 'name');
                    datatable.mDatatable('reload');
                }
            });
            $(document).off('input', '#UserEmail').on('input', '#UserEmail', function (e) {
                // $('#usersControll').find('input[name!="email"]').val('');
                var val = $(this).val();
                if (val.length >= 3) {
                    put_filter('users', {name: 'email', value: val});
                    datatable.search(val, 'email');
                }
                if (val.length === 0) {
                    deleteCookieOf('users', 'email');
                    datatable.mDatatable('reload');
                }
            })


            sendAjax('lookup/user/roles', function (results) {
                let cookies = JSON.parse(getCookie('users')||'[]');
                let value;
                for (let cookie of cookies) {
                    if (cookie.name === 'role')
                        value = cookie.value;
                }
                results = results.map(x => `<option value="${x.text}" ${value === x.text?'selected':''}>${x.text}</option>`);
                $('#user---role').html(results).selectpicker('refresh');
            });
            $('#user---role').selectpicker().on('change', function () {
                var val = $(this).val();
                if (val.length >= 3) {
                    put_filter('users', {name:'role', value: val});
                    datatable.search(val, 'role');
                }
                if (val.length === 0) {
                    deleteCookieOf('users', 'role');
                    datatable.mDatatable('refresh');
                }
            });

        };

        return {
            // public functions
            init: function () {
                demo();
            }
        };
    }();

    jQuery(document).ready(function () {
        DatatableAutoColumnHideDemo.init();
    });


</script>