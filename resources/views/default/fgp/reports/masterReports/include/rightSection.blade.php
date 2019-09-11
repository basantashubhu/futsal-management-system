<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{ucfirst($target)}} Report List
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <div class="row">
                <div class="col no-pd-right">

                </div>
                <div class="col-auto">
                    <button data-modal-route="fgp_report/search/{{$modalTarget}}"
                            type="button"
                            class="btn m-btn--pill btn-info btn-sm m-btn m-btn--custom no-m-i float-right generateBtn">
                        <i class="la la-plus"></i> Generate
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet__body" id="reportLogContainer" data-target="{{$modalTarget}}">
        <div class="m-form m-form--label-align-right m--margin-top-bottom">
            <div class="global-filter row no-gutters">
                <div class="col-lg-12">
                    <div class="m-portlet no-m-i m-portlet--bordered-semi">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row justify-content-start align-items-center toolbar justify-content-start">
                                <form class="form form-inline" id="petQuickSort">
                                    <div class="col-auto">
                                        <div class="date_filter">
                                            <span class="m-subheader__daterange m_report_date_filter" id="m_report_date_filter">
                                               <span class="m-subheader__daterange-label">
                                                    <span class="m-subheader__daterange-date m--font-brand"></span>
                                                   <input type="hidden" name="dateRange" id="statement" class="data-range-input">
                                               </span>
                                               <a class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                                                    <i class="la la-angle-down"></i>
                                               </a>
                                           </span>
                                        </div>
                                    </div>
                                    @if(auth()->user()->role_id == 1)
                                    <div class="col-auto">
                                        <div class="input-group m-input-group"
                                                 style="border-radius: 20px !important;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background-color: #f2f3f8 !important; border-top-left-radius: 20px;border-bottom-left-radius: 20px; height: 27px; border: none !important;">
                                                  Users
                                                </span>
                                            </div>
                                            <div class="m-form__control custom-selecter-btn">
                                                <select class="form-control m-bootstrap-select m-input m-input--pill"
                                                      id="userTypeFilter" data-width="120"
                                                      data-style="btn-redius"
                                                      title="Select User"
                                                      data-actions-box="true" multiple name="userID">
                                                    @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-md-none m--margin-bottom-10"></div>
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="repostTablem"></div>
    </div>
</div>
<script>
    reportDatePicker();
    $('#userTypeFilter').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });
    var target = $('#reportLogContainer').attr('data-target');
    var reportTable=$('#repostTablem').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/fgp_report/getReportLog/' + target,
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

        rows: {
            // auto hide columns, if rows overflow
            autoHide: false,
        },

        layout: {
            theme: 'default',
            class: 'm-datatable--brand',
            scroll: false,
        },

        // columns definition
        columns: [
            {
                field: 'created_at',
                title: 'Date',
                sortable: 'desc',
                width: 100,
                template: function (row) {
                    return moment(row.created_at).format(std.config.date_format);
                }
            },
            {
                field: 'created_at_time',
                title: 'Time',
                width: 100,
                template: function (row) {
                    return moment(row.created_at).format('HH:mm:ss');
                }
            },
            {
                field: 'report_name',
                title: 'Report Name',
                sortable: true,
                width: 200,
                template: function (row) {
                    if (row.report_name == 'statement')
                        return 'Account Summary';
                    else if(row.report_name == 'application1')
                        return 'Application';
                    else if(row.report_name == 'pet1')
                        return 'Pet';
                    else
                        return row.report_name.ucfirst().replace(/_/g, ' ');
                }
            }, {
                field: 'file_name',
                title: 'File name',
                sortable: true,
                width: 500,
                template: function (row) {
                    var fileIcon = getFileIcon(row.file_name);
                    var fileColor = getFileExtensionColor(row.file_name);
                    return '<div class="m-widget4__img m-widget4__img--icon ' + fileColor + '">' +
                            '<img class="icon-img-lg m-r-10" src="assets/images/file-icon/' + fileIcon + '" alt="">' +
                            row.file_name + '</div> ';
                }
            },
            {
                field: 'action',
                title: 'Action',
                width: 80,
                template: function (row) {
                    var btn = '<button class="m-portlet__nav-link btn m-btn m-btn--hover-metal m-btn--icon m-btn--icon-only m-btn--pill downloadReport" data-id="' + row.id + '" title="Download Report">' +
                            '<i class="la la-download"></i></button>&nbsp;<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="fgp_deleteReport/'+row.id+'" data-id="' + row.id + '" title="Download Report">' +
                            '<i class="la la-trash"></i></button>';
                    return btn;
                }
            }]
    });

    $('.m_report_date_filter').on('apply.daterangepicker', function (ev, picker) {
        var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
        reportTable.search(dateRange, 'dateRange');
    }).on('cancel.daterangepicker', function (ev, picker) {
        var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
        reportTable.search(dateRange, 'dateRange');
    });

    $('#userTypeFilter').off('change').on('change', function () {
        reportTable.search($(this).val(), 'userID');
    });
</script>