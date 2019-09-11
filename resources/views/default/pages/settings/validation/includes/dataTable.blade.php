<div class="validation_val_datatable"></div>
<script>
    $(function () {
        let datatable = $('.validation_val_datatable').mDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/validation/all?groupBy=false',
                        method: 'GET',
                        params: {
                            // custom parameters
                            query: {
                                'sectionSelect': [
                                    '{{$section->section}}'
                                ]
                            }
                        }
                    }
                },
                pageSize: 50,
                saveState: false,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true

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
                        pageSizeSelect: [10, 20, 30, 50, 100]
                    }
                }
            },
            search: {
                input: $('#ValidationTableSearch')
            },
            rows: {
                // auto hide columns, if rows overflow
                autoHide: false
            },
            // columns definition
            columns: [
                {
                    field: 'id',
                    title: '#',
                    width: 20,
                    template: function (row) {
                        return '#';
                    }
                },
                {
                    field: 'code',
                    title: 'Code'
                },
                {
                    field: 'value',
                    title: 'Value',
                    sortable: 'asc',
                    width: 400
                },
                {
                    field: 'action',
                    title: 'Action',
                    width: 100,
                    template: function (row) {
                        return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/validation/edit/' + row.id + '">\
                        <i class="la la-edit"></i></button>&nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/validation/delete/' + row.id + '">\
                                    <i class="la la-trash"></i></button>'
                            ;
                    }
                }]
        });
        $(document).off('input', '#ValidationTableSearch').on('input', '#ValidationTableSearch', function (e) {
            if (this.value.length < 3) return;
            datatable.search(this.value, 'code');
        });
    });
</script>