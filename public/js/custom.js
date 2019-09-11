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
 * Created On: 4/7/2018
 *
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2018
 * ZEUSLOGIC, INC. ALL RIGHT RESERVED
*/

String.prototype.ucfirst = function(){
	return this.charAt(0).toUpperCase() + this.slice(1);
};

var blackListsInputs =  {};

$(document).off('keyup', 'input').on('keyup', 'input', function(e) {

	var self = $(this);
	// if(blackListsInputs.indexOf())

});
/*!
 RowReorder 1.2.3
 2015-2017 SpryMedia Ltd - datatables.net/license
*/
(function(d){"function"===typeof define&&define.amd?define(["jquery","datatables.net"],function(f){return d(f,window,document)}):"object"===typeof exports?module.exports=function(f,g){f||(f=window);if(!g||!g.fn.dataTable)g=require("datatables.net")(f,g).$;return d(g,f,f.document)}:d(jQuery,window,document)})(function(d,f,g,m){var h=d.fn.dataTable,k=function(c,b){if(!h.versionCheck||!h.versionCheck("1.10.8"))throw"DataTables RowReorder requires DataTables 1.10.8 or newer";this.c=d.extend(!0,{},h.defaults.rowReorder,
k.defaults,b);this.s={bodyTop:null,dt:new h.Api(c),getDataFn:h.ext.oApi._fnGetObjectDataFn(this.c.dataSrc),middles:null,scroll:{},scrollInterval:null,setDataFn:h.ext.oApi._fnSetObjectDataFn(this.c.dataSrc),start:{top:0,left:0,offsetTop:0,offsetLeft:0,nodes:[]},windowHeight:0,documentOuterHeight:0,domCloneOuterHeight:0};this.dom={clone:null,dtScroll:d("div.dataTables_scrollBody",this.s.dt.table().container())};var a=this.s.dt.settings()[0],e=a.rowreorder;if(e)return e;a.rowreorder=this;this._constructor()};
d.extend(k.prototype,{_constructor:function(){var c=this,b=this.s.dt,a=d(b.table().node());"static"===a.css("position")&&a.css("position","relative");d(b.table().container()).on("mousedown.rowReorder touchstart.rowReorder",this.c.selector,function(a){if(c.c.enable){var i=d(this).closest("tr"),j=b.row(i);if(j.any())return c._emitEvent("pre-row-reorder",{node:j.node(),index:j.index()}),c._mouseDown(a,i),!1}});b.on("destroy.rowReorder",function(){d(b.table().container()).off(".rowReorder");b.off(".rowReorder")})},
_cachePositions:function(){var c=this.s.dt,b=d(c.table().node()).find("thead").outerHeight(),a=d.unique(c.rows({page:"current"}).nodes().toArray()),e=d.map(a,function(a){return d(a).position().top-b}),a=d.map(e,function(a,b){return e.length<b-1?(a+e[b+1])/2:(a+a+d(c.row(":last-child").node()).outerHeight())/2});this.s.middles=a;this.s.bodyTop=d(c.table().body()).offset().top;this.s.windowHeight=d(f).height();this.s.documentOuterHeight=d(g).outerHeight()},_clone:function(c){var b=d(this.s.dt.table().node().cloneNode(!1)).addClass("dt-rowReorder-float").append("<tbody/>").append(c.clone(!1)),
a=c.outerWidth(),e=c.outerHeight(),i=c.children().map(function(){return d(this).width()});b.width(a).height(e).find("tr").children().each(function(a){this.style.width=i[a]+"px"});b.appendTo("body");this.dom.clone=b;this.s.domCloneOuterHeight=b.outerHeight()},_clonePosition:function(c){var b=this.s.start,a=this._eventToPage(c,"Y")-b.top,c=this._eventToPage(c,"X")-b.left,e=this.c.snapX,a=a+b.offsetTop,b=!0===e?b.offsetLeft:"number"===typeof e?b.offsetLeft+e:c+b.offsetLeft;0>a?a=0:a+this.s.domCloneOuterHeight>
this.s.documentOuterHeight&&(a=this.s.documentOuterHeight-this.s.domCloneOuterHeight);this.dom.clone.css({top:a,left:b})},_emitEvent:function(c,b){this.s.dt.iterator("table",function(a){d(a.nTable).triggerHandler(c+".dt",b)})},_eventToPage:function(c,b){return-1!==c.type.indexOf("touch")?c.originalEvent.touches[0]["page"+b]:c["page"+b]},_mouseDown:function(c,b){var a=this,e=this.s.dt,i=this.s.start,j=b.offset();i.top=this._eventToPage(c,"Y");i.left=this._eventToPage(c,"X");i.offsetTop=j.top;i.offsetLeft=
j.left;i.nodes=d.unique(e.rows({page:"current"}).nodes().toArray());this._cachePositions();this._clone(b);this._clonePosition(c);this.dom.target=b;b.addClass("dt-rowReorder-moving");d(g).on("mouseup.rowReorder touchend.rowReorder",function(b){a._mouseUp(b)}).on("mousemove.rowReorder touchmove.rowReorder",function(b){a._mouseMove(b)});d(f).width()===d(g).width()&&d(g.body).addClass("dt-rowReorder-noOverflow");e=this.dom.dtScroll;this.s.scroll={windowHeight:d(f).height(),windowWidth:d(f).width(),dtTop:e.length?
e.offset().top:null,dtLeft:e.length?e.offset().left:null,dtHeight:e.length?e.outerHeight():null,dtWidth:e.length?e.outerWidth():null}},_mouseMove:function(c){this._clonePosition(c);for(var b=this._eventToPage(c,"Y")-this.s.bodyTop,a=this.s.middles,e=null,i=this.s.dt,j=i.table().body(),g=0,f=a.length;g<f;g++)if(b<a[g]){e=g;break}null===e&&(e=a.length);if(null===this.s.lastInsert||this.s.lastInsert!==e)0===e?this.dom.target.prependTo(j):(b=d.unique(i.rows({page:"current"}).nodes().toArray()),e>this.s.lastInsert?
this.dom.target.insertAfter(b[e-1]):this.dom.target.insertBefore(b[e])),this._cachePositions(),this.s.lastInsert=e;this._shiftScroll(c)},_mouseUp:function(){var c=this,b=this.s.dt,a,e,i=this.c.dataSrc;this.dom.clone.remove();this.dom.clone=null;this.dom.target.removeClass("dt-rowReorder-moving");d(g).off(".rowReorder");d(g.body).removeClass("dt-rowReorder-noOverflow");clearInterval(this.s.scrollInterval);this.s.scrollInterval=null;var j=this.s.start.nodes,f=d.unique(b.rows({page:"current"}).nodes().toArray()),
k={},h=[],l=[],n=this.s.getDataFn,m=this.s.setDataFn;a=0;for(e=j.length;a<e;a++)if(j[a]!==f[a]){var o=b.row(f[a]).id(),s=b.row(f[a]).data(),p=b.row(j[a]).data();o&&(k[o]=n(p));h.push({node:f[a],oldData:n(s),newData:n(p),newPosition:a,oldPosition:d.inArray(f[a],j)});l.push(f[a])}var q=[h,{dataSrc:i,nodes:l,values:k,triggerRow:b.row(this.dom.target)}];this._emitEvent("row-reorder",q);var r=function(){if(c.c.update){a=0;for(e=h.length;a<e;a++){var d=b.row(h[a].node).data();m(d,h[a].newData);b.columns().every(function(){this.dataSrc()===
i&&b.cell(h[a].node,this.index()).invalidate("data")})}c._emitEvent("row-reordered",q);b.draw(!1)}};this.c.editor?(this.c.enable=!1,this.c.editor.edit(l,!1,d.extend({submit:"changed"},this.c.formOptions)).multiSet(i,k).one("submitUnsuccessful.rowReorder",function(){b.draw(!1)}).one("submitSuccess.rowReorder",function(){r()}).one("submitComplete",function(){c.c.enable=!0;c.c.editor.off(".rowReorder")}).submit()):r()},_shiftScroll:function(c){var b=this,a=this.s.scroll,e=!1,d=c.pageY-g.body.scrollTop,
f,h;65>d?f=-5:d>a.windowHeight-65&&(f=5);null!==a.dtTop&&c.pageY<a.dtTop+65?h=-5:null!==a.dtTop&&c.pageY>a.dtTop+a.dtHeight-65&&(h=5);f||h?(a.windowVert=f,a.dtVert=h,e=!0):this.s.scrollInterval&&(clearInterval(this.s.scrollInterval),this.s.scrollInterval=null);!this.s.scrollInterval&&e&&(this.s.scrollInterval=setInterval(function(){if(a.windowVert)g.body.scrollTop=g.body.scrollTop+a.windowVert;if(a.dtVert){var c=b.dom.dtScroll[0];if(a.dtVert)c.scrollTop=c.scrollTop+a.dtVert}},20))}});k.defaults={dataSrc:0,
editor:null,enable:!0,formOptions:{},selector:"td:first-child",snapX:!1,update:!0};var l=d.fn.dataTable.Api;l.register("rowReorder()",function(){return this});l.register("rowReorder.enable()",function(c){c===m&&(c=!0);return this.iterator("table",function(b){b.rowreorder&&(b.rowreorder.c.enable=c)})});l.register("rowReorder.disable()",function(){return this.iterator("table",function(c){c.rowreorder&&(c.rowreorder.c.enable=!1)})});k.version="1.2.3";d.fn.dataTable.RowReorder=k;d.fn.DataTable.RowReorder=
k;d(g).on("init.dt.dtr",function(c,b){if("dt"===c.namespace){var a=b.oInit.rowReorder,e=h.defaults.rowReorder;if(a||e)e=d.extend({},a,e),!1!==a&&new k(b,e)}});return k});
// new Route({
// 	'dashboardPanel': {
// 		url: '/panel',
// 		callback: 'dashboardPanelLoaded',
// 	},
// });


// function dashboardPanelLoaded(response) {
// 	console.log(response.data + ' loaded');
// }


function fullCalendarInit(){
    var CalendarExternalEvents1 = function() {
    
        var initCalendar = function() {
            let ctrlIsPressed = false;

            function setEventsCopyable(isCopyable) {
              ctrlIsPressed = !ctrlIsPressed;
              $("#calendar").fullCalendar("option", "eventStartEditable", !isCopyable);
              $(".fc-event").draggable("option", "disabled", !isCopyable);
            }

            // set events copyable if the user is holding the control key
            $(document).keydown(function(e) {
              if (e.ctrlKey && !ctrlIsPressed) {
                setEventsCopyable(true);
              }
            });

            // if control has been released stop events being copyable
            $(document).keyup(function(e) {
              if (ctrlIsPressed) {
                setEventsCopyable(false);
              }
            });

            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var yesterday = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var today = todayDate.format('YYYY-MM-DD');
            var tomorrrow = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
            $("#m_calendar1").fullCalendar({ 
              height: 617,
              defaultView: "month",
              eventLimit: true,
              navLinks:true,
              events: [
                {
                  title: "All Day Event",
                  start: YM+'-01',
                  description: 'Lorem ipsum dolor sit incid idnut ut',
                  className: 'fc-event--success'
                },
                {
                  title: "Event 2",
                  start: YM+'-02',
                  end: YM+'-03',
                  description: 'Lorem ipsum dolor sit incid idnut ut',
                  className: 'fc-event--primary'
                },
                {
                  title: 'Travel Expenses',
                  start: YM+'-12',
                  description:'Lorem ipsum dolor sit incid idnut ut',
                  end: YM+'-10',
                  className: 'fc-event--info'
                }
              ],
              editable: false,
              droppable: true,
              dayClick: function(date, jsEvent,view){
                showModal('addEvent');
              },
              eventAfterAllRender(event, element, view) {
                // make all events draggable but disable dragging
                $(".fc-event").each(function() {
                  const $event = $(this);
                  // store data so the calendar knows to render an event upon drop
                  const event = $event.data("fcSeg").footprint.eventDef;
                  $event.data("event", event);

                  // make the event draggable using jQuery UI
                  $event.draggable({
                    disabled: true,
                    helper: "clone",
                    revert: true,
                    revertDuration: 0,
                    zIndex: 999,
                    stop(event, ui) {
                      // when dragging of a copied event stops we must set them
                      // copyable again if the control key is still held down
                      if (ctrlIsPressed) {
                        setEventsCopyable(true);
                      }
                    }
                  });
                });
              },
              eventMouseover: function(calEvent, domEvent) {
                var p = $(this).offset();
                var top = p.top-50;
                var left = p.left-40;
                var d = calEvent.description;
                if(d==undefined){
                  d = calEvent.miscProps.description;
                }
                var layer =	"<div id='events-layer' class='fc-events-layer fc-transparent' style='will-change: transform;transform: translate3d("+left+"px, "+top+"px, 0px);'>"+d+"</div>";
                $('body').append(layer);
              },
              eventMouseout: function(calEvent, domEvent) {
                $("body").find('div[id*=events-layer]').remove();
              },
          });
        }
    
        return {
            //main function to initiate the module
            init: function() {
                initCalendar(); 
            }
        };
    }();
    
    jQuery(document).ready(function() {
        CalendarExternalEvents1.init();
    });
}

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

/*-
Last Changes
--------------------------------
5/8/2018 - Kiran (
           line no 101 comment removed -
           )
 -*/

var formModal 	= '#modalContainer';
var formDebug 	= true;

function processForm(formResponse, cb = null) {

	$(".modal.show").find('.input-required').removeClass('input-required');

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
					if($('*[name="'+name+'\\[\\]"]').closest('label').length) {
						$(".modal.show").find('*[name="'+name+'\\[\\]"]').closest('label').addClass('input-required');
					}
					$(".modal.show").find('*[name="'+name+'\\[\\]"]').addClass('input-required');

					var wizard 	= $('*[name="'+name+'\\[\\]"]').closest('.m-wizard__form-step');
					var wizardId = $('*[name="'+name+'\\[\\]"]').closest('.m-wizard').attr("id");
				}
				else{
					if($('*[name='+name+']').closest('label').length) {
						$(".modal.show").find('*[name='+name+']').closest('label').addClass('input-required');
					}
					$(".modal.show").find('*[name='+name+']').addClass('input-required');

					var wizard 	= $('*[name='+name+']').closest('.m-wizard__form-step');
					var wizardId = $('*[name='+name+']').closest('.m-wizard').attr("id");
				}


				// $(".modal.show").find('*[name='+name+']').after('<div class="form-control-feedback text-danger">'+message+'</div>');

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

					if($(".modal.show *[data-wizard-target='#"+wizard.attr("id")+"']").hasClass('m-wizard__step--done')
							|| $(".modal.show #"+wizard.attr("id")).find('input, select').hasClass('input-required')) {
						// Trigger Validation
						$('.modal.show *[data-wizard-target="#'+wizard.attr('id')+'"]').find('a:first-child').trigger('click');
					}
				}
			});
			toastr.error("Please Check Highlighted Fields.");
		}

	} else {

		// if response has sucess data
		if(formResponse.data && formResponse.status == 200) {
            for(var i = 0; i < formResponse.data.length; i++) {
                if(formResponse.data[i].type == "success") {
                    toastr.success(formResponse.data[i].data);
                }
            }
            // $(".modal.show").modal('hide');
            processModal(formResponse);
        }
	}

	if(cb)
		cb(formResponse);
}


function processModal(formResponse) {
	const currModal = $(".modal.show");
	if(currModal.attr('data-parent-modal-id') && currModal.attr('data-parent-modal-id') >= 0) {
    	var callback = currModal.attr('data-modal-callback') || false,
    		parentModalId 	= currModal.attr('data-parent-modal-id'),
    		modalId 		= currModal.attr('data-modal-id');

		if(parentModalId) {
			var parent 			= 'body .modal[data-modal-id='+parentModalId+']';
			var self 			= 'body .modal[data-modal-id='+modalId+']';

			/* Send Response On Callback of Modal */
			if (callback && typeof window[callback] === 'function')
				window[callback](formResponse);

			$('body .modal-backdrop').remove();
			$(parent).modal('show');
			$(self).modal('hide').remove();
		}
    } else {
        currModal.modal('hide');
        const callback = currModal.attr('data-modal-callback');
		if (callback && typeof window[callback] === 'function')
			window[callback](formResponse);
    }
}
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

var formModal 	= '#modalContainer';
var formDebug 	= true;

function processFormCustom(formResponse, cb = null) {

	$("#modalContainer").find('.input-required').removeClass('input-required');

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
					if($('*[name="'+name+'\\[\\]"]').closest('label').length) {
						$("#modalContainer").find('*[name="'+name+'\\[\\]"]').closest('label').addClass('input-required');
					}
					$("#modalContainer").find('*[name="'+name+'\\[\\]"]').addClass('input-required');

					var wizard 	= $('*[name="'+name+'\\[\\]"]').closest('.m-wizard__form-step');
					var wizardId = $('*[name="'+name+'\\[\\]"]').closest('.m-wizard').attr("id");
				}
				else{
					if($('*[name='+name+']').closest('label').length) {
						$("#modalContainer").find('*[name='+name+']').closest('label').addClass('input-required');
					}
					$("#modalContainer").find('*[name='+name+']').addClass('input-required');

					var wizard 	= $('*[name='+name+']').closest('.m-wizard__form-step');
					var wizardId = $('*[name='+name+']').closest('.m-wizard').attr("id");
				}


				// $("#modalContainer").find('*[name='+name+']').after('<div class="form-control-feedback text-danger">'+message+'</div>');

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

					if($("#modalContainer *[data-wizard-target='#"+wizard.attr("id")+"']").hasClass('m-wizard__step--done')
							|| $("#modalContainer #"+wizard.attr("id")).find('input, select').hasClass('input-required')) {
						// Trigger Validation
						$('#modalContainer *[data-wizard-target="#'+wizard.attr('id')+'"]').find('a:first-child').trigger('click');
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
            processModalCustom(formResponse);
        }
	}

	if(cb)
		cb();
}


function processModalCustom(formResponse) {
	if($("#modalContainer").attr('data-parent-modal-id') && $("#modalContainer").attr('data-parent-modal-id') >= 0) {
    	var callback = $("#modalContainer").attr('data-modal-callback') ? $("#modalContainer").attr('data-modal-callback') : false,
    		parentModalId 	= $("#modalContainer").attr('data-parent-modal-id'),
    		modalId 		= $("#modalContainer").attr('data-modal-id');
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
        $("#modalContainer").modal('hide');
    }
}
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

function processFormSingleNP(formResponse, cb = null) {

	$("#singleApplicationNPModal").find('.input-required').removeClass('input-required');

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
					if($("#singleApplicationNPModal").find('*[name="'+name+'\\[\\]"]').closest('label').length) {
						$("#singleApplicationNPModal").find('*[name="'+name+'\\[\\]"]').closest('label').addClass('input-required');
					}
					$("#singleApplicationNPModal").find('*[name="'+name+'\\[\\]"]').addClass('input-required');

					var wizard 	= $('#singleApplicationNPModal').find('*[name="'+name+'\\[\\]"]').closest('.m-wizard__form-step');
					var wizardId = $('#singleApplicationNPModal').find('*[name="'+name+'\\[\\]"]').closest('.m-wizard').attr("id");
				}
				else{
					if($("#singleApplicationNPModal").find('*[name='+name+']').closest('label').length) {
						$("#singleApplicationNPModal").find('*[name='+name+']').closest('label').addClass('input-required');
					}
					$("#singleApplicationNPModal").find('*[name='+name+']').addClass('input-required');

					var wizard 	= $('#singleApplicationNPModal').find('*[name='+name+']').closest('.m-wizard__form-step');
					var wizardId = $('#singleApplicationNPModal').find('*[name='+name+']').closest('.m-wizard').attr("id");
				}

				/**
				 * wizard selection
				 */

				var wizardContainer = $('#singleApplicationNPModal').mWizard();
				var wizardStep 		= wizardContainer.getStep();
				if(!is_wizard_found && wizard.length && wizard.attr("id")) {
					is_wizard_found = true;
					/**
					* If previous wizard has error, stay on error panel
					*/
					if($("#singleApplicationNPModal #"+wizard.attr("id")).find('textarea, select').hasClass('input-required')) {
						// Trigger Validation
						$('#singleApplicationNPModal *[data-wizard-target="#'+wizard.attr('id')+'"]').find('a:first-child').trigger('click');
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
            processModalSingleNP();
        }
	}

	if(cb)
		cb();
}


function processModalSingleNP() {
	if($("#singleApplicationNPModal").attr('data-parent-modal-id') && $("#singleApplicationNPModal").attr('data-parent-modal-id') >= 0) {
    	var callback = $("#singleApplicationNPModal").attr('data-modal-callback') ? $("#singleApplicationNPModal").attr('data-modal-callback') : false,
    		parentModalId 	= $("#singleApplicationNPModal").attr('data-parent-modal-id'),
    		modalId 		= $("#singleApplicationNPModal").attr('data-modal-id');
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
        $("#singleApplicationNPModal").modal('hide');
    }
}


// function enable_form(element) {
//  	if (element.text() == "Edit") {
//         var id = element.attr("id");
//         element.parent().parent().find(':input').attr("disabled", false);
//         element.hide();
//         element.siblings().show();
//     }
// }

$(document).off('click', '.enable_form').on('click', '.enable_form', function(e){
    e.preventDefault();
    var self = $(this);
        if (self.text() == "Edit") {
        var id = self.attr("id");
        self.parent().parent().find(':input').attr("disabled", false);
        self.hide();
        self.siblings().show();
    }
});

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

// Table pointer action
var guardTable = [],
    guardedLists = "";

$(document).off('click', 'table tbody tr').on('click', 'table tbody tr', function (e) {
    var self = $(this),
        a = "";

    if(guardTable.length) {

        $.each(guardTable, function(index, val) {
            a +=  val+", ";
        });

        guardedLists = a.replace(/,\s*$/, "");
    }

    if(!self.closest(guardedLists).length) {
        self.siblings('tr').removeClass('active_row');
        if (self.hasClass('active_row')) {
            // self.removeClass('active_row');
        } else {
            // self.addClass('active_row');
        }
    }
});
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

$(document).off('click','*[data-target-search]').on('click','*[data-target-search]', function(e){
	e.preventDefault();
	var self = $(this);
		searchBox = self.attr("data-target-search");
	$(searchBox).toggle("fast");
});



function loadSearchDateRange(name) {
	var input = $("input[name="+name+"]");
	input.daterangepicker({
		autoApply: true,
      	locale: {
          	cancelLabel: 'Clear'
      	}
  });

}


function reloadDatatable(selector) {
	$(selector).mDatatable('reload');
}

/**
 * Quick Action Event
 */
var showQuickAction = false;
$(document).off('click', 'tbody .m-datatable__cell').on('click', 'tbody .m-datatable__cell', function (e) {
	var self = $(this),
		action = self.parent().find('td[data-field=action], td[data-field=Actions]').find('button');


	showQuickAction = true;
	/**
	 * Don't Init Quick Actions on these DOM
	 */
	if (self.hasClass('m-datatable__toggle--detail') ||
		self.find('*[data-modal-route]').length ||
		self.find('.m-checkbox-list').length ||
		(self.attr('data-field') && self.attr('data-field').trim() == 'Actions') ||
		(self.attr('data-field') && self.attr('data-field').trim() == 'action')) {
		showQuickAction = false;
	}

	/**
	 * Remove Previous Quick Action
	 */
	$('.action-menu').hide(100, function () {
		$(this).remove();
	});

	if (action.length && showQuickAction) {
		var quickAction = '<div class="action-menu"><ul>';
		$.each(action, function (index, button) {
			quickAction += '<li class="quickActionList">' + button.outerHTML + '</li>';
		});
		quickAction += '</ul></div>';

		if (quickAction) {
			$('body').append(quickAction);
			var top = e.clientY - $(this).height();
			var left = e.clientX - ($('.action-menu').children('ul').outerWidth() / 2);
			$('.action-menu').find('button').addClass('btn-xs quickActionButton').end().css({
				"top": top,
				"left": left
			}).show(200);
		}
	}

});


/**
 * Remove QuickAction After Click on action menu buttons
 */
$(document).off('click', '.action-menu button').on('click', '.action-menu button', function () {
	$('.action-menu').hide(100, function () {
		$(this).remove();
	});
});


/**
 * Remove QuickAction if not in target
 */
$('body').on('click', function (e) {

	if (e && e.target && !($(e.target).hasClass('m-datatable__cell') || $(e.target).closest('.m-datatable__cell').length ||
		$(e.target).hasClass('m-datatable__row') || $(e.target).hasClass('quickActionList') || $(e.target).hasClass('quickActionButton'))) {

		$('.action-menu').hide(100, function () {
			$(this).remove();
		});
	}
});

$(window).on('scroll', function () {
	var removeQuickAction = setTimeout(function () {
		$('.action-menu').hide(100, function () {
			$(this).remove();
		});
		clearTimeout(removeQuickAction);
	}, 500);
});


function loadIndividualTimeSheet() {
	let targetTable = $('#tableSchedule');
	const selectPick = $('#timeTypeInput');

	let time_types = [];
	let columns = [
		{
			title: '#', field: '#', width: 20, sortable: false, template: function ({ site_id, period_id, vol_id }) {
				let no = [site_id, period_id, vol_id].join('');
				return `<label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand no-m">
                        <input type="checkbox" class="inputTarget target${no}" data-target="${no}">
                        <span class="checkbox-target"></span>
                    </label>`;
			}
		},
		{ title: 'Schedule Date', field: 'end_date', width: '100px', textAlign: 'center' },
		{ title: 'Site Name', field: 'site_name' },
		{ title: 'Volunteer', field: 'vol_name' },
		{ title: 'Time Type', field: 'time_type', width: 100 },
		{ title: 'Days', field: 'day', width: 80 },
		{ title: 'Time In', field: 'time_in', width: '60px', textAlign: 'center' },
		{ title: 'Time Out', field: 'time_out', width: '60px', textAlign: 'center' },
		{ title: 'Break In', field: 'break_in', width: '60px', textAlign: 'center' },
		{ title: 'Break Out', field: 'break_out', width: '65px', textAlign: 'center' },
		{ title: 'Total Hrs', field: 'total_hrs', width: '60px', textAlign: 'center' },
		{
			title: 'Actions', field: 'actions', width: 100, textAlign: 'right', template: function ({ vol_id, unique_id, period_id, site_id }) {
				return `<button class="btn m-btn m-btn--hover-primary btn-sm m-btn--icon m-btn--icon-only m-btn--pill viewPeriodTsv2"
                        data-vol-id="${vol_id}" data-timesheet-id="${unique_id}" data-period-id="${period_id}" data-associated-site="${site_id}">
                    <i class="la la-eye"></i>
                </button>`;
			}
		}
	];
	let finalLength;
	targetTable.off('m-datatable--on-ajax-done').on('m-datatable--on-ajax-done', function (e, data) {
		finalLength = data.length - 1;
	});
	return targetTable.mDatatable({
		// datasource definition
		data: {
			type: 'remote',
			source: {
				read: {
					url: '/schedules/getData',
					params: { _token: $('meta[name="csrf-token"]').attr('content') }
				},
			},
			pageSize: 50,
			saveState: false,
			serverPaging: true,
			serverFiltering: true,
			serverSorting: true,

		},
		// column sorting
		sortable: true,
		pagination: true,
		toolbar: {
			items: {
				pagination: {
					pageSizeSelect: [10, 20, 30, 50, 100],
				},
			},
		},
		search: {
			// input: $('#select_schedule_date'),
			input: $('#select_period_no'),
		},
		rows: {
			// auto hide columns, if rows overflow
			autoHide: false,
			afterTemplate: function (row, { time_type, site_id, period_id, vol_id, groupSpecific }, i) {

				if (time_types.indexOf(time_type) === -1) {
					time_types.push(time_type);
					selectPick.append('<option value="' + time_type + '">' + time_type + '</option>');
				}

				// grouping
				let current = groupSpecific.hashCode();
				if (window.last_row !== current) {
					row.before(`
                        <tr class="m-datatable__row">
                        <td class="grouped_td" style="width: 20px;">
                        <span>
                            <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand no-m">
                                <input type="checkbox" class="check-site-of" value="${current}"><span></span>
                            </label>
                        </span>
                        </td>
                        <td colspan="11" class="grouped_td">
                            <div class="pull-left">
                                <strong>${groupSpecific}</strong>
                            </div>
                        </td>
                        </tr>
                        `);
				}
				window.last_row = current;
				if (i === finalLength) {
					selectPick.selectpicker('refresh');
					window.last_row = null;
				}
			}
		},
		columns
	});
}

function loadGroupTimeSheet() {
	let targetTable = $('#tableSchedule');
	const selectPick = $('#timeTypeInput');

	let time_types = [];
	/*`id
total_hrs
unique_id
site_name
vol_name
time_type
groupSpecific
site_id
end_date`*/
	let columns = [
		{
			title: '#', field: '#', width: 20, sortable: false, template: function ({ site_id, period_id, vol_id, groupSpecific }) {
				const no = groupSpecific.hashCode();
				return `<label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand no-m">
                        <input type="checkbox" class="inputTarget target${no} dataCheckbox" data-group-specific="${no}"
                        data-site="${site_id}" data-period="${period_id}" data-vol="${vol_id}">
                        <span class="checkbox-target"></span>
                    </label>`;
			}
		},
		{ title: 'Volunteer', field: 'vol_name' },
		{ title: 'Site', field: 'site_name' },
		{ title: 'Period#', field: 'period_no', width: '100px', textAlign: 'center' },
		{ title: 'Schedule Date', field: 'end_date', width: 200, textAlign: 'right' },
		{ title: 'Total Scheduled Hours', field: 'total_hrs', textAlign: 'right', width: 200 },
		{ title: 'Total Items', field: 'total_item', textAlign: "right" },
		// {title: 'Total Hrs', field: 'total_hrs', width: '60px', textAlign:'center'},
		{
			title: 'Actions', field: 'actions', width: 100, textAlign: 'right', template: function ({ vol_id, unique_id, period_id, site_id }) {
				return `
				<button class="btn m-btn m-btn--hover-primary btn-sm m-btn--icon m-btn--icon-only m-btn--pill viewPeriodTsv2"
                        data-vol-id="${vol_id}" data-timesheet-id="${unique_id}" data-period-id="${period_id}" data-associated-site="${site_id}">
                    <i class="la la-eye"></i>
                </button>
                <button class="btn m-btn m-btn--hover-primary btn-sm m-btn--icon m-btn--icon-only m-btn--pill printSchedule"
                        data-vol-id="${vol_id}" data-period-id="${period_id}" data-site-id="${site_id}">
                    <i class="la la-print"></i>
                </button>
                `;
			}
		}
	];
	let finalLength;
	targetTable.off('m-datatable--on-ajax-done').on('m-datatable--on-ajax-done', function (e, data) {
		finalLength = data.length - 1;
	});
	return targetTable.mDatatable({
		// datasource definition
		data: {
			type: 'remote',
			source: {
				read: {
					url: '/schedules/getGroupData',
					params: { _token: $('meta[name="csrf-token"]').attr('content') }
				},
			},
			pageSize: 50,
			saveState: false,
			serverPaging: true,
			serverFiltering: true,
			serverSorting: true,

		},
		// column sorting
		sortable: true,
		pagination: true,
		toolbar: {
			items: {
				pagination: {
					pageSizeSelect: [10, 20, 30, 50, 100],
				},
			},
		},
		search: {
			// input: $('#select_schedule_date'),
			input: $('#select_period_no'),
		},
		rows: {
			// auto hide columns, if rows overflow
			autoHide: false,
			afterTemplate: function (row, { time_type, site_id, groupSpecific, address_id }, i) {


				if (time_types.indexOf(time_type) === -1) {
					time_types.push(time_type);
					selectPick.append('<option value="' + time_type + '">' + time_type + '</option>');
				}

				// grouping
				let current = groupSpecific.hashCode();
				if (window.last_row !== current) {
					row.before(`
                        <tr class="m-datatable__row mapped_grouped_row">
                        <td class="grouped_td" style="width:53px">
	                        <span>
	                            <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand no-m">
	                                <input type="checkbox" class="check-site-of check-site-of${current}" value="${current}"><span></span>
	                            </label>
	                        </span>
                        </td>
                        <td colspan="6">
                            <div class="pull-left">
                                <strong>${groupSpecific}</strong>
                                <button class="btn m-btn btn-secondary ml-10 btn-sm m-btn--icon m-btn--pill printButton printCheckedSchedule" style="display:none; padding: 4px 10px" data-group-specific="${current}">
	                        	   <i class="la la-print"></i>&nbsp; Print
	                        	</button>
                            </div>
                        </td>
                        <td class="grouped_td" style="width: 163px;visibility:hidden;">
                        	<div class="text-right" style="width: 100px;">
	                        	<button class="btn m-btn m-btn--hover-primary btn-sm m-btn--icon m-btn--icon-only m-btn--pill printGroupSchedule"
	                        	    data-address-id="${address_id}" data-site-id="${site_id}">
	                        	    <i class="la la-print" style="font-size: 17px"></i>
	                        	</button>
                        	</div>
                        </td>
                        </tr>
                        `);
				}
				window.last_row = current;

				if (i === finalLength) {
					selectPick.selectpicker('refresh');
					window.last_row = null;

					setTimeout(tableInitCallback, 500, targetTable);
				}
			}
		},
		columns
	});
}

function tableInitCallback(targetTable) {
	const targets = targetTable.find('tbody tr.mapped_grouped_row');
	targets.each(function () {
		const lastChild = this.querySelector('td:last-child');
		if (!lastChild) return;
		const target = $(this).next().children('td:last-child');
		lastChild.style.width = `${target.innerWidth()}px`;
		lastChild.style.visibility = 'visible';
	});
}
var DatatablesAdvancedRowGrouping={
	init:function(){
		$("#m_table_1").DataTable({responsive:!0,pageLength:25,order:[[2,"asc"]],
			drawCallback:function(a)
			{
				var e=this.api(),
				t=e.rows({page:"current"}).nodes(),
				n=null;
				e.column(2,{page:"current"}).data().each(function(a,e){
					n!==a&&($(t).eq(e).before('<tr class="group"><td colspan="10">'+a+"</td></tr>"),n=a)
				})
			},
			columnDefs:[
			{targets:[0,2],visible:!1},
			{targets:-1,
				title:"Actions",
				orderable:!1,
				render:function(a,e,t,n){
					return'\n<span class="dropdown">\n<a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">\n<i class="la la-ellipsis-h"></i>\n</a>\n<div class="dropdown-menu dropdown-menu-right">\n<a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\n<a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\n<a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\n</div>\n</span>\n<a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">\n<i class="la la-edit"></i>\n</a>'}},
					{
						targets:8,render:function(a,e,t,n){
						var s={
							1:{title:"Pending",class:"m-badge--brand"},
							2:{title:"Delivered",class:" m-badge--metal"},
							3:{title:"Canceled",class:" m-badge--primary"},
							4:{title:"Success",class:" m-badge--success"},
							5:{title:"Info",class:" m-badge--info"},
							6:{title:"Danger",class:" m-badge--danger"},
							7:{title:"Warning",class:" m-badge--warning"}
						};
						return void 0===s[a]?a:'<span class="m-badge '+s[a].class+' m-badge--wide">'+s[a].title+"</span>"}},
						{
							targets:9,render:function(a,e,t,n){
								var s={
									1:{title:"Online",state:"danger"},
									2:{title:"Retail",state:"primary"},
									3:{title:"Direct",state:"accent"}};
									return void 0===s[a]?a:'<span class="m-badge m-badge--'+s[a].state+' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-'+s[a].state+'">'+s[a].title+"</span>"
								}
							}
							]
						})
	}
};
jQuery(document).ready(function(){DatatablesAdvancedRowGrouping.init()});
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
 * Created On: 4/7/2018
 *
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2018
 * ZEUSLOGIC, INC. ALL RIGHT RESERVED
*/

/**
 * -----------------------
 * LookUp plugin
 * gurung@173.162.135.164:fgp.git
 * ------------------------ 
 */

/**
 * -----------------------
 * Changed By Shiva 
 * Add the event Origin in callback
 * Changed By Rakesh
 * Added has_lookup and modified the data-id 
 *
 * Change By Shiva - > 2018/07/10
 * Change By rakesh - > 2019/03/14
 * Add on reload load all data
 * ------------------------
 */

var lookupConfig = {
    searchOnQueryLength: 3,
    width: 163,
    lookUpRef: 'data-lookup-id',
    lookUpClass: 'lookup-lists',
    lookUpListClass: 'selectedLookUp'
};


var origin=null;
var lookUpId = 0;
var lookUpCallback = null;

// initializaion
$(document).off('focusin click', '*[data-lookup]').on('focusin click', '*[data-lookup]', function(e) {
    lookUpCallback = $(this).attr('data-lookup-callback') || null;


    if($(this).val().length) {
        return $(this).trigger('keyup');
    }

    e.preventDefault();
    var self            = $(this),
        lookup_url      = self.attr('data-lookup'),
        lookup_code     = self.attr('data-lookup-code') ? self.attr('data-lookup-code') : null,
        lookup_update   = self.attr('data-lookup-update') ? self.attr('data-lookup-update') : null;

    origin=self;
    // Increment Lookup id
    lookUpId++;
    // Lookup Ajax Request
    var ajaxOptions = {
        cancelPrevious: true,
        url: lookup_url
    };

    $('.' + lookupConfig.lookUpClass).remove();
    showLoader(self);

    ajaxRequest(ajaxOptions, function(response) {
        if(self.is(':focus') && response && response.data) {
            self.attr(lookupConfig.lookUpRef, lookUpId);
            $('.lookupParent').removeClass('lookupParent');
            $('.' + lookupConfig.lookUpClass).remove();

            self.addClass('lookupParent');
            self.after(getLookUpDom(response, false));

            $('*[' + lookupConfig.lookUpRef + '=' + lookUpId + '][class=' + lookupConfig.lookUpClass + ']').width(self.outerWidth());
        } else {
            $('.lookup-lists').remove();
        }
    });
});


// Search on Lookup
$(document).off('keyup', '*[data-lookup]').on('keyup', '*[data-lookup]', function (e) {

    if (e.which == 37 || e.which == 38 || e.which == 39 || e.which == 40 || e.which == 13) {
        return;
    }

    var self            = $(this),
        lookup_url      = self.attr('data-lookup') + '/' + self.val(),
        lookup_code     = self.attr('data-lookup-code') ? self.attr('data-lookup-code') : null,
        lookup_update   = self.attr('data-lookup-update') ? self.attr('data-lookup-update') : null;

    origin = self;

    /**
     * If it is mouse event
     */
    if(typeof e.which == 'undefined')
        lookup_url      = self.attr('data-lookup');
    /**
     * If Query Exist Process Search
     */
    if(self.val().length) {

        // Increment Lookup id
        lookUpId++;
        // Lookup Ajax Request
        var ajaxOptions = {
            cancelPrevious: true,
            url: lookup_url,
        };

        $('.' + lookupConfig.lookUpClass).remove();
        showLoader(self);

        ajaxRequest(ajaxOptions, function(response) {
            if(self.is(':focus') && response && response.data) {
                self.attr(lookupConfig.lookUpRef, lookUpId);
                $('.lookupParent').removeClass('lookupParent');
                $('.' + lookupConfig.lookUpClass).remove();
                self.addClass('lookupParent');
                self.after(getLookUpDom(response, false));
                $('*[' + lookupConfig.lookUpRef + '=' + lookUpId + '][class=' + lookupConfig.lookUpClass + ']').width(self.outerWidth());

                initCallback();
            } else {
                $('.lookup-lists').remove();
            }
        });

    } else {
        self.trigger('click');
    }
});



/**
 * Up Down Key Event
 */
var select_list = 0;
$(document).off('keydown', '*[data-lookup]').on('keydown', '*[data-lookup]', function(e) {

    if (e.which && (e.which == 38 || e.which == 40)) {
        var self = $(this),
            lookUpId = self.attr(lookupConfig.lookUpRef) ? self.attr(lookupConfig.lookUpRef) : null;

        if (lookUpId) {
            var parentList = $('*[' + lookupConfig.lookUpRef + '=' + lookUpId + '][class=' + lookupConfig.lookUpClass + ']'),
                listLength = parentList.find('li').length;

            if (listLength && (select_list <= listLength)) {

                // 38 : up
                // 40 : down
                switch (e.which) {
                    case 38:
                        if (select_list == 0) {
                            select_list++;
                        }
                        if (select_list && select_list > 1) {
                            select_list--;
                        }
                        break;
                    case 40:
                        if (select_list == listLength) {
                            select_list = 0;
                        }
                        select_list++;
                        break;
                    default:
                        break;
                }

                parentList.find('li').removeClass(lookupConfig.lookUpListClass);
                parentList.find('li:nth-child(' + select_list + ')').addClass(lookupConfig.lookUpListClass);

            } else {
                select_list = 0;
            }
        }
    }
});

// Lookup Click Event
$(document).off('click', '.' + lookupConfig.lookUpClass + ' > ul > li').on('click', '.' + lookupConfig.lookUpClass + ' > ul > li', function(e) {
    e.preventDefault();
    e.stopPropagation();
    var self = $(this),
        lookUpId = self.closest('.' + lookupConfig.lookUpClass).attr('data-lookup-id'),
        value = self.text();

    if(value.length) {
        $('*.lookupParent[' + lookupConfig.lookUpRef + '=' + lookUpId + ']').val(value);
        $('*.lookupParent[' + lookupConfig.lookUpRef + '=' + lookUpId + ']').attr('data-value', self.attr('data-id'));
        $('*.lookupParent[' + lookupConfig.lookUpRef + '=' + lookUpId + ']').attr("data-ref",lookUpId);
    }
    // console.log(origin)
    initCallback(self.attr('data-id'));
    destroyLookUp(lookUpId);
});

// Lookup List Event
$(document).off('keyup', '.' + lookupConfig.lookUpClass + ' > ul > li').on('keyup', '.' + lookupConfig.lookUpClass + ' > ul > li', function(e) {

    e.preventDefault();
    // Event : 13
    if (e.which == 13) {
        var self = $(this),
            lookUpId = self.closest('.' + lookupConfig.lookUpClass).attr('data-lookup-id'),
            value = self.text();

        if(value.length) {
            $('*.lookupParent[' + lookupConfig.lookUpRef + '=' + lookUpId + ']').val(value);
            $('*.lookupParent[' + lookupConfig.lookUpRef + '=' + lookUpId + ']').attr('data-value', self.attr('data-id'));
        }
        initCallback(self.attr('data-id'));
        destroyLookUp(lookUpId);
    }
});

/**
 * Enter| event on lookup list
 */
$(document).off('keypress keydown', '.lookupParent').on('keypress keydown', '.lookupParent', function(e) {
    var self = $(this);
    var code = e.keyCode || e.which;

    if (code == 13 || code == 9) {
        e.stopPropagation();
        e.stopImmediatePropagation();

        var lookUpId = self.attr(lookupConfig.lookUpRef);

        var selectedList = $('.' + lookupConfig.lookUpClass + '[' + lookupConfig.lookUpRef + '=' + lookUpId + ']').find('.' + lookupConfig.lookUpListClass);
        if(code == 9) {
            selectedList = $('.' + lookupConfig.lookUpClass + '[' + lookupConfig.lookUpRef + '=' + lookUpId + ']').find('ul > li:first-child');
        }

        var value = selectedList.text();
        if(value.length){
            $('*.lookupParent[' + lookupConfig.lookUpRef + '=' + lookUpId + ']').val(value);
            $('*.lookupParent[' + lookupConfig.lookUpRef + '=' + lookUpId + ']').attr('data-value', self.attr('data-id'));
        }
        initCallback(selectedList.attr('data-id'));
        destroyLookUp(lookUpId);
    }
});

/**
 * Destroy Lookup modal if clicked except lookup input, not found message and lists
 */
$('body').on('click', function(e){

    if(e && e.target && e.target.nodeName === "LI" && e.target.className.indexOf('lookup-list-items') !== -1) {
        return;
    }

    if (e && e.target)
    if (!(e.target.nodeName == "INPUT" && e.target.className.indexOf('lookupParent') !== -1) ||
        !(e.target.nodeName == "SPAN" && e.target.parentNode.className.indexOf('lookup-lists') !== -1)) {

        $('*.lookupParent[' + lookupConfig.lookUpRef +']').removeClass('lookupParent').removeAttr(lookupConfig.lookUpRef);
        $('.' + lookupConfig.lookUpClass + '[' + lookupConfig.lookUpRef +']').remove();
    }
});

/**
 * Show Loader before load
 */
function showLoader(self) {
    self.after('<div class="' + lookupConfig.lookUpClass + ' has-loader"' + lookupConfig.lookUpRef + '="' + lookUpId + '">\
										<div class="m-loader m-loader--brand"></div></div>');
}

/**
 * Prepare list item dom for lookup
 */
function getLookUpDom(response, showInitialNotFound) {
    var lookUpDom = '';

    if (response && response.data && response.data.length) {
        lookUpDom += ' <div class="' + lookupConfig.lookUpClass + '"' + lookupConfig.lookUpRef + '="' + lookUpId + '"> <ul>';
        $.each(response.data, function(index, val) {
            // let has_lookup = val.has_lookup == 1 ? true : false;
            // let value_id = Number.isInteger(val.id) ? val.id : (val.id).toLowerCase().replace(' ', '_');
            lookUpDom += '<li data-id='+val.id+' class="lookup-list-items">' + val.value + '</li>';
        });
        lookUpDom += '</ul></div>';
    } else {
        if(showInitialNotFound) {
            lookUpDom += ' <div class="' + lookupConfig.lookUpClass + '  has-loader"' + lookupConfig.lookUpRef + '="' + lookUpId + '">';
            lookUpDom += '<span class="m--font-danger"><i class="la la-warning"></i> Result Not Found</span>';
            lookUpDom += '</div>';
        }
    }
    return lookUpDom;
}

/**
 * Initialize callback after list item select
 */
function initCallback(lookUpDataId) {
    if(lookUpCallback && window[lookUpCallback]) {
        return (lookUpDataId) ? window[lookUpCallback](lookUpDataId,origin) : window[lookUpCallback]();
    }
}


/**
 * Destroy Lookup
 */
function destroyLookUp(lookUpId) {
    $('*.lookupParent[' + lookupConfig.lookUpRef + '=' + lookUpId + ']').removeClass('lookupParent').removeAttr(lookupConfig.lookUpRef);
    $('.' + lookupConfig.lookUpClass + '[' + lookupConfig.lookUpRef + '=' + lookUpId + ']').remove();
}


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

$(document).off('click','.accordion-close').on('click','.accordion-close', function(e) {
	e.preventDefault();
	e.stopPropagation();
	$(this).closest('.m-accordion').remove();
	const_i=const_i-1;
});
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
var xhra;
function lookupSearch(url, callback = '') {
     if (xhra && xhra.readyState != 4) {
        xhra.abort();
    }
    xhra = $.ajax({
        type: 'get',
        url: url,
        success: function(response) {
            if (typeof callback !== "string" && typeof callback === "function") {
                callback(response);
            }
        }
    });
}

function getAllData(event){
    var lookup_val = $(event).attr('data-lookup');
    var url = $(event).attr('data-url');
    var id = $(event).attr('id');
    $('#var_' + id).empty();
    lookupSearch(url+'/'+lookup_val, function(response){
        if (response.length > 0) {
            $.each(response, function(index, value) {
                var data = '<li class="putdata" data-value="' + value.value + '" data-type="'+value.code+'" data-id="'+value.id+'" data-target="' + id + '" onclick="putData(this)">' + value.value + '</li>';
                $('#var_' + id).append(data);
            });
        }
    });
    $('#var_' + id).css('display', 'block');
};

function getTypeData(event){
    var value = $(event).val();
    if(value.length >= 1){
        var id = $(event).attr('id');
        var url = $(event).attr('data-type-url');
        var lookup_val = $(event).attr('data-lookup');
        $('#var_' + id).css('display', 'block');
        $('#var_' + id).empty();
        lookupSearch(url+'/'+lookup_val+'/'+value, function(response){
            if (response.length > 0) {
                $.each(response, function(index, value) {
                    var data = '<li class="putdata" data-value="' + value.value + '" data-type="' + value.code + '" data-id="'+id+'" data-target="' +id + '" onclick="putData(this)">' + value.value + '</li>';
                    $('#var_' + id).append(data);
                });
            } else {
                $('#var_' + id).css('display', 'none');
            }
        });
    }
    else{
        getAllData(event);
    }
}

$(document).keyup(function(e) {
    var code = e.keyCode || e.which;
    if (code == '9') {
        $('.show-lookup').css('display', 'none');
    }
});

$(document).click(function(e) {
    var target = e.target;
    if (target.nodeName !== "INPUT" || (target.nextElementSibling ? target.nextElementSibling.className !== "show-lookup" : true)) {
        $('.show-lookup').css('display', 'none');
    }
});

function putData(event){
    var value = $(event).attr('data-value');
    var target = $(event).attr('data-target');
    $('#'+target).val(value);
    $('.show-lookup').css('display', 'none');
}

function arrangeData(multi) {
    var data = {};
    var multi_data = [];
    var sr = {};
    $.each(multi, function(i, v) {
        $('.' + v).each(function(i1, v1) {
            sr = {};
            $(this).find(':input').each(function(index, val3) {
                sr[$(this).attr("name")] = $(this).val();
            });
            multi_data.push(sr);
        });
        data[v] = multi_data;
        multi_data = [];
    });
    return data;
}
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


function zipCodeSearch(url, callback = '') {
     if (xhra && xhra.readyState != 4) {
        xhra.abort();
    }
    xhra = $.ajax({
        type: 'get',
        url: url,
        success: function(response) {
            if (typeof callback !== "string" && typeof callback === "function") {
                callback(response);
            }
        }
    });
}

function getAllZipCode(event){
    $('.show-lookup').css('display', 'none');
    var lookup_val = $(event).attr('data-lookup');
    var url = $(event).attr('data-url');
    var id = $(event).attr('id');
    $('#var_' + id).empty();
    zipCodeSearch(url+'/'+lookup_val, function(response){
        if (response.length > 0) {
            $.each(response, function(index, value) {
                if(lookup_val != "country"){
                    var data = '<li class="putdata" data-zip="' + value.zip_code + '" data-city="'+value.city+'" data-id="'+value.id+'"\
                    data-country="'+value.country+'" data-state="'+value.state+'" data-target="' + id + '" onclick="putZipCode(this)"\
                    data-lookup="'+value.lookup_val+'">' + value.lookup_val + '</li>';
                }
                else{
                    var data = '<li class="putdata" data-id="'+value.id+'" data-target="' + id + '" onclick="putCountry(this)" data-lookup="'+value.lookup_val+'">' + value.lookup_val + '</li>';
                }
                $('#var_' + id).append(data);
            });
        }
    });
    $('#var_' + id).css('display', 'block');
};

function getTypeZipCode(event){
    $('.show-lookup').css('display', 'none');
    var value = $(event).val();
    if(value.length >= 1){
        var id = $(event).attr('id');
        var url = $(event).attr('data-type-url');
        var lookup_val = $(event).attr('data-lookup');
        $('#var_' + id).css('display', 'block');
        $('#var_' + id).empty();
        zipCodeSearch(url+'/'+lookup_val+'/'+value, function(response){
            if (response.length > 0) {
                $.each(response, function(index, value) {
                    if(lookup_val != "country"){
                        var data = '<li class="putdata" data-zip="' + value.zip_code + '" data-city="'+value.city+'" data-id="'+value.id+'"\
                                    data-country="'+value.country+'" data-state="'+value.state+'" data-target="' + id + '" onclick="putZipCode(this)" data-lookup="'+value.lookup_val+'">'+
                                    value.lookup_val + '</li>';
                    }
                    else{
                        var data = '<li class="putdata" data-id="'+value.id+'" data-target="' + id + '" onclick="putCountry(this)" data-lookup="'+value.lookup_val+'">' + value.lookup_val + '</li>';
                    }
                });
            } else {
                $('#var_' + id).css('display', 'none');
            }
        });
    }
    else{
        getAllData(event);
    }
}
$(document).keyup(function(e) {
    var code = e.keyCode || e.which;
    if (code == '9') {
        $('.show-lookup').css('display', 'none');
    }
});
$(document).click(function(e) {
    var target = e.target;
    if (target.nodeName !== "INPUT" || (target.nextElementSibling ? target.nextElementSibling.className !== "show-lookup" : true)) {
        $('.show-lookup').css('display', 'none');
    }
});

function putZipCode(event){
    var city = $(event).attr('data-city');
    var zip = $(event).attr('data-zip');
    // var country = $(event).attr('data-country');
    var state = $(event).attr('data-state');
    var lookup = $(event).attr('data-lookup');
    var target = $(event).attr('data-target');

    $('#'+target).val(lookup);
    $('#city').val(city);
    $('#zip').val(zip);
    $('#state').val(state);
    // $('#country').val(country);

    $('.show-lookup').css('display', 'none');
}
function putCountry(event){
    var lookup = $(event).attr('data-lookup');
    var target = $(event).attr('data-target');
    $('#'+target).val(lookup);

    $('.show-lookup').css('display', 'none');
}

function addTableFields(event, options = false){
    var capture = event.parent().parent().clone();
    capture.find('.idField').val('');
    if(options == "remove"){
        event.parent().parent().remove();
    }
    else{
        capture.find('#addFields').hide();
        capture.find('.remove').show();
        if(event.parent().parent().siblings().length<10)
            event.parent().parent().parent().append(capture);
        else
            toastr.error("Can't add more row")
    }
}
function reportDatePicker(dateRange=null,pickerClass='.m_report_date_filter') {
    var daterangepickerInit = function () {
        if ($('.m_report_date_filter').length == 0) {
            return;
        }

        var picker = $(pickerClass);
        var start = moment().startOf('year');
        var end = moment().endOf('Year');

        if(dateRange!=null && dateRange!='' )
        {
            var dates=dateRange.split('-');
            start=moment(dates[0]);
            end=moment(dates[1]);
        }

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

            range=start.format('Y/MM/DD') + ' - ' + end.format('Y/MM/DD');
            $('.data-range-input').val(range);
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


var applicationchartdata;

function dashboardTopDateLoader() {

    var daterangepickerInit = function () {
        if ($('#m_dashboard_daterangepicker').length == 0) {
            return;
        }

        var picker = $('#m_dashboard_daterangepicker');
        var start = moment();
        var end = moment();

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
            opens: 'left',
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

function loadDashboardPortlet() {

    var PortletTools = function () {
        //== Toastr
        var initToastr = function () {
            toastr.options.showDuration = 1000;
        }

        //== Demo 1
        var demo1 = function () {
            // This portlet is lazy initialized using data-portlet="true" attribute. You can access to the portlet object as shown below and override its behavior
            var portlet = $('#m_portlet_tools_1').mPortlet();

            //== Toggle event handlers
            portlet.on('beforeCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before collapse event fired!');
                }, 100);
            });

            portlet.on('afterCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.warning('Before collapse event fired!');
                }, 2000);
            });

            portlet.on('beforeExpand', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before expand event fired!');
                }, 100);
            });

            portlet.on('afterExpand', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After expand event fired!');
                }, 2000);
            });

            //== Remove event handlers
            portlet.on('beforeRemove', function (portlet) {
                toastr.info('Before remove event fired!');

                return confirm('Are you sure to remove this portlet ?');  // remove portlet after user confirmation
            });

            portlet.on('afterRemove', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After remove event fired!');
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('reload', function (portlet) {
                toastr.info('Leload event fired!');

                mApp.block(portlet.getSelf(), {
                    overlayColor: '#ffffff',
                    type: 'loader',
                    state: 'accent',
                    opacity: 0.3,
                    size: 'lg'
                });

                // update the content here

                setTimeout(function () {
                    mApp.unblock(portlet.getSelf());
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('afterFullscreenOn', function (portlet) {
                //toastr.info('After fullscreen on event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.data('original-height', scrollable.data('max-height'));
                scrollable.css('height', '100%');
                scrollable.css('max-height', '100%');
                mApp.initScroller(scrollable, {});
            });

            portlet.on('afterFullscreenOff', function (portlet) {
                toastr.warning('After fullscreen off event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.css('height', scrollable.data('original-height'));
                scrollable.data('max-height', scrollable.data('original-height'));
                mApp.initScroller(scrollable, {});
            });
        }

        //== Demo 2
        var demo2 = function () {
            // This portlet is lazy initialized using data-portlet="true" attribute. You can access to the portlet object as shown below and override its behavior
            var portlet = $('#m_portlet_tools_2').mPortlet();

            //== Toggle event handlers
            portlet.on('beforeCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before collapse event fired!');
                }, 100);
            });

            portlet.on('afterCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.warning('Before collapse event fired!');
                }, 2000);
            });

            portlet.on('beforeExpand', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before expand event fired!');
                }, 100);
            });

            portlet.on('afterExpand', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After expand event fired!');
                }, 2000);
            });

            //== Remove event handlers
            portlet.on('beforeRemove', function (portlet) {
                toastr.info('Before remove event fired!');

                return confirm('Are you sure to remove this portlet ?');  // remove portlet after user confirmation
            });

            portlet.on('afterRemove', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After remove event fired!');
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('reload', function (portlet) {
                toastr.info('Leload event fired!');

                mApp.block(portlet.getSelf(), {
                    overlayColor: '#000000',
                    type: 'spinner',
                    state: 'brand',
                    opacity: 0.05,
                    size: 'lg'
                });

                // update the content here

                setTimeout(function () {
                    mApp.unblock(portlet.getSelf());
                }, 2000);
            });
        }

        //== Demo 3
        var demo3 = function () {
            // This portlet is lazy initialized using data-portlet="true" attribute. You can access to the portlet object as shown below and override its behavior
            var portlet = $('#m_portlet_tools_3').mPortlet();

            //== Toggle event handlers
            portlet.on('beforeCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before collapse event fired!');
                }, 100);
            });

            portlet.on('afterCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.warning('Before collapse event fired!');
                }, 2000);
            });

            portlet.on('beforeExpand', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before expand event fired!');
                }, 100);
            });

            portlet.on('afterExpand', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After expand event fired!');
                }, 2000);
            });

            //== Remove event handlers
            portlet.on('beforeRemove', function (portlet) {
                toastr.info('Before remove event fired!');

                return confirm('Are you sure to remove this portlet ?');  // remove portlet after user confirmation
            });

            portlet.on('afterRemove', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After remove event fired!');
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('reload', function (portlet) {
                toastr.info('Leload event fired!');

                mApp.block(portlet.getSelf(), {
                    type: 'loader',
                    state: 'success',
                    message: 'Please wait...'
                });

                // update the content here

                setTimeout(function () {
                    mApp.unblock(portlet.getSelf());
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('afterFullscreenOn', function (portlet) {
                //toastr.info('After fullscreen on event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.data('original-height', scrollable.data('max-height'));
                scrollable.css('height', '100%');
                scrollable.css('max-height', '100%');
                mApp.initScroller(scrollable, {});
            });

            portlet.on('afterFullscreenOff', function (portlet) {
                toastr.warning('After fullscreen off event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.css('height', scrollable.data('original-height'));
                scrollable.data('max-height', scrollable.data('original-height'));
                mApp.initScroller(scrollable, {});
            });
        }

        //== Demo 3
        var demo4 = function () {
            // This portlet is lazy initialized using data-portlet="true" attribute. You can access to the portlet object as shown below and override its behavior
            var portlet = $('#m_portlet_tools_4').mPortlet();

            //== Toggle event handlers
            portlet.on('beforeCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before collapse event fired!');
                }, 100);
            });

            portlet.on('afterCollapse', function (portlet) {
                setTimeout(function () {
                    toastr.warning('Before collapse event fired!');
                }, 2000);
            });

            portlet.on('beforeExpand', function (portlet) {
                setTimeout(function () {
                    toastr.info('Before expand event fired!');
                }, 100);
            });

            portlet.on('afterExpand', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After expand event fired!');
                }, 2000);
            });

            //== Remove event handlers
            portlet.on('beforeRemove', function (portlet) {
                toastr.info('Before remove event fired!');

                return confirm('Are you sure to remove this portlet ?');  // remove portlet after user confirmation
            });

            portlet.on('afterRemove', function (portlet) {
                setTimeout(function () {
                    toastr.warning('After remove event fired!');
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('reload', function (portlet) {
                toastr.info('Leload event fired!');

                mApp.block(portlet.getSelf(), {
                    type: 'loader',
                    state: 'success',
                    message: 'Please wait...'
                });

                // update the content here

                setTimeout(function () {
                    mApp.unblock(portlet.getSelf());
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('afterFullscreenOn', function (portlet) {
                //toastr.info('After fullscreen on event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.data('original-height', scrollable.data('max-height'));
                scrollable.css('height', '100%');
                scrollable.css('max-height', '100%');
                mApp.initScroller(scrollable, {});
            });

            portlet.on('afterFullscreenOff', function (portlet) {
                toastr.warning('After fullscreen off event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.css('height', scrollable.data('original-height'));
                scrollable.data('max-height', scrollable.data('original-height'));
                mApp.initScroller(scrollable, {});
            });
        }

        //== Demo 3
        var demo5 = function () {
            // This portlet is lazy initialized using data-portlet="true" attribute. You can access to the portlet object as shown below and override its behavior
            var portlet = $('#m_portlet_tools_5').mPortlet();

            //== Toggle event handlers
            portlet.on('beforeCollapse', function (portlet) {
                setTimeout(function () {
                    // toastr.info('Before collapse event fired!');
                }, 100);
            });

            portlet.on('afterCollapse', function (portlet) {
                setTimeout(function () {
                    // toastr.warning('Before collapse event fired!');
                }, 2000);
            });

            portlet.on('beforeExpand', function (portlet) {
                setTimeout(function () {
                    // toastr.info('Before expand event fired!');
                }, 100);
            });

            portlet.on('afterExpand', function (portlet) {
                setTimeout(function () {
                    // toastr.warning('After expand event fired!');
                }, 2000);
            });

            //== Remove event handlers
            portlet.on('beforeRemove', function (portlet) {
                // toastr.info('Before remove event fired!');
                return confirm('Are you sure to remove this portlet ?');  // remove portlet after user confirmation
            });

            portlet.on('afterRemove', function (portlet) {
                setTimeout(function () {
                    // toastr.warning('After remove event fired!');
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('reload', function (portlet) {
                // toastr.info('Leload event fired!');
                mApp.block(portlet.getSelf(), {
                    type: 'loader',
                    state: 'success',
                    message: 'Please wait...'
                });

                // update the content here

                setTimeout(function () {
                    mApp.unblock(portlet.getSelf());
                }, 2000);
            });

            //== Reload event handlers
            portlet.on('afterFullscreenOn', function (portlet) {
                //toastr.info('After fullscreen on event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.data('original-height', scrollable.data('max-height'));
                scrollable.css('height', '100%');
                scrollable.css('max-height', '100%');
                mApp.initScroller(scrollable, {});
            });

            portlet.on('afterFullscreenOff', function (portlet) {
                toastr.warning('After fullscreen off event fired!');

                var scrollable = portlet.getBody().find('> .m-scrollable');

                scrollable.css('height', scrollable.data('original-height'));
                scrollable.data('max-height', scrollable.data('original-height'));
                mApp.initScroller(scrollable, {});
            });
        }


        return {
            //main function to initiate the module
            init: function () {
                initToastr();

                // init demos
                demo1();
                demo2();
                demo3();
                demo4();
                demo5();
            }
        };
    }();

    var PortletDraggable = function () {

        return {
            //main function to initiate the module
            init: function () {
                $("#m_sortable_portlets").sortable({
                    connectWith: ".m-portlet__head",
                    items: ".m-portlet",
                    opacity: 0.8,
                    handle: '.m-portlet__head',
                    coneHelperSize: true,
                    placeholder: 'm-portlet--sortable-placeholder',
                    forcePlaceholderSize: true,
                    tolerance: "pointer",
                    helper: "clone",
                    tolerance: "pointer",
                    forcePlaceholderSize: !0,
                    helper: "clone",
                    cancel: ".m-portlet--sortable-empty", // cancel dragging if portlet is in fullscreen mode
                    revert: 250, // animation in milliseconds
                    update: function (b, c) {
                        if (c.item.prev().hasClass("m-portlet--sortable-empty")) {
                            c.item.prev().before(c.item);
                        }
                    }
                });
            }
        };
    }();

    PortletTools.init();
    PortletDraggable.init();

}

/**
 * Load Dashboard Datatable
 */
function loadDashboardDataTable() {

    // Datatable 1
    if ($('#m_datatable_latest_orders').length === 0) {
        return;
    }

    var dashboardDatatable = $('#m_datatable_latest_orders').mDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: 'https://keenthemes.com/metronic/preview/inc/api/datatables/demos/default.php'
                }
            },
            pageSize: 10,
            saveState: {
                cookie: false,
                webstorage: true
            },
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true
        },

        layout: {
            theme: 'default',
            class: '',
            scroll: true,
            height: 455,
            footer: false
        },

        sortable: true,

        filterable: false,

        pagination: true,

        columns: [{
            field: "RecordID",
            title: "#",
            sortable: false,
            width: 40,
            selector: {
                class: 'm-checkbox--solid m-checkbox--brand'
            },
            textAlign: 'center'
        }, {
            field: "OrderID",
            title: "Order ID",
            sortable: 'asc',
            filterable: false,
            width: 150,
            template: '{{OrderID}} - {{ShipCountry}}'
        }, {
            field: "ShipName",
            title: "Ship Name",
            width: 150,
            responsive: {
                visible: 'lg'
            }
        }, {
            field: "Status",
            title: "Status",
            width: 100,
            // callback function support for column rendering
            template: function (row) {
                var status = {
                    1: {
                        'title': 'Pending',
                        'class': 'm-badge--brand'
                    },
                    2: {
                        'title': 'Delivered',
                        'class': ' m-badge--metal'
                    },
                    3: {
                        'title': 'Canceled',
                        'class': ' m-badge--primary'
                    },
                    4: {
                        'title': 'Success',
                        'class': ' m-badge--success'
                    },
                    5: {
                        'title': 'Info',
                        'class': ' m-badge--info'
                    },
                    6: {
                        'title': 'Danger',
                        'class': ' m-badge--danger'
                    },
                    7: {
                        'title': 'Warning',
                        'class': ' m-badge--warning'
                    }
                };
                return '<span class="m-badge ' + status[row.Status].class + ' m-badge--wide">' + status[row.Status].title + '</span>';
            }
            // }, {
            //     field: "Type",
            //     title: "Type",
            //     width: 100,
            //     // callback function support for column rendering
            //     template: function(row) {
            //         var status = {
            //             1: {
            //                 'title': 'Online',
            //                 'state': 'danger'
            //             },
            //             2: {
            //                 'title': 'Retail',
            //                 'state': 'primary'
            //             },
            //             3: {
            //                 'title': 'Direct',
            //                 'state': 'accent'
            //             }
            //         };
            //         return '<span class="m-badge m-badge--' + status[row.Type].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + status[row.Type].state + '">' + status[row.Type].title + '</span>';
            //     }
        }
            , {
                field: "Actions",
                width: 110,
                title: "Actions",
                sortable: false,
                overflow: 'visible',
                template: function (row) {
                    var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

                    return '\
                    <div class="dropdown ' + dropup + '">\
                        <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                            <i class="la la-ellipsis-h"></i>\
                        </a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                            <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\
                            <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\
                            <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\
                        </div>\
                    </div>\
                    <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\
                        <i class="la la-edit"></i>\
                    </a>\
                    <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\
                        <i class="la la-trash"></i>\
                    </a>\
                ';
                }
            }]
    });

    // Datatable 2
    if ($('#m_datatable_latest_orders2').length === 0) {
        return;
    }

    var dashboardDatatable2 = $('#m_datatable_latest_orders2').mDatatable({
        data: {
            type: 'remote',
            source: {
                read: {
                    url: 'https://keenthemes.com/metronic/preview/inc/api/datatables/demos/default.php'
                }
            },
            pageSize: 10,
            saveState: {
                cookie: false,
                webstorage: true
            },
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true
        },

        layout: {
            theme: 'default',
            class: '',
            scroll: true,
            height: 455,
            footer: false
        },

        sortable: true,

        filterable: false,

        pagination: true,

        columns: [{
            field: "RecordID",
            title: "#",
            sortable: false,
            width: 40,
            selector: {
                class: 'm-checkbox--solid m-checkbox--brand'
            },
            textAlign: 'center'
        }, {
            field: "OrderID",
            title: "Order ID",
            sortable: 'asc',
            filterable: false,
            width: 150,
            template: '{{OrderID}} - {{ShipCountry}}'
        }, {
            field: "ShipName",
            title: "Ship Name",
            width: 150,
            responsive: {
                visible: 'lg'
            }
        }, {
            field: "Status",
            title: "Status",
            width: 100,
            // callback function support for column rendering
            template: function (row) {
                var status = {
                    1: {
                        'title': 'Pending',
                        'class': 'm-badge--brand'
                    },
                    2: {
                        'title': 'Delivered',
                        'class': ' m-badge--metal'
                    },
                    3: {
                        'title': 'Canceled',
                        'class': ' m-badge--primary'
                    },
                    4: {
                        'title': 'Success',
                        'class': ' m-badge--success'
                    },
                    5: {
                        'title': 'Info',
                        'class': ' m-badge--info'
                    },
                    6: {
                        'title': 'Danger',
                        'class': ' m-badge--danger'
                    },
                    7: {
                        'title': 'Warning',
                        'class': ' m-badge--warning'
                    }
                };
                return '<span class="m-badge ' + status[row.Status].class + ' m-badge--wide">' + status[row.Status].title + '</span>';
            }
            // }, {
            //     field: "Type",
            //     title: "Type",
            //     width: 100,
            //     // callback function support for column rendering
            //     template: function(row) {
            //         var status = {
            //             1: {
            //                 'title': 'Online',
            //                 'state': 'danger'
            //             },
            //             2: {
            //                 'title': 'Retail',
            //                 'state': 'primary'
            //             },
            //             3: {
            //                 'title': 'Direct',
            //                 'state': 'accent'
            //             }
            //         };
            //         return '<span class="m-badge m-badge--' + status[row.Type].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + status[row.Type].state + '">' + status[row.Type].title + '</span>';
            //     }
        }, {
            field: "Actions",
            width: 110,
            title: "Actions",
            sortable: false,
            overflow: 'visible',
            template: function (row) {
                var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';

                return '\
                    <div class="dropdown ' + dropup + '">\
                        <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                            <i class="la la-ellipsis-h"></i>\
                        </a>\
                        <div class="dropdown-menu dropdown-menu-right">\
                            <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\
                            <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\
                            <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\
                        </div>\
                    </div>\
                    <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\
                        <i class="la la-edit"></i>\
                    </a>\
                    <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete">\
                        <i class="la la-trash"></i>\
                    </a>\
                ';
            }
        }]
    });


    // dashboardDatatable();
    // dashboardDatatable2();
}

/**
 * Charts
 * ---------------
 * Profit
 * Trends
 */
function loadDashboardChart() {

    //== Profit Share Chart.
    var profitShare = function () {
        if ($('#m_chart_profit_share').length == 0) {
            return;
        }
        ajaxRequest({
            url: 'service_provider/chart'
        }, function (response) {
            var chartData = response.data;
            $('#service_provider').text(chartData[0].value + '% Total Service Provider');
            $('#non_profit').text(chartData[1].value + '% Total Non Profit');
            $('#rescue').text(chartData[2].value + '% Total Rescue');
            var chart = new Chartist.Pie('#m_chart_profit_share', {

                series: [{
                    value: chartData[0].value,
                    className: 'custom',
                    meta: {
                        color: mUtil.getColor('accent')
                    }
                },
                    {
                        value: chartData[1].value,
                        className: 'custom',
                        meta: {
                            color: mUtil.getColor('warning')
                        }
                    },
                    {
                        value: chartData[2].value,
                        className: 'custom',
                        meta: {
                            color: mUtil.getColor('brand')
                        }
                    }
                ],
                labels: [1, 2, 3]
            }, {
                donut: true,
                donutWidth: 17,
                showLabel: false
            });

            chart.on('draw', function (data) {
                if (data.type === 'slice') {
                    // Get the total path length in order to use for dash array animation
                    var pathLength = data.element._node.getTotalLength();

                    // Set a dasharray that matches the path length as prerequisite to animate dashoffset
                    data.element.attr({
                        'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
                    });

                    // Create animation definition while also assigning an ID to the animation for later sync usage
                    var animationDefinition = {
                        'stroke-dashoffset': {
                            id: 'anim' + data.index,
                            dur: 1000,
                            from: -pathLength + 'px',
                            to: '0px',
                            easing: Chartist.Svg.Easing.easeOutQuint,
                            // We need to use `fill: 'freeze'` otherwise our animation will fall back to initial (not visible)
                            fill: 'freeze',
                            'stroke': data.meta.color
                        }
                    };

                    // If this was not the first slice, we need to time the animation so that it uses the end sync event of the previous animation
                    if (data.index !== 0) {
                        animationDefinition['stroke-dashoffset'].begin = 'anim' + (data.index - 1) + '.end';
                    }

                    // We need to set an initial value before the animation starts as we are not in guided mode which would do that for us

                    data.element.attr({
                        'stroke-dashoffset': -pathLength + 'px',
                        'stroke': data.meta.color
                    });

                    // We can't use guided mode as the animations need to rely on setting begin manually
                    // See http://gionkunz.github.io/chartist-js/api-documentation.html#chartistsvg-function-animate
                    data.element.animate(animationDefinition, false);
                }
            });

            // For the sake of the example we update the chart every time it's created with a delay of 8 seconds
            chart.on('created', function () {
                if (window.__anim21278907124) {
                    clearTimeout(window.__anim21278907124);
                    window.__anim21278907124 = null;
                }
                window.__anim21278907124 = setTimeout(chart.update.bind(chart), 15000);
            });


        });

    }
    profitShare();
    //== Revenue Change.
    //** Based on Morris plugin - http://morrisjs.github.io/morris.js/


    var serviceProvider = function () {
        if ($('#service_provider_chart').length == 0) {
            return;
        }
        ajaxRequest({
            url: 'service_provider/chart'
        }, function (response) {
            var chartData = response.data;
            applicationchartdata = [];
            $.each(chartData, function (idx, value) {
                if (idx != 3) {

                    applicationchartdata[idx] = value
                }
            });
            var appchart = Morris.Donut({
                element: 'service_provider_chart',
                data: applicationchartdata,
                colors: [
                    mUtil.getColor('warning'),
                    mUtil.getColor('success'),
                    mUtil.getColor('metal')
                ],
            });
            appchart.select(0);

            // $('#totalApplication').text("Total Applications :" + chartData[3].value);
        });
    }
    serviceProvider();

    //== Daily Sales chart.
    //** Based on Chartjs plugin - http://www.chartjs.org/
    var dailySales = function () {
        var chartContainer = $('#m_chart_daily_sales');

        if (chartContainer.length == 0) {
            return;
        }
        ajaxRequest({
            url: 'invoice/chart'
        }, function (response) {
            var responsedata = response.data;


            var chartData = {
                labels: responsedata.label,
                datasets: [{
                    //label: 'Dataset 1',
                    backgroundColor: mUtil.getColor('success'),
                    data: responsedata.amount
                }, {
                    //label: 'Dataset 2',
                    backgroundColor: '#f3f3fb',
                    data: responsedata.amount
                }]
            };

            var chart = new Chart(chartContainer, {
                type: 'bar',
                data: chartData,
                options: {
                    title: {
                        display: false,
                    },
                    tooltips: {
                        intersect: false,
                        mode: 'nearest',
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    legend: {
                        display: false
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    barRadius: 4,
                    scales: {
                        xAxes: [{
                            display: false,
                            gridLines: false,
                            stacked: true
                        }],
                        yAxes: [{
                            display: false,
                            stacked: true,
                            gridLines: false
                        }]
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    }
                }
            });
        });
    }
    dailySales();
    //== Trends Stats
    var trendsStats = function () {
        if ($('#m_chart_trends_stats').length == 0) {
            return;
        }

        var ctx = document.getElementById("m_chart_trends_stats").getContext("2d");

        var config = {
            type: 'line',
            data: {
                labels: [
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April"
                ],
                datasets: [{
                    label: "Sales Stats",
                    backgroundColor: '#d2f5f9', // Put the gradient here as a fill color
                    borderColor: mUtil.getColor('brand'),

                    pointBackgroundColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointHoverBackgroundColor: mUtil.getColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.2).rgbString(),

                    //fill: 'start',
                    data: [
                        20, 10, 18, 15, 32, 18, 15, 22, 8, 6,
                        12, 13, 10, 18, 14, 24, 16, 12, 19, 21,
                        16, 14, 24, 21, 13, 15, 27, 29, 21, 11,
                        14, 19, 21, 17
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                hover: {
                    mode: 'index'
                },
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.19
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 5,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
    }

    //== Trends Stats 2.
    var trendsStats2 = function () {
        if ($('#m_chart_trends_stats_2').length == 0) {
            return;
        }

        var ctx = document.getElementById("m_chart_trends_stats_2").getContext("2d");

        var config = {
            type: 'line',
            data: {
                labels: [
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
                    "January", "February", "March", "April"
                ],
                datasets: [{
                    label: "Sales Stats",
                    backgroundColor: '#d2f5f9', // Put the gradient here as a fill color
                    borderColor: mUtil.getColor('brand'),

                    pointBackgroundColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointBorderColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                    pointHoverBackgroundColor: mUtil.getColor('danger'),
                    pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.2).rgbString(),

                    //fill: 'start',
                    data: [
                        20, 10, 18, 15, 32, 18, 15, 22, 8, 6,
                        12, 13, 10, 18, 14, 24, 16, 12, 19, 21,
                        16, 14, 24, 21, 13, 15, 27, 29, 21, 11,
                        14, 19, 21, 17
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                },
                tooltips: {
                    intersect: false,
                    mode: 'nearest',
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                legend: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                hover: {
                    mode: 'index'
                },
                scales: {
                    xAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                elements: {
                    line: {
                        tension: 0.19
                    },
                    point: {
                        radius: 4,
                        borderWidth: 12
                    }
                },
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 5,
                        bottom: 0
                    }
                }
            }
        };

        var chart = new Chart(ctx, config);
    }

    trendsStats();
    trendsStats2();
}


var stickyParent = "#dashboardItems";
var order = 1;
$(document).off('click', '*[rel=minimizeDiv]').on('click', '*[rel=minimizeDiv]', function (e) {
    e.preventDefault();
    var self = $(this),
        div = self.attr("data-parent");
    if (div) {
        var list = '<li class="m-nav-sticky__item c-p" rel="maximizeDiv" data-toggle="m-tooltip" title="' + $(div).find('.m-portlet__head-text').html() + '"\
						data-order="' + order + '" data-placement="left" data-original-title="' + $(div).find('.m-portlet__head-text').html() + '">' +
            $(div).find('.m-portlet__head-icon').html() + '</li>';

        $(div).attr("data-order", order).fadeOut("slow", function () {
            $(stickyParent).append(list).hide().fadeIn("slow");
        });
        order++;
    }

});

$(document).off('click', '*[rel=maximizeDiv]').on('click', '*[rel=maximizeDiv]', function (e) {
    e.preventDefault();
    var self = $(this),
        order = self.attr("data-order");
    if (order) {
        $(".m-portlet[data-order=" + order + "]").removeAttr("data-order").fadeIn("slow", function () {
            self.fadeOut("slow").remove();
        });
    }
});




// Load Color Picker

var originalColor = $('body .m-body').css('background-color');
var colorpalette = [
    ["rgb(242, 243, 248)", "rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)",
        "rgb(204, 204, 204)", "rgb(217, 217, 217)", "rgb(255, 255, 255)"],
    ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
        "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"],
    ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)",
        "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)",
        "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)",
        "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)",
        "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)",
        "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
        "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
        "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
        "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)",
        "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]
];

$(".chooseColor").spectrum({
    color: "rgb(242, 243, 248)",
    showInput: true,
    className: "full-spectrum",
    showInitial: true,
    showPalette: true,
    showSelectionPalette: true,
    maxSelectionSize: 10,
    preferredFormat: "hex",
    localStorageKey: "spectrum.chooseColor",
    move: function (color) {
        $('body .m-body').css('background-color', color.toHexString());
    },
    show: function () {
    },
    hide: function () {
        $('body .m-body').css('background-color', originalColor);
    },
    change: function (color) {
        // $("#customColorSaveModal").modal('show');
    },
    palette: colorpalette
});

// Global Background Color
$(document).off('change', 'select[name=global_page_background]').on('change', 'select[name=global_page_background]', function (e) {
    var layout = $(this).val();
    layout = layout.length ? layout.toLowerCase().trim() : false;

    if (layout) {
        switch (layout) {
            case "none":
                $('body').removeClass('lightgray lightyellow darkblue classic pinky');
                break;
            case "lightyellow":
                $('body').removeClass('lightgray darkblue classic pinky').addClass(layout);
                break;
            case "darkblue":
                $('body').removeClass('lightyellow lightgray classic pinky').addClass(layout);
                break;
            case "lightgray":
                $('body').removeClass('darkblue lightyellow classic pinky').addClass(layout);
                break;
            case "classic":
                $('body').removeClass('darkblue lightyellow lightgray pinky').addClass(layout);
                break;
            case "pinky":
                $('body').removeClass('darkblue lightyellow lightgray classic').addClass(layout);
                break;
            default:
                break;
        }
    }
});

// Layout Type
$(document).off('change', 'select[name=layout_type]').on('change', 'select[name=layout_type]', function (e) {
    var layout = $(this).val();
    layout = layout.length ? layout.toLowerCase().trim() : false;

    if (layout) {
        switch (layout) {
            case "fluid":
                $('body').removeClass('m-page--boxed').addClass('m-page--fluid');
                $('.m-container').addClass('m-container--fluid').removeClass('m-container--responsive m-container--xxl custom-response-header');
                break;
            case "boxed":
                $('body').removeClass('m-page--fluid').addClass('m-page--boxed');
                $('.m-container').addClass('m-container--responsive m-container--xxl custom-response-header').removeClass('m-container--fluid');
                break;

            default:
                toastr.error('Setting Not Found');
                break;
        }
    }
});

// Page Background
$(document).off('change', 'select[name=page_background]').on('change', 'select[name=page_background]', function (e) {
    var content_skin = $(this).val();
    content_skin = content_skin.length ? content_skin.toLowerCase().trim() : false;

    if (content_skin) {
        switch (content_skin) {
            case "light":
                $('body').removeClass('m-content--skin-light2').addClass('m-content--skin-light');

                break;
            case "lightgray":
                $('body').removeClass('m-content--skin-light').addClass('m-content--skin-light2');
                break;

            default:
                toastr.error('Setting Not Found');
                break;
        }
    }
});


// Desktop Fixed Header
$(document).off('change', 'input[name=desktop_fixed_header]')
    .on('change', 'input[name=desktop_fixed_header]', function (e) {
        if ($(this).prop('checked')) {
            $('body').addClass('m-header--fixed').removeClass('m-header--static');
        } else {
            $('body').addClass('m-header--static').removeClass('m-header--fixed');
        }
    });

// Desktop Header Minimize Mode
$(document).off('change', 'select[name=desktop_header_minimize_mode]')
    .on('change', 'select[name=desktop_header_minimize_mode]', function (e) {
        var content_skin = $(this).val();
        content_skin = content_skin.length ? content_skin.toLowerCase().trim() : false;

        if (content_skin) {
            switch (content_skin) {
                case "hide":
                    $('body').addClass('m-header--show');

                    break;
                case "none":
                    $('body').removeClass('m-header--show');
                    break;

                default:
                    toastr.error('Setting Not Found');
                    break;
            }
        }
    });


// Mobile Fixed header
$(document).off('change', 'input[name=mobile_fixed_header]')
    .on('change', 'input[name=mobile_fixed_header]', function (e) {
        if ($(this).prop('checked')) {
            $('body').addClass('m-header--fixed-mobile');
        } else {
            $('body').removeClass('m-header--fixed-mobile');
        }
    });


// Display Header Menu
$(document).off('change', 'input[name=display_header_menu]').on('change', 'input[name=display_header_menu]', function (e) {
    if ($(this).prop('checked')) {
        $('.m-header-menu ul li:not(:first-child)').removeClass('hidden');
    } else {
        $('.m-header-menu ul li:not(:first-child)').addClass('hidden');
    }
});


// Display Dropdown Skin(Desktop)
$(document).off('change', 'select[name=dropdown_skin]').on('change', 'select[name=dropdown_skin]', function (e) {
    var submenu_dropDown_menu = $(this).val() && $(this).val().length ? $(this).val().toLowerCase().trim() : false;

    if (submenu_dropDown_menu) {
        switch (submenu_dropDown_menu) {
            case "light":
                $('.m-header-menu').removeClass('m-header-menu--submenu-skin-dark');
                break;

            case "dark":
                $('.m-header-menu').addClass('m-header-menu--submenu-skin-dark');
                break;

            default:
                toastr.error('Setting Not Found');
                break;
        }
    }
});


// Display Submenu Arrow
$(document).off('change', 'input[name=display_submenu_arrow]')
    .on('change', 'input[name=display_submenu_arrow]', function (e) {
        if ($(this).prop('checked')) {
            $('.m-menu__nav').addClass('m-menu__nav--submenu-arrow');
        } else {
            $('.m-menu__nav').removeClass('m-menu__nav--submenu-arrow');
        }
    });


// Display Aside Skin(Desktop)
$(document).off('change', 'select[name=aside_skin]')
    .on('change', 'select[name=aside_skin]', function (e) {
        var submenu_dropDown_menu = $(this).val() && $(this).val().length ? $(this).val().toLowerCase().trim() : false;

        if (submenu_dropDown_menu) {
            switch (submenu_dropDown_menu) {
                case "light":
                    $('header .m-stack__item').addClass('m-brand--skin-light').removeClass('m-brand--skin-dark');
                    $('#m_aside_left').addClass('m-aside-left--skin-light').removeClass('m-aside-left--skin-dark');
                    break;

                case "dark":
                    $('header .m-stack__item').addClass('m-brand--skin-dark').removeClass('m-brand--skin-light');
                    $('#m_aside_left').addClass('m-aside-left--skin-dark').removeClass('m-aside-left--skin-light');
                    break;

                default:
                    toastr.error('Setting Not Found');
                    break;
            }
        }
    });


// Fixed Aside
$(document).off('change', 'input[name=fixed_aside]').on('change', 'input[name=fixed_aside]', function (e) {
    if ($(this).prop('checked')) {
        $('body').addClass('m-aside-left--fixed');
    } else {
        $('body').removeClass('m-aside-left--fixed');
    }
});


// Allow Aside Minimizing
$(document).off('change', 'input[name=allow_aside_minimizing]').on('change', 'input[name=allow_aside_minimizing]', function (e) {
    if ($(this).prop('checked')) {

        // If Default Aside is hidden, show it
        if ($('[name="default_hidden_aside"]').prop('checked')) {
            $('[name="default_hidden_aside"]').trigger('click');
        }

        $('body').addClass('m-brand--minimize m-aside-left--minimize m-scroll-top--shown hideMenuText');
        $('.showAsideText').addClass('show');
    } else {
        $('body').removeClass('m-brand--minimize m-aside-left--minimize m-scroll-top--shown hideMenuText');
        $('.showAsideText').removeClass('show');
    }
});

$(document).off('change', 'input[name = "global_font_size"]').on('change', 'input[name = "global_font_size"]', function(e){

    e.preventDefault();

    // let previousFs = $(this).data('previous-fs');

    // console.log(previousFs, $(this).val())
    

    $(document).find('.global--fs').removeClass(`gfs--${previousFs}`).addClass(`gfs--${$(this).val()}`);

});

// Header Aside Menu Text Toggler
$(document).off('click', '.showAsideText').on('click', '.showAsideText', function (e) {
    e.preventDefault();
    minimizeAsideMenu(true);
});

function minimizeAsideMenu(triggerAjax) {
    $('input[name=allow_aside_minimizing]').prop('checked', false);
    $('body').removeClass('m-brand--minimize m-aside-left--minimize m-scroll-top--shown hideMenuText');
    $('.showAsideText').removeClass('show');

    // Trigger Submit Button Of Layout Form
    if (triggerAjax) {
        $('[name=builder_submit]').trigger('click');
    }
}


// Default Hidden Aside
$(document).off('change', 'input[name=default_hidden_aside]').on('change', 'input[name=default_hidden_aside]', function (e) {
    if ($(this).prop('checked')) {

        // Check Aside is minimized or not
        if ($('[name="allow_aside_minimizing"]').prop('checked')) {
            $('[name="allow_aside_minimizing"]').trigger('click');
        }

        $('body').addClass('m-aside-left--hide');
    } else {
        $('body').removeClass('m-aside-left--hide');
    }
});


// Fixed Footer
$(document).off('change', 'input[name=fixed_footer]').on('change', 'input[name=fixed_footer]', function (e) {
    if ($(this).prop('checked')) {
        $('body').addClass('m-footer--fixed');
    } else {
        $('body').removeClass('m-footer--fixed');
    }
});

/**
 * Submit New Setting
 */
$(document).off('submit', '#layout_builder_form').on('submit', '#layout_builder_form', function (e) {
    e.preventDefault();
    var ajaxOptions = {
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        form: 'layout_builder_form'
    }

    addFormLoader();
    ajaxRequest(ajaxOptions, function (response) {
        removeFormLoader();
        toastr.success("Setting Updated");
        if (window.location) {
            window.location.reload();
        }
    });
});

$(document).off('change', 'input[name=EmailMode]').on('change', 'input[name=EmailMode]', function (e) {
    e.preventDefault();
    var request = {
        url: '/sitesetting/change/email',
        method: 'get'
    }
    ajaxRequest(request, function (data) {
        console.log(data);
    })
});
$(document).off('change', 'input[name=applicationMode]').on('change', 'input[name=applicationMode]', function (e) {
    e.preventDefault();
    var request = {
        url: '/sitesetting/change/application_citizen_add_mode',
        method: 'get'
    }
    ajaxRequest(request, function (data) {
        // console.log(data);
    })
});
$(document).off('change', '*[rel=changeMode]').on('change', '*[rel=changeMode]', function (e) {
    e.preventDefault();
    var code = $(this).data('code');
    var request = {
        url: '/sitesetting/change/' + code,
        method: 'get'
    };
    ajaxRequest(request, function (data) {
        // console.log(data);
    });
});
$(document).off('change', '*[rel=changeNotification]').on('change', '*[rel=changeNotification]', function (e) {
    e.preventDefault();
    var code = $(this).data('code');
    var request = {
        url: '/sitesetting/notification/' + code,
        method: 'get'
    };
    ajaxRequest(request, function (data) {
        toastr.success("Settings Updated Successfully");
        if (window.location) {
            window.location.reload();
        }
    });
});
$(document).off('change', '*[rel=mailChange]').on('change', '*[rel=mailChange]', function (e) {
    e.preventDefault();
    var code = $(this).data('code');
    var request = {
        url: '/sitesetting/mailchange/' + code,
        method: 'get'
    };
    ajaxRequest(request, function (data) {
        // console.log(data);
    })
});


// Dropzone configuration
Dropzone.autoDiscover = false;

function loadIETable(dataQuery='') {
    var appOpenData = [{name: $('#applicationIDFilter').attr('name'), value: $('#applicationIDFilter').val()}, {name: $('#applicationSourceFiltertest').attr('name'), value: $('#applicationSourceFiltertest').val()}, {name: $('#applicationStatusFilter').attr('name'), value: $('#applicationStatusFilter').val()}];
    var ieTable = $('#applicationTable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/application/all',
                    method: 'POST',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    params: {
                        // custom parameters
                        query: {
                            // 'status': [
                            //     'New', 'Pending', 'Review',
                            // ],
                        }
                    },
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
            afterTemplate: function (row, data, index) {
                $('tbody .m-datatable__row').first().addClass('active_row');
            },
        },

        // columns definition
        columns: [
            {
                field: 'created_at',
                title: 'Date',
                sortable: 'desc',
                width: 80,
                template: function (row) {
                    return moment(row.created_at).format(std.config.date_format);
                }
            },
            {
                field: 'id',
                title: 'ID',
                width: 80,
                template: function (row) {
                    if (std.config.alt_id == 'true' && row.alt_id) {
                        return 'IE' + row.alt_id.toString().padStart(5, '0');
                    }
                    return row.id;
                }
            },

            {
                field: 'org_id',
                title: 'Type',
                sortable: true,
                width: 50,
                template: function (row) {
                    if (row.org_id) {
                        if (row.org_id != row.providerId)
                            return 'Rescue';
                        else
                            return 'NP';
                    }
                    else {
                        return 'IE';
                    }

                }
            },
            {
                field: 'fname',
                title: 'Owner/Care Taker',
                sortable: false,
                width: 190,
                template: function (row) {
                    if (row.fname == null) {
                        return '';
                    }
                    if (row.mname != null)
                        return row.fname.ucfirst() + ' ' + row.mname.ucfirst() + ' ' + row.lname.ucfirst();
                    else
                        return row.fname.ucfirst() + ' ' + row.lname.ucfirst();
                },
            },
            {
                field: 'no_of_pet',
                title: 'Total Pets',
                width: 80
            },
            {
                field: 'service_provider',
                title: 'Service Provider',
                sortable: false,
                width: 200,
                template: function (row) {
                    if (row.service_provider == null)
                        return '<span class="m-badge m-badge--danger m-badge--wide c-p">Not assigned</span>';

                    else
                        return row.service_provider.ucfirst();
                }
            },
            {
                field: 'inv_amt',
                title: 'Inv Amt.',
                sortable: false,
                width: 100,
                textAlign: 'right',
                template: function (row) {
                    if (row.inv_amt)
                        return '$' + row.inv_amt.toFixed(2);
                    else
                        return '';
                }
            },
            {
                field: 'status',
                title: 'Status',
                width: 140,
                template: function (row) {
                    if (!row.status) {
                        return '<span class="m-badge  m-badge--info m-badge--wide c-p">New</span>';
                    }
                    if (row.status == 'New') {
                        var type = 'm-badge--info newStatus';

                    } else if (row.status == 'Pending') {
                        var type = 'm-badge--warning';
                    } else if (row.status == 'Approved') {
                        var type = 'm-badge--success';
                    } else if (row.status == 'Invoiced') {
                        var type = 'm-badge--warning';
                    }else if (row.status == 'Review') {
                        var type = 'm-badge--primary';
                    }
                    else {
                        var type = 'm-badge--danger';
                    }
                    return '<span class="m-badge ' + type + ' m-badge--wide c-p">' + row.status + '</span>';

                }
            },
            {
                field: 'source',
                title: 'Source',
                width: 100,
                template: function (row) {
                    if (row.source) {
                        return '<h6>' + row.source + '</h6>'
                    }
                    return '';
                },
            },
            {
                field: 'action',
                title: 'Action',
                width: 80,
                template: function (row) {
                    var btn = '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" \
                            data-route="application/' + row.id + '" title="View Application">' +
                        '<i class="la la-eye"></i>' +
                        '</button>';

                    if(row.source && (row.source=='FixedAndFab' || row.source=='WebSite' || row.source=='FF') && row.is_provider_view!=1)
                    {
                        btn+='&nbsp;<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" ' +
                            'data-modal-title=" Delete Application" data-modal-route="/application/delete/'+row.id+'" data-modal-type="delete">' +
                            '<i class="la la-trash"></i></button>'
                    }

                    return btn;
                },
            },]
    });

    ieTable.on('m-datatable--on-init', function (e) {
        $('.newStatus').closest('tr').addClass('newStatus');
    });

    $('#applicationIDFilter').on('blur', function(e){
        ieTable.search($(this).val(), 'applicationID');
        appOpenData.splice(0, 1, {name: 'applicationID', value: $(this).val()});
        setCookie('application_open',JSON.stringify(appOpenData));
    });

    $('#applicationSourceFiltertest').off('change').on('change', function () {
        $('#applicationStatusFilter_advance').selectpicker('val',$(this).val());
        $(this).selectpicker('val',$(this).val());
        ieTable.search($(this).val(), 'source');
        appOpenData.splice(1, 1,{name: 'source', value: $(this).val()});
        setCookie('application_open',JSON.stringify(appOpenData));
    });

    $('#applicationStatusFilter').off('change').on('change', function () {
        $(this).selectpicker('val',$(this).val());
        $('#applicationStatusFilter_advance').selectpicker('val',$(this).val());
        ieTable.search($(this).val(), 'status');
        appOpenData.splice(2, 1, {name: 'status', value: $(this).val()});
        setCookie('application_open',JSON.stringify(appOpenData));
    });

    $('#applicationStatusFilter_advance').off('change').on('change', function () {
        $(this).selectpicker('val',$(this).val());
        $('#applicationStatusFilter').selectpicker('val',$(this).val());
    });

    $('#applicationTypeFilter').off('change').on('change', function () {
        ieTable.search($(this).val(), 'type');
        appOpenData.push({name: $(this).attr('name'), value: $(this).val()});
        setCookie('application_open',JSON.stringify(appOpenData));
        $(this).selectpicker('val', $(this).val());
    });

    $('#applicationSsnFilter').off('blur').on('blur', function () {
        ieTable.search($(this).val(), 'ssn');
    });
    $('#applicationDateFilter').off('blur').on('blur', function () {
        ieTable.search($(this).val(), 'dateRange');
    });
    $('#m_application_date_filter').on('apply.daterangepicker', function (ev, picker) {
        var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
        ieTable.search(dateRange, 'dateRange');
    });

    $(document).off('click', '.submitAppFilter').on('click', '.submitAppFilter', function (e) {
        var id = $(this).attr('data-target');
        data = $('#'+id).serializeArray();
        setCookie('application',JSON.stringify(data));
        ieTable.search(data, 'advancedFilter');
        $('#showApplicationAdvanceSearch').trigger('click');
    });

    $(document).off('click', '#appQuickButton').on('click', '#appQuickButton', function (e) {
        var id = $(this).attr('data-target');
        data = $('#'+id).serializeArray();
        ieTable.search(data, 'advancedFilter');
    });

}


//== Class definition
var ApplicationWizard = function () {
    //== Base elements
    var applicationAddWizard = $('#applicationAddWizard');
    var formEl = $('#applicationForm');
    var validator;
    var applicationWizard = '';

    applicationWizard = $('#applicationAddWizard').mWizard({
        startStep: 1
    });
    applicationWizard.goFirst();


    var prevStep = applicationWizard.currentStep;
    var errors = "";
    //== Validation before going to next page
    applicationWizard.on('beforeNext', function (applicationWizard) {
        ajaxRequest({
            url: "/application/getApplicationValidation",
            method: formEl.attr("method"),
            form: 'applicationForm'
        }, function (response) {
            processForm(response);
        });
    });

    //== Change event
    applicationWizard.on('change', function (applicationWizard) {

        mApp.scrollTop();
        if ($("#legalName") && $("#legalName").val().length) {
            $('.application-form-summary-list').removeClass('hidden');
            $(".eligiliblity").removeClass('hidden');
        }

        if (applicationWizard.currentStep == 1) {
            $("#petSummaryList").addClass('hidden');
            $(".application-form-summary-list").addClass('hidden');
        }

        // Owner Eligilibily
        if (applicationWizard.currentStep == 2) {
            $('#commLists').html('');
            $.each($('input.getComunicationPreference[data-checked]'), function (index, val) {
                var val = '<span title="' + $(this).next('p').text() + '" class="m-list-search__result-item m-list-search__result-item-text d-b lh-26 summary-line-overflow">' +
                    '<i class="la la-check fs-12"></i> &nbsp;' + $(this).next('p').text() + '</span>';
                $('#commLists').append(val);
            });


            $("#petSummaryList").addClass('hidden');
            $('.compunicationPerferencesLists').removeClass('hidden');
            $(".eligiliblity").addClass('hidden');
            if ($("#legalName") && $("#legalName").val().length) {
                $('#app_summary_header').text($("#legalName").val());
                $('#clientEmail').removeClass('m-widget4__sub');
                $('#clientEmail').addClass('m-list-search__result-item m-list-search__result-item-text d-b lh-26 summary-line-overflow');
                $('#clientEmail').text($("input[rel=personal_email]").val());
            }
        }

        /**
         * 1. Pet Validation Process begin at this step
         * 2. List Pet on Summary
         */
        if (applicationWizard.currentStep == 4) {

            /**
             * Get Pet Details
             */

            var petInfoHtml = '';
            $('#applicationCreateModal .petInformation[id!=""]').each(function (index, element) {
                var petName = $(this).find('.petName').text();
                var breed = $(this).find('.breeds').clone().children()
                    .remove()
                    .end()
                    .text().trim();
                var species = $(this).find('.species').clone().children()
                    .remove()
                    .end()
                    .text().trim();
                petInfoHtml += '<li class="decimal-list-style">' + petName + ' / ' + species + ' / ' + breed + '</li>';
            });

            $("#petSummaryList").removeClass('hidden').find('ul').html(petInfoHtml);

            /**
             * Pet Validation
             */
            $('#onlyForPetValidation').addClass('pet_validation');
            $(document).off('click', '.pet_validation').on('click', '.pet_validation', function (applicationWizard) {
                //validation for pet
                ajaxRequest({
                    cancelPrevious: true,
                    url: "/application/getPetValidation",
                    method: formEl.attr("method"),
                    form: 'applicationForm'
                }, function (response) {
                    processForm(response);
                });
            });
        }
        else {
            $('#onlyForPetValidation').removeClass('pet_validation');
        }
    });
    $(document).off('click', "#applicationAddWizard [data-wizard-target='#m_wizard_form_step_4']").on('click', "#applicationAddWizard [data-wizard-target='#m_wizard_form_step_4']", function (applicationWizard) {
        //validation for pet
        ajaxRequest({
            cancelPrevious: true,
            url: "/application/getPetValidation",
            method: formEl.attr("method"),
            form: 'applicationForm'
        }, function (response) {
            processForm(response);
        });
    });
    $(document).off('click', "#applicationAddWizard [data-wizard-target='#m_wizard_form_step_5']").on('click', "#applicationAddWizard [data-wizard-target='#m_wizard_form_step_5']", function (applicationWizard) {
        //validation for pet
        ajaxRequest({
            cancelPrevious: true,
            url: "/application/getPetValidation",
            method: formEl.attr("method"),
            form: 'applicationForm'
        }, function (response) {
            processForm(response);
        });
    });
};

/**
 * Application DataTable
 */
var ApplicationTable = function () {

    var applicationDataTable = function (id) {
        var datatable = $('#application_datatable').mDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/application/pets/' + id,
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

            search: {
                input: $('#generalSearch'),
            },

            rows: {
                // auto hide columns, if rows overflow
                autoHide: false,
            },

            // columns definition
            columns: [
                {
                    field: 'pet_name',
                    title: 'Pet Name',

                },

                {
                    field: 'species',
                    title: 'species',
                },
                {
                    field: 'breed',
                    title: 'Breed',
                },
                {
                    field: 'color',
                    title: 'Color',
                },

                {
                    field: 'action',
                    title: 'Action',
                    width: 130,
                    sortable: false,
                    template: function (row) {
                        return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"' +
                            ' onclick=showModal("/pet/edit/' + row.id + '")>' +
                            '<i class="fa fa-edit"></i>' +
                            '</button> &nbsp;' +
                            ' <button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"' +
                            ' onclick=showModal("/pet/delete/' + row.id + '")>' +
                            '<i class="fa fa-trash"></i>' +
                            '</button>';
                    },
                },
            ]
        });

    };

    return {
        // public functions
        init: function (id) {
            applicationDataTable(id);
        },
    };
}();

/**
 * Application Input Mask
 */
$("input[name=cell_phone], input[name=alt_phone], input[name=phone]").inputmask("mask", {
    "mask": "(999) 999-9999"
});


/**
 * application pet species bredd lookup change
 */
$(document).off('change', '.speciesName').on('change', '.speciesName', function () {
    $('.breed').attr('data-lookup', '/breed/getPetData/' + $(this).val())
});

/**
 * Modal Event
 */
$(document).off('click', '#SubmitPet').on('click', '#SubmitPet', function (e) {
    var data = arrangeData(['client', 'pet', 'application']);
    var request = {
        url: '/application/store',
        method: 'post',
        data: data
    };
    ajaxRequest(request, function (response) {
        processForm(response, function () {
            reloadDatatable('.m_datatable');
        });
    });
});

/**
 * Application Form
 */


var applicationForm = "applicationForm";

$(document).off('keypress', 'input[name=vol_ssn]').on('keypress', 'input[name=vol_ssn]', function (e) {
    if ($(this).val().length > 7) {
        e.preventDefault();
    }
});

/**
 * Comunication Preferences Focus
 */
$(document).off('focusin', '.getComunicationPreference').on('focusin', '.getComunicationPreference', function (e) {
    $('.showFocus').removeClass('showFocus');
    $(this).siblings('span').addClass('showFocus');
    $(this).closest('.m-portlet').css({
        'margin': -1,
        'border': '1px solid #36a3f7'
    });
});

$(document).off('focusout', '.getComunicationPreference').on('focusout', '.getComunicationPreference', function (e) {
    $('.showFocus').removeClass('showFocus');
    $(this).closest('.m-portlet').removeAttr('style');
});

/**
 * Comunication Preferences Focus
 */
$(document).off('focusin', '.eligibilityFocus').on('focusin', '.eligibilityFocus', function (e) {
    $('.showFocus').removeClass('showFocus');
    $(this).siblings('span').addClass('showFocus');
    $(this).closest('.m-portlet').css({
        'margin': '15px -1px -1px -1px',
        'border': '1px solid #36a3f7'
    });
});

$(document).off('focusout', '.eligibilityFocus').on('focusout', '.eligibilityFocus', function (e) {
    $('.showFocus').removeClass('showFocus');
    $(this).closest('.m-portlet').removeAttr('style');
});


/**
 * Client Summary Events
 */
var checked_pref = [];
var index_pref = 0;
$(document).off('change', 'input.getComunicationPreference').on('change', 'input.getComunicationPreference', function (e) {
    var self = $(this);

    if (!$('.getComunicationPreference[data-checked]').length) {
        checked_pref = [];
    }

    if (self.prop('checked')) {

        self.val(1);
        if (!checked_pref['comunication_preferences']) {
            checked_pref['comunication_preferences'] = [];
        }

        self.attr('data-checked', index_pref);

        var t = '<span title="' + self.next('p').text() + '" class="m-list-search__result-item m-list-search__result-item-text d-b lh-26 summary-line-overflow">' +
            '<i class="la la-check fs-12"></i> &nbsp;' + self.next('p').text() + '</span>';
        checked_pref['comunication_preferences'][index_pref] = t;
        index_pref++;

    } else {
        if (checked_pref['comunication_preferences'] && self.attr('data-checked')) {
            self.val(0);
            delete checked_pref['comunication_preferences'][self.attr('data-checked')];
            self.removeAttr('data-checked');
        }
    }

    /**
     * Append Check list
     */
    if (checked_pref) {
        if (typeof checked_pref["comunication_preferences"] !== undefined) {
            $("#commLists").html("");
            $.each(checked_pref["comunication_preferences"], function (index, val) {
                $("#commLists").append(val);
            });
        }
    }
});


/**
 * Prevent Form Submitting on Enter
 * @type {[type]}
 */
$(document).off('keypress', '#' + applicationForm).on('keypress', '#' + applicationForm, function (e) {
    var keyCode = e.keyCode || e.which;
    if (e.keyCode == 13) {
        e.preventDefault();
    }
});


/*
 * Application Form Create For Client
 */
$(document).off('submit', '#' + applicationForm).on('submit', '#' + applicationForm, function (e) {
    e.preventDefault();
    var self = this;
    var data = arrangeData(['client', 'pet', 'application', 'file', 'survey']);
    // Add loader
    addFormLoader();
    ajaxRequest({
        url: self.action,
        method: self.method,
        form: applicationForm
    }, function (response) {
        processForm(response, function () {
            removeFormLoader();

            /**
             * After Inserted Successfully Reset Form
             */
            if (response && response.status === 200) {
                $("#commLists, #federalLists, #stateLists").html('');
                $('#applicationCreateModal .application-form-summary-list').addClass('hidden');
                $('#applicationCreateModal .dynamicShownImages').remove();
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

                $('#applicationCreateModal .fileDetail').html(initFileUploadInfo);
                $("#extraUploadSection").nextAll().remove();

                /**
                 * Remove Selected SP
                 */
                $('#SP_ID').val('');
                $('#NearBySpHolder .selectSp').text('Select').removeClass('text-success btn-success').addClass('btn-secondary');
                $('#NearBySpHolder .m-widget4__title').removeClass('text-success');
                $('#applicationForm input[data-checked]').val(0).removeAttr('data-checked');

                // Reset Selected Sp
                $(".serviceProviderL").val('').trigger('keyup');
                $('#loadSelectedSpNp').empty();
                $('.selectedServiceProviderVetHolder').addClass('hidden');

                // Remove Dynamic Pet
                $('#newPet_Template_Append_Citizan').html('');
                document.getElementById(applicationForm).reset();
                // reloadDatatable('.m_datatable');
                $('#applicationCreateModal').modal('hide');
                if (response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('app_id')) {
                    routes.executeRoute('application/{id}', {
                        url: 'application/' + response.data[0].element.app_id
                    });
                }
            }
        });
    });
});

/*
    Application create form for NP
 */
$(document).off('submit', '#applicationNpForm').on('submit', '#applicationNpForm', function (e) {
    e.preventDefault();
    var self = this;
    var data = arrangeData(['client', 'pet', 'application', 'file']);

    // Add loader
    addFormLoader();

    ajaxRequest({
        url: self.action,
        method: self.method,
        form: 'applicationNpForm'
    }, function (response) {
        processForm(response, function () {
            removeFormLoader();

            /**
             * After Inserted Successfully Reset Form
             */
            if (response && response.status === 200) {

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

                document.getElementById("applicationNpForm").reset();
                // reloadDatatable('.m_datatable');
                $('#applicationCreateModal').modal('hide');
                if (response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('app_id')) {
                    routes.executeRoute('application/{id}', {
                        url: 'application/' + response.data[0].element.app_id
                    });
                }
            }
        });
    });
});


// $(document).off('blur', '#email').on('blur', '#email', function (e) {
//     var val = $(this).val();
//     if (val) {
//         var request = {
//             url: '/client_detail/' + val,
//             method: 'get'
//         };
//         ajaxRequest(request, function (response) {
//             $('#var_pet_name').css('display', 'block');
//             $.each(response.data, function (i, v) {
//                 $('#' + i).val(v);
//             });
//             $.each(response.data.pets, function (i, v) {
//                 var data = '<li class="petData" data-value="' + v.pet_name + '" data-target="pet_name" data-pet-id="' + v.id + '" onclick="petData(this)">' + v.pet_name + '</li>';
//                 $('#var_pet_name').append(data);
//             });
//         });
//     }
// });

$(document).off('click', '.enable_lookup').on('click', '.enable_lookup', function () {
    $('#var_pet_name').css('display', 'block');
});

function petData(event) {
    var target = $(event).attr('data-target');
    var value = $(event).attr('data-value');
    var pet_id = $(event).attr('data-pet-id');
    $('#' + target).val(value);

    var request = {
        url: '/pet_detail/' + pet_id,
        method: 'get'
    };

    ajaxRequest(request, function (response) {
        $.each(response.data, function (i, val) {
            $('#' + i).val(val);
        });
    });
};

/* ---------------------------
    Add New Pet Accordian
------------------------------*/
var templateId = 2,
    petCount = templateId,
    appendDiv = null,
    const_i = 1;
$(document).off('click', '.addNewPet').on('click', '.addNewPet', function (e) {
    var self = $(this);
    var url = self.data('url');
    var request = {
        url: url + '/' + const_i,
        method: 'get'
    }
    var limit = self.attr('data-number');

    var appendPetOn = "#" + self.prev('.dynamicPetAppendSection').attr('id');

    addFormLoader();
    ajaxRequest(request, function (response) {
        removeFormLoader();
        appendDiv = $(appendPetOn);

        if (appendDiv.find('.m-accordion').length > limit) {
            if (petCount >= limit) {
                petCount = 2;
            }
            return toastr.error('Can\'t add more');
        }

        $(".m-accordion").find('.collapse').removeClass('show');

        /**
         * Append Response
         */
        appendDiv.append(response.data);

        /**
         * Ready Dynamic Accordion
         */
        prepareDynamicAccordion(templateId);

        /**
         * Collapse all accordion and Show Last
         */
        appendDiv.find('.m-accordion:last-of-type').find('.collapse').addClass('show');

        templateId++;
        petCount++;
    });
    const_i++;
});

function prepareDynamicAccordion(templateId) {

    var template = $(".addedPets[data-order=last]");
    if (!template) {
        return console.warn('template not found');
    }

    template.find('.countPets').html(petCount);
    template.find('.m-accordion').attr('id', 'm_pet_accordion_' + templateId);
    template.find('.m-accordion__item-body[data-parent]').attr('data-parent', '#m_pet_accordion_' + templateId);

    // Accordian Header
    var templateHeader = 'm_pet_accordion_item_' + templateId + '_head';
    template.find('.m-accordion__item-head').attr('id', templateHeader);
    template.find('.m-accordion__item-body[aria-labelledby]').attr('aria-labelledby', templateHeader);

    // Accordian Body
    var templateBody = 'm_pet_accordion_item_' + templateId + '_body';
    template.find('.m-accordion__item-body').attr('id', templateBody);
    template.find('#' + templateHeader).attr('href', '#' + templateBody);
    template.removeAttr('data-order');

}

// function reverseOldAccordion(templateId) {

//     var template = $(".addedPets[data-order=last]");
//     if (!template) {
//         return console.warn('template not found');
//     }

//     template.find('.countPets').html('');
//     template.find('.m-accordion').attr('id', '');
//     template.find('.m-accordion__item-body[data-parent]').attr('data-parent', '');

//     // Accordian Header
//     template.find('.m-accordion__item-head').attr('id', '');
//     template.find('.m-accordion__item-body[aria-labelledby]').attr('aria-labelledby', '');

//     // Accordian Body
//     var templateHeader = 'm_pet_accordion_item_' + templateId + '_head';
//     template.find('.m-accordion__item-body').attr('id', '');
//     template.find('#' + templateHeader).attr('href', '');
// }

/**
 * Application Upload Files
 */
function uploadFiles() {

    var dropZoneRef = "#uploadApplicationFile";
    if ($(dropZoneRef).length) {

        var myDropzone_1 = new Dropzone(dropZoneRef, {
            maxFiles: 10
        });

        myDropzone_1.on("complete", function (response) {
        });
    }

}

/**
 * Autosize
 */

function initAutoSize() {
    var autosizeClass = '.autosize';
    autosize($(autosizeClass));
}


/**
 * Set Legal Name
 */
var lastName = 'input[rel=lastName]';

function loadLegalName() {
}

/**
 * UcFirst on Blur of Application add modal
 */




$(document).off('blur', 'input[rel=person_title], input[rel=firstName], input[rel=midName],' + lastName + '')
    .on('blur', 'input[rel=person_title], input[rel=firstName], input[rel=midName],' + lastName + '', function (e) {
        setLegalName();
    });


function setLegalName() {
    if($('input[rel=person_title]').length > 0){
        var title = $('input[rel=person_title]').val().length ? $('input[rel=person_title]').val() + ' ' : '';
    }
    var fname = $('input[rel=firstName]').val().length ? $('input[rel=firstName]').val() + ' ' : '';
    var mname = $('input[rel=midName]').val().length ? $('input[rel=midName]').val() + ' ' : '';
    var lname = $(lastName).val().length ? $(lastName).val() : '';

    $("#legalName").val("");
    if (fname.length) {
        if($('input[rel=person_title]').length > 0){
            var legalName = title + fname + mname + lname;
        }else{
            var legalName = fname + mname + lname;
        }
        $("#legalName").val(legalName);
    }
}


/**
 * Client Summary Events
 */
var checked = [];
var index = 0;
$(document).off('change', 'input.getChecked').on('change', 'input.getChecked', function (e) {
    var self = $(this);

    if (!$('.getChecked[data-checked]').length) {
        checked = [];
    }

    if (self.prop('checked')) {
        self.val(1);
        if (!checked[self.attr('data-title')]) {
            checked[self.attr('data-title')] = [];
        }
        self.attr('data-checked', index);
        var t = '<span title="' + self.next('p').text() + '" class="m-list-search__result-item m-list-search__result-item-text d-b lh-26 summary-line-overflow">' +
            '<i class="la la-check fs-12"></i> &nbsp;' + self.next('p').text() + '</span>';
        checked[self.attr('data-title')][index] = t;
        index++;

    } else {
        if (checked[self.attr('data-title')] && self.attr('data-checked') >= 0) {
            self.val(0);
            delete checked[self.attr('data-title')][self.attr('data-checked')];
            self.removeAttr('data-checked');
        }
    }

    renderCheckedLists(checked);
});

function renderCheckedLists(checked) {
    if (checked) {
        if (typeof checked["State"] !== undefined) {
            $("#stateLists").html("");
            $.each(checked["State"], function (index, val) {
                $("#stateLists").append(val);
            });
        }

        if (typeof checked["Federal"] !== undefined) {
            $("#federalLists").html("");
            $.each(checked["Federal"], function (index, val) {
                $("#federalLists").append(val);
            });
        }
    }
}


/**
 * Pet Events
 * Icons
 * Names
 */
var catIcon = '<i class="m-menu__link-icon socicon-github"></i>',
    dogIcon = '<i class="m-menu__link-icon socicon-zynga"></i>',
    petNameClass = '.petName',
    petIconClass = '.petIcon';

$(document).off('change', 'select[name="species[]"]').on('change', 'select[name="species[]"]', function (e) {
    var self = $(this),
        selected = self.val().trim();

    switch (selected) {
        case 'dog':
            self.closest('.m-accordion__item').find(petIconClass).html(dogIcon);
            break;
        case 'cat':
            self.closest('.m-accordion__item').find(petIconClass).html(catIcon);
            break;
        default:
            break;
    }
});


$(document).off('keyup', '*[name=pet_name]').on('keyup', '*[name=pet_name]', function (e) {
    var self = $(this);
    if (self.val().length) {
        self.closest('.m-accordion__item').find(petNameClass).html(self.val());
    } else {
        self.closest('.m-accordion__item').find(petNameClass).html('Pet');
    }
});


/**
 * Upload Events
 * Application Modal From
 */
var index = 1;
$(document).off('click', '*[rel=getExtraUpload]').on('click', '*[rel=getExtraUpload]', function (e) {
    e.preventDefault();

    if ($(this).attr("data-np") == "true") {
        $("#extraUploadSection").closest('.upload-divider').removeClass('hidden');
        $(this).addClass('m-t-20');
    }

    if ($('.extra-upload').length > 4) {
        return toastr.error('Can\'t add more than 5 upload Section');
    }

    var uploadId = 'upload_' + index;
    var uploadHTML = '<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 m-b-20">\
                        <input type="text" class="form-control form-control-sm m-b-15 extra-upload no-m-left" name="document_name[]" placeholder="Type Your Document Name" value="">\
                        <label class="m-dropzone dropzone ApplicationFiles full-width p-rel" for="' + uploadId + '">\
                        <input type="file" class="hidden uploadApplicationFiles" name="documents[]" id="' + uploadId + '">\
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
                        <button class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeUploadSection" title="Remove">\
                            <i class="flaticon-circle"></i>\
                        </button>\
                    </div>';

    $("#extraUploadSection").after(uploadHTML);

    index++;
});

$(document).off('click', '.removeUploadSection').on('click', '.removeUploadSection', function(e){
    e.preventDefault();
    var self = $(this);
    self.parent().remove();
});

// Select Upload files

var uploadedImages = 1;
$(document).off('change', '.uploadApplicationFiles').on('change', '.uploadApplicationFiles', function (e) {
    e.preventDefault();
    var self = this;
    var name = '';
    var size = '';

    if($(this).hasClass('clear-option')){
        $('.clear-option').show();
    }else if($(this).hasClass('clear-option1')){
        $('.clear-option1').show();
    }

    if (this.files && this.files.length) {
        var img = '<img src="" class="dynamicShownImages" alt="" id="uploadedImage_' + uploadedImages + '">';

        for (var i = 0; i < this.files.length; i++) {
            if ($(self).prev('img')) {
                $(self).prev('img').remove();
            }

            $(img).insertBefore($(self));

            if (this.files[i].type == "image/png" ||
                this.files[i].type == "image/jpeg" ||
                this.files[i].type == "image/gif" ||
                this.files[i].type == "image/x-icon") {

                readURL({
                    input: self,
                    img: $("#uploadedImage_" + uploadedImages)[0]
                });

            } else if (this.files[i].type == "application/pdf") {
                $("#uploadedImage_" + uploadedImages).attr('src', '/assets/images/file-icon/pdf.svg');
            }

            name = this.files[i].name;
            size = this.files[i].size / 1024;

            // 5 MB
            if (size > 5012) {
                $(this).closest('.ApplicationFiles').addClass('error').attr('title', 'Upload max size exceeded');
            } else {
                $(this).closest('.ApplicationFiles').removeClass('error').removeAttr('title');
            }

            $(this).closest('.ApplicationFiles').find('.m-dropzone__msg-title').html(name);
            $(this).closest('.ApplicationFiles').find('.m-dropzone__msg-desc').html('File Size <strong>' + (Math.round(size)) + ' KB </strong>');
        }
        uploadedImages++;
    }
});

$(document).off('click', '*[rel=clearUpload]').on('click', '*[rel=clearUpload]', function(e){
    e.preventDefault();
    $(this).parent().next().next().find('img').remove();
    $(this).parent().next().next().find('.m-dropzone__msg-title').html('Drop a file here or click to upload');
    $(this).parent().next().next().find('.m-dropzone__msg-desc').html('Maximum upload size: <strong> 4.00 MB </strong>');
    $(this).hide();
});

function loadNotes(id) {
    ajaxRequest({
        url: 'notes/application/' + id,
        method: 'get'
    }, function (response) {
        $('#ApplicationNotes').empty();
        $.each(response.data, function (index, value) {
            var markup = '<div class="m-timeline-3__item m-timeline-3__item--info">\n' +
                '                                <span class="m-timeline-3__item-time" style="font-size:10px">' + moment(value.created_at).fromNow() + '</span>\n' +
                '                                <div class="m-timeline-3__item-desc">\n' +
                '\t\t\t\t\t\t\t\t<span class="m-timeline-3__item-text">\n' +
                value.title.ucfirst() +
                '\t\t\t\t\t\t\t\t</span><br>\n' +
                '                                    <span class="m-timeline-3__item-user-name">\n' +
                '\t\t\t\t\t\t\t\t<a href="#" class="m-link m-link--metal m-timeline-3__item-link">\n' +
                value.notes.ucfirst() +
                '\t\t\t\t\t\t\t\t</a>\n' +
                '\t\t\t\t\t\t\t\t</span>\n' +
                '                                </div>\n' +
                '                            </div>';
            $('#ApplicationNotes').append(markup);
        });
    })
}

/**
 * Load Date Filter
 */
function applicationTopDateLoader() {
    var daterangepickerInit = function () {
        if ($('#m_application_date_filter').length == 0) {
            return;
        }

        var picker = $('#m_application_date_filter');
        var start = moment().startOf('year');
        var end = moment().endOf('month');

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
            range = start.format('Y/MM/DD') + ' - ' + end.format('Y/MM/DD');
            $('.data-range-input').val(range);
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

function TopDateLoader(id) {
    var daterangepickerInit = function () {
        if ($(id).length == 0) {
            return;
        }

        var picker = $(id);
        var start = moment().startOf('year');
        var end = moment().endOf('month');

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


var initIE_ServiceProviderDate = function (dateInputId) {
    $("#" + dateInputId).datepicker({
        autoclose: true,
        todayHighlight: true,
    });
};

// var initIE_ServiceProviderEndDate = function (dateInputId) {
//     $("#" + dateInputId).datepicker({
//         autoclose: true,
//         todayHighlight: true,
//     });
// };

var initDatepicker = function () {
    $(".dpicker").datepicker({
        autoclose: true,
        format: 'yyyy/mm/dd',
        todayHighlight: true,
    });
};
var initTimepicker = function () {
    $(".tpicker").timepicker({
        minuteStep: 1,
        defaultTime: "",

    });
};


function citySelected(id,origin) {
    ajaxRequest({
        url: '/zip_code/city/' + id
    }, function (response) {
        if (response && response.data && response.data[0]) {
            $(".floatLabelForm *[name=city]").focus();
            $(".floatLabelForm *[name=city]").val(response.data[0].city);
            $(".floatLabelForm *[name=state]").focus();
            $(".floatLabelForm *[name=state]").val(response.data[0].state);
            $(".floatLabelForm *[name=zip_code]").focus();
            $(".floatLabelForm *[name=zip]").val(response.data[0].zip_code);
            $(".floatLabelForm *[name=zip]").focus();
            $(".floatLabelForm *[name=zip_code]").val(response.data[0].zip_code);
            $(".floatLabelForm *[name=county]").focus();
            $(".floatLabelForm *[name=county]").val(response.data[0].county);
        }
        // $(".floatLabelForm *[name=zip]").focus();
    })
}

function breedInputFnc(id,origin) {
    if(typeof origin!='undefined')
    {
        origin.trigger('input');
    }

}
function tabToTarget(id,origin) {
    var target=origin.attr('data-target');
    $("#applicationForm *[name="+target+"]").focus()
}
/**
 * Service Provider Button SPHolder on Row Click
 */
$(document).off('click', '#SPHolder .m-widget4__item').on('click', '#SPHolder .m-widget4__item', function () {
    $(this).find('.selectSp').trigger('click');
});


function loadServiceProvider(zip) {
    ajaxRequest({
        url: 'application/search/suggestorg',
        data: {
            'zip_code': zip
        }
    }, function (response) {
        if (response.data)
            loadSP(response.data);
    });
}

function loadSP(data) {

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
$(document).off('click', '.selectSp').on('click', '.selectSp', function (e) {

    e.preventDefault();
    e.stopPropagation();
    var text = $(this).text();

    if (text != 'Selected') {

        /**
         * Load Vet
         */
        addFormLoader();

        ajaxRequest({
            url: 'organization/search/vet?provider_id=' + $(this).attr('data-id')
        }, function (response) {

            removeFormLoader();
            if (response.data) {
                $('#loadSelectedSpNp').html('');
                $.each(response.data, function (index, value) {
                    if (value.address != null)
                        add3 = value.address.add1 + '\n' +
                            value.address.add2 + '\n' +
                            value.address.zip.city + ',' + value.address.zip.state + '-' + value.address.zip.zip_code;
                    else
                        add3 = "";
                    var markup = '<div class="m-widget4__item choose-provider full-width">\n' +
                        '<label class="m-radio">\n' +
                        '<input type="radio" class="selectVet" value="' + value.id + '" name="vet_id">\n' +
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
        $(document).find('.selectSp').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(this).text('Selected');
        $(this).addClass('btn-success text-success').removeClass('btn-secondary');
        $(this).parent().siblings().children('.m-widget4__title').addClass('text-success');
    }
    else {
        $(".selectedServiceProviderVetHolder").addClass('hidden');
        $(this).closest('.m-widget4__item').siblings().fadeIn(100);
        $('#SP_ID').val('');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(document).find('.selectSp').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
    }

});

$(document).off('keyup', '.serviceProviderL').on('keyup', '.serviceProviderL', function (e) {
    e.preventDefault();
    ajaxRequest({
        url: "application/search/suggestorg?cname=" + $(this).val(),
        cancelPrevious: true,
    }, function (response) {
        $('#SearchSPText').text('Service Provider');
        loadSP(response.data);
    });
});


/**
 * Init Signature
 */

function initSignature() {
    var canvas = $("#signpad_canvas")[0],
        signaturePad;

    // Adjust canvas coordinate space taking into account pixel ratio,
    // to make it look crisp on mobile devices.
    // This also causes canvas to be cleared.
    function resizeCanvas() {
        // When zoomed out to less than 100%, for some very strange reason,
        // some browsers report devicePixelRatio as less than 1
        // and only part of the canvas is cleared then.
        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
    }

    window.onresize = resizeCanvas;
    resizeCanvas();

    signaturePad = new SignaturePad(canvas);


    $(document).off('click', "*[data-action=clear]").on('click', "*[data-action=clear]", function () {
        signaturePad.clear();
    });

    $(document).off('click', '#saveSig').on('click', '#saveSig', function () {

        $("#signature-pad").addClass('hidden');

        if (!$("input[name=initial_signature_name]").val())
            return toastr.error("Please provide initial name.");

        if (signaturePad.isEmpty()) {
            toastr.error("Please provide signature first.");
        } else {
            $("#signature-pad").removeClass('hidden');
            $("#signatureName").text($("input[name=initial_signature_name]").val());
            $("#signatureImage").attr('src', signaturePad.toDataURL());
            $("#signatureImage").attr('alt', $("input[name=initial_signature_name]").val());
            $(modalConfig.container).modal('hide');
        }
    });
}


/**
 * Table Export
 */

$(document).off('click', '.ietable-export').on('click', '.ietable-export', function (e) {
    e.preventDefault();
    var self = $(this),
        exportType = self.attr("data-export-type");
    if (exportType) {
        $("#applicationTable table").tableExport({
            type: exportType,
            escape: 'false',
            fileName: "ietable",
            ignoreColumn: [9]
        });
    }
});

$(document).off('click', '.app-approve').on('click', '.app-approve', function (e) {

    var sign = $(document).find('#signatureImage').attr('src');
    var signName = $(document).find('#signatureName').text();
    var id = $(this).attr('data-id');

    var request = {
        url: '/application/approve/' + id,
        method: 'post',
        data: {signature: sign, signature_holder: signName},
    };

    showProcess();
    ajaxRequest(request, function (response) {
        clearProcess();
        processForm(response, function () {
            routes.executeRoute('application/{id}', {
                url: 'application/' + id
            });
            $('html, body').stop().animate({scrollTop:0}, 500, 'swing', function() {
            });
        });

    });
});


var approveProcess = null;

function showProcess() {
    $('#contentHolder').append('<div class="text-loader"><div class="loader"></div>\
                                            <div class="process-status">Processing..</div></div>');
    approveProcess = setInterval(function () {
        ajaxRequest({
            url: 'application/approve/getProcess'
        }, function (response) {
            if (response && response.data && response.data.process) {
                $('#contentHolder').find('.text-loader .process-status').animate({
                    opacity: '0'
                }, 500, function () {
                    $(this).text('');
                    $('#contentHolder').find('.text-loader .process-status').animate({
                        opacity: '1'
                    }, 500, function () {
                        $(this).text(response.data.process);
                    });
                });
            }
        });
    }, 3000);
}


function clearProcess() {
    clearInterval(approveProcess);
    $('#contentHolder').remove('.text-loader');
}


$(document).off('click', '.generateInvoice').on('click', '.generateInvoice', function () {
    var id = $(this).attr('data-id');
    var request = {
        url: '/application/generateInvoice/' + id,
        method: 'post',
    };

    addFormLoader();
    ajaxRequest(request, function (response) {
        removeFormLoader();
        processForm(response, function () {
            routes.executeRoute('application/{id}', {
                url: 'application/' + id
            });
        });

    });
});

/*-------------------------------------------Non Profit------------------------------------------------------*/
$(document).off('input', '.nonProfit').on('input', '.nonProfit', function () {
    var imp = $(this).val();
    var request = {
        url: '/application/getNonProfit',
        data: {cname: imp},
        method: 'post',
        cancelPrevious: true
    };
    ajaxRequest(request, function (response) {
        if (imp != "")
            $('#SearchNPText').text('Search Result for ' + imp);
        else
            $('#SearchNPText').html('Choose <abbr title="Non Profit">NP</abbr>');
        $('#NP_ID').val();
        $('#npSearchResultLists').empty().append(response.data);
    });
});

$(document).off('click', '.selectNp').on('click', '.selectNp', function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var text = $(this).text();
    if (text != 'Selected') {
        addFormLoader();
        ajaxRequest({
            url: 'organization/search/vet?provider_id=' + $(this).attr('data-id')
        }, function (response) {
            removeFormLoader();
            if (response.data) {
                $('#loadSelectedNpVets').html('');
                $.each(response.data, function (index, value) {
                    if (value.address != null)
                        add3 = value.address.add1 + '\n' +
                            value.address.add2 + '\n' +
                            value.address.zip.city + ',' + value.address.zip.state + '-' + value.address.zip.zip_code;
                    else
                        add3 = "";
                    var markup = '<div class="m-widget4__item choose-provider full-width">\n' +
                        '<label class="m-radio">\n' +
                        '<input type="radio" class="selectVet" value="' + value.id + '" name="vet_id">\n' +
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
                    $('#loadSelectedNpVets').append(markup);
                });
                $(".selectedNPVetHolder").removeClass('hidden');
            }
        });
        $(this).closest('.m-widget4__item').siblings().fadeOut(100);

        $('#NP_ID').val($(this).attr('data-id'));
        $(document).find('.selectNp').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(this).text('Selected');
        $(this).addClass('btn-success text-success').removeClass('btn-secondary');
        $(this).parent().siblings().children('.m-widget4__title').addClass('text-success');
    }
    else {
        $(".selectedNPVetHolder").addClass('hidden');
        $(this).closest('.m-widget4__item').siblings().fadeIn(100);
        $('#NP_ID').val();
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(document).find('.selectNp').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
    }

});


/*-------------------------------------------Rescue Provider------------------------------------------------------*/
$(document).off('input', '.rescueProvider').on('input', '.rescueProvider', function (e) {
    e.preventDefault();
    var imp = $(this).val();
    ajaxRequest({
        url: "application/search/suggestorg?cname=" + $(this).val(),
        cancelPrevious: true,
    }, function (response) {
        if (imp != "")
            $('#SearchSPRText').text('Search Result for ' + imp);
        else
            $('#SearchSPRText').html('Choose Provider');

        $('#SPR_ID').val();

        loadSPR(response.data);
    });
});

function loadSPR(data) {

    var add3;
    $('#sprSearchResultLists').empty();
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
            '                                    <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary selectSpr" data-id="' + value.id + '">\n' +
            '                                        Select\n' +
            '                                    </a>\n' +
            '                                </div>\n' +
            '                            </div>';
        $('#sprSearchResultLists').append(markup);
        if (data.length) {
            $('#sprSearchResults').removeClass('hidden');
            $('#sprSearchResults').show();
        }
        else {
            $('#sprSearchResults').hide();
            $('#sprSearchResults').addClass('hidden');
        }
    });
}

$(document).off('click', '.selectSpr').on('click', '.selectSpr', function (e) {

    e.preventDefault();
    e.stopPropagation();
    var text = $(this).text();

    if (text != 'Selected') {

        /**
         * Load Vet
         */
        addFormLoader();

        ajaxRequest({
            url: 'organization/search/vet?provider_id=' + $(this).attr('data-id')
        }, function (response) {

            removeFormLoader();
            if (response.data) {
                $('#loadSelectedSprVets').html('');
                $.each(response.data, function (index, value) {
                    if (value.address != null)
                        add3 = value.address.add1 + '\n' +
                            value.address.add2 + '\n' +
                            value.address.zip.city + ',' + value.address.zip.state + '-' + value.address.zip.zip_code;
                    else
                        add3 = "";
                    var markup = '<div class="m-widget4__item choose-provider full-width">\n' +
                        '<label class="m-radio">\n' +
                        '<input type="radio" class="selectVet" value="' + value.id + '" name="vet_id">\n' +
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
                    $('#loadSelectedSprVets').append(markup);
                });
                $(".selectedSprVetHolder").removeClass('hidden');
            }
        });

        $(this).closest('.m-widget4__item').siblings().fadeOut(100);

        $('#SPR_ID').val($(this).attr('data-id'));
        $(document).find('.selectSpr').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(this).text('Selected');
        $(this).addClass('btn-success text-success').removeClass('btn-secondary');
        $(this).parent().siblings().children('.m-widget4__title').addClass('text-success');
    }
    else {
        $(".selectedServiceProviderVetHolder").addClass('hidden');
        $(this).closest('.m-widget4__item').siblings().fadeIn(100);
        $('#SP_ID').val('');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(document).find('.selectSpr').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
    }

});

/*-------------------------------------------Rescu------------------------------------------------------*/
$(document).off('input', '.rescue').on('input', '.rescue', function (e) {
    e.preventDefault();
    var imp = $(this).val();
    ajaxRequest({
        url: "application/search/rescue?cname=" + $(this).val(),
        cancelPrevious: true,
    }, function (response) {
        if (imp != "")
            $('#SearchRescueText').text('Search Result for ' + imp);
        else
            $('#SearchRescueText').html('Choose Rescue');

        $('#rescue_ID').val();

        loadRescue(response.data);
    });
});

function loadRescue(data) {

    var add3;
    $('#rescueSearchResultLists').empty();
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
            '                                    <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary selectRescue" data-id="' + value.id + '">\n' +
            '                                        Select\n' +
            '                                    </a>\n' +
            '                                </div>\n' +
            '                            </div>';
        $('#rescueSearchResultLists').append(markup);
        if (data.length) {
            $('#rescueSearchResults').removeClass('hidden');
            $('#rescueSearchResults').show();
        }
        else {
            $('#rescueSearchResults').hide();
            $('#rescueSearchResults').addClass('hidden');
        }
    });
}

$(document).off('click', '.selectRescue').on('click', '.selectRescue', function (e) {

    e.preventDefault();
    e.stopPropagation();
    var text = $(this).text();

    if (text != 'Selected') {

        $(this).closest('.m-widget4__item').siblings().fadeOut(100);

        $('#rescue_ID').val($(this).attr('data-id'));
        $(document).find('.selectRescue').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(this).text('Selected');
        $(this).addClass('btn-success text-success').removeClass('btn-secondary');
        $(this).parent().siblings().children('.m-widget4__title').addClass('text-success');
    }
    else {
        $(this).closest('.m-widget4__item').siblings().fadeIn(100);
        $('#rescue_ID').val('');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(document).find('.selectRescue').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
    }
});


// $(document).off('blur','input[rel=personal_email]').on('blur','input[rel=personal_email]',function () {
//     var email=$(this).val();
//     var request = {
//         url: '/checkClientEmail?email='+email,
//         method: 'get',
//         cancelPrevious: true
//     };
//     ajaxRequest(request,function (response) {
//         var data=response.data;
//         if(data)
//         {
//            replaceValue(data);
//         }

//     });
// });

// function replaceValue(data) {
//     $('input[name=title]').val(data.title);
//     $('input[name=fname]').val(data.fname);
//     $('input[name=mname]').val(data.mname);
//     $('input[name=lname]').val(data.lname);
//     $('input[name=dob]').val(data.dob);
//     var legalname='';
//     if(data.mname)
//         legalname=data.title+' '+data.fname+' '+data.mname+' '+data.lname;
//     else
//         legalname=data.title+' '+data.fname+' '+data.lname;

//     $('input[name=legalName]').val(legalname);
//     $('input[name=add1]').val(data.address.add1);
//     $('input[name=add2]').val(data.address.add2);
//     $('input[name=city]').val(data.address.zip.city);
//     $('input[name=state]').val(data.address.zip.state);
//     $('input[name=zip]').val(data.address.zip.zip_code);

//     $('input[name=cell_phone]').val(data.contact.cell_phone);
//     $('input[name=alt_phone]').val(data.contact.alt_phone);

// }


$('.refreshApp').off('click').on('click', function () {
    routes.executeRoute('application/{id}', {
        url: 'application/{{$application->id}}'
    });
});

/**
 * Invoice Edit Options
 */
var amountUnit = '$';
$(document).off('click', '.changeAmount').on('click', '.changeAmount', function (e) {
    var amount = $(this).text().numval();

    if (amount) {
        var edit = '<input type="number" name="amount" class="change-amount-input" value="' + amount + '">';
        removePrevEditAmount();
        $(this).html(edit);
    }
});

function removePrevEditAmount() {
    var editAmountInput = $('.change-amount-input');
    if (editAmountInput) {
        editAmountInput.each(function (index, element) {
            if (index > (editAmountInput.length - 1)) return;
            var val = amountUnit + $(element).val();
            $(element).replaceWith(val);
        });
    }
}

function refreshInvoiceTotal() {
    var t = 0;
    $(".parent").find('.rowAmountTotal').each(function (index, element) {
        if (typeof $(element).text().numval() !== "undefined") {
            t += $(element).text().numval();
        }
    });
    $("#invoice-total").find('.netInvoiceTotal').text(t);
}

var rowTotal = 0;
$(document).off('input blur', '.change-amount-input').on('input blur', '.change-amount-input', function (e) {
    var self = $(this);

    var parent = self.closest('tr').attr('data-parent-id');

    if (parent) {
        rowTotal = self.val().numval();
        $('*[data-parent-id=' + parent + ']').find('.changeAmount').each(function (index, element) {
            if (typeof $(element).text().numval() !== "undefined") {
                rowTotal += $(element).text().numval();
            }
        });
        $('#' + parent).find('.rowAmountTotal').text(amountUnit + rowTotal);
        refreshInvoiceTotal();

    }

    if (e.type == "focusout") {
        self.replaceWith(amountUnit + self.val());
    }
});


/**
 * Jump To Process
 */

$(document).off('click', ".jumpToProcess").on('click', ".jumpToProcess", function (e) {
    e.preventDefault();
    if ($(".next_step").length) {
        $('html, body').animate({
            scrollTop: ($(".next_step").offset().top - 90)
        }, 600);
    }
});


/**
 * Edit Eligilibility
 */



$(document).off('click', '#editEligibility').on('click', '#editEligibility', function (e) {
    var self = $(this),
        form = self.attr('data-target'),
        requestURL = self.attr('data-url');

    var request = {
        url: requestURL,
        method: 'post',
        form: form
    };

    ajaxRequest(request, function (response) {
        processForm(response, function () {
            reloadDatatable('.m_datatable');

            // If Application Detail refresh partial dom
            if ($("#applicantDetail").length) {
                routes.executeRoute('application/{id}', {
                    url: 'application/' + (document.param ? document.param : '')
                });
            }
        });
    });
});


function loadCitizanModalJs() {
    initIE_ServiceProviderDate("aplicationClientDob");
    BootstrapSelect.init();
    ApplicationWizard();
    initAutoSize();
    loadNpPets();
    loadLegalName();
    uploadFiles();
}

/**
 * ------------------------------------------------
 * Application Add
 * On blur Event for focus on : save and continue
 * -----------------------------------------------
 */

var inputs = 'input[name="alt_phone"], input[name="is_vad"], textarea[name="where_obtained[]"]';
$(document).off('focusout', inputs).on('focusout', inputs, function (e) {
    $('*[data-wizard-action="next"]').focus();
});


/**
 * Clear Aplication From
 */

$(document).off('click', '.clearApplicationForm').on('click', '.clearApplicationForm', function () {
    $("#commLists, #federalLists, #stateLists").html('');
    $('#applicationCreateModal .application-form-summary-list').addClass('hidden');
    $('#applicationCreateModal .dynamicShownImages').remove();
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

    $('#applicationCreateModal .fileDetail').html(initFileUploadInfo);
    $("#extraUploadSection").nextAll().remove();

    /**
     * Remove Selected SP
     */
    $('#SP_ID').val('');
    $('#NearBySpHolder .selectSp').text('Select').removeClass('text-success btn-success').addClass('btn-secondary');
    $('#NearBySpHolder .m-widget4__title').removeClass('text-success');
    $('#applicationForm input[data-checked]').val(0).removeAttr('data-checked');

    // Reset Selected Sp
    $(".serviceProviderL").val('').trigger('keyup');
    $('#loadSelectedSpNp').empty();
    $('.selectedServiceProviderVetHolder').addClass('hidden');

    // Remove Dynamic Pet
    $('#newPet_Template_Append_Citizan').html('');
});


/**
 * Clear Np Form
 */

$(document).off('click', '.clearNpApplicationForm').on('click', '.clearNpApplicationForm', function () {
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
});
$(document).off('click', '.server-applicationexporter').on('click', '.server-applicationexporter', function (e) {
    var exporttype = $(this).attr('data-export-type');
    var url = 'application/report/' + exporttype + '?';
    var data = $('#ApplicationFilter').serialize() + '&' + $('#ApplicationQuickSearch').serialize();
    window.open(url + data);
});


/*---------------------------------------Draft Js------------------------------*/
$(document).off('click', '.saveDraft').on('click', '.saveDraft', function (e) {
    e.preventDefault();
    var section = $(this).attr('data-target');
    var data = $('.' + section).serializeArray();
    if(data[0] && data[0].value != ''){

        var modal_url = '/draft/saveConfirm/' + section;
        var parent = $(this).closest('.modal.show').attr('data-modal-id');
        ++modalId;
        showModal(modal_url, {
            relation: "child",
            parentId: parent,
        });

        $('.modal.show[data-modal-id=' + parent + ']').modal('hide');
    }
});

function checkData() {

}




// $('.loadDraft').on('click',function (e) {
//    e.preventDefault();
//     var section=$(this).attr('data-target');
//
//     var modal_url='/draft/load/'+section;
//     var parent = $(this).closest('.modal.show').attr('data-modal-id');
//     ++modalId;
//     showModal(modal_url, {
//         relation: "child",
//         parentId: parent,
//     });
//
//     $('.modal.show[data-modal-id='+parent+']').modal('hide');
// });
//== Class definition
var RescueApplicationWizard = function () {
    //== Base elements
    var rescueAppWizard = $('#rescueAppWizard');
    var formEl = $('#rescueAddForm');
    var validator;
    var applicationRescueWizard = '';

    applicationRescueWizard = $('#rescueAppWizard').mWizard({
        startStep: 1
    });
    applicationRescueWizard.goFirst();
    initAutoSize();
    uploadFiles();
    //== Validation before going to next page
    applicationRescueWizard.on('beforeNext', function (applicationRescueWizard) {
        ajaxRequest({
            url: "/application/getPetValidation",
            method: formEl.attr("method"),
            form: 'rescueAddForm'
        }, function (response) {
            processForm(response);
        });
    });
};

/*
    Application create form for NP From Service Provider Login
 */
$(document).off('submit', '#rescueAddForm').on('submit', '#rescueAddForm', function (e) {
    e.preventDefault();
    var self = this;
    var data = arrangeData(['pet', 'application', 'file']);

    // Add loader
    addFormLoader();

    ajaxRequest({
        url: self.action,
        method: self.method,
        form: 'rescueAddForm'
    }, function (response) {
        processForm(response, function () {
            removeFormLoader();

            /**
             * File Upload Section
             */
            document.getElementById("rescueAddForm").reset();
            // reloadDatatable('.m_datatable');
            if(response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('app_id')){
                routes.executeRoute('application/{id}', {
                    url: 'application/'+response.data[0].element.app_id
                });
            }
        });
    });
});

var rescue_i = 1;
$(document).off('click', '.addNewPetRescue').on('click', '.addNewPetRescue', function(e){
    var self = $(this);
    if(rescue_i < 5){
        var accordionLength=$('#newPet_Template_Append_Rescue').children().length;
        rescue_i=accordionLength+1;
        addFormLoader();
        ajaxRequest(
        {
            url: 'rescueAddTreatments/'+rescue_i,
            method: 'get'
        }, function(response){
            $(".m-accordion").find('.collapse').removeClass('show');
            $('#newPet_Template_Append_Rescue').append(response.data);
        });
        rescue_i++;
    }else{
         return toastr.error('Can\'t add more than 5 pets');
    }
});
$(document).off('click','.removeAccordion').on('click','.removeAccordion', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).closest('.m-accordion').remove();
    rescue_i = rescue_i-1;
});
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

//== Class definition
var ApplicationCitizenWizard = function () {
    //== Base elements
    var applicationAddWizard = $('#applicationAddPage');
    var formEl = $('#applicationFormCitizen');
    var validator;
    var applicationWizard = '';

    applicationWizard = $('#applicationAddPage').mWizard({
        startStep: 1
    });
    applicationWizard.goFirst();


    var prevStep = applicationWizard.currentStep;
    var errors = "";
    //== Validation before going to next page
    applicationWizard.on('beforeNext', function (applicationWizard) {
        ajaxRequest({
            url: "/application/getApplicationValidation",
            method: formEl.attr("method"),
            form: 'applicationFormCitizen'
        }, function (response) {
            processFormPage(response);
        });
    });

    //== Change event
    applicationWizard.on('change', function (applicationWizard) {

        mApp.scrollTop();
        if ($("#legalName") && $("#legalName").val().length) {
            $('.application-form-summary-list').removeClass('hidden');
            $(".eligiliblity").removeClass('hidden');
        }

        if (applicationWizard.currentStep == 1){
            $("#petSummaryList").addClass('hidden');
            $(".application-form-summary-list").addClass('hidden');
        }

        // Owner Eligilibily
        if (applicationWizard.currentStep == 2) {
            $("#petSummaryList").addClass('hidden');
            $('.compunicationPerferencesLists').removeClass('hidden');
            $(".eligiliblity").addClass('hidden');
            if ($("#legalName") && $("#legalName").val().length) {
                $('#app_summary_header').text($("#legalName").val());
                $('#clientEmail').text($("input[rel=personal_email]").val());
            }
        }

        /**
         * 1. Pet Validation Process begin at this step
         * 2. List Pet on Summary
         */
        if (applicationWizard.currentStep == 4) {

            /**
             * Get Pet Details
             */

            var petInfoHtml = '';
            $('#contentHolder .petInformation[id!=""]').each(function(index, element){
                var petName = $(this).find('.petName').text();
                var breed   = $(this).find('.breeds').clone().children()
                                .remove()
                                .end()
                                .text().trim();
                var species = $(this).find('.species').clone().children()
                                .remove()
                                .end()
                                .text().trim();
                petInfoHtml += '<li class="decimal-list-style">'+petName+' / '+breed+' / '+species+'</li>';
            });

            $("#petSummaryList").removeClass('hidden').find('ul').html(petInfoHtml);

            /**
             * Pet Validation
             */
            $('#onlyForPetCitizenValidation').addClass('pet_validation');
            $(document).off('click', '.pet_validation').on('click', '.pet_validation', function (applicationWizard) {
                //validation for pet
                ajaxRequest({
                    cancelPrevious: true,
                    url: "/application/getPetValidation",
                    method: formEl.attr("method"),
                    form: 'applicationFormCitizen'
                }, function (response) {
                    processFormPage(response);
                });
            });

        }
        else{
            $('#onlyForPetCitizenValidation').removeClass('pet_validation');
        }

        $(document).off('click', "#applicationAddPage [data-wizard-target='#m_wizard_form_step_4']").on('click', "#applicationAddPage [data-wizard-target='#m_wizard_form_step_4']", function (applicationWizard) {
                //validation for pet
                ajaxRequest({
                    cancelPrevious: true,
                    url: "/application/getPetValidation",
                    method: formEl.attr("method"),
                    form: 'applicationFormCitizen'
                }, function (response) {
                    processFormPage(response);
                });
            });
        $(document).off('click', "#applicationAddPage [data-wizard-target='#m_wizard_form_step_5']").on('click', "#applicationAddPage [data-wizard-target='#m_wizard_form_step_5']", function (applicationWizard) {
                //validation for pet
                ajaxRequest({
                    cancelPrevious: true,
                    url: "/application/getPetValidation",
                    method: formEl.attr("method"),
                    form: 'applicationFormCitizen'
                }, function (response) {
                    processFormPage(response);
                });
            });
    });
};

/**
     * Prevent Form Submitting on Enter
     * @type {[type]}
     */
$(document).off('keypress', '#applicationFormCitizen').on('keypress', '#applicationFormCitizen', function (e) {
    var keyCode = e.keyCode || e.which;
    if(e.keyCode == 13){
        e.preventDefault();
    }
});

function citySelectedCitizen(id) {
    ajaxRequest({
        url: '/zip_code/city/' + id
    }, function (response) {
        if (response && response.data && response.data[0]) {
            $("#applicationFormCitizen *[name=state]").val(response.data[0].state);
            $("#applicationFormCitizen *[name=zip]").val(response.data[0].zip_code);
        }
    })
}

/*
 * Application Form Create For Client
 */
$(document).off('submit', '#applicationFormCitizen').on('submit', '#applicationFormCitizen', function (e) {
    e.preventDefault();
    var self = this;
    var data = arrangeData(['client', 'pet', 'application', 'file']);
    // Add loader
    addFormLoader();
    ajaxRequest({
        url: self.action,
        method: self.method,
        form: 'applicationFormCitizen'
    }, function (response) {
        processFormPage(response, function () {
            removeFormLoader();
            /**
             * After Inserted Successfully Reset Form
             */
            if(response && response.status === 200) {
                $("#commLists, #federalLists, #stateLists").html('');
                $('#contentHolder .application-form-summary-list').addClass('hidden');
                $('#contentHolder .dynamicShownImages').remove();
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

                $('#contentHolder .fileDetail').html(initFileUploadInfo);
                $("#extraUploadSection").nextAll().remove();

                /**
                 * Remove Selected SP
                 */
                $('#SP_ID').val('');
                $('#NearBySpHolder .selectSp').text('Select').removeClass('text-success btn-success').addClass('btn-secondary');
                $('#NearBySpHolder .m-widget4__title').removeClass('text-success');
                $('#applicationForm input[data-checked]').val(0).removeAttr('data-checked');

                // Reset Selected Sp
                $(".serviceProviderL").val('').trigger('keyup');
                $('#loadSelectedSpNp').empty();
                $('.selectedServiceProviderVetHolder').addClass('hidden');

                // Remove Dynamic Pet
                $('#newPet_Template_Append_Citizan').html('');
                document.getElementById(applicationForm).reset();
                // reloadDatatable('.m_datatable');
                if(response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('app_id')){
                    routes.executeRoute('application/{id}', {
                        url: 'application/'+response.data[0].element.app_id
                    });
                }
            }
        });
    });
});

/**
 * Upload Events
 * Application Modal From
 */
var index = 1;
$(document).off('click', '#applicationFormCitizen *[rel=getExtraUpload]').on('click', '#applicationFormCitizen *[rel=getExtraUpload]', function (e) {
    e.preventDefault();

    if ($(this).attr("data-np") == "true") {
        $("#applicationFormCitizen #extraUploadSection").closest('.upload-divider').removeClass('hidden');
        $(this).addClass('m-t-20');
    }

    if ($('#applicationFormCitizen .extra-upload').length > 4) {
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

    $("#applicationFormCitizen #extraUploadSection").after(uploadHTML);

    index++;
});

//== Class definition
$(".nonProfit").val('').trigger('input');
var ApplicationNPWizard = function () {
    //== Base elements
    var applicationAddWizard = $('#applicationAddPage');
    var formEl = $('#applicationFormNP');
    var validator;
    var applicationWizard = '';

    applicationWizard = $('#applicationAddPage').mWizard({
        startStep: 1
    });
    applicationWizard.goFirst();


    var prevStep = applicationWizard.currentStep;
    var errors = "";
    //== Validation before going to next page
    $(".nonProfit").val('').trigger('input');
    applicationWizard.goFirst();
    loadNpPets();
    initAutoSize();
    uploadFiles();
    applicationWizard.on('beforeNext', function(applicationWizard){
        //validation for pet
        ajaxRequest({
            cancelPrevious: true,
            url: "/application/getPetValidation",
            method: 'post',
            form: 'applicationFormNP'
        }, function (response) {
            processFormPage(response);
        });
    });
};

/**
     * Prevent Form Submitting on Enter
     * @type {[type]}
     */
$(document).off('keypress', '#applicationFormNP').on('keypress', '#applicationFormNP', function (e) {
    var keyCode = e.keyCode || e.which;
    if(e.keyCode == 13){
        e.preventDefault();
    }
});


/*
 * Application Form Create For Client
 */
$(document).off('submit', '#applicationFormNP').on('submit', '#applicationFormNP', function (e) {
    e.preventDefault();
    var self = this;
    var data = arrangeData(['client', 'pet', 'application', 'file']);
    // Add loader
    addFormLoader();
    ajaxRequest({
        url: self.action,
        method: self.method,
        form: 'applicationFormNP'
    }, function (response) {
        processFormPage(response, function () {
            removeFormLoader();
            /**
             * After Inserted Successfully Reset Form
             */
            if(response && response.status === 200) {

                $("#commLists, #federalLists, #stateLists").html('');
                $('#contentHolder .application-form-summary-list').addClass('hidden');
                $('#contentHolder .dynamicShownImages').remove();
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

                $('#contentHolder .fileDetail').html(initFileUploadInfo);
                $("#extraUploadSection").nextAll().remove();

                /**
                 * Remove Selected SP
                 */
                $('#SP_ID').val('');
                $('#NearBySpHolder .selectSp').text('Select').removeClass('text-success btn-success').addClass('btn-secondary');
                $('#NearBySpHolder .m-widget4__title').removeClass('text-success');
                $('#applicationForm input[data-checked]').val(0).removeAttr('data-checked');

                // Reset Selected Sp
                $(".serviceProviderL").val('').trigger('keyup');
                $('#loadSelectedSpNp').empty();
                $('.selectedServiceProviderVetHolder').addClass('hidden');

                // Remove Dynamic Pet
                $('#newPet_Template_Append_Citizan').html('');
                document.getElementById(applicationForm).reset();
                // reloadDatatable('.m_datatable');
                if(response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('app_id')){
                    routes.executeRoute('application/{id}', {
                        url: 'application/'+response.data[0].element.app_id
                    });
                }
            }
        });
    });
});

/**
 * Upload Events
 * Application Modal From
 */
var index = 1;
$(document).off('click', '#applicationFormNP *[rel=getExtraUpload]').on('click', '#applicationFormNP *[rel=getExtraUpload]', function (e) {
    e.preventDefault();

    if ($(this).attr("data-np") == "true") {
        $("#applicationFormNP #extraUploadSection").closest('.upload-divider').removeClass('hidden');
        $(this).addClass('m-t-20');
    }

    if ($('#applicationFormNP .extra-upload').length > 4) {
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

    $("#applicationFormNP #extraUploadSection").after(uploadHTML);

    index++;
});

/* ---------------------------
    Add New Pet Accordian
------------------------------*/
var const_np_i = 1;
$(document).off('click', '.addNewPetPage').on('click', '.addNewPetPage', function (e) {
    var self = $(this);
    var url = self.data('url');
    if(const_np_i < 5){
        var request = {
            url: url+'/'+const_np_i,
            method: 'get'
        }

        addFormLoader();
        ajaxRequest(request, function (response) {
            removeFormLoader();
            $(".m-accordion").find('.collapse').removeClass('show');
            $('#append_pet_from_page').append(response.data);
        });
        const_np_i++;
    }else{
        return toastr.error('Can\'t add more than 5');
    }
});
$(document).off('click', '.removePetFormPage').on('click', '.removePetFormPage', function(e){
    e.preventDefault();
    e.stopPropagation();
    $(this).closest('.m-accordion').remove();
    const_np_i = const_np_i-1;
})


$(document).off('click', '.selectNpPage').on('click', '.selectNpPage', function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var text = $(this).text();
    if (text != 'Selected') {
        addFormLoader();
        ajaxRequest({
            url: 'organization/search/vet?provider_id=' + $(this).attr('data-id')
        }, function (response) {
            removeFormLoader();
            if (response.data) {
                $('#loadSelectedNpVets').html('');
                $.each(response.data, function (index, value) {
                    if (value.address != null)
                        add3 = value.address.add1 + '\n' +
                            value.address.add2 + '\n' +
                            value.address.zip.city + ',' + value.address.zip.state + '-' + value.address.zip.zip_code;
                    else
                        add3 = "";
                    var markup = '<div class="m-widget4__item choose-provider full-width">\n' +
                        '<label class="m-radio">\n' +
                        '<input type="radio" class="selectVet" value="' + value.id + '" name="vet_id">\n' +
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
                    $('#loadSelectedNpVets').append(markup);
                });
                $(".selectedNPVetHolder").removeClass('hidden');
            }
        });
        $(this).closest('.m-widget4__item').siblings().fadeOut(100);

        $('#NP_ID').val($(this).attr('data-id'));
        $(document).find('.selectNpPage').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(this).text('Selected');
        $(this).addClass('btn-success text-success').removeClass('btn-secondary');
        $(this).parent().siblings().children('.m-widget4__title').addClass('text-success');
    }
    else {
        $(".selectedNPVetHolder").addClass('hidden');
        $(this).closest('.m-widget4__item').siblings().fadeIn(100);
        $('#NP_ID').val();
        $(document).find('.m-widget4__title').removeClass('text-success');
        $(document).find('.selectNpPage').removeClass('btn-success text-success').addClass('btn-secondary').text('select');
    }

});
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

//== Class definition
var NonProfitWizard = function () {
    //== Base elements
    var wizardEl = $('#addNPWizard');
    var formEl = $('#npForm');
    var validator;
    var wizard;


    //== Initialize form wizard
    wizard = wizardEl.mWizard({
        startStep: 1
    });

    //== Validation before going to next page
    wizard.on('beforeNext', function (wizard) {
        ajaxRequest({
            cancelPrevious: true,
            url: "/organization/getOrganizationValidation",
            method: formEl.attr("method"),
            form: 'npForm'
        }, function (response) {
            processFormCustom(response);
        });
    })

    $(document).off('click', "#addNPWizard [data-wizard-target='#m_wizard_form_step_4']").on('click', "#addNPWizard [data-wizard-target='#m_wizard_form_step_4']", function (applicationWizard) {
        //validation for pet
        ajaxRequest({
            cancelPrevious: true,
            url: "/organization/getVetValidation",
            method: formEl.attr("method"),
            form: 'npForm'
        }, function (response) {
            processFormCustom(response);
        });
    });
};

/* ---------------------------
    Add New Vet Accordian
------------------------------*/
var templateId = 2,
    petCount = templateId,
    template = null,
    appendDiv = null;
    provider_i = 1;
$(document).off('click', '#addNewVet').on('click', '#addNewVet', function (e) {

    var self = $(this);
    if(provider_i < 5){
            var request = {
            url: 'organization/addNewVet/'+provider_i,
            method: 'get'
        }

        ajaxRequest(request, function(response){
            appendDiv = $("#m_pet_accordion");

            if (appendDiv.find('.m-accordion').length > 3) {
                if (petCount >= 5) {
                    petCount = 2;
                }
                return toastr.error('Can\'t add more than 5');
            }

            prepareDynamicAccordion(templateId);
            $(".m-accordion").find('.collapse').removeClass('show');
            appendDiv.append(response.data);
            appendDiv.find('.m-accordion:last-of-type').find('.collapse').addClass('show');

            templateId++;
            petCount++;
        });
        provider_i++;
    }else{
        return toastr.error('Can\'t add more than 5');
    }

});

/**
 * Pet Events
 * Icons
 * Names
 */
var catIcon = '<i class="m-menu__link-icon socicon-github"></i>',
    dogIcon = '<i class="m-menu__link-icon socicon-zynga"></i>',
    petNameClass = '.petName',
    petIconClass = '.petIcon';

$(document).off('change', 'select[name=pet_type]').on('change', 'select[name=pet_type]', function (e) {
    var self = $(this),
        selected = self.val().trim();

    switch (selected) {
        case 'dog':
            self.closest('.m-accordion__item').find(petIconClass).html(dogIcon);
            break;
        case 'cat':
            self.closest('.m-accordion__item').find(petIconClass).html(catIcon);
            break;
        default:
            break;
    }
});

/**
 * Application Form
 */
var npForm = "npForm";
$(document).off('submit', '#' + npForm).on('submit', '#' + npForm, function (e) {
    e.preventDefault();
        var self = this;


    addFormLoader();
        ajaxRequest({
            url: self.action,
            method: self.method,
            form: 'npForm'
        }, function (response) {
            removeFormLoader();
            processForm(response, function () {

                // reloadDatatable('.m_datatable');
                $('#modalContainer').modal('hide');
                if(response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('org_id')){
                    routes.executeRoute('org/single/{id}', {
                        url: 'org/single/'+response.data[0].element.org_id
                    });
                }

            });
        });

});


function loadNpPets(id) {
    if (!id) {
        id = 30;
    }
    $('#npPetsTable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/getNpPet/' + id,
                    method: 'GET'
                },
            },
            pageSize: 5,
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
                    pageSizeSelect: [5, 10, 20, 30, 50, 100],
                },
            },
        },

        rows: {
            // auto hide columns, if rows overflow
            autoHide: true,
        },

        layout: {
            theme: 'default',
            class: 'm-datatable--brand',
            scroll: false,
            height: 200,
        },

        // columns definition
        columns: [{
            field: 'ApplicationId',
            title: '#',
            sortable: false,
            width: 40,
            textAlign: 'center',
            selector: {class: 'm-checkbox--solid m-checkbox--brand'},
        },
            {
                field: 'pet_name',
                title: 'Pet Name',
                sortable: 'asc',
                width: 200,
                template: function (data) {
                    return '<div class="m-card-user m-card-user--sm">\
                                <div class="m-card-user__pic">\
                                    <img src="https://www.marshallspetzone.com/blog/wp-content/uploads/2017/01/golden-retriever1.jpg" class="m--img-rounded m--marginless" alt="photo">\
                                </div>\
                                <div class="m-card-user__details">\
                                    <span class="m-card-user__name">' + data.pet_name + '</span>\
                                </div>\
                            </div>';
                }
            },
            {
                field: 'species',
                title: 'Species',
                width: 150
            },
            {
                field: 'breed',
                title: 'Breed',
                width: 150
            },
            {
                field: 'color',
                title: 'Color',
                width: 100
            },
            {
                field: 'weight',
                title: 'Weight',
                template: function (row) {
                    return row.weight + ' KG';
                }
            },
            {
                field: 'age_type',
                title: 'Age Type',
            },
            {
                field: 'age_of_pet',
                title: 'Age',
            },
            {
                field: 'unique_traits',
                title: 'Unique Traits',
            },
            {
                field: 'comments',
                title: 'Comments',
            },
            {
                field: 'fname',
                title: 'Client',
                template: function (row) {
                    return row.title + ' ' + row.fname + ' ' + row.lname;
                },
            }]
    });
}

function orgZipLoaded(id) {
    var zip = $('#zip').val();
    ajaxRequest({
        url: 'zip_code/' + id
    }, function (response) {
        if (response && response.data) {
            $("#npForm *[name=state]").val(response.data.state);
            $("#npForm *[name=zip]").val(response.data.zip_code);
        }
    })
}

/**
 * Set Vet Name
 */
var lastName = 'input[rel=lastName]';


    $(document).off('input', 'input[rel=person_title], input[rel=firstName], input[rel=midName],' + lastName + '')
        .on('input', 'input[rel=person_title], input[rel=firstName], input[rel=midName],' + lastName + '', function (e) {
            setVetName();
    });


$("*[rel=cell_phone], *[rel=alt_phone]").inputmask("mask", {
    "mask": "(999) 999-9999"
});

function setVetName() {
    var title = $('input[rel=person_title]').val().length ? $('input[rel=person_title]').val() + ' ' : '';
    var fname = $('input[rel=firstName]').val().length ? $('input[rel=firstName]').val() + ' ' : '';
    var mname = $('input[rel=midName]').val().length ? $('input[rel=midName]').val() + ' ' : '';
    var lname = $(lastName).val().length ? $(lastName).val() : '';

    $(".vetName").text("");
    if (title.length) {
        var legalName = title + fname + mname + lname;
        $(".vetName").text(legalName);
    }
}

/**
     * Prevent Form Submitting on Enter
     * @type {[type]}
     */
$(document).off('keypress', '#npForm').on('keypress', '#npForm', function (e) {
    var keyCode = e.keyCode || e.which;
    if(e.keyCode == 13){
        e.preventDefault();
    }
});
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

//== Class definition
var RescueWizard = function () {
    //== Base elements
    //== Base elements
    var wizardEl = $('#addRescueWizard');
    var formEl = $('#rescueForm');
    var validator;
    var wizard;


    //== Initialize form wizard
    wizard = wizardEl.mWizard({
        startStep: 1
    });

    //== Validation before going to next page
    wizard.on('beforeNext', function (wizard) {
        ajaxRequest({
            cancelPrevious: true,
            url: "/organization/getRescueValidation",
            method: formEl.attr("method"),
            form: 'rescueForm'
        }, function (response) {
            processFormCustom(response);
        });
    })
};


/**
 * Pet Events
 * Icons
 * Names
 */
var catIcon = '<i class="m-menu__link-icon socicon-github"></i>',
    dogIcon = '<i class="m-menu__link-icon socicon-zynga"></i>',
    petNameClass = '.petName',
    petIconClass = '.petIcon';

$(document).off('change', 'select[name=pet_type]').on('change', 'select[name=pet_type]', function (e) {
    var self = $(this),
        selected = self.val().trim();

    switch (selected) {
        case 'dog':
            self.closest('.m-accordion__item').find(petIconClass).html(dogIcon);
            break;
        case 'cat':
            self.closest('.m-accordion__item').find(petIconClass).html(catIcon);
            break;
        default:
            break;
    }
});

/**
 * Application Form
 */
var rescueForm = "rescueForm";
$(document).off('submit', '#' + rescueForm).on('submit', '#' + rescueForm, function (e) {
    e.preventDefault();
        var self = this;


    addFormLoader();
        ajaxRequest({
            url: self.action,
            method: self.method,
            form: 'rescueForm'
        }, function (response) {
            removeFormLoader();
            processForm(response, function () {

                // reloadDatatable('.m_datatable');
                $('#modalContainer').modal('hide');
                if(response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('org_id')){
                    routes.executeRoute('org/single/{id}', {
                        url: 'org/single/'+response.data[0].element.org_id
                    });
                }

            });
        });

});



function orgZipLoaded(id) {
    var zip = $('#zip').val();
    ajaxRequest({
        url: 'zip_code/' + id
    }, function (response) {
        if (response && response.data) {
            $("#rescueForm *[name=state]").val(response.data.state);
            $("#rescueForm *[name=zip]").val(response.data.zip_code);
        }
    })
}

/**
 * Set Vet Name
 */
var lastName = 'input[rel=lastName]';


    $(document).off('input', 'input[rel=person_title], input[rel=firstName], input[rel=midName],' + lastName + '')
        .on('input', 'input[rel=person_title], input[rel=firstName], input[rel=midName],' + lastName + '', function (e) {
            setVetName();
    });



/**
     * Prevent Form Submitting on Enter
     * @type {[type]}
     */
$(document).off('keypress', '#rescueForm').on('keypress', '#rescueForm', function (e) {
    var keyCode = e.keyCode || e.which;
    if(e.keyCode == 13){
        e.preventDefault();
    }
});
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

var formModal 	= '#addNPPageWizard';
var formDebug 	= true;

function processFormNPPage(formResponse, cb = null) {

	$("#addNPPageWizard").find('.input-required').removeClass('input-required');

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
					if($('*[name="'+name+'\\[\\]"]').closest('label').length) {
						$("#addNPPageWizard").find('*[name="'+name+'\\[\\]"]').closest('label').addClass('input-required');
					}
					$("#addNPPageWizard").find('*[name="'+name+'\\[\\]"]').addClass('input-required');

					var wizard 	= $('*[name="'+name+'\\[\\]"]').closest('.m-wizard__form-step');
					var wizardId = $('*[name="'+name+'\\[\\]"]').closest('.m-wizard').attr("id");
				}
				else{
					if($('*[name='+name+']').closest('label').length) {
						$("#addNPPageWizard").find('*[name='+name+']').closest('label').addClass('input-required');
					}
					$("#addNPPageWizard").find('*[name='+name+']').addClass('input-required');

					var wizard 	= $('*[name='+name+']').closest('.m-wizard__form-step');
					var wizardId = $('*[name='+name+']').closest('.m-wizard').attr("id");
				}


				// $("#addNPPageWizard").find('*[name='+name+']').after('<div class="form-control-feedback text-danger">'+message+'</div>');

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

					if($("#addNPPageWizard *[data-wizard-target='#"+wizard.attr("id")+"']").hasClass('m-wizard__step--done')
							|| $("#addNPPageWizard #"+wizard.attr("id")).find('input, select').hasClass('input-required')) {
						// Trigger Validation
						$('#addNPPageWizard *[data-wizard-target="#'+wizard.attr('id')+'"]').find('a:first-child').trigger('click');
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
            processModalCustomPage(formResponse);
        }
	}

	if(cb)
		cb();
}


function processModalCustomPage(formResponse) {
	if($("#addNPPageWizard").attr('data-parent-modal-id') && $("#addNPPageWizard").attr('data-parent-modal-id') >= 0) {
    	var callback = $("#addNPPageWizard").attr('data-modal-callback') ? $("#addNPPageWizard").attr('data-modal-callback') : false,
    		parentModalId 	= $("#addNPPageWizard").attr('data-parent-modal-id'),
    		modalId 		= $("#addNPPageWizard").attr('data-modal-id');
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
        $("#addNPPageWizard").modal('hide');
    }
}
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

//== Class definition
var NonProfitWizardPage = function () {
    //== Base elements
    var wizardEl = $('#addNPPageWizard');
    var formEl = $('#npForm');
    var validator;
    var wizard;


    //== Initialize form wizard
    wizard = wizardEl.mWizard({
        startStep: 1
    });

    //== Validation before going to next page
    wizard.on('beforeNext', function (wizard) {
        ajaxRequest({
            cancelPrevious: true,
            url: "/organization/getOrganizationValidation",
            method: formEl.attr("method"),
            form: 'npForm'
        }, function (response) {
            processFormNPPage(response);
        });
    })

    //== Change event
    wizard.on('change', function (wizard) {
        mApp.scrollTop();

        // Vets
        if (wizard.currentStep == 3) {
         }

        $('*[rel=getExtraUpload]').removeClass('hidden');
        if (wizard.currentStep == 4) {
            $('*[rel=getExtraUpload]').removeClass('hidden');
            $('#onlyForVetValidation').addClass('vet_validation');
            //== Validation before going to next page
            $(document).off('click', '.vet_validation').on('click', '.vet_validation', function (wizard) {
                //validation for vet
                ajaxRequest({
                    cancelPrevious: true,
                    url: "/organization/getVetValidation",
                    method: formEl.attr("method"),
                    form: 'npForm'
                }, function (response) {
                    processFormCustom(response);
                });
            });
        } else {
            $('#onlyForVetValidation').removeClass('vet_validation');
        }
    });
    $(document).off('click', "#addNPPageWizard [data-wizard-target='#m_wizard_form_step_4']").on('click', "#addNPPageWizard [data-wizard-target='#m_wizard_form_step_4']", function (applicationWizard) {
        //validation for pet
        ajaxRequest({
            cancelPrevious: true,
            url: "/organization/getVetValidation",
            method: formEl.attr("method"),
            form: 'npForm'
        }, function (response) {
            processFormCustom(response);
        });
    });
};

/* ---------------------------
    Add New Vet Accordian
------------------------------*/
var templateId = 2,
    petCount = templateId,
    template = null,
    appendDiv = null;

$(document).off('click', '#addNewVet').on('click', '#addNewVet', function (e) {

    var self = $(this);
    var request = {
        url: 'organization/addNewVet',
        method: 'get'
    }

    ajaxRequest(request, function(response){
        appendDiv = $("#m_pet_accordion");

        if (appendDiv.find('.m-accordion').length > 3) {
            if (petCount >= 5) {
                petCount = 2;
            }
            return toastr.error('Can\'t add more than 5 pets');
        }

        prepareDynamicAccordion(templateId);
        $(".m-accordion").find('.collapse').removeClass('show');
        appendDiv.append(response.data);
        appendDiv.find('.m-accordion:last-of-type').find('.collapse').addClass('show');

        templateId++;
        petCount++;
    });

});

/**
 * Pet Events
 * Icons
 * Names
 */
var catIcon = '<i class="m-menu__link-icon socicon-github"></i>',
    dogIcon = '<i class="m-menu__link-icon socicon-zynga"></i>',
    petNameClass = '.petName',
    petIconClass = '.petIcon';

$(document).off('change', 'select[name=pet_type]').on('change', 'select[name=pet_type]', function (e) {
    var self = $(this),
        selected = self.val().trim();

    switch (selected) {
        case 'dog':
            self.closest('.m-accordion__item').find(petIconClass).html(dogIcon);
            break;
        case 'cat':
            self.closest('.m-accordion__item').find(petIconClass).html(catIcon);
            break;
        default:
            break;
    }
});

/**
 * Application Form
 */
var npForm = "npForm";
$(document).off('submit', '#' + npForm).on('submit', '#' + npForm, function (e) {
    e.preventDefault();
        var self = this;


    addFormLoader();
        ajaxRequest({
            url: self.action,
            method: self.method,
            form: 'npForm'
        }, function (response) {
            removeFormLoader();
            processForm(response, function () {

                // reloadDatatable('.m_datatable');
                $('#modalContainer').modal('hide');
                if(response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('org_id')){
                    routes.executeRoute('org/single/{id}', {
                        url: 'org/single/'+response.data[0].element.org_id
                    });
                }

            });
        });

});


function loadNpPets(id) {
    if (!id) {
        id = 30;
    }
    $('#npPetsTable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/getNpPet/' + id,
                    method: 'GET'
                },
            },
            pageSize: 5,
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
                    pageSizeSelect: [5, 10, 20, 30, 50, 100],
                },
            },
        },

        rows: {
            // auto hide columns, if rows overflow
            autoHide: true,
        },

        layout: {
            theme: 'default',
            class: 'm-datatable--brand',
            scroll: false,
            height: 200,
        },

        // columns definition
        columns: [{
            field: 'ApplicationId',
            title: '#',
            sortable: false,
            width: 40,
            textAlign: 'center',
            selector: {class: 'm-checkbox--solid m-checkbox--brand'},
        },
            {
                field: 'pet_name',
                title: 'Pet Name',
                sortable: 'asc',
                width: 200,
                template: function (data) {
                    return '<div class="m-card-user m-card-user--sm">\
                                <div class="m-card-user__pic">\
                                    <img src="https://www.marshallspetzone.com/blog/wp-content/uploads/2017/01/golden-retriever1.jpg" class="m--img-rounded m--marginless" alt="photo">\
                                </div>\
                                <div class="m-card-user__details">\
                                    <span class="m-card-user__name">' + data.pet_name + '</span>\
                                </div>\
                            </div>';
                }
            },
            {
                field: 'species',
                title: 'Species',
                width: 150
            },
            {
                field: 'breed',
                title: 'Breed',
                width: 150
            },
            {
                field: 'color',
                title: 'Color',
                width: 100
            },
            {
                field: 'weight',
                title: 'Weight',
                template: function (row) {
                    return row.weight + ' KG';
                }
            },
            {
                field: 'age_type',
                title: 'Age Type',
            },
            {
                field: 'age_of_pet',
                title: 'Age',
            },
            {
                field: 'unique_traits',
                title: 'Unique Traits',
            },
            {
                field: 'comments',
                title: 'Comments',
            },
            {
                field: 'fname',
                title: 'Client',
                template: function (row) {
                    return row.title + ' ' + row.fname + ' ' + row.lname;
                },
            }]
    });
}

function orgZipLoaded(id) {
    var zip = $('#zip').val();
    ajaxRequest({
        url: 'zip_code/' + id
    }, function (response) {
        if (response && response.data) {
            $("#npForm *[name=state]").val(response.data.state);
            $("#npForm *[name=zip]").val(response.data.zip_code);
        }
    })
}

/**
 * Set Vet Name
 */
var lastName = 'input[rel=lastName]';


    $(document).off('input', 'input[rel=person_title], input[rel=firstName], input[rel=midName],' + lastName + '')
        .on('input', 'input[rel=person_title], input[rel=firstName], input[rel=midName],' + lastName + '', function (e) {
            setVetName();
    });



function setVetName() {
    var title = $('input[rel=person_title]').val().length ? $('input[rel=person_title]').val() + ' ' : '';
    var fname = $('input[rel=firstName]').val().length ? $('input[rel=firstName]').val() + ' ' : '';
    var mname = $('input[rel=midName]').val().length ? $('input[rel=midName]').val() + ' ' : '';
    var lname = $(lastName).val().length ? $(lastName).val() : '';

    $(".vetName").text("");
    if (title.length) {
        var legalName = title + fname + mname + lname;
        $(".vetName").text(legalName);
    }
}

/**
     * Prevent Form Submitting on Enter
     * @type {[type]}
     */
$(document).off('keypress', '#npForm').on('keypress', '#npForm', function (e) {
    var keyCode = e.keyCode || e.which;
    if(e.keyCode == 13){
        e.preventDefault();
    }
});
//== Class definition
var CitizenWizard = function () {
    //== Base elements
    var applicationAddWizard = $('#clientWizard');
    var formEl = $('#client_applicationForm');
    var validator;
    var applicationWizard = '';

    applicationWizard = $('#clientWizard').mWizard({
        startStep: 1
    });
    applicationWizard.goFirst();


    var prevStep = applicationWizard.currentStep;
    var errors = "";
    //== Validation before going to next page
    applicationWizard.on('beforeNext', function (applicationWizard) {
        ajaxRequest({
            url: "/client_application/getApplicationValidation",
            method: formEl.attr("method"),
            form: 'client_applicationForm'
        }, function (response) {
            processFormCustom(response);
        });
    });

    //== Change event
    applicationWizard.on('change', function (applicationWizard) {

        mApp.scrollTop();

        // Owner Eligilibily
        if (applicationWizard.currentStep == 1) {
            $("#petSummaryList").addClass('hidden');
            $('.compunicationPerferencesLists').removeClass('hidden');
            $(".eligiliblity").addClass('hidden');
        }

        /**
         * 1. Pet Validation Process begin at this step
         * 2. List Pet on Summary
         */
        if (applicationWizard.currentStep == 2) {

            /**
             * Get Pet Details
             */

            var petInfoHtml = '';
            $('#contentHolder .petInformation[id!=""]').each(function(index, element){
                var petName = $(this).find('.petName').text();
                var breed   = $(this).find('.breeds').clone().children()
                                .remove()
                                .end()
                                .text().trim();
                var species = $(this).find('.species').clone().children()
                                .remove()
                                .end()
                                .text().trim();
                petInfoHtml += '<li class="decimal-list-style">'+petName+' / '+breed+' / '+species+'</li>';
            });

            $("#petSummaryList").removeClass('hidden').find('ul').html(petInfoHtml);

        }
        else{
            $('#onlyForPetCitizenValidation').removeClass('pet_validation');
        }

    });
};

/**
     * Prevent Form Submitting on Enter
     * @type {[type]}
     */
$(document).off('keypress', '#client_applicationForm').on('keypress', '#client_applicationForm', function (e) {
    var keyCode = e.keyCode || e.which;
    if(e.keyCode == 13){
        e.preventDefault();
    }
});

/*
 * Application Form Create For Client
 */
$(document).off('submit', '#client_applicationForm').on('submit', '#client_applicationForm', function (e) {
    e.preventDefault();
    var self = this;
    var data = arrangeData(['client', 'pet', 'application', 'file']);
    // Add loader
    addFormLoader();
    ajaxRequest({
        url: self.action,
        method: self.method,
        form: 'client_applicationForm'
    }, function (response) {
        processFormPage(response, function () {
            removeFormLoader();
            /**
             * After Inserted Successfully Reset Form
             */
            if(response && response.status === 200) {
                $("#commLists, #federalLists, #stateLists").html('');
                $('#contentHolder .application-form-summary-list').addClass('hidden');
                $('#contentHolder .dynamicShownImages').remove();
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

                $('#contentHolder .fileDetail').html(initFileUploadInfo);
                $("#extraUploadSection").nextAll().remove();

                /**
                 * Remove Selected SP
                 */
                $('#SP_ID').val('');
                $('#NearBySpHolder .selectSp').text('Select').removeClass('text-success btn-success').addClass('btn-secondary');
                $('#NearBySpHolder .m-widget4__title').removeClass('text-success');
                $('#applicationForm input[data-checked]').val(0).removeAttr('data-checked');

                // Reset Selected Sp
                $(".serviceProviderL").val('').trigger('keyup');
                $('#loadSelectedSpNp').empty();
                $('.selectedServiceProviderVetHolder').addClass('hidden');

                // Remove Dynamic Pet
                $('#newPet_Template_Append_Citizan').html('');
                document.getElementById(applicationForm).reset();
                // reloadDatatable('.m_datatable');
                $('#modalContainer').modal('hide');
                if(response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('app_id')){
                    routes.executeRoute('application/{id}', {
                        url: 'client_applicationSingle/'+response.data[0].element.app_id
                    });
                }
            }
        });
    });
});

/**
 * Upload Events
 * Application Modal From
 */
var index = 1;
$(document).off('click', '#client_applicationForm *[rel=getExtraUpload]').on('click', '#client_applicationForm *[rel=getExtraUpload]', function (e) {
    e.preventDefault();

    if ($(this).attr("data-np") == "true") {
        $("#client_applicationForm #extraUploadSection").closest('.upload-divider').removeClass('hidden');
        $(this).addClass('m-t-20');
    }

    if ($('#client_applicationForm .extra-upload').length > 4) {
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

    $("#client_applicationForm #extraUploadSection").after(uploadHTML);

    index++;
});

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

/* ---------------------------
    Add New Vet Accordian
------------------------------*/
var templateId = 2,
    petCount = templateId,
    template = null,
    appendDiv = null;

$(document).off('click', '#addNewRate').on('click', '#addNewRate', function (e) {

    var self = $(this);

    template = $("#newRate_Template");
    appendDiv = $("#newRate_Template_Append");

    if (appendDiv.find('.m-accordion').length > 3) {
        if (petCount >= 5) {
            petCount = 2;
        }
        return toastr.error('Can\'t add more than 5 pets');
    }

    prepareDynamicAccordion(templateId);
    $(".m-accordion").find('.collapse').removeClass('show');
    appendDiv.append(template.html());
    appendDiv.find('.m-accordion:last-of-type').find('.collapse').addClass('show');

    templateId++;
    petCount++;
});

function pageLoaded() {
    // return;
    var DatatableAutoColumnHideDemo = function () {
        // basic demo
        var demo = function () {
            var datatable = $('#auto_column_hide').mDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '/pages/all',
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

                search: {
                    input: $('#generalSearch'),
                },

                rows: {
                    // auto hide columns, if rows overflow
                    autoHide: false,
                },

                // columns definition
                columns: [
                    {
                        field: 'page_name',
                        title: 'Page',
                        sortable: 'asc'
                    }, {
                        field: 'action',
                        title: 'Action',

                    }, {
                        field: 'a',
                        title: 'Action',
                        sortable: false,
                        template: function (row) {
                            return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route=/pages/edit/' + row.id + '">\
                                    <i class="la la-edit"></i></button> &nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-title="Delete Pages" data-modal-type="delete" data-modal-route=/pages/delete/' + row.id + '">\
                                    <i class="la la-trash"></i></button>';
                        },
                    },]
            });
        };

        return {
            // public functions
            init: function () {
                demo();
            },
        };
    }();

    DatatableAutoColumnHideDemo.init();
}

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

var initIE_VeterinarianDate = function() {
    $("#dob").datepicker({
        autoclose : true,
        format: std.config.date_format
    });
}
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

$(document).off('click', '.printBtn').on('click', '.printBtn', function(e){
    e.preventDefault();
    var file_name = $(this).data('filename');
    var id = $(this).data('id');
    var request = {
        url: 'checkPdfFile/'+id,
        method: 'get',
    }
    ajaxRequest(request, function(response){
        if(response && response.response && response.response.data &&
                response.response.data[0] && response.response.data[0].type == 'error') {
            return;
        }
        else{
            print_certificate(file_name);
        }
    });
});

$(document).off('click', '.bulk_print').on('click', '.bulk_print', function(e){
    if($(this).hasClass('mergePdf')){
        $(this).removeClass('mergePdf');
    }
    else{
        $(this).addClass('mergePdf');
    }
});

$(document).off('click', '#printMergeFile').on('click', '#printMergeFile', function(e){
    e.preventDefault();
    var const_i = 0;
    var data = {};
    $('.mergePdf').each(function(index, value){
        const_i++;
        data['file_id'+const_i] = $(this).data('id');
    });

    if($('.mergePdf').length > 0){
        var request = {
            url: '/getPdfFile',
            method: 'post',
            data: data
        };

        ajaxRequest(request, function(response){
            if(response && response.response && response.response.data &&
                response.response.data[0] && response.response.data[0].type == 'error') {
                return;
            }
            bulk_print(response.data);
        });
    }
    else{
        showModal('notFoundError/Email');
    }
});

$(document).off('click', '.printInvoiceView').on('click', '.printInvoiceView', function(e){
    e.preventDefault();
    var file_name = $(this).data('filename');
    var id = $(this).data('id');
    var request = {
        url: 'checkPdfFile/'+id,
        method: 'get',
    }
    ajaxRequest(request, function(response){
        if(response && response.response && response.response.data &&
                response.response.data[0] && response.response.data[0].type == 'error') {
            return;
        }
        else{
            print_certificate(file_name);
        }
    });
});

function print_certificate(file_name)
{
    printJS('storage/uploads/'+file_name);
}
function bulk_print(file_name)
{

    printJS('bulk_print/'+file_name);
}

$('#applicationTitle').on('change', function(){
    fileTable.search($(this).val(), 'document_title');
});

function objectifyForm(formArray) {

    //serialize data function
    var returnArray = {};
    for (var i = 0; i < formArray.length; i++){
        if(formArray[i]['value']!='' && formArray[i]['value']!=null)
            returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
}

function saveTemplate(target,data,self)
{
    document.templateData=objectifyForm(data);
    var modal_url='/reports/template/view?target='+target;
    var parent = self.closest('.modal.show').attr('data-modal-id');
    ++modalId;
    showModal(modal_url, {
        relation: "child",
        parentId: parent,
    });

    $('.modal.show[data-modal-id='+parent+']').modal('hide');
}

$(document).off('click','.loadReportTemp').on('click','.loadReportTemp',function () {
    var selected=$('.dataTemplate').find('tr:not(:first-child).active_row').data('id');
    if(typeof  selected !=undefined && selected !='')
    {
        loadTemplate(selected)
    }
});

$(document).off('dblclick','.dataTemplate').on('dblclick','.dataTemplate tr:not(:first-child)',function(){
    var selected=$(this).data('id');
    $(this).closest('.modal-body').siblings('.modal-header').find('button.close').trigger('click');
    if(typeof  selected !=undefined && selected !='')
        loadTemplate(selected);
});
function loadTemplate(selected) {
    var request= {
        url: '/reports/template/load?id=' + selected
    };
    ajaxRequest(request,function (response) {
        var data=response.data.key_val;
        data=JSON.parse(data);
        $.each(data,function (key,value) {
            $('input[name='+key+']').val(value);
            $('select[name='+key+']').selectpicker('val', value)
            $('textarea[name='+key+']').val(value)
        })
    });
}

$(document).off('click','.exportReportData').on('click','.exportReportData',function () {
    var format=$(this).attr('data-export-type');
    var target=$(this).attr('data-target');
    var data=$('.reportSearchForm').serialize();

    var url='/report/exportAll/'+target+'/'+format+'?'+data;

    window.open(url);
});
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

$(document).off('click', '.checkAllPet').on('click', '.checkAllPet', function(e){
    var self = $(this);
    if(self.prop('checked')){
        $('.parent_call').each(function(i, v){
            if($(this).hasClass('treatmentChecked')){
                return;
            }
            else{
                $(this).trigger('click');
                $(this).addClass('treatmentChecked');
            }
        });
    }
    else{
        if(!$('.parent_call').hasClass('treatmentChecked')){
            return ;
        }
        $('.parent_call').trigger("click");
    }

});

$(document).off('click', '.parent_call').on('click', '.parent_call', function(e){
    var self = $(this);
    if($('input[type="checkbox"]').prop('checked')){
        self.trigger('click');
        self.removeClass('treatmentChecked');
    }
    else{
        if(self.hasClass('treatmentChecked')){
            self.removeClass('treatmentChecked');
            if($('.checkAllPet').prop('checked')){
                $('.checkAllPet').trigger('click');
            }
        }
        else{
            self.addClass('treatmentChecked');
        }
    }
});


$(document).off('click', '#assign_provider').on('click', '#assign_provider', function(e){
    e.preventDefault();

    if($('.treatmentChecked').length > 0){
        var application_id = $(this).data('application-id');
        var data = [];

        $('.treatmentChecked').each(function(index, value){
            var id = $(this).data('id');
            data.push(id);
        });

        showModal('/pet/assignProvider/'+application_id+'?data='+data);
    }
    else{
        showModal('notFoundError/Pet');
    }
});
//
// $(document).off('click', '.singleTreatment').on('click', '.singleTreatment', function(e){
//     e.preventDefault();
//     var data = [];
//     var application_id = $(this).data('application-id');
//     var id = $(this).data('id');
//     showModal('pet/getTreatment/'+application_id+'/'');
//
// });


/**
 * -------------------------------
 * Pet Input Events For Headning
 * ------------------------------
 */

/**
 * Pet Name
 */
$(document).off('input', '*[name="pet_name[]"]').on('input', '*[name="pet_name[]"]', function(e){
    var self = $(this);
    var petHeader = self.closest('.m-accordion__item').find('.m-accordion__item-head').find('.m-accordion__item-title').find('.petName');
    if(self.val().length) {
        petHeader.text(self.val());
    } else {
        petHeader.text("Pet");
    }
});

/**
 * Species
 */
$(document).off('change', '*[name="species[]"]').on('change', '*[name="species[]"]', function(e){
    var self = $(this);
    var petHeader = self.closest('.m-accordion__item').find('.m-accordion__item-head').find('.m-accordion__item-title');

    if(self.val().length) {
        petHeader.find('.species').remove();
        petHeader.append('<span class="species"> <strong>Species </strong> '+self.val()+'</span>');
    } else {
        petHeader.find('.species').remove();
    }
});

/**
 * Breed
 */
$(document).off('input', '*[name="breed[]"]').on('input', '*[name="breed[]"]', function(e){
    var self = $(this);
    var petHeader = self.closest('.m-accordion__item').find('.m-accordion__item-head').find('.m-accordion__item-title');
    if(self.val().length) {
        petHeader.find('.breeds').remove();
        petHeader.append('<span class="breeds"> <strong>Breed </strong> '+self.val()+'</span>');
    } else {
        petHeader.find('.breeds').remove();
    }
});


var notificationConfig = {
    notificationContainer: 'CustomNotification_events',
    notificationspan: 'NotificationSpan',
    notificationTitle: 'NotificationTitle',
    notificationReminder: 'ReminderSection'
};


function loadNotification() {
    ajaxRequest({
        url: '/notifications',
        method: 'get'
    }, function (response) {
        appendtoNotification(response.data);
    });
}

function appendNotification(notification) {
    emptyNotification();
    $.each(notification, function (index, value) {
        var markup = ' <div class="m-list-timeline__item"> <span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>' +
            '<a data-route="' + value.url + '" class="m-list-timeline__text is_notification" style="cursor: pointer" data-id="' + value.id + '" data-table="' + value.table_name + '" data-tableid="' + value.table_id + '">' + value.message + ' </a>' +
            '<span class="m-list-timeline__time">' + moment(value.created_at).fromNow() + '</span>  ' +
            '</div>';
        $('#' + notificationConfig.notificationContainer).prepend(markup);
    });
}

function appendReminder(reminder) {
    emptyReminder();
    $.each(reminder, function (index, value) {
        var markup = ' <div class="m-list-timeline__item"> <span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>' +
            '<a data-route="' + value.url + '" class="m-list-timeline__text is_notification" style="cursor: pointer" data-id="' + value.id + '" data-table="' + value.table_name + '" data-tableid="' + value.table_id + '">' + value.title + ' </a>' +
            '<span class="m-list-timeline__time">' + moment(value.created_at).fromNow() + '</span>  ' +
            '</div>';
        $('#' + notificationConfig.notificationReminder).prepend(markup);
    });
}

function appendtoNotification(newnotification) {
    if (!newnotification)
        return;

    if (newnotification.hasOwnProperty('notification'))
        appendNotification(newnotification.notification);
    if (newnotification.hasOwnProperty('reminder'))
        appendReminder(newnotification.reminder);
    if (newnotification.hasOwnProperty('total'))
        prepareHeader(newnotification.total);
}

function prepareHeader(total) {
    $("#NotificationSpan").hide();

    if (total) {
        $('#' + notificationConfig.notificationspan).show().html(total);
    }
}


function emptyNotification() {
    $('#' + notificationConfig.notificationContainer).empty();
}

function emptyReminder() {
    $('#' + notificationConfig.notificationReminder).empty();
}

$(document).on('click', '.is_notification', function (e) {
    var id = $(this).attr('data-id');
    var tableid = $(this).attr('data-tableid');
    setCookie('forward_period_id', tableid);
    ajaxRequest({
        url: '/notifications/' + id + '/markAsRead',
        method: 'get'
    }, function (response) {
        loadNotification();
    })
});
loadNotification();
setInterval(function () {
    loadNotification();
}, 60000);


function pinguser() {
    return ajaxRequest({
        url: '/userlog/ping',
        method: 'post'
    }, function (response) {
        if (response.data && response.data.status == 'error') {
            alert(response.data.message);
            location.assign('/');
        }
        return response;
    });
}

var global_ping;
// pinguser().then(({ data: response }) => {
//     response.ping_gap = parseFloat(response.ping_gap) < 3 ? 30 : response.ping_gap;
//     const ping_time = (parseFloat(response.ping_gap) - 1) * 60 * 1000;
//     clearInterval(global_ping);
//     setTimeout(function () {
//         global_ping = setInterval(pinguser, ping_time);
//     }, ping_time);
// });

$(document).on('click', '.markAllAsRead', function () {
    sendAjax('notifications/markAsRead/all', loadNotification);
});


loadTodoList();
$(document).off('blur', '#TodoInputField').on('blur', '#TodoInputField', function (e) {
    if ($(this).val().length) {
        ajaxRequest({
            url: "/note/todo/create",
            method: 'post',
            data: {
                'title': $(this).val()
            }
        }, function (response) {
            loadTodoList();
        });

        $(this).val('');
    }
})

function loadTodoList() {
    var request = {
        url: '/note/todo',
        method: 'get'
    };
    ajaxRequest(request, function (response) {
        appendtolist(response.data);
    })
}

function appendtolist(todos) {
    $('#TodoList').empty();
    if(todos != 'false'){
        if (todos.length) {
            $.each(todos, function (index, value) {
                var todo = ' <div class="m-widget2__item m-widget2__item--primary">\
                                 <div class="m-widget2__checkbox">\
                                    <label class="m-checkbox m-checkbox--solid m-checkbox--single m-checkbox--brand">\
                                     <input type="checkbox" class="todo-checkBox" name="todo-item" data-id="' + value.id + '" title="Mark as Completed">\
                                    <span></span>\
                                    </label>\
                                </div>\
                                <div class="m-widget2__desc">\
                                        <span class="m-widget2__text" ">'
                    + value.title.ucfirst() +
                    '</span><br>\
                    <span class="m-widget2__user-name">\
                    <a href="#" class="m-widget2__link"> ' +
                    moment(value.date).format(std.config.date_format) +
                    '</a>\
                    </span>\
            </div>\
            <div class="m-widget2__actions">\
             <button type="button" class="btn m-btn btn-success doneTodo hidden btn-sm" data-id=' + value.id + '> <i class="fa fa-check"></i> Done</button>\
                                </div>\
                             </div>\
                    <hr/>';
                $('#TodoList').append(todo)

            });
        } else {
            $('#TodoList').html('<p>No To Do available</p>')
        }
    }

}

$(document).on('click', '.doneTodo', function (e) {
    var id = $(this).attr('data-id');
    ajaxRequest({
        url: "todo/completed/"+id,
        method: 'post',
    }, function (response) {
        loadTodoList();
    });
});
/*$(document).on('click', '.todo-checkBox', function (e) {
    if ($(this).prop('checked')) {
        $(this).parent().parent().next().css('text-decoration', 'line-through');
        $('#MarkAsCompleteBtn').attr('disabled', false);
    }
    else {
        $(this).parent().parent().next().css('text-decoration', 'none');

        if (!$('[name="todo-item"]:checked').length) {
            $('#MarkAsCompleteBtn').attr('disabled', true);
        }
    }
});*/
$(document).on('click', '.todo-checkBox', function (e) {
    var btn = $(this).parent().parent().parent().find('.doneTodo');
    if ($(this).prop('checked')) {
        $(this).parent().parent().next().css('text-decoration', 'line-through');
        btn.removeClass('hidden');
    }
    else {
        $(this).parent().parent().next().css('text-decoration', 'none');
        btn.addClass('hidden');

    }
});
var SelectedTodo = [];
$(document).on('click', '#MarkAsCompleteBtn', function () {

    if ($('[name="todo-item"]:checked').length) {
        $('.todo-checkBox').each(function () {
            if ($(this).prop('checked')) {
                SelectedTodo.push($(this).attr('data-id'));
            }
        });
    }
    ajaxRequest({
        url: "todo/completed",
        method: 'post',
        data: SelectedTodo
    }, function (response) {
        loadTodoList();
    });
});



String.prototype.padStart = function padStart(targetLength,padString) {
    targetLength = targetLength>>0; //truncate if number or convert non-number to 0;
    padString = String((typeof padString !== 'undefined' ? padString : ' '));
    if (this.length > targetLength) {
        return String(this);
    }
    else {
        targetLength = targetLength-this.length;
        if (targetLength > padString.length) {
            padString += padString.repeat(targetLength/padString.length); //append to original to ensure we are longer than needed
        }
        return padString.slice(0,targetLength) + String(this);
    }
};
String.prototype.ucfirst = function () {
    return this.charAt(0).toUpperCase() + this.slice(1);
};

Date.prototype.formatDate = function () {
    var date = new Date(this);

    console.log(date);
    // return moment(this).fromNow()
};

$(document).on('change', '.notificationSettings', function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    if ($(this).prop('checked')) {
        $(this).val(1);
    }
    else {
        $(this).val(0);
    }
    var request = {
        url: '/user/settings/store/'+id,
        method: 'post',
        data: {
            code: $(this).attr('name'),
            is_true: $(this).val()
        }
    };
    ajaxRequest(request, function (response) {
    })
});

$(document).on('change', '.communicationSettings', function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    if ($(this).prop('checked')) {
        $(this).val(1);
    }
    else {
        $(this).val(0);
    }
    var request = {
        url: '/user/communicationpefrences/'+id,
        method: 'post',
        data: {
            code: $(this).attr('name'),
            is_true: $(this).val()
        }
    };
    ajaxRequest(request, function (response) {
        console.log(response);
    })
});

function getFileIcon($fileName) {
    var dotPosition = $fileName.lastIndexOf('.');
    var fileExt = $fileName.slice(dotPosition + 1, $fileName.length);
    var name = "";
    switch (fileExt.toLowerCase()) {
        case 'css':
            name = 'css.svg';
            break;
        case 'csv':
            name = 'csv.svg';
            break;
        case 'doc':
        case 'docx':
            name = 'doc.svg';
            break;
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            name = 'jpg.svg';
            break;
        case 'json':
            name = 'json.svg';
            break;
        case 'html':
            name = 'html.svg';
            break;
        case 'js':
            name = 'javascript.svg';
            break;
        case 'pdf':
            name = 'pdf.svg';
            break;
        case 'txt':
            name = 'txt.svg';
            break;
        case 'xml':
            name = 'xml.svg';
            break;
        case 'zip':
            name = 'zip.svg';
            break;
        default:
            name = 'file.svg'
    }
    return name;

}

function getFileExtensionColor($fileName) {
    var dotPosition = $fileName.lastIndexOf('.');
    var fileExt = $fileName.slice(dotPosition + 1, $fileName.length);
    var name = "";
    switch (fileExt.toLowerCase()) {
        case 'css':
            name = '';
            break;
        case 'csv':
            name = 'm--font-info';
            break;
        case 'doc':
        case 'docx':
            name = '';
            break;
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            name = '';
            break;
        case 'json':
            name = 'm--font-brand';
            break;
        case 'html':
            name = '';
            break;
        case 'js':
            name = '';
            break;
        case 'pdf':
            name = 'm--font-danger';
            break;
        case 'txt':
            name = 'm--font-success';
            break;
        case 'xml':
            name = '';
            break;
        case 'zip':
            name = '';
            break;
        default:
            name = ''
    }
    return name;
}

function escapeHtml(text) {
    var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;',
        "/":'&sol;'
    };

    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}
/**
 * Function to set cookie
 *
 * @param cname
 * @param cvalue
 * @param exTime
 * @createdBy SHIVA THAPA
 */
function setCookie(cname, cvalue, exTime = 86400) {
    var d = new Date();
    d.setTime(d.getTime() + (exTime*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

/**
 * Function to get cookie Value
 *
 * @param cname
 * @createdBy SHIVA THAPA
 */
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

/**
 * Function to load data from cookie
 *
 * @param cname
 * @param btnName
 * @createdBy SHIVA THAPA
 */
function loadCookie(cname,btnName, getTo=false) {
    var id=$(btnName).attr('data-target');
    var data = getCookie(cname);
    if(data)
    {
        data = JSON.parse(data);
        var form=$('#'+id);
        $.each(data,function (key,val) {
            if(getTo ==true){
                if(val.name == 'status'){
                    return val.value;
                }
            }else{
                if(val.name.indexOf('[]')>-1)
                {

                    let name=val.name.replace('[]','');
                    if (!name) return 1;
                    form.find('input[name^="'+name+'"]').val(val.value);
                    form.find('select[name^="'+name+'"]').selectpicker('val', val.value);
                    form.find('textarea[name^="'+name+'"]').val(val.value);
                }
                else
                {
                    if (!val.name) return 1;
                    form.find('input[name="'+val.name+'"]').val(val.value);
                    form.find('select[name="' + val.name + '"]').selectpicker('val', val.value);
                    form.find('textarea[name="'+val.name+'"]').val(val.value);
                }
            }
        });
        // $(btnName).trigger('click');
    }
}
function loadStatusCookie(cname,btnName, getTo=false) {
    var id=$(btnName).attr('data-target');
    var data=getCookie(cname);
    if(data!="")
    {   data=JSON.parse(data);
        var form=$('#'+id);
        $.each(data,function (key,val) {
            if(getTo ==true){
                if(val.name == 'status'){
                    return val.value;
                }
            }else{
                if(val.name.indexOf('[]')>-1)
                {
                    var name=val.name.replace('[]','');
                    form.find('input[name^='+name+']').val(val.value);
                    form.find('select[name^='+name+']').selectpicker('val', val.value);
                    form.find('textarea[name^='+name+']').val(val.value);
                }
                else
                {
                    form.find('input[name='+val.name+']').val(val.value);
                    form.find('select[name='+val.name+']').selectpicker('val', val.value);
                    form.find('textarea[name='+val.name+']').val(val.value);
                }
            }
        });
        // $(btnName).trigger('click');
    }
}
function loadStatusCookie1(cname,btnName, getTo=false) {
    var id=$(btnName).attr('data-target');
    var data=getCookie(cname);

    if(data!="")
    {   data=JSON.parse(data);
        var form=$('#'+id);
        $.each(data,function (key,val) {
            if(val.name == 'status[]'){
                form.find('input[name^=status]').val(val.value.toString());
                form.find('.dropdownStatus ul li').removeClass('checked');
                form.find('.dropdownStatus ul li').addClass('unchecked');
                form.find('.dropdownStatus ul li .la').addClass('hidden');
                $.each(val.value, function(k, v){
                    form.find('.dropdownStatus ul li[data-value^='+v+']').removeClass('unchecked');
                    form.find('.dropdownStatus ul li[data-value^='+v+']').addClass('checked');
                    form.find('.dropdownStatus ul li[data-value^='+v+'] .la').removeClass('hidden');
                });
            }

        });
        // $(btnName).trigger('click');
    }
}
function loadDateCookie(cname,btnName, dateID,getTo=false) {
    var data=getCookie(cname);
    if(data!="")
    {   data=JSON.parse(data);
        $.each(data,function (key,val) {
            if(val.name == 'date_range' || val.name == 'application_date' || val.name == 'invoiced_date' || val.name == 'approved_date'  || val.name == 'trans_date'){
                var d = val.value.split(' - ');
                var start = d[0];
                var end = d[1];
                var picker = $('#'+dateID);
                function cb(start, end,label) {
                    var title = '';
                    var range = '';
                    if ((end - start) < 100) {
                        title = 'Today:';
                        range = moment(start).format('MMM D');
                    } else if (label == 'Yesterday') {
                        title = 'Yesterday:';
                        range = moment(start).format('MMM D');
                    } else {
                        range = moment(start).format('MMM D') + ' - ' + moment(end).format('MMM D');
                    }
                    picker.find('.m-subheader__daterange-date').text('');
                    picker.find('.m-subheader__daterange-date').html(range);
                    picker.find('.m-subheader__daterange-title').html(title);
                }
                picker.daterangepicker({
                    startDate: moment(start),
                    endDate: moment(end),
                    opens: 'right',
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        'Last 3 Month': [moment().subtract(2, 'month').startOf('month'), moment().endOf('month')],
                    }
                }, cb);
                cb(start, end, '');
            }
        });
        // $(btnName).trigger('click');
    }
}

/**
 * Function to set cookie
 *
 * @param cname
 * @param cvalue
 * @createdBy SHIVA THAPA
 */
function deleteCookie(name){
    var d = new Date();
    d.setTime(d.getTime() - (1000*60*60*24));
    var expires = "expires=" + d.toGMTString();
    window.document.cookie = name+"="+"; "+expires;
}
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

String.prototype.format = function()
{
    var args = arguments;

    return this.replace(/{(\d+)}/g, function(match, number)
    {
        return typeof args[number] != 'undefined' ? args[number] :
            '{' + number + '}';
    });
};



function ConvertJsonToTable(parsedJson, tableId, tableClassName, linkText)
{
    //Patterns for links and NULL value
    var italic = '<i>{0}</i>';
    var link = linkText ? '<a href="{0}">' + linkText + '</a>' :
        '<a href="{0}">{0}</a>';

    //Pattern for table
    var idMarkup = tableId ? ' id="' + tableId + '"' :
        '';

    var classMarkup = tableClassName ? ' class="' + tableClassName + '"' :
        '';

    var tbl = '<table border="1" cellpadding="1" cellspacing="1"' + idMarkup + classMarkup + '>{0}{1}</table>';

    //Patterns for table content
    var th = '<thead>{0}</thead>';
    var tb = '<tbody>{0}</tbody>';
    var tr = '<tr>{0}</tr>';
    var thRow = '<th>{0}</th>';
    var tdRow = '<td>{0}</td>';
    var thCon = '';
    var tbCon = '';
    var trCon = '';

    if (parsedJson)
    {
        var isStringArray = typeof(parsedJson[0]) == 'string';
        var headers;

        // Create table headers from JSON data
        // If JSON data is a simple string array we create a single table header
        if(isStringArray)
            thCon += thRow.format('value');
        else
        {
            // If JSON data is an object array, headers are automatically computed
            if(typeof(parsedJson[0]) == 'object')
            {
                headers = array_keys(parsedJson[0]);

                for (var i = 0; i < headers.length; i++)
                    thCon += thRow.format(headers[i]);
            }
        }
        th = th.format(tr.format(thCon));

        // Create table rows from Json data
        if(isStringArray)
        {
            for (var i = 0; i < parsedJson.length; i++)
            {
                tbCon += tdRow.format(parsedJson[i]);
                trCon += tr.format(tbCon);
                tbCon = '';
            }
        }
        else
        {
            if(headers)
            {
                var urlRegExp = new RegExp(/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig);
                var javascriptRegExp = new RegExp(/(^javascript:[\s\S]*;$)/ig);

                for (var i = 0; i < parsedJson.length; i++)
                {
                    for (var j = 0; j < headers.length; j++)
                    {
                        var value = parsedJson[i][headers[j]];
                        var isUrl = urlRegExp.test(value) || javascriptRegExp.test(value);

                        if(isUrl)   // If value is URL we auto-create a link
                            tbCon += tdRow.format(link.format(value));
                        else
                        {
                            if(value){
                                if(typeof(value) == 'object'){
                                    //for supporting nested tables
                                    tbCon += tdRow.format(ConvertJsonToTable(eval(value.data), value.tableId, value.tableClassName, value.linkText));
                                } else {
                                    tbCon += tdRow.format(value);
                                }

                            } else {    // If value == null we format it like PhpMyAdmin NULL values
                                tbCon += tdRow.format(italic.format(value).toUpperCase());
                            }
                        }
                    }
                    trCon += tr.format(tbCon);
                    tbCon = '';
                }
            }
        }
        tb = tb.format(trCon);
        tbl = tbl.format(th, tb);

        return tbl;
    }
    return null;
}


function array_keys(input, search_value, argStrict)
{
    var search = typeof search_value !== 'undefined', tmp_arr = [], strict = !!argStrict, include = true, key = '';

    if (input && typeof input === 'object' && input.change_key_case) { // Duck-type check for our own array()-created PHPJS_Array
        return input.keys(search_value, argStrict);
    }

    for (key in input)
    {
        if (input.hasOwnProperty(key))
        {
            include = true;
            if (search)
            {
                if (strict && input[key] !== search_value)
                    include = false;
                else if (input[key] != search_value)
                    include = false;
            }
            if (include)
                tmp_arr[tmp_arr.length] = key;
        }
    }
    return tmp_arr;
}

$(document).off('click', '*[rel=developerConsole]').on('click', '*[rel=developerConsole]', function (e) {
    e.preventDefault();

    loadDeveloperNote();
    $("#developerPanel").slideToggle();
});

// Shift + ~
$(document).on('keyup keypress', function (e) {
    if (e.shiftKey && e.key == "~") {
        loadDeveloperNote();
        $("#developerPanel").slideToggle();
    }
});

$(document).off('submit', '#DeveloperNoteForm').on('submit', '#DeveloperNoteForm', function (e) {
    e.preventDefault();

    $('#PageHolder').val(location.hash);
    var request = {
        url: '/developernote/store',
        method: 'Post',
        form: 'DeveloperNoteForm'
    };

    addFormLoader();
    ajaxRequest(request, function (response) {

        removeFormLoader();
        $('#NoteTextarea').val('');
        showSuccessMessage(response.data);
        loadDeveloperNote();
        highlightFirst();
    });
});

function initResizer() {
    $("#developerPanel").resizable({
        maxHeight: 600,
        minHeight: 365,
        handles: {
            'n': '#handle'
        },
        resize: function (event, ui) {
            var parent = ui.element;
            var height = ui.size.height;

            // Textarea
            parent.find('#DeveloperNoteForm textarea').css({
                "max-height": (height - 160),
                "height": (height - 160),
            });

            // Note Lists
            parent.find('.notes').css({
                "max-height": (height - 120),
                "height": (height - 120),
            });
        }
    });
}

function loadDeveloperNote() {
    ajaxRequest({
        'url': '/developernote/all'
    }, function (response) {
        loadDeveloperNotesServer(response.data)
    });
}
function loadDeveloperNotesServer(markup) {
    $('#DeveloperNotesHolder').html(markup);
}

function loadDeveloperNotesClient(data) {

    $('#DeveloperNotesHolder').empty();
    if (data.length) {
        $.each(data, function (idx, val) {
            var is_done = '';
            var pickup = '';
            var pickupby = '';
            if (!val.user) {
                pickup = '<button class="btn m-btn--pill btn-xs btn-outline-info dNotePickUp" data-id="' + val.id + '"> Pick Up </button>';
            }
            if (!val.is_done && val.user) {
                is_done = '<button class="btn m-btn--pill btn-xs btn-sm btn-outline-success m-l-5 d_is_done" data-id="' + val.id + '">Done</button>';
            }
            if (val.user) {
                pickupby = '<button class="btn m-btn--pill btn-xs btn-outline-info">Picked By : ' + val.user.name + ' </button>';
            }
            var markup = ' <div class="m-widget3__item">\n' +
                '                                <div class="m-widget3__header">\n' +
                '                                    <div class="m-widget3__user-img">\n' +
                '                                        <img class="m-widget3__img" src="images/no-user.svg" alt="">\n' +
                '                                    </div>\n' +
                '                                    <div class="m-widget3__info">\n' +
                '                                        <span class="m-widget3__username">\n' +
                val.creator.name.ucfirst() +
                '                                        </span>\n' +
                '                                        <br>\n' +
                '                                        <span class="m-widget3__time">\n' +
                '                                            2 day ago\n' +
                '                                        </span>\n' +
                '                                    </div>\n' +
                '                                    <span class="m-widget3__status m--font-info">\n' +
                pickup + pickupby + is_done +
                '                                    </span>\n' +
                '                                </div>\n' +
                '                                <div class="m-widget3__body">\n' +
                '                                    <p class="m-widget3__text">\n' +
                val.text +
                '                                    </p>\n' +
                '                                </div>\n' +
                '                            </div>';
            $('#DeveloperNotesHolder').prepend(markup);
        })
    } else {
        var markup = 'No Issue yet';
        $('#DeveloperNotesHolder').html(markup);
    }

}

$(document).off('click', '.dNotePickUp').on('click', '.dNotePickUp', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    ajaxRequest({
        url: '/developernote/pickup/' + id,
        method: 'Post',
        cancelPrevious: true
    }, function (response) {
        showSuccessMessage(response.data);
        loadDeveloperNote();
    });
});

$(document).off('click', '.d_is_done').on('click', '.d_is_done', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    ajaxRequest({
        url: '/developernote/done/' + id,
        method: 'Post',
        cancelPrevious: true
    }, function (response) {
        showSuccessMessage(response.data);
        loadDeveloperNote();
    });
});

function highlightFirst() {
    var notes = $(".notes");
    notes.animate({scrollTop: 0}, 300);
    notes.find('.m-widget3__item:first-child').addClass('added');

    var removeClassTime = setTimeout(function () {
        notes.find('.m-widget3__item:first-child').removeClass('added');
        clearTimeout(removeClassTime);
    }, 4000);
}



/**
 * Table Export
 */

$(document).off('click', '.developerNote_export').on('click', '.developerNote_export', function (e) {
    e.preventDefault();
    var exportType = $(this).attr("data-export-type");
    if (exportType) {
        $("#developernoteTable table").tableExport({
            type: exportType,
            escape: 'false',
            fileName: "ietable",
            ignoreColumn: [6]
        });
    }
});
$(document).off('blur', 'input[rel=email]').on('blur', 'input[rel=email]', function(e){
   e.preventDefault();
   var self = $(this);
   var email = $(this).val();
   var oldEmail = $(this).data('email');
   // if(email === oldEmail){
      if(email){
          ajaxRequest({
          url: 'checkEmail?email='+email,
          cancelPrevious: true,
          method: 'get',
         }, function(response){
              if(response.hasOwnProperty('data') && response.data != "not"){
                $('.btnsubModal').attr('data-sub-modal-route', 'getEmailInfo/'+response.data);
                $('.btnsubModal').trigger('click');
              }else{
                $('#emailExistOnly').text('');
              }
          });
     }
   // }
});

$(document).off('blur', 'input[rel=company_email]').on('blur', 'input[rel=company_email]', function(e){
   e.preventDefault();
   var email = $(this).val();
   var parent = $(this).closest('.modal.show').attr('data-modal-id');
   if(email){
        ajaxRequest({
        url: 'checkOrgEmail?email='+email,
        cancelPrevious: true,
        method: 'get',
       }, function(response){
            if(response.hasOwnProperty('data') && response.data != "false" &&response.data.hasOwnProperty('id')){
                $('#applicationNpCreateModal').modal('hide');
                $('#btnsubModal').attr('data-sub-modal-route', 'getOrgInfo/'+response.data.id);
                $('#btnsubModal').trigger('click');
            }else{
                $('#emailExistOnly').text('');
              }
        });
   }
});

function showPrevModal() {
    $('#applicationCreateModal').modal('show');
}


$(document).off('blur', 'input[rel=siteEmail]').on('blur', 'input[rel=siteEmail]', function(e){
    e.preventDefault();
    var self = $(this);
    var email = $(this).val();
    var oldEmail = $(this).data('email');
    // if(email === oldEmail){
    if(email){
        ajaxRequest({
            url: 'checkSiteEmail?email='+email,
            cancelPrevious: true,
            method: 'get',
        }, function(response){
            if(response.hasOwnProperty('data') && response.data != "not"){
                $('.btnsubModal').attr('data-sub-modal-route', 'getSiteEmailInfo/'+response.data);
                $('.btnsubModal').trigger('click');
            }else if(response.data == "not"){
                 $('p#email_exists').hide();
                $('#saveSite').show();
            }
            else{
                $('#emailExistOnly').text('');
               
            }
        });
    }
    // }
});


/**
 * DEVELOPERS
 * ----------------------------------------------
 * SUMAN  THAPA - LEAD  (NEPALNME@GMAIL.COM)
 * ----------------------------------------------
 * - PRABHAT GURUNG
 * - BASANTA TAJPURIYA
 * - RAKESH SHRESTHA
 * - MANISH BUDDHACHARYA
 * - LEKH RAJ RAI
 * - ASCOL PARAJULI
 * -----------------------------------------------
 * Created On: 3/26/2019
 *
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2019
 * SHUBHU TECH PVT LTD , NEPAL. ALL RIGHT RESERVED
 * 
 * change
 */


/*
ajax function using jquery ajax
* */
function sendAjax(props, callback = resp => 1, errorCallback = err => 1) {
    props = typeof props === 'string' ? { url: props } : props;
    if (props.loader) {
        addFormLoader();
        props.complete = removeFormLoader;
    }
    if (props.data instanceof FormData) {
        Object.assign(props, { contentType: false, processData: false });
    }
    return $.ajax(props).then(callback, errorCallback);
}

function processAjaxForm(responseArr, cb = false) {
    toastr.options.preventDuplicates = true;
    cb = typeof cb === 'function' ? cb : element => element;
    if (typeof responseArr === 'object' && responseArr !== null) {
        if (responseArr.hasOwnProperty('responseJSON') && responseArr.status === 422) {
            const highlight = true;
            return formValidation(responseArr, highlight);
        }
        responseArr = responseArr.hasOwnProperty('responseJSON') ? responseArr.responseJSON : responseArr;
        if (!'message' in responseArr)
            for (const response of responseArr) {
                const msg = response.data;
                if (response.type === 'success') {
                    toastr.success(msg);
                } else {
                    toastr.error(msg);
                }
                cb(response.element);
            }
    }
}

/*
* form validator with toastr message
* */
function formValidation(err, highlight = false) {
    let message = '';
    if (highlight) {
        message = 'Please check highlighted fields.<br><br>';
        $('form [name]').css('border-color', '#ccc');
        $('form [name]+.note-editor').css('border-color', '#ccc');
        $('form [name]+.select2-container').find('.select2-selection--single').css('border-color', '#ccc');
    }
    if (err.status === 422) {
        for (let [i, msg] of Object.entries(err.responseJSON.errors)) {
            msg = typeof msg === 'string' ? msg : msg.join('');
            message += msg + '<br>';
            if (highlight) {
                $('form [name="' + i + '"]').css('border-color', 'brown');
                $('form [name="' + i + '"]+.note-editor').css('border-color', 'brown');
                $('form [name]+.select2-container').find('.select2-selection--single').css('border-color', '#ccc');

            }
        }
    }
    message = message ? message : err.status + ' ' + err.statusText;
    toastr.error(message);
}

/*
* confirm box before ajax action
* */
function confirmAction(props, callback = '') {
    let date = new Date();
    const modal_id = date.getTime();
    props.btn = props.btn || 'btn-primary';
    props.fresh = props.fresh || true;
    if (props.fresh) {
        $('.custom-confirm-modal').remove();
    }
    $('body').append(`
    <div class="modal fade std-modal modal-default custom-confirm-modal" id="confirm-${modal_id}" tabindex="-1" role="dialog" aria-labelledby="modalContainerHeader" data-backdrop="static" data-keyboard="false" style="z-index: 99999; display: none;" >
    <style>
        .modal-header-danger {
            background-color: #fb7b91 !important;
            border-color: #fb7b91 !important;
        }    
    </style>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="background: #fff;">
                <p>${props.message}</p>
            </div>
            <div class="modal-footer" style="display: inline-block; background: #eee;">
                <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn m-btn--icon ${props.btn} m-btn--pill float-right" data-dismiss="modal" id="btn-${modal_id}-confirm">
                    <span>
                        ${props.action}
                    </span>
                </button>
            </div>
        </div>
    </div>
    </div>
    `.trim());

    $('#confirm-' + modal_id).modal('show');
    if (props.ajax) {
        $(`#btn-${modal_id}-confirm`).off('click').on('click', function () {
            sendAjax(props.ajax);
        });
    }
    if (typeof callback === 'function') {
        $(`#btn-${modal_id}-confirm`).off('click').on('click', function (e) {
            callback(e);
        });
    }
    if (typeof props.callback === 'function') {
        props.callback();
    }
}

function hasCooke(cname, item = false) {
    const cookie = getCookie(cname);
    if (!cookie || !item) return !1;
    const check = (cookieArr, item) => cookieArr.filter(x => x.name === item).length > 0;
    return check(JSON.parse(cookie), item);
}

function hasCookie(cname, item = false) {
    const cookie = getCookie(cname);
    if (!cookie || !item) return !!cookie;
    const check = (cookieArr, item) => cookieArr.filter(x => x.name === item);
    return check(JSON.parse(cookie), item) > 0;
}

function resetCookie(key) {
    let cookies = typeof key === 'string' ? arguments : key;
    for (let i = 0; i < cookies.length; i++) {
        setCookie(cookies[i], '', 0);
    }
}

function deleteCookieOf(cookie, key) {
    (function (cookieArr, cookie) {
        cookieArr = cookieArr.filter(function ({ name }) {
            return name !== key;
        });
        setCookie(cookie, JSON.stringify(cookieArr));
    })(JSON.parse(getCookie(cookie) || '[]'), cookie);
}

function put_filter(key, data, append = false) {
    let time_sheet_cookie = JSON.parse(getCookie(key) || '[]');
    let hasReplaced = false;
    for (let i = 0; i < time_sheet_cookie.length; i++) {
        if (time_sheet_cookie[i].name !== data.name) continue;
        time_sheet_cookie[i] = !append ? data : { name: data.name, value: [time_sheet_cookie[i].value, data.value].join(',') };
        hasReplaced = true;
        break;
    }
    if (!hasReplaced) {
        time_sheet_cookie.push(data);
    }
    setCookie(key, JSON.stringify(time_sheet_cookie));
}

String.prototype.escapeSpecialChars = function () {
    return this.replace(/\\n/g, "\\n")
        .replace(/\\'/g, "\\'")
        .replace(/\\"/g, '\\"')
        .replace(/\\&/g, "\\&")
        .replace(/\\r/g, "\\r")
        .replace(/\\t/g, "\\t")
        .replace(/\\b/g, "\\b")
        .replace(/\\f/g, "\\f");
};

String.prototype.hashCode = function () {
    let hash = 0, i, chr;
    if (this.length === 0) return hash;
    for (i = 0; i < this.length; i++) {
        chr = this.charCodeAt(i);
        hash = ((hash << 5) - hash) + chr;
        hash |= 0; // Convert to 32bit integer
    }
    return hash;
};

String.prototype.formatHrs = function () {
    let hours = Math.floor(this);
    const mins = Math.round((this - hours) * 60);
    hours = String(hours).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    return `${hours} : ${mins < 10 ? `0${mins}` : mins}`;
}

Number.prototype.formatHrs = function () {
    let hours = Math.floor(this);
    const mins = Math.round((this - hours) * 60);
    hours = String(hours).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    return `${hours}:${mins < 10 ? `0${mins}` : mins}`;
}

// Number.prototype.formatToThousands = function(){
//     return this.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
// }


function replaceLookups(context = null) {
    $('input[data-lookup]:not([data-advanced])', context || document).each(function (i, elem) {
        const element = $(elem);
        const url = element.attr('data-lookup'), value = element.val();
        const select = document.createElement('SELECT');
        select.className = 'form-control'; select.title = 'Choose'; select.name = element.attr('name');
        if (element.attr('multiple')) {
            select.multiple = "multiple";
            if (element.attr('title'))
                select.title = element.attr('title');
            select.setAttribute('data-selected-text-format', 'count>1');
            select.setAttribute('data-actions-box', 'true');
            select.setAttribute('data-live-search', 'true');
            select.setAttribute('data-done-button', 'true');
            select.setAttribute('data-done-button-text', 'Apply');
        }
        element.replaceWith(select);
        $(select).selectpicker({ width: '100%' });
        sendAjax(url, function (results) {
            results = results.map(x => `<option value="${x.value}">${x.value}</option>`);
            $(select).html(results).selectpicker('refresh').selectpicker('val', value);
        });
    });
}

function tooltip(props = {}) {
    const options = {
        placement: 'bottom'
    };
    Object.assign(options, props);
    $('[data-tooltip]').tooltip(props);
}

$(document)
    .off('click', '.m-datatable__row')
    .on('click', '.m-datatable__row', function (e) {

        let checkBox = $(this).find('td input[type="checkbox"]');

        if (checkBox.length) {

            checkBox.first().prop("checked", !checkBox.prop("checked"));

            checkBox.first().trigger('change')

        }

    });

/* 
    overriding default behavior of daterangepicker
*/
$(document).on('click focus', '.daterangepicker_input input', e => {
    e.stopImmediatePropagation();
    e.stopPropagation();
    e.preventDefault();
});

$(document).on('click', '[data-range-key="No range defined"]', e => {
    const span = $(`<span data-modal-route="vsy-calendar-add" data-modal-callback="reloadCurrentRoute" class="hidden"></span>`);
    $('body').append(span);
    span.click();
    span.remove();
});

function reloadCurrentRoute() {
    const url = location.hash.slice(1);
    $('#contentHolder').load(url);
}


function processModalSilently(callback = '') {
    $('.modal-dialog,.modal-backdrop').remove();
    $('.modal.show').modal('hide');
}
/* 
    time in time out calc in 12 hours format
*/

var Intelligent = {
	calculateTime(start, end, operator = true) {
		if (start == "") {
			start = "0:00";
		} else if (start == "0:00") {
		} else {
			if (start.match(/\d{1,2}:\d{1,2}$/) === null) {
				start = "0:00";
			} else if (operator) {
				let [hour, min] = start.split(":");
				hour = Number(hour);
				if (hour < 6) {
					start = [12 + hour, min].join(":");
				}
			}
		}

		if (end == "") {
			end = "0:00";
		} else if (end == "0:00") {
		} else {
			if (end.match(/\d{1,2}:\d{1,2}$/) === null) {
				end = "0:00";
			} else if (operator) {
				let [startHour, startMin] = start.split(":");
				startHour = Number(startHour);
				if (startHour < 6) {
					startHour += 12;
				}

				let [endHour, endMin] = end.split(":");
				endHour = Number(endHour);
				if (endHour - startHour < 0 || (endHour < 6 && startHour >= 6))
					endHour += 12;

				end = [endHour, endMin].join(":");
			}
		}

		start = start.split(":");
		end = end.split(":");
		var end = parseInt(end[0]) * 60 + parseInt(end[1]);
		var start = parseInt(start[0]) * 60 + parseInt(start[1]);
		var diff = Math.abs(end - start);
		let hours = parseInt(diff / 60);
		return hours + ":" + (diff % 60 < 9 ? "0" + (diff % 60) : diff % 60);
		// return (hours < 9 ?"0"+hours : hours) + ":" + (diff%60 < 9 ? "0"+diff%60 : diff%60);
	},

	AI_time(start, end, operator = true) {

		if (start == "") {
			start = "0:00";
		} else if (start == "0:00") {
		} else {
			if (start.match(/\d{1,2}:\d{1,2}$/) === null) {
				start = "0:00";
			} else if (operator) {
				let [hour, min] = start.split(":");
				hour = Number(hour);
				const plusHour = this.time_in ? parseInt(this.time_in) >= 12 : false;
				if (hour < 6 || plusHour) {
					start = [12 + hour, min].join(":");
				}
			}
		}

		if (end == "") {
			end = "0:00";
		} else if (end == "0:00") {
		} else {
			if (end.match(/\d{1,2}:\d{1,2}$/) === null) {
				end = "0:00";
			} else if (operator) {
				let [startHour, startMin] = start.split(":");
				startHour = Number(startHour);
				const plusHour = this.time_in ? parseInt(this.time_in) >= 12 : false;
				if (startHour < 6 || plusHour) {
					startHour += 12;
				}

				let [endHour, endMin] = end.split(":");
				endHour = Number(endHour);
				if (endHour - startHour < 0 || (endHour < 6 && startHour >= 6))
					endHour += 12;

				end = [endHour, endMin].join(":");
			}
		}

		return [start, end];
	},

	checkTsIsValid(userTimeIn) {
		let errors;

		return userTimeOut => userBreakIn => userBreakOut => {

      if(!(userTimeOut && userTimeIn)) return []; 

			let [time_in, time_out] = this.AI_time(userTimeIn, userTimeOut);
			let [break_out, break_in] = this.AI_time.call({ time_in, time_out }, userBreakOut, userBreakIn);

			// console.log({ time_in, time_out, break_out, break_in });

			if (moment(time_in, "HH:mm:ss").isBefore(moment(time_out, "HH:mm:ss"))) {
				if (
					moment(break_out, "HH:mm:ss").isSameOrBefore(
						moment(break_in, "HH:mm:ss")
					)
				) {
					if (
						(moment(break_out, "HH:mm:ss").isBetween(
							moment(time_in, "HH:mm:ss"),
							moment(time_out, "HH:mm:ss")
						) &&
							moment(break_in, "HH:mm:ss").isBetween(
								moment(time_in, "HH:mm:ss"),
								moment(time_out, "HH:mm:ss")
							)) ||
						(break_in === "0:00" && break_out === "0:00")
					) {
						errors = []; // no errors
					} else {
						console.log("breakin breanout must be within timein timeout limit");
						errors = ["break_in", "break_out"];
					}
				} else {
					console.log("Breakout cannot be after break in");
					errors = ["break_out"];
				}
			} else {
				errors = ["time_out"];
			}

			return errors;
		};
	}
};


/**
 * Flaoter js
 * 
 * */

class Floater {
    constructor(period, site) {
        this.floater = { period, site };
        this.loadModal();
    }

    loadModal() {
        const url = `time-sheet/create-floater/${this.floater.period}/${this.floater.site}`;
        showModal(url);
    }

    static DataTable(container, options) {
        const Floaters = [];

        let lastCount = 0;
        const default_options = {
            data: {
                type: 'remote',
                source: {
                    read: {
                        method: 'get',
                        url: '/volunteers/all',
                    }
                },
                pageSize: options.pageSize || 50, serverFiltering: true, serverSorting: true, serverPaging: true,
                saveState: true
            },
            pagination: options.hasOwnProperty('pagination') ? options.pagination : true,
            sortable: true,
            /* toolbar: {
                item: {
                    pagination: {
                        pageSizeSelect: [10, 20, 30, 50, 100]
                    }
                }
            }, */
            layout: {
                height: 400,
            },
            rows: {
                autoHide: false,
                afterTemplate(row, data, index) {
                    if (index === lastCount) {
                        $(container).find('tbody').addClass('scrollbar-navy scrollbar-y').css({ height: options.height });
                    }
                    if (Floaters.indexOf(data.id) > 0) {
                        setTimeout(function () {
                            row.find('.selected-floater :input').prop('checked', true);
                            $(container).find('tbody').prepend(row);
                        }, 500);
                    }
                }
            },
            columns: [
                {
                    title: '#', field: 'id', width: 30, sortable: false,
                    selector: { class: 'selected-floater checkbox-navy' }
                },
                {
                    title: 'Name', field: 'full_name', width: 150, sortable: 'asc',
                    template({ full_name }) {
                        return `<span title="${full_name}">${full_name}</span>`;
                    }
                },
                { title: 'Email', field: 'email', width: 120 },
                { title: 'County', field: 'county', width: 100 },
                { title: 'City', field: 'city', width: 100 },
            ]
        };

        $(container).on('m-datatable--on-ajax-done', function (e, data) {
            lastCount = data.length - 1;
        });

        const fDataTable = $(container).mDatatable(default_options);

        if (options.quickFilterForm) {
            $(options.quickFilterForm).off('input').on('input', function () {
                const data = $(this).serializeArray().filter(x => !!x.value);
                setCookie('floaterQuick', JSON.stringify(data));
                fDataTable.search();
            });
        }


        $(document).on('change', '.selected-floater:not(.m-checkbox--all) :input', function (e) {
            const vol_id = Number(this.value);
            let index = -1;
            if (this.checked && Floaters.indexOf(vol_id) < 0) {
                Floaters.push(vol_id);
            } else if (!this.checked && (index = Floaters.indexOf(vol_id)) > -1) {
                Floaters.splice(index, 1);
            }
        });

        $(document).on('change', '.selected-floater.m-checkbox--all :input', function (e) {
            const value = this.checked;
            $('.selected-floater:not(.m-checkbox--all) :input').each(function () {
                $(this).prop('checked', value).change();
            });
        });

        if (options.addFloater) {
            $(options.addFloater).off('click').on('click', e => {
                let data = Floaters.map(x => ({ name: 'vol_ids[]', value: x }));
                data = data.concat($('#floater-info').serializeArray());
                sendAjax({
                    url: '/time-sheets/floater-add',
                    method: 'post', data
                }, function (response) {
                    const site_id = $('#floater-site').val();
                    toastr.success(response.message);
                    processModal();
                    Floater.loadFloater(site_id);
                }, function (err) {
                    if (err.status === 422) {
                        toastr.error(err.responseJSON.message);
                    }
                });
            });
        }
    }

    static loadFloater(site_id) {
        sendAjax('time-sheets/load-floater/' + site_id, function (results) {
            const container = $('.vol-lists-item.ofSite' + site_id);
            container.find('li.floater-vol').remove();
            const floaters = results.map(x => {
                return `<li style="display: flex; align-items: center; justify-content: space-between;" 
                title="${ [x.first_name, x.middle_name || '', x.last_name].join(' ')}">
                    <p style="display: flex; margin-bottom: 0">
                      <label class="m-checkbox">
                          <input class="selected_volunteer" type="checkbox"  value="${ x.vol_id}"> 
                          <span></span>
                      </label>
                      <i class="flaticon-user m-r-5"></i>${ [x.first_name, x.middle_name || '', x.last_name].join(' ')}
                    </p>
                    <div class="d-flex">
                        <span class="badge badge-pill badge-light" title="Floater"><i class="fa fa-facebook text-muted"></i></span> &nbsp; &nbsp;
                        <span class="badge badge-pill badge-light" title="No default template"><i class="fa fa-exclamation" style="color: #dc3545"></i></span>
                    </div>

                </li>`;
            });
            if (container.find('.normal-vol').length) {
                container.find('.normal-vol:last').after(floaters);
            } else {
                container.find('li:not(.create-floater)').remove();
                container.prepend(floaters);
            }

            $('.vol-ts-details ul.vol-lists-item li').off('click')
                .on('click', vol_list_action);
        });
    }
}


function appendApprovedTimesheetButton(datas) {
    var markup = '<div class="m-form__group row">\n' +
        '<div class="col-xl-6">' +
        '                            <div class="m-form__label m-form__label-no-wrap float-left">\n' +
        '                                <label class="m--font-bold m--font-danger" style="margin-top:3px;">Selected\n' +
        '                                    <span id="m_datatable_selected_number1">' + datas + '</span> records:</label>\n' +
        '                            </div>\n' +
        '<div class="m-form__control">\n' +
        '                                <div class="btn-toolbar"">\n' +
        '                                    <button class="hidden beforeAction" type="hidden"></button><button href="#" class="btn btn-info btn-sm m-btn m-btn--icon m-btn--pill" id="approveAllTimesheet" data-target="applicationForm" style="margin-left:10px;">' +
        '<span>' +
        'Approve All' +
        '</span>' +
        '</button>' +
        '\n' +
        '                                </div>\n' +
        '                            </div>\n' +
        '                            </div>\n' +
        '                </div>';
    $('#approvedTimesheet').html(markup);
}
function appendInitialButton() {
    var t = `<div class="m-form__group row">
                    <div class="col-xl-6">
                        <div class="m-form__label m-form__label-no-wrap float-left">
                            <label class="m--font-bold m--font-danger" style="margin-top:3px;">
                                Please Select Items:
                            </label>
                        </div>
                        <div class="m-form__control">
                            <div class="btn-toolbar">
                                <button href="#" class="btn btn-info btn-sm m-btn m-btn--icon m-btn--pill" id="approveAllFinance" data-target="financeForm" style="margin-left:10px;"><span>Approve All</span></button>
                            </div>
                        </div>
                    </div>
                </div>`;
    $('#approvedTimesheet').html(t);
}


$(document).off('click', '.approveAllTimesheet').on('click', '.approveAllTimesheet', function (e) {
    e.stopPropagation();
    setCookie('forward_period_id', $(this).data('period-id'));
    processApproval.call(this, $(this).data('period-id'));
});

$(document).off('click', '.beforeAction1').on('click', '.beforeAction1', function (e) {
    e.stopPropagation();
});

function processApproval(period_id) {

    event.stopPropagation();

    const targets = $('.demoCheckedtimesheet');
    const self = $(this);
    const form = $(this).attr('data-target');


    if (targets.length > 0) {
        let data = [];
        targets.each(function (i, v) {
            data.push(this.value);
        });
        data = data.toString();
        // return console.log(data, data.length, $('.selected_timesheets:checked').length, $('.selected_timesheets:not(:checked)').length);

        $('.beforeAction1[data-period="' + period_id + '"]').attr('data-modal-route', 'timesheetApprovalView?data=' + data).click();

        $(document).off('click', '.actionCondition').on('click', '.actionCondition', function (e) {
            $('.actionCondition').attr('disabled', 'disabled');
            var request = {
                url: 'timesheetApprovalView',
                method: 'post',
                form: form
            };
            addFormLoader();
            ajaxRequest(request, function (response) {
                processForm(response, function () {
                    // $('.text-loader').remove();
                    removeFormLoader();
                    reloadDatatable('#finance_tableContainer_period');
                    $('#approvedFinance').html(`<div class="m-form__group row">
                    <div class="col-xl-6">
                        <div class="m-form__label m-form__label-no-wrap float-left">
                            <label class="m--font-bold m--font-danger" style="margin-top:3px;">
                                Please Select Items:
                            </label>
                        </div>
                        <div class="m-form__control">
                            <div class="btn-toolbar">
                                <button href="#" class="btn btn-info btn-sm m-btn m-btn--icon m-btn--pill" id="approveAllFinance" data-target="financeForm" style="margin-left:10px;"><span>Posting All</span></button>
                            </div>
                        </div>
                    </div>
                </div>`);
                    $('.close1').trigger('click');
                });
            });

            $('.close').trigger('click');

            if ($(this).hasClass('queue')) {
                setTimeout(function () {
                    $('.close2').trigger('click');
                    $('#launchBeforeActionModal').click();
                    $('#applicationForm').find('.demoCheckedFinance').parent().parent().parent().next().next().find('span').append('');
                }, 1000);
            } else {
                setTimeout(function () { $('.close2').trigger('click'); }, 1000);
            }
        });
        // });
    } else {
        $('.periodBySelect').siblings('span').css('background', '#dc3545');
        return toastr.error('Please Select the Items');
    }
}

$(document).off('change', '.periodBySelect').on('change', '.periodBySelect', function (e) {
    const self = $(this);
    //  console.log(self.checked);
    const period_id = self.attr("data-period");
    $('.stipend_row' + period_id).find('.selected_timesheets').prop('checked', this.checked).eq(0).change();
    $('.stipend_row' + period_id).find('.siteBySelect').prop('checked', this.checked)/* .change() */;
    if ($(this).prop("checked") == true) {
        $('.periodBySelect').siblings('span').css('background', '#716aca');
    } else {
        $('.periodBySelect').siblings('span').css('background', '#bdc3d4');
    }
});
$(document).off('change', '.siteBySelect').on('change', '.siteBySelect', function (e) {
    const self = $(this);
    // $('.periodBySelect').siblings('span').css('background','#716aca');
    // const period_id = self.attr('data-period');
    // $(`.active_period${period_id}_site${site_id}`).prop('checked', this.checked).eq(0).change();
    $(`.${self.data('hash')}`).prop('checked', this.checked).eq(0).change();

});
$(document).on('click', 'label > .siteBySelect+span', e => e.stopPropagation());


$(document).off('change', '.selected_timesheets').on('change', '.selected_timesheets', function (e) {
    const self = $(this);
    const stipend_id = self.attr('data-period');
    const site_id = self.attr('data-site');

    const stipend_row = $('.stipend_row' + stipend_id);
    const targets = stipend_row.find('.selected_timesheets');

    const selectedChild = targets.filter((i, el) => el.checked);

    const siteChild = $(`.active_period${stipend_id}_site${site_id}`);
    const selectedSiteChild = siteChild.filter((i, el) => el.checked);

    const toggleCheck = targets.length === selectedChild.length;
    const siteToggleCheck = siteChild.length === selectedSiteChild.length;

    $('.periodBySelect[data-period="' + stipend_id + '"]').prop('checked', toggleCheck);
    $('.siteBySelect[data-period="' + stipend_id + '"][data-site="' + site_id + '"]').prop('checked', siteToggleCheck);

    stipend_row.parent().siblings('.list-group-item').find('.siteBySelect,.periodBySelect,.selected_timesheets')
        .prop('checked', false).removeClass('demoCheckedtimesheet'); // other timesheets
    $('.approveAllTimesheet[data-period-id!=' + stipend_id + ']').css('display', 'none'); // other approve button
    targets.removeClass('demoCheckedtimesheet');
    selectedChild.addClass('demoCheckedtimesheet');

    // const displayValue = $('.demoCheckedtimesheet').length > 0 ? 'block' : 'none';
    // $('.approveAllTimesheet[data-period-id='+ stipend_id +']').css('display', displayValue);
});

//
$(document).off('click', '.time-sheets .stipend_item').on('click', '.time-sheets .stipend_item', function () {
    hideShow(this);
});


function hideShow(element, forceShow = false) {

    forceShow = this ? this.forceShow || forceShow : forceShow;

    let stipend_id = element.getAttribute('data-stipend');
    let target = $('#time_sheet_data_tableContainer' + stipend_id);
    let caret = element.querySelector('.m-datatable__toggle-detail i.fa');
    if (target.data('slideDown') === 'true' && !forceShow) {
        target.slideUp();
        target.closest('.stipend_row' + stipend_id).removeClass('checked');
        if (caret) caret.className = 'fa fa-caret-right';
        target.data('slideDown', 'false');
    } else {
        target.slideDown();
        target.closest('.stipend_row' + stipend_id).addClass('checked');
        if (caret) caret.className = 'fa fa-caret-down';
        target.data('slideDown', 'true')
        if (typeof load_stipend_period === 'function')
            load_stipend_period(stipend_id);
    }
}

$(document).on('click', '.volunteerExportFiscal', function () {
    const self = $(this);
    const exprotType = self.attr('data-export-type');
    const request = $('#siteSettingsFilter').serializeArray().filter(x => !!x.value);
    return console.log(request);
    window.open('fgp_reports/generate/volunteerReportFiscal/' + exprotType);
});

function fullCalendarInit(){
    var CalendarExternalEvents1 = function() {
    
        var initCalendar = function() {
            let ctrlIsPressed = false;

            function setEventsCopyable(isCopyable) {
              ctrlIsPressed = !ctrlIsPressed;
              $("#calendar").fullCalendar("option", "eventStartEditable", !isCopyable);
              $(".fc-event").draggable("option", "disabled", !isCopyable);
            }

            // set events copyable if the user is holding the control key
            $(document).keydown(function(e) {
              if (e.ctrlKey && !ctrlIsPressed) {
                setEventsCopyable(true);
              }
            });

            // if control has been released stop events being copyable
            $(document).keyup(function(e) {
              if (ctrlIsPressed) {
                setEventsCopyable(false);
              }
            });

            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var yesterday = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var today = todayDate.format('YYYY-MM-DD');
            var tomorrrow = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
            $("#m_calendar_time").fullCalendar({ 
              height: 617,
              defaultView: "month",
              eventLimit: true,
              navLinks:true,
              events: [
                {
                  title: "All Day Event",
                  start: YM+'-01',
                  description: 'Lorem ipsum dolor sit incid idnut ut',
                  className: 'fc-event--success'
                },
                {
                  title: "Event 2",
                  start: YM+'-02',
                  end: YM+'-03',
                  description: 'Lorem ipsum dolor sit incid idnut ut',
                  className: 'fc-event--primary'
                },
                {
                  title: 'Travel Expenses',
                  start: YM+'-12',
                  description:'Lorem ipsum dolor sit incid idnut ut',
                  end: YM+'-10',
                  className: 'fc-event--info'
                }
              ],
              editable: false,
              droppable: true,
              dayClick: function(date, jsEvent,view){
                openDayEvent();
              },
              eventAfterAllRender(event, element, view) {
                // make all events draggable but disable dragging
                $(".fc-event").each(function() {
                  const $event = $(this);
                  // store data so the calendar knows to render an event upon drop
                  const event = $event.data("fcSeg").footprint.eventDef;
                  $event.data("event", event);

                  // make the event draggable using jQuery UI
                  $event.draggable({
                    disabled: true,
                    helper: "clone",
                    revert: true,
                    revertDuration: 0,
                    zIndex: 999,
                    stop(event, ui) {
                      // when dragging of a copied event stops we must set them
                      // copyable again if the control key is still held down
                      if (ctrlIsPressed) {
                        setEventsCopyable(true);
                      }
                    }
                  });
                });
              },
              eventMouseover: function(calEvent, domEvent) {
                var p = $(this).offset();
                var top = p.top-50;
                var left = p.left-40;
                var d = calEvent.description;
                if(d==undefined){
                  d = calEvent.miscProps.description;
                }
                var layer = "<div id='events-layer' class='fc-events-layer fc-transparent' style='will-change: transform;transform: translate3d("+left+"px, "+top+"px, 0px);'>"+d+"</div>";
                $('body').append(layer);
              },
              eventClick: function(calEvent, jsEvent, view) {
                var request= {
                  url: 'getCalendarDayDetail',
                  method: 'get'
                }
                ajaxRequest(request, function(response){
                  $('.m_calendar_time_Changable').slideUp('slow');
                  $('#m_calendar_time_detail').show();
                  $('#m_calendar_day_detail').html(response.data);
                });      
              },
              eventMouseout: function(calEvent, domEvent) {
                $("body").find('div[id*=events-layer]').remove();
              },  
          });
        }
    
        return {
            //main function to initiate the module
            init: function() {
                initCalendar(); 
            }
        };
    }();
    
    jQuery(document).ready(function() {
        CalendarExternalEvents1.init();
    });

    function openDayEvent(){
      var request= {
        url: 'getCalendarDayDetail',
        method: 'get'
      }
      ajaxRequest(request, function(response){
        $('.m_calendar_time_Changable').slideUp('slow');
        $('#m_calendar_time_detail').show();
        $('#m_calendar_day_detail').html(response.data);
      });      
    }
}

/*
* @Author: 
 /** 
 * DEVELOPERS 
 * ------------------------------------------------  
 * - SUMAN THAPA - LEAD(NEPALNME@GMAIL.COM) 
 * ------------------------------------------------  
 * - PRABHAT GURUNG 
 * - BASANTA TAJPURIYA 
 * - RAKESH SHRESTHA 
 * - MANISH BUDDHACHARYA 
 * - LEKH RAJ RAJ 
 * - ASCOL PARAJULI 
 * ------------------------------------------------  
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2019 
 * SHUBHU TECH PVT LTD , NEPAL. ALL RIGHT RESERVED
* @Date:   2019-03-15 14:07:36
* @Last Modified by:   Lekh Raj Rai
* @Last Modified time: 2019-05-17 14:06:59
*/

function floatLabelInput(input, load = false, align = 30) {
    if (load) {
        let floatingInterval = setInterval(ownFloatLabel, 100, input, load, align);
        setTimeout(function () {
            clearInterval(floatingInterval);
        }, 1000);
    } else {
        ownFloatLabel(input, load, align);
    }
    return true;
}

function ownFloatLabel(input, load = false, align = 30) {
    if (load && input.value.length === 0) {
        $(input).closest('.field').find('label:first').attr('style', '').removeClass('floatingLabel');
        return false;
    }
    $(input).closest('.field').css('position','relative')
    .find('label:first').css({
        'position':'absolute', 'top':'-7px','left':align+'px',
        'background' : 'white','color':'#3780b7',
        'padding':'0 1px',
        'z-index':'9', 'transition': '0.3s'
    }).addClass('floatingLabel');
    $(input).css({'cssText':'position:relative;' });
}
/*
* @Author: 
 /** 
 * DEVELOPERS 
 * ------------------------------------------------  
 * - SUMAN THAPA - LEAD(NEPALNME@GMAIL.COM) 
 * ------------------------------------------------  
 * - PRABHAT GURUNG 
 * - BASANTA TAJPURIYA 
 * - RAKESH SHRESTHA 
 * - MANISH BUDDHACHARYA 
 * - LEKH RAJ RAJ 
 * - ASCOL PARAJULI 
 * ------------------------------------------------  
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2019 
 * SHUBHU TECH PVT LTD , NEPAL. ALL RIGHT RESERVED
* @Date:   2019-03-28 19:38:55
* @Last Modified by:   Lekh Raj Rai
* @Last Modified time: 2019-05-09 18:03:33
*/



$(function(){
$('input[data-lookup]').on('keydown',function(e){
     $(this)[0].hasAttribute('isLookup') ? checkFinanceCode($(this).val(), $(this)) : false;
   });

  /*---------- finance code lookup -------*/
    function getFinanceCode(financeCode, origin){
        typeof origin === "undefined" ? false : origin.val(financeCode);
        if (typeof origin !== "undefined") {
          origin.val(financeCode);
          checkFinanceCode(financeCode,origin);
        }
    }


    function checkFinanceCode(givenCode,element) {
    if (givenCode != "") {
          $.ajax({
            url:'/finance_code/check/value/'+givenCode,
            method:'GET',
            success:function(data){
               let id = element.attr('id') ; 
             $('input#'+id).css("border","1px solid #fff");
            },
            error: function (error) {
              let id = element.attr('id'); 
              $('#'+id).css("border","1px solid #b12704");
            }
          })
        }
      }


    function stipendItemCategorySelected(category_id){
      $.get("/stipend/item/category/name/"+category_id,function(response,status){
          let categoryName = response.value;
             $('.business_unit').attr('data-lookup',`stipend/items/Business/${categoryName}`);


            $('.department_code').attr('data-lookup', `stipend/items/Department/${categoryName}`);
            $('.account_code').attr('data-lookup', `stipend/items/Account/${categoryName}`);
            $('.program_code').attr('data-lookup', `stipend/items/Program/${categoryName}`);
            $('.fund_code').attr('data-lookup', `stipend/items/Fund/${categoryName}`);
            $('.project_code').attr('data-lookup', `stipend/items/Project/${categoryName}`);  


            $('#viewBusiness').attr('data-sub-modal-route', `finance_code/${categoryName}/business`);
            $('#viewDepartment').attr('data-sub-modal-route', `finance_code/${categoryName}/department`);
            $('#viewAccount').attr('data-sub-modal-route', `finance_code/${categoryName}/account`);
            $('#viewProgram').attr('data-sub-modal-route', `finance_code/${categoryName}/program`);
            $('#viewFund').attr('data-sub-modal-route', `finance_code/${categoryName}/fund`);
            $('#viewProject').attr('data-sub-modal-route', `finance_code/${categoryName}/project`);
      });
    }

    function labelFloatNow() {
       $('#AddStipendItem :input').each(function(){
             floatLabelInput(this,true);
        }).off('focus')
        .on('focus', function() {
            floatLabelInput(this);
        })
        .off('blur')
        .on('blur', function() {
            floatLabelInput(this, true);
        })
        .off('change')
        .on('change', function() {
            floatLabelInput(this, true);
        });
  }   

  function labelFloatUpdateNow() {
       $('#stipendItemUpdate :input').each(function(){
             floatLabelInput(this,true);
        }).off('focus')
        .on('focus', function() {
            floatLabelInput(this);
        })
        .off('blur')
        .on('blur', function() {
            floatLabelInput(this, true);
        })
        .off('change')
        .on('change', function() {
            floatLabelInput(this, true);
        });
  }


 function clickSubmodalTable(element, attribute){
 
       let remove = $('.my-submodal-table').find('tr');
        remove.removeClass('rowBg');
        element.addClass('rowBg');
        var data = element.find("td.myvalue");
        if(data) {
           let fcode = data[0].innerHTML;
          let newValue = $("[data-table-value="+attribute+"]");
            newValue.val() == "";
            newValue.val(fcode);
            checkFinanceCode(fcode,newValue);
            labelFloatUpdateNow()
            labelFloatNow();
            processModal();
        }
  }




	
    /*-------- submit form ----------*/
    $(document).off('click','#btnUpdateItem').on('click','#btnUpdateItem', function (e) {
        e.preventDefault();
        var form = $(this).attr('data-target');
        let formData = $('#'+form).serializeArray();
        let stipendItem = $(this).attr('data-id');

        var request = {
            url: '/stipend/items/update/'+stipendItem,
            method: 'post',
            data: formData,
            loader: true
        };

        sendAjax(request, function(response){
            processModal();
            reloadDatatable('#stipend_item_data_table');
            toastr.success("Successfully updated")


        }, function({responseJSON}){

            toastr.error("Please fill in the required fields")

            $('#'+form).find(`input`).css('border-color', "#ccc")
            $('#'+form).find('.select2-selection--single').css('border-color', "#ccc")
            
            for(let error in responseJSON.errors){
                $('#'+form).find(`[name="${error}"]`).css('border-color', "#b12704")
                $('#'+form).find(`[name="${error}"]`).next().find('.select2-selection--single').css('border-color', "#b12704")
            }

        })



    });
});

$(document).off('click','a.selectCode').on('click','a.selectCode',function(e) {
  let value =  $(this).attr('data-code-value');
  let id = $(this).attr('data-select-id');
  clickedSelectItem(value,id);
});

function itemsSummary(container, name){

    let categories = container.find(name).toArray();
    let summary = categories.reduce((acc, iterator) => {
        let selectedOption = $(iterator).find('option:selected');
        if(selectedOption.length > 0){			

            let parentRow = $(iterator).closest('tr')
            let category = selectedOption.text();
            let item = $(iterator).attr('data-stipend-category')
            let amount = parentRow.find('.appendAmount').val();
            let desiredObject = {
                category,
                item,
                amount,
                count : 1
            }

            let push = true;

            acc.forEach(t =>{
                if(t.category === desiredObject.category && t.item === desiredObject.item && desiredObject.amount === t.amount){
                    t.count += 1;
                    push = false;
                }
            })	

            if(acc.length < 1 || push){
                acc = [...acc, desiredObject];
            }

            return acc;		

        }else{
            return acc;
        }

    }, []);

    summary.sort(function(a,b){
        return b.item.charCodeAt(0) - a.item.charCodeAt(0);
    })

    let mapSummary = (summaryContainer) => {
        let summaryHTML = '<table class="table items-map-table borderless">';

        if(summary.length < 1){
            summaryContainer.html('')
            return;
        }	

        $(summary).each((index, summaryDetail) => {
            summaryHTML += `
                <tr class="f-w-400 fs">
                    <td>
                        ${summaryDetail.item}&nbsp;-&nbsp;${summaryDetail.category}
                    </td>
                    <td>Count ${summaryDetail.count}</td>
                    <td>@&nbsp; $${summaryDetail.amount}</td>
                </tr>	
            `.trim();

        });
        summaryHTML += "</table>";
        summaryContainer.html(summaryHTML);
    }

    return {
        summary,
        mapSummary
    };

}	

function itemMap({table, holder, name} = {
    table : $('.vol-site-tab-content .tab-pane.active'),
    holder : $('.totalSummary'),
    name : '[name ^= "item[value]"]'
}){
    var sum = itemsSummary(table, name)
    sum.mapSummary(holder);
}
/**
 * @author Suman Thaapa -- Lead 
 * @author Basanta Tajpuriya 
 * @author Rakesh Shrestha 
 * @author Manish Buddhacharya 
 * @author Prabhat gurung 
 * @author Lekh Raj Rai 
 * @email NEPALNME@GMAIL.COM
 * @create date 2019-03-28 16:34:11
 * @modify date 2019-03-28 16:34:11
 * @desc [description]
 */
//== Class definition
var VolunteerWizard = function (id, formid) {
    //== Base elements
    var volunteerAddWizard = $('#' + id);
    var formEl = $('#' + formid);
    var validator;
    var volunteerWizard = '';

    volunteerWizard = $('#' + id).mWizard({
        startStep: 1
    });
    // volunteerWizard.goFirst();

    var prevStep = volunteerWizard.currentStep;
    var errors = "";
    var vol_id = '';

    volunteerWizard.on('beforeNext', function (volunteerWizard) {
        sendAjax({
            url: "/volunteer/getVolunteerValidation",
            method: "POST",
            data: $(formEl).serializeArray()
        }, function (response) {
            $('#m_wizard_form_step_1').find(`input`).css("border-color", "#d0d0d0");
            // processForm(response);
        }, function ({ responseJSON }) {
            $('#m_wizard_form_step_1').find(`input`).css("border-color", "#d0d0d0");
            volunteerWizard.goFirst();
            for (let key in responseJSON.errors) {
                let index = 0;
                if (key.indexOf('.') > -1) {
                    [key, index] = key.split('.');
                }
                $('#m_wizard_form_step_1').find(`input[name^="${key}"]`).eq(index).css("border-color", "#b12704")
            }
        });

    });
    //== Change event
    volunteerWizard.on('change', function (volunteerWizard) {
        if ($("#" + id).find('.input-required1').length > 0) {
            $('#modalContainer *[data-wizard-target="#m_wizard_form_step_1').find('a:first-child').trigger('click');
        }

        let alt_id = $('#m_wizard_form_step_1').find('[name="alt_id"]').val();

        $('.vendor--id').val(alt_id.padStart(10, '0'));

        if (volunteerWizard.currentStep == 1) {
            /* Validate alt_id */
            let alt_id = $('#m_wizard_form_step_1').find('[name="alt_id"]');

            $('.vendor--id').val(alt_id.val());

            if (!$(alt_id).val())
                $(alt_id).addClass('input-required1');
            $(".volunteer-form-summary-list").addClass('hidden');

            // sendAjax({
            //     url: '' + volunteer_id,
            //     method: 'POST',
            //     data: $('#m_wizard_form_step_1 :input').serializeArray()
            // }, function () {
            //     reloadDatatable('#vol_data_table');
            // }, function ({ responseJSON }) {
            //     $('#m_wizard_form_step_1').find(`input`).css("border-color", "#d0d0d0");
            //     volunteerWizard.goPrev();
            //     for (let key in responseJSON.errors) {
            //         let index = 0;
            //         if (key.indexOf('.') > -1) {
            //             [key, index] = key.split('.');
            //         }
            //         $('#m_wizard_form_step_1').find(`input[name^="${key}"]`).eq(index).css("border-color", "#b12704")
            //     }
            // });


        }
        if (volunteerWizard.currentStep == 2) {
            $(".volunteer-form-summary-list").removeClass("hidden");
            $('.siteLocationSection').removeClass('hidden');
            $('#vol_summary_header').text($("#" + id).find("#first_name").val() + ' ' + $("#" + id).find("#middle_name").val() + ' ' + $("#" + id).find("#last_name").val());
            $('#volEmail').text($("input[rel=email]").val());
        }
        if (volunteerWizard.currentStep == 3) {
            $(".modal").find('.addSitesTemplate').show();
        } else {
            $(".modal").find('.addSitesTemplate').hide();
        }

        if (volunteerWizard.currentStep == 4) {
            //Check if a week is selected
            let isWeekSelected = $(document.getElementById('m_wizard_form_step_3')).find('[name="w_days[]"]').val().length;

            let rowsAddedForInsertion = $('#m_wizard_form_step_3 table.view-selected-table :input');

            let addIcon = $('.addTsVolData');

            if (isWeekSelected) {

                addIcon.removeClass('btn-success').addClass("btn-danger");

                volunteerWizard.goPrev()

                return toastr.error("Please click the red circled icon to save template.");

            }

            addIcon.hasClass('btn-danger') ? addIcon.addClass("btn-success") : '';

        }
    });
};


var VolunteerEditWizard = function (id, formid, volunteer_id) {
    //== Base elements
    var volunteerAddWizard = $('#' + id);
    var formEl = $('#' + formid);
    var validator;
    var volunteerWizard = '';

    volunteerWizard = $('#' + id).mWizard({
        startStep: 1
    });

    var prevStep = volunteerWizard.currentStep;
    var errors = "";
    var vol_id = '';
    volunteerWizard.on('beforeNext', function (volunteerWizard) {

        if (volunteerWizard.currentStep === 1) {

            let alt_id = $('#m_wizard_form_step_1').find('[name="alt_id"]').val();

            $('.vendor--id').val(alt_id.padStart(10, '0'));

            let hasValidationError = $('#m_wizard_form_step_1 .input-required1').length;

            if (hasValidationError > 0)
                return toastr.error("Please check the red fields");

            sendAjax({
                url: 'volunteer/updateGenerals/' + volunteer_id,
                method: 'POST',
                data: $('#m_wizard_form_step_1 :input').serializeArray()
            }, function () {
                $('#m_wizard_form_step_1').find(`input`).css("border-color", "#d0d0d0");
                reloadDatatable('#vol_data_table');
            }, function ({ responseJSON }) {
                $('#m_wizard_form_step_1').find(`input`).css("border-color", "#d0d0d0");
                volunteerWizard.goFirst();
                for (let key in responseJSON.errors) {
                    let index = 0;
                    if (key.indexOf('.') > -1) {
                        [key, index] = key.split('.');
                    }
                    $('#m_wizard_form_step_1').find(`input[name^="${key}"]`).eq(index).css("border-color", "#b12704")
                }
            });

        } else if (volunteerWizard.currentStep === 2) { //volunteer detail            

            sendAjax({
                url: 'volunteer/updateDetails/' + volunteer_id,
                method: 'POST',
                data: $('#m_wizard_form_step_2 :input').serializeArray()
            }, function (response) {
                reloadDatatable('#vol_data_table');
            }, function (err) {
                volunteerWizard.goPrev();
            });

        } else { //(volunteerWizard.currentStep === 3){ //template           




        }



    });
    //== Change event
    volunteerWizard.on('change', function (volunteerWizard) {
        if ($("#" + id).find('.input-required1').length > 0) {
            $('#modalContainer *[data-wizard-target="#m_wizard_form_step_1').find('a:first-child').trigger('click');
        }

        if (volunteerWizard.currentStep == 1) {
            $(".volunteer-form-summary-list").addClass('hidden');
        }
        if (volunteerWizard.currentStep == 2) {
            $(".volunteer-form-summary-list").removeClass("hidden");
            $('.siteLocationSection').removeClass('hidden');
            $('#vol_summary_header').text($("#" + id).find("#first_name").val() + ' ' + $("#" + id).find("#middle_name").val() + ' ' + $("#" + id).find("#last_name").val());
            $('#volEmail').text($("input[rel=email]").val());
        }
        if (volunteerWizard.currentStep == 3) {

        }

        if (volunteerWizard.currentStep == 4) {

            //Check if a week is selected
            let isWeekSelected = $(document.getElementById('m_wizard_form_step_3')).find('[name="w_days[]"]').val().length;

            let rowsAddedForInsertion = $('#m_wizard_form_step_3 table.view-selected-table :input');

            let addIcon = $('.addTsVolData');

            if (isWeekSelected) {

                addIcon.removeClass('btn-success').addClass("btn-danger");

                volunteerWizard.goPrev()

                return toastr.error("Please click the red circled icon to save template.");

            }

            let hasDefaultTemplate = $('.saveAndContBtn').attr('data-has-template');

            let bypassStep3 = $('.saveAndContBtn').attr('data-bypass-step-3');

            if (typeof bypassStep3 !== "undefined") {

                $('.saveAndContBtn').removeAttr('data-bypass-step-3');
                $('.saveAndContBtn').attr('data-has-template', "");
                return;

            }

            if (
                (typeof hasDefaultTemplate !== "undefined" && hasDefaultTemplate !== "")
                &&
                (rowsAddedForInsertion.length < 1)
            ) {
                volunteerWizard.goPrev();

                confirmAction({
                    message: "Do you want to delete this timesheet?",
                    action: "yes",
                    ajax: {
                        url: '/',
                        success: function () {
                            $('.saveAndContBtn').attr('data-bypass-step-3', 1);
                            volunteerWizard.goNext();
                        }
                    }
                })

                return;
            }


            $("#appendableTableDetails :input").prop("disabled", false);

            let template_id = $('.saveAndContBtn').attr('data-template-id');


            let url;

            if (!template_id) {
                url = 'volunteer/updateTemplate/' + volunteer_id;

            } else {


                url = 'volunteer/updateTemplate/' + volunteer_id + '/' + template_id;

            }

            sendAjax({
                url: url,
                method: 'POST',
                data: $('#m_wizard_form_step_3 :input').serializeArray()
            }, function () {

                addIcon.removeClass('btn-danger').addClass("btn-success");

                $("#appendableTableDetails :input").prop("disabled", true);

            }, function (err) {
                addIcon.removeClass('btn-danger').addClass("btn-success");

                volunteerWizard.goPrev();
            });
        }
    });

};


function templateFieldsClearer() {

    $('.modernFormAddTable .weekSelectpicker[name="w_days[]"]').val('default').selectpicker('refresh')
    $('#ts-v2-sites').val("").trigger("change")
    $('.modernFormAddTable select[name="w_item[label][]"]').val("").trigger("change")
    let itemValue = $('.modernFormAddTable select[name="w_item[value][]"]');
    itemValue.val("").trigger("change")
    itemValue.removeAttr('data-stipend-category')
    let inputsNames = ["w_time_in", "w_time_out", "w_break_out", "w_break_in", "w_total_hrs", "w_item[amount][]"];

    inputsNames.forEach((name) => {
        $(`.modernFormAddTable input[name="${name}"]`).val("");
    })

}



$(document).off('click', '.clearWidget').on('click', '.clearWidget', function (e) {
    e.preventDefault();

    let target = $('.m-wizard__step--current').attr('data-form-type');

    if (target === "template") {
        $('#modern_template_name').val("")
        $('#ts-v2-time-type').val("").trigger("change")

        templateFieldsClearer();
    }

})



$('.siteLocationSection').removeClass('hidden');
$('#siteLists').html('');
var clickedSite = 0;
$(document).off('change', '.siteChecked').on('change', '.siteChecked', function () {
    var self = $(this);
    if (self.prop('checked')) {
        var t = '<span title="' + self.attr("data-title") + '" data-id="' + self.attr("data-id") + '" class="m-list-search__result-item m-list-search__result-item-text d-b lh-26 summary-line-overflow">' +
            '<i class="la la-check fs-12"></i> &nbsp;' + self.attr("data-title") + '</span>';
        $('#siteLists').append(t);
        self.attr('name', 'site_id[]');
        self.val(self.attr("data-id"));

        if (clickedSite === 0) {
            var classHidden = "";
            var add = `<a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill addWeekFormat" data-parent-id="parentRow_` + self.attr('data-id') + `" style="width:20px; height:20px;margin-top:5px;" data-id="` + self.attr('data-id') + `" data-title="` + self.attr('data-title') + `" data-count="0">
                            <i class="la la-plus"></i>
                        </a>`;
        } else {
            var classHidden = "hidden";
            var add = `<a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeDataTemplate" data-parent-id="parentBody_` + self.attr('data-id') + `" style="width:20px; height:20px;margin-top:5px;" data-id="` + self.attr('data-id') + `" data-count="0">
                            <i class="la la-remove"></i>
                        </a>`;
        }
        var weeks = `<select class="form-control m-bootstrap-select m-input selectpicker dayFilter required_input ` + classHidden + `"
        multiple title="Select Weeks" data-selected-text-format="count > 3" name="days[0][]">
            <option value="Sunday">Sunday</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
        </select>`;
        function makeTemplateBody(countNum) {
            var demo = `<tr data-site="` + self.attr('data-id') + `" class="parentRow" id="parentRow_` + self.attr('data-id') + `" count="` + self.attr('data-id') + `" data-parent="appendBodyTemplate_0">
                        <td>
                            `+ weeks + `
                        </td>
                        <td style="width: 220px;">
                            <input type="text" class="form-control m-input" value="`+ self.attr("data-title") + `" disabled>
                        </td>
                        <td style="width: 150px;">
                            <input type="text" class="form-control m-input required_input" name="time_type[`+ countNum + `][` + self.attr("data-id") + `][]" data-lookup="lookup/ts/time_type" data-count="0" data-next="` + self.attr("data-id") + `" placeholder="Time Type">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input timein_timepicker" name="time_in[`+ countNum + `][` + self.attr("data-id") + `][]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input timeout_timepicker" name="time_out[`+ countNum + `][` + self.attr("data-id") + `][]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input break_timepicker" name="break_out[`+ countNum + `][` + self.attr("data-id") + `][]">
                        </td>	
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input break_timepicker" name="break_in[`+ countNum + `][` + self.attr("data-id") + `][]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input" name="total_hr[`+ countNum + `][` + self.attr("data-id") + `][]">
                        </td>
                        <td style="width: 40px;">
                            `+ add + `
                        </td>
                    </tr>
                    <tr data-site="`+ self.attr('data-id') + `" class="subParentRow_` + self.attr('data-id') + `" data-count="` + self.attr('data-id') + `">
                        <td colspan="3"></td>
                        <td colspan="2">
                            <input type="text" class="form-control m-input tempLabel required_input" name="" placeholder="Item Types" data-lookup="lookup/getData/template_option" data-count="`+ countNum + `" data-next="` + self.attr("data-id") + `">
                        </td>
                        <td colspan="2">
                            <input type="text" class="form-control m-input tempValue required_input" name="" placeholder="Items" data-lookup-callback="itemSelected">
                        </td>
                        <td style="width: 80px;">
                            <input type="text" class="form-control m-input appendAmount required_input" name="" placeholder="Amount">
                            <input type="hidden" class="stipend_item_id" name="">
                        </td>
                        <td style="width: 40px;">
                            <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill addTravelOption" style="width:20px; height:20px;margin-top:5px;" data-parent="subParentRow_`+ self.attr('data-id') + `" data-id="` + self.attr('data-id') + `" data-count="0"  data-next="` + self.attr("data-id") + `">
                                <i class="la la-plus"></i>
                            </a>
                        </td>
                    </tr>`;
            return demo;
        }
        $('.templateTable tbody').each(function (i, v) {
            $(this).append(makeTemplateBody(i));
            $(this).attr("id", "appendBodyTemplate_" + i);
            $(this).addClass('bg-r');
        });
        $('.dayFilter').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });
        $('.timein_timepicker').timepicker({
            minuteStep: 1,
            defaultTime: '8:30 AM',
            showMeridian: false,
            template: false
        });
        $('.timeout_timepicker').timepicker({
            minuteStep: 1,
            defaultTime: '0:00',
            showMeridian: false,
            template: false
        });
        $('.break_timepicker').timepicker({
            minuteStep: 1,
            defaultTime: '0:00',
            showMeridian: false,
            template: false
        });

        clickedSite++;
    } else {
        self.removeAttr('name');
        $('#siteLists').find('span[data-id="' + self.attr("data-id") + '"]').remove();
        $('.templateTable').find('tr[data-site="' + self.attr("data-id") + '"]').remove();
        $('.templateTable tbody').each(function (i, v) {

        });
        var main = $('.templateTable tbody').find('tr').first().attr("data-parent");
        var dayFilterl = $('#' + main).find('select.dayFilter').length;
        var hiddenl = $('#' + main).find('select.hidden').length;
        if (dayFilterl === hiddenl) {
            $('#' + main).find('select.dayFilter').first().removeClass("hidden");
            $('#' + main).find('div.dayFilter').first().removeClass("hidden");
            $('#' + main).find('tr').first().find('td').last().find('a').addClass('addWeekFormat btn-outline-info').removeClass('removeDataTemplate btn-outline-danger');
            $('#' + main).find('tr').first().find('td').last().find('a').find('i').addClass('la-plus').removeClass('la-remove');
        }
        clickedSite--;
    }
});
// var tbody_count = 1;
$(document).off('click', '.addWeekFormat').on('click', '.addWeekFormat', function (e) {

    e.preventDefault();
    var self = $(this);
    var tbody_count = $(this).attr("data-count");
    // var ind = $(this).attr("data-count");
    tbody_count++;
    if (tbody_count == 5) {
        return toastr.error("Cannot add more then " + tbody_count);
    }
    $('.templateTable').append('<tbody id="appendBodyTemplate_' + tbody_count + '"></tbody>');
    $('#siteLists span').each(function (i, v) {
        if (i == 0) {
            var classHidden = ""
        } else {
            var classHidden = "hidden"
        }
        var weeks = `<select class="form-control m-bootstrap-select m-input selectpicker dayFilter ` + classHidden + `"
        multiple title="Select Weeks" data-selected-text-format="count > 3" name="days[`+ tbody_count + `][]">
            <option value="Sunday">Sunday</option>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
        </select>`;
        var add = `<a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeDataTemplate" data-parent-id="parentBody_` + $(this).attr('data-id') + `" style="width:20px; height:20px;margin-top:5px;" data-id="` + $(this).attr('data-id') + `">
                        <i class="la la-remove"></i>
                    </a>`;
        var demo = `<tr data-site="` + $(this).attr('data-id') + `" class="parentRow" id="parentRow_` + $(this).attr('data-id') + `" count="` + $(this).attr('data-id') + `" data-parent="appendBodyTemplate_` + tbody_count + `">
                        <td>
                            `+ weeks + `
                        </td>
                        <td style="width: 220px;">
                            <input type="text" class="form-control m-input" value="`+ $(this).attr("title") + `" disabled>
                        </td>
                        <td style="width: 150px;">
                            <input type="text" class="form-control m-input required_input" name="time_type[`+ tbody_count + `][` + $(this).attr("data-id") + `][]" data-lookup="lookup/ts/time_type" data-count="0" data-next="` + self.attr("data-id") + `" placeholder="Time Type">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input timein_timepicker" name="time_in[`+ tbody_count + `][` + $(this).attr('data-id') + `][]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input timeout_timepicker" name="time_out[`+ tbody_count + `][` + $(this).attr('data-id') + `][]">
                        </td>	
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input break_timepicker" name="break_out[`+ tbody_count + `][` + $(this).attr('data-id') + `][]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input break_timepicker" name="break_in[`+ tbody_count + `][` + $(this).attr('data-id') + `][]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input" name="total_hr[`+ tbody_count + `][` + $(this).attr('data-id') + `][]">
                        </td>
                        <td style="width: 40px;">
                            `+ add + `
                        </td>
                    </tr>
                    <tr data-site="`+ $(this).attr('data-id') + `" class="subParentRow_` + $(this).attr('data-id') + `" data-count="` + $(this).attr('data-id') + `" data-parent="appendBodyTemplate_` + tbody_count + `">
                        <td colspan="3"></td>
                        <td colspan="2">
                            <input type="text" class="form-control m-input tempLabel required_input" name="" placeholder="Item Types" data-lookup="lookup/getData/template_option" data-count="`+ tbody_count + `" data-next="` + $(this).attr('data-id') + `">
                        </td>
                        <td colspan="2">
                            <input type="text" class="form-control m-input tempValue required_input" name="" placeholder="Items" data-lookup-callback="itemSelected">
                        </td>
                        <td style="width: 80px;">
                            <input type="text" class="form-control m-input appendAmount required_input" name="" placeholder="Amount">
                            <input type="hidden" class="stipend_item_id" name="">
                        </td>
                        <td style="width: 40px;">
                            <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill addTravelOption" style="width:20px; height:20px;margin-top:5px;" data-parent="subParentRow_`+ $(this).attr('data-id') + `" data-id="` + $(this).attr('data-id') + `" data-count="` + tbody_count + `" data-next="` + $(this).attr('data-id') + `">
                                <i class="la la-plus"></i>
                            </a>
                        </td>
                    </tr>`;
        $('.templateTable #appendBodyTemplate_' + tbody_count).append(demo);
        $('.templateTable #appendBodyTemplate_' + tbody_count).addClass('bg-r');
        $('.dayFilter').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });
        $('.timein_timepicker').timepicker({
            minuteStep: 1,
            defaultTime: '8:30 AM',
            showMeridian: false,
            template: false
        });
        $('.timeout_timepicker').timepicker({
            minuteStep: 1,
            defaultTime: '0:00',
            showMeridian: false,
            template: false
        });
        $('.break_timepicker').timepicker({
            minuteStep: 1,
            defaultTime: '0:00',
            showMeridian: false,
            template: false
        });
    });
    $(this).attr("data-count", tbody_count);
});
$(document).off('click', '.removeDataTemplate').on('click', '.removeDataTemplate', function (e) {
    e.preventDefault();
    var main = $(this).closest('tr').attr("data-parent");
    var trL = $('#' + main).find('tr').length;
    if (trL <= 2) {
        $('#' + main).remove();
    } else {
        $(this).closest('tbody').find('tr[data-site="' + $(this).attr('data-id') + '"]').remove();
        var dayFilterl = $('#' + main).find('select.dayFilter').length;
        var hiddenl = $('#' + main).find('select.hidden').length;
        if (dayFilterl === hiddenl) {
            $('#' + main).find('select.dayFilter').first().removeClass("hidden");
            $('#' + main).find('div.dayFilter').first().removeClass("hidden");
        }
    }
});
$(document).off('click', '.removeDataTemplateBody').on('click', '.removeDataTemplateBody', function (e) {
    e.preventDefault();
    $(this).closest('tbody').remove();
});
// var addtravelcount=0;
$(document).off('click', '.addTravelOption').on('click', '.addTravelOption', function (e) {
    e.preventDefault();
    var self = $(this);
    var count_i = self.closest('tbody').find('tr[data-site="' + self.attr("data-id") + '"]').length - 1;
    // console.log(count_i);
    if (count_i == 10) {
        return toastr.error("cannot add more than " + count_i);
    }
    var co = $(this).attr("data-count");
    var ne = $(this).attr("data-next");
    let site_id = self.attr('data-id');
    var options = `<tr data-site="` + self.attr('data-id') + `" class="subParentRow_` + self.attr('data-id') + `" data-count="` + self.attr('data-id') + `">
                    <td colspan="3"></td>
                    <td colspan="2">
                        <input type="text" class="form-control m-input required_input tempLabel" name="travel_code[${co}][${site_id}][]" placeholder="Item Types" data-lookup="lookup/getData/template_option" data-count="` + co + `" data-next="` + ne + `">
                    </td>
                    <td colspan="2">
                        <input type="text" class="form-control m-input required_input tempValue" name="travel_value[${co}][${site_id}][]" placeholder="Items" data-lookup-callback="itemSelected">
                    </td>
                    <td style="width: 80px;">
                        <input type="hidden" class="stipend_item_id" name="">
                        <input type="text" class="form-control m-input appendAmount required_input" name="travel_amt[${co}][${site_id}][]" placeholder="Amount">
                    </td>
                    <td style="width: 40px;">
                        <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeTravelOption" style="width:20px; height:20px;margin-top:5px;" data-parent="subParentRow_`+ self.attr('data-id') + `">
                            <i class="la la-remove"></i>
                        </a>
                    </td>
                </tr>`;
    self.closest('tr').after(options);
    // $('.templateTable').find('tbody[data-site="'+self.attr("data-id")+'"]').append(options);
    // addtravelcount++;
});
$(document).off('click', '.removeTravelOption').on('click', '.removeTravelOption', function (e) {
    e.preventDefault();
    $(this).closest('tr').remove();
    // addtravelcount--;
});
$(document).off('focusin click', '.tempValue').on('focusin click', '.tempValue', function (e) {
    var c = $(this).closest('tr').find('.tempLabel').val();
    var count = $(this).closest('tr').find('.tempLabel').attr("data-count");
    var ne = $(this).closest('tr').find('.tempLabel').attr("data-next");
    if (c == "Mileage Reimbursements") {
        $(this).attr("data-lookup", 'lookup/getData/travel_option');
        $(this).attr("name", "travel_value[" + count + "][" + ne + "][]");
        $(this).closest('tr').find('.tempLabel').attr("name", "travel_code[" + count + "][" + ne + "][]");
        $(this).closest('tr').find('.appendAmount').attr("name", "travel_amt[" + count + "][" + ne + "][]");
        $(this).closest('tr').find('.stipend_item_id').attr("name", "travel_stipend_item_id[" + count + "][" + ne + "][]");
    } else if (c == "Food Service") {
        $(this).attr("data-lookup", 'lookup/getData/meal_option');
        $(this).attr("name", "meal_value[" + count + "][" + ne + "][]");
        $(this).closest('tr').find('.tempLabel').attr("name", "meal_code[" + count + "][" + ne + "][]");
        $(this).closest('tr').find('.appendAmount').attr("name", "meal_amt[" + count + "][" + ne + "][]");
        $(this).closest('tr').find('.stipend_item_id').attr("name", "meal_stipend_item_id[" + count + "][" + ne + "][]");
    }
})
function itemSelected(id) {
    ajaxRequest({
        url: 'itemSelection/' + id
    }, function (response) {
        if (response && response.data) {
            $('.modal').find('input[data-value="' + id + '"]').closest('tr').find('.appendAmount').val(response.data.amt);
            $('.modal').find('input[data-value="' + id + '"]').closest('tr').find('.stipend_item_id').val(response.data.id);
        }
    })
}
$(document).off('click', '.addSitesTemplate').on('click', '.addSitesTemplate', function (e) {
    e.preventDefault();
    var weeks = `<select class="form-control m-bootstrap-select m-input selectpicker dayFilter"
            multiple title="Select Weeks" data-selected-text-format="count > 3" name="days[]">
                <option value="Sunday">Sunday</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
            </select>`;
    var add = `<a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill" data-parent-id="parentRow_` + self.attr('data-id') + `" style="width:20px; height:20px;margin-top:5px;">
                            <i class="la la-plus"></i>
                        </a>`;
    // }else{
    //     var weeks = '';
    //     var add = '';
    // }
    var demo = `<tbody data-site="` + self.attr('data-id') + `" class="parentBody" id="parentBody_` + self.attr('data-id') + `" count="` + self.attr('data-id') + `">
                        <tr data-site="`+ self.attr('data-id') + `" class="parentRow" id="parentRow_` + self.attr('data-id') + `" count="` + self.attr('data-id') + `">
                        <td>
                            `+ weeks + `
                        </td>
                        <td style="width: 220px;">
                            <input type="text" class="form-control m-input" value="`+ self.attr("data-title") + `" disabled>
                        </td>
                        <td style="width: 150px;">
                            <select class="form-control m-input" name="time_type[`+ self.attr("data-id") + `][]">
                                <option value="regular">Regular Time</option>
                                <option value="jury">Jury Duty</option>
                            </select>
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input timein_timepicker" name="time_in[]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input timeout_timepicker" name="time_out[]">
                        </td>
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input break_timepicker" name="break_out[]">
                        </td>	
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input break_timepicker" name="break_in[]">
                        </td>	
                        <td style="width: 100px;">
                            <input type="text" class="form-control m-input" name="total_hr[`+ self.attr('data-id') + `][]">
                        </td>	
                        <td style="width: 40px;">
                            
                        </td>
                    </tr>
                    <tr class="subParentRow_`+ self.attr('data-id') + `" data-count="` + self.attr('data-id') + `">
                        <td colspan="3"></td>
                        <td colspan="2">
                            <input type="text" class="form-control m-input" name="[]">
                        </td>
                        <td colspan="2">
                            <input type="text" class="form-control m-input" name="[]">
                        </td>
                        <td style="width: 80px;">
                            <input type="text" class="form-control m-input" name="total_amt[]">
                        </td>
                        <td style="width: 40px;">
                            <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill" style="width:20px; height:20px;margin-top:5px;" data-parent="subParentRow_`+ self.attr('data-id') + `">
                                <i class="la la-plus"></i>
                            </a>
                        </td>
                    </tr></tbody>`;
    $('.templateTable').append(demo);
    $('.dayFilter').selectpicker({
        liveSearch: true,
        showTick: true,
        actionsBox: true,
    });
    $('.timein_timepicker').timepicker({
        minuteStep: 1,
        defaultTime: '8:30 AM',
        showMeridian: false,
        template: false
    });
    $('.timeout_timepicker').timepicker({
        minuteStep: 1,
        defaultTime: '0:00',
        showMeridian: false,
        template: false
    });
    $('.break_timepicker').timepicker({
        minuteStep: 1,
        defaultTime: '0:00',
        showMeridian: false,
        template: false,
    });
});
/**
 * Autosize
 */



function initAutoSize() {
    var autosizeClass = '.autosize';
    autosize($(autosizeClass));
}
/**
 * volunteer Upload Files
 */
function uploadFiles() {

    var dropZoneRef = "#uploadApplicationFile";
    if ($(dropZoneRef).length) {

        var myDropzone_1 = new Dropzone(dropZoneRef, {
            maxFiles: 10
        });

        myDropzone_1.on("complete", function (response) {
        });
    }

}
function citySelectedWidget(id, origin) {
    ajaxRequest({
        url: '/zip_code/city/' + id
    }, function (response) {
        if (response && response.data && response.data[0]) {
            $("#modalContainer *[name=city]").val(response.data[0].city);
            $("#modalContainer *[name=state]").val(response.data[0].state);
            $("#modalContainer *[name=zip]").val(response.data[0].zip_code);
        }
        // $("#volunteerFormWizard *[name=zip]").focus()
    })
}
$(document).off('keypress', 'input[name=vol_ssn]').on('keypress', 'input[name=vol_ssn]', function (e) {
    if ($(this).val().length > 7) {
        e.preventDefault();
    }
});
$(document).off('blur', '#selectSupervisor').on('blur', '#selectSupervisor', function (e) {
    e.preventDefault();
    var self = $(this);
    var v = self.val();
    if (v == '' || v == null) {
        return;
    }
    setTimeout(function () {
        var request = {
            url: 'getSupervisor/' + v,
            method: 'get'
        }
        ajaxRequest(request, function (response) {
            if (response.data === undefined || response.data.length == 0) {
                var p = self.offset();
                var top = p.top - 50;
                var left = p.left - 40;
                var t = `
                    <div id='lookup-popover' class='lookup-popover' style='will-change: transform;transform: translate3d(`+ left + `px, ` + top + `px, 0px);'>Not Found Supervisor</div>
                `;
                $('body').append(t);
                return;
            }
            $('#lookup-popover').remove();
            $.each(response.data, function (i, v) {
                $("#volunteerAddWizard").find('#supervisor').val(v.id);
                self.val(v.value);
            });
        });
    }, 1000);
});
function setSupervisor(id) {
    $('#supervisor').val(id);
}

var const_i = 1;
$(document).off('click', '#addFormVolunteerDetails').on('click', '#addFormVolunteerDetails', function (e) {
    e.preventDefault();
    if (const_i == 4) {
        return toastr.error("Cannot add more items");
    }
    var t = `
        <div class="col-md-12 widgetParentDiv m-t-10" data-count="`+ const_i + `">
            <div class="input-section">
                <input type="text" name="label[]" class="form-control form-control-sm" data-lookup="lookupForVolunteers1/volunteer_details" id="countLabel_`+ const_i + `" data-id="` + const_i + `">  
            </div>
            <div class="btn-section">
                <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeField1" style="width:20px !important;height:20px !important;margin-top:5px;" data-count="`+ const_i + `">
                    <i class="la la-remove"></i>
                </a>
            </div>
        </div>
    `;
    $('#appendFormWidget').append(t);
    const_i++;
});

$(document).off('click', '.removeField1').on('click', '.removeField1', function (e) {
    e.preventDefault();
    var r = $(this).closest('.col-md-12[data-count=' + $(this).attr("data-count") + ']').find('input[name="label[]"]').val();
    var c = getCookie('volunteer_detail');
    var d = c.split(",");
    var index = d.indexOf(r);
    if (index > -1) {
        d.splice(index, 1);
    }
    var f = d.toString();
    setCookie('volunteer_detail', f);
    $(this).closest('.col-md-12[data-count=' + $(this).attr("data-count") + ']').remove();
    const_i--;
});
$(document).off('click', '.widgetParentDiv .lookup-list-items').on('click', '.widgetParentDiv .lookup-list-items', function (e) {
    e.preventDefault();
    var self = $(this);
    var id = self.attr('data-id');
    var parentid = self.closest('.lookup-lists').attr('data-lookup-id');
    var v = self.text();
    var c = getCookie('volunteer_detail');
    if (c !== '') {
        c = c + ',' + v;
    } else {
        c = v;
    }

    setCookie('volunteer_detail', c);
    var parent = $('input[data-value=' + id + '][data-ref=' + parentid + ']').attr("data-id");
    var target = $('#countLabel_' + parent).closest('.form-group');
    var co1 = $('#countLabel_' + parent).closest('.widgetParentDiv').attr("data-count");
    $('#countLabel_' + parent).closest('.form-group').find('input[target-id="countLabel_' + parent + '"]').closest('.col-md-12').remove();
    var t = `
        <div class="col-md-12" data-count="`+ co1 + `">
            <div class="input-section">
                <label for="value">`+ v + `</label>
                <input type="hidden" name="label[]" value="`+ v + `">
                <input type="text" name="value[]" class="form-control form-control-sm" target-id="countLabel_`+ parent + `" data-id="` + parent + `">  
            </div>
            <div class="btn-section">
                <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeField1" style="width:20px !important;height:20px !important;margin-top:30px;" data-count="`+ co1 + `">
                    <i class="la la-remove"></i>
                </a>
            </div>
        </div>
    `;

    target.append(t);
    var targetInput = $('#countLabel_' + parent).closest('.form-group').find('input[target-id="countLabel_' + parent + '"]')

    targetInput.removeClass('m_datepicker');
    targetInput.removeAttr('data-lookup');
    if (v == "Stipend eligibility") {
        targetInput.removeClass('m_datepicker');
        targetInput.attr('data-lookup', 'lookupForVolunteers/stipend_eligibility');
    } else if (v == "Date of birth") {
        targetInput.removeAttr('data-lookup');
        targetInput.addClass('m_datepicker');
        $('.m_datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
        });
    } else {
        targetInput.removeAttr('data-lookup');
        targetInput.removeClass('m_datepicker');
    }
    targetInput.focus();
    $('#countLabel_' + parent).closest('.widgetParentDiv').remove();
});
/*
 * Volunteer Form 
 */
$(document).off('click', '#ApplicationSubmitBtn').on('click', '#ApplicationSubmitBtn', function (e) {
    e.preventDefault();
    deleteCookie('volunteer_detail');
    var self = this;
    // var data = arrangeData(['file']);

    let vols = $('.volunteer :input').serializeArray();
    let volunteer_detail = $('.volunteer_detail :input').serializeArray();
    let template_header = $('#modern-add-template :input').serializeArray();
    let template_body = $('#appendableTableDetails :input').serializeArray();


    // let vols = $('.volunteer :input').serializeArray();
    // let volunteer_detail = $('.volunteer_detail :input').serializeArray();
    // let template_header = $('#modern-add-template :input').serializeArray();
    // let template_body = $('#appendableTableDetails :input').serializeArray();


    // let combinedData = [...vols, ...volunteer_detail, ...template_header, ...template_body];

    $('#appendableTableDetails').find('input').prop('disabled', false);
    $('#appendableTableDetails').find('select').prop('disabled', false);

    var formData = new FormData($('#volunteerFormWizard')[0]);


    sendAjax({
        url: 'volunteerAddWidget/store',
        method: "post",
        data: formData,
        loader: true,
        processData: false,
        contentType: false
    }, function (response) {
        processModal();

        try {
            setCookie('volProfileView', response[0]['element']['volunteer_id']);
        } catch (e) {
            console.log(e.message);
        }
        // $('#volunteerCreateModal *[data-wizard-target="#m_wizard_form_step_1').find('a:first-child').trigger('click');
        // document.getElementById("volunteerFormWizard").reset();
        // $('.templateTable').find('tbody').remove();
        // $('.templateTable').append('<tbody id="appendBodyTemplate_0"></tbody>');
        // clickedSite=0;
        // tbody_count=0;
        // const_i=0;
        // $('#volunteerCreateModal').modal('hide');
        // $('#siteLists').empty();
        // $('.siteChecked').prop("checked", false);
        // if (response[0].hasOwnProperty('element') && response[0].element.hasOwnProperty('volunteer_id')) {
        //     routes.executeRoute('view/volunteer/{volunteer}', {
        //         url: 'view/volunteer/' + response[0].element.volunteer_id
        //     });
        // }
        // $('#vol_data_table').mDatatable('refresh');
        vDatatable.reload();

    })

    return;

    /*

    // Add loader
    addFormLoader();
    ajaxRequest({
        url: "volunteerAddWidget/store",
        method: "post",
        data : combinedData
        // form: 'volunteerFormWizard'
    }, function (response) {
        processForm(response, function () {
            removeFormLoader();
           
            if (response && response.status === 200) {
                
                // File Upload Section
                
                $('#volunteerCreateModal *[data-wizard-target="#m_wizard_form_step_1').find('a:first-child').trigger('click');
                document.getElementById("volunteerFormWizard").reset();
                $('.templateTable').find('tbody').remove();
                $('.templateTable').append('<tbody id="appendBodyTemplate_0"></tbody>');
                clickedSite=0;
                tbody_count=0;
                const_i=0;
                $('#volunteerCreateModal').modal('hide');
                $('#siteLists').empty();
                $('.siteChecked').prop("checked", false);
                if (response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('volunteer_id')) {
                    routes.executeRoute('view/volunteer/{volunteer}', {
                        url: 'view/volunteer/' + response.data[0].element.volunteer_id
                    });
                }
            }
        });
    });
    */
});
// volunteer edit form
/*
 * Application Form Create For Client
 */
$(document).off('submit', '#volunteerEditFormWizard').on('submit', '#volunteerEditFormWizard', function (e) {
    e.preventDefault();
    deleteCookie('volunteer_detail');
    var self = this;

    // $('#appendableTableDetails').find('input').prop('disabled', false);
    // $('#appendableTableDetails').find('select').prop('disabled', false);

    var formData = new FormData($('#volunteerEditFormWizard')[0]);

    sendAjax({
        url: self.action,
        method: self.method,
        data: formData,
        loader: true,
        processData: false,
        contentType: false
    }, function (response) {

        processModal();
        toastr.success("Volunteer Successfully Updated");

        $('#volunteerCreateModal *[data-wizard-target="#m_wizard_form_step_1').find('a:first-child').trigger('click');
        document.getElementById("volunteerFormWizard").reset();
        $('.templateTable').find('tbody').remove();
        $('.templateTable').append('<tbody id="appendBodyTemplate_0"></tbody>');
        clickedSite = 0;
        tbody_count = 0;
        const_i = 0;
        $('#volunteerCreateModal').modal('hide');
        $('#siteLists').empty();
        $('.siteChecked').prop("checked", false);

        reloadDatatable('#vol_data_table');

    })

    // addFormLoader();
    // ajaxRequest({
    //     url: self.action,
    //     method: self.method,
    //     form: 'volunteerEditFormWizard'
    // }, function (response) {
    //     processForm(response, function () {
    //         removeFormLoader();
    //         /**
    //          * After Inserted Successfully Reset Form
    //          */
    //         if (response && response.status === 200) {
    //             /**
    //              * File Upload Section
    //              */
    //             $('#volunteerCreateModal *[data-wizard-target="#m_wizard_form_step_1').find('a:first-child').trigger('click');
    //             document.getElementById("volunteerEditFormWizard").reset();
    //             $('.templateTable').find('tbody').remove();
    //             $('.templateTable').append('<tbody id="appendBodyTemplate_0"></tbody>');
    //             clickedSite=0;
    //             tbody_count=0;
    //             const_i=0;
    //             $('#volunteerCreateModal').modal('hide');
    //             $('#siteLists').empty();
    //             $('.siteChecked').prop("checked", false);
    //             reloadDatatable('#vol_data_table');
    //             if (response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('volunteer_id')) {
    //                 routes.executeRoute('view/volunteer/{volunteer}', {
    //                     url: 'view/volunteer/' + response.data[0].element.volunteer_id
    //                 });
    //             }
    //         }
    //     });
    // });
});
/*-------------------------------------------Site Location------------------------------------------------------*/
$(document).off('keyup', '.siteLocation').on('keyup', '.siteLocation', function () {
    var imp = $(this).val();
    var request = {
        url: '/volunteer/getsiteLocation',
        data: { site: imp },
        method: 'post',
        cancelPrevious: true
    };
    ajaxRequest(request, function (response) {
        if (imp != "") {
            $('#SearchSiteText').text('Search Result for ' + imp);
        }
        else {
            $('#SearchSiteText').html('Choose <abbr title="Site Location">Site Locaiton</abbr>');
        }
        $('#siteSearchResultLists').empty().append(response.data);
    });
});


$(document).off('blur', '#alt_id').on('blur', '#alt_id', function (e) {
    e.preventDefault();
    var id = $(this).val();
    let vol_id = $(this).attr('data-volunteer-id');

    ajaxRequest({ url: 'checkVolAlt/' + id + "?volunteer=" + vol_id }, function (response) {
        if (response.data == "exist") {

            $('#alt_id').addClass('input-required1');
            $('#alt_id').parent().find('#warning-span').html('Volunteer ID already exists.');


        } else {

            $('#alt_id').parent().find('#warning-span').html('');
            $('#alt_id').removeClass('input-required1');


            if (!vol_id) {
                $('.volAddTemplate').attr('data-sub-modal-route', `addTemplateVolunteer/${id}?requester=volEdit&reload=true&temporary=true`);
            }


        }
    });
});

$(document).off('blur', '#eStipendId').on('blur', '#eStipendId', function (e) {

    e.preventDefault();

    var eStipendId = $(this).val();
    const self = $(this);

    ajaxRequest({ url: 'checkEStipendId/"' + eStipendId + '"' }, function (response) {

        if (response.data === true) {
            self.next().html('eStipend Id Already Exists');
            self.addClass('input-required1');
        } else {
            self.next().html('');
            self.removeClass('input-required1')
        }

    })

});

function siteLocationSelected(data, data1) {
    if (data !== undefined) {
        $('#siteSearchResultLists').empty();
        $('#siteLists').empty();
        $.each(data, function (i, v) {
            var siteHeding = '<span title="' + data1[i].value + '" class="m-list-search__result-item m-list-search__result-item-text d-b lh-26 summary-line-overflow">' +
                '<i class="la la-check fs-12"></i> &nbsp;' + data1[i].value + '</span>';
            $('#siteLists').append(siteHeding);
            var t = `<a class="m-list-search__result-item">
                <span class="m-list-search__result-item-icon">
                    <label class="m-checkbox m-checkbox--solid m-checkbox--brand">
                        <input type="checkbox" class="siteChecked" data-id="`+ v.value + `" data-title="` + data1[i].value + `" checked="checked" name="site_id[]" value="` + v.value + `">
                        <span></span>
                    </label>
                </span>
                <span class="m-list-search__result-item-text">`+ data1[i].value + `</span>
            </a>`;
            $('#siteSearchResultLists').append(t);
        });
        $('#volunteerAddWizard *[data-wizard-target="#m_wizard_form_step_2"]').find('a:first-child').trigger('click');
    }
}
$('.timein_timepicker').timepicker({
    minuteStep: 1,
    defaultTime: '0:00',
    showMeridian: false,
    template: false
});
$('.timeout_timepicker').timepicker({
    minuteStep: 1,
    defaultTime: '0:00',
    showMeridian: false,
    template: false
});
$('.break_timepicker').timepicker({
    minuteStep: 1,
    defaultTime: '0:00',
    showMeridian: false,
    template: false
});

// $(document).off('blur', '.timeout_timepicker').on('blur', '.timeout_timepicker', function(){
//     var parent = $(this).closest('tr');
//     var start = parent.find('input.timein_timepicker').val();
//     var end = $(this).val();
//     var total = calculateTimeDiff(start, end);
//     parent.find('td:last-child').find('input').val(total);
// });

$(document).off('change', '.timein_timepicker, .timeout_timepicker').on('change', '.timein_timepicker, .timeout_timepicker', function () {

    var parent = $(this).closest('tr');

    var first = parent.find('input.timein_timepicker').val();
    var second = parent.find('input.timeout_timepicker').val();

    var total = calculateTimeDiff(first, second);

    parent.find('[name ^= "total_hr"]').val(total);
});

function diff(start, end) {
    start = start.split(":");
    end = end.split(":");
    var startDate = new Date(0, 0, 0, start[0], start[1], 0);
    var endDate = new Date(0, 0, 0, end[0], end[1], 0);
    var diff = endDate.getTime() - startDate.getTime();
    var hours = Math.floor(diff / 1000 / 60 / 60);
    diff -= hours * 1000 * 60 * 60;
    var minutes = Math.floor(diff / 1000 / 60);
    return (hours < 9 ? "0" : "") + hours + ":" + (minutes < 9 ? "0" : "") + minutes;
}

function calculateTimeDiff(start, end) {
    start = start.split(":");
    end = end.split(":");
    if (end == '') return "0:00";
    var end = parseInt(end[0]) * 60 + parseInt(end[1]);
    var start = parseInt(start[0]) * 60 + parseInt(start[1]);
    var diff = Math.abs(end - start);
    let hours = parseInt(diff / 60);
    // return (int) hours+":"+diff%60;
    // return (hours < 9 ?"0"+hours : hours) + ":" + (diff%60 < 9 ? "0"+diff%60 : diff%60);
    return hours + ":" + (diff % 60 < 9 ? "0" + diff % 60 : diff % 60);
}
$('#supervisorFilter, .dayFilter').selectpicker({
    liveSearch: true,
    showTick: true,
    actionsBox: true,
});

function checkDefaultSite() {
    $('#siteSearchResultLists a input[name="default_site"]').each(function (index, input) {
        if (index === 0) {
            $(this).attr("checked", "checked");
        }
    });
}

$(document).on('click', '.addAppendableWeek', function (e) {

	let site_data = $('.ts-vol-assigned-sites').serializeArray();


	const formatted_data = formatter(site_data);


	let new_row = '';

	$.each(formatted_data, function (i, v) {

		new_row += `
			
			<tr class="odd">
	            <td>
	            	`;
		if (i == 0) {

			new_row += `<select class="form-control m-bootstrap-select m-input selectpicker dayFilter"
		                multiple title="Select Weeks">
		                    <option value="Sunday">Sunday</option>
		                    <option value="Monday">Monday</option>
		                    <option value="Tuesday">Tuesday</option>
		                    <option value="Wednesday">Wednesday</option>
		                    <option value="Thursday">Thursday</option>
		                    <option value="Friday">Friday</option>
		                    <option value="Saturday">Saturday</option>
		                </select>`;
		}
		new_row += `</td>
	            <td style="width: 220px;">
	                <input type="text" class="form-control m-input" value="${v.assigned_site_name}" data-id="${v.assigned_site_name}" disabled>
	            </td>
	            <td style="width: 150px;">
	                <select class="form-control m-input">
	                    <option value="regular">Regular Time</option>
	                    <option value="jury">Jury Duty</option>
	                </select>
	            </td>
	            <td style="width: 100px;">
	                <input type="text" class="form-control m-input timein_timepicker">
	            </td>
	            <td style="width: 100px;">
	                <input type="text" class="form-control m-input timeout_timepicker">
	            </td>
	            <td style="width: 100px;">
	                <input type="text" class="form-control m-input break_timepicker">
	            </td>
	            <td style="width: 100px;">
	                <input type="text" class="form-control m-input break_timepicker">
	            </td>	
	            <td style="width: 100px;">
	                <input type="text" class="form-control m-input">
	            </td>
	            <td style="width: 40px;">
	                <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill addAppendableWeek" style="width:20px; height:20px;margin-top:5px;">
	                    <i class="la la-plus"></i>
	                </a>
	            </td>
	    	</tr>
	        <tr class="odd">
	            <td colspan="3"></td>
	            <td colspan="2">
	                <input type="text" class="form-control m-input tempLabel" name="" data-lookup="lookup/getData/template_option">
	            </td>
	            <td colspan="2">
	                <input type="text" class="form-control m-input tempValue" name="" placeholder="Items">
	            </td>
	            <td style="width: 80px;">
	                <input type="text" class="form-control m-input appendAmount" name="" placeholder="Amount">
	            </td>
	            <td style="width: 40px;">
	                <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill addTravelOption" style="width:20px; height:20px;margin-top:5px;">
	                    <i class="la la-plus"></i>
	                </a>
	            </td>
	        </tr>
		
		`.trim();


	});

	$('#ts-appendable-table').append(new_row);

	init_picker('.dayFilter');

});

/* Utilities function */

function formatter(unformattedArray) {

	let temp_array = {};


	$.each(unformattedArray, function (i, data) {

		if (data.name in temp_array) {
			temp_array[data.name].push(data.value);
		} else {
			temp_array[data.name] = [data.value];
		}

	});


	let formatted = [];

	for (let key in temp_array) {


		for (let k = 0; k < temp_array[key].length; k++) {

			if (k in formatted)
				Object.assign(formatted[k], formatted[k], { [key]: temp_array[key][k] })
			else
				formatted[k] = { [key]: temp_array[key][k] };
		}

	}

	return formatted;
}

function init_picker(el) {
	$(el).selectpicker();
}

$('.initDatePicker').datepicker({
    autoclose: true,
    todayHighlight: true,
    format: 'dd/mm/yyyy',
});

$(document).off('click', '.backLocation').on('click', '.backLocation', function(e){
    e.preventDefault();
    history.back()
})

$(document).off('click', '.addPhoneRow').on('click', '.addPhoneRow', function(e){

    e.preventDefault();

    let totalPhoneRows = $('[name = "phone_type[]"]').length;

    if( !canAddPhoneRow(totalPhoneRows) ){

        return toastr.error("Cannot add more rows");

    }

    let phoneRow = `
        
        <div class="form-group m-form__group row no-pd-i" style="padding-bottom: 10px !important">
            <div class="col-lg-5">
                <label for="type">
                    Phone Type
                </label>
                <div class="input-group">
                    <select name="phone_type[]" class="form-control phone-type"></select>
                </div>
            </div>
            <div class="col-lg-7 d-flex justify-content-around align-items-center">
                <div>
                    <label for="">Number</label>
                    <input type="text" class="form-control m-input" 
                           name="number[]" autocomplete="off">
                </div>
                <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removePhoneRow m-l-10 m-t-25"><i class="la la-times"></i></a>
            </div>
        </div> 

    `.trim();


    $('.contactForm').append(phoneRow);

    $('.phone-type').select2({
        width: "100%",
        placeholder: "Phone Type",
        dropdownParent : $('.contactForm'),
        ajax : {
            url : '/fetch/phoneTypes',
            data : function(term, page){
                 // let selections = $('[name="phone_type[]"]').map(phoneType => $(phoneType).val());
                 let type = $('[name="phone_type[]"]');

                 let selections = [];

                 $(type).each(function(){
                    selections.push(this.value);
                 })

                 return {
                     term, 
                     selectedTypes : JSON.stringify(selections)
                 }
             },
             processResults : function(results){
                console.log({results})
                  return {results : results}
             }
        },
        

    });


});

$(document).off('click', '.removePhoneRow').on('click', '.removePhoneRow', function(e){

    e.preventDefault();

    $(this).closest('.form-group').remove();

});

function canAddPhoneRow(count){
    
    return count > 3 ? false : true;

}

$(document).off('click', '#updatePersonalInfo').on('click', '#updatePersonalInfo', function(e){

    e.preventDefault();

    let volunteer_id = $(this).data('id');

    let form = $(this).data('target');

    let data = $('#'+form).serializeArray();

    sendAjax({
        url : '/updatedProfile/updatePersonalInfo/'+volunteer_id,
        data,
        method : "post",
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer_id
        });
    }, function({status, responseJSON}){

        if(status === 422){

            let {errors} = responseJSON;

            validationError($('#'+form), errors);    
        }else{
            toastr.error("Please contact for support");
        }

    })

});

function validationError(form, errors){ 

    clearValidationHighlights(form);   

    for(let key in errors){

        form.find(`[name = "${key}"]`).css("border-color", "#b12704");

    }

}

function clearValidationHighlights(form){
    form.find(`input`).css("border-color", "#ddd");
}

$(document).off('click', '#submitEmergencyContact').on('click', '#submitEmergencyContact', function(e){

    e.preventDefault();

    let volunteer_id = $(this).data('id');

    let form = $(this).data('target');

    let data = $('#'+form).serializeArray();

    sendAjax({
        url : '/updatedProfile/emergencyContact/'+volunteer_id,
        data,
        method : "post",
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer_id
        });
    }, function({status, responseJSON}){

        if(status === 422){

            let {errors} = responseJSON;

            validationError($('#'+form), errors);    
        }

    })

});


$(document).off('click', '#updateEmergencyContact').on('click', '#updateEmergencyContact', function(e){

    e.preventDefault();

    let emergencyContactId = $(this).data('id');

    let volunteer_id = $(this).data('related-vol-id');

    let form = $(this).data('target');

    let data = $('#'+form).serializeArray();

    sendAjax({
        url : '/updatedProfile/updateEmergencyContact/'+emergencyContactId,
        data,
        method : "post",
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer_id
        });
    }, function({status, responseJSON}){

        if(status === 422){

            let {errors} = responseJSON;
            validationError($('#'+form), errors);    
        }

    })

});


$(document).off('click', '#updateHrBasic').on('click', '#updateHrBasic', function(e){

    e.preventDefault();

    let volunteer_id = $(this).data('id');

    let form = $(this).data('target');

    let data = $('#'+form).serializeArray();

    sendAjax({
        url : '/updatedProfile/updateHrBasic/'+volunteer_id,
        data,
        method : "post",
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer_id
        });
    }, function({status, responseJSON}){

        if(status === 422){

            let {errors} = responseJSON;
            validationError($('#'+form), errors);    
        }

    })

});

$(document).off('click', '#updateHrDetails').on('click', '#updateHrDetails', function(e){

    e.preventDefault();

    let volunteer_id = $(this).data('id');

    let form = $(this).data('target');

    let data = $('#'+form).serializeArray();

    sendAjax({
        url : '/updatedProfile/updateHrDetails/'+volunteer_id,
        data,
        method : "post",
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer_id
        });
    }, function({status, responseJSON}){

        if(status === 422){

            let {errors} = responseJSON;
            validationError($('#'+form), errors);
        }

    })

});

$(document).off('click', '#updateVolRemarks').on('click', '#updateVolRemarks', function(e){
    e.preventDefault();
    let volDeactivate = $(this).data('id')

    let volunteer_id = $(this).data('vol-id')
    
    let form = $(this).data('target');

    let data = $('#'+form).serializeArray();

    sendAjax({
        url : '/updatedProfile/updateVolRemarks/'+volDeactivate,
        data,
        method : "post",
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer_id
        });
    });
})


$(document).off('click', '#addVolunteerFiles').on('click', '#addVolunteerFiles', function(e){

    e.preventDefault();

    let volunteer_id = $(this).data('id');

    let form = $(this).data('target');

    let data = new FormData($('#'+form)[0]);

    sendAjax({
        url : '/updatedProfile/uploadDocs/'+volunteer_id,
        data,
        method : "post",
        loader:true,
        processData : false,
        contentType : false
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer_id
        });
    })

});

$(document).off('click', '.viewVolFile').on('click','.viewVolFile', function(e){
    let file = $(this).attr('data-file');
    window.open('/updatedProfile/viewDocs/'+file);
})

$(document).off('click', '.downloadVolFile').on('click','.downloadVolFile' , function(e){
    let file = $(this).attr('data-file');
    window.open('/updatedProfile/downloadDocs/'+file);
})



$(document).off('change', '#deActiveVol').on('change','#deActiveVol', function(e){

    let isChecked = $(this).prop('checked');

    if(isChecked){

        $('.deactivationDetails').slideDown();

    }else{

        $('.deactivationDetails').slideUp();

    }

});

$(document).off('click', '.unassignFromVol').on('click', '.unassignFromVol', function(e){

    e.preventDefault();

    let unassignType = $(this).attr('data-type');
    let id = $(this).attr('data-id')
    let volunteer_id = $(this).attr('data-vol-id')

    const self = $(this)

    function unassignFromVol(type){

        let url = '/';

        if(type == "supervisor"){

            url = `/updatedProfile/unassignSupervisorFromVol/`;                

        }else{

            url = `/updatedProfile/unassignSiteFromVol/`;

        }

        return url;


    }

    let unassignUrl = unassignFromVol(unassignType);

    confirmAction({

        "message" : `Are you sure you want to unassign this ${unassignType}?`,
        "action"   : "Ok",
        "btn" : "btn-danger",
        ajax : {
            url : unassignUrl+volunteer_id+'/'+id,
            success:function(){
                self.closest('tr').remove();

                toastr.success("Successfully unassigned")
            }
        }
    })
  

});


$(document).off('click', '.removeTemplate').on('click', '.removeTemplate', function(e){

    let template_id = $(this).attr('data-template-id')

    const self = $(this)

    confirmAction({

        "message" : " Are you sure you want to delete this timesheet?",
        "action"   : "Ok",
        "btn" : "btn-danger",
        ajax : {
            url : '/updatedProfile/removeTemplate/'+template_id,
            success:function(){
                toastr.success("Template Successfully Removed")
                self.closest('tr').remove();
            }
        }
    })

});

$(document).off('click', '.setHomeSite').on('click', '.setHomeSite', function(e){

    e.preventDefault();

    let site = $(this).attr('data-site-id')

    let volunteer = $(this).attr('data-volunteer-id')

    sendAjax({
        url : '/updatedProfile/setHomeSite/'+volunteer+"/"+site,
        method : "get",
        loader:true,
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer
        });
    })

});

$(document).off('click', '.setDefaultTemplate').on('click', '.setDefaultTemplate', function(e){

    e.preventDefault();

    let template = $(this).attr('data-template-id');

    let volunteer = $(this).attr('data-volunteer-id');

    sendAjax({
        url : '/updatedProfile/setDefaultTemplate/'+volunteer+"/"+template,
        method : "get",
        loader:true,
    }, function(){
        processModal();
        routes.executeRoute('view/vol/{volunteer}', {
            url: 'view/vol/'+volunteer
        });
    })

});

