<script>
$(document).ready(function(){
	var sentMailTable = $('#sentMail').mDatatable({
		data: {
            type: 'remote',
            source: {
                read: {
                    url: '/email/select/Success',
                    method: 'GET',
                }
            },
            pageSize: 10,
            saveState: false,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
        },

        // column sorting
        sortable: true,

        pagination: true,

        toolbar: {
            // toolbar items
            items: {
                // pagination
                pagination: {
                    // page size select
                    pageSizeSelect: [10, 20, 30, 50, 100],
                },
            },
        },

        search: {
            input: $('#generalSearch'),
        },
        layout: {
            scroll: false,
        },
        rows: {
            // auto hide columns, if rows overflow
            autoHide: true,
        },

        // columns definition
        columns: [
            {
                field: 'sub',
                title: 'Subject',
                width: 150
            },
            {
                field: 'msg',
                title: 'Message'
            },
            {
                field: 'from',
                title: 'From',
                width: 100
            },
            {
            	field: 'sent_date',
            	title: 'Sent Date',
            	template: function(row){
            		return moment(row.sent_date).format(std.config.date_format);
            	}
            },
            {
                field: 'action',
                title: 'Action',
                sortable: false,
                width: 100,
                template: function (row) {
                    var btn = '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-route="emailSingle/' + row.id + '" title="View Email">' +
                        '<i class="la la-eye"></i>' +
                        '</button>';

                    if (row.is_approved != 1 && row.is_approved != 3) {
                        btn += '<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"  data-modal-title=" Delete Organization" data-modal-route=/organization/delete/' + row.id + '" data-modal-type="delete">\
                    <i class="la la-trash"></i></button>'
                    }

                    return btn;
                },
            },
        ]
    });
    var draftMailTable = $('#draftMail').mDatatable({
		data: {
            type: 'remote',
            source: {
                read: {
                    url: '/email/select/Draft',
                    method: 'GET',
                }
            },
            pageSize: 10,
            saveState: false,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
        },

        // column sorting
        sortable: true,

        pagination: true,

        toolbar: {
            // toolbar items
            items: {
                // pagination
                pagination: {
                    // page size select
                    pageSizeSelect: [10, 20, 30, 50, 100],
                },
            },
        },

        search: {
            input: $('#generalSearch'),
        },
        layout: {
            scroll: false,
        },
        rows: {
            // auto hide columns, if rows overflow
            autoHide: true,
        },

        // columns definition
        columns: [
            {
                field: 'sub',
                title: 'Subject',
                width: 150
            },
            {
                field: 'msg',
                title: 'Message'
            },
            {
                field: 'from',
                title: 'From',
                width: 100
            },
            {
            	field: 'to',
            	title: 'To'
            },
            {
                field: 'action',
                title: 'Action',
                sortable: false,
                width: 100,
                template: function (row) {
                    var btn = '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-route="org/single/' + row.id + '" title="View Application">' +
                        '<i class="la la-eye"></i>' +
                        '</button>';

                    if (row.is_approved != 1 && row.is_approved != 3) {
                        btn += '<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"  data-modal-title=" Delete Organization" data-modal-route=/organization/delete/' + row.id + '" data-modal-type="delete">\
                    <i class="la la-trash"></i></button>'
                    }

                    return btn;
                },
            },
        ]
    });
});
</script>