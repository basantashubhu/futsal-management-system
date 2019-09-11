
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