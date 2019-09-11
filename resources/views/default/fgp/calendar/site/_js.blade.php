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


		$('#calendar-sites-vol li').off('click').on('click', function(e){

			e.preventDefault();			

			siteVolLists.highlight( $(this) );

			let response = siteVolLists.fetchCalendarTs( $(this) );


		});

		/* Make the timesheet editable */

		$(document).off('click', '.editable-cal-site-ts').on('click','.editable-cal-site-ts', function(e){


			$(document).find('table.cal-ts-generated').removeClass('cal-ts-generated');

			$('.save-cal-site-ts').show();
			$('.clear-cal-site-ts').show();
			$(this).hide();

		});

		/* Clear timesheet inputs */

		$(document).off('click', '.clear-cal-site-ts').on('click','.clear-cal-site-ts', function(e){

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


		$(document).off('click', '.save-cal-site-ts').on('click', '.save-cal-site-ts', function(e){

			e.preventDefault();

			let formdata = $('table.cal-table-ts :input').serializeArray();

			let timesheet_id = $(this).attr('data-timesheet-id');

			sendAjax({

				url : 'saveCalendarSiteVol/ts/'+timesheet_id,
				method : "post",
				loader : true,
				data : formdata

			},function(response){

				toastr.success("Timesheet updated");

				$('.calendar-sites-active').trigger('click');

			});

		})

		/* Site list object to fetch data for the site lists */
		var siteVolLists = {

			highlight: (el) =>{

				el.addClass('calendar-sites-active');
				el.siblings().removeClass('calendar-sites-active');

			},

			getOptions(el){		

				let options;

				return options = {

					period_id  : el.attr('data-period-id'),
					vol_id  : el.attr('data-vol-id'),
					site_id  : el.attr('data-site-id'),
					date  : el.attr('data-date'),
				}
				
			},

			fetchCalendarTs(el){

				let options = this.getOptions(el);

				let response;

				sendAjax({

					url : `site-calendar/site/${options.site_id}/vol/${options.vol_id}/${options.period_id}/${options.date}`,
					method: 'get',

				}, function(resp){

					$('#calendar-site-right-sec').html(resp);

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

				}, function(err){

					toastr.error("something unexpected happened");

				});

			},
			


		}


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