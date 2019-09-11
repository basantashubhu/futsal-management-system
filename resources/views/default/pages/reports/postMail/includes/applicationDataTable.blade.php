<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30 collapse show" id="generateButtons" style="display:none">
</div>
<form id="mailForm">
	<div class="applicationTable" id="applicationTable"></div>
</form>
<script>
		var applicationTable = $('#applicationTable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/application/all',
                    method: 'POST',
					headers:{
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
                    params: {
                        // custom parameters
                        query: {
                            'status': [
                                'Approved', 'Denial'
                            ],
                            'from': 'post_mail'
                        }
                    },
                },
            },
            pageSize: 100,
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
                    pageSizeSelect: [100, 200, 300, 500, 1000],
                },
            },
        },

        rows: {
            // auto hide columns, if rows overflow
            autoHide: true,
            beforeTemplate: function(row, data, index){
                row.find('td:eq(0)').addClass('m-datatable__toggle--detail');
                row.attr('data-active-id', data.id);
            },
        },

        layout: {
            theme: 'default',
            class: 'm-datatable--brand',
            scroll: false,
        },

        // columns definition
        columns: [
            {
                field: "id",
                title: "#",
                sortable: false, // disable sort for this column
                width: 40,
                selector: {class: 'm-checkbox--solid m-checkbox--brand checkedToGenerate'}
            },
            {
                field: 'created_at',
                title: 'Date',
                sortable: 'desc',
                width: 80,
                template: function (row) {
                    return moment(row.created_at).format(std.config.date_format);
                }
            },
            {
                field: 'alt_id',
                title: 'ID',
                width: 80,
                template: function (row) {
                    if (std.config.alt_id == 'true' && row.alt_id) {
                        return 'IE' + row.alt_id.toString().padStart(5, '0');
                    }
                    return row.id;
                }
            },

            {
                field: 'org_id',
                title: 'Type',
                sortable: true,
                width: 50,
                template: function (row) {
                    if (row.org_id) {
                        if (row.org_id != row.providerId)
                            return 'Rescue';
                        else
                            return 'NP';
                    }
                    else {
                        return 'IE';
                    }

                }
            },
            {
                field: 'fname',
                title: 'Owner/Care Taker',
                sortable: false,
                width: 190,
                template: function (row) {
                    if (row.fname == null) {
                        return '';
                    }
                    if (row.mname != null)
                        return row.fname.ucfirst() + ' ' + row.mname.ucfirst() + ' ' + row.lname.ucfirst();
                    else
                        return row.fname.ucfirst() + ' ' + row.lname.ucfirst();
                },
            },
            {
                field: 'no_of_pet',
                title: 'Total Pets',
                width: 80
            },
            {
                field: 'service_provider',
                title: 'Service Provider',
                sortable: false,
                width: 200,
                template: function (row) {
                    if (row.service_provider == null)
                        return '<span class="m-badge m-badge--danger m-badge--wide c-p">Not assigned</span>';

                    else
                        return row.service_provider.ucfirst();
                }
            },
            {
                field: 'status',
                title: 'Status',
                width: 140,
                template: function (row) {
                    if (!row.status) {
                        return '<span class="m-badge  m-badge--info m-badge--wide c-p">New</span>';
                    }
                    if (row.status == 'New') {
                        var type = 'm-badge--info newStatus';

                    } else if (row.status == 'Pending') {
                        var type = 'm-badge--warning';
                    } else if (row.status == 'Approved') {
                        var type = 'm-badge--success';
                    } else if (row.status == 'Invoiced') {
                        var type = 'm-badge--warning';
                    }
                    else {
                        var type = 'm-badge--danger';
                    }
                    return '<span class="m-badge ' + type + ' m-badge--wide c-p">' + row.status + '</span>';

                }
            },
            {
                field: 'source',
                title: 'Source',
                width: 100,
                template: function (row) {
                    if (row.source) {
                        return '<h6>' + row.source + '</h6>'
                    }
                    return '';
                },
            },
            {
                field: 'action',
                title: 'Action',
                width: 80,
                template: function (row) {
                    var btn = '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" \
                            data-route="application/' + row.id + '" title="View Application">' +
                        '<i class="la la-eye"></i>' +
                        '</button>';

                    if(row.source && (row.source=='FixedAndFab' || row.source=='WebSite') && row.is_provider_view!=1)
                    {
                        btn+='<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" ' +
                            'data-modal-title=" Delete Application" data-modal-route="/application/delete/'+row.id+'" data-modal-type="delete">' +
                            '<i class="la la-trash"></i></button>'
                    }

                    return btn;
                },
            },
        ]
    });

    $('#m_application_date_filter').on('apply.daterangepicker', function (ev, picker) {
        var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
        applicationTable.search(dateRange, 'dateRange');
    });
</script>