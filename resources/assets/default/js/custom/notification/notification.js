

var notificationConfig = {
    notificationContainer: 'CustomNotification_events',
    notificationspan: 'NotificationSpan',
    notificationTitle: 'NotificationTitle',
    notificationReminder: 'ReminderSection'
};


function loadNotification() {
    ajaxRequest({
        url: '/notifications',
        method: 'get'
    }, function (response) {
        appendtoNotification(response.data);
    });
}

function appendNotification(notification) {
    emptyNotification();
    $.each(notification, function (index, value) {
        var markup = ' <div class="m-list-timeline__item"> <span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>' +
            '<a data-route="' + value.url + '" class="m-list-timeline__text is_notification" style="cursor: pointer" data-id="' + value.id + '" data-table="' + value.table_name + '" data-tableid="' + value.table_id + '">' + value.message + ' </a>' +
            '<span class="m-list-timeline__time">' + moment(value.created_at).fromNow() + '</span>  ' +
            '</div>';
        $('#' + notificationConfig.notificationContainer).prepend(markup);
    });
}

function appendReminder(reminder) {
    emptyReminder();
    $.each(reminder, function (index, value) {
        var markup = ' <div class="m-list-timeline__item"> <span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>' +
            '<a data-route="' + value.url + '" class="m-list-timeline__text is_notification" style="cursor: pointer" data-id="' + value.id + '" data-table="' + value.table_name + '" data-tableid="' + value.table_id + '">' + value.title + ' </a>' +
            '<span class="m-list-timeline__time">' + moment(value.created_at).fromNow() + '</span>  ' +
            '</div>';
        $('#' + notificationConfig.notificationReminder).prepend(markup);
    });
}

function appendtoNotification(newnotification) {
    if (!newnotification)
        return;

    if (newnotification.hasOwnProperty('notification'))
        appendNotification(newnotification.notification);
    if (newnotification.hasOwnProperty('reminder'))
        appendReminder(newnotification.reminder);
    if (newnotification.hasOwnProperty('total'))
        prepareHeader(newnotification.total);
}

function prepareHeader(total) {
    $("#NotificationSpan").hide();

    if (total) {
        $('#' + notificationConfig.notificationspan).show().html(total);
    }
}


function emptyNotification() {
    $('#' + notificationConfig.notificationContainer).empty();
}

function emptyReminder() {
    $('#' + notificationConfig.notificationReminder).empty();
}

$(document).on('click', '.is_notification', function (e) {
    var id = $(this).attr('data-id');
    var tableid = $(this).attr('data-tableid');
    setCookie('forward_period_id', tableid);
    ajaxRequest({
        url: '/notifications/' + id + '/markAsRead',
        method: 'get'
    }, function (response) {
        loadNotification();
    })
});
loadNotification();
setInterval(function () {
    loadNotification();
}, 60000);


function pinguser() {
    return ajaxRequest({
        url: '/userlog/ping',
        method: 'post'
    }, function (response) {
        if (response.data && response.data.status == 'error') {
            alert(response.data.message);
            location.assign('/');
        }
        return response;
    });
}

var global_ping;
// pinguser().then(({ data: response }) => {
//     response.ping_gap = parseFloat(response.ping_gap) < 3 ? 30 : response.ping_gap;
//     const ping_time = (parseFloat(response.ping_gap) - 1) * 60 * 1000;
//     clearInterval(global_ping);
//     setTimeout(function () {
//         global_ping = setInterval(pinguser, ping_time);
//     }, ping_time);
// });

$(document).on('click', '.markAllAsRead', function () {
    sendAjax('notifications/markAsRead/all', loadNotification);
});