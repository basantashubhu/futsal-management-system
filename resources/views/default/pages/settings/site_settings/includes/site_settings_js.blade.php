<script type="text/javascript">
    var DatatableAutoColumnHideDemo = function() {
        //== Private functions
        // basic demo
        var demo = function() {
            var datatable = $('.site_datatable').mDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '/site_settings/all',
                            method: 'GET'
                        },
                    },
                    pageSize: 50,
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
                columns: [{
                    field: 'code',
                    title: 'Code',
                    sortable: 'asc'
                }, {
                    field: 'value',
                    title: 'Value',
                }, {
                    field: 'description',
                    title: 'Description',
                }, {
                    field: 'action',
                    title: 'Action',
                    template: function(row) {
                        return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/site_settings/edit/' + row.id + '">\
                                    <i class="la la-edit"></i></button> &nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/site_settings/delete/' + row.id + '">\
                                    <i class="la la-trash"></i></button>';
                    },
                }, ]
            });
            $(document).off('keyup', '#SiteCode').on('keyup', '#SiteCode', function(e) {
                if (this.value.length < 3 && this.value.length > 0) return;
                datatable.search($(this).val(), 'code');
            });
            $(document).off('keyup', '#SiteValue').on('keyup', '#SiteValue', function(e) {
                if (this.value.length < 3 && this.value.length > 0) return;
                datatable.search($(this).val(), 'value');
            });

        };

        return {
            // public functions
            init: function() {
                demo();
            },
        };
    }();
    $(document).off('click', '.siteSettingExporter').on('click', '.siteSettingExporter', function(e) {
        var field = $(this).attr("data-sort-field");
        var value = $(this).attr("data-sort-value");
        var exporttype = $(this).attr('data-export-type');

        console.log(field, value, exporttype);
        var url = 'site-settings-export/' + exporttype + '?';
        var data = '&sort_field=' + field + '&sort_value=' + value;
        window.open(url + data);
    });

    jQuery(document).ready(function() {
        DatatableAutoColumnHideDemo.init();
    });
</script>