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
* Prevent Form Submitting on Enter
* @type {[type]}
*/
$(document).off('keypress', '#addSingleServiceProvider').on('keypress', '#addSingleServiceProvider', function (e) {
    var keyCode = e.keyCode || e.which;
    if(e.keyCode == 13){
        e.preventDefault();
    }
});

function loadNpModalForSPJs() {
    $(".nonProfit").val('').trigger('input');
    var npWizard = $('#singleServiceProvider').mWizard({
                startStep: 1
            });
    npWizard.goFirst();
    loadNpPets();
    initAutoSize();
    npWizard.on('beforeNext', function(npWizard){
        //validation for pet
        ajaxRequest({
            cancelPrevious: true,
            url: "/sp_application/sp_getPetValidation",
            method: 'post',
            form: 'addSingleServiceProvider'
        }, function (response) {
            processFormSingleNP(response);
        });
    });
}
var const_i = 1;
$(document).off('click', '.addNewPetForm').on('click', '.addNewPetForm', function(e){
    var self = $(this);
    var parentID = self.data('parent');
    if(const_i < 5){
        const_i = const_i+1;
        var request = {
            url: 'sp_application/addNewPetForm/'+const_i,
            method: 'get'
        }
        ajaxRequest(request, function(response){
            $(".m-accordion").find('.collapse').removeClass('show');
            $('#dynamicAccordion').append(response.data);
        });
    }else{
        return toastr.error('Can\'t add more than 5');
    }

});

$(document).off('click','.accordion-close1').on('click','.accordion-close1', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).closest('.m-accordion').remove();
    const_i = const_i-1;
});

/*
    Application create form for NP From Service Provider Login
 */
$(document).off('submit', '#addSingleServiceProvider').on('submit', '#addSingleServiceProvider', function (e) {
    e.preventDefault();
    var self = this;
    var data = arrangeData(['client', 'pet', 'application', 'file']);

    // Add loader
    addFormLoader();

    ajaxRequest({
        url: self.action,
        method: self.method,
        form: 'addSingleServiceProvider'
    }, function (response) {
        processForm(response, function () {
            removeFormLoader();
            $('#singleApplicationNPModal').modal('hide');
            // reloadDatatable('.m_datatable');
            if(response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('app_id')){
                routes.executeRoute('application/{id}', {
                    url: 'application/'+response.data[0].element.app_id
                });
            }
        });
    });
});
