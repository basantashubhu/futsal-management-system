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