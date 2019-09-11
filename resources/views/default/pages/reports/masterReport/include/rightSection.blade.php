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
                    <button data-modal-route="report/search/{{isset($modalTarget)?$modalTarget:'statement'}}" type="button" class="btn m-btn--pill btn-info btn-sm m-btn m-btn--custom no-m-i float-right generateBtn">
                        <i class="la la-plus"></i> Generate
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet__body" id="reportLogContainer" data-target="{{$target}}">
        <div id="repostTablem"></div>
    </div>
</div>
<script>
    var target = $('#reportLogContainer').attr('data-target');
    $('#repostTablem').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/report/getReportLog/' + target,
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
                template:function (row) {
                    return moment(row.created_at).format(std.config.date_format);
                }
            },
            {
                field: 'created_at_time',
                title: 'Time',
                width: 100,
                template:function (row) {
                    return moment(row.created_at).format('HH:mm:ss');
                }
            },
            {
                field: 'report_name',
                title: 'Report Name',
                sortable: true,
                width: 200,
                template:function (row) {
                    if(row.report_name=='statement')
                        return 'Account Summary';
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
                    return '<div class="m-widget4__img m-widget4__img--icon '+fileColor+'">' +
                            '<img class="icon-img-lg m-r-10" src="assets/images/file-icon/' + fileIcon + '" alt="">' +
                            row.file_name + '</div> ';
                }
            },
            {
                field: 'action',
                title: 'Action',
                width: 50,
                template: function (row) {
                    var btn = '<button class="m-portlet__nav-link btn m-btn m-btn--hover-metal m-btn--icon m-btn--icon-only m-btn--pill downloadReport" data-id="'+row.id+'" title="Download Report">' +
                            '<i class="la la-download"></i></button>';
                    return btn;
                }
            }]
    });
</script>