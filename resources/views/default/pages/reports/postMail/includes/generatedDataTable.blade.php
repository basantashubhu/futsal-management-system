<div class="post_mail_datatable" id="post_mail_datatable"></div>
<script>
	$('#post_mail_datatable').mDatatable({
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
            beforeTemplate: function(row, data, index){
                row.attr('data-active-id', data.id);
                row.find('td').addClass('m-datatable__toggle--detail');
            },
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
                title: 'Certificate',
                sortable: true,
                width: 100,
                template: function (row) {
                    if(row.surgery_certificate){
                        var fileIcon = getFileIcon(row.surgery_certificate);
                        if(row.is_send){
                            var fileColor = 'm--font-afterSend';
                        }else{
                            var fileColor = getFileExtensionColor(row.surgery_certificate);
                        }
                        return '<a class="c-p" data-file-extension="pdf" ><div class="m-widget4__img m-widget4__img--icon '+fileColor+'" data-file-url="report/viewFile/surgery_certificate/'+row.id+'" type="surgery_certificate" data-file-extension="pdf">' +
                                '<img class="icon-img-lg m-r-10" src="assets/images/file-icon/' + fileIcon + '" alt=""> </div> </a>';
                    }else{
                        return '-';
                    }

                },
                textAlign:'center',
            },
            {
                field: 'approval_letter',
                title: 'Approved',
                sortable: true,
                width: 100,
                template: function (row) {
                    if(row.approval_letter){
                        var fileIcon = getFileIcon(row.approval_letter);
                        if(row.is_send){
                            var fileColor = 'm--font-afterSend';
                        }else{
                            var fileColor = getFileExtensionColor(row.approval_letter);
                        }
                        return '<a class="c-p" data-file-extension="pdf" >' +
                            '<div class="m-widget4__img m-widget4__img--icon '+fileColor+'' +
                            '" data-file-url="report/viewFile/approval_letter/'+row.id+'" type="approval_letter" data-file-extension="pdf">' +
                                '<img class="icon-img-lg m-r-10" src="assets/images/file-icon/' + fileIcon + '" alt=""></a>';
                    }else{
                        return '-';
                    }
                },
                textAlign:'center',
            },
            {
                field: 'denial_letter',
                title: 'Denial',
                sortable: true,
                width: 100,
                template: function (row) {
                    if(row.denial_letter){
                        var fileIcon = getFileIcon(row.denial_letter);
                        if(row.is_send){
                            var fileColor = 'm--font-afterSend';
                        }else{
                            var fileColor = getFileExtensionColor(row.denial_letter);
                        }
                        return '<a class="c-p" data-file-extension="pdf" >' +
                            '<div class="m-widget4__img m-widget4__img--icon '+fileColor+'" ' +
                            'data-file-url="report/viewFile/denial_letter/'+row.id+'" type="denial_letter" data-file-extension="pdf">' +
                                '<img class="icon-img-lg m-r-10" src="assets/images/file-icon/' + fileIcon + '" alt=""></a>';
                    }else{
                        return '-';
                    }
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
                    return '<span class="font-warning">Not Sent</span>';
                }
            },
            {
                field: 'action',
                title: 'Action',
                width: 150,
                template: function (row) {
                    if(row.is_send){
                        var btn = '<button class="m-portlet__nav-link btn m-btn m-btn--hover-metal m-btn--icon m-btn--icon-only m-btn--pill" title="Undo Report" style="visibility:hidden;">' +
                            '<i class="la la-undo"></i></button>&nbsp;<button class="m-portlet__nav-link btn m-btn m-btn--hover-metal m-btn--icon m-btn--icon-only m-btn--pill" data-id="'+row.id+'" title="Sent Report" data-modal-route="reportSentForm/' + row.id + '">' +
                            '<i class="la la-send-o"></i></button>&nbsp;<button class="m-portlet__nav-link btn m-btn m-btn--hover-metal m-btn--icon m-btn--icon-only m-btn--pill" data-id="'+row.id+'" title="Application View" data-modal-route="viewOriginalFile/'+row.id+'">' +
                            '<i class="la la-eye"></i></button>';
                    }else{
                        var btn = '<button class="m-portlet__nav-link btn m-btn m-btn--hover-metal m-btn--icon m-btn--icon-only m-btn--pill undoReport" data-id="'+row.id+'" title="Undo Report">' +
                            '<i class="la la-undo"></i></button>&nbsp;<button class="m-portlet__nav-link btn m-btn m-btn--hover-metal m-btn--icon m-btn--icon-only m-btn--pill" data-id="'+row.id+'" title="Sent Report" data-modal-route="reportSentForm/' + row.id + '">' +
                            '<i class="la la-send-o"></i></button>&nbsp;<button class="m-portlet__nav-link btn m-btn m-btn--hover-metal m-btn--icon m-btn--icon-only m-btn--pill" data-id="'+row.id+'" title="Application View" data-modal-route="viewOriginalFile/'+row.id+'">' +
                            '<i class="la la-eye"></i></button>';
                    }

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
                $('#showAllLists').hide();
                $('#showMailList').show();
                var request = {
                    url: 'getAllLists',
                    method: 'get'
                }
                ajaxRequest(request, function(response){
                    $('#mailContentHolder').html(response.data);
                });
                if (response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('merge_id')) {
                    var ids = response.data[0].element.merge_id;
                    setTimeout(function() {
                    $.each(ids, function(index, value){
                        $('#applicationTable').find('tr[data-active-id='+value+']').addClass('active_class_row');
                    })}, 1000);
                }
            });
        });
    });
    //  $(document).off('click','*[data-file-url]').on('click','*[data-file-url]', function(e) {
    //     e.preventDefault();
    //     var self = $(this);
    //     if(self.attr("data-file-url") && self.attr("data-file-extension")) {
    //         switch (self.attr("data-file-extension")) {
    //             case "jpg":
    //             case "jpeg":
    //             case "png":
    //                 ajaxRequest({
    //                     url: self.attr("data-file-url")
    //                 });
    //                 window.open(self.attr("data-file-url"));
    //                 break;
    //             default:
    //                 window.open(self.attr("data-file-url"));
    //                 break;
    //         }
    //     }
    // });
</script>