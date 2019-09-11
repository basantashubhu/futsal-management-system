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

/**
 * -----------------------------
 * Add
 * -----------------------------
 */

function loadClientDatePicker() {
    $("*[name=dob]").datepicker({
        autoclose : true,
        todayHighlight: true,
        format: std.config.date_format
    });
}


$(document).off('click','#SubmitClient').on('click','#SubmitClient', function (e) {
    var form = $(this).attr('data-target');
    var request = {
        url: '/client/store',
        method: 'post',
        form: form
    };

    addFormLoader();
    ajaxRequest(request, function (response) {
        processForm(response, function () {
            removeFormLoader();
            loadNotes();
        });
    });
});


/**
 * -----------------------------
 * Edit
 * -----------------------------
 */

$(document).off('click','#saveClient').on('click','#saveClient', function (e) {
    $('*[rel=personal_email]').off('blur');
    e.preventDefault();
    var self = $(this),
        form = self.attr('data-target'),
        requestURL = self.attr('data-url'),
        clientId = self.attr('data-client-id');
    var request = {
        url: requestURL,
        method: 'post',
        form: form
    };
    ajaxRequest(request, function (response) {
        processForm(response, function(){
            reloadDatatable('.m_datatable');

            // If Application Detail refresh partial dom
            if($("#applicantDetail").length) {
                routes.executeRoute('application/{id}',{
                    url : 'application/'+ (document.param ? document.param : '')
                });
            }
        });
    });
});

function removeDisabled() {
    $('.custom_disable').find('input, textarea, select').each(function (event) {
        $(this).attr("disabled", true);
    });
}

function citySelectedClient(id) {
    ajaxRequest({
        url: '/zip_code/city/' + id
    }, function (response) {
        if (response && response.data && response.data[0]) {
            $(".clientForm *[name=city]").focus();
            $(".clientForm *[name=state]").focus();
            $(".clientForm *[name=zip]").focus();
            $(".clientForm *[name=city]").val(response.data[0].city);
            $(".clientForm *[name=state]").val(response.data[0].state);
            $(".clientForm *[name=zip]").val(response.data[0].zip_code);
        }
    })
}
function addressCitySelected(cityid) {
        $.ajax({
                url:'getAddress?city='+cityid,
                method:'get',
                error:function(error){

                },
                success:function(data){
                    $('#site_city').html(`<option value="${data.city}" selected>${data.city}</option>`);
                    $('#site_zip').val(data.zip_code);
                    $('#site_state').val(data.state);
                    $('#site_county').val(data.county);
                    $('#site_region').val(data.region);
                    $('#site_district').val(data.district);
                    $('#siteCreate :input').each(function() {
                            floatLabelInput(this, true);
                    });
                }

            });
    }
