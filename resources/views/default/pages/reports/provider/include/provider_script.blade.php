<script type="text/javascript">
    $('#serviceProviderFilter').selectpicker({
        liveSearch: true,
        showTick: true,
        actionsBox: true,
    });

    var pid = $('#providerContent').attr('data-provider');
    var dateRange = $('#providerContent').attr('data-dateRange');
    reportDatePicker(dateRange);

    var ieTable = $('.pet_datatable').mDatatable({
        // datasource definition
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '/report/allProvider/?provider=' + pid+'&dateRange='+dateRange,
                    method: 'GET'
                },
            },
            pageSize: 100,
            saveState: false,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,

        },
        layout: {
            theme: 'default',
            scroll: false,
            footer: false
        },

        detail: {
            title: 'Treatment Table',
            content: subTableInit
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

        rows: {
            autoHide: false,
        },

        // columns definition
        columns: [
            {
                field: 'appId',
                title: '',
                sortable: false,
                width: 10,
            }, {
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
                field: 'org_id',
                title: 'Type',
                width: 40,
                template: function (row) {
                    if (row.org_id)
                        return 'NP';
                    else
                        return 'IE';
                }
            },
            {
                field: 'fname',
                title: 'Owner Name',
                template: function (row) {
                    if (row.mname)
                        return row.fname + ' ' + row.mname + ' ' + row.lname;
                    else
                        return row.fname + ' ' + row.lname;
                }
            },

            {
                field: 'id',
                title: 'AppId',
                width: 50,
                template: function (row) {
                    if (std.config.alt_id == 'true') {
                        return row.alt_id;
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
                field: 'copay',
                title: 'Copay',
                sortable: false,
                width: 100,
                template: function (row) {
                    if (!row.org_id) {
                        if (row.copay == null) {
                            //return ' <span class="m-badge m-badge--danger m-badge--wide c-p">Unpaid</span>';
                            return '$ ' + (row.no_of_pet * 20)
                        }
                        else {
                            if (row.no_of_pet * 20 == row.copay)
                                return '$ ' + row.copay.toFixed(2) + ' <span class="m-badge m-badge--success m-badge--wide c-p">Paid</span>';
                            else {
                                var remaining = (row.no_of_pet * 20) - row.copay;
                                return '$ ' + remaining.toFixed(2) + ' <span class="m-badge m-badge--warning m-badge--wide c-p">Remaining</span>';
                            }

                        }

                    }
                    else
                        return '-';

                },
                textAlign:'right'
            },
            {
                field: 'inv_amt',
                title: 'Invoice Amt.',
                sortable: false,
                width: 100,
                template: function (row) {
                    if (row.inv_amt == null) {
                        //return '<span class="m-badge m-badge--danger m-badge--wide c-p">Unpaid</span>';
                        return 0;
                    }
                    else {
                        //return '<span class="m-badge m-badge--success m-badge--wide c-p">Paid</span>';
                        return '$ '+row.inv_amt.toFixed(2);
                    }
                },
                textAlign:'right'
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
                    return '<span class="m-badge ' + type + ' m-badge--wide c-p">' + row.status + '</span>';

                }
            },
            {
                field: 'action',
                title: 'Comment',
                width: 80,
                template: function (row) {
                    return '';
                },
            },]
    });
    function subTableInit(e) {
        $('<div/>').attr('id', 'child_data_ajax_' + e.data.appId).appendTo(e.detailCell).mDatatable({
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/application/treatmentList/' + e.data.appId,
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
                    field: 'id',
                    title: 'Pet ID',
                    width: 40
                },
                {
                    field: 'pet_name',
                    title: 'Pet Name',
                    template: function (data) {
                        var className = '';
                        if (data.species) {
                            if (data.species.toLowerCase() == "dog")
                                className = "socicon-zynga";
                            else if (data.species.toLowerCase() == "cat")
                                className = "   socicon-github";
                            else
                                className = "socicon-swarm";

                            return '<div class="row"><div class="col-sm-1"><i class="' + className + '"></i></div><div class="col-sm-1"><div style="background-color: ' + data.color + ';width: 15px;height:15px;border-radius:50%;"></div></div><div class="col-sm-8">' + data.pet_name + '</div></div>';
                        }

                    },
                    width: 200
                },
                {
                    field: 'sex',
                    title: 'Sex',
                    width: 70
                },
                {
                    field: 'weight',
                    title: 'Weight',
                    width: 70
                },
                {
                    field: 'breed',
                    title: 'Breed',
                    width: 70
                },
                {
                    field: 'age_of_pet',
                    title: 'Age',
                    width: 40
                },
                {
                    field: 'unique_traits',
                    title: 'Unique Traits',
                    width: 200
                }, {
                    field: 'where_obtained',
                    title: 'Where Obtained',
                    width: 200
                },
                {
                    field: 'treatments_performed',
                    title: 'Treatment',
                    template: function (row) {
                        if (row.treatments_performed == null) {
                            return '<span class="m-badge m-badge--danger m-badge--wide c-p">Not Assigned</span>'
                        }
                        else {
                            var treatment = '';
                            var data = row.treatments_performed.split(',');
                            $(data).each(function (k, v) {
                                treatment += '<span class="m-badge m-badge--success m-badge--wide c-p">' + v.ucfirst() + '</span> &nbsp;'
                            });
                            return treatment;
                        }

                    },
                    width: 80
                },
            ],
        });
    }

    $('.m_report_date_filter').on('apply.daterangepicker', function (ev, picker) {
        var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
        var selectedProvider = $('#serviceProviderFilter').val();
        sendRequest(selectedProvider, dateRange);

    });

    $('#serviceProviderFilter').on('change', function () {
        var selectedProvider = $(this).val();
        var dateRange = '';
        sendRequest(selectedProvider, dateRange);
    });

    function sendRequest(serviceProvider, dateRange) {

        var url = 'report/provider?a=1';
        if (serviceProvider != '')
            url += '&provider=' + serviceProvider;
        else if (dateRange != '')
            url += '&dateRange=' + dateRange;

        var request = {
            url: url
        };
        ajaxRequest(request, function (response) {
            $('#contentHolder').empty();
            $('#contentHolder').html('');
            $("#contentHolder").html(response.data)
        });
    }


</script>