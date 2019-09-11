<script>

    $(document).ready(function () {
        //var date=moment().startOf('month').format('MM/DD/YYYY')+'-'+moment().endOf('month').format('MM/DD/YYYY');
        reportDatePicker();

        $('#assign_to,#assign_from,#status,#support_type,#support_category,#support_department').selectpicker({
            liveSearch: true,
            showTick: true,
            actionsBox: true,
        });

        var supportTable = $('.support_datatable').mDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/report/allSupportData',
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
                height: 650,
                footer: false
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
                    field: 'assigned_date',
                    title: 'Assign Date',
                    sortable: false,
                    width: 150,
                    template:function (row) {
                        return moment(row.assigned_date).format(std.config.date_time_format);
                    }
                },
                {
                    field: 'assign_from',
                    title: 'Assign From',
                    sortable: false,
                    width: 150,
                },
                {
                    field: 'assign_to',
                    title: 'Assign To',
                    width: 150,
                },
                {
                    field: 'total_time',
                    title: 'Total Time',
                    width: 100,
                },
                {
                    field: 'support_type',
                    title: 'Type',
                    width: 80
                },
                {
                    field: 'support_category',
                    title: 'Category',
                    sortable: false,
                    width: 100,

                },
                {
                    field: 'support_department',
                    title: 'Department',
                    sortable: false,
                    width: 100,

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
                }]
        });

        $('#assign_to').off('change').on('change', function (e) {
            supportTable.search($(this).val(), 'assign_to');
            $(this).selectpicker('val',$(this).val());
        });

        $('#assign_from').off('change').on('change', function (e) {
            supportTable.search($(this).val(), 'assign_from');
            $(this).selectpicker('val',$(this).val());
        });
        $('#status').off('change').on('change', function (e) {
            supportTable.search($(this).val(), 'status');
            $(this).selectpicker('val',$(this).val());
        });
        $('#support_type').off('change').on('change', function (e) {
            supportTable.search($(this).val(), 'support_type');
            $(this).selectpicker('val',$(this).val());
        });

        $('#support_category').off('change').on('change', function (e) {
            supportTable.search($(this).val(), 'support_category');
            $(this).selectpicker('val',$(this).val());
        });

        $('#support_department').off('change').on('change', function (e) {
            supportTable.search($(this).val(), 'support_department');
            $(this).selectpicker('val',$(this).val());
        });

        $('.m_report_date_filter').on('apply.daterangepicker', function (ev, picker) {
            var dateRange = picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY');
            supportTable.search(dateRange, 'dateRange');
        });

    });

    $('.supportReportExporter').off('click').on('click',function () {
        var exportType = $(this).attr('data-export-type');
        var url = '/report/exportAll/support/'+exportType+'?';
        var data = $('#SupportReportFilter').serialize();
        var advData = $('#SupportReportAdvFilter').serialize();
        window.open(url+data+'&'+advData);
    });

</script>