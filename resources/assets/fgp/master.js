/**
 * DEVELOPERS
 * ----------------------------------------------
 * SUMAN  THAPA - LEAD  (NEPALNME@GMAIL.COM)
 * ----------------------------------------------
 * - PRABHAT GURUNG
 * - BASANTA TAJPURIYA
 * - RAKESH SHRESTHA
 * - MANISH BUDDHACHARYA
 * - LEKH RAJ RAI
 * - ASCOL PARAJULI
 * -----------------------------------------------
 * Created On: 3/26/2019
 *
 * THIS INTELLECTUAL PROPERTY IS COPYRIGHT Ⓒ 2019
 * SHUBHU TECH PVT LTD , NEPAL. ALL RIGHT RESERVED
 * 
 * change
 */


/*
ajax function using jquery ajax
* */
function sendAjax(props, callback = resp => 1, errorCallback = err => 1) {
    props = typeof props === 'string' ? {
        url: props
    } : props;
    if (props.loader) {
        addFormLoader();
        props.complete = removeFormLoader;
    }
    if (props.data instanceof FormData) {
        Object.assign(props, {
            contentType: false,
            processData: false
        });
    }
    return $.ajax(props).then(callback, errorCallback);
}

function processAjaxForm(responseArr, cb = false) {
    toastr.options.preventDuplicates = true;
    cb = typeof cb === 'function' ? cb : element => element;
    if (typeof responseArr === 'object' && responseArr !== null) {
        if (responseArr.hasOwnProperty('responseJSON') && responseArr.status === 422) {
            const highlight = true;
            return formValidation(responseArr, highlight);
        }
        responseArr = responseArr.hasOwnProperty('responseJSON') ? responseArr.responseJSON : responseArr;
        if (!'message' in responseArr)
            for (const response of responseArr) {
                const msg = response.data;
                if (response.type === 'success') {
                    toastr.success(msg);
                } else {
                    toastr.error(msg);
                }
                cb(response.element);
            }
    }
}

/*
 * form validator with toastr message
 * */
function formValidation(err, highlight = false) {
    let message = '';
    if (highlight) {
        message = 'Please check highlighted fields.<br><br>';
        $('form [name]').css('border-color', '#ccc');
        $('form [name]+.note-editor').css('border-color', '#ccc');
        $('form [name]+.select2-container').find('.select2-selection--single').css('border-color', '#ccc');
        $('form [name]').siblings('.btn.dropdown-toggle').css('border-color', '#ccc');
    }
    if (err.status === 422) {
        for (let [i, msg] of Object.entries(err.responseJSON.errors)) {
            msg = typeof msg === 'string' ? msg : msg.join('');
            message += msg + '<br>';
            if (highlight) {
                $('form [name="' + i + '"]').css('border-color', 'brown');
                $('form [name="' + i + '"]+.note-editor').css('border-color', 'brown');
                $('form [name="' + i + '"]+.select2-container').find('.select2-selection--single').css('border-color', 'brown');
                $('form [name="' + i + '"]').siblings('.btn.dropdown-toggle').css('border-color', 'brown');
            }
        }
    }
    message = message ? message : err.status + ' ' + err.statusText;
    toastr.error(message);
}

/*
 * confirm box before ajax action
 * */
function confirmAction(props, callback = '') {
    let date = new Date();
    const modal_id = date.getTime();
    props.btn = props.btn || 'btn-primary';
    props.fresh = props.fresh || true;
    if (props.fresh) {
        $('.custom-confirm-modal').remove();
    }
    $('body').append(`
    <div class="modal fade std-modal modal-default custom-confirm-modal" id="confirm-${modal_id}" tabindex="-1" role="dialog" aria-labelledby="modalContainerHeader" data-backdrop="static" data-keyboard="false" style="z-index: 99999; display: none;" >
    <style>
        .modal-header-danger {
            background-color: #fb7b91 !important;
            border-color: #fb7b91 !important;
        }    
    </style>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="background: #fff;">
                <p>${props.message}</p>
            </div>
            <div class="modal-footer" style="display: inline-block; background: #eee;">
                <button type="button" class="btn btn-secondary m-btn--pill float-left" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn m-btn--icon ${props.btn} m-btn--pill float-right" data-dismiss="modal" id="btn-${modal_id}-confirm">
                    <span>
                        ${props.action}
                    </span>
                </button>
            </div>
        </div>
    </div>
    </div>
    `.trim());

    $('#confirm-' + modal_id).modal('show');
    if (props.ajax) {
        $(`#btn-${modal_id}-confirm`).off('click').on('click', function () {
            sendAjax(props.ajax);
        });
    }
    if (typeof callback === 'function') {
        $(`#btn-${modal_id}-confirm`).off('click').on('click', function (e) {
            callback(e);
        });
    }
    if (typeof props.callback === 'function') {
        props.callback();
    }
}

function hasCooke(cname, item = false) {
    const cookie = getCookie(cname);
    if (!cookie || !item) return !1;
    const check = (cookieArr, item) => cookieArr.filter(x => x.name === item).length > 0;
    return check(JSON.parse(cookie), item);
}

function hasCookie(cname, item = false) {
    const cookie = getCookie(cname);
    if (!cookie || !item) return !!cookie;
    const check = (cookieArr, item) => cookieArr.filter(x => x.name === item);
    return check(JSON.parse(cookie), item) > 0;
}

function resetCookie(key) {
    let cookies = typeof key === 'string' ? arguments : key;
    for (let i = 0; i < cookies.length; i++) {
        setCookie(cookies[i], '', 0);
    }
}

function deleteCookieOf(cookie, key) {
    (function (cookieArr, cookie) {
        cookieArr = cookieArr.filter(function ({
            name
        }) {
            return name !== key;
        });
        setCookie(cookie, JSON.stringify(cookieArr));
    })(JSON.parse(getCookie(cookie) || '[]'), cookie);
}

function put_filter(key, data, append = false) {
    let time_sheet_cookie = JSON.parse(getCookie(key) || '[]');
    let hasReplaced = false;
    for (let i = 0; i < time_sheet_cookie.length; i++) {
        if (time_sheet_cookie[i].name !== data.name) continue;
        time_sheet_cookie[i] = !append ? data : {
            name: data.name,
            value: [time_sheet_cookie[i].value, data.value].join(',')
        };
        hasReplaced = true;
        break;
    }
    if (!hasReplaced) {
        time_sheet_cookie.push(data);
    }
    setCookie(key, JSON.stringify(time_sheet_cookie));
}

String.prototype.escapeSpecialChars = function () {
    return this.replace(/\\n/g, "\\n")
        .replace(/\\'/g, "\\'")
        .replace(/\\"/g, '\\"')
        .replace(/\\&/g, "\\&")
        .replace(/\\r/g, "\\r")
        .replace(/\\t/g, "\\t")
        .replace(/\\b/g, "\\b")
        .replace(/\\f/g, "\\f");
};

String.prototype.hashCode = function () {
    let hash = 0,
        i, chr;
    if (this.length === 0) return hash;
    for (i = 0; i < this.length; i++) {
        chr = this.charCodeAt(i);
        hash = ((hash << 5) - hash) + chr;
        hash |= 0; // Convert to 32bit integer
    }
    return hash;
};

String.prototype.formatHrs = function () {
    let hours = Math.floor(this);
    const mins = Math.round((this - hours) * 60);
    hours = String(hours).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    return `${hours} : ${mins < 10 ? `0${mins}` : mins}`;
}

Number.prototype.formatHrs = function () {
    let hours = Math.floor(this);
    const mins = Math.round((this - hours) * 60);
    hours = String(hours).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    return `${hours}:${mins < 10 ? `0${mins}` : mins}`;
}

// Number.prototype.formatToThousands = function(){
//     return this.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
// }


function replaceLookups(context = null) {
    $('input[data-lookup]:not([data-advanced])', context || document).each(function (i, elem) {
        const element = $(elem);
        const url = element.attr('data-lookup'),
            value = element.val();
        const select = document.createElement('SELECT');
        select.className = 'form-control';
        select.title = 'Choose';
        select.name = element.attr('name');
        if (element.attr('multiple')) {
            select.multiple = "multiple";
            if (element.attr('title'))
                select.title = element.attr('title');
            select.setAttribute('data-selected-text-format', 'count>1');
            select.setAttribute('data-actions-box', 'true');
            select.setAttribute('data-live-search', 'true');
            select.setAttribute('data-done-button', 'true');
            select.setAttribute('data-done-button-text', 'Apply');
        }
        element.replaceWith(select);
        $(select).selectpicker({
            width: '100%'
        });
        sendAjax(url, function (results) {
            results = results.map(x => `<option value="${x.value}">${x.value}</option>`);
            $(select).html(results).selectpicker('refresh').selectpicker('val', value);
        });
    });
}

function tooltip(props = {}) {
    const options = {
        placement: 'bottom'
    };
    Object.assign(options, props);
    $('[data-tooltip]').tooltip(props);
}

$(document)
    .off('click', '.m-datatable__row')
    .on('click', '.m-datatable__row', function (e) {

        let checkBox = $(this).find('td input[type="checkbox"]');

        if (checkBox.length) {

            checkBox.first().prop("checked", !checkBox.prop("checked"));

            checkBox.first().trigger('change')

        }

    });

/* 
    overriding default behavior of daterangepicker
*/
$(document).on('click focus', '.daterangepicker_input input', e => {
    e.stopImmediatePropagation();
    e.stopPropagation();
    e.preventDefault();
});

$(document).on('click', '[data-range-key="No range defined"]', e => {
    const span = $(`<span data-modal-route="vsy-calendar-add" data-modal-callback="reloadCurrentRoute" class="hidden"></span>`);
    $('body').append(span);
    span.click();
    span.remove();
});

function reloadCurrentRoute() {
    const url = location.hash.slice(1);
    $('#contentHolder').load(url);
}


function processModalSilently(callback = '') {
    $('.modal-dialog,.modal-backdrop').remove();
    $('.modal.show').modal('hide');
}


$(document).on('click', '.makeEditable', function (e) {
    e.preventDefault();

    const self = $(this);
    const form = $(`#${ self.attr('data-target') }`);

    form.find(':input:not(.exception-disable)').prop('disabled', false);
    $(self.attr('data-id')).prop('disabled', false);
    self.siblings('[data-target]').removeClass('d-none');

    self.addClass('d-none');
});

$(document).on('click', '.loadPage', function (e) {
    e.preventDefault();
    const route = $(this).attr('data-route1');
    addFormLoader();
    sendAjax(route, function (content) {
        $('#contentHolder').html(content);
        location.hash = route;
        removeFormLoader();
    });
});
