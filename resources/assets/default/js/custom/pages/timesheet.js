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
