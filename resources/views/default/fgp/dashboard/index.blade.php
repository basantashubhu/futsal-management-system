<?php

?>

<style>
    table.dataTable th {
        background-color: #ffffff !important;
    }
    .tooltip-inner {
        max-width: 400px !important;
    }
</style>
@include('default.fgp.dashboard.head')

<div class="m-content">
    @include('default.fgp.dashboard.includes.summary')
    {{-- @include('default.fgp.dashboard.includes.cascading-search') --}}
</div>
<script>
    /* $(function () {
        ajaxRequest({
            url: '/period/current-period',
            beforeSend: addFormLoader
        }, function (response) {
            $('#PeriodContents').html(response.data);
            removeFormLoader();
        });
    }); */

$(document).off('click', '.group_stipend_period').on('click', '.group_stipend_period', function (e) {
    $("#addTimesheet").attr("data-id", $(this).data('id'));
    if (this.checked) {
        $('.' + this.dataset.class).prop('checked', true);
        $(this).closest('tr').addClass('checked').siblings('tr.checked').removeClass('checked');
    } else {
        $('.' + this.dataset.class).prop('checked', false);
        $(this).closest('tr').removeClass('checked');
    }
});
var last_count = 0;
$('#notifications_table').on('m-datatable--on-ajax-done', function(e, data) {
    last_count = data.length - 1;
});

var vDatatable = $('#notifications_table').mDatatable({
    // datasource definition
    data: {
        type: 'remote',
        source: {
            read: {
                url: '/notifications/all',
                method:'GET'
            },
        },
        pageSize: 5,
        saveState: false,
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true,

    },
    layout: {
        scroll: false,
        height: 200,
        smoothScroll: {
            scrollbarShown: false
        }
    },
    // column sorting
    sortable: true,
    pagination: false,
    toolbar: {
        // toolbar items
        items: {
            // pagination
            pagination: {
                // page size select
                pageSizeSelect: [5, 10, 20, 30, 50, 100],
            },
        },
    },
    search: {
        input: $('#generalSearch'),
    },
    rows: {
        // auto hide columns, if rows overflow
        autoHide: true,
        afterTemplate(row, data, index) {
            if(last_count === index) {
                $('[data-tooltip]').tooltip({placement: 'bottom'});
            }
        }
    },
    // columns definition
    columns: [
        {
            field: 'created_at',
            title: 'Date',
            sortable: 'asc',
            template: function(row){
                return moment( row.created_at).format(std.config.date_format);
            },
            width: 100
        },{
            field: 'message',
            title: 'Title',
            width: 290,
            template({message}) {
                return `<span title="${message}" data-tooltip>${message}</span>`
            }
        },{
            field: '',
            title: '',
            width: 40,
            template: function(row){
                return `<button type="button" class="m-portlet__nav-link btn m-btn m-btn--hover-primary is_notification m-btn--icon m-btn--icon-only m-btn--pill" data-id="${row.id}" data-table="${row.table_name}" data-tableid="${row.table_id}" data-m-route="${row.url}" data-date="${row.created_at}" data-message="${row.message}" data-user="${row.user_name}">
                        <i class="la la-eye"></i></button>`;
            },
        },]
});

$(document).off('click', '[data-m-route]').on('click', '[data-m-route]', function (e) {
    e.preventDefault();
    const self = $(this), url = self.attr('data-m-route');
    if ('time-sheets' === url) {
        const message = [
            `<strong style="float:left;"><small class="text-muted">Sent Date</small> <br>${moment(self.attr('data-date')).format(std.config.date_format)}</strong>`,
            `<strong style="float:right;"><small class="text-muted float-right">Sent By</small> <br>${self.attr('data-user')}</strong>`,
            '<br><br><br>',
            self.attr('data-message')
        ].join('');
        confirmAction({
            message,
            btn: 'btn-success',
            action: 'Open'
        }, function() {
            setCookie('forward_period_id', self.attr('data-tableid'));
            routes.executeRoute(url, { url });
        });
        vDatatable.reload();
    } else {
        routes.executeRoute(url, { url });
    }
});


var reminder = $('#reminder_table').mDatatable({
    // datasource definition
    data: {
        type: 'remote',
        source: {
            read: {
                url: '/note/allFromDasboard',
                method:'GET'
            },
        },
        pageSize: 5,
        saveState: false,
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true,

    },
    layout: {
        scroll: false,
        height: 200,
        smoothScroll: {
            scrollbarShown: false
        }
    },
    // column sorting
    sortable: true,
    pagination: false,
    toolbar: {
        // toolbar items
        items: {
            // pagination
            pagination: {
                // page size select
                pageSizeSelect: [5, 10, 20, 30, 50, 100],
            },
        },
    },
    search: {
        input: $('#generalSearch'),
        
    },
    rows: {
        // auto hide columns, if rows overflow
        autoHide: true,
    },
    // columns definition
    columns: [
        {
            field: 'date',
            title: 'Date',
            template: function(row){
                return moment( row.start_date).format(std.config.date_format);
            },
            width: 70,
        },
        {
            field: 'title',
            title: 'Title',
            sortable: 'asc',
            width: 320,
        }, {
            field: '',
            title: '',
            width: 40,
            template: function(row){
                return `<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/note/edit/` + row.id + `">\
                        <i class="la la-eye"></i></button>`;
            },
        },]
});

reminder.search('reminder', 'note_type');


var todo = $('#todo_table').mDatatable({
    // datasource definition
    data: {
        type: 'remote',
        source: {
            read: {
                url: '/note/allFromDasboard',
                method:'GET'
            },
        },
        pageSize: 5,
        saveState: false,
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true,

    },
    layout: {
        scroll: false,
        height: 200,
        smoothScroll: {
            scrollbarShown: false
        }
    },
    // column sorting
    sortable: true,
    pagination: false,
    toolbar: {
        // toolbar items
        items: {
            // pagination
            pagination: {
                // page size select
                pageSizeSelect: [5, 10, 20, 30, 50, 100],
            },
        },
    },
    search: {
        input: $('#generalSearch'),
    },
    rows: {
        // auto hide columns, if rows overflow
        autoHide: true,
    },
    // columns definition
    columns: [
        {
            field: 'note_date',
            title: 'Date',
            sortable: 'asc',
            template: function(row){
                return moment( row.start_date).format(std.config.date_format);
            },
            width: 70,
        },{
            field: 'title',
            title: 'Title',
            sortable: 'asc',
            width: 320,
        },{
            field: '',
            title: '',
            width: 40,
            template: function(row){
                return `<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/note/edit/` + row.id + `">\
                        <i class="la la-eye"></i></button>`;
            },
        },]
});

todo.search('todo', 'note_type');


$('#selectStipendPeriod').selectpicker();
$(document).off('change', '#selectStipendPeriod').on('change', '#selectStipendPeriod', function(e){
    e.preventDefault();
    var text1 = $(this).attr("data-text");
    $("#datePeriod").text('Period '+ text1);
    var request = {
        url: 'reloadChart/'+$(this).val(),
        method: 'get'
    }
    ajaxRequest(request, function(response){
        $('#finance_tab1').html(response.data);
    });
    var request = {
        url: 'reloadChartItem/'+$(this).val(),
        method: 'get'
    }
    ajaxRequest(request, function(response){
        $('#finance_tab2').html(response.data);
    });
    var request = {
        url: 'reloadFinanaceDetail/'+$(this).val(),
        method: 'get'
    }
    ajaxRequest(request, function(response){
        $('#summary_tab1').html(response.data);
    })
});
</script>