<script type="text/javascript">
    var DatatableAutoColumnHideDemo = function () {
        //== Private functions
        // basic demo
        var demo = function () {
            var datatable = $('#template_datatable').mDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '/email_template/all',
                            method:'GET'
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
                columns: [
                    {
                        field: 'temp_name',
                        title: 'Template Name',
                        sortable: 'asc'
                    }, {
                        field: 'temp_type',
                        title: 'Template Type',
                    }, {
                        field: 'section',
                        title: 'Section',
                    }, {
                        field: 'action',
                        title: 'Action',
                        width: 140,
                        template: function(row){
                            return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/singleTemplate/'+row.id+'">\
                                    <i class="la la-eye"></i></button> &nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/email_template/edit/'+row.id+'">\
                                    <i class="la la-edit"></i></button> &nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/email_template/delete/'+row.id+'">\
                                    <i class="la la-trash"></i></button>';
                        },
                    },]
            });
            $(document).off('blur','#TemplateName').on('blur','#TemplateName',function (e) {
                datatable.search($(this).val(),'temp_name');
            });
            $(document).off('blur','#TemplateType').on('blur','#TemplateType',function (e) {
                datatable.search($(this).val(),'temp_type');
            });
            $(document).off('blur','#TemplateSection').on('blur','#TemplateSection',function (e) {
                datatable.search($(this).val(),'section');
            });
        };

        return {
            // public functions
            init: function () {
                demo();
            },
        };
    }();

    jQuery(document).ready(function () {
        DatatableAutoColumnHideDemo.init();
    });

    jQuery('.modal-dialog').draggable();
</script>