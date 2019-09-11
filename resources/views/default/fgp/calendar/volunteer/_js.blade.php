<script>
	
	$(function(){

		$('[name^="time_in"], [name^="time_out"]').timepicker({
		    minuteStep: 5,
		    showInputs: false,
		    disableFocus: true,
		    showMeridian: false

		});

		$(document).off('change', '.timesheet-timepicker').on('change', '.timesheet-timepicker', function(){
			
		    var parent = $(this).closest('tr');

		    var first = parent.find('input.timesheet-timepicker').eq(0).val();
		    var second = parent.find('input.timesheet-timepicker').eq(1).val();

		    var total = calculateTimeDiff(first, second);

		    parent.find('[name ^= "total_hr"]').val(total);
		});

		/* Make the timesheet editable */

		$(document).off('click', '.editable-vol-site-ts').on('click','.editable-vol-site-ts', function(e){


			$(document).find('table.cal-ts-generated').removeClass('cal-ts-generated');

			$('.save-vol-site-ts').show();
			$('.clear-vol-site-ts').show();
			$(this).hide();

		});

		/* Clear timesheet inputs */

		$(document).off('click', '.clear-vol-site-ts').on('click','.clear-vol-site-ts', function(e){

			$(document).find('table.cal-table-ts').find(':input').each(function(i, el){

				$(el).val('');

			});


		});

		/* Add new items  */

		$(document).off('click', '.addCalTsOption').on('click', '.addCalTsOption', function(e){

			var self = $(this);					

			var options =  `<tr class="td-no-border-top odd">
			                <td colspan="4">
			                </td>
			                <td>
			                    <select name="label[]" id="" class="form-control stipendCategorySelect"></select>
			                </td>
			                <td>
			                    <select name="value[]" id="" class="form-control stipendCategoryValue"></select>

			                </td>
			                <td style="width: 80px;">
			                    <input type="text" class="form-control m-input appendAmount" name="amount[]" placeholder="Amount">
			                </td>
			                <td style="width: 40px;">
			                    <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeCalTsOption" style="width:20px; height:20px;margin-top:5px;" >
			                        <i class="la la-remove"></i>
			                    </a>
			                </td>
			            </tr>`;
			self.closest('tr').after(options);
			$('.stipendType').select2({

				width: "100%",
				placeholder : 'Stipend Type',
				ajax : {
					url : 'lookup/ts/stipend_type',
					processResults : function(data){

						let types = data.map(type => {
							return {
								'text' : type.text,
								'id' : type.text,
							}					
						});

						return {results : types}
					} 
				}

			});

			$('.stipendCategorySelect').select2({
				width : "100%",
				placeholder : "Stipend",
				ajax :{
					url : 'lookup/ts/stipend_category',
					processResults : function(data){

						let categories = data.map(category => {
							return {
								'text' : category.text,
								'id' : category.text,
							}					
						});

						return {results : categories}
					} 
				}
			}).on('select2:select', function(e){

				$(this).parent().next().find('select').attr('data-stipend-category', $(this).val());


			});

			$('.stipendCategoryValue').select2({
				width : '100%',
				placeholder: "Select Stipend ",
				ajax : {
					url : function(params){

						if(!$(this).attr('data-stipend-category')) return 'lookup/ts/stipend_items';

						return 'lookup/ts/stipend_items/?category='+$(this).attr('data-stipend-category').toLowerCase()
					},
					processResults : function(data){

						let categories_value = data.map(cat_value => {
						    return {
						        'text' : cat_value.text,
						        'id' : cat_value.text,
						        'data_id' : cat_value.id
						    }                   
						});

						return {results : categories_value}
					} 
				}

			}).on('select2:select', function(){

				const self = $(this);

				let selected_id = $(this).select2('data')[0].data_id;

				$.ajax({
					url : 'lookup/ts/fetchStipendDetails/'+ selected_id,
					success:function(data){

						self.closest('td').next().find('input').val(data.unit_amount);

					}
				})

			});

		});

		/* Remove the added items */
		$(document).off('click', '.removeCalTsOption').on('click', '.removeCalTsOption', function(e){
        	e.preventDefault();
        	$(this).closest('tr').remove();
    	});


		$(document).off('click', '.save-vol-site-ts').on('click', '.save-vol-site-ts', function(e){

			e.preventDefault();

			let formdata = $('table.cal-table-ts :input').serializeArray();

			let timesheet_id = $(this).attr('data-timesheet-id');

			sendAjax({

				url : 'saveCalendarSiteVol/ts/'+timesheet_id,
				method : "post",
				loader : true,
				data : formdata

			},function(data){

				toastr.success("Timesheet updated");

				$('.save-vol-site-ts').hide();
				$('.clear-vol-site-ts').hide();
				$('.editable-vol-site-ts').show();

				$('table.cal-table-ts').addClass('cal-ts-generated');

				let response;

				response = `
					
					<tr class="odd">
					    <td style="font-weight: 600; width: 100px">
					        ${data.formatted_date} (${data.formatted_week_day})
					    </td>
					    <td style="width: 150px;">
					        <select class="form-control m-input stipendType" name="time_type">
					            <option 
					            value="${data.type_label}" 
					            selected>
					                ${data.type_label}
					            </option>                                
					        </select>

					        <label>${data.type_label}</label>
					    </td>
					    <td style="width: 100px">
					        <input type="text" class="form-control m-input timein_timepicker"
					        name="time_in"
					        value="${data.formatted_time_in}"
					        >

					        <label>
					        	${data.formatted_time_in}
					        </label>
					    </td>
					    <td style="width: 100px">
					        <input type="text" class="form-control m-input timeout_timepicker"
					        name="time_out"
					        value="${data.formatted_time_out}" 
					        >
					        
					        <label for="">
					            ${data.formatted_time_out}
					        </label>
					    </td>
					    <td style="width: 100px">
					        <input type="text" class="form-control m-input break_timepicker"
					        name="break_in"
					        value="${data.formatted_break_in}" 
					        >

					        <label for="">
					            ${data.formatted_break_in}
					        </label>
					    </td>
					    <td style="width: 100px">
					        <input type="text" class="form-control m-input break_timepicker"
					        name="break_out"
					        value="${data.formatted_break_out}" 
					        >

					        <label for="">
					        	${data.formatted_break_out}
					        </label>
					    </td>					       
					    <td style="width: 100px">
					        <input type="text" class="form-control m-input" 
					        name="total_hr" 
					        value="${data.formatted_total_hrs}"
					        >

					        <label>${data.formatted_total_hrs}</label>
					    </td>
					    <td style="width: 40px"></td>
					</tr>
					<tr class="odd">
					    <td></td>
					    <td colspan="3">
					        <p class="itemLabel"><strong class="no-pd-i">Comment</strong></p>
					    </td>
					    <td>
					        <p class="itemLabel"><strong class="no-pd-i">Items</strong></p>
					    </td>
					    <td>
					        <p class="itemLabel"><strong class="no-pd-i">Category</strong></p>
					    </td>
					    <td>
					        <p class="itemLabel"><strong class="no-pd-i">Amount</strong></p>
					    </td>
					    <td></td>
					</tr>
					`;
					if(data.timesheet_items){

						$.each(data.timesheet_items, function(index, item){

							response += `

								<tr class="odd">`;
								    if(index === 0){
								    	response +=`
								        <td>
								            
								        </td>
								        <td colspan="3">                                               
								            <textarea placeholder="comment" rows="1" class="form-control" name="comment">${data.comment ? data.comment : ""}</textarea>
								           
								            <label>${data.comment ? data.comment: "- - -"}</label>
								        </td>`;
								    }else{
								    
								        response += `<td colspan="4" class="no-br-top"></td>`;

								   	}
								   	response += `
								    
								    <td>
								        <select name="label[]" id="" class="form-control stipendCategorySelect">
								            <option value="${item.type}">${item.type}</option>
								        </select>

								        <label>${item.type}</label>
								    </td>
								    <td>
								        <select name="value[]" id="" class="form-control stipendCategoryValue">
								            <option value="${item.value}">${item.value}</option>
								        </select>

								        <label for="">${item.value}</label>
								    </td>
								    <td>
								        <input type="text" class="form-control m-input appendAmount" name="amount[]" placeholder="Amount" value="${item.amount}">
								        <label>${item.amount? item.amount.toFixed(2) : '0.00'}</label>
								    </td>
								    <td>`;
								        if(index === 0){
								        	response += `
								            <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill addCalTsOption" style="width:20px; height:20px;margin-top:5px;"                                        
								            >
								                <i class="la la-plus"></i>
								            </a>`;
								        }else{
								        	response += `
								            <a href="#" class="btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill removeCalTsOption" style="width:20px; height:20px;margin-top:5px;" >
								                <i class="la la-remove"></i>
								            </a>
								            `;
								        }
								        response += `
								    </td>
								</tr>

							`;

						});	

					}else{

						response += `
							<tr class="odd">
							     
							    <td colspan="4" class="no-br-top"></td>
							     
							    <td>
							        <select name="label[]" id="" class="form-control stipendCategorySelect">
							        </select>

							    </td>
							    <td>
							        <select name="value[]" id="" class="form-control stipendCategoryValue">
							        </select>
							    </td>
							    <td>
							        <input type="text" class="form-control m-input appendAmount" name="amount[]" placeholder="Amount">
							    </td>
							    <td>
							         <a href="#" class="btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only m-btn--pill addCalTsOption" style="width:20px; height:20px;margin-top:5px;"                                        
							         >
							             <i class="la la-plus"></i>
							         </a>
							        
							     </td>
							</tr>`;

					}

					response +=`

				`.trim();

				$('table.cal-table-ts tbody').html(response);

				$('.stipendType').select2({

					width: "100%",
					placeholder : 'Stipend Type',
					ajax : {
						url : 'lookup/ts/stipend_type',
						processResults : function(data){

							let types = data.map(type => {
								return {
									'text' : type.text,
									'id' : type.text,
								}					
							});

							return {results : types}
						} 
					}

				});

				$('.stipendCategorySelect').select2({
					width : "100%",
					placeholder : "Stipend",
					ajax :{
						url : 'lookup/ts/stipend_category',
						processResults : function(data){

							let categories = data.map(category => {
								return {
									'text' : category.text,
									'id' : category.text,
								}					
							});

							return {results : categories}
						} 
					}
				}).on('select2:select', function(e){

					$(this).parent().next().find('select').attr('data-stipend-category', $(this).val());


				});

				$('.stipendCategoryValue').select2({
					width : '100%',
					placeholder: "Select Stipend ",
					ajax : {
						url : function(params){

							if(!$(this).attr('data-stipend-category')) return 'lookup/ts/stipend_items';

							return 'lookup/ts/stipend_items/?category='+$(this).attr('data-stipend-category').toLowerCase()
						},
						processResults : function(data){

							let categories_value = data.map(cat_value => {
							    return {
							        'text' : cat_value.text,
							        'id' : cat_value.text,
							        'data_id' : cat_value.id
							    }                   
							});

							return {results : categories_value}
						} 
					}

				}).on('select2:select', function(){

					const self = $(this);

					let selected_id = $(this).select2('data')[0].data_id;

					$.ajax({
						url : 'lookup/ts/fetchStipendDetails/'+ selected_id,
						success:function(data){

							self.closest('td').next().find('input').val(data.unit_amount);

						}
					})

				});

			});

		});		


		$('.stipendType').select2({

			width: "100%",
			placeholder : 'Stipend Type',
			ajax : {
				url : 'lookup/ts/stipend_type',
				processResults : function(data){

					let types = data.map(type => {
						return {
							'text' : type.text,
							'id' : type.text,
						}					
					});

					return {results : types}
				} 
			}

		});

		$('.stipendCategorySelect').select2({
			width : "100%",
			placeholder : "Stipend",
			ajax :{
				url : 'lookup/ts/stipend_category',
				processResults : function(data){

					let categories = data.map(category => {
						return {
							'text' : category.text,
							'id' : category.text,
						}					
					});

					return {results : categories}
				} 
			}
		}).on('select2:select', function(e){

			$(this).parent().next().find('select').attr('data-stipend-category', $(this).val());


		});

		$('.stipendCategoryValue').select2({
			width : '100%',
			placeholder: "Select Stipend ",
			ajax : {
				url : function(params){

					if(!$(this).attr('data-stipend-category')) return 'lookup/ts/stipend_items';

					return 'lookup/ts/stipend_items/?category='+$(this).attr('data-stipend-category').toLowerCase()
				},
				processResults : function(data){

					let categories_value = data.map(cat_value => {
					    return {
					        'text' : cat_value.text,
					        'id' : cat_value.text,
					        'data_id' : cat_value.id
					    }                   
					});

					return {results : categories_value}
				} 
			}

		}).on('select2:select', function(){

			const self = $(this);

			let selected_id = $(this).select2('data')[0].data_id;

			$.ajax({
				url : 'lookup/ts/fetchStipendDetails/'+ selected_id,
				success:function(data){

					self.closest('td').next().find('input').val(data.unit_amount);

				}
			})

		});


	});



</script>