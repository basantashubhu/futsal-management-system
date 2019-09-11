<script type="text/javascript">
    var DatatableAutoColumnHideDemo = function () {
        //== Private functions
        // basic demo
        var demo = function () {
            var datatable = $('.validation_datatable').mDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '/validation/all',
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
                        field: 'section',
                        title: 'Section',
                        sortable: 'asc'
                    },{
                        field: 'action',
                        title: 'Action',
                        template: function(row){
                            return '<button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-route="validation/singleView/'+row.id+'")>\
                                    <i class="la la-eye"></i></button> &nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/validation/edit/'+row.id+'")>\
                                    <i class="la la-edit"></i></button> &nbsp;\
                                    <button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" data-modal-route="/validation/delete/'+row.id+'">\
                                    <i class="la la-trash"></i></button>';
                        },
                    },
                ]
            });

            $(document).off('keyup', '#validationSection').on('keyup', '#validationSection', function(){
                datatable.search($(this).val(), 'section');
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

        $(document).off('click', '.LookupSingleView').on('click', '.LookupSingleView', function (e) {
            let request = { url: this.getAttribute('data-c-route'), beforeSend: addFormLoader };
            location.hash = request.url;
            makeActiveRow({id: this.getAttribute('data-id')});
            ajaxRequest(request, function (response) {
                $('#singleValidation').html(response.data);
                removeFormLoader();
            });
        });

        $('#ValidationSection').select2({
            width: 'resolve', placeholder: 'Section Search',
            ajax: {
                url: '/lookup/search-section', delay: 500,
                processResults: results => ({results})
            }
        }).on('select2:select', e => {
            let data = e.params.data;
            let request = { url: 'validation/singleView/'+ data.id, beforeSend: addFormLoader };
            location.hash = request.url;
            makeActiveRow(data);
            ajaxRequest(request, function (response) {
                $('#singleValidation').html(response.data);
                removeFormLoader();
            });
        });
    });
    function makeActiveRow({id}) {
        $('#SiteSectionTable .LookupSingleView[data-id="'+ id +'"]').addClass('active_row').siblings('.LookupSingleView').removeClass('active_row');
    }
</script>