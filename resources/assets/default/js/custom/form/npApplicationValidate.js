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

var formDebug1 	= true;

function processFormNP(formResponse, cb = null) {

	$("#applicationNpCreateModal").find('.input-required').removeClass('input-required');

	// if response has error
	if(formResponse.response && formResponse.response.data.exception) {

		toastr.error(formResponse.response.data.message, formResponse.response.data.exception);

    } else if(formResponse.response && formResponse.response.data.errors) {

		var is_wizard_found = false;

		if(formDebug1) {
			$.each(formResponse.response.data.errors, function(name, message) {

				var petValidation = ['pet_name_multi', 'species_multi', 'sex_multi', 'age_type_multi', 'age_of_pet_multi', 'weight_multi', 'color_multi', 'breed_multi'];

				if(jQuery.inArray(name, petValidation) != '-1'){
					name = name.slice(0, -6);
					if($("#applicationNpCreateModal").find('*[name="'+name+'\\[\\]"]').closest('label').length) {
						$("#applicationNpCreateModal").find('*[name="'+name+'\\[\\]"]').closest('label').addClass('input-required');
					}
					$("#applicationNpCreateModal").find('*[name="'+name+'\\[\\]"]').addClass('input-required');

					var wizard 	= $('#applicationNpCreateModal').find('*[name="'+name+'\\[\\]"]').closest('.m-wizard__form-step');
					var wizardId = $('#applicationNpCreateModal').find('*[name="'+name+'\\[\\]"]').closest('.m-wizard').attr("id");
				}
				else{
					if($("#applicationNpCreateModal").find('*[name='+name+']').closest('label').length) {
						$("#applicationNpCreateModal").find('*[name='+name+']').closest('label').addClass('input-required');
					}
					$("#applicationNpCreateModal").find('*[name='+name+']').addClass('input-required');

					var wizard 	= $('#applicationNpCreateModal').find('*[name='+name+']').closest('.m-wizard__form-step');
					var wizardId = $('#applicationNpCreateModal').find('*[name='+name+']').closest('.m-wizard').attr("id");
				}

				/**
				 * wizard selection
				 */

				var wizardContainer = $('#applicationNpCreateModal').mWizard();
				var wizardStep 		= wizardContainer.getStep();
				if(!is_wizard_found && wizard.length && wizard.attr("id")) {
					is_wizard_found = true;
					/**
					* If previous wizard has error, stay on error panel
					*/
					if($("#applicationNpCreateModal #"+wizard.attr("id")).find('textarea, select').hasClass('input-required')) {
						// Trigger Validation
						$('#applicationNpCreateModal *[data-wizard-target="#'+wizard.attr('id')+'"]').find('a:first-child').trigger('click');
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
            processModalNP();
        }
	}

	if(cb)
		cb();
}


function processModalNP() {
	if($("#applicationNpCreateModal").attr('data-parent-modal-id') && $("#applicationNpCreateModal").attr('data-parent-modal-id') >= 0) {
    	var callback = $("#applicationNpCreateModal").attr('data-modal-callback') ? $("#applicationNpCreateModal").attr('data-modal-callback') : false,
    		parentModalId 	= $("#applicationNpCreateModal").attr('data-parent-modal-id'),
    		modalId 		= $("#applicationNpCreateModal").attr('data-modal-id');
		if(parentModalId) {
			var parent 			= 'body .modal[data-modal-id='+parentModalId+']';
			var self 			= 'body .modal[data-modal-id='+modalId+']';

			if(callback) {
				window[callback]();
			}

			$('body .modal-backdrop').remove();
			$(parent).modal('show');
			$(self).modal('hide').remove();
		}
    } else {
        $("#applicationNpCreateModal").modal('hide');
    }
}