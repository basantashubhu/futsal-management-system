<script type="text/javascript">
    $(document).ready(function () {
        var datatable = $('.rate_plan_datatable').mDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/rate_plan/all',
                        method: 'GET'
                    },
                },
                pageSize: 20,
                saveState: false,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,

            },
            layout: {
                scroll: false,
                smoothScroll: {
                    scrollbarShown: false
                }
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
                // auto hide columns, if rows overflow
                autoHide: true,
                beforeTemplate: function(row, data, index){
                    if(data.is_active && !data.is_custom){
                        row.addClass('active_class_row');
                    }
                    row.find('td:not(:last-child)').attr('data-route', 'rate_p/'+data.id);
                    row.find('td').addClass('m-datatable__toggle--detail');
                },
            },
            // columns definition
            columns: [
                {
                    field: 'plan_name',
                    title: 'Plan Name',
                    sortable: 'asc'
                },
                {
                    field: 'start_date',
                    title: 'Start Date',
                    sortable: false,
                    width: 68,
                    template: function(row){
                        return moment( row.start_date).format(std.config.date_format);
                    }
                },
                {
                    field: 'end_date',
                    title: 'End Date',
                    sortable: false,
                    width: 68,
                    template: function(row){
                        return moment( row.end_date).format(std.config.date_format);
                    }
                },
                {
                    field: 'is_active',
                    title: 'Status',
                    width: 65,
                    template: function(row){
                        if(row.is_active && !row.is_custom){
                            return '<span class="m-badge m-badge--success m-badge--wide c-p" data-modal-route="rate_plan/changeStatus/'+row.id+'">Active</span>';
                        }
                        else if(row.is_active && row.is_custom){
                            return '<span class="m-badge m-badge--success m-badge--wide c-p" data-modal-route="rate_plan/changeStatus/'+row.id+'">Active</span>';
                        }
                        else{
                            return '<span class="m-badge m-badge--danger m-badge--wide c-p" data-modal-route="rate_plan/changeStatus/'+row.id+'">Inactive</span>';
                        }
                    },
                },
                {
                    field: 'action',
                    title: 'Action',
                    width: 80,
                    template: function (row) {
                        return '<div class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill rateClicked"' +
                                'data-id="'+row.id+'" >\
                        <i class="la la-eye"></i></div>&nbsp;'+
                            '<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="rate_plan/delete/' + row.id + '">\
                        <i class="la la-trash"></i></button>';
                    },
                },
            ]
        });

        $(document).off('click', '.rateClicked').on('click', '.rateClicked', function(e){
            var row = $(this).closest('table').parent().parent();
            $(row).siblings('.active_class_row').removeClass('active_class_row');
            $(row).prev().addClass('active_class_row');
            $(row).addClass('active_class_row');

            var id=$(this).attr('data-id');
            var request={
                url:'rate_p/'+id,
                method:'get'
            };

            ajaxRequest(request, function (response) {
                $('#singleRatePlan').empty().append(response.data);
            });

        });
    });
</script>