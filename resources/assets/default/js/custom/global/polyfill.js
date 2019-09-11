


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