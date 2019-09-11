<script type="text/javascript">
    $(document).ready(function () {
        var datatable = $('.rate_datatable').mDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/rate/all/{{$rate_plan->id}}',
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
            },
            // columns definition
            columns: [
                {
                    field: 'rate_type_name',
                    title: 'Rate Type',
                    sortable: 'asc',
                    template: function(row) {
                        return row.rate_type_name.ucfirst();
                    }
                },
                {
                    field: 'treatment_name',
                    title: 'Procedure Type',
                    sortable: false,
                    template: function(row){
                        if(row.treatment_name!=null)
                            return row.treatment_name.ucfirst();
                        else
                            return 'All';
                    }

                },
                {
                    field: 'animal_type',
                    title: 'Animal Type',
                    sortable: false,
                    template: function(row){
                        return row.animal_type.ucfirst();
                    }
                },
                {
                    field: 'sex',
                    title: 'Sex',
                    sortable: false,
                    template: function(row){
                        return row.sex.ucfirst();
                    }
                },
                {
                    field: 'cost',
                    title: 'Max Contingent',
                    sortable: false,
                    textAlign: 'right',
                    template:function (row) {
                        return '$'+row.cost.toFixed(2);
                    }
                },
                {
                    field: 'action',
                    title: 'Action',
                    template: function (row) {
                        return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/rate/edit/' + row.id + '">\
                        <i class="la la-edit"></i></button>\
                        <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/rate/delete/' + row.id + '">\
                        <i class="la la-trash"></i></button>';
                    },
                },
            ]
        });
    });
</script>