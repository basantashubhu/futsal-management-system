<div class="modal-dialog modal-custom-small-width" role="document">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                Email Form
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">
					&times;
				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body" style="background-color: #fff !important;">
            <div class="row">
                <div class="col-sm-12">
                    <div class="m-form m-form--label-align-right m--margin-top-bottom">
                        <div class="global-filter row no-gutters">
                            <div class="col-lg-12">
                                <div class="m-portlet no-m-i m-portlet--bordered-semi">
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                                            <form class="form-inline" id="ProviderQuickFilter">
                                                <div class="col-auto">
                                                    <div class="m-form__group m-form__group--inline w-220 pill-style">
                                                        <div class="m-form__label left">
                                                            <label class="m-label m-label--single">
                                                                Name
                                                            </label>
                                                        </div>
                                                        <div class="m-form__control custom-selecter-btn">
                                                            <input class="form-control m-input form-control-sm"
                                                                   type="text" value="" name="code" id="code"
                                                                   autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div id="loadSaveEmail"></div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var loadTable = $('#loadSaveEmail').mDatatable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/loadSaveEmailAll?table={{$table}}',
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
                    field: 'code',
                    title: 'Name',
                },
                {
                    field: 'section',
                    title: 'Section',
                    width: 180,
                },
                {
                    field: 'action',
                    title: 'Action',
                    sortable: false,
                    width: 180,
                    template: function (row) {
                        return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill onCheckTemplate" data-id="' + row.id + '"><i class="la la-check"></i></button>' +
                            '<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill deleteTemp" data-id="' + row.id + '"><i class="la la-trash"></i></button>';
                    },
                },]
        });

        $('#code').on('keyup', function () {
            loadTable.search($(this).val(), 'name');
        });
    });
    $(document).off('click', '.onCheckTemplate').on('click', '.onCheckTemplate', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var request = {
            url: 'selectTemplate/' + id,
            method: 'get'
        }
        ajaxRequest(request, function (response) {
            var files = response.data.files;
            var template = response.data.email;
            $('.close').trigger('click');
            $('#templateCreate').find('[name=subject]').val(template.subject);
            $('#templateCreate #message').summernote('code', template.message);
            $('#hereFiles').html('');
            for (var i = 0; i < files.length; i++) {
                var myfile = '<li class="c-p"><span class="c-p fileView" data-file="' + files[i].file_name + '"><input name="file[]" value="' + files[i].file_name + '" class="form-control m-input c-p" readonly></span><span class="pull-right removeFile"><i class="fa fa-remove"></i></span></li>';
                $('#hereFiles').append(myfile);
            }
        });
    });
    $(document).off('click', '.deleteTemp').on('click', '.deleteTemp', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var request = {
            url: 'deleteSetEmail/' + id,
            method: 'post'
        };
        ajaxRequest(request, function (response) {
            processForm(response, function (response) {
                reloadDatatable('#loadSaveEmail');
            });
        })
    })
</script>