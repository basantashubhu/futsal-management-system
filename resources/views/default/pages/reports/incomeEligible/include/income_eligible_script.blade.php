<script>
    $('select').selectpicker();


    var dateRange = $('#ieContent').attr('data-dateRange');
    reportDatePicker(dateRange);
    jQuery(document).ready(function () {
        var request = {
            url: '/report/incomeEligible/getPetData',
            method: 'get',
        };
        ajaxRequest(request, function (response) {
            var data = response.data;
            pieChart("#m_flotcharts_8", data)
        });

        var request2 = {
            url: '/report/incomeEligible/getClientData',
            method: 'get',
        };
        ajaxRequest(request2, function (response) {
            var data = response.data;
            pieChart("#m_flotcharts_9", data)
        });

    });

    function pieChart(id, data) {
        $.plot($(id), data, {
            series: {
                pie: {
                    show: true,
                    radius: 0.8,
                    label: {
                        show: true,
                        radius: 1 / 4,
                        formatter: labelFormatter,
                    }
                }
            },
            legend: {
                show: false
            }
        });
    }
    function labelFormatter(label, series) {
        return "<div style='font-size:12pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
    }

    var datatable = $('.ieReport_table').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/report/incomeEligible/getAll?dateRange='+dateRange,
                    method: 'GET'
                },
            },
            pageSize: 50,
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
        detail: {
            title: 'Treatment Table',
            content: subTableInit
        },

        rows: {
            // auto hide columns, if rows overflow
            autoHide: false,
        },

        // columns definition
        columns: [
            {
                field: 'id',
                title: '',
                width: '10px'
            },
            {
                field: 'client_name',
                title: 'Client',
                template: function (row) {
                    if (row.mname)
                        return row.fname + ' ' + row.mname + ' ' + row.lname;
                    else
                        return row.fname + ' ' + row.lname;
                }
            },

            {
                field: 'cell_phone',
                title: 'Phone',
                width:'100px'
            },
            {
                field:'city',
                title:'City',
            },
            {
                field:'zip_code',
                title:'Zip',
            },
            {
                field: 'number_of_pet',
                title: 'Total Pet',
                width: '80px',
                textAlign:'center',
            },
            {
                field: 'no_of_application',
                title: 'Total Application',
                width: '120px',
                textAlign:'center',
            },
            {
                field: 'total_invoice',
                title: 'Total invoice',
                template: function (row) {
                    if(row.total_invoice)
                        return '$'+row.total_invoice.toFixed(2);
                    else
                        return '-';
                },
                textAlign:'right',
                width: '100px'
            },
            {
                field: 'paid_copay',
                title: 'Total Copay',
                template: function (row) {
                    if(row.paid_copay)
                        return '$'+row.total_invoice.toFixed(2);
                    else
                        return '-';
                },
                textAlign:'right',
                width: '100px'
            }
        ]
    });

    function subTableInit(e) {
        $('<div/>').attr('id', 'child_data_ajax_' + e.data.id).appendTo(e.detailCell).mDatatable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/ieReport/getByclient/' + e.data.id,
                        method: 'GET',
                        params: {
                            // custom query params
                            query: {
                                generalSearch: '',
                            },
                        },
                    },
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },

            // layout definition
            layout: {
                theme: 'default',
                scroll: true,
                height: 'auto',
                footer: false,

                // enable/disable datatable spinner.
                spinner: {
                    type: 1,
                    theme: 'default',
                },
            },

            sortable: true,

            // columns definition
            columns: [
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
                    field: 'id',
                    title: 'ID',
                    width: 80,
                    template: function (row) {
                        if (std.config.alt_id == 'true') {
                            if(row.alt_id)
                                return 'IE' + row.alt_id.toString().padStart(5, '0');
                            else
                                return row.id;
                        }
                        return row.id;
                    }
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
                    field: 'copay',
                    title: 'Copay',
                    sortable: false,
                    width: 100,
                    template: function (row) {
                        if (!row.org_id && (row.status == 'Approved' || row.is_provider_view)) {
                            if (row.copay == null) {
                                return ' <span class="m-badge m-badge--danger m-badge--wide c-p">Unpaid</span>';
                            }
                            else {
                                if (row.no_of_pet * 20 == row.copay)
                                    return '<span class="m-badge m-badge--success m-badge--wide c-p">Paid</span>';
                                else {
                                    var remaining = (row.no_of_pet * 20) - row.copay;
                                    return '<span class="m-badge m-badge--warning m-badge--wide c-p">Partial Paid</span>';
                                }

                            }

                        }
                        else
                            return '-';

                    },
                },
                {
                    field: 'inv_amt',
                    title: 'Invoice Amt.',
                    sortable: false,
                    width: 100,
                    textAlign: 'right',
                    template:function (row) {
                        if(row.inv_amt)
                            return '$'+row.inv_amt.toFixed(2);
                        else
                            return '';
                    }
                },
                {
                    field: 'status',
                    title: 'Status',
                    width: 140,
                    template: function (row) {
                        if (!row.status) {
                            return '<span data-modal-route="application/status/' + row.id + '" class="m-badge  m-badge--info m-badge--wide c-p">New</span>';
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
                        return '<span  data-modal-route="application/status/' + row.id + '" class="m-badge ' + type + ' m-badge--wide c-p">' + row.status + '</span>';

                    }
                },
                {
                    field: 'source',
                    title: 'Source',
                    width: 70,
                    template: function (row) {
                        if (row.source) {
                            return '<h6>' + row.source + '</h6>'
                        }
                        return '';
                    },
                },
            ],
        });
    }


    $('.m_report_date_filter').on('apply.daterangepicker', function (ev, picker) {
        var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');

        var url = 'report/incomeEligible?a=1';
        if (dateRange != '')
            url += '&dateRange=' + dateRange;

        var request = {
            url: url
        };
        ajaxRequest(request, function (response) {
            $('#contentHolder').empty().html('').html(response.data)
        });
    });

    $('.m_report_date_filter').on('cancel.daterangepicker', function (ev, picker) {
        var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');

        var url = 'report/incomeEligible?a=1';
        if (dateRange != '')
            url += '&dateRange=' + dateRange;

        var request = {
            url: url
        };
        ajaxRequest(request, function (response) {
            $('#contentHolder').empty().html('').html(response.data)
        });
    });


</script>