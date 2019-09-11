<script>
	applicationTopDateLoader();
	loadSearchDateRange("postMailDateRange");
	$(document).off('click', '.showList').on('click', '.showList', function(e){
		e.preventDefault();
		var ref = $(this).attr('data-ref');
        var url = $(this).attr('data-url');
		$(this).hide();
		$('#'+ref).show();
		var request = {
			url: url,
			method: 'get'
		}
		ajaxRequest(request, function(response){
			$('#mailContentHolder').html(response.data);
		});
	});

    $(document).off('click', '#generateFormSubmit').on('click', '#generateFormSubmit', function (e) {
    	e.preventDefault();
        var d = $('#mailForm').find('.demoChecked');
        if(d.length > 0){
            var request = {
                url: '/generateMailList',
                method: 'post',
                form: $(this).attr('data-target')
            };
            addFormLoader();
            ajaxRequest(request, function (response) {
                processForm(response, function () {
                    removeFormLoader();
                    $('#showAllLists').show();
                    $('#showMailList').hide();

                    reloadDatatable('#post_mail_datatable');
                    reloadDatatable('#applicationTable');
                    var request = {
                        url: 'getGenerateLists',
                        method: 'get'
                    }
                    ajaxRequest(request, function(response){
                        $('#mailContentHolder').html(response.data);
                    });
                    if (response && response.data && response.data[0].hasOwnProperty('element') && response.data[0].element.hasOwnProperty('merge_id')) {
                        setTimeout(function() {$('#post_mail_datatable').find('tr[data-active-id='+response.data[0].element.merge_id+']').addClass('active_class_row');}, 1000);
                    }
                });

            });
        }else{
            return toastr.error('Please Check The CheckBox');
        }
    });


    $(document).off('change', '.checkedToGenerate:not(.m-checkbox--all):not([disabled]) input[type=checkbox]')
            .on('change', '.checkedToGenerate:not(.m-checkbox--all):not([disabled]) input[type=checkbox]', function (e) {
                // console.log($(this));
                var self = $(this);
                self.removeAttr("name", "id[]");
                self.removeClass("demoChecked");
                if (self.prop('checked')) {
                    self.addClass("demoChecked");
                    self.attr('name', 'id[]');
                }
                if($('.demoChecked').length > 0){
                    $('#generateButtons').show();
                    appendGenerateButton($('.demoChecked').length);
                }else{
                    $('#generateButtons').hide();
                }
    });
    function appendGenerateButton(datas) {
            var markup = ' <div class="row align-items-center">\n' +
                    '                    <div class="col-xl-12">\n' +
                    '                        <div class="m-form__group m-form__group--inline">\n' +
                    '                            <div class="m-form__label m-form__label-no-wrap">\n' +
                    '                                <label class="m--font-bold m--font-danger-">Selected\n' +
                    '                                    <span id="m_datatable_selected_number1">' + datas + '</span> records:</label>\n' +
                    '                            </div>\n' +
                    '                            <div class="m-form__control">\n' +
                    '                                <div class="btn-toolbar">\n' +
                    '                                    <button href="#" class="btn btn-info btn-sm m-btn m-btn--icon m-btn--pill" id="generateFormSubmit" data-target="mailForm">' +
                    '<span>' +
                    'Generate' +
                    '</span>' +
                    '</button>\n' +
                    '\n' +
                    '                                    &nbsp;\n' +
                    '                                </div>\n' +
                    '                            </div>\n' +
                    '                        </div>\n' +
                    '                    </div>\n' +
                    '                </div>';
            $('#generateButtons').html(markup);
        }
    $(document).off('change', '.m-checkbox--all.checkedToGenerate:not([disabled]) input[type=checkbox]')
    .on('change', '.m-checkbox--all.checkedToGenerate:not([disabled]) input[type=checkbox]', function (e) {
        var self = $(this);
        $('.demoChecked').removeClass('demoChecked');
        if ($(this).prop('checked')) {
            $('.checkedToGenerate:not(.m-checkbox--all) input[type=checkbox]').trigger('change');
        }

    });

     updateMail();
     function updateMail(){
     	var request = {
     		url: 'countMailFileMerge',
     		method: 'get'
     	}
     	ajaxRequest(request, function(response){
     		$('#updateBadge').text(response.data);
     	});
     }

</script>