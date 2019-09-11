<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{ucfirst($title)}} Report List
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <div class="row">
                <div class="col no-pd-right">

                </div>
                <div class="col-auto">
                    <button type="button" class="btn m-btn--pill btn-info btn-sm m-btn m-btn--custom no-m-i float-right" id="showForm">
                        <i class="la la-plus"></i> Generate
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet__body" id="reportLogContainer" data-target="{{$target}}">
        <div id="generateForm" style="display: none;">

        </div>
        <div id="repostTablem"></div>
    </div>
</div>
<script>
    $(document).off('click', '#showForm').on('click', '#showForm', function(e){
        var request = {
            url: 'getGenerateForm',
            method: 'get'
        }
        ajaxRequest(request, function(response){
            $("#generateForm").slideDown();
            $('#generateForm').html(response.data);
        });
    });
    $(document).off('click', '#hideForm').on('click', '#hideForm', function(e){
        $("#generateForm").slideUp();
    });
    var target = $('#reportLogContainer').attr('data-target');
    $('#repostTablem').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/report/getPostMail',
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
                field: 'name',
                title: 'User'
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
            },
            {
                field: 'surgery_certificate',
                title: 'Certificate File',
                sortable: true,
                width: 100,
                template: function (row) {
                    var fileIcon = getFileIcon(row.surgery_certificate);
                    var fileColor = getFileExtensionColor(row.surgery_certificate);
                    return '<a class="c-p" data-file-extension="pdf" data-file-url="report/getFile/'+row.surgery_certificate+'"><div class="m-widget4__img m-widget4__img--icon '+fileColor+'" data-file-url="report/viewFile/surgery_certificate/'+row.id+'" type="surgery_certificate" data-file-extension="pdf">' +
                            '<img class="icon-img-lg m-r-10" src="assets/images/file-icon/' + fileIcon + '" alt=""> </div> </a>';
                },
                textAlign:'center',
            },
            {
                field: 'approval_letter',
                title: 'Approved File',
                sortable: true,
                width: 100,
                template: function (row) {
                    var fileIcon = getFileIcon(row.approval_letter);
                    var fileColor = getFileExtensionColor(row.approval_letter);
                    return '<a class="c-p" data-file-extension="pdf" data-file-url="report/getFile/'+row.approval_letter+'"><div class="m-widget4__img m-widget4__img--icon '+fileColor+'" data-file-url="report/viewFile/approval_letter/'+row.id+'" type="approval_letter" data-file-extension="pdf">' +
                            '<img class="icon-img-lg m-r-10" src="assets/images/file-icon/' + fileIcon + '" alt=""></a>';
                },
                textAlign:'center',
            },
            {
                field: 'is_print',
                title: 'Status',
                template: function(row){
                    if(row.is_print){
                        return '<span class="font-danger">Printed</span>';
                    }
                    if(row.is_send){
                        return '<span class="font-success">Sent</span>';
                    }
                    return '<span class="font-warning">Nothing</span>';
                }
            },
            {
                field: 'action',
                title: 'Action',
                width: 150,
                template: function (row) {
                    var btn = '<button class="m-portlet__nav-link btn m-btn m-btn--hover-metal m-btn--icon m-btn--icon-only m-btn--pill undoReport" data-id="'+row.id+'" title="Undo Report">' +
                            '<i class="la la-undo"></i></button>&nbsp;<button class="m-portlet__nav-link btn m-btn m-btn--hover-metal m-btn--icon m-btn--icon-only m-btn--pill" data-id="'+row.id+'" title="Sent Report" data-modal-route="reportSentForm/' + row.id + '">' +
                            '<i class="la la-send-o"></i></button>&nbsp;<button class="m-portlet__nav-link btn m-btn m-btn--hover-metal m-btn--icon m-btn--icon-only m-btn--pill" data-id="'+row.id+'" title="Application View" data-modal-route="viewOriginalFile/'+row.id+'">' +
                            '<i class="la la-eye"></i></button>';
                    return btn;
                }
            }]
    });

    $(document).off('click', '.undoReport').on('click', '.undoReport', function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        var request = {
            url: 'undoReport/'+id,
            method: 'get'
        }
        ajaxRequest(request, function(response){
            processForm(response, function(){
                reloadDatatable('#repostTablem');
                reloadDatatable('#post_mail_datatable');
            });
        });
    });
     $(document).off('click','*[data-file-url]').on('click','*[data-file-url]', function(e) {
        e.preventDefault();
        var self = $(this);
        if(self.attr("data-file-url") && self.attr("data-file-extension")) {
            switch (self.attr("data-file-extension")) {
                case "jpg":
                case "jpeg":
                case "png":
                    ajaxRequest({
                        url: self.attr("data-file-url")
                    });
                    window.open(self.attr("data-file-url"));
                    break;
                default:
                    window.open(self.attr("data-file-url"));
                    break;
            }
        }
    });
</script>