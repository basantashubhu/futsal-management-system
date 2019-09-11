<div class="clearfix">
    <div class="lookup_val_datatable_1"></div>
</div>
<script>
    $(function () {
        let datatable = $('.lookup_val_datatable_1').mDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/lookup/all?groupBy=false',
                        method: 'GET',
                        params: {
                            // custom parameters
                            query: {
                                'section': [
                                    '{{ $section }}'
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
                input: $('#LookupSingleTableSearch')
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
                }, {
                    field: 'code',
                    title: 'Code',
                    width: 150,
                    sortable: 'asc'
                },
                {
                    field: 'value',
                    title: 'Value',
                    sortable: 'asc',
                    width: 200
                },
                {
                    field: 'type',
                    title: 'Category',
                    width: 150,
                },
                {
                    field: 'description',
                    title: 'Description',
                },
                {
                    field: 'action',
                    title: 'Action&nbsp;&nbsp;&nbsp;',
                    textAlign:'right',
                    width: 100,
                    template: function (row) {
                        return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/lookup/edit/' + row.id + '">\
                        <i class="la la-edit"></i></button>&nbsp;<button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/lookup/delete/' + row.id + '">\
                                    <i class="la la-trash"></i></button>'
                            ;
                    }
                }]
        });
        $(document).off('input', '#LookupSingleTableSearch').on('input', '#LookupSingleTableSearch', function (e) {
            if (this.value.length < 3) return;
            datatable.search(this.value, 'code');
        });
    });
</script>
