// /**
//  * DEVELOPERS
//  * ----------------------------------------------
//  * SUMAN  THAPA - LEAD  (NEPALNME@GMAIL.COM)
//  * ----------------------------------------------
//  * - RUNA SIDDHI BAJRACHARYA
//  * - RABIN BHANDARI
//  * - SHIVA THAPA
//  * - PRABHAT GURUNG
//  * - KIRAN CHAULAGAIN
//  * -----------------------------------------------
//  * Created On: 3/16/2018
//  *
//  * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2018
//  * ZEUSLOGIC, INC. ALL RIGHT RESERVED
// */
//
// var modalConfig = {
// 		container: '#subModalContainer',
// 		header: 'modal-header',
// 		body: 'modal-body',
// 		footer: 'modal-footer',
// 		loader: '.modal-btn-loader'
// 	}
//
// var title 		= null,
// 	self 		= null;
// 	prevIcon 	= null;
//
// // Show Modal on DOM Event
// $(document).off('click', '*[data-sub-modal-route]').on('click', '*[data-sub-modal-route]', function(e){
//
// 	e.preventDefault();
// 		self 			= $(this);
//
// 	var type 			= self.attr('data-modal-type') ? self.attr('data-modal-type') : 'default',
// 		modal_url		= self.attr('data-sub-modal-route'),
// 		icon 			= self.find('*[class^="la"], *[class^="fa"], *[class^="flaticon-"], *[class^="socicon-"]').eq(0);
//
// 		// get prev icon
// 		prevIcon 		= icon.length ? icon[0].outerHTML : null;
// 		// update title
// 		title 			= self.attr('data-modal-title') ? self.attr('data-modal-title') : 'Delete';
//
// 		// update icon with loader
// 		$(modalConfig.loader).remove();
// 		self.attr("disabled","disabled");
// 		icon.after('<div class="m-loader modal-btn-loader"></div>').end().remove();
//
//
// 		showModal(modal_url, {
// 			type : type
// 		});
//
// });
//
//
// function showModal(modal_url, options = null){
// 	if(modal_url.length) {
// 		ajaxRequest({
// 			url : modal_url.trim()
// 		}, function(response) {
// 			console.log(response);
// 			self.removeAttr("disabled");
//
// 			if(prevIcon)
// 				$(modalConfig.loader).after(prevIcon).end();
//
// 			$(modalConfig.loader).remove();
//
// 			if(response.response && (response.response.status >= 500 || response.response.status == 404)) {
// 				toastr.error(response.response.statusText);
// 			} else {
// 				setModalDom(response, options);
// 			}
// 		});
// 	}
//
// }
//
// function setModalDom(response, options = null) {
// 	if(options && options.hasOwnProperty('type') && options.type == 'delete') {
// 		$(modalConfig.container)
// 			.removeClass('modal-default').addClass('modal-danger')
// 			.html("").html(response.data)
// 			.find('#modal_dynamic_title').html(title)
// 			.end().modal('show');
// 	} else {
// 		$(modalConfig.container).removeClass('modal-danger').addClass('modal-default').html("").html(response.data).modal('show');
// 	}
// }
//
