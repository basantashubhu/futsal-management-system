<?php

?>

<div class="m-portlet__body">
    <div class="form-group m-form__group m--margin-top-10 m--hide">
        <div class="alert m-alert m-alert--default" role="alert">
            The example form below demonstrates common HTML form elements that receive updated
            styles from Bootstrap with additional classes.
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-12 mb-25">
            <button type="button" class="btn btn-sm btn-accent m-btn m-btn--pill m-btn--custom"
            data-modal-route="/users/{{ $client->user_id }}/sites/assign" data-modal-callback="userSiteAssignedCallback">
                Assign Site
            </button>
        </div>
        <div class="col-lg-12">
            <table id="userSites"></table>
        </div>
    </div>
</div>

<script>
    $(function() {
        let DataTable = $('#userSites').mDatatable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/user/{{ $client->user_id }}/sites/all',
                        method:'GET'
                    },
                },
                // pageSize: 20,
                saveState: false,
                // serverPaging: true,
                serverFiltering: true,
                // serverSorting: true,
            },
            pagination: false,
            columns: [
                {
                    field: 'site_name',
                    title: 'Site name',
                    width: 250,
                    template:function ({site_name, site_type}) {
                        if(!site_type) site_type = '';
                        return [`<span title="${ site_name }">${ site_name }</span>`, '<a href="javascript:;">'+site_type+'</a>'].join('<br>');
                    }
                },
                {
                    field: 'add1',
                    title: 'Address',
                    width: '200px',
                    template:function ({add1, add2}) {
                        return [add1, add2].join(' ');
                    }
                },
                {
                    field: 'city',
                    title: 'City'
                },
                /* {
                    field: 'county',
                    title: 'County'
                }, */
                {
                    field: 'district',
                    title: 'District'
                },
                {
                    field: 'county',
                    title: 'County'
                },
                {
                    field: 'action',
                    title: 'Action',
                    template: function (raw) {
                        return [
                            `<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill deleteASite" data-id="${raw.site_id}">`,
                            `<i class="la la-trash"></i></button>`
                        ].join('');
                    }
                }
            ]
        });

        $(document).off('click', '.deleteASite').on('click', '.deleteASite', function (e) {
            let site = $(this).data('id');
            confirmAction({
                message: 'Are you sure you want to un-assign this site?',
                action: 'Yes, Un-assign',
                btn: 'btn-danger',
                ajax : {
                    url: '/user/{{ $client->user_id }}/sites/' + site + '/un-assign',
                    method: 'post',
                    success: function (message) {
                        toastr.success(message);
                        DataTable.reload();
                    },
                    error: function (err) {
                        toastr.error(err.status + ' ' + err.statusText);
                    }
                }
            });
        });

        // user sites assign form submit
        $(document).off('click', '#submitUserSites').on('click', '#submitUserSites', function (e) {
            sendAjax({
                url: '/users/{{ $client->user_id }}/sites/assign', method: 'post',
                data: {sites: $('#selected_sites').val()}, loader: true,
                success: resp => {
                    processModal();
                    $('#userSites').mDatatable('reload');
                    toastr.success('User sites updated successfully.');
                },
                error: err => toastr.error([err.status, err.statusText].join(' '))
            });
        });

        window.userSiteAssignedCallback = function () {
            DataTable.reload();
        };
    });
</script>