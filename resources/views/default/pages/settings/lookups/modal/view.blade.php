<div class="modal-dialog" role="document" style="max-width: 800px;">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header application-modal-color" style="background-color: #36a3f7 !important">
            <h5 class="modal-title" id="exampleModalLabel">
                {{$header}}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    				<span aria-hidden="true">
    					&times;
    				</span>
            </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body has-divider">
            <div class="m-form m-form--label-align-right m--margin-top-bottom">
                <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                    <!-- Advance Filter -->
                    <!-- Advance Filter -->
                    <form class="form form-inline" id="siteSettingsFilter">
                        <div class="col-auto">
                            <div class="input-group m-input-group" style="border-radius: 20px !important;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                          style="background-color: #d6d4d4 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">
                                        Value
                                    </span>
                                </div>
                                <input type="text" name="value" id="SiteValue"
                                           class="form-control m-input applicationIDFilter"
                                           style="height: 27px; border-top-right-radius: 20px;border-bottom-right-radius: 20px;" autocomplete="off"
                                           >
                            </div>
                        </div>

                    </form>


                </div>
            </div>
            <div style="margin: 20px 10px;padding: 0 20px;">

                <div class="lookup_datatable" id="auto_column_hide"></div>
            </div>

        </div>

        <!-- Modal Footer -->
        <div class="modal-footer d-ib">
            <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">
                Cancel
            </button>
            <button type="button" class="btn btn-info m-btn--pill float-right"
                    data-sub-modal-route="/lookup/add/{{$code}}">
                Add
            </button>
        </div>
    </div>
</div>
<script>
    var DatatableAutoColumnHideDemo = function () {
        //== Private functions
        // basic demo
        var demo = function () {
            var datatable = $('.lookup_datatable').mDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: 'lookup/code/{{$code}}',
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
                        field: 'value',
                        title: 'Value',
                        width: 200

                    },
                    {
                        field: 'description',
                        title: 'Description',
                        width: 250,
                        template: function (row) {
                            if (row.description) {
                                return '<span title="' + row.description + '">' + row.description.substr(0, 100) + '</span>';
                            }
                            return '-';
                        }

                    }, {
                        field: 'action',
                        title: 'Action',
                        width: 100,
                        template: function (row) {
                            return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-sub-modal-route="/lookup/edit/' + row.id + '?submodal=true">\
                                    <i class="la la-edit"></i></button> &nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-sub-modal-route="/lookup/delete/' + row.id + '">\
                                    <i class="la la-trash"></i></button>';
                        },
                    },]
            });
            $(document).off('keyup', '#SiteValue').on('keyup', '#SiteValue', function (e) {
                datatable.search($(this).val(), 'value');
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