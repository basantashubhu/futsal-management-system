<div class="m-portlet m-portlet--full-height support-border-color">
    <div class="m-portlet__body">
    <!--begin: Search Form -->
    <div class="m-form m-form--label-align-right m--margin-top-bottom">
        <div class="global-filter row no-gutters">
            <div class="col-lg-12">
                <div class="m-portlet no-m-i m-portlet--bordered-semi">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                            <form id="ApplicationQuickSearch" class="form-inline">
                                <div class="col-auto">
                                    <div class="m-form__group m-form__group--inline w-220 pill-style">
                                        <div class="m-form__label left">
                                            <label class="m-label m-label--single">
                                                Title
                                            </label>
                                        </div>
                                        <div class="m-form__control custom-selecter-btn" >
                                            <input class="form-control m-input form-control-sm" type="text" value="" name="title" id="title" autocomplete="off" style="height: 27px; border-top-right-radius: 20px;border-bottom-right-radius: 20px;">
                                        </div>
                                    </div>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
                            </form>
                            <div class="col-auto no-pd-left">
                                <div class="date_filter">
                                    <span class="m-subheader__daterange" id="m_application_date_filter">
                                       <span class="m-subheader__daterange-label">
                                            <span class="m-subheader__daterange-date m--font-brand"></span>
                                           <input type="hidden" name="dateRange" class="date-range-input"
                                                  id="supportDateRange">
                                       </span>
                                       <a class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                            <i class="la la-angle-down"></i>
                                       </a>
                                   </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end: Search Form -->
        <div class="support_table"></div>
    </div>
</div>
<script type="text/javascript">
    $('#typeFilter').selectpicker();
    applicationTopDateLoader();
    $(document).ready(function () {
        var supportTable = $('.support_table').mDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/support/all',
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
                beforeTemplate: function(row, data, index){
                    row.find('td:not(:last-child)').attr('data-route', 'support/viewSingle/'+data.id);
                    row.find('td').addClass('m-datatable__toggle--detail');
                },
            },

            // columns definition
            columns: [
                {
                    field: 'created_at',
                    title: 'Date',
                    width: 70,
                    sortable: 'asc',
                    template: function(row){
                        return moment(row.created_at).format(std.config.date_format);
                    }
                },
                {
                    field: 'title',
                    title: 'Title'
                },
                {
                    field: 'status',
                    title: 'Status',
                    template: function(row){
                        return '<a href="#" class="m-portlet__nav-link btn btn-info btn-sm m-btn m-btn--pill">'+
                            row.status+
                        '</a>';
                    }
                },
                {
                    field: 'id',
                    title: 'action',
                    template: function(row){
                        var btn = '<button class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" data-id="'+row.id+'" title="Sent Report" data-modal-route="support/editSupport/' + row.id + '">' +
                            '<i class="la la-edit"></i></button>&nbsp;<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-id="'+row.id+'" title="Application View" data-modal-route="support/deleteSupport/'+row.id+'">' +
                            '<i class="la la-trash"></i></button>';
                            return btn;
                    }
                }
            ]
        });

        $('#title').on('keyup', function () {
            var val = $(this).val();
            if(val.length >= 3){
                supportTable.search($(this).val(), 'title');
            }
        });
        $('#typeFilter').on('change', function () {
            supportTable.search($(this).val(), 'support_type');
        });

        $('#m_application_date_filter').on('apply.daterangepicker', function (ev, picker) {
            var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
            supportTable.search(dateRange, 'dateRange');
        });
    });


</script>