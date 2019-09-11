/**
 * @author Suman Thaapa -- Lead 
 * @author Prabhat gurung 
 * @author Basanta Tajpuriya 
 * @author Rakesh Shrestha 
 * @author Manish Buddhacharya 
 * @author Lekh Raj Rai 
 * @author Ascol Parajuli
 * @email NEPALNME@GMAIL.COM
 * @create date 2019-03-12 16:51:56
 * @modify date 2019-03-12 16:51:56
 * @desc [description]
 */

// Dropzone configuration
Dropzone.autoDiscover = false;

function sp_loadIETable() {

    var sp_ieTable = $('#sp_applicationTable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/application/all',
                    method: 'POST',
                    params:{
                        //custom parameters
                        query:{
                            'type': 'Rescue'
                        }
                    }
                },
            },
            pageSize: 10,
            saveState: false,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,

        },
        layout: {
            theme: 'default',
            scroll: false,
            height: 520,
            footer: false
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
            autoHide: true,
            afterTemplate: function(row, data, index){
                $('tbody .m-datatable__row').first().addClass('active_row');
            },
        },

        // columns definition
        columns: [
            {
                field: 'created_at',
                title: 'Date',
                sortable: 'desc',
                width: 70,
                template: function(row){
                    return moment( row.created_at).format(std.config.date_format);
                }
            },
            {
                field: 'id',
                title: 'AppID',
                width: 60,
                template:function (row) {
                    if (std.config.alt_id == 'true' && row.alt_id) {
                        return 'IE' + row.alt_id.toString().padStart(5, '0');
                    }
                    return row.id;
                }
            },
            {
              field:'org_id',
                title:'Type',
                width: 40,
                template:function (row) {
                    if(row.org_id)
                        return 'NP';
                    else
                        return 'IE';
                }
            },
            {
                field: 'no_of_pet',
                title: 'Total Pets',
                width: 80
            },
            {
                field: 'inv_amt',
                title: '$ Invoice Amt.',
                textAlign: 'right',
                sortable: false,
                width: 100,
                template:function (row) {
                    if(row.inv_amt)
                        return '$'+row.inv_amt.toFixed(2);
                    else
                        return '-';
                }
            },
            {
                field: 'status',
                title: 'Status',
                width: 140,
                template: function (row) {
                    if (!row.status) {
                        return '<span data-modal-route="sp_application/status/' + row.id + '" class="m-badge  m-badge--info m-badge--wide c-p">New</span>';
                    }
                    if (row.status == 'New') {
                        var type = 'm-badge--info newStatus';

                    } else if (row.status == 'Pending') {
                        var type = 'm-badge--warning';
                    } else if (row.status == 'Approved') {
                        var type = 'm-badge--success';
                    }else if (row.status == 'Invoiced') {
                        var type = 'm-badge--warning';
                    }
                    else {
                        var type = 'm-badge--danger';
                    }
                    return '<span  data-modal-route="sp_application/status/' + row.id + '" class="m-badge ' + type + ' m-badge--wide c-p">' + row.status + '</span>';

                }
            },
            {
                field: 'action',
                title: 'Action',
                width: 80,
                template: function (row) {
                    return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" \
                            data-route="sp_applicationSingle/' + row.id + '" title="View Application">' +
                        '<i class="la la-eye"></i>' +
                        '</button>';
                },
            },]
    });

    sp_ieTable.on('m-datatable--on-init', function (e) {
        $('.newStatus').closest('tr').addClass('newStatus');
    });
    $('#sp_applicationIDFilter').on('blur', function(){
        sp_ieTable.search($(this).val(), 'applicationID');
    })
    $('#sp_applicationStatusFilter').on('change', function () {
        sp_ieTable.search($(this).val(), 'status');
    });
    $('#sp_applicationDateFilter').on('blur', function () {
        sp_ieTable.search($(this).val(), 'dateRange');
    });
    $('#m_application_date_filter').on('change', function () {
        alert('changed');
    });

}

/**
     * Prevent Form Submitting on Enter
     * @type {[type]}
     */
$(document).off('keypress', '#addNpApplicationFromServiceProvider').on('keypress', '#addNpApplicationFromServiceProvider', function (e) {
    var keyCode = e.keyCode || e.which;
    if(e.keyCode == 13){
        e.preventDefault();
    }
});


/**
 * Load Date Filter
 */
function sp_applicationTopDateLoader() {
    var daterangepickerInit = function () {
        if ($('#m_application_date_filter').length == 0) {
            return;
        }

        var picker = $('#m_application_date_filter');
        var start = moment().subtract(30, 'days');
        var end = moment().add('1','d');

        function cb(start, end, label) {
            var title = '';
            var range = '';

            if ((end - start) < 100) {
                title = 'Today:';
                range = start.format('MMM D');
            } else if (label == 'Yesterday') {
                title = 'Yesterday:';
                range = start.format('MMM D');
            } else {
                range = start.format('MMM D') + ' - ' + end.format('MMM D');
            }

            picker.find('.m-subheader__daterange-date').html(range);
            picker.find('.m-subheader__daterange-title').html(title);
        }

        picker.daterangepicker({
            startDate: start,
            endDate: end,
            opens: 'right',
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end, '');
    }

    daterangepickerInit();
}

/**
 * IE Service Proider Function
 */


function loadSPApp(data) {

    var add3;
    $('#SPHolder').empty();
    $.each(data, function (index, value) {
        if (value.address != null)
            add3 = value.address.add1 + '\n' +
                value.address.add2 + '\n' +
                value.address.zip.city + ',' + value.address.zip.state + '-' + value.address.zip.zip_code;
        else
            add3 = "";
        var markup = '  <div class="m-widget4__item choose-provider">\n' +
            '                                <div class="m-widget4__info">\n' +
            '                                    <span class="m-widget4__title">\n' +
            value.cname.ucfirst() +
            '                                    </span>\n' +
            '                                    <br>\n' +
            '                                    <span class="m-widget4__sub">\n' +
            add3 +
            '                                    </span>\n' +
            '                                </div>\n' +
            '                                <div class="m-widget4__ext">\n' +
            '                                    <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary selectSp" data-id="' + value.id + '">\n' +
            '                                        Select\n' +
            '                                    </a>\n' +
            '                                </div>\n' +
            '                            </div>';
        $('#SPHolder').append(markup);
        if (data.length) {
            $('#NearBySpHolder').removeClass('hidden');
            $('#NearBySpHolder').show();
        }
        else {
            $('#NearBySpHolder').hide();
            $('#NearBySpHolder').addClass('hidden');
        }
    });
}
/**
 * Service Provider Choose Options
 */
$(document).off('click', '.appSelectSp').on('click', '.appSelectSp', function (e) {
    e.preventDefault();
    e.stopPropagation();
    var text=$(this).text();

    if(text!='Selected')
    {
        /**
         * Load Vet
        */

        addFormLoader();

        ajaxRequest({
            url: 'organization/search/vet?provider_id=' + $(this).attr('data-id')
        }, function (response) {

            removeFormLoader();
            if(response.data) {
                $('#loadSelectedSpNp').html('');
                $.each(response.data, function(index, value){
                    if (value.address != null)
                            add3 = value.address.add1 + '\n' +
                                    value.address.add2 + '\n' +
                                    value.address.zip.city + ',' + value.address.zip.state + '-' + value.address.zip.zip_code;
                        else
                            add3 = "";
                        var markup = '  <div class="m-widget4__item choose-provider">\n' +
                                '<label class="m-checkbox">\n' +
                                '<input type="checkbox" class="selectVet" data-id="' + value.id + '">\n' +
                                '                                <div class="m-widget4__info no-pd-i">\n' +
                                '                                    <label class="m-widget4__title">\n' +
                                value.fname.ucfirst() + ' ' + value.lname.ucfirst() +
                                '                                    </label>\n' +
                                '                                    <br>\n' +
                                '                                    <span class="m-widget4__sub">\n' +
                                add3 +
                                '                                    </span>\n' +
                                '                                </div>\n' +
                                '<span></span>\n' +
                                '</label>\n' +
                                '                            </div>';
                        $('#loadSelectedSpNp').append(markup);
                });
                $(".selectedServiceProviderVetHolder").removeClass('hidden');
            }
        });

        $(this).closest('.m-widget4__item').siblings().fadeOut(100);

        $('#SP_ID').val($(this).attr('data-id'));
        $(document).find('.appSelectSp').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(this).text('Selected');
        $(this).addClass('btn-success text-success').removeClass('btn-secondary');
        $(this).parent().siblings().children('.m-widget4__title').addClass('text-success');
    }
    else
    {
        $(".selectedServiceProviderVetHolder").addClass('hidden');
        $(this).closest('.m-widget4__item').siblings().fadeIn(100);
        $('#SP_ID').val('');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(document).find('.appSelectSp').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
    }

});

/*-------------------------------------------Non Profit------------------------------------------------------*/
$(document).off('keyup', '.nonProfit').on('keyup', '.nonProfit', function () {
    var imp = $(this).val();
    var request = {
        url: '/application/getNonProfit',
        data: {cname: imp},
        method: 'post',
        cancelPrevious: true
    };
    ajaxRequest(request, function (response) {
        if (imp != "")
            $('#SearchSPText').text('Search Result for ' + imp);
        else
            $('#SearchSPText').html('Choose <abbr title="Non Profit">NP</abbr>');
        $('#NP_ID').val();
        $('#npSearchResultLists').empty().append(response.data);
    });
});

// $(document).off('click', '.selectNp').on('click', '.selectNp', function () {
//     var id = $(this).attr('data-id');
//     var text=$(this).text();
//     if(text!='Selected')
//     {
//         $('#NP_ID').val($(this).attr('data-id'));
//         $(document).find('.selectNp').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
//         $(document).find('.m-widget4__title').removeClass('text-success');
//         $(this).text('Selected');
//         $(this).addClass('btn-success text-success').removeClass('btn-secondary');
//         $(this).parent().siblings().children('.m-widget4__title').addClass('text-success');
//     }
//     else
//     {
//         $('#NP_ID').val();
//         $(document).find('.m-widget4__title').removeClass('text-success');
//         $(document).find('.selectNp').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
//     }
// });

$('.refreshApp').off('click').on('click',function () {
    routes.executeRoute('application/{id}', {
        url: 'application/{{$application->id}}'
    });
});




/**
 * Jump To Process
 */

$(document).off('click', ".jumpToProcess").on('click', ".jumpToProcess", function(e){
    e.preventDefault();
    if($(".next_step").length) {
        $('html, body').animate({
            scrollTop: ($(".next_step").offset().top - 90)
        }, 600);
    }
});

function loadNpModalJs() {
    $(".nonProfit").val('').trigger('input');
    var npWizard = $('#applicationAddNpWizardServiceProvider').mWizard({
                startStep: 1
            });
    npWizard.goFirst();
    loadNpPets();
    initAutoSize();
    uploadFiles();
}

/*
    Application create form for NP From Service Provider Login
 */
$(document).off('submit', '#addNpApplicationFromServiceProvider').on('submit', '#addNpApplicationFromServiceProvider', function (e) {
    e.preventDefault();
    var self = this;
    var data = arrangeData(['client', 'pet', 'application', 'file']);
    var req_count=0;
    // this will go each req class check if empty
    $('.required_input').each(function(){
        if($(this).val()=="") {
            req_count=1;
            $(this).css("border","1px solid #f4516c");
        } else {
            $(this).css("border","");
        }
    });
    // this will do bulk return instead of single single
   if(req_count==1){
        return ;
    }
    // Add loader
    addFormLoader();

    ajaxRequest({
        url: self.action,
        method: self.method,
        form: 'addNpApplicationFromServiceProvider'
    }, function (response) {
        processForm(response, function () {
            removeFormLoader();
            $('#applicationNpCreateModal .dynamicShownImages').remove();

            /**
             * File Upload Section
             */
            var initFileUploadInfo = '<h3 class="m-dropzone__msg-title">\
                                           Drop a file here or click to upload\
                                        </h3>\
                                        <span class="m-dropzone__msg-desc">\
                                            Maximum upload size:\
                                            <strong>\
                                                8.39 MB\
                                            </strong>\
                                        </span>';

            $('#applicationNpCreateModal .fileDetail').html(initFileUploadInfo);
            $("#extraUploadSection").nextAll().remove();

            /**
             * Remove Selected SP
             */
            $('#SP_ID').val('');
            $('#npSearchResultLists .selectNp').text('Select').removeClass('text-success btn-success').addClass('btn-secondary');
            $('#npSearchResultLists .m-widget4__title').removeClass('text-success');

            // Remove Dynamic Pet
            $('#newPet_Template_Append_Np').html('');

            document.getElementById("addNpApplicationFromServiceProvider").reset();
            $('#applicationNpCreateModal').modal('hide');
            // reloadDatatable('.m_datatable');
            if(response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('app_id')){
                routes.executeRoute('application/{id}', {
                    url: 'application/'+response.data[0].element.app_id
                });
            }
        });
    });
});

/**
 * Upload Events
 * Application Modal From
 */
var index = 1;
$(document).off('click', '#applicationNpCreateModal *[rel=getExtraUpload]').on('click', '#applicationNpCreateModal *[rel=getExtraUpload]', function (e) {
    e.preventDefault();

    if ($(this).attr("data-np") == "true") {
        $("#applicationNpCreateModal #extraUploadSection").closest('.upload-divider').removeClass('hidden');
        $(this).addClass('m-t-20');
    }

    if ($('#applicationNpCreateModal .extra-upload').length > 4) {
        return toastr.error('Can\'t add more than 5 upload Section');
    }

    var uploadId = 'upload_' + index;
    var uploadHTML = '<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 m-b-20">\
                        <input type="text" class="form-control form-control-sm m-b-15 extra-upload no-m-left" name="extraFiles[]" placeholder="Type Your Document Name" value="">\
                        <label class="m-dropzone dropzone ApplicationFiles full-width p-rel" for="' + uploadId + '">\
                        <input type="file" class="hidden uploadApplicationFiles" name="addinationalPhotos[]" id="' + uploadId + '">\
                            <div class="m-dropzone__msg dz-message needsclick fileDetail">\
                                <h3 class="m-dropzone__msg-title">\
                                   Drop a file here or click to upload\
                                </h3>\
                                <span class="m-dropzone__msg-desc">\
                                    Maximum upload size:\
                                    <strong>\
                                        8.39MB\
                                    </strong>\
                                </span>\
                            </div>\
                        </label>\
                    </div>';

    $("#applicationNpCreateModal #extraUploadSection").after(uploadHTML);

    index++;
});