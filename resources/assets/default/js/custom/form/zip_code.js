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