/**
 * DEVELOPERS
 * ----------------------------------------------
 * SUMAN  THAPA - LEAD  (NEPALNME@GMAIL.COM)
 * ----------------------------------------------
 * - RUNA SIDDHI BAJRACHARYA
 * - RABIN BHANDARI
 * - SHIVA THAPA
 * - PRABHAT GURUNG
 * - KIRAN CHAULAGAIN
 * -----------------------------------------------
 * Created On: 3/20/2018
 *
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2018
 * ZEUSLOGIC, INC. ALL RIGHT RESERVED
*/

var formModal 	= '#applicationAddPage';
var formDebug 	= true;

function processFormPage(formResponse, cb = null) {

	$("#applicationAddPage").find('.input-required').removeClass('input-required');

	// if response has error
	if(formResponse.response && formResponse.response.data.exception) {

		toastr.error(formResponse.response.data.message, formResponse.response.data.exception);

    } else if(formResponse.response && formResponse.response.data.errors) {

		var is_wizard_found = false;

		if(formDebug) {
			$.each(formResponse.response.data.errors, function(name, message) {

				var petValidation = ['pet_name_multi', 'species_multi', 'sex_multi', 'age_type_multi', 'age_of_pet_multi', 'weight_multi', 'color_multi', 'breed_multi', 'fname_multi', 'lname_multi', 'personal_email_multi', 'cell_phone_multi', 'vet_lic_multi'];

				if(jQuery.inArray(name, petValidation) != '-1'){
					name = name.slice(0, -6);
					if($("#applicationAddPage").find('*[name="'+name+'\\[\\]"]').closest('label').length) {
						$("#applicationAddPage").find('*[name="'+name+'\\[\\]"]').closest('label').addClass('input-required');
					}
					$("#applicationAddPage").find('*[name="'+name+'\\[\\]"]').addClass('input-required');

					var wizard 	= $('*[name="'+name+'\\[\\]"]').closest('.m-wizard__form-step');
					var wizardId = $('*[name="'+name+'\\[\\]"]').closest('.m-wizard').attr("id");
				}
				else{
					if($("#applicationAddPage").find('*[name='+name+']').closest('label').length) {
						$("#applicationAddPage").find('*[name='+name+']').closest('label').addClass('input-required');
					}
					$("#applicationAddPage").find('*[name='+name+']').addClass('input-required');

					var wizard 	= $('*[name='+name+']').closest('.m-wizard__form-step');
					var wizardId = $('*[name='+name+']').closest('.m-wizard').attr("id");
				}

				// $("#applicationAddPage").find('*[name='+name+']').after('<div class="form-control-feedback text-danger">'+message+'</div>');

				/**
				 * wizard selection
				 */

				var wizardContainer = $('#'+wizardId).mWizard();
				var wizardStep 		= wizardContainer.getStep();
				if(!is_wizard_found && wizard.length && wizard.attr("id")) {
					is_wizard_found = true;
					/**
					 * If previous wizard has error, stay on error panel
					 */

					if($("*[data-wizard-target='#"+wizard.attr("id")+"']").hasClass('m-wizard__step--done')
							|| $("#"+wizard.attr("id")).find('input, select').hasClass('input-required')) {
						// Trigger Validation
						$('*[data-wizard-target="#'+wizard.attr('id')+'"]').find('a:first-child').trigger('click');
					}
				}
			});
		}

	} else {

		// if response has sucess data
		if(formResponse.data && formResponse.status == 200) {
            for(var i = 0; i < formResponse.data.length; i++) {
                if(formResponse.data[i].type == "success") {
                    toastr.success(formResponse.data[i].data);
                }
            }
            processFormModal(formResponse);
        }
	}

	if(cb)
		cb();
}


function processFormModal(formResponse) {

	if($("#applicationAddPage").attr('data-parent-modal-id') && $("#applicationAddPage").attr('data-parent-modal-id') >= 0) {
    	var callback = $("#applicationAddPage").attr('data-modal-callback') ? $("#applicationAddPage").attr('data-modal-callback') : false,
    		parentModalId 	= $("#applicationAddPage").attr('data-parent-modal-id'),
    		modalId 		= $("#applicationAddPage").attr('data-modal-id');
		if(parentModalId) {
			var parent 			= 'body .modal[data-modal-id='+parentModalId+']';
			var self 			= 'body .modal[data-modal-id='+modalId+']';

			/* Send Response On Callback of Modal */
			if(callback) {
				if(formResponse){
					window[callback](formResponse);
				} else {
					window[callback]();
				}
			}

			$('body .modal-backdrop').remove();
			$(parent).modal('show');
			$(self).modal('hide').remove();
		}
    } else {
        $("#applicationAddPage").modal('hide');
    }
}