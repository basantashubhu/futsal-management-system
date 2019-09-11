$(document).off('submit', '#form_app').on('submit', '#form_app', function (e) {
    e.preventDefault();
    // console.log($(this).serializeArray());
    if (validateForm($(this).attr('id'))) {
        var request = {
            url: 'web/application',
            form: $(this).attr('id'),
            method: 'Post'
        };
        ajaxRequest(request, function (response) {
            if (response && response.data)
                $('#renderPartialPage').html(response.data);
            window.scrollTo(0, 0);
        })
    }

});

$(document).off('change', '#partnerzip').on('change', '#partnerzip', function (e) {
    var value = $(this).val();
    var request = {
        url: 'web/partners/' + value,
        method: 'GET'
    };
    ajaxRequest(request, function (response) {
        if (response && response.data)
            $('#patnerSearchHolder').html(response.data);
    })

});

function validateForm(form) {
    var noerror = true;
    var data = $('#' + form).serializeArray();
    var requiredfield = [
        'legalName', 'dob', 'ssn', 'add1', 'city', 'zip', 'personal_email', 'cell_phone', 'pet_name1', 'age_type1',
        'age_of_pet1', 'breed1','signature'
    ];
    $.each(requiredfield, function (index, value) {
        if ($("input[name='" + value + "']").length && $("input[name='" + value + "']").val().length) {
            $("input[name='" + value + "']").removeClass('haserror');
        } else {
            $("input[name='" + value + "']").addClass('haserror');
            console.log(value);
            noerror = false
        }

    });
    // console.log(noerror);
    return noerror;
}