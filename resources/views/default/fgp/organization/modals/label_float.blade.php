<script>
    $("input[name=tel_phone], input[name=person_alt_phone], input[name=alt_phone]").inputmask("mask", {
        "mask": "(999) 999-9999"
    });
	$('#organizationCreate :input').each(function() {
        floatLabelInput(this, true);
    })
    .off('focus')
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

	$('#industry_id').select2({
        width : "100%",
        dropdownParent: $('#modalContainer'),
        ajax : {
            url : 'industry/type?lookup=industry_type',
            processResults : function(data){
                let industry = [];
                $.each(data,function(index,value){
                    industry.push({id:value.val, text:value.text})
                });
                return {
                    results : industry
                }
            }
        }
    });
	$('#lookup_city').select2({
        width : "100%",
        dropdownParent: $('#modalContainer'),
        ajax : {
            url : 'location/city/name',
            processResults : function(data){
                return {
                    results : data
                }
            }
        }
    }).on('select2:select', function(e){
    	let city_id = $(this).val();
    	$.ajax({
    		url:'getAddress?city='+city_id,
    		method:'get',
    		error:function(error){
    			console.log(error)
    		},
    		success:function(data){
    			$('select#lookup_city').html(`<option value="${data.city}" selected>${data.city}</option>`);
    			$('input#zip').val(data.zip_code);
    			$('input#state').val(data.state);
    			$('input#county').val(data.county);
    			$('input#region').val(data.region);
    			$('input#district').val(data.district);
    			$('#organizationCreate :input').each(function() {
			        floatLabelInput(this, true);
			    });
    		}

    	})
	});


       $(document).off('click','#addOrganization').on('click','#addOrganization', function (e) {
        e.preventDefault();
        var form = $(this).attr('data-target');
        var request = {
            url: '/fgp/organization/store',
            method: 'post',
            form: form
        };

        addFormLoader();
        ajaxRequest(request, function (response) {
            processForm(response, function () {
                if(response.status === 200){
                    removeFormLoader();
                    $('#modalContainer').modal('hide');
                     reloadDatatable('#orgn_data_table');
                }
            });
        });
    });

	
</script>
